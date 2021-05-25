<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\API\Header\AuthorizationBearer;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Helpers\PKCE;
use Auth0\SDK\Helpers\TransientStoreHandler;
use Auth0\SDK\Utility\HttpClient;
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
     * @param SdkConfiguration|array $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
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
        $this->configuration = $configuration;

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
     * @param array $params Optional. Additional parameters to include with the request. See @link for details.
     *
     * @link https://auth0.com/docs/api/authentication#authorize-application
     */
    public function getAuthorizationLink(
        array $params = []
    ): string {
        $params = array_filter(array_merge([
            'client_id' => $this->configuration->getClientId(),
            'response_type' => $this->configuration->getResponseType(),
            'redirect_uri' => $this->configuration->getRedirectUri(),
            'audience' => $this->configuration->buildDefaultAudience(),
            'scope' => $this->configuration->buildScopeString(),
            'organization' => $this->configuration->buildDefaultOrganization(),
        ], $params));

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
            $clientId ?? $this->configuration->getClientId(),
            $connection ?? ''
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
            $clientId ?? $this->configuration->getClientId()
        );
    }

    /**
     * Build and return a WS-Federation link
     *
     * @param string|null $clientId Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     * @param array       $params   Optional. Additional parameters to include with the request. See @link for details.
     *
     * @link https://auth0.com/docs/protocols/ws-fed
     */
    public function getWsfedLink(
        ?string $clientId = null,
        array $params = []
    ): string {
        return sprintf(
            '%s/wsfed/%s?%s',
            $this->configuration->buildDomainUri(),
            $clientId ?? $this->configuration->getClientId(),
            http_build_query($params, '', '&', PHP_QUERY_RFC3986)
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
     * @param array $params Optional. Additional parameters to include with the request. See @link for details.
     *
     * @link https://auth0.com/docs/api/authentication#authorize-application
     */
    public function getLoginLink(
        array $params = []
    ): string {
        $params = array_filter(array_replace([
            'scope' => $this->configuration->buildScopeString(),
            'audience' => $this->configuration->buildDefaultAudience(),
            'response_mode' => $this->configuration->getResponseMode(),
            'response_type' => $this->configuration->getResponseType(),
            'redirect_uri' => $this->configuration->getRedirectUri(),
            'max_age' => $this->configuration->getTokenMaxAge(),
        ], $params));

        if (! isset($params['state'])) {
            // No state provided by application so generate, store, and send one.
            $params['state'] = $this->transient->issue('state');
        } else {
            // Store the passed-in value.
            $this->transient->store('state', $params['state']);
        }

        // ID token nonce validation is required so auth params must include one.
        if (! isset($params['nonce'])) {
            $params['nonce'] = $this->transient->issue('nonce');
        } else {
            $this->transient->store('nonce', $params['nonce']);
        }

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
     * @param string|null $returnTo URL to return to after logging in; must be white-listed in Auth0. Defaults to the SDK's configured redirectUri.
     * @param array       $params   Optional. Additional parameters to include with the request. See @link for details.
     *
     * @link https://auth0.com/docs/api/authentication#logout
     */
    public function getLogoutLink(
        ?string $returnTo = null,
        array $params = []
    ): string {
        return sprintf(
            '%s/v2/logout?%s',
            $this->configuration->buildDomainUri(),
            http_build_query(array_filter(array_merge([
                'returnTo' => $returnTo ?? $this->configuration->getRedirectUri(),
                'client_id' => $this->configuration->getClientId(),
            ], $params)), '', '&', PHP_QUERY_RFC3986)
        );
    }

    /**
     * Start passwordless login process.
     *
     * @param array  $body    Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array  $headers Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function passwordlessStart(
        array $body = [],
        array $headers = []
    ): ResponseInterface {
        if (! $this->configuration->hasClientSecret()) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresClientSecret();
        }

        $body = array_filter(array_merge([
            'client_id' => $this->configuration->getClientId(),
            'client_secret' => $this->configuration->getClientSecret(),
        ], $body));

        return $this->httpClient
            ->method('post')
            ->addPath('passwordless', 'start')
            ->withBody($body)
            ->withHeaders($headers)
            ->call();
    }

    /**
     * Start passwordless login process for email
     *
     * @param string $email      Email address to use.
     * @param string $type       Use null or "link" to send a link, use "code" to send a verification code.
     * @param array  $authParams Optional.Append or override the link parameters (like scope, redirect_uri, protocol, response_type) when you send a link using email.
     * @param array  $headers    Optional. Additional headers to send with the API request.
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
        array $authParams = [],
        array $headers = []
    ): ResponseInterface {
        if (! mb_strlen($email)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('email');
        }

        if (! mb_strlen($type)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('type');
        }

        return $this->passwordlessStart(array_filter([
            'email' => $email,
            'connection' => 'email',
            'send' => $type,
            'authParams' => $authParams,
        ]), $headers);
    }

    /**
     * Start passwordless login process for SMS.
     *
     * @param string $phoneNumber Phone number to use.
     * @param array  $headers     Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $phoneNumber is passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function smsPasswordlessStart(
        string $phoneNumber,
        array $headers = []
    ): ResponseInterface {
        if (! mb_strlen($phoneNumber)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('phoneNumber');
        }

        return $this->passwordlessStart(array_filter([
            'phone_number' => $phoneNumber,
            'connection' => 'sms',
        ]), $headers);
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
        if (! mb_strlen($accessToken)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('phoneNumber');
        }

        return $this->httpClient
            ->method('post')
            ->addPath('userinfo')
            ->withHeader(new AuthorizationBearer($accessToken))
            ->call();
    }

    /**
     * Makes a call to the `oauth/token` endpoint.
     *
     * @param array  $grantType Denotes the type of flow being used. See @link for details.
     * @param array  $params    Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array  $headers   Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $grantType is passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-token
     */
    public function oauthToken(
        string $grantType,
        array $params = [],
        array $headers = []
    ): ResponseInterface {
        if (! mb_strlen($grantType)) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresGrantType();
        }

        return $this->httpClient
            ->method('post')
            ->addPath('oauth', 'token')
            ->withHeaders($headers)
            ->withFormParams(array_filter(array_merge([
                'grant_type' => $grantType,
                'client_id' => $this->configuration->getClientId(),
            ], $params)))
            ->call();
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `authorization_code` grant type
     *
     * @param string      $code         Authorization code received during login.
     * @param string|null $redirectUri  Optional. Redirect URI sent with authorize request.
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
        if (! mb_strlen($code)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('code');
        }

        return $this->oauthToken('authorization_code', array_filter([
            'client_secret' => $this->configuration->getClientSecret(),
            'redirect_uri' => $redirectUri ?? $this->configuration->getRedirectUri(),
            'code' => $code,
            'code_verifier' => $codeVerifier,
        ]));
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password-realm` grant type.
     *
     * @param string $username   Username of the resource owner.
     * @param string $password   Password of the resource owner.
     * @param string $realm      Database realm the user belongs to.
     * @param array  $params     Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array  $headers    Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $username, $password, or $realm are passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function login(
        string $username,
        string $password,
        string $realm,
        array $params = [],
        array $headers = []
    ): ResponseInterface {
        if (! mb_strlen($username)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('username');
        }

        if (! mb_strlen($password)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('password');
        }

        if (! mb_strlen($realm)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('realm');
        }

        return $this->oauthToken('http://auth0.com/oauth/grant-type/password-realm', array_filter(array_merge([
            'username' => $username,
            'password' => $password,
            'realm' => $realm,
            'client_secret' => $this->configuration->getClientSecret(),
        ], $params)), $headers);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password` grant type
     *
     * @param string $username   Username of the resource owner.
     * @param string $password   Password of the resource owner.
     * @param array  $params     Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array  $headers    Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $username or $password are passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api-auth/grant/password
     */
    public function loginWithDefaultDirectory(
        string $username,
        string $password,
        array $params = [],
        array $headers = []
    ): ResponseInterface {
        if (! mb_strlen($username)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('username');
        }

        if (! mb_strlen($password)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('password');
        }

        return $this->oauthToken('password', array_filter(array_merge([
            'username' => $username,
            'password' => $password,
            'client_secret' => $this->configuration->getClientSecret(),
        ], $params)), $headers);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `client_credentials` grant type.
     *
     * @param array  $params  Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array  $headers Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api-auth/grant/client-credentials
     */
    public function clientCredentials(
        array $params = [],
        array $headers = []
    ): ResponseInterface {
        if (! $this->configuration->hasClientSecret()) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresClientSecret();
        }

        return $this->oauthToken('client_credentials', array_filter(array_merge([
            'client_secret' => $this->configuration->getClientSecret(),
            'audience' => $this->configuration->buildDefaultAudience(),
        ], $params)), $headers);
    }

    /**
     * Use a refresh token grant to get new tokens.
     *
     * @param string $refreshToken Refresh token to use.
     * @param array  $params       Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array  $headers      Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $refreshToken is passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#refresh-token
     */
    public function refreshToken(
        string $refreshToken,
        array $params = [],
        array $headers = []
    ): ResponseInterface {
        if (! mb_strlen($refreshToken)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('refreshToken');
        }

        if (! $this->configuration->hasClientSecret()) {
            throw \Auth0\SDK\Exception\AuthenticationException::requiresClientSecret();
        }

        return $this->oauthToken('refresh_token', array_filter(array_merge([
            'client_secret' => $this->configuration->getClientSecret(),
            'refresh_token' => $refreshToken,
        ], $params)), $headers);
    }

    /**
     * Create a new user using active authentication.
     * This endpoint only works for database connections.
     *
     * @param string $email      Email for the user signing up.
     * @param string $password   New password for the user signing up.
     * @param string $connection Database connection to create the user in.
     * @param array  $body       Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array  $headers    Optional. Additional headers to send with the API request.
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
        array $body = [],
        array $headers = []
    ): ResponseInterface {
        if (! mb_strlen($email)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('email');
        }

        if (! mb_strlen($password)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('password');
        }

        if (! mb_strlen($connection)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('connection');
        }

        return $this->httpClient
            ->method('post')
            ->addPath('dbconnections', 'signup')
            ->withBody(array_filter(array_merge([
                'client_id' => $this->configuration->getClientId(),
                'email' => $email,
                'password' => $password,
                'connection' => $connection,
            ], $body)))
            ->withHeaders($headers)
            ->call();
    }

    /**
     * Send a change password email.
     * This endpoint only works for database connections.
     *
     * @param string      $email      Email for the user changing their password.
     * @param string      $connection The name of the database connection this user is in.
     * @param array       $body       Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array       $headers    Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\AuthenticationException When an invalid $email or $connection are passed.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#change-password
     */
    public function dbConnectionsChangePassword(
        string $email,
        string $connection,
        array $body = [],
        array $headers = []
    ): ResponseInterface {
        if (! mb_strlen($email)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('email');
        }

        if (! mb_strlen($connection)) {
            throw \Auth0\SDK\Exception\AuthenticationException::emptyString('connection');
        }

        return $this->httpClient
            ->method('post')
            ->addPath('dbconnections', 'change_password')
            ->withBody(array_filter(array_merge([
                'client_id' => $this->configuration->getClientId(),
                'email' => $email,
                'connection' => $connection,
            ], $body)))
            ->withHeaders($headers)
            ->call();
    }
}
