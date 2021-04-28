<?php

/**
 * Authentication API wrapper
 *
 * @package Auth0\SDK\API
 *
 * @see https://auth0.com/docs/api/authentication
 */

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\API\Header\AuthorizationBearer;
use Auth0\SDK\API\Header\ForwardedFor;
use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\Exception\ApiException;
use GuzzleHttp\Psr7;

/**
 * Class Authentication
 *
 * @package Auth0\SDK\API
 */
class Authentication
{
    /**
     * Domain for the Auth0 Tenant.
     *
     * @var string
     */
    private $domain;

    /**
     * Client ID for the Auth0 Application.
     *
     * @var string|null
     */
    private $client_id;

    /**
     * Client Secret for the Auth0 Application.
     *
     * @var string|null
     */
    private $client_secret;

    /**
     * API audience identifier for the access token.
     *
     * @var string|null
     */
    private $audience;

    /**
     * The Id of an organization to log in to.
     *
     * @var string|null
     */
    private $organization;

    /**
     * Scopes to request during login.
     *
     * @var string|null
     */
    private $scope;

    /**
     * ApiClient instance.
     *
     * @var ApiClient
     */
    private $apiClient;

    /**
     * Authentication constructor.
     *
     * @param string      $domain        Tenant domain, found in Application settings.
     * @param string      $client_id     Client ID, found in Application settings.
     * @param string|null $client_secret Optional. Client Secret, found in Application settings.
     * @param string|null $audience      Optional. API audience identifier for the access token, found in API settings.
     * @param string|null $scope         Optional. Scopes to request during login.
     * @param array       $guzzleOptions Optional. Options for the Guzzle HTTP client.
     * @param string|null $organization  Optional. The Id of an organization to log in to.
     *
     * @link https://auth0.com/docs/scopes/current
     * @link http://docs.guzzlephp.org/en/stable/request-options.html
     */
    public function __construct(
        string $domain,
        string $client_id,
        ?string $client_secret = null,
        ?string $audience = null,
        ?string $scope = null,
        array $guzzleOptions = [],
        ?string $organization = null
    ) {
        $this->domain        = $domain;
        $this->client_id     = $client_id;
        $this->client_secret = $client_secret;
        $this->audience      = $audience;
        $this->scope         = $scope;
        $this->organization  = $organization;

        $this->apiClient = new ApiClient(
            [
                'domain' => 'https://' . $this->domain,
                'basePath' => '/',
                'guzzleOptions' => $guzzleOptions,
                'returnType' => 'body',
            ]
        );
    }

    /**
     * Builds and returns the authorization URL.
     *
     * @param string      $response_type Response type requested, typically "code" for web application login.
     * @param string      $redirect_uri  Redirect URI for login and consent, must be white-listed.
     * @param string|null $connection    Connection parameter to send with the request.
     * @param string|null $state         State parameter to send with the request.
     * @param array       $params        Additional URL parameters to send with the request.
     *
     * @return string
     *
     * @link https://auth0.com/docs/api/authentication#authorize-application
     */
    public function getAuthorizationLink(
        string $response_type,
        string $redirect_uri,
        ?string $connection = null,
        ?string $state = null,
        array $params = []
    ): string {
        $params['client_id']     = $this->client_id;
        $params['response_type'] = $response_type;
        $params['redirect_uri']  = $redirect_uri;
        $params['connection']    = $connection ?? $params['connection'] ?? null;
        $params['state']         = $state ?? $params['state'] ?? null;
        $params['audience']      = $params['audience'] ?? $this->audience ?? null;
        $params['scope']         = $params['scope'] ?? $this->scope ?? null;
        $params['organization']  = $params['organization'] ?? $this->organization ?? null;

        $params = array_filter($params);

        return sprintf(
            'https://%s/authorize?%s',
            $this->domain,
            Psr7\build_query($params)
        );
    }

    /**
     * Build and return a SAMLP link.
     *
     * @param string|null $client_id  Client ID to use, null to use the value set during class initialization.
     * @param string      $connection Connection parameter to add.
     *
     * @return string
     *
     * @link https://auth0.com/docs/connections/enterprise/samlp
     */
    public function getSamlpLink(?string $client_id = null, ?string $connection = null): string
    {
        return sprintf(
            'https://%s/samlp/%s?connection=%s',
            $this->domain,
            $client_id ?? $this->client_id,
            $connection ?? ''
        );
    }

    /**
     * Build and return a SAMLP metadata link.
     *
     * @param string|null $client_id Client ID to use, null to use the value set during class initialization.
     *
     * @return string
     *
     * @link https://auth0.com/docs/connections/enterprise/samlp
     */
    public function getSamlpMetadataLink(?string $client_id = null): string
    {
        return sprintf(
            'https://%s/samlp/metadata/%s',
            $this->domain,
            $client_id ?? $this->client_id
        );
    }

    /**
     * Build and return a WS-Federation link
     *
     * @param string|null $client_id Client ID to use, null to use the value set during class initialization.
     * @param array       $params    Request parameters for the WS-Fed request.
     *                               - params.client-id The client-id of your application.
     *                               - params.wtrealm   Can be used in place of client-id.
     *                               - params.whr       The name of the connection (used to skip the login page).
     *                               - params.wctx      Your application's state.
     *                               - params.wreply    The callback URL.
     *
     * @return string
     *
     * @link https://auth0.com/docs/protocols/ws-fed
     */
    public function getWsfedLink(?string $client_id = null, array $params = []): string
    {
        return sprintf(
            'https://%s/wsfed/%s?%s',
            $this->domain,
            $client_id ?? $this->client_id,
            Psr7\build_query($params)
        );
    }

    /**
     * Build and return a WS-Federation metadata link
     *
     * @return string
     *
     * @link https://auth0.com/docs/protocols/ws-fed
     */
    public function getWsfedMetadataLink(): string
    {
        return 'https://' . $this->domain . '/wsfed/FederationMetadata/2007-06/FederationMetadata.xml';
    }

    /**
     * Builds and returns a logout URL to terminate an SSO session.
     *
     * @param string|null      $returnTo  URL to return to after logging in; must be white-listed in Auth0.
     * @param string|bool|null $client_id Client ID to use App-specific returnTo URLs. True to use class prop.
     * @param bool             $federated Attempt a federated logout.
     *
     * @return string
     *
     * @link https://auth0.com/docs/api/authentication#logout
     */
    public function getLogoutLink(?string $returnTo = null, $client_id = null, bool $federated = false): string
    {
        $params = [
            'returnTo' => $returnTo,
            'client_id' => true === $client_id ? $this->client_id : $client_id,
            'federated' => $federated ? 'federated' : null,
        ];

        $params = array_filter($params);

        return sprintf(
            'https://%s/v2/logout?%s',
            $this->domain,
            Psr7\build_query($params)
        );
    }

    /**
     * Start passwordless login process for email
     *
     * @param string      $email         Email address to use.
     * @param string      $type          Use null or "link" to send a link, use "code" to send a verification code.
     * @param array       $authParams    Link parameters (like scope, redirect_uri, protocol, response_type) to modify.
     * @param string|null $forwarded_for (optional) source IP address. requires Trust Token Endpoint IP Header
     *
     * @return array
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function emailPasswordlessStart(
        string $email,
        string $type,
        array $authParams = [],
        ?string $forwarded_for = null
    ): array {
        $data = [
            'client_id' => $this->client_id,
            'connection' => 'email',
            'send' => $type,
            'email' => $email,
        ];

        if (! empty($this->client_secret)) {
            $data['client_secret'] = $this->client_secret;
        }

        if (! empty($authParams)) {
            $data['authParams'] = $authParams;
        }

        $request = $this->apiClient->method('post')
            ->addPath('passwordless', 'start')
            ->withBody($data);

        if (! empty($forwarded_for)) {
            $request->withHeader(new ForwardedFor($forwarded_for));
        }

        return $request->call();
    }

    /**
     * Start passwordless login process for SMS.
     *
     * @param string      $phone_number  Phone number to use.
     * @param string|null $forwarded_for (optional) source IP address. requires Trust Token Endpoint IP Header
     *
     * @return array
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function smsPasswordlessStart(string $phone_number, ?string $forwarded_for = null): array
    {
        $data = [
            'client_id' => $this->client_id,
            'connection' => 'sms',
            'phone_number' => $phone_number,
        ];

        if (! empty($this->client_secret)) {
            $data['client_secret'] = $this->client_secret;
        }

        $request = $this->apiClient->method('post')
            ->addPath('passwordless', 'start')
            ->withBody($data);

        if (! empty($forwarded_for)) {
            $request->withHeader(new ForwardedFor($forwarded_for));
        }

        return $request->call();
    }

    /**
     * Make an authenticated request to the /userinfo endpoint.
     *
     * @param string $access_token Bearer token to use for the request.
     *
     * @return array
     *
     * @link https://auth0.com/docs/api/authentication#user-profile
     */
    public function userInfo(string $access_token): array
    {
        return $this->apiClient->method('get')
            ->addPath('userinfo')
            ->withHeader(new AuthorizationBearer($access_token))
            ->call();
    }

    /**
     * Makes a call to the `oauth/token` endpoint.
     *
     * @param array $options Options for the token endpoint request.
     *                       - options.grant_type    Grant type to use; required.
     *                       - options.client_id     Application Client ID; required.
     *                       - options.client_secret Application Client Secret; required if token endpoint requires authentication.
     *                       - options.scope         Access token scope requested.
     *                       - options.audience      API audience identifier for access token.
     *
     * @return array
     *
     * @throws ApiException If grant_type is missing from $options.
     */
    public function oauthToken(array $options = []): array
    {
        if (! isset($options['client_id'])) {
            $options['client_id'] = $this->client_id;
        }

        if (! isset($options['client_secret'])) {
            $options['client_secret'] = $this->client_secret;
        }

        if (! isset($options['grant_type'])) {
            throw new ApiException('grant_type is mandatory');
        }

        $request = $this->apiClient->method('post')
            ->addPath('oauth', 'token')
            ->withBody($options);

        if (isset($options['auth0_forwarded_for'])) {
            $request->withHeader(new ForwardedFor($options['auth0_forwarded_for']));
        }

        return $request->call();
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `authorization_code` grant type
     *
     * @param string      $code          Authorization code received during login.
     * @param string      $redirect_uri  Redirect URI sent with authorize request.
     * @param string|null $code_verifier The clear-text version of the code_challenge from the /authorize call
     *
     * @return array
     *
     * @throws ApiException If grant_type is missing.
     */
    public function codeExchange(string $code, string $redirect_uri, ?string $code_verifier = null): array
    {
        if (empty($this->client_secret)) {
            throw new ApiException('client_secret is mandatory');
        }

        $options = [
            'client_secret' => $this->client_secret,
            'redirect_uri' => $redirect_uri,
            'code' => $code,
            'grant_type' => 'authorization_code',
        ];

        if ($code_verifier) {
            $options += ['code_verifier' => $code_verifier];
        }

        return $this->oauthToken($options);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password-realm` grant type.
     *
     * @param array       $options    Options for this grant.
     *                                - options.username Username or email of the user logging in; required.
     *                                - options.password Password of the user logging in; required.
     *                                - options.realm    Database realm to use; required.
     *                                - options.scope    Access token scope requested.
     *                                - options.audience API audience identifier for access token.
     * @param string|null $ip_address Pass in an IP address to set an Auth0-Forwarded-For header.
     *
     * @return array
     *
     * @throws ApiException If username, password, or realm are missing from $options.
     */
    public function login(array $options, ?string $ip_address = null): array
    {
        if (! isset($options['username'])) {
            throw new ApiException('username is mandatory');
        }

        if (! isset($options['password'])) {
            throw new ApiException('password is mandatory');
        }

        if (! isset($options['realm'])) {
            throw new ApiException('realm is mandatory');
        }

        if (! empty($ip_address)) {
            $options['auth0_forwarded_for'] = $ip_address;
        }

        $options['grant_type'] = 'http://auth0.com/oauth/grant-type/password-realm';

        return $this->oauthToken($options);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password` grant type
     *
     * @param array       $options    Options for this grant.
     *                                - options.username Username or email of the user logging in; required.
     *                                - options.password Password of the user logging in; required.
     *                                - options.scope    Access token scope requested.
     *                                - options.audience API audience identifier for access token.
     * @param string|null $ip_address Pass in an IP address to set an Auth0-Forwarded-For header.
     *
     * @return array
     *
     * @throws ApiException If username or password is missing.
     *
     * @link https://auth0.com/docs/api-auth/grant/password
     */
    public function loginWithDefaultDirectory(array $options, ?string $ip_address = null): array
    {
        if (! isset($options['username'])) {
            throw new ApiException('username is mandatory');
        }

        if (! isset($options['password'])) {
            throw new ApiException('password is mandatory');
        }

        if (! empty($ip_address)) {
            $options['auth0_forwarded_for'] = $ip_address;
        }

        $options['grant_type'] = 'password';

        return $this->oauthToken($options);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `client_credentials` grant type.
     *
     * @param array $options Information required for this grant.
     *                       - options.client_id     Application Client ID.
     *                       - options.client_secret Application Client Secret.
     *                       - options.audience      API Audience requested.
     *
     * @return array
     *
     * @throws ApiException If client_id or client_secret are missing.
     *
     * @link https://auth0.com/docs/api-auth/grant/client-credentials
     */
    public function clientCredentials(array $options): array
    {
        if (! isset($options['client_secret'])) {
            $options['client_secret'] = $this->client_secret;
        }

        if (empty($options['client_secret'])) {
            throw new ApiException('client_secret is mandatory');
        }

        if (! isset($options['client_id'])) {
            $options['client_id'] = $this->client_id;
        }

        if (! isset($options['audience'])) {
            $options['audience'] = $this->audience;
        }

        if (empty($options['audience'])) {
            throw new ApiException('audience is mandatory');
        }

        $options['grant_type'] = 'client_credentials';

        return $this->oauthToken($options);
    }

    /**
     * Use a refresh token grant to get new tokens.
     *
     * @param string $refresh_token Refresh token to use.
     * @param array  $options       Array of options to override defaults.
     *
     * @return array
     *
     * @throws ApiException If $refresh_token, client_secret, or client_id is blank.
     *
     * @link https://auth0.com/docs/api/authentication#refresh-token
     */
    public function refreshToken(string $refresh_token, array $options = []): array
    {
        if (empty($refresh_token)) {
            throw new ApiException('Refresh token cannot be blank');
        }

        if (! isset($options['client_secret'])) {
            $options['client_secret'] = $this->client_secret;
        }

        if (empty($options['client_secret'])) {
            throw new ApiException('client_secret is mandatory');
        }

        if (! isset($options['client_id'])) {
            $options['client_id'] = $this->client_id;
        }

        if (empty($options['client_id'])) {
            throw new ApiException('client_id is mandatory');
        }

        $options['refresh_token'] = $refresh_token;
        $options['grant_type']    = 'refresh_token';

        return $this->oauthToken($options);
    }

    /**
     * Create a new user using active authentication.
     * This endpoint only works for database connections.
     *
     * @param string $email      Email for the user signing up.
     * @param string $password   New password for the user signing up.
     * @param string $connection Database connection to create the user in.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/authentication#signup
     */
    public function dbconnectionsSignup(string $email, string $password, string $connection): array
    {
        $data = [
            'client_id' => $this->client_id,
            'email' => $email,
            'password' => $password,
            'connection' => $connection,
        ];

        return $this->apiClient->method('post')
            ->addPath('dbconnections', 'signup')
            ->withBody($data)
            ->call();
    }

    /**
     * Send a change password email.
     * This endpoint only works for database connections.
     *
     * @param string      $email      Email for the user changing their password.
     * @param string      $connection The name of the database connection this user is in.
     * @param string|null $password   New password to use.
     *                                If this parameter is provided, when the user clicks on the confirm password change link,
     *                                this value will be set for the user.
     *                                If this parameter is NOT provided, the user will be asked for a new password.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/authentication#change-password
     */
    public function dbconnectionsChangePassword(string $email, string $connection, ?string $password = null)
    {
        $data = [
            'client_id' => $this->client_id,
            'email' => $email,
            'connection' => $connection,
        ];

        if ($password !== null) {
            $data['password'] = $password;
        }

        return $this->apiClient->method('post')
            ->addPath('dbconnections', 'change_password')
            ->withBody($data)
            ->call();
    }
}
