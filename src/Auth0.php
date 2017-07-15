<?php

namespace Auth0\SDK;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Store\EmptyStore;
use Auth0\SDK\Store\SessionStore;
use Auth0\SDK\Store\StoreInterface;

/**
 * This class provides access to Auth0 Platform.
 *
 * @author Auth0
 */
final class Auth0
{
    /**
     * Available keys to persist data.
     *
     * @var array
     */
    private $persistentMap = [
        'refresh_token',
        'access_token',
        'user',
        'id_token',
    ];

    /**
     * Auth0 Domain.
     *
     * @var string
     */
    private $domain;
    /**
     * Auth0 Client ID.
     *
     * @var string
     */
    private $clientId;
    /**
     * Auth0 Client Secret.
     *
     * @var string
     */
    private $clientSecret;
    /**
     * Response Mode.
     *
     * @var string
     */
    private $responseMode;
    /**
     * Response Type.
     *
     * @var string
     */
    private $responseType;
    /**
     * Audience.
     *
     * @var string
     */
    private $audience;
    /**
     * Scope.
     *
     * @var string
     */
    private $scope;
    /**
     * Auth0 Refresh Token.
     *
     * @var string
     */
    private $refreshToken;
    /**
     * @var string
     */
    private $idToken;
    /**
     * Redirect URI needed on OAuth2 requests.
     *
     * @var string
     */
    private $redirectUri;
    /**
     * Debug mode flag.
     *
     * @var bool
     */
    private $debugMode;
    /**
     * Debugger function.
     * Will be called only if $debug_mode is true.
     *
     * @var \Closure
     */
    private $debugger;
    /**
     * The access token retrieved after authorization.
     * NULL means that there is no authorization yet.
     *
     * @var string
     */
    private $accessToken;
    /**
     * Store.
     *
     * @var StoreInterface
     */
    private $store;
    /**
     * The user object.
     *
     * @var string
     */
    private $user;
    /**
     * Authentication Client.
     *
     * @var \Auth0\SDK\API\Authentication
     */
    private $authentication;

    /**
     * @param array $config {
     *
     *    @var string $domain                Required. Should match your Auth0 domain
     *    @var string $client_id             Required. The id of the application, you can get this in the auth0 console
     *    @var string $client_secret         Required. The application secret, same comment as above
     *    @var string $redirect_uri          Required. The uri of the auth callback, used as a security method
     *    @var string $response_mode         Optional. Default `query`
     *    @var string $response_mode         Optional. Default `code`
     *    @var string $persist_user          Optional. Indicates if you want to persist the user info, default true
     *    @var string $persist_access_token  Optional. Indicates if you want to persist the access token, default false
     *    @var string $persist_refresh_token Optional. Indicates if you want to persist the refresh token, default false
     *    @var string $persist_id_token      Optional. Indicates if you want to persist the id token, default false
     *    @var bool   $debug                 Optional. Default false
     *    @var mixed  $store                 Optional. Indicates how we store the persisting methods, default is session store,
     *                                         you can pass false to avoid storing it or a class that implements a store
     *                                         (get, set, delete). TODO: add a proper interface
     * }
     *
     * @throws CoreException If `domain` is not provided
     * @throws CoreException If `client_id` is not provided
     * @throws CoreException If `client_secret` is not provided
     * @throws CoreException If `redirect_uri` is not provided
     */
    public function __construct(array $config)
    {
        $requiredConfigNames = ['domain', 'client_id', 'client_secret', 'redirect_uri'];
        foreach ($requiredConfigNames as $name) {
            if (empty($config[$name])) {
                throw new CoreException(sprintf('Config name "%s" cannot be empty or missing. ', $name));
            }
        }

        $this->domain = $config['domain'];
        $this->clientId = $config['client_id'];
        $this->clientSecret = $config['client_secret'];
        $this->redirectUri = $config['redirect_uri'];

        $defaults = [
            'audience'              => null,
            'response_mode'         => 'query',
            'response_type'         => 'code',
            'scope'                 => null,
            'debug_mode'            => false,
            'persist_user'          => null,
            'persist_access_token'  => false,
            'persist_refresh_token' => false,
            'persist_id_token'      => false,
            'store'                 => null,
        ];

        $config = array_merge($defaults, $config);

        $this->audience = $config['audience'];
        $this->responseMode = $config['response_mode'];
        $this->responseType = $config['response_type'];
        $this->scope = $config['scope'];
        $this->debugMode = $config['debug_mode'];

        // User info is persisted unless said otherwise
        if (false === $config['persist_user']) {
            $this->dontPersist('user');
        }
        // Access token is not persisted unless said otherwise
        if (false === $config['persist_access_token']) {
            $this->dontPersist('access_token');
        }
        // Refresh token is not persisted unless said otherwise
        if (false === $config['persist_refresh_token']) {
            $this->dontPersist('refresh_token');
        }
        // Id token is not per persisted unless said otherwise
        if (false === $config['persist_id_token']) {
            $this->dontPersist('id_token');
        }

        if (null === $config['store']) {
            $this->setStore(new SessionStore());
        } elseif ($config['store'] === false) {
            $this->setStore(new EmptyStore());
        } else {
            $this->setStore($config['store']);
        }

        $this->authentication = new Authentication($this->domain, $this->clientId, $this->clientSecret);

        $this->user = $this->store->get('user');
        $this->accessToken = $this->store->get('access_token');
        $this->idToken = $this->store->get('id_token');
        $this->refreshToken = $this->store->get('refresh_token');
    }

    public function login($state = null, $connection = null)
    {
        $params = [];
        if ($this->audience) {
            $params['audience'] = $this->audience;
        }
        if ($this->scope) {
            $params['scope'] = $this->scope;
        }

        $params['response_mode'] = $this->responseMode;

        $url = $this->authentication->get_authorize_link($this->responseType, $this->redirectUri, $connection, $state, $params);

        header("Location: $url");
        exit;
    }

    public function getUser()
    {
        if ($this->user) {
            return $this->user;
        }
        $this->exchange();

        return $this->user;
    }

    public function getIdToken()
    {
        if ($this->idToken) {
            return $this->idToken;
        }
        $this->exchange();

        return $this->idToken;
    }

    public function getAccessToken()
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }
        $this->exchange();

        return $this->accessToken;
    }

    public function getRefreshToken()
    {
        if ($this->refreshToken) {
            return $this->refreshToken;
        }
        $this->exchange();

        return $this->refreshToken;
    }

    /**
     * Code exchange.
     *
     * @throws CoreException If there is an active session already
     */
    public function exchange()
    {
        $code = $this->getAuthorizationCode();
        if (!$code) {
            return false;
        }

        if ($this->user) {
            throw new CoreException('Can\'t initialize a new session while there is one active session already');
        }

        $response = $this->authentication->code_exchange($code, $this->redirectUri);

        $accessToken = (isset($response['access_token'])) ? $response['access_token'] : false;
        $refreshToken = (isset($response['refresh_token'])) ? $response['refresh_token'] : false;
        $idToken = (isset($response['id_token'])) ? $response['id_token'] : false;

        if (!$accessToken) {
            throw new ApiException('Invalid access_token - Retry login.');
        }

        $this->setAccessToken($accessToken);
        $this->setIdToken($idToken);
        $this->setRefreshToken($refreshToken);

        $user = $this->authentication->userinfo($accessToken);
        $this->setUser($user);

        return true;
    }

    public function setUser($user)
    {
        $key = array_search('user', $this->persistentMap);
        if ($key !== false) {
            $this->store->set('user', $user);
        }
        $this->user = $user;

        return $this;
    }

    /**
     * Sets and persists $access_token.
     *
     * @param string $accessToken
     *
     * @return self
     */
    public function setAccessToken($accessToken)
    {
        $key = array_search('access_token', $this->persistentMap);
        if ($key !== false) {
            $this->store->set('access_token', $accessToken);
        }
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Sets and persists $id_token.
     *
     * @param string $idToken
     *
     * @return self
     */
    public function setIdToken($idToken)
    {
        $key = array_search('id_token', $this->persistentMap);
        if ($key !== false) {
            $this->store->set('id_token', $idToken);
        }
        $this->idToken = $idToken;

        return $this;
    }

    /**
     * Sets and persists $refresh_token.
     *
     * @param string $refreshToken
     *
     * @return self
     */
    public function setRefreshToken($refreshToken)
    {
        $key = array_search('refresh_token', $this->persistentMap);
        if ($key !== false) {
            $this->store->set('refresh_token', $refreshToken);
        }
        $this->refreshToken = $refreshToken;

        return $this;
    }

    private function getAuthorizationCode()
    {
        if ($this->responseMode === 'query') {
            return isset($_GET['code']) ? $_GET['code'] : null;
        } elseif ($this->responseMode === 'form_post') {
            return isset($_POST['code']) ? $_POST['code'] : null;
        }
    }

    public function logout()
    {
        $this->deleteAllPersistentData();
        $this->accessToken = null;
        $this->user = null;
        $this->idToken = null;
        $this->refreshToken = null;
    }

    public function deleteAllPersistentData()
    {
        foreach ($this->persistentMap as $key) {
            $this->store->delete($key);
        }
    }

    /**
     * Removes $name from the persistentMap, thus not persisting it when we set the value.
     *
     * @param string $name The value to remove
     */
    private function dontPersist($name)
    {
        $key = array_search($name, $this->persistentMap);
        if ($key !== false) {
            unset($this->persistentMap[$key]);
        }
    }

    /**
     * @param StoreInterface $store
     *
     * @return self
     */
    public function setStore(StoreInterface $store)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * @param \Closure $debugger
     */
    public function setDebugger(\Closure $debugger)
    {
        $this->debugger = $debugger;
    }
}
