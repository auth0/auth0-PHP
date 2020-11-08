<?php
/**
 * Main entry point to the Auth0 SDK
 *
 * @package Auth0\SDK
 */

namespace Auth0\SDK;

use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\Cache\NoCacheHandler;
use Auth0\SDK\Helpers\JWKFetcher;
use Auth0\SDK\Helpers\PKCE;
use Auth0\SDK\Helpers\Tokens\IdTokenVerifier;
use Auth0\SDK\Helpers\Tokens\AsymmetricVerifier;
use Auth0\SDK\Helpers\Tokens\SymmetricVerifier;
use Auth0\SDK\Helpers\TransientStoreHandler;
use Auth0\SDK\Store\CookieStore;
use Auth0\SDK\Store\EmptyStore;
use Auth0\SDK\Store\SessionStore;
use Auth0\SDK\Store\StoreInterface;
use Auth0\SDK\API\Authentication;

use GuzzleHttp\Exception\RequestException;
use Psr\SimpleCache\CacheInterface;

/**
 * Class Auth0
 * Provides access to Auth0 authentication functionality.
 *
 * @package Auth0\SDK
 */
class Auth0
{
    const TRANSIENT_STATE_KEY = 'state';
    const TRANSIENT_NONCE_KEY = 'nonce';
    const TRANSIENT_CODE_VERIFIER_KEY = 'code_verifier';

    /**
     * Available keys to persist data.
     *
     * @var array
     */
    public $persistantMap = [
        'refresh_token',
        'access_token',
        'user',
        'id_token',
    ];

    /**
     * Auth0 Domain, found in Application settings
     *
     * @var string
     */
    protected $domain;

    /**
     * Auth0 Client ID, found in Application settings
     *
     * @var string
     */
    protected $clientId;

    /**
     * Auth0 Client Secret, found in Application settings
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * Response mode
     *
     * @var string
     */
    protected $responseMode;

    /**
     * Response type
     *
     * @var string
     */
    protected $responseType;

    /**
     * Audience for the API being used
     *
     * @var string
     */
    protected $audience;

    /**
     * Scope for ID tokens and /userinfo endpoint
     *
     * @var string
     */
    protected $scope = 'openid profile email';

    /**
     * Auth0 Refresh Token
     *
     * @var string
     */
    protected $refreshToken;

    /**
     * Redirect URI needed on OAuth2 requests, aka callback URL
     *
     * @var string
     */
    protected $redirectUri;

    /**
     * The access token retrieved after authorization.
     * NULL means that there is no authorization yet.
     *
     * @var string
     */
    protected $accessToken;

    /**
     * JWT for identity information
     *
     * @var string
     */
    protected $idToken;

    /**
     * Decoded version of the ID token
     *
     * @var array
     */
    protected $idTokenDecoded;

    /**
     * Storage engine for persistence
     *
     * @var StoreInterface
     */
    protected $store;

    /**
     * The user object provided by Auth0
     *
     * @var string
     */
    protected $user;

    /**
     * Authentication Client.
     *
     * @var \Auth0\SDK\API\Authentication
     */
    protected $authentication;

    /**
     * Configuration options for Guzzle HTTP client.
     *
     * @var array
     *
     * @see http://docs.guzzlephp.org/en/stable/request-options.html
     */
    protected $guzzleOptions;

    /**
     * Skip the /userinfo endpoint call and use the ID token.
     *
     * @var boolean
     */
    protected $skipUserinfo;

	/**
	 * Enable Authorization Code Flow with Proof Key for Code Exchange (PKCE)
	 *
	 * @var boolean
	 */
	protected $enablePkce;

    /**
     * Algorithm used for ID token validation.
     * Can be "HS256" or "RS256" only.
     *
     * @var string
     */
    protected $idTokenAlg;

    /**
     * Leeway for ID token validation.
     *
     * @var integer
     */
    protected $idTokenLeeway;

    /**
     * URI to the JWKS when accepting RS256 ID tokens.
     *
     * @var string
     */
    protected $jwksUri;

    /**
     * Maximum time allowed between authentication and ID token verification.
     *
     * @var integer
     */
    protected $maxAge;

    /**
     * Transient authorization storage used for state, nonce, and max_age.
     *
     * @var TransientStoreHandler
     */
    protected $transientHandler;

    /**
     * Cache Handler.
     *
     * @var CacheInterface
     */
    protected $cacheHandler;

    /**
     * BaseAuth0 Constructor.
     *
     * @param array $config - Required configuration options.
     *     - domain                 (String)  Required. Auth0 domain for your tenant
     *     - client_id              (String)  Required. Client ID found in the Application settings
     *     - redirect_uri           (String)  Required. Authentication callback URI
     *     - client_secret          (String)  Optional. Client Secret found in the Application settings
     *     - secret_base64_encoded  (Boolean) Optional. Client Secret base64 encoded (true) or not (false, default)
     *     - audience               (String)  Optional. API identifier to generate an access token
     *     - response_mode          (String)  Optional. Response mode from the authorization server
     *     - response_type          (String)  Optional. Response type from the authorization server
     *     - scope                  (String)  Optional. Scope for ID and access tokens.
     *     - guzzle_options         (Object)  Optional. Options passed to the Guzzle HTTP library
     *     - skip_userinfo          (Boolean) Optional. Use the ID token for user identity (true, default) or the
     *                                                  userinfo endpoint (false)
     *     - enable_pkce            (Boolean) Optional. Enable Authorization Code Flow with Proof Key for Code Exchange
     *     - max_age                (Integer) Optional. Maximum time allowed between authentication and callback
     *     - id_token_alg           (String)  Optional. ID token algorithm expected; RS256 (default) or HS256 only
     *     - id_token_leeway        (Integer) Optional. Leeway, in seconds, for ID token validation.
     *     - jwks_uri               (String)  Optional. URI to the JWKS when accepting RS256 ID tokens.
     *     - store                  (Mixed)   Optional. StorageInterface for identity and token persistence;
     *                                                  leave empty to default to SessionStore
     *     - transient_store        (Mixed)   Optional.  StorageInterface for transient auth data;
     *                                                  leave empty to default to CookieStore
     *     - cache_handler          (Mixed)   Optional. CacheInterface instance or false for none
     *     - persist_user           (Boolean) Optional. Persist the user info, default true
     *     - persist_access_token   (Boolean) Optional. Persist the access token, default false
     *     - persist_refresh_token  (Boolean) Optional. Persist the refresh token, default false
     *     - persist_id_token       (Boolean) Optional. Persist the ID token, default false
     *
     * @throws CoreException If `domain`, `client_id`, or `redirect_uri` is not provided.
     * @throws CoreException If `id_token_alg` is provided and is not supported.
     */
    public function __construct(array $config)
    {
        $this->domain = $config['domain'] ?? $_ENV['AUTH0_DOMAIN'] ?? null;
        if (empty($this->domain)) {
            throw new CoreException('Invalid domain');
        }

        $this->clientId = $config['client_id'] ?? $_ENV['AUTH0_CLIENT_ID'] ?? null;
        if (empty($this->clientId)) {
            throw new CoreException('Invalid client_id');
        }

        $this->redirectUri = $config['redirect_uri'] ?? $_ENV['AUTH0_REDIRECT_URI'] ?? null;
        if (empty($this->redirectUri)) {
            throw new CoreException('Invalid redirect_uri');
        }

        $this->clientSecret = $config['client_secret'] ?? null;
        if ($this->clientSecret && ($config['secret_base64_encoded'] ?? false)) {
            $this->clientSecret = self::urlSafeBase64Decode($this->clientSecret);
        }

        $this->audience      = $config['audience'] ?? null;
        $this->responseMode  = $config['response_mode'] ?? 'query';
        $this->responseType  = $config['response_type'] ?? 'code';
        $this->scope         = $config['scope'] ?? 'openid profile email';
        $this->guzzleOptions = $config['guzzle_options'] ?? [];
        $this->skipUserinfo  = $config['skip_userinfo'] ?? true;
        $this->enablePkce    = $config['enable_pkce'] ?? false;
        $this->maxAge        = $config['max_age'] ?? null;
        $this->idTokenLeeway = $config['id_token_leeway'] ?? null;
        $this->jwksUri       = $config['jwks_uri'] ?? 'https://'.$this->domain.'/.well-known/jwks.json';

        $this->idTokenAlg = $config['id_token_alg'] ?? 'RS256';
        if (! in_array( $this->idTokenAlg, ['HS256', 'RS256'] )) {
            throw new CoreException('Invalid id_token_alg; must be "HS256" or "RS256"');
        }

        // User info is persisted by default.
        if (isset($config['persist_user']) && false === $config['persist_user']) {
            $this->dontPersist('user');
        }

        // Access token is not persisted by default.
        if (! isset($config['persist_access_token']) || false === $config['persist_access_token']) {
            $this->dontPersist('access_token');
        }

        // Refresh token is not persisted by default.
        if (! isset($config['persist_refresh_token']) || false === $config['persist_refresh_token']) {
            $this->dontPersist('refresh_token');
        }

        // ID token is not persisted by default.
        if (! isset($config['persist_id_token']) || false === $config['persist_id_token']) {
            $this->dontPersist('id_token');
        }

        $this->store = $config['store'] ?? null;
        if (empty($this->persistantMap)) {
            // No need for storage, nothing to persist.
            $this->store = new EmptyStore();
        } else if (! $this->store instanceof StoreInterface) {
            // Need to have some kind of storage if user data needs to be persisted.
            $this->store = new SessionStore();
        }

        $transientStore = $config['transient_store'] ?? null;
        if (! $transientStore instanceof StoreInterface) {
            $transientStore = new CookieStore([
                // Use configuration option or class default.
                'legacy_samesite_none' => $config['legacy_samesite_none_cookie'] ?? null,
                'samesite' => 'form_post' === $this->responseMode ? 'None' : 'Lax',
            ]);
        }

        $this->transientHandler = new TransientStoreHandler( $transientStore );

        $this->cacheHandler = $config['cache_handler'] ?? null;
        if (! $this->cacheHandler instanceof CacheInterface) {
            $this->cacheHandler = new NoCacheHandler();
        }

        $this->authentication = new Authentication(
            $this->domain,
            $this->clientId,
            $this->clientSecret,
            $this->audience,
            $this->scope,
            $this->guzzleOptions
        );

        $this->user         = $this->store->get('user');
        $this->accessToken  = $this->store->get('access_token');
        $this->idToken      = $this->store->get('id_token');
        $this->refreshToken = $this->store->get('refresh_token');
    }

    /**
     * Redirect to the hosted login page for a specific client
     *
     * @param null  $state            - state value.
     * @param null  $connection       - connection to use.
     * @param array $additionalParams - additional, valid parameters.
     *
     * @return void
     *
     * @see \Auth0\SDK\API\Authentication::get_authorize_link()
     * @see https://auth0.com/docs/api/authentication#login
     */
    public function login($state = null, $connection = null, array $additionalParams = [])
    {
        $params = [];

        if ($state) {
            $params[self::TRANSIENT_STATE_KEY] = $state;
        }

        if ($connection) {
            $params['connection'] = $connection;
        }

        if (! empty($additionalParams) && is_array($additionalParams)) {
            $params = array_replace($params, $additionalParams);
        }

        $login_url = $this->getLoginUrl($params);

        header('Location: '.$login_url);
        exit;
    }

    /**
     * Build the login URL.
     *
     * @param array $params Array of authorize parameters to use.
     *
     * @return string
     */
    public function getLoginUrl(array $params = [])
    {
        $default_params = [
            'scope' => $this->scope,
            'audience' => $this->audience,
            'response_mode' => $this->responseMode,
            'response_type' => $this->responseType,
            'redirect_uri' => $this->redirectUri,
            'max_age' => $this->maxAge,
        ];

        $auth_params = array_replace( $default_params, $params );
        $auth_params = array_filter( $auth_params );

        if (empty( $auth_params[self::TRANSIENT_STATE_KEY] )) {
            // No state provided by application so generate, store, and send one.
            $auth_params[self::TRANSIENT_STATE_KEY] = $this->transientHandler->issue(self::TRANSIENT_STATE_KEY);
        } else {
            // Store the passed-in value.
            $this->transientHandler->store(self::TRANSIENT_STATE_KEY, $auth_params[self::TRANSIENT_STATE_KEY]);
        }

        // ID token nonce validation is required so auth params must include one.
        if (empty( $auth_params[self::TRANSIENT_NONCE_KEY] )) {
            $auth_params[self::TRANSIENT_NONCE_KEY] = $this->transientHandler->issue(self::TRANSIENT_NONCE_KEY);
        } else {
            $this->transientHandler->store(self::TRANSIENT_NONCE_KEY, $auth_params[self::TRANSIENT_NONCE_KEY]);
        }

        if ($this->enablePkce) {
            $codeVerifier = PKCE::generateCodeVerifier(128);
            $auth_params['code_challenge'] = PKCE::generateCodeChallenge($codeVerifier);
            // The PKCE spec defines two methods, S256 and plain, the former is
            // the only one supported by Auth0 since the latter is discouraged.
            $auth_params['code_challenge_method'] = 'S256';
            $this->transientHandler->store(self::TRANSIENT_CODE_VERIFIER_KEY, $codeVerifier);
        }

        if (isset($auth_params['max_age'])) {
            $this->transientHandler->store( 'max_age', $auth_params['max_age'] );
        }

        return $this->authentication->get_authorize_link(
            $auth_params['response_type'],
            $auth_params['redirect_uri'],
            null,
            null,
            $auth_params
        );
    }

    /**
     * Get userinfo from persisted session or from a code exchange
     *
     * @return array|null
     *
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
     */
    public function getUser()
    {
        if (! $this->user) {
            $this->exchange();
        }

        return $this->user;
    }

    /**
     * Get access token from persisted session or from a code exchange
     *
     * @return string|null
     *
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
     */
    public function getAccessToken()
    {
        if (! $this->accessToken) {
            $this->exchange();
        }

        return $this->accessToken;
    }

    /**
     * Get ID token from persisted session or from a code exchange
     *
     * @return string|null
     *
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
     */
    public function getIdToken()
    {
        if (! $this->idToken) {
            $this->exchange();
        }

        return $this->idToken;
    }

    /**
     * Get refresh token from persisted session or from a code exchange
     *
     * @return string|null
     *
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
     */
    public function getRefreshToken()
    {
        if (! $this->refreshToken) {
            $this->exchange();
        }

        return $this->refreshToken;
    }

    /**
     * Exchange authorization code for access, ID, and refresh tokens
     *
     * @throws CoreException If the state value is missing or invalid.
     * @throws CoreException If there is already an active session.
     * @throws ApiException If access token is missing from the response.
     * @throws RequestException If HTTP request fails (e.g. access token does not have userinfo scope).
     *
     * @return boolean
     *
     * @see https://auth0.com/docs/api-auth/tutorials/authorization-code-grant
     */
    public function exchange()
    {
        $code = $this->getAuthorizationCode();
        if (! $code) {
            return false;
        }

        $state = $this->getState();
        if (! $state || ! $this->transientHandler->verify(self::TRANSIENT_STATE_KEY, $state)) {
            throw new CoreException('Invalid state');
        }

        $code_verifier = null;
        if ($this->enablePkce) {
            $code_verifier = $this->transientHandler->getOnce(self::TRANSIENT_CODE_VERIFIER_KEY);
            if (!$code_verifier) {
                throw new CoreException('Missing code_verifier');
            }
        }

        if ($this->user) {
            throw new CoreException('Can\'t initialize a new session while there is one active session already');
        }

        $response = $this->authentication->code_exchange($code, $this->redirectUri, $code_verifier);

        if (empty($response['access_token'])) {
            throw new ApiException('Invalid access_token - Retry login.');
        }

        $this->setAccessToken($response['access_token']);

        if (isset($response['refresh_token'])) {
            $this->setRefreshToken($response['refresh_token']);
        }

        if (isset($response['id_token'])) {
            if (! $this->transientHandler->isset(self::TRANSIENT_NONCE_KEY)) {
                throw new InvalidTokenException('Nonce value not found in application store');
            }

            $this->setIdToken($response['id_token']);
        }

        if ($this->skipUserinfo) {
            $user = $this->idTokenDecoded;
        } else {
            $user = $this->authentication->userinfo($this->accessToken);
        }

        if ($user) {
            $this->setUser($user);
        }

        return true;
    }

    /**
     * Renews the access token and ID token using an existing refresh token.
     * Scope "offline_access" must be declared in order to obtain refresh token for later token renewal.
     *
     * @param array $options Options for the token endpoint request.
     *      - options.scope         Access token scope requested; optional.
     *
     * @throws CoreException If the Auth0 object does not have access token and refresh token
     * @throws ApiException If the Auth0 API did not renew access and ID token properly
     * @link   https://auth0.com/docs/tokens/refresh-token/current
     */
    public function renewTokens(array $options = [])
    {
        if (! $this->refreshToken) {
            throw new CoreException('Can\'t renew the access token if there isn\'t a refresh token available');
        }

        $response = $this->authentication->refresh_token( $this->refreshToken, $options );

        if (empty($response['access_token'])) {
            throw new ApiException('Token did not refresh correctly. Access token not returned.');
        }

        $this->setAccessToken($response['access_token']);

        if (isset($response['id_token'])) {
            $this->setIdToken($response['id_token']);
        }
    }

    /**
     * Set the user property to a userinfo array and, if configured, persist
     *
     * @param array $user - userinfo from Auth0.
     *
     * @return $this
     */
    public function setUser(array $user)
    {
        if (in_array('user', $this->persistantMap)) {
            $this->store->set('user', $user);
        }

        $this->user = $user;
        return $this;
    }

    /**
     * Sets and persists the access token.
     *
     * @param string $accessToken - access token returned from the code exchange.
     *
     * @return \Auth0\SDK\Auth0
     */
    public function setAccessToken($accessToken)
    {
        if (in_array('access_token', $this->persistantMap)) {
            $this->store->set('access_token', $accessToken);
        }

        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * Sets, validates, and persists the ID token.
     *
     * @param string $idToken - ID token returned from the code exchange.
     *
     * @return \Auth0\SDK\Auth0
     *
     * @throws CoreException
     * @throws InvalidTokenException
     */
    public function setIdToken($idToken)
    {
        $this->idTokenDecoded = $this->decodeIdToken($idToken);

        if (in_array('id_token', $this->persistantMap)) {
            $this->store->set('id_token', $idToken);
        }

        $this->idToken = $idToken;
        return $this;
    }

    /**
     * Verifies and decodes an ID token using the properties in this class.
     *
     * @param string $idToken         ID token to verify and decode.
     * @param array  $verifierOptions Options passed to verifier.
     *
     * @return array
     *
     * @throws InvalidTokenException
     */
    public function decodeIdToken(string $idToken, array $verifierOptions = []) : array
    {
        $idTokenIss  = 'https://'.$this->domain.'/';
        $sigVerifier = null;
        if ('RS256' === $this->idTokenAlg) {
            $jwksHttpOptions = array_merge( $this->guzzleOptions, [ 'base_uri' => $this->jwksUri ] );
            $jwksFetcher     = new JWKFetcher($this->cacheHandler, $jwksHttpOptions);
            $sigVerifier     = new AsymmetricVerifier($jwksFetcher);
        } else if ('HS256' === $this->idTokenAlg) {
            $sigVerifier = new SymmetricVerifier($this->clientSecret);
        }

        $verifierOptions = $verifierOptions + [
            'leeway' => $this->idTokenLeeway,
            'max_age' => $this->transientHandler->getOnce('max_age') ?? $this->maxAge,
            self::TRANSIENT_NONCE_KEY => $this->transientHandler->getOnce(self::TRANSIENT_NONCE_KEY)
        ];

        $idTokenVerifier = new IdTokenVerifier($idTokenIss, $this->clientId, $sigVerifier);
        return $idTokenVerifier->verify($idToken, $verifierOptions);
    }

    /**
     * Sets and persists the refresh token.
     *
     * @param string $refreshToken - refresh token returned from the code exchange.
     *
     * @return \Auth0\SDK\Auth0
     */
    public function setRefreshToken($refreshToken)
    {
        if (in_array('refresh_token', $this->persistantMap)) {
            $this->store->set('refresh_token', $refreshToken);
        }

        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * Get the authorization code from POST or GET, depending on response_mode
     *
     * @return string|null
     *
     * @see https://auth0.com/docs/api-auth/tutorials/authorization-code-grant
     */
    protected function getAuthorizationCode()
    {
        $code = null;
        if ($this->responseMode === 'query' && isset($_GET['code'])) {
            $code = $_GET['code'];
        } else if ($this->responseMode === 'form_post' && isset($_POST['code'])) {
            $code = $_POST['code'];
        }

        return $code;
    }

    /**
     * Get the state from POST or GET, depending on response_mode
     *
     * @return string|null
     *
     * @see https://auth0.com/docs/api-auth/tutorials/authorization-code-grant
     */
    protected function getState()
    {
        $state = null;
        if ($this->responseMode === 'query' && isset($_GET[self::TRANSIENT_STATE_KEY])) {
            $state = $_GET[self::TRANSIENT_STATE_KEY];
        } else if ($this->responseMode === 'form_post' && isset($_POST[self::TRANSIENT_STATE_KEY])) {
            $state = $_POST[self::TRANSIENT_STATE_KEY];
        }

        return $state;
    }

    /**
     * Delete any persistent data and clear out all stored properties
     *
     * @return void
     */
    public function logout()
    {
        $this->deleteAllPersistentData();
        $this->accessToken  = null;
        $this->user         = null;
        $this->idToken      = null;
        $this->refreshToken = null;
    }

    /**
     * Delete all persisted data
     *
     * @return void
     */
    public function deleteAllPersistentData()
    {
        foreach ($this->persistantMap as $key) {
            $this->store->delete($key);
        }
    }

    /**
     * Removes $name from the persistantMap, thus not persisting it when we set the value.
     *
     * @param string $name - value to remove from persistence.
     *
     * @return void
     */
    private function dontPersist($name)
    {
        $key = array_search($name, $this->persistantMap);
        if ($key !== false) {
            unset($this->persistantMap[$key]);
        }
    }

    /**
     * Set the storage engine that implements StoreInterface
     *
     * @param StoreInterface $store - storage engine to use.
     *
     * @return \Auth0\SDK\Auth0
     */
    public function setStore(StoreInterface $store)
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @param integer $length
     *
     * @return string
     */
    public static function getNonce(int $length = 16) : string
    {
        try {
            $random_bytes = random_bytes($length);
        } catch (\Exception $e) {
            $random_bytes = openssl_random_pseudo_bytes($length);
        }

        return bin2hex($random_bytes);
    }

    /**
     * Decode a URL-safe base64-encoded string.
     *
     * @param string $input Base64 encoded string to decode.
     *
     * @return string
     */
    public static function urlSafeBase64Decode(string $input) : string
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $input .= str_repeat('=', 4 - $remainder);
        }

        $input = strtr($input, '-_', '+/');
        return base64_decode($input);
    }
}
