<?php

declare(strict_types=1);

namespace Auth0\SDK;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Helpers\PKCE;
use Auth0\SDK\Helpers\TransientStoreHandler;
use Auth0\SDK\Store\CookieStore;
use Auth0\SDK\Store\EmptyStore;
use Auth0\SDK\Store\SessionStore;
use Psr\SimpleCache\CacheInterface;

/**
 * Class Auth0
 * Provides access to Auth0 authentication functionality.
 */
class Auth0
{
    /**
     * Available keys to persist data.
     */
    protected array $persistentMap = [
        'refresh_token',
        'access_token',
        'user',
        'id_token',
    ];

    /**
     * Auth0 Domain, found in Application settings
     */
    protected ?string $domain = null;

    /**
     * Auth0 Client ID, found in Application settings
     */
    protected ?string $clientId = null;

    /**
     * Auth0 Client Secret, found in Application settings
     */
    protected ?string $clientSecret = null;

    /**
     * Response mode
     */
    protected string $responseMode;

    /**
     * Response type
     */
    protected string $responseType;

    /**
     * Audience for the API being used
     */
    protected ?string $audience = null;

    /**
     * Auth0 Organization ID, found in your Organization settings.
     * Used for generating log in urls and validating token claims.
     */
    protected ?string $organization = null;

    /**
     * Scope for ID tokens and /userinfo endpoint
     */
    protected string $scope = 'openid profile email';

    /**
     * Auth0 Refresh Token
     */
    protected ?string $refreshToken = null;

    /**
     * Redirect URI needed on OAuth2 requests, aka callback URL
     */
    protected ?string $redirectUri = null;

    /**
     * The access token retrieved after authorization.
     */
    protected ?string $accessToken = null;

    /**
     * JWT for identity information
     */
    protected ?string $idToken = null;

    /**
     * Decoded version of the ID token
     */
    protected ?array $idTokenDecoded = null;

    /**
     * Storage engine for persistence
     */
    protected StoreInterface $store;

    /**
     * The user object provided by Auth0
     */
    protected ?array $user;

    /**
     * Authentication Client.
     */
    protected \Auth0\SDK\API\Authentication $authentication;

    /**
     * Configuration options for Guzzle HTTP client.
     *
     * @see http://docs.guzzlephp.org/en/stable/request-options.html
     */
    protected array $guzzleOptions;

    /**
     * Skip the /userinfo endpoint call and use the ID token.
     */
    protected bool $skipUserinfo;

    /**
     * Enable Authorization Code Flow with Proof Key for Code Exchange (PKCE)
     */
    protected bool $enablePkce;

    /**
     * Algorithm used for ID token validation.
     * Can be "HS256" or "RS256" only.
     */
    protected string $idTokenAlg;

    /**
     * Leeway for ID token validation.
     */
    protected ?int $idTokenLeeway = null;

    /**
     * URI to the JWKS when accepting RS256 ID tokens.
     */
    protected string $jwksUri;

    /**
     * Maximum time allowed between authentication and ID token verification.
     */
    protected ?int $maxAge = null;

    /**
     * Transient authorization storage used for state, nonce, and max_age.
     */
    protected TransientStoreHandler $transientHandler;

    /**
     * Cache Handler.
     */
    protected ?CacheInterface $cacheHandler = null;

    /**
     * Maximum time allowed between authentication and ID token verification.
     */
    protected ?int $cacheTtl = null;

    /**
     * BaseAuth0 Constructor.
     *
     * @param array $config Required. Configuration options.
     *                      - domain                 (String)  Required. Auth0 domain for your tenant
     *                      - client_id              (String)  Required. Client ID found in the Application settings
     *                      - redirect_uri           (String)  Required. Authentication callback URI
     *                      - client_secret          (String)  Optional. Client Secret found in the Application settings
     *                      - audience               (String)  Optional. API identifier to generate an access token
     *                      - organization           (String)  Optional. ID of the Organization, if used. Found in your Organization settings.
     *                      - response_mode          (String)  Optional. Response mode from the authorization server
     *                      - response_type          (String)  Optional. Response type from the authorization server
     *                      - scope                  (String)  Optional. Scope for ID and access tokens.
     *                      - guzzle_options         (Object)  Optional. Options passed to the Guzzle HTTP library
     *                      - skip_userinfo          (Boolean) Optional. Use the ID token for user identity (true, default) or the userinfo endpoint (false)
     *                      - enable_pkce            (Boolean) Optional. Enable Authorization Code Flow with Proof Key for Code Exchange
     *                      - max_age                (Integer) Optional. Maximum time allowed between authentication and callback
     *                      - id_token_alg           (String)  Optional. ID token algorithm expected; RS256 (default) or HS256 only
     *                      - id_token_leeway        (Integer) Optional. Leeway, in seconds, for ID token validation.
     *                      - jwks_uri               (String)  Optional. URI to the JWKS when accepting RS256 ID tokens.
     *                      - store                  (Mixed)   Optional. StorageInterface for identity and token persistence; leave empty to default to SessionStore
     *                      - transient_store        (Mixed)   Optional. StorageInterface for transient auth data; leave empty to default to CookieStore
     *                      - cache_handler          (Mixed)   Optional. CacheInterface instance or false for none
     *                      - persist_user           (Boolean) Optional. Persist the user info, default true
     *                      - persist_access_token   (Boolean) Optional. Persist the access token, default false
     *                      - persist_refresh_token  (Boolean) Optional. Persist the refresh token, default false
     *                      - persist_id_token       (Boolean) Optional. Persist the ID token, default false
     *
     * @throws CoreException If `domain`, `client_id`, or `redirect_uri` is not provided.
     * @throws CoreException If `id_token_alg` is provided and is not supported.
     */
    public function __construct(
        array $config
    ) {
        $this->domain = $config['domain'] ?? $_ENV['AUTH0_DOMAIN'] ?? null;
        $this->clientId = $config['client_id'] ?? $_ENV['AUTH0_CLIENT_ID'] ?? null;
        $this->redirectUri = $config['redirect_uri'] ?? $_ENV['AUTH0_REDIRECT_URI'] ?? null;
        $this->clientSecret = $config['client_secret'] ?? $_ENV['AUTH0_CLIENT_SECRET'] ?? null;
        $this->organization = $config['organization'] ?? $_ENV['AUTH0_ORGANIZATION'] ?? null;
        $this->audience = $config['audience'] ?? $_ENV['AUTH0_AUDIENCE'] ?? null;
        $this->responseMode = $config['response_mode'] ?? 'query';
        $this->responseType = $config['response_type'] ?? 'code';
        $this->scope = $config['scope'] ?? 'openid profile email';
        $this->guzzleOptions = $config['guzzle_options'] ?? [];
        $this->skipUserinfo = $config['skip_userinfo'] ?? true;
        $this->enablePkce = $config['enable_pkce'] ?? false;
        $this->jwksUri = $config['jwks_uri'] ?? 'https://' . $this->domain . '/.well-known/jwks.json';
        $this->idTokenAlg = $config['id_token_alg'] ?? 'RS256';

        if ($this->domain === null) {
            throw new \Auth0\SDK\Exception\CoreException('Invalid domain');
        }

        if ($this->clientId === null) {
            throw new \Auth0\SDK\Exception\CoreException('Invalid client_id');
        }

        if ($this->redirectUri === null) {
            throw new \Auth0\SDK\Exception\CoreException('Invalid redirect_uri');
        }

        if (! in_array($this->idTokenAlg, ['HS256', 'RS256'])) {
            throw new \Auth0\SDK\Exception\CoreException('Invalid id_token_alg; must be "HS256" or "RS256"');
        }

        if (isset($config['max_age'])) {
            if (is_int($config['max_age'])) {
                // Max age was passed as an int, perfect.
                $this->maxAge = $config['max_age'];
            } elseif (! is_int($config['max_age']) && is_numeric($config['max_age'])) {
                // Max age was passed as a string, but it is numeric so cast to int.
                $this->maxAge = (int) $config['max_age'];
            }
        }

        if (isset($config['id_token_leeway'])) {
            if (is_int($config['id_token_leeway'])) {
                // Leeway was passed as an int, perfect.
                $this->idTokenLeeway = $config['id_token_leeway'];
            } elseif (! is_int($config['id_token_leeway']) && is_numeric($config['id_token_leeway'])) {
                // Leeway was passed as a string, but it is numeric so cast to int.
                $this->idTokenLeeway = (int) $config['id_token_leeway'];
            }
        }

        // User info is persisted by default.
        if (isset($config['persist_user']) && $config['persist_user'] === false) {
            $this->doNotPersist('user');
        }

        // Access token is not persisted by default.
        if (! isset($config['persist_access_token']) || $config['persist_access_token'] === false) {
            $this->doNotPersist('access_token');
        }

        // Refresh token is not persisted by default.
        if (! isset($config['persist_refresh_token']) || $config['persist_refresh_token'] === false) {
            $this->doNotPersist('refresh_token');
        }

        // ID token is not persisted by default.
        if (! isset($config['persist_id_token']) || $config['persist_id_token'] === false) {
            $this->doNotPersist('id_token');
        }

        if (! count($this->persistentMap)) {
            // No need for storage, nothing to persist.
            $this->store = new EmptyStore();
        } else {
            if (isset($config['store']) && $config['store'] instanceof StoreInterface) {
                $this->store = $config['store'];
            } else {
                // Need to have some kind of storage if user data needs to be persisted.
                $this->store = new SessionStore();
            }
        }

        if (! isset($config['transient_store']) || ! $config['transient_store'] instanceof StoreInterface) {
            $config['transient_store'] = new CookieStore(
                [
                    // Use configuration option or class default.
                    'legacy_samesite_none' => $config['legacy_samesite_none_cookie'] ?? null,
                    'samesite' => $this->responseMode === 'form_post' ? 'None' : 'Lax',
                ]
            );
        }
        $this->transientHandler = new TransientStoreHandler($config['transient_store']);

        if (isset($config['cache_handler']) && $config['cache_handler'] instanceof CacheInterface) {
            $this->cacheHandler = $config['cache_handler'];
        }

        $this->authentication = new Authentication(
            $this->domain,
            $this->clientId,
            $this->clientSecret,
            $this->audience,
            $this->scope,
            $this->guzzleOptions,
            $this->organization
        );

        $this->user = $this->store->get('user');
        $this->accessToken = $this->store->get('access_token');
        $this->idToken = $this->store->get('id_token');
        $this->refreshToken = $this->store->get('refresh_token');
    }

    /**
     * Redirect to the hosted login page for a specific client
     *
     * @param string $state            State value.
     * @param string $connection       Connection to use.
     * @param array  $additionalParams Additional, valid parameters.
     *
     * @see \Auth0\SDK\API\Authentication::getAuthorizationLink()
     * @see https://auth0.com/docs/api/authentication#login
     */
    public function login(
        ?string $state = null,
        ?string $connection = null,
        array $additionalParams = []
    ): void {
        $params = [];

        if ($state) {
            $params['state'] = $state;
        }

        if ($connection) {
            $params['connection'] = $connection;
        }

        if (count($additionalParams)) {
            $params = array_replace($params, $additionalParams);
        }

        $login_url = $this->getLoginUrl($params);

        header('Location: ' . $login_url);
        exit;
    }

    /**
     * Build the login URL.
     *
     * @param array $params Array of authorize parameters to use.
     */
    public function getLoginUrl(
        array $params = []
    ): string {
        $default_params = [
            'scope' => $this->scope,
            'audience' => $this->audience,
            'response_mode' => $this->responseMode,
            'response_type' => $this->responseType,
            'redirect_uri' => $this->redirectUri,
            'max_age' => $this->maxAge,
        ];

        $auth_params = array_replace($default_params, $params);
        $auth_params = array_filter($auth_params);

        if (! isset($auth_params['state'])) {
            // No state provided by application so generate, store, and send one.
            $auth_params['state'] = $this->transientHandler->issue('state');
        } else {
            // Store the passed-in value.
            $this->transientHandler->store('state', $auth_params['state']);
        }

        // ID token nonce validation is required so auth params must include one.
        if (! isset($auth_params['nonce'])) {
            $auth_params['nonce'] = $this->transientHandler->issue('nonce');
        } else {
            $this->transientHandler->store('nonce', $auth_params['nonce']);
        }

        if ($this->enablePkce) {
            $codeVerifier = PKCE::generateCodeVerifier(128);
            $auth_params['code_challenge'] = PKCE::generateCodeChallenge($codeVerifier);
            // The PKCE spec defines two methods, S256 and plain, the former is
            // the only one supported by Auth0 since the latter is discouraged.
            $auth_params['code_challenge_method'] = 'S256';
            $this->transientHandler->store('code_verifier', $codeVerifier);
        }

        if (isset($auth_params['max_age'])) {
            $this->transientHandler->store('max_age', (string) $auth_params['max_age']);
        }

        return $this->authentication->getAuthorizationLink(
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
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
     */
    public function getUser(): ?array
    {
        if (! $this->user) {
            $this->exchange();
        }

        return $this->user;
    }

    /**
     * Get access token from persisted session or from a code exchange
     *
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
     */
    public function getAccessToken(): ?string
    {
        if (! $this->accessToken) {
            $this->exchange();
        }

        return $this->accessToken;
    }

    /**
     * Get ID token from persisted session or from a code exchange
     *
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
     */
    public function getIdToken(): ?string
    {
        if (! $this->idToken) {
            $this->exchange();
        }

        return $this->idToken;
    }

    /**
     * Get refresh token from persisted session or from a code exchange
     *
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
     */
    public function getRefreshToken(): ?string
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
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @see https://auth0.com/docs/api-auth/tutorials/authorization-code-grant
     */
    public function exchange(): bool
    {
        $code = $this->getAuthorizationCode();
        if (! $code) {
            return false;
        }

        $state = $this->getState();
        if (! $state || ! $this->transientHandler->verify('state', $state)) {
            throw new \Auth0\SDK\Exception\CoreException('Invalid state');
        }

        $code_verifier = null;
        if ($this->enablePkce) {
            $code_verifier = $this->transientHandler->getOnce('code_verifier');
            if (! $code_verifier) {
                throw new \Auth0\SDK\Exception\CoreException('Missing code_verifier');
            }
        }

        if ($this->user) {
            throw new \Auth0\SDK\Exception\CoreException('Can\'t initialize a new session while there is one active session already');
        }

        $response = $this->authentication->codeExchange($code, $this->redirectUri, $code_verifier);

        if (! isset($response['access_token']) || ! $response['access_token']) {
            throw new \Auth0\SDK\Exception\ApiException('Invalid access_token - Retry login.');
        }

        $this->setAccessToken($response['access_token']);

        if (isset($response['refresh_token'])) {
            $this->setRefreshToken($response['refresh_token']);
        }

        if (isset($response['id_token'])) {
            if (! $this->transientHandler->isset('nonce')) {
                throw new \Auth0\SDK\Exception\InvalidTokenException('Nonce value not found in application store');
            }

            $this->setIdToken($response['id_token']);
        }

        if ($this->skipUserinfo) {
            $user = $this->idTokenDecoded;
        } else {
            $user = $this->authentication->userInfo($this->accessToken);
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
     *                       - options.scope         Access token scope requested; optional.
     *
     * @throws CoreException If the Auth0 object does not have access token and refresh token
     * @throws ApiException If the Auth0 API did not renew access and ID token properly
     *
     * @link   https://auth0.com/docs/tokens/refresh-token/current
     */
    public function renewTokens(
        array $options = []
    ): void {
        if (! $this->refreshToken) {
            throw new \Auth0\SDK\Exception\CoreException('Can\'t renew the access token if there isn\'t a refresh token available');
        }

        $response = $this->authentication->refreshToken($this->refreshToken, $options);

        if (! isset($response['access_token']) || ! $response['access_token']) {
            throw new \Auth0\SDK\Exception\ApiException('Token did not refresh correctly. Access token not returned.');
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
     */
    public function setUser(
        array $user
    ): self {
        if (in_array('user', $this->persistentMap)) {
            $this->store->set('user', $user);
        }

        $this->user = $user;
        return $this;
    }

    /**
     * Sets and persists the access token.
     *
     * @param string $accessToken - access token returned from the code exchange.
     */
    public function setAccessToken(
        string $accessToken
    ): self {
        if (in_array('access_token', $this->persistentMap)) {
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
     * @throws CoreException
     * @throws InvalidTokenException
     */
    public function setIdToken(
        string $idToken
    ): self {
        $this->idTokenDecoded = $this->decode($idToken);

        if (in_array('id_token', $this->persistentMap)) {
            $this->store->set('id_token', $idToken);
        }

        $this->idToken = $idToken;
        return $this;
    }

    /**
     * Verifies and decodes an ID token using the properties in this class.
     *
     * @param string $token ID token to verify and decode.
     * @param array $options Additional configuration options to pass during Token processing.
     *
     * @throws InvalidTokenException
     */
    public function decode(
        string $token,
        array $options = []
    ): array {
        $token = new Token($token);

        $token->verify($this->idTokenAlg, $this->jwksUri, $this->clientSecret, $this->cacheTtl, $this->cacheHandler);

        $maxAge = $options['max_age'] ?? $this->maxAge ?? $this->transientHandler->getOnce('max_age') ?? null;
        $nonce = $options['nonce'] ?? $this->transientHandler->getOnce('nonce') ?? null;
        $organization = $options['org_id'] ?? $this->organization ?? null;

        if ($maxAge !== null && ! is_int($maxAge)) {
            if (is_numeric($maxAge)) {
                $maxAge = (int) $maxAge;
            } else {
                $maxAge = null;
            }
        }

        if ($nonce !== null && strlen($nonce) === 0) {
            $nonce = null;
        }

        if ($organization !== null) {
            if (! is_array($organization)) {
                $organization = [ $organization ];
            }
        }

        $token->validate(
            'https://' . $this->domain . '/',
            [$this->clientId],
            $organization,
            $nonce,
            $maxAge,
            $this->idTokenLeeway
        );

        return $token->toArray();
    }

    /**
     * Sets and persists the refresh token.
     *
     * @param string $refreshToken - refresh token returned from the code exchange.
     */
    public function setRefreshToken(
        string $refreshToken
    ): self {
        if (in_array('refresh_token', $this->persistentMap)) {
            $this->store->set('refresh_token', $refreshToken);
        }

        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * Get the state from POST or GET, depending on response_mode
     *
     * @see https://auth0.com/docs/api-auth/tutorials/authorization-code-grant
     */
    public function getState(): ?string
    {
        $state = null;
        if ($this->responseMode === 'query' && isset($_GET['state'])) {
            $state = $_GET['state'];
        } elseif ($this->responseMode === 'form_post' && isset($_POST['state'])) {
            $state = $_POST['state'];
        }

        return $state;
    }

    /**
     * If invitation parameters are present in the request, handle extraction and automatically redirect to Universal Login.
     */
    public function handleInvitation(): void
    {
        $invite = $this->getInvitationParameters();

        if ($invite) {
            $this->login(
                null,
                null,
                [
                    'invitation' => $invite->invitation,
                    'organization' => $invite->organization,
                ]
            );
        }
    }

    /**
     * Get the invitation details GET request
     */
    public function getInvitationParameters(): ?object
    {
        $invite = null;
        $orgId = null;
        $orgName = null;

        if ($this->responseMode === 'query') {
            $invite = (isset($_GET['invitation']) ? filter_var($_GET['invitation'], FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE) : null);
            $orgId = (isset($_GET['organization']) ? filter_var($_GET['organization'], FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE) : null);
            $orgName = (isset($_GET['organization_name']) ? filter_var($_GET['organization_name'], FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE) : null);
        }

        if ($invite && $orgId && $orgName) {
            return (object) [
                'invitation' => $invite,
                'organization' => $orgId,
                'organizationName' => $orgName,
            ];
        }

        return null;
    }

    /**
     * Delete any persistent data and clear out all stored properties
     */
    public function logout(): void
    {
        $this->deleteAllPersistentData();
        $this->accessToken = null;
        $this->user = null;
        $this->idToken = null;
        $this->refreshToken = null;
    }

    /**
     * Delete all persisted data
     */
    public function deleteAllPersistentData(): void
    {
        foreach ($this->persistentMap as $key) {
            $this->store->delete($key);
        }
    }

    /**
     * Set the storage engine that implements Store interface
     *
     * @param Store $store - storage engine to use.
     */
    public function setStore(
        StoreInterface $store
    ): self {
        $this->store = $store;
        return $this;
    }

    /**
     * Generate a nonce value.
     *
     * @param int $length Desired length of the nonce.
     */
    public static function getNonce(
        int $length = 16
    ): string {
        try {
            $random_bytes = random_bytes($length);
        } catch (\Exception $exception) {
            $random_bytes = openssl_random_pseudo_bytes($length);
        }

        return bin2hex($random_bytes);
    }

    /**
     * Decode a URL-safe base64-encoded string.
     *
     * @param string $input Base64 encoded string to decode.
     */
    public static function urlSafeBase64Decode(
        string $input
    ): string {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $input .= str_repeat('=', 4 - $remainder);
        }

        $input = strtr($input, '-_', '+/');
        return base64_decode($input);
    }

    /**
     * Get the authorization code from POST or GET, depending on response_mode
     *
     * @see https://auth0.com/docs/api-auth/tutorials/authorization-code-grant
     */
    protected function getAuthorizationCode(): ?string
    {
        $code = null;
        if ($this->responseMode === 'query' && isset($_GET['code'])) {
            $code = $_GET['code'];
        } elseif ($this->responseMode === 'form_post' && isset($_POST['code'])) {
            $code = $_POST['code'];
        }

        return $code;
    }

    /**
     * Removes $name from the persistentMap, thus not persisting it when we set the value.
     *
     * @param string $name - value to remove from persistence.
     */
    private function doNotPersist(
        string $name
    ): void {
        $key = array_search($name, $this->persistentMap);
        if ($key !== false) {
            unset($this->persistentMap[$key]);
        }
    }
}
