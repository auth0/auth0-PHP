<?php

namespace Auth0SDK;

/*
 * This file is part of Auth0-PHP-SDK package.
 * 
 * (c) Auth0
 * 
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

use OAuth2;
use \Exception;
use \Closure;

/**
 * This class provides access to Auth0 Platform.
 * 
 * @author Sergio Daniel Lepore
 * @todo Logout and other useful proxies. See <https://app.auth0.com/#/sdk/api> 
 *       and <https://docs.auth0.com/api-reference>
 * @todo Lots of code documentation.
 */
abstract class BaseAuth0
{
    /**
     * SDK Version.
     */
    const VERSION = "0.6.0"; // Not ready for production yet :(

    /**
     * SDK Codename.
     */
    const CODENAME = "Abyssinian"; // Yup, a cat breed :)

    /**
     * Available keys to persist data.
     * 
     * @var array
     */
    public static $PERSISTANCE_MAP = array(
        'access_token'
    );

    /**
     * Auth0 URL Map.
     * 
     * @var array
     */
    public static $URL_MAP = array(
        'api'           => 'https://{username}.auth0.com/api',
        'authorize'     => 'https://{username}.auth0.com/authorize',
        'token'         => 'https://{username}.auth0.com/oauth/token',
        'user_info'     => 'https://{username}.auth0.com/userInfo',
    );

    /**
     * Auth0 Username.
     * 
     * @var string
     */
    protected $username;

    /**
     * Auth0 Client ID
     * 
     * @var string
     */
    protected $client_id;

    /**
     * Auth0 Client Secret
     * 
     * @var string
     */
    protected $client_secret;

    protected $redirect_uri;

    /**
     * Debug mode flag.
     * 
     * @var Boolean
     */
    protected $debug_mode;

    /**
     * Debugger function.
     * Will be called only if $debug_mode is true.
     * 
     * @var \Closure
     */
    protected $debugger;

    /**
     * The access token retrieved after authorization.
     * NULL means that there is no authorization yet.
     * 
     * @var string
     */
    protected $access_token;

    /**
     * OAuth2 Client.
     * 
     * @var OAuth2\Client
     */
    protected $oauth_client;



    /**
     * BaseAuth0 Constructor.
     *
     * Configuration:
     *     - username (String) Required
     *     - client_id (string) Required
     *     - client_secret (string) Required
     *     - redirect_uri (string) Required
     *     - debug (Boolean) Optional. Default false
     *     
     * @param array $config Required
     *
     * @throws CoreException If `domain` is not provided.
     */
    public function __construct(array $config)
    {
        // check for system requirements
        $this->checkRequirements();

        // now we are ready to go on...
        if (isset($config['username'])) {
            $this->username = $config['username'];
        } else {
            throw new CoreException('Invalid username');
        }

        if (isset($config['client_id'])) {
            $this->client_id = $config['client_id'];
        } else {
            throw new CoreException('Invalid client_id');
        }

        if (isset($config['client_secret'])) {
            $this->client_secret = $config['client_secret'];
        } else {
            throw new CoreException('Invalid client_secret');
        }

        if (isset($config['redirect_uri'])) {
            $this->redirect_uri = $config['redirect_uri'];
        } else {
            throw new CoreException('Invalid redirect_uri');
        }

        if (isset($config['debug'])) {
            $this->debug_mode = $config['debug'];
        } else {
            $this->debug_mode = false;
        }

        $this->oauth_client = new OAuth2\Client($this->client_id, $this->client_secret);
    }

    final public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    final public function getUsername()
    {
        return $this->username;
    }

    final public function setClientId($client_id)
    {
        $this->client_id = $client_id;

        return $this;
    }

    final public function getClientId()
    {
        return $this->client_id;
    }

    final public function setClientSecret($client_secret)
    {
        $this->client_secret = $client_secret;

        return $this;
    }

    final public function getClientSecret()
    {
        return $this->client_secret;
    }

    final public function setRedirectUri($redirect_uri)
    {
        $this->redirect_uri = $redirect_uri;

        return $this;
    }

    final public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    final public function setDebugMode($debug_mode)
    {
        $this->debug_mode = $debug_mode;

        return $this;
    }

    final public function getDebugMode()
    {
        return $this->debug_mode;
    }

    final public function setDebugger(Closure $debugger)
    {
        $this->debugger = $debugger;

        return $this;
    }

    final public function getDebugger()
    {
        return $this->debugger;
    }

    final public function setAccessToken($access_token)
    {
        $this->setPersistentData('access_token', $access_token);
        $this->access_token = $access_token;

        return $this;
    }

    final public function getAccessToken()
    {
        if (!$this->access_token) {
            $this->access_token = $this->getPersistentData('access_token');
            if (!$this->access_token) {
                if (isset($_REQUEST['code'])) {
                    $this->access_token = $this->getTokenFromCode($_REQUEST['code']);
                } else {
                    return;
                }
            }
        }

        return $this->access_token;
    }

    final protected function getTokenFromCode($code)
    {
        $this->debugInfo("Code: ".$code);
        $auth_url = $this->generateUrl('token');

        $auth0_response = $this->oauth_client->getAccessToken($auth_url, "authorization_code", array(
            "code" => $code,
            "redirect_uri" => $this->redirect_uri
        ));

        $auth0_response = $auth0_response['result'];
        $this->debugInfo(json_encode($auth0_response));
        $access_token = (isset($auth0_response['access_token']))? $auth0_response['access_token'] : false;

        if (!$access_token)
            throw new ApiException('Invalid access_token - Retry login.');

        $this->oauth_client->setAccessToken($access_token);
        $this->oauth_client->setAccessTokenType(OAuth2\Client::ACCESS_TOKEN_BEARER);
        $this->setAccessToken($access_token);

        return $access_token;
    }

    final public function getUserInfo()
    {
        $userinfo_url = $this->generateUrl('user_info');

        return $this->oauth_client->fetch($userinfo_url, array(
            'access_token' => $this->access_token
        ));
    }

    public function deleteAllPersistentData()
    {
        foreach (self::$PERSISTANCE_MAP as $key) {
            $this->deletePersistentData($key);
        }
    }

    /**
     * Constructs an API URL.
     * 
     * @param  string $domain_key
     * @param  string $path
     * 
     * @return string
     */
    final protected function generateUrl($domain_key, $path = '/') 
    {
        $base_domain = self::$URL_MAP[$domain_key];
        $base_domain = str_replace('{username}', $this->username, $base_domain);

        if ($path[0] === '/') {
            $path = substr($path, 1);
        }

        return $base_domain.$path;
    }


    /**
     * Checks for all dependencies of SDK or API.
     *
     * @throws CoreException If CURL extension is not found.
     * @throws CoreException If JSON extension is not found.
     * 
     * @return void
     */
    final public function checkRequirements() 
    {
        if (!function_exists('curl_version')) {
            throw new CoreException('CURL extension is needed to use Auth0 SDK. Not found.');
        }

        if (!function_exists('json_decode')) {
            throw new CoreException('JSON extension is needed to use Auth0 SDK. Not found.');
        }
    }

    public function debugInfo($info)
    {
        if ($this->debug_mode && (is_object($this->debugger) && ($this->debugger instanceof Closure))) {
            list(, $caller) = debug_backtrace(false);

            $caller_function = $caller['function'];
            $caller_class = $caller['class'];

            $this->debugger->__invoke($caller_class.'::'.$caller_function. ' > '.$info);
        }
    }


    abstract protected function setPersistentData($key, $value);

    abstract protected function getPersistentData($key);

    abstract protected function deletePersistentData($key);
}

class ApiException extends Exception { }

class CoreException extends Exception { }