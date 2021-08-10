<?php

declare(strict_types=1);

namespace Auth0\SDK;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Configuration\SdkState;
use Auth0\SDK\Utility\HttpResponse;
use Auth0\SDK\Utility\PKCE;
use Auth0\SDK\Utility\Shortcut;
use Auth0\SDK\Utility\TransientStoreHandler;

/**
 * Class Auth0.
 */
final class Auth0
{
    public const VERSION = '8.0.0';

    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private SdkConfiguration $configuration;

    /**
     * Instance of SdkState, for shared state across classes.
     */
    private SdkState $state;

    /**
     * Instance of TransientStoreHandler for storing ephemeral data.
     */
    private TransientStoreHandler $transient;

    /**
     * Authentication Client.
     */
    private ?Authentication $authentication = null;

    /**
     * Authentication Client.
     */
    private ?Management $management = null;

    /**
     * Auth0 Constructor.
     *
     * @param SdkConfiguration|array<mixed> $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     */
    public function __construct(
        $configuration
    ) {
        // If we're passed an array, construct a new SdkConfiguration from that structure.
        if (is_array($configuration)) {
            $configuration = new SdkConfiguration($configuration);
        }

        // Store the configuration internally.
        $this->configuration = $configuration;

        // Create a transient storage handler using the configured transientStorage medium.
        $this->transient = new TransientStoreHandler($configuration->getTransientStorage());

        // Setup active state using session data when available.
        // Otherwise, instantiate a new session.
        $this->restoreState();
    }

    /**
     * Create, configure, and return an instance of the Authentication class.
     */
    public function authentication(): Authentication
    {
        if ($this->authentication === null) {
            $this->authentication = new Authentication($this->configuration);
        }

        return $this->authentication;
    }

    /**
     * Create, configure, and return an instance of the Management class.
     */
    public function management(): Management
    {
        if ($this->management === null) {
            $this->management = new Management($this->configuration);
        }

        return $this->management;
    }

    /**
     * Retrieve the SdkConfiguration instance.
     */
    public function configuration(): SdkConfiguration
    {
        return $this->configuration;
    }

    /**
     * Return the url to the login page.
     *
     * @param string|null                 $redirectUrl Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param array<int|string|null>|null $params Additional parameters to include with the request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When `redirectUri` is not specified, and supplied SdkConfiguration does not have a default redirectUri configured.
     *
     * @link https://auth0.com/docs/api/authentication#login
     */
    public function login(
        ?string $redirectUrl = null,
        ?array $params = null
    ): string {
        $params = $params ?? [];
        $state = $params['state'] ?? $this->transient->issue('state');
        $params['nonce'] = $params['nonce'] ?? $this->transient->issue('nonce');
        $params['max_age'] = $params['max_age'] ?? $this->configuration->getTokenMaxAge();

        unset($params['state']);

        if ($this->configuration->getUsePkce()) {
            $codeVerifier = PKCE::generateCodeVerifier(128);
            $params['code_challenge'] = PKCE::generateCodeChallenge($codeVerifier);
            $params['code_challenge_method'] = 'S256';
            $this->transient->store('code_verifier', $codeVerifier);
        }

        if ($params['max_age'] !== null) {
            $this->transient->store('max_age', (string) $params['max_age']);
        }

        return $this->authentication()->getLoginLink((string) $state, $redirectUrl, $params);
    }

    /**
     * Return the url to the signup page when using the New Universal Login Experience.
     *
     * @param string|null                 $redirectUrl Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param array<int|string|null>|null $params Additional parameters to include with the request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When `redirectUri` is not specified, and supplied SdkConfiguration does not have a default redirectUri configured.
     *
     * @link https://auth0.com/docs/universal-login/new-experience
     * @link https://auth0.com/docs/api/authentication#login
     */
    public function signup(
        ?string $redirectUrl = null,
        ?array $params = null
    ): string {
        $params = Shortcut::mergeArrays([
            'screen_hint' => 'signup',
        ], $params);

        return $this->login($redirectUrl, $params);
    }

    /**
     * Delete any persistent data and clear out all stored properties, and return the URI to Auth0 /logout endpoint for redirection.
     *
     * @param string|null                 $returnUri Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param array<int|string|null>|null $params    Optional. Additional parameters to include with the request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When `returnUri` is not specified, and supplied SdkConfiguration does not have a default redirectUri configured.
     *
     * @link https://auth0.com/docs/api/authentication#logout
     */
    public function logout(
        ?string $returnUri = null,
        ?array $params = null
    ): string {
        $this->clear();

        return $this->authentication()->getLogoutLink($returnUri, $params);
    }

    /**
     * Delete any persistent data and clear out all stored properties.
     */
    public function clear(): self
    {
        $sessionStorage = $this->configuration->getSessionStorage();
        $transientStorage = $this->configuration->getTransientStorage();

        if ($sessionStorage !== null) {
            $sessionStorage->deleteAll();
        }

        if ($transientStorage !== null) {
            $transientStorage->deleteAll();
        }

        $this->state->reset();

        return $this;
    }

    /**
     * Verifies and decodes an ID token using the properties in this class.
     *
     * @param string             $token             ID token to verify and decode.
     * @param array<string>      $tokenAudience     Optional. An array of allowed values for the 'aud' claim. Successful if ANY match.
     * @param array<string>|null $tokenOrganization Optional. An array of allowed values for the 'org_id' claim. Successful if ANY match.
     * @param string|null        $tokenNonce        Optional. The value expected for the 'nonce' claim.
     * @param int|null           $tokenMaxAge       Optional. Maximum window of time in seconds since the 'auth_time' to accept the token.
     * @param int|null           $tokenLeeway       Optional. Leeway in seconds to allow during time calculations. Defaults to 60.
     * @param int|null           $tokenNow          Optional. Optional. Unix timestamp representing the current point in time to use for time calculations.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When token validation fails. See the exception message for further details.
     */
    public function decode(
        string $token,
        ?array $tokenAudience = null,
        ?array $tokenOrganization = null,
        ?string $tokenNonce = null,
        ?int $tokenMaxAge = null,
        ?int $tokenLeeway = null,
        ?int $tokenNow = null
    ): Token {
        // instantiate Token handler using the provided JWT, expecting an ID token, using the SDK configuration.
        $token = new Token($this->configuration, $token, Token::TYPE_ID_TOKEN);

        // Verify token signature.
        $token->verify();

        $tokenMaxAge = $tokenMaxAge ?? $this->transient->getOnce('max_age') ?? null;

        // If pulling from transient storage, $tokenMaxAge might be a string.
        if ($tokenMaxAge !== null) {
            $tokenMaxAge = (int) $tokenMaxAge;
        }

        // Validate token claims.
        $token->validate(
            null,
            $tokenAudience,
            $tokenOrganization,
            $tokenNonce ?? $this->transient->getOnce('nonce') ?? null,
            $tokenMaxAge ?? null,
            $tokenLeeway,
            $tokenNow
        );

        // Ensure transient-stored values are cleared, even if overriding values were passed to the  method.
        $this->transient->delete('max_age');
        $this->transient->delete('nonce');

        return $token;
    }

    /**
     * Exchange authorization code for access, ID, and refresh tokens.
     *
     * @param string|null $redirectUri  Optional. Redirect URI sent with authorize request. Defaults to the SDK's configured redirectUri.
     *
     * @throws \Auth0\SDK\Exception\StateException   If the state value is missing or invalid.
     * @throws \Auth0\SDK\Exception\StateException   If access token is missing from the response.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api-auth/tutorials/authorization-code-grant
     */
    public function exchange(
        ?string $redirectUri = null
    ): bool {
        $code = $this->getRequestParameter('code');
        $state = $this->getRequestParameter('state');
        $codeVerifier = null;
        $user = null;

        if ($code === null) {
            return false;
        }

        if ($state === null || ! $this->transient->verify('state', $state)) {
            $this->clear();
            throw \Auth0\SDK\Exception\StateException::invalidState();
        }

        if ($this->configuration->getUsePkce()) {
            $codeVerifier = $this->transient->getOnce('code_verifier');

            if ($codeVerifier === null) {
                throw \Auth0\SDK\Exception\StateException::missingCodeVerifier();
            }
        }

        if ($this->state->hasUser()) {
            $this->clear();
        }

        $response = $this->authentication()->codeExchange($code, $redirectUri, $codeVerifier);

        if (! HttpResponse::wasSuccessful($response)) {
            $this->clear();
            throw \Auth0\SDK\Exception\StateException::failedCodeExchange();
        }

        $response = HttpResponse::decodeContent($response);

        if (! isset($response['access_token']) || ! $response['access_token']) {
            $this->clear();
            throw \Auth0\SDK\Exception\StateException::badAccessToken();
        }

        $this->setAccessToken($response['access_token']);

        if (isset($response['scope'])) {
            $this->setAccessTokenScope(explode(' ', $response['scope']));
        }

        if (isset($response['refresh_token'])) {
            $this->setRefreshToken($response['refresh_token']);
        }

        if (isset($response['id_token'])) {
            if (! $this->transient->isset('nonce')) {
                $this->clear();
                throw \Auth0\SDK\Exception\StateException::missingNonce();
            }

            $this->setIdToken($response['id_token']);
            $user = $this->decode($response['id_token'])->toArray();
        }

        if (isset($response['expires_in']) && is_numeric($response['expires_in'])) {
            $expiresIn = time() + (int) $response['expires_in'];
            $this->setAccessTokenExpiration($expiresIn);
        }

        if ($user === null || $this->configuration->getQueryUserInfo() === true) {
            $response = $this->authentication()->userInfo($response['access_token']);

            if (HttpResponse::wasSuccessful($response)) {
                $user = HttpResponse::decodeContent($response);
            }
        }

        $this->setUser($user ?? []);
        return true;
    }

    /**
     * Renews the access token and ID token using an existing refresh token.
     * Scope "offline_access" must be declared in order to obtain refresh token for later token renewal.
     *
     * @param array<int|string|null>|null $params Optional. Additional parameters to include with the request.
     *
     * @throws \Auth0\SDK\Exception\StateException         If the Auth0 object does not have access token and refresh token, or the API did not renew tokens properly.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/tokens/refresh-token/current
     */
    public function renew(
        ?array $params = null
    ): self {
        $refreshToken = $this->state->getRefreshToken();

        if ($refreshToken === null) {
            throw \Auth0\SDK\Exception\StateException::failedRenewTokenMissingRefreshToken();
        }

        $response = $this->authentication()->refreshToken($refreshToken, $params);
        $response = HttpResponse::decodeContent($response);

        if (! isset($response['access_token']) || ! $response['access_token']) {
            throw \Auth0\SDK\Exception\StateException::failedRenewTokenMissingAccessToken();
        }

        $this->setAccessToken($response['access_token']);

        if (isset($response['id_token'])) {
            $this->setIdToken($response['id_token']);
        }

        return $this;
    }

    /**
     * Return an object representing the current session credentials (including id token, access token, access token expiration, refresh token and user data) without triggering an authorization flow. Returns null when session data is not available.
     */
    public function getCredentials(): ?object
    {
        $user = $this->state->getUser();

        if ($user === null) {
            return null;
        }

        $idToken = $this->state->getIdToken();
        $accessToken = $this->state->getAccessToken();
        $accessTokenScope = $this->state->getAccessTokenScope();
        $accessTokenExpiration = (int) $this->state->getAccessTokenExpiration();
        $accessTokenExpired = time() >= $accessTokenExpiration;
        $refreshToken = $this->state->getRefreshToken();

        return (object) [
            'user' => $user,
            'idToken' => $idToken,
            'accessToken' => $accessToken,
            'accessTokenScope' => $accessTokenScope ?? [],
            'accessTokenExpiration' => $accessTokenExpiration,
            'accessTokenExpired' => $accessTokenExpired,
            'refreshToken' => $refreshToken,
        ];
    }

    /**
     * Get ID token from persisted session or from a code exchange
     *
     * @throws \Auth0\SDK\Exception\StateException   If the state value is missing or invalid.
     * @throws \Auth0\SDK\Exception\StateException   If access token is missing from the response.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getIdToken(): ?string
    {
        if (! $this->state->hasIdToken()) {
            $this->exchange();
        }

        return $this->state->getIdToken();
    }

    /**
     * Get userinfo from persisted session or from a code exchange
     *
     * @return array<string,array|int|string>|null
     *
     * @throws \Auth0\SDK\Exception\StateException   If the state value is missing or invalid.
     * @throws \Auth0\SDK\Exception\StateException   If access token is missing from the response.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getUser(): ?array
    {
        if (! $this->state->hasUser()) {
            $this->exchange();
        }

        return $this->state->getUser();
    }

    /**
     * Get access token from persisted session or from a code exchange
     *
     * @throws \Auth0\SDK\Exception\StateException   If the state value is missing or invalid.
     * @throws \Auth0\SDK\Exception\StateException   If access token is missing from the response.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getAccessToken(): ?string
    {
        if (! $this->state->hasAccessToken()) {
            $this->exchange();
        }

        return $this->state->getAccessToken();
    }

    /**
     * Get refresh token from persisted session or from a code exchange
     *
     * @throws \Auth0\SDK\Exception\StateException   If the state value is missing or invalid.
     * @throws \Auth0\SDK\Exception\StateException   If access token is missing from the response.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getRefreshToken(): ?string
    {
        if (! $this->state->hasRefreshToken()) {
            $this->exchange();
        }

        return $this->state->getRefreshToken();
    }

    /**
     * Get token expiration from persisted session or from a code exchange
     *
     * @return array<string>
     *
     * @throws \Auth0\SDK\Exception\StateException   If the state value is missing or invalid.
     * @throws \Auth0\SDK\Exception\StateException   If access token is missing from the response.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getAccessTokenScope(): ?array
    {
        if (! $this->state->hasAccessTokenScope()) {
            $this->exchange();
        }

        return $this->state->getAccessTokenScope();
    }

    /**
     * Get token expiration from persisted session or from a code exchange
     *
     * @throws \Auth0\SDK\Exception\StateException   If the state value is missing or invalid.
     * @throws \Auth0\SDK\Exception\StateException   If access token is missing from the response.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function getAccessTokenExpiration(): ?int
    {
        if (! $this->state->hasAccessTokenExpiration()) {
            $this->exchange();
        }

        return $this->state->getAccessTokenExpiration();
    }

    /**
     * Sets, validates, and persists the ID token.
     *
     * @param string $idToken Id token returned from the code exchange.
     */
    public function setIdToken(
        string $idToken
    ): self {
        $this->state->setIdToken($idToken);

        if ($this->configuration->hasSessionStorage() && $this->configuration->getPersistIdToken()) {
            $this->configuration->getSessionStorage()->set('idToken', $idToken);
        }

        return $this;
    }

    /**
     * Set the user property to a userinfo array and, if configured, persist
     *
     * @param array<array|int|string> $user User data to store.
     */
    public function setUser(
        array $user
    ): self {
        $this->state->setUser($user);

        if ($this->configuration->hasSessionStorage() && $this->configuration->getPersistUser()) {
            $this->configuration->getSessionStorage()->set('user', $user);
        }

        return $this;
    }

    /**
     * Sets and persists the access token.
     *
     * @param string $accessToken Access token returned from the code exchange.
     */
    public function setAccessToken(
        string $accessToken
    ): self {
        $this->state->setAccessToken($accessToken);

        if ($this->configuration->hasSessionStorage() && $this->configuration->getPersistAccessToken()) {
            $this->configuration->getSessionStorage()->set('accessToken', $accessToken);
        }

        return $this;
    }

    /**
     * Sets and persists the refresh token.
     *
     * @param string $refreshToken Refresh token returned from the code exchange.
     */
    public function setRefreshToken(
        string $refreshToken
    ): self {
        $this->state->setRefreshToken($refreshToken);

        if ($this->configuration->hasSessionStorage() && $this->configuration->getPersistRefreshToken()) {
            $this->configuration->getSessionStorage()->set('refreshToken', $refreshToken);
        }

        return $this;
    }

    /**
     * Sets and persists the access token scope.
     *
     * @param array<string> $accessTokenScope An array of scopes for the access token.
     */
    public function setAccessTokenScope(
        array $accessTokenScope
    ): self {
        $this->state->setAccessTokenScope($accessTokenScope);

        if ($this->configuration->hasSessionStorage() && $this->configuration->getPersistAccessToken()) {
            $this->configuration->getSessionStorage()->set('accessTokenScope', $accessTokenScope);
        }

        return $this;
    }

    /**
     * Sets and persists the access token expiration unix timestamp.
     *
     * @param int $accessTokenExpiration Unix timestamp representing the expiration time on the access token.
     */
    public function setAccessTokenExpiration(
        int $accessTokenExpiration
    ): self {
        $this->state->setAccessTokenExpiration($accessTokenExpiration);

        if ($this->configuration->hasSessionStorage() && $this->configuration->getPersistAccessToken()) {
            $this->configuration->getSessionStorage()->set('accessTokenExpiration', $accessTokenExpiration);
        }

        return $this;
    }

    /**
     * Get the specified parameter from POST or GET, depending on configured response mode.
     *
     * @param string $parameterName Name of the parameter to pull from the request.
     */
    public function getRequestParameter(
        string $parameterName
    ): ?string {
        $responseMode = $this->configuration->getResponseMode();

        if ($responseMode === 'query' && isset($_GET[$parameterName])) {
            return filter_var($_GET[$parameterName], FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
        }

        if ($responseMode === 'form_post' && isset($_POST[$parameterName])) {
            return filter_var($_POST[$parameterName], FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
        }

        return null;
    }

    /**
     * Get the invitation details GET request
     */
    public function getInvitationParameters(): ?object
    {
        $invite = $this->getRequestParameter('invitation');
        $orgId = $this->getRequestParameter('organization');
        $orgName = $this->getRequestParameter('organization_name');

        if ($invite !== null && $orgId !== null && $orgName !== null) {
            return (object) [
                'invitation' => $invite,
                'organization' => $orgId,
                'organizationName' => $orgName,
            ];
        }

        return null;
    }

    /**
     * If invitation parameters are present in the request, handle extraction and automatically redirect to Universal Login.
     */
    public function handleInvitation(): self
    {
        $invite = $this->getInvitationParameters();

        if ($invite !== null) {
            $this->login(null, [
                'invitation' => (string) $invite->invitation,
                'organization' => (string) $invite->organization,
            ]);
        }

        return $this;
    }

    /**
     * Retrieve state from session storage and configure SDK state.
     */
    private function restoreState(): self
    {
        $state = [];

        if ($this->configuration->hasSessionStorage()) {
            if ($this->configuration->getPersistUser()) {
                $state['user'] = $this->configuration->getSessionStorage()->get('user');
            }

            if ($this->configuration->getPersistIdToken()) {
                $state['idToken'] = $this->configuration->getSessionStorage()->get('idToken');
            }

            if ($this->configuration->getPersistAccessToken()) {
                $state['accessToken'] = $this->configuration->getSessionStorage()->get('accessToken');
                $state['accessTokenScope'] = $this->configuration->getSessionStorage()->get('accessTokenScope');

                $expires = $this->configuration->getSessionStorage()->get('accessTokenExpiration');

                if ($expires !== null) {
                    $state['accessTokenExpiration'] = (int) $expires;
                }
            }

            if ($this->configuration->getPersistRefreshToken()) {
                $state['refreshToken'] = $this->configuration->getSessionStorage()->get('refreshToken');
            }
        }

        $this->state = new SdkState($state);

        return $this;
    }
}
