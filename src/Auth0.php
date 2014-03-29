<?php

namespace Auth0SDK;

/*
 * This file is part of Auth0-PHP package.
 *
 * (c) Auth0
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

use OAuth2;
use \Exception;
use \Closure;

require_once 'SessionStore.php';
require_once 'EmptyStore.php';

/**
 * This class provides access to Auth0 Platform.
 *
 * @author Auth0
 * @todo Logout and other useful proxies. See <https://app.auth0.com/#/sdk/api>
 *       and <https://docs.auth0.com/api-reference>
 * @todo Lots of code documentation.
 */
class Auth0
{
    /**
     * Available keys to persist data.
     *
     * @var array
     */
    public $persistantMap = array(
        'access_token',
        'user_info'
    );

    /**
     * Auth0 URL Map.
     *
     * @var array
     */
    public static $URL_MAP = array(
        'api'           => 'https://{domain}/api/',
        'authorize'     => 'https://{domain}/authorize/',
        'token'         => 'https://{domain}/oauth/token/',
        'user_info'     => 'https://{domain}/userinfo/',
    );

    /**
     * Auth0 Domain.
     *
     * @var string
     */
    protected $domain;

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

    /**
     * Redirect URI needed on OAuth2 requests.
     *
     * @var string
     */
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


    // -------------------------------------------------------------------------------------------------------------- //


    /**
     * BaseAuth0 Constructor.
     *
     * Configuration:
     *     - domain (String) Required
     *     - client_id (string) Required
     *     - client_secret (string) Required
     *     - redirect_uri (string) Required
     *     - debug (Boolean) Optional. Default false
     *
     * @param array $config Required
     *
     * @throws CoreException If `domain` is not provided.
     * @throws CoreExcaption If `client_id` is not provided.
     * @throws CoreException If `client_secret` is not provided.
     * @throws CoreException If `redirect_uri` is not provided.
     */
    public function __construct(array $config)
    {
        // check for system requirements
        $this->checkRequirements();

        // now we are ready to go on...
        if (isset($config['domain'])) {
            $this->domain = $config['domain'];
        } else {
            throw new CoreException('Invalid domain');
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

        if (isset($config['persist_access_token']) && $config['persist_access_token'] === false) {
            $key = array_search('access_token',$this->persistantMap);
            if ($key !== false) {
                unset($this->persistantMap[$key]);
            }
        }

        if (isset($config['store'])) {
            if ($config['store'] === false) {
                $this->store = new EmptyStore();
            } else {
                $this->store = $config['store'];
            }
        } else {
            $this->store = new SessionStore();
        }

        $this->oauth_client = new OAuth2\Client($this->client_id, $this->client_secret);

        $this->user_info = $this->store->get("user_info");
        $this->access_token = $this->store->get("access_token");

        if (!$this->access_token) {
            $this->oauth_client->setAccessToken($this->access_token);
        }
    }

    private function exchangeCode() {

        if (!isset($_REQUEST['code'])) {
            return false;
        }
        $access_token = $this->getTokenFromCode($_REQUEST['code']);

        $user_info = $this->oauth_client->fetch($this->generateUrl('user_info'));

        $this->setUserInfo($user_info);
        return true;
    }

    /**
     * Requests user info to Auth0 server.
     *
     * @return array
     */
    public function getUserInfo() {
        if ($this->user_info === false) {
            $this->exchangeCode();
        }
        return $this->user_info;
    }

    private function setUserInfo($user_info) {

        $key = array_search('user_info',$this->persistantMap);
        if ($key !== false) {
            $this->store->set('user_info', $user_info);
        }

        $this->user_info = $user_info;

        return $this;
    }

    /**
     * Sets and persists $access_token.
     *
     * @param string $access_token
     *
     * @return Auth0SDK\BaseAuth0
     */
    public function setAccessToken($access_token) {
        $key = array_search('access_token',$this->persistantMap);
        if ($key !== false) {
            $this->store->set('access_token', $access_token);
        }

        $this->access_token = $access_token;

        return $this;
    }

    /**
     * Gets $access_token.
     *
     *
     * @return string
     */
    final public function getAccessToken() {
        if ($this->access_token === false) {
            $this->exchangeCode();
        }
        return $this->access_token;
    }

    /**
     * Logout (removes all persisten data)
     */
    final public function logout()
    {
        $this->deleteAllPersistentData();
        $this->access_token = NULL;
    }



    /**
     * Requests access token to Auth0 server, using authorization code.
     *
     * @param  string $code Authorization code
     *
     * @return string
     */
    final protected function getTokenFromCode($code) {
        $this->debugInfo("Code: ".$code);
        $auth_url = $this->generateUrl('token');

        $auth0_response = $this->oauth_client->getAccessToken($auth_url, "authorization_code", array(
            "code" => $code,
            "redirect_uri" => $this->redirect_uri
        ));

        $auth0_response = $auth0_response['result'];
        $this->debugInfo(json_encode($auth0_response));
        $access_token = (isset($auth0_response['access_token']))? $auth0_response['access_token'] : false;

        if (!$access_token) {
            throw new ApiException('Invalid access_token - Retry login.');
        }

        $this->oauth_client->setAccessToken($access_token);
        $this->oauth_client->setAccessTokenType(OAuth2\Client::ACCESS_TOKEN_BEARER);
        $this->setAccessToken($access_token);

        return $access_token;
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
        $base_domain = str_replace('{domain}', $this->domain, $base_domain);

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

    /**
     * If debug mode is set, sends $info to debugger Closure.
     *
     * @param  mixed $info  Info to debug. It will be converted to string.
     */
    public function debugInfo($info)
    {
        if ($this->debug_mode && (is_object($this->debugger) && ($this->debugger instanceof Closure))) {
            list(, $caller) = debug_backtrace(false);

            $caller_function = $caller['function'];
            $caller_class = $caller['class'];

            $this->debugger->__invoke($caller_class.'::'.$caller_function. ' > '.$info);
        }
    }



    /**
     * Deletes all persistent data, for every mapped key.
     */
    public function deleteAllPersistentData()
    {
        foreach ($this->persistantMap as $key) {
            $this->store->delete($key);
        }
    }

    // -------------------------------------------------------------------------------------------------------------- //
        /**
     * Sets $domain.
     *
     * @param string $domain
     *
     * @return Auth0SDK\BaseAuth0
     */
    final public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Gets $domain
     *
     * @return string
     */
    final public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Sets $client_id.
     *
     * @param string $client_id
     *
     * @return Auth0SDK\BaseAuth0
     */
    final public function setClientId($client_id)
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * Gets $client_id.
     *
     * @return string
     */
    final public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * Sets $client_secret.
     *
     * @param string $client_secret
     *
     * @return Auth0SDK\BaseAuth0
     */
    final public function setClientSecret($client_secret)
    {
        $this->client_secret = $client_secret;

        return $this;
    }

    /**
     * Gets $client_secret.
     *
     * @return string
     */
    final public function getClientSecret()
    {
        return $this->client_secret;
    }

    /**
     * Sets $redirect_uri.
     *
     * @param string $redirect_uri
     *
     * @return Auth0SDK\BaseAuth0
     */
    final public function setRedirectUri($redirect_uri)
    {
        $this->redirect_uri = $redirect_uri;

        return $this;
    }

    /**
     * Gets $redirect_uri.
     *
     * @return string
     */
    final public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    /**
     * Sets $debug_mode.
     *
     * @param boolean $debug_mode
     *
     * @return Auth0SDK\BaseAuth0
     */
    final public function setDebugMode($debug_mode)
    {
        $this->debug_mode = $debug_mode;

        return $this;
    }

    /**
     * Gets $debug_mode.
     *
     * @return boolean
     */
    final public function getDebugMode()
    {
        return $this->debug_mode;
    }

    /**
     * Sets $debugger.
     *
     * @param \Closure $debugger
     *
     * @return Auth0SDK\BaseAuth0
     */
    final public function setDebugger(Closure $debugger)
    {
        $this->debugger = $debugger;

        return $this;
    }

    /**
     * Gets $debugger.
     *
     * @return \Closure
     */
    final public function getDebugger()
    {
        return $this->debugger;
    }
}

/**
 * Represents all errors returned by the server
 *
 * @author Auth0
 */
class ApiException extends Exception { }

/**
 * Represents all errors generated by SDK itself.
 *
 * @author Auth0
 */
class CoreException extends Exception { }
