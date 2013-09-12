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

use \Exception;

/**
 * This class provides access to Auth0 Platform.
 * 
 * @author Sergio Daniel Lepore
 * @todo Logout, getUserInfo and other useful proxies. See <https://app.auth0.com/#/sdk/api> 
 *       and <https://docs.auth0.com/api-reference>
 */
abstract class BaseAuth0
{
    /**
     * SDK Version.
     */
    const VERSION = "0.5.2"; // Not ready for production yet :(

    /**
     * SDK Codename.
     */
    const CODENAME = "Abyssinian"; // Yup, a cat breed :)

    /**
     * CURL Options.
     * 
     * @var array
     */
    public static $CURL_OPTS = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_USERAGENT      => 'auth0-php-abyssinian',
    );

    /**
     * HTTP Methods for CURL.
     * 
     * @var array
     */
    public static $CURL_METHOD_MAP = array(
        'POST' => array(CURLOPT_POST, true),
        'PUT' => array(CURLOPT_PUT, true),
        'DELETE' => array(CURLOPT_CUSTOMREQUEST, 'DELETE'),
    );

    /**
     * Available keys to persist data.
     * 
     * @var array
     */
    public static $PERSISTANCE_MAP = array(
        'token_type',
        'access_token'
    );

    /**
     * Auth0 URL Map.
     * 
     * @var array
     */
    public static $URL_MAP = array(
        'api'           => 'https://{domain}/api',
        'authorization' => 'https://{domain}/authorize',
        'token'         => 'https://{domain}/oauth/token',
        'user_info'     => 'https://{domain}/userInfo',
    );

    /**
     * Debug mode flag.
     * 
     * @var Boolean
     */
    protected $debug_mode;

    /**
     * Base domain.
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
     * Auth0 Access Type
     * 
     * @var string
     */
    protected $access_type;

    /**
     * Auth0 Grant Type
     * 
     * @var string
     */
    protected $grant_type;

    /**
     * The access token retrieved after authorization.
     * NULL means that there is no authorization yet.
     * 
     * @var string
     */
    protected $access_token;

    protected $token_type;

    /**
     * BaseAuth0 Constructor.
     *
     * Configuration:
     *     - domain (String)
     *     - debug (Boolean)
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
        if (isset($config['domain'])) {
            $this->domain = $config['domain'];
        } else {
            throw new CoreException('Invalid domain');
        }

        if (isset($config['debug'])) {
            $this->debug_mode = $config['debug'];
        }

        $this->access_type  = 'web_server';
        $this->grant_type   = 'client_credentials';
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

    final public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    final public function getDomain()
    {
        return $this->domain;
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

    final public function getAccessType()
    {
        return $this->access_type;
    }

    final public function getGrantType()
    {
        return $this->grant_type;
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
        }

        return $this->access_token;
    }

    final public function setTokenType($token_type)
    {
        $this->setPersistentData('token_type', $token_type);
        $this->token_type = $token_type;

        return $this;
    }

    final public function getTokenType()
    {
        if (!$this->token_type) {
            $this->token_type = $this->getPersistentData('token_type');
        }

        return $this->token_type;
    }



    final public function login($client_id, $client_secret)
    {
        $this->client_id     = $client_id;
        $this->client_secret = $client_secret;

        $post_params = array(
            'client_id'         => $client_id,
            'client_secret'     => $client_secret,
            'type'              => $this->access_type,
            'grant_type'        => $this->grant_type,
            'auth0_domain_key'  => 'token'
        );

        $response = $this->api('/', 'POST', $post_params);

        if (!isset($response['access_token']) || !isset($response['token_type'])) {
            throw new ApiException('Error');
        }

        $this->setAccessToken($response['access_token']);
        $this->setTokenType($response['token_type']);

        return $this->access_token;
    }


    final public function api($path, $method = 'GET', array $params = array())
    {
        if (is_array($method) && !$params) {
            $params = $method;
            $method = 'GET';
        }

        if (isset($params['auth0_domain_key'])) {
            $domain_key = $params['auth0_domain_key'];

            unset($params['auth0_domain_key']);
        } else {
            $domain_key = 'api';
        }

        $url = $this->generateUrl($domain_key, $path);

        $response = json_decode($this->makeRequest(
            $url,
            $method,
            $params
        ), true);

        return $response;
    }

    
    final protected function makeRequest($url, $method, array $params = array())
    {
        $data_type = 'json';
        $ch = curl_init();

        $opts = self::$CURL_OPTS;
        $query_params = http_build_query($params);
        
        if ($method == 'POST') {
            $opts[CURLOPT_POSTFIELDS] = $query_params;
        } else {
            $url .= '?' . $query_params;
        }

        $opts[CURLOPT_URL] = $url;

        if ($method != 'GET') {
            if (!array_key_exists($method, self::$CURL_METHOD_MAP)) {
                throw new CoreException(sprintf('Method %s not allowed', $method));        
            }

            $method_array = self::$CURL_METHOD_MAP[$method];

            $opts[$method_array[0]] = $method_array[1];
        }

        curl_setopt_array($ch, $opts);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }


    final protected function generateUrl($domain_key, $path = '/')
    {
        $base_domain = self::$URL_MAP[$domain_key];
        $base_domain = str_replace('{domain}', $this->domain, $base_domain);

        if ($path[0] == '/') {
            $path = substr($path, 1);
        }

        return $base_domain.$path;
    }


    public function deleteAllPersistentData()
    {
        foreach (self::$PERSISTANCE_MAP as $key) {
            $this->deletePersistentData($key);
        }
    }


    /**
     * Checks for all dependencies of SDK or API.
     *
     * @throws CoreException If CURL extension is not found.
     * @throws CoreException If JSON extension is not found.
     * 
     * @return void
     */
    public function checkRequirements() 
    {
        if (!function_exists('curl_version')) {
            throw new CoreException('CURL extension is needed to use Auth0 SDK. Not found.');
        }

        if (!function_exists('json_decode')) {
            throw new CoreException('JSON extension is needed to use Auth0 SDK. Not found.');
        }
    }


    abstract protected function setPersistentData($key, $value);

    abstract protected function getPersistentData($key);

    abstract protected function deletePersistentData($key);
}

class ApiException extends Exception { }

class CoreException extends Exception { }