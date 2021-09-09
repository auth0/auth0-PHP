<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Authentication
 */
final class Authentication
{
    /**
     * Instance of Auth0\SDK\API\Utility\HttpClient.
     */
    private ?HttpClient $httpClient = null;

    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private SdkConfiguration $configuration;

    /**
     * Authentication constructor.
     *
     * @param SdkConfiguration|array<mixed> $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When an invalidation `configuration` is provided.
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
        $this->configuration = $configuration;
    }

    /**
     * Return the HttpClient instance being used for authentication  API requests.
     */
    public function getHttpClient(): HttpClient
    {
        if ($this->httpClient !== null) {
            return $this->httpClient;
        }

        return $this->httpClient = new HttpClient($this->configuration, HttpClient::CONTEXT_AUTHENTICATION_CLIENT);
    }

    /**
     * Build and return a SAMLP link.
     *
     * @param string|null $clientId   Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     * @param string|null $connection Optional. The connection to use. If no connection is specified, the Auth0 Login Page will be shown.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a $clientId is not configured.
     *
     * @link https://auth0.com/docs/connections/enterprise/samlp
     */
    public function getSamlpLink(
        ?string $clientId = null,
        ?string $connection = null
    ): string {
        [$clientId, $connection] = Toolkit::filter([$clientId, $connection])->string()->trim();

        [$clientId] = Toolkit::filter([
            [$clientId, $this->configuration->getClientId()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresClientId());

        return sprintf(
            '%s/samlp/%s?%s',
            $this->configuration->formatDomain(),
            $clientId,
            http_build_query(Toolkit::filter([
                ['connection' => $connection],
            ])->array()->trim()[0], '', '&', PHP_QUERY_RFC3986)
        );
    }

    /**
     * Build and return a SAMLP metadata link.
     *
     * @param string|null $clientId Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a $clientId is not configured.
     *
     * @link https://auth0.com/docs/connections/enterprise/samlp
     */
    public function getSamlpMetadataLink(
        ?string $clientId = null
    ): string {
        [$clientId] = Toolkit::filter([$clientId])->string()->trim();

        [$clientId] = Toolkit::filter([
            [$clientId, $this->configuration->getClientId()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresClientId());

        return sprintf(
            '%s/samlp/metadata/%s',
            $this->configuration->formatDomain(),
            $clientId
        );
    }

    /**
     * Build and return a WS-Federation link
     *
     * @param string|null                 $clientId Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     * @param array<int|string|null>|null $params   Optional. Additional parameters to include with the request. See @link for details.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a $clientId is not configured.
     *
     * @link https://auth0.com/docs/protocols/ws-fed
     */
    public function getWsfedLink(
        ?string $clientId = null,
        ?array $params = null
    ): string {
        [$clientId] = Toolkit::filter([$clientId])->string()->trim();
        [$params] = Toolkit::filter([$params])->array()->trim();

        [$clientId] = Toolkit::filter([
            [$clientId, $this->configuration->getClientId()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresClientId());

        return sprintf(
            '%s/wsfed/%s?%s',
            $this->configuration->formatDomain(),
            $clientId,
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
        return sprintf(
            '%s/wsfed/FederationMetadata/2007-06/FederationMetadata.xml',
            $this->configuration->formatDomain()
        );
    }

    /**
     * Build the login URL.
     *
     * @param string                      $state       A CSRF mitigating value, also useful for restoring the previous state of your app. See https://auth0.com/docs/protocols/state-parameters
     * @param string|null                 $redirectUri Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param array<int|string|null>|null $params      Optional. Additional parameters to include with the request. See @link for details.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `state` is passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a $redirectUri is not configured.
     *
     * @link https://auth0.com/docs/api/authentication#authorize-application
     */
    public function getLoginLink(
        string $state,
        ?string $redirectUri = null,
        ?array $params = null
    ): string {
        [$state, $redirectUri] = Toolkit::filter([$state, $redirectUri])->string()->trim();
        [$params] = Toolkit::filter([$params])->array()->trim();

        Toolkit::assert([
            [$state, \Auth0\SDK\Exception\ArgumentException::missing('state')],
        ])->isString();

        [$redirectUri] = Toolkit::filter([
            [$redirectUri, isset($params['redirect_uri']) ? (string) $params['redirect_uri'] : null, $this->configuration->getRedirectUri()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresRedirectUri());

        return sprintf(
            '%s/authorize?%s',
            $this->configuration->formatDomain(),
            http_build_query(Toolkit::merge([
                'state' => $state,
                'client_id' => $this->configuration->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
                'audience' => $this->configuration->defaultAudience(),
                'organization' => $this->configuration->defaultOrganization(),
                'redirect_uri' => $redirectUri,
                'scope' => $this->configuration->formatScope(),
                'response_mode' => $this->configuration->getResponseMode(),
                'response_type' => $this->configuration->getResponseType(),
            ], $params), '', '&', PHP_QUERY_RFC3986)
        );
    }

    /**
     * Builds and returns a logout URL to terminate an SSO session.
     *
     * @param string|null                 $returnTo Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param array<int|string|null>|null $params   Optional. Additional parameters to include with the request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a $returnUri is not configured.
     *
     * @link https://auth0.com/docs/api/authentication#logout
     */
    public function getLogoutLink(
        ?string $returnTo = null,
        ?array $params = null
    ): string {
        [$returnTo] = Toolkit::filter([$returnTo])->string()->trim();
        [$params] = Toolkit::filter([$params])->array()->trim();

        [$returnTo] = Toolkit::filter([
            [$returnTo, isset($params['returnTo']) ? (string) $params['returnTo'] : null, $this->configuration->getRedirectUri()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresRedirectUri());

        return sprintf(
            '%s/v2/logout?%s',
            $this->configuration->formatDomain(),
            http_build_query(Toolkit::merge([
                'returnTo' => $returnTo,
                'client_id' => $this->configuration->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
            ], $params), '', '&', PHP_QUERY_RFC3986)
        );
    }

    /**
     * Start passwordless login process.
     *
     * @param array<mixed>|null       $body    Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null  $headers Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function passwordlessStart(
        ?array $body = null,
        ?array $headers = null
    ): ResponseInterface {
        [$body, $headers] = Toolkit::filter([$body, $headers])->array()->trim();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('passwordless', 'start')
            ->withBody(Toolkit::merge([
                'client_id' => $this->configuration->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
                'client_secret' => $this->configuration->getClientSecret(\Auth0\SDK\Exception\ConfigurationException::requiresClientSecret()),
            ], $body))
            ->withHeaders($headers)
            ->call();
    }

    /**
     * Start passwordless login process for email
     *
     * @param string                         $email   Email address to use.
     * @param string                         $type    Use null or "link" to send a link, use "code" to send a verification code.
     * @param array<string,string|null>|null $params  Optional. Append or override the link parameters (like scope, redirect_uri, protocol, response_type) when you send a link using email.
     * @param array<int|string>|null         $headers Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `email` or `type` are passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function emailPasswordlessStart(
        string $email,
        string $type,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        [$email, $type] = Toolkit::filter([$email, $type])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$email, \Auth0\SDK\Exception\ArgumentException::missing('email')],
        ])->isEmail();

        Toolkit::assert([
            [$type, \Auth0\SDK\Exception\ArgumentException::missing('type')],
        ])->isString();

        return $this->passwordlessStart(Toolkit::filter([
            [
                'email' => $email,
                'connection' => 'email',
                'send' => $type,
                'authParams' => $params,
            ],
        ])->array()->trim()[0], $headers);
    }

    /**
     * Start passwordless login process for SMS.
     *
     * @param string                 $phoneNumber Phone number to use.
     * @param array<int|string>|null $headers     Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `phoneNumber` is passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function smsPasswordlessStart(
        string $phoneNumber,
        ?array $headers = null
    ): ResponseInterface {
        [$phoneNumber] = Toolkit::filter([$phoneNumber])->string()->trim();
        [$headers] = Toolkit::filter([$headers])->array()->trim();

        Toolkit::assert([
            [$phoneNumber, \Auth0\SDK\Exception\ArgumentException::missing('phoneNumber')],
        ])->isString();

        return $this->passwordlessStart(Toolkit::filter([
            [
                'phone_number' => $phoneNumber,
                'connection' => 'sms',
            ],
        ])->array()->trim()[0], $headers);
    }

    /**
     * Make an authenticated request to the /userinfo endpoint.
     *
     * @param string $accessToken Bearer token to use for the request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `accessToken` is passed.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#user-profile
     */
    public function userInfo(
        string $accessToken
    ): ResponseInterface {
        [$accessToken] = Toolkit::filter([$accessToken])->string()->trim();

        Toolkit::assert([
            [$accessToken, \Auth0\SDK\Exception\ArgumentException::missing('accessToken')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('userinfo')
            ->withHeader('Authorization', 'Bearer ' . ($accessToken ?? ''))
            ->call();
    }

    /**
     * Makes a call to the `oauth/token` endpoint.
     *
     * @param string                      $grantType Denotes the type of flow being used. See @link for details.
     * @param array<int|string|null>|null $params    Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null      $headers   Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `grantType` is passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#get-token
     */
    public function oauthToken(
        string $grantType,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        [$grantType] = Toolkit::filter([$grantType])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$grantType, \Auth0\SDK\Exception\ArgumentException::missing('grantType')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('oauth', 'token')
            ->withHeaders($headers)
            ->withFormParams(Toolkit::merge([
                'grant_type' => $grantType,
                'client_id' => $this->configuration->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
                'client_secret' => $this->configuration->getClientSecret(\Auth0\SDK\Exception\ConfigurationException::requiresClientSecret()),
            ], $params))
            ->call();
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `authorization_code` grant type
     *
     * @param string      $code         Authorization code received during login.
     * @param string|null $redirectUri  Optional. Redirect URI sent with authorize request. Defaults to the SDK's configured redirectUri.
     * @param string|null $codeVerifier Optional. The clear-text version of the code_challenge from the /authorize call
     *
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `code` is passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a redirect uri is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#authorization-code-flow45
     * @link https://auth0.com/docs/api/authentication#authorization-code-flow-with-pkce46
     */
    public function codeExchange(
        string $code,
        ?string $redirectUri = null,
        ?string $codeVerifier = null
    ): ResponseInterface {
        [$code, $redirectUri, $codeVerifier] = Toolkit::filter([$code, $redirectUri, $codeVerifier])->string()->trim();

        Toolkit::assert([
            [$code, \Auth0\SDK\Exception\ArgumentException::missing('code')],
        ])->isString();

        [$redirectUri] = Toolkit::filter([
            [$redirectUri, $this->configuration->getRedirectUri()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresRedirectUri());

        return $this->oauthToken('authorization_code', Toolkit::filter([
            [
                'redirect_uri' => $redirectUri,
                'code' => $code,
                'code_verifier' => $codeVerifier,
            ],
        ])->array()->trim()[0]);
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
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `username`, `password`, or `realm` are passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#resource-owner-password
     * @link https://auth0.com/docs/authorization/flows/resource-owner-password-flow
     */
    public function login(
        string $username,
        string $password,
        string $realm,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        [$username, $password, $realm] = Toolkit::filter([$username, $password, $realm])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$username, \Auth0\SDK\Exception\ArgumentException::missing('username')],
            [$password, \Auth0\SDK\Exception\ArgumentException::missing('password')],
            [$realm, \Auth0\SDK\Exception\ArgumentException::missing('realm')],
        ])->isString();

        return $this->oauthToken('http://auth0.com/oauth/grant-type/password-realm', Toolkit::merge([
            'username' => $username,
            'password' => $password,
            'realm' => $realm,
        ], $params), $headers);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password` grant type
     *
     * @param string                      $username Username of the resource owner.
     * @param string                      $password Password of the resource owner.
     * @param array<int|string|null>|null $params   Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null      $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `username` or `password` are passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#resource-owner-password
     * @link https://auth0.com/docs/authorization/flows/resource-owner-password-flow
     */
    public function loginWithDefaultDirectory(
        string $username,
        string $password,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        [$username, $password] = Toolkit::filter([$username, $password])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$username, \Auth0\SDK\Exception\ArgumentException::missing('username')],
            [$password, \Auth0\SDK\Exception\ArgumentException::missing('password')],
        ])->isString();

        return $this->oauthToken('password', Toolkit::merge([
            'username' => $username,
            'password' => $password,
        ], $params), $headers);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `client_credentials` grant type.
     *
     * @param array<int|string|null>|null $params  Optional. Additional content to include in the body of the API request. See @link for details.
     * @param array<int|string>|null      $headers Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#client-credentials-flow
     * @link https://auth0.com/docs/authorization/flows/client-credentials-flow
     */
    public function clientCredentials(
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        return $this->oauthToken('client_credentials', Toolkit::merge([
            'audience' => $this->configuration->defaultAudience(),
        ], $params), $headers);
    }

    /**
     * Use a refresh token grant to get new tokens.
     *
     * @param string                      $refreshToken Refresh token to use.
     * @param array<int|string|null>|null $params       Optional. Additional parameters to include with the request.
     * @param array<int|string>           $headers      Optional. Additional headers to send with the request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `refreshToken` is passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client Secret is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#refresh-token
     */
    public function refreshToken(
        string $refreshToken,
        ?array $params = null,
        ?array $headers = null
    ): ResponseInterface {
        [$refreshToken] = Toolkit::filter([$refreshToken])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$refreshToken, \Auth0\SDK\Exception\ArgumentException::missing('refreshToken')],
        ])->isString();

        return $this->oauthToken('refresh_token', Toolkit::merge([
            'refresh_token' => $refreshToken,
        ], $params), $headers);
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
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `email`, `password`, or `connection` are passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
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
        [$email, $password, $connection] = Toolkit::filter([$email, $password, $connection])->string()->trim();
        [$body, $headers] = Toolkit::filter([$body, $headers])->array()->trim();

        Toolkit::assert([
            [$email, \Auth0\SDK\Exception\ArgumentException::missing('email')],
            [$password, \Auth0\SDK\Exception\ArgumentException::missing('password')],
            [$connection, \Auth0\SDK\Exception\ArgumentException::missing('connection')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('dbconnections', 'signup')
            ->withBody(Toolkit::merge([
                'client_id' => $this->configuration->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
                'email' => $email,
                'password' => $password,
                'connection' => $connection,
            ], $body))
            ->withHeaders($headers)
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
     * @throws \Auth0\SDK\Exception\ArgumentException      When an invalid `email` or `connection` are passed.
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Client ID is not configured.
     * @throws \Auth0\SDK\Exception\NetworkException       When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/authentication#change-password
     */
    public function dbConnectionsChangePassword(
        string $email,
        string $connection,
        ?array $body = null,
        ?array $headers = null
    ): ResponseInterface {
        [$email, $connection] = Toolkit::filter([$email, $connection])->string()->trim();
        [$body, $headers] = Toolkit::filter([$body, $headers])->array()->trim();

        Toolkit::assert([
            [$email, \Auth0\SDK\Exception\ArgumentException::missing('email')],
            [$connection, \Auth0\SDK\Exception\ArgumentException::missing('connection')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('dbconnections', 'change_password')
            ->withBody(Toolkit::merge([
                'client_id' => $this->configuration->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
                'email' => $email,
                'connection' => $connection,
            ], $body))
            ->withHeaders($headers)
            ->call();
    }
}
