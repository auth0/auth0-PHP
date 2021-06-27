<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\PKCE;
use Auth0\SDK\Utility\Shortcut;
use Auth0\SDK\Utility\TransientStoreHandler;
use Auth0\SDK\Utility\Validate;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Authentication
 */
final class Authentication
{
    /**
     * HttpClient instance.
     */
    private HttpClient $httpClient;

    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private SdkConfiguration $configuration;

    /**
     * Instance of TransientStoreHandler for storing ephemeral data.
     */
    private TransientStoreHandler $transient;

    /**
     * Authentication constructor.
     *
     * @param SdkConfiguration|array<mixed> $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     *
     * @psalm-suppress DocblockTypeContradiction
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
            throw \Auth0\SDK\Exception\ConfigurationException::requiresConfiguration();
        }

        // Store the configuration internally.
        $this->configuration = & $configuration;

        // Create a transient storage handler using the configured transientStorage medium.
        $this->transient = new TransientStoreHandler($configuration->getTransientStorage());

        // Build the HTTP client.
        $this->httpClient = new HttpClient($this->configuration);
    }

    /**
     * Return the HttpClient instance being used for authentication  API requests.
     */
    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * Builds and returns the authorization URL.
     *
     * @param array<int|string|null> $params Optional. Additional parameters to include with the request. See @link for details.
     *
     * @link https://auth0.com/docs/api/authentication#authorize-application
     */
    public function getAuthorizationLink(
        ?array $params = null
    ): string {
        $redirectUri = isset($params['redirect_uri']) ? (string) $params['redirect_uri'] : null;
        $redirectUri = Shortcut::trimNull($redirectUri) ?? $this->configuration->getRedirectUri() ?? null;

        if ($redirectUri === null) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresReturnUri();
        }

        $params = Shortcut::mergeArrays(Shortcut::filterArray([
            'client_id' => $this->configuration->getClientId(),
            'response_type' => $this->configuration->getResponseType(),
            'redirect_uri' => $redirectUri,
            'audience' => $this->configuration->buildDefaultAudience(),
            'scope' => $this->configuration->buildScopeString(),
            'organization' => $this->configuration->buildDefaultOrganization(),
        ]), $params);

        return sprintf(
            '%s/authorize?%s',
            $this->configuration->buildDomainUri(),
            http_build_query($params, '', '&', PHP_QUERY_RFC3986)
        );
    }

    /**
     * Build and return a SAMLP link.
     *
     * @param string|null $clientId   Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     * @param string|null $connection Optional. The connection to use. If no connection is specified, the Auth0 Login Page will be shown.
     *
     * @link https://auth0.com/docs/connections/enterprise/samlp
     */
    public function getSamlpLink(
        ?string $clientId = null,
        ?string $connection = null
    ): string {
        return sprintf(
            '%s/samlp/%s?connection=%s',
            $this->configuration->buildDomainUri(),
            Shortcut::trimNull($clientId) ?? $this->configuration->getClientId(),
            Shortcut::trimNull($connection) ?? ''
        );
    }

    /**
     * Build and return a SAMLP metadata link.
     *
     * @param string|null $clientId Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     *
     * @link https://auth0.com/docs/connections/enterprise/samlp
     */
    public function getSamlpMetadataLink(
        ?string $clientId = null
    ): string {
        return sprintf(
            '%s/samlp/metadata/%s',
            $this->configuration->buildDomainUri(),
            Shortcut::trimNull($clientId) ?? $this->configuration->getClientId()
        );
    }

    /**
     * Build and return a WS-Federation link
     *
     * @param string|null                 $clientId Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     * @param array<int|string|null>|null $params   Optional. Additional parameters to include with the request. See @link for details.
     *
     * @link https://auth0.com/docs/protocols/ws-fed
     */
    public function getWsfedLink(
        ?string $clientId = null,
        ?array $params = null
    ): string {
        return sprintf(
            '%s/wsfed/%s?%s',
            $this->configuration->buildDomainUri(),
            Shortcut::trimNull($clientId) ?? $this->configuration->getClientId(),
            http_build_query($params ?? [], '', '&', PHP_QUERY_RFC3986)
        );
    }

    /**
     * Build and return a WS-Federation metadata link
     *
     * @link https://auth0.com/docs/protocols/ws-fed
     */
    public function getWsfedMetadataLink(): string
    {
        return $this->configuration->buildDomainUri() . '/wsfed/FederationMetadata/2007-06/FederationMetadata.xml';
    }

    /**
     * Build the login URL.
     *
     * @param string|null                 $redirectUri Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param array<int|string|null>|null $params Optional. Additional parameters to include with the request. See @link for details.
     *
     * @link https://auth0.com/docs/api/authentication#authorize-application
     */
    public function getLoginLink(
        ?string $redirectUri = null,
        ?array $params = null
    ): string {
        $redirectUri = $redirectUri ?? (isset($params['redirect_uri']) ? (string) $params['redirect_uri'] : null);
        $redirectUri = Shortcut::trimNull($redirectUri) ?? $this->configuration->getRedirectUri() ?? null;
        $state = $params['state'] ?? $this->transient->issue('state');
        $nonce = $params['nonce'] ?? $this->transient->issue('nonce');

        if ($redirectUri === null) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresReturnUri();
        }

        $params = Shortcut::mergeArrays(Shortcut::filterArray([
            'scope' => $this->configuration->buildScopeString(),
            'audience' => $this->configuration->buildDefaultAudience(),
            'response_mode' => $this->configuration->getResponseMode(),
            'response_type' => $this->configuration->getResponseType(),
            'redirect_uri' => $redirectUri,
            'max_age' => $this->configuration->getTokenMaxAge(),
            'state' => $state,
            'nonce' => $nonce,
        ]), $params);

        if ($this->configuration->getUsePkce()) {
            $codeVerifier = PKCE::generateCodeVerifier(128);
            $params['code_challenge'] = PKCE::generateCodeChallenge($codeVerifier);
            $params['code_challenge_method'] = 'S256';
            $this->transient->store('code_verifier', $codeVerifier);
        }

        if (isset($params['max_age'])) {
            $this->transient->store('max_age', (string) $params['max_age']);
        }

        return $this->getAuthorizationLink($params);
    }

    /**
     * Builds and returns a logout URL to terminate an SSO session.
     *
     * @param string|null                 $returnUri Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param array<int|string|null>|null $params    Optional. Additional parameters to include with the request.
     *
     * @link https://auth0.com/docs/api/authentication#logout
     */
    public function getLogoutLink(
        ?string $returnUri = null,
        ?array $params = null
    ): string {
        $returnUri = $returnUri ?? (isset($params['returnTo']) ? (string) $params['returnTo'] : null);
        $returnUri = Shortcut::trimNull($returnUri) ?? $this->configuration->getRedirectUri() ?? null;

        if ($returnUri === null) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresReturnUri();
        }

        $payload = Shortcut::mergeArrays([
            'returnTo' => $returnUri,
            'client_id' => $this->configuration->getClientId(),
        ], $params);

        return sprintf(
            '%s/v2/logout?%s',
            $this->configuration->buildDomainUri(),
            http_build_query($payload, '', '&', PHP_QUERY_RFC3986)
        );
    }

    /**
     * Start passwordless login process.
     *
     * @param array<mixed>|null       $body    Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null  $headers Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function passwordlessStart(
        ?array $body = null,
        ?array $headers = null
    ): ResponseInterface {
        if (! $this->configuration->hasClientSecret()) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresClientSecret();
        }

        $body = Shortcut::mergeArrays([
            'client_id' => $this->configuration->getClientId(),
            'client_secret' => $this->configuration->getClientSecret(),
        ], $body);

        return $this->httpClient
            ->method('post')
            ->addPath('passwordless', 'start')
            ->withBody($body)
            ->withHeaders($headers ?? [])
            ->call();
    }

    /**
     * Start passwordless login process for email
     *
     * @param string                 $email      Email address to use.
     * @param string                 $type       Use null or "link" to send a link, use "code" to send a verification code.
     * @param array<string>|null     $params     Optional. Append or override the link parameters (like scope, redirect_uri, protocol, response_type) when you send a link using email.
     * @param array<int|string>|null $headers    Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid `email` or `type` are passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function emailPasswordlessStart(
        string $email,
        string $type,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        Validate::email($email, 'email');
        Validate::string($type, 'type');

        $body = Shortcut::filterArray([
            'email' => trim($email),
            'connection' => 'email',
            'send' => trim($type),
            'authParams' => $params ?? [],
        ]);

        return $this->passwordlessStart($body, $headers ?? []);
    }

    /**
     * Start passwordless login process for SMS.
     *
     * @param string                 $phoneNumber Phone number to use.
     * @param array<int|string>|null $headers     Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $phoneNumber is passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function smsPasswordlessStart(
        string $phoneNumber,
        ?array $headers = null
    ): ResponseInterface {
        Validate::string($phoneNumber, 'phoneNumber');

        $body = Shortcut::filterArray([
            'phone_number' => trim($phoneNumber),
            'connection' => 'sms',
        ]);

        return $this->passwordlessStart($body, $headers ?? []);
    }

    /**
     * Make an authenticated request to the /userinfo endpoint.
     *
     * @param string $accessToken Bearer token to use for the request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $accessToken is passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#user-profile
     */
    public function userInfo(
        string $accessToken
    ): ResponseInterface {
        Validate::string($accessToken, 'accessToken');

        return $this->httpClient
            ->method('post')
            ->addPath('userinfo')
            ->withHeader('Authorization', 'Bearer ' . trim($accessToken))
            ->call();
    }

    /**
     * Makes a call to the `oauth/token` endpoint.
     *
     * @param string                      $grantType Denotes the type of flow being used. See @link for details.
     * @param array<int|string|null>|null $params    Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null      $headers   Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $grantType is passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-token
     */
    public function oauthToken(
        string $grantType,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        Validate::string($grantType, 'grantType');

        if (! $this->configuration->hasClientSecret()) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresClientSecret();
        }

        $params = Shortcut::mergeArrays([
            'grant_type' => trim($grantType),
            'client_id' => $this->configuration->getClientId(),
            'client_secret' => $this->configuration->getClientSecret(),
        ], $params);

        return $this->httpClient
            ->method('post')
            ->addPath('oauth', 'token')
            ->withHeaders($headers ?? [])
            ->withFormParams($params)
            ->call();
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `authorization_code` grant type
     *
     * @param string      $code         Authorization code received during login.
     * @param string|null $redirectUri  Optional. Redirect URI sent with authorize request. Defaults to the SDK's configured redirectUri.
     * @param string|null $codeVerifier Optional. The clear-text version of the code_challenge from the /authorize call
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $code is passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function codeExchange(
        string $code,
        ?string $redirectUri = null,
        ?string $codeVerifier = null
    ): ResponseInterface {
        Validate::string($code, 'code');

        $returnUri = Shortcut::trimNull($redirectUri) ?? $this->configuration->getRedirectUri() ?? null;

        if ($returnUri === null) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresReturnUri();
        }

        return $this->oauthToken('authorization_code', Shortcut::filterArray([
            'redirect_uri' => $returnUri,
            'code' => trim($code),
            'code_verifier' => Shortcut::trimNull($codeVerifier),
        ]));
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password-realm` grant type.
     *
     * @param string                      $username Username of the resource owner.
     * @param string                      $password Password of the resource owner.
     * @param string                      $realm    Database realm the user belongs to.
     * @param array<int|string|null>|null $params   Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null      $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $username, $password, or $realm are passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function login(
        string $username,
        string $password,
        string $realm,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        Validate::string($username, 'username');
        Validate::string($password, 'password');
        Validate::string($realm, 'realm');

        $params = Shortcut::mergeArrays([
            'username' => trim($username),
            'password' => trim($password),
            'realm' => trim($realm),
        ], $params);

        return $this->oauthToken('http://auth0.com/oauth/grant-type/password-realm', $params, $headers ?? []);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password` grant type
     *
     * @param string                      $username Username of the resource owner.
     * @param string                      $password Password of the resource owner.
     * @param array<int|string|null>|null $params   Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null      $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $username or $password are passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api-auth/grant/password
     */
    public function loginWithDefaultDirectory(
        string $username,
        string $password,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        Validate::string($username, 'username');
        Validate::string($password, 'password');

        $params = Shortcut::mergeArrays([
            'username' => trim($username),
            'password' => trim($password),
        ], $params);

        return $this->oauthToken('password', $params, $headers ?? []);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `client_credentials` grant type.
     *
     * @param array<int|string|null>|null $params  Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null      $headers Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api-auth/grant/client-credentials
     */
    public function clientCredentials(
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        if (! $this->configuration->hasClientSecret()) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresClientSecret();
        }

        $params = Shortcut::mergeArrays([
            'audience' => $this->configuration->buildDefaultAudience(),
        ], $params);

        return $this->oauthToken('client_credentials', $params, $headers ?? []);
    }

    /**
     * Use a refresh token grant to get new tokens.
     *
     * @param string                      $refreshToken Refresh token to use.
     * @param array<int|string|null>|null $params       Optional. Additional parameters to include with the request.
     * @param array<int|string>           $headers      Optional. Additional headers to send with the request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When Client Secret is not configured, or an invalid $refreshToken is passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#refresh-token
     */
    public function refreshToken(
        string $refreshToken,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        Validate::string($refreshToken, 'refreshToken');

        if (! $this->configuration->hasClientSecret()) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresClientSecret();
        }

        $params = Shortcut::mergeArrays([
            'refresh_token' => trim($refreshToken),
        ], $params);

        return $this->oauthToken('refresh_token', $params, $headers ?? []);
    }

    /**
     * Create a new user using active authentication.
     * This endpoint only works for database connections.
     *
     * @param string                 $email      Email for the user signing up.
     * @param string                 $password   New password for the user signing up.
     * @param string                 $connection Database connection to create the user in.
     * @param array<mixed>|null      $body       Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null $headers    Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $email, $password, or $connection are passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#signup
     */
    public function dbConnectionsSignup(
        string $email,
        string $password,
        string $connection,
        ?array $body = null,
        ?array $headers = null
    ): ResponseInterface {
        Validate::string($email, 'email');
        Validate::string($password, 'password');
        Validate::string($connection, 'connection');

        $body = Shortcut::mergeArrays([
            'client_id' => $this->configuration->getClientId(),
            'email' => trim($email),
            'password' => trim($password),
            'connection' => trim($connection),
        ], $body);

        return $this->httpClient
            ->method('post')
            ->addPath('dbconnections', 'signup')
            ->withBody($body)
            ->withHeaders($headers ?? [])
            ->call();
    }

    /**
     * Send a change password email.
     * This endpoint only works for database connections.
     *
     * @param string                 $email      Email for the user changing their password.
     * @param string                 $connection The name of the database connection this user is in.
     * @param array<mixed>|null      $body       Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null $headers    Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $email or $connection are passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#change-password
     */
    public function dbConnectionsChangePassword(
        string $email,
        string $connection,
        ?array $body = null,
        ?array $headers = null
    ): ResponseInterface {
        Validate::string($email, 'email');
        Validate::string($connection, 'connection');

        $body = Shortcut::mergeArrays([
            'client_id' => $this->configuration->getClientId(),
            'email' => trim($email),
            'connection' => trim($connection),
        ], $body);

        return $this->httpClient
            ->method('post')
            ->addPath('dbconnections', 'change_password')
            ->withBody($body)
            ->withHeaders($headers ?? [])
            ->call();
    }
}
