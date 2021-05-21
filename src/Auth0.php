<?php

declare(strict_types=1);

namespace Auth0\SDK;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Configuration\SdkState;
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Exception\StateException;
use Auth0\SDK\Helpers\TransientStoreHandler;
use Auth0\SDK\Utility\HttpResponse;

/**
 * Class Auth0
 * Provides access to Auth0 API functionality.
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
     * @param SdkConfiguration|array $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     *
     * @throws ConfigurationException When `domain`, `clientId`, or `redirectUri` are not provided.
     * @throws ConfigurationException When `tokenAlgorithm` is provided but the value is not supported.
     * @throws ConfigurationException When `tokenMaxAge` or `tokenLeeway` are provided but the value is not numeric.
     */
    public function __construct(
        $configuration
    ) {
        // If we're passed an array, construct a new SdkConfiguration from that structure.
        if (is_array($configuration)) {
            $configuration = new SdkConfiguration($configuration);
        }

        // We only accept an SdkConfiguration type.
        if (! $configuration instanceof SdkConfiguration) {
            throw ConfigurationException::requiresConfiguration();
        }

        // Store the configuration internally.
        $this->configuration = $configuration;

        // Create a transient storage handler using the configured transientStorage medium.
        $this->transient = new TransientStoreHandler($configuration->getTransientStorage());

        // Setup active state using session data when available.
        // Otherwise, instantiate a new session.
        $this->restoreState();
    }

    public function authentication()
    {
        if ($this->authentication === null) {
            $this->authentication = new Authentication($this->configuration);
        }

        return $this->authentication;
    }

    public function management()
    {
        if ($this->management === null) {
            $this->management = new Management($this->configuration);
        }

        return $this->management;
    }

    /**
     * Redirect to the hosted login page for a specific client.
     *
     * @param array $params Additional, valid parameters.
     *
     * @see \Auth0\SDK\API\Authentication::getAuthorizationLink()
     * @see https://auth0.com/docs/api/authentication#login
     */
    public function login(
        ?array $params = []
    ): void {
        header('Location: ' . $this->authentication()->getLoginLink($params));
    }

    /**
     * Delete any persistent data and clear out all stored properties, and redirect to Auth0 /logout endpoint.
     */
    public function logout(
        string $returnUri,
        array $params = []
    ): void {
        $this->clear();
        header('Location: ' . $this->authentication()->getLogoutLink($returnUri, $params));
    }

    /**
     * Delete any persistent data and clear out all stored properties.
     */
    public function clear(): void
    {
        if ($this->configuration->hasSessionStorage()) {
            foreach (['user', 'idToken', 'accessToken', 'refreshToken'] as $key) {
                $this->configuration->getSessionStorage()->delete($key);
            }
        }

        $this->state->reset();
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
        ?array $tokenAudience = null,
        ?array $tokenOrganization = null,
        ?string $tokenNonce = null,
        ?int $tokenMaxAge = null,
        ?int $tokenLeeway = null,
        ?int $tokenNow = null
    ): Token {
        // instantiate Token handler using the provided JWT, expecting an ID token, using the SDK configuration.
        $token = new Token($token, Token::TYPE_ID_TOKEN, $this->configuration);

        // Verify token signature.
        $token->verify();

        // Validate token claims.
        $token->validate(
            null,
            $tokenAudience,
            $tokenOrganization,
            $tokenNonce,
            $tokenMaxAge,
            $tokenLeeway,
            $tokenNow
        );

        return $token;
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
        $code = $this->getRequestParameter('code');
        if (! $code) {
            return false;
        }

        $state = $this->getRequestParameter('state');
        if (! $state || ! $this->transient->verify('state', $state)) {
            throw StateException::invalidState();
        }

        $code_verifier = null;
        if ($this->configuration->getUsePkce()) {
            $code_verifier = $this->transient->getOnce('code_verifier');

            if (! $code_verifier) {
                throw StateException::missingCodeVerifier();
            }
        }

        if ($this->state->hasUser()) {
            throw StateException::existingSession();
        }

        $response = $this->authentication()->codeExchange($code, $this->configuration->getRedirectUri(), $code_verifier);
        $response = HttpResponse::getJson($response);

        if (! isset($response['access_token']) || ! $response['access_token']) {
            throw StateException::badAccessToken();
        }

        $this->setAccessToken($response['access_token']);

        if (isset($response['refresh_token'])) {
            $this->setRefreshToken($response['refresh_token']);
        }

        if (isset($response['id_token'])) {
            if (! $this->transient->isset('nonce')) {
                throw StateException::missingNonce();
            }

            $this->setIdToken($response['id_token']);
        }

        $user = $this->state->getIdTokenDecoded();

        if ($user === null || $this->configuration->getQueryUserInfo() === true) {
            $user = $this->authentication()->userInfo($this->state->getAccessToken());
            $user = HttpResponse::getJson($user);
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
    public function renew(
        array $options = []
    ): void {
        $refreshToken = $this->state->getRefreshToken();

        if (! $refreshToken) {
            throw StateException::failedRenewTokenMissingRefreshToken();
        }

        $response = $this->authentication()->refreshToken($refreshToken, $options);
        $response = HttpResponse::getJson($response);

        if (! isset($response['access_token']) || ! $response['access_token']) {
            throw StateException::failedRenewTokenMissingAccessToken();
        }

        $this->setAccessToken($response['access_token']);

        if (isset($response['id_token'])) {
            $this->setIdToken($response['id_token']);
        }
    }

    /**
     * Get ID token from persisted session or from a code exchange
     *
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
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
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
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
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
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
     * @throws ApiException (see self::exchange()).
     * @throws CoreException (see self::exchange()).
     */
    public function getRefreshToken(): ?string
    {
        if (! $this->state->hasRefreshToken()) {
            $this->exchange();
        }

        return $this->state->getRefreshToken();
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
        $this->state->setIdTokenDecoded($this->decode($idToken)->toArray());
        $this->state->setIdToken($idToken);

        if ($this->configuration->hasSessionStorage() && $this->configuration->getPersistIdToken()) {
            $this->configuration->getSessionStorage()->set('idToken', $idToken);
        }

        return $this;
    }

    /**
     * Set the user property to a userinfo array and, if configured, persist
     *
     * @param array $user - userinfo from Auth0.
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
     * @param string $accessToken - access token returned from the code exchange.
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
     * @param string $refreshToken - refresh token returned from the code exchange.
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
     * Get the specified parameter from POST or GET, depending on configured response mode.
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
     * If invitation parameters are present in the request, handle extraction and automatically redirect to Universal Login.
     */
    public function handleInvitation(): void
    {
        $invite = $this->getInvitationParameters();

        if ($invite) {
            $this->login([
                'invitation' => $invite->invitation,
                'organization' => $invite->organization,
            ]);
        }
    }

    private function restoreState(): void
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
            }

            if ($this->configuration->getPersistRefreshToken()) {
                $state['refreshToken'] = $this->configuration->getSessionStorage()->get('refreshToken');
            }
        }

        $this->state = new SdkState($state);
    }
}
