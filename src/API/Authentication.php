<?php
/**
 * Authentication API wrapper
 *
 * @package Auth0\SDK\API
 *
 * @see https://auth0.com/docs/api/authentication
 */
namespace Auth0\SDK\API;

use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;
use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\API\Header\ForwardedFor;
use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\API\Helpers\InformationHeaders;

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
     * @var null|string
     */
    private $client_id;

    /**
     * Client Secret for the Auth0 Application.
     *
     * @var null|string
     */
    private $client_secret;

    /**
     * API audience identifier for the access token.
     *
     * @var null|string
     */
    private $audience;

    /**
     * Scopes to request during login.
     *
     * @var null|string
     */
    private $scope;

    /**
     * Options for the Guzzle HTTP client.
     *
     * @var array
     */
    private $guzzleOptions;

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
     * @param null|string $client_id     Client ID, found in Application settings.
     * @param null|string $client_secret Client Secret, found in Application settings.
     * @param null|string $audience      API audience identifier for the access token, found in API settings.
     * @param null|string $scope         Scopes to request during login.
     * @param array       $guzzleOptions Options for the Guzzle HTTP client.
     *
     * @link https://auth0.com/docs/scopes/current
     * @link http://docs.guzzlephp.org/en/stable/request-options.html
     */
    public function __construct(
        $domain,
        $client_id = null,
        $client_secret = null,
        $audience = null,
        $scope = null,
        $guzzleOptions = []
    )
    {
        $this->domain        = $domain;
        $this->client_id     = $client_id;
        $this->client_secret = $client_secret;
        $this->audience      = $audience;
        $this->scope         = $scope;
        $this->guzzleOptions = $guzzleOptions;

        $this->apiClient = new ApiClient( [
            'domain' => 'https://'.$this->domain,
            'basePath' => '/',
            'guzzleOptions' => $guzzleOptions
        ] );
    }

    /**
     * Builds and returns the authorization URL.
     *
     * @param string      $response_type     Response type requested, typically "code" for web application login.
     * @param string      $redirect_uri      Redirect URI for login and consent, must be white-listed.
     * @param null|string $connection        Connection parameter to send with the request.
     * @param null|string $state             State parameter to send with the request.
     * @param array       $additional_params Additional URL parameters to send with the request.
     *
     * @return string
     *
     * @link https://auth0.com/docs/api/authentication#authorize-application
     */
    public function get_authorize_link(
        $response_type,
        $redirect_uri,
        $connection = null,
        $state = null,
        array $additional_params = []
    )
    {
        $additional_params['response_type'] = $response_type;
        $additional_params['redirect_uri']  = $redirect_uri;
        $additional_params['client_id']     = $this->client_id;

        if ($connection !== null) {
            $additional_params['connection'] = $connection;
        }

        if ($state !== null) {
            $additional_params['state'] = $state;
        }

        return sprintf(
            'https://%s/authorize?%s',
            $this->domain,
            Psr7\build_query($additional_params)
        );
    }

    /**
     * Build and return a SAMLP link.
     *
     * @param null|string $client_id  Client ID to use, null to use the value set during class initialization.
     * @param string      $connection Connection parameter to add.
     *
     * @return string
     *
     * @link https://auth0.com/docs/connections/enterprise/samlp
     */
    public function get_samlp_link($client_id = null, $connection = '')
    {
        return sprintf(
            'https://%s/samlp/%s?connection=%s',
            $this->domain,
            empty($client_id) ? $this->client_id : $client_id,
            $connection
        );
    }

    /**
     * Build and return a SAMLP metadata link.
     *
     * @param null|string $client_id Client ID to use, null to use the value set during class initialization.
     *
     * @return string
     *
     * @link https://auth0.com/docs/connections/enterprise/samlp
     */
    public function get_samlp_metadata_link($client_id = null)
    {
        return sprintf(
            'https://%s/samlp/metadata/%s',
            $this->domain,
            empty($client_id) ? $this->client_id : $client_id
        );
    }

    /**
     * Build and return a WS-Federation link
     *
     * @param null|string $client_id Client ID to use, null to use the value set during class initialization.
     * @param array       $params    Request parameters for the WS-Fed request.
     *      - params.client-id The client-id of your application.
     *      - params.wtrealm   Can be used in place of client-id.
     *      - params.whr       The name of the connection (used to skip the login page).
     *      - params.wctx      Your application's state.
     *      - params.wreply    The callback URL.
     *
     * @return string
     *
     * @link https://auth0.com/docs/protocols/ws-fed
     */
    public function get_wsfed_link($client_id = null, array $params = [])
    {
        return sprintf(
            'https://%s/wsfed/%s?%s',
            $this->domain,
            empty($client_id) ? $this->client_id : $client_id,
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
    public function get_wsfed_metadata_link()
    {
        return 'https://'.$this->domain.'/wsfed/FederationMetadata/2007-06/FederationMetadata.xml';
    }

    /**
     * Builds and returns a logout URL to terminate an SSO session.
     *
     * @param null|string $returnTo  URL to return to after logging in; must be white-listed in Auth0.
     * @param null|string $client_id Client ID to use Application-specific returnTo URLs.
     * @param boolean     $federated Attempt a federated logout.
     *
     * @return string
     *
     * @link https://auth0.com/docs/api/authentication#logout
     */
    public function get_logout_link($returnTo = null, $client_id = null, $federated = false)
    {
        $params = [];

        if ($returnTo !== null) {
            $params['returnTo'] = $returnTo;
        }

        if ($client_id !== null) {
            $params['client_id'] = $client_id;
        }

        if ($federated) {
            $params['federated'] = '';
        }

        return sprintf(
            'https://%s/v2/logout?%s',
            $this->domain,
            Psr7\build_query($params)
        );
    }

    /**
     * Start passwordless login process for email
     *
     * @param string $email      Email address to use.
     * @param string $type       Use null or "link" to send a link, use "code" to send a verification code.
     * @param array  $authParams Link parameters (like scope, redirect_uri, protocol, response_type) to modify.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function email_passwordless_start($email, $type, array $authParams = [])
    {
        $data = [
            'client_id' => $this->client_id,
            'connection' => 'email',
            'send' => $type,
            'email' => $email,
        ];

        if (! empty($authParams)) {
            $data['authParams'] = $authParams;
        }

        return $this->apiClient->method('post')
        ->addPath('passwordless')
        ->addPath('start')
        ->withBody(json_encode($data))
        ->call();
    }

    /**
     * Start passwordless login process for SMS.
     *
     * @param string $phone_number Phone number to use.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function sms_passwordless_start($phone_number)
    {
        $data = [
            'client_id' => $this->client_id,
            'connection' => 'sms',
            'phone_number' => $phone_number,
        ];

        return $this->apiClient->method('post')
        ->addPath('passwordless')
        ->addPath('start')
        ->withBody(json_encode($data))
        ->call();
    }

    /**
     * Make an authenticated request to the /userinfo endpoint.
     *
     * @param string $access_token Bearer token to use for the request.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/authentication#user-profile
     */
    public function userinfo($access_token)
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
     *      - options.grant_type    Grant type to use; required.
     *      - options.client_id     Application Client ID; required.
     *      - options.client_secret Application Client Secret; required if token endpoint requires authentication.
     *      - options.scope         Access token scope requested.
     *      - options.audience      API audience identifier for access token.
     *
     * @return mixed
     *
     * @throws ApiException If grant_type is missing from $options.
     */
    public function oauth_token(array $options = [])
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
            ->addPath( 'oauth/token' )
            ->withBody(json_encode($options));

        if (isset($options['auth0_forwarded_for'])) {
            $request->withHeader( new ForwardedFor( $options['auth0_forwarded_for'] ) );
        }

        return $request->call();

    }

    /**
     * Makes a call to the `oauth/token` endpoint with `authorization_code` grant type
     *
     * @param string $code         Authorization code received during login.
     * @param string $redirect_uri Redirect URI sent with authorize request.
     *
     * @return mixed
     *
     * @throws ApiException If grant_type is missing.
     */
    public function code_exchange($code, $redirect_uri)
    {
        $options = [];

        $options['client_secret'] = $this->client_secret;
        $options['redirect_uri']  = $redirect_uri;
        $options['code']          = $code;
        $options['grant_type']    = 'authorization_code';

        return $this->oauth_token($options);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password-realm` grant type.
     *
     * @param array       $options    Options for this grant.
     *      - options.username Username or email of the user logging in; required.
     *      - options.password Password of the user logging in; required.
     *      - options.realm    Database realm to use; required.
     *      - options.scope    Access token scope requested.
     *      - options.audience API audience identifier for access token.
     * @param string|null $ip_address Pass in an IP address to set an Auth0-Forwarded-For header.
     *
     * @return mixed
     *
     * @throws ApiException If username, password, or realm are missing from $options.
     */
    public function login(array $options, $ip_address = null)
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

        if (! empty( $ip_address )) {
            $options['auth0_forwarded_for'] = $ip_address;
        }

        $options['grant_type'] = 'http://auth0.com/oauth/grant-type/password-realm';

        return $this->oauth_token($options);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password` grant type
     *
     * @param array       $options    Options for this grant.
     *      - options.username Username or email of the user logging in; required.
     *      - options.password Password of the user logging in; required.
     *      - options.scope    Access token scope requested.
     *      - options.audience API audience identifier for access token.
     * @param string|null $ip_address Pass in an IP address to set an Auth0-Forwarded-For header.
     *
     * @return mixed
     *
     * @throws ApiException If username or password is missing.
     *
     * @link https://auth0.com/docs/api-auth/grant/password
     */
    public function login_with_default_directory(array $options, $ip_address = null)
    {
        if (! isset($options['username'])) {
            throw new ApiException('username is mandatory');
        }

        if (! isset($options['password'])) {
            throw new ApiException('password is mandatory');
        }

        if (! empty( $ip_address )) {
            $options['auth0_forwarded_for'] = $ip_address;
        }

        $options['grant_type'] = 'password';

        return $this->oauth_token($options);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `client_credentials` grant type.
     *
     * TODO: MAJOR - Add a new ApiException for missing audience.
     *
     * @param array $options Information required for this grant.
     *      - options.client_id     Application Client ID.
     *      - options.client_secret Application Client Secret.
     *      - options.audience      API Audience requested.
     *
     * @return mixed
     *
     * @throws ApiException If client_id or client_secret are missing.
     *
     * @link https://auth0.com/docs/api-auth/grant/client-credentials
     */
    public function client_credentials(array $options)
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

        if (empty($options['client_id'])) {
            throw new ApiException('client_id is mandatory');
        }

        if (! isset($options['audience'])) {
            $options['audience'] = $this->audience;
        }

        $options['grant_type'] = 'client_credentials';

        return $this->oauth_token($options);
    }

    /**
     * Use a refresh token grant to get new tokens.
     *
     * @param string $refresh_token Refresh token to use.
     * @param array  $options       Array of options to override defaults.
     *
     * @return mixed
     *
     * @throws ApiException If $refresh_token, client_secret, or client_id is blank.
     *
     * @link https://auth0.com/docs/api/authentication#refresh-token
     */
    public function refresh_token($refresh_token, array $options = [])
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

        return $this->oauth_token($options);
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
    public function dbconnections_signup($email, $password, $connection)
    {
        $data = [
            'client_id' => $this->client_id,
            'email' => $email,
            'password' => $password,
            'connection' => $connection,
        ];

        return $this->apiClient->method('post')
        ->addPath('dbconnections')
        ->addPath('signup')
        ->withBody(json_encode($data))
        ->call();
    }

    /**
     * Send a change password email.
     * This endpoint only works for database connections.
     *
     * @param string      $email      Email for the user changing their password.
     * @param string      $connection The name of the database connection this user is in.
     * @param null|string $password   New password to use.
     *      If this parameter is provided, when the user clicks on the confirm password change link,
     *      this value will be set for the user.
     *      If this parameter is NOT provided, the user will be asked for a new password.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/authentication#change-password
     */
    public function dbconnections_change_password(
        $email,
        $connection,
        $password = null
    )
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
        ->addPath('dbconnections')
        ->addPath('change_password')
        ->withBody(json_encode($data))
        ->call();
    }

    /*
     * Deprecated
     */

    // phpcs:disable
    /**
     * Set an ApiClient for use in this object
     *
     * @deprecated 5.4.0, not used and no replacement provided.
     *
     * @return void
     *
     * @codeCoverageIgnore - Deprecated
     */
    protected function setApiClient()
    {
        $apiDomain = "https://{$this->domain}";

        $client = new ApiClient(
            [
                'domain' => $apiDomain,
                'basePath' => '/',
                'guzzleOptions' => $this->guzzleOptions
            ]
        );

        $this->apiClient = $client;
    }

    /**
     * Verify SMS code
     *
     * @deprecated 5.4.0, legacy authentication pipeline, no alternative provided.
     *
     * @param string $phone_number
     * @param string $code
     * @param string $scope
     *
     * @return mixed
     *
     * @throws ApiException
     *
     * @codeCoverageIgnore - Deprecated
     */
    public function sms_code_passwordless_verify($phone_number, $code, $scope = 'openid')
    {
        return $this->authorize_with_ro($phone_number, $code, $scope, 'sms');
    }

    /**
     * Verify email code
     *
     * @deprecated 5.4.0, legacy authentication pipeline, no alternative provided.
     *
     * @param string $email
     * @param string $code
     * @param string $scope
     *
     * @return mixed
     *
     * @throws ApiException
     *
     * @codeCoverageIgnore - Deprecated
     */
    public function email_code_passwordless_verify($email, $code, $scope = 'openid')
    {
        return $this->authorize_with_ro($email, $code, $scope, 'email');
    }

    /**
     * Obtain an impersonation URL to login as another user.
     * Impersonation functionality may be disabled by default for your tenant.
     *
     * @deprecated 5.4.0, legacy authentication pipeline, no alternative provided.
     *
     * @param string $access_token
     * @param string $user_id
     * @param string $protocol
     * @param string $impersonator_id
     * @param string $client_id
     * @param array  $additionalParameters
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/authentication#impersonation
     *
     * @codeCoverageIgnore - Deprecated
     */
    public function impersonate(
        $access_token,
        $user_id,
        $protocol,
        $impersonator_id,
        $client_id,
        array $additionalParameters = []
    )
    {
        $data = [
            'protocol' => $protocol,
            'impersonator_id' => $impersonator_id,
            'client_id' => $client_id,
            'additionalParameters' => $additionalParameters,
        ];

        return $this->apiClient->method('post')
            ->addPath('users', $user_id)
            ->addPath('impersonate')
            ->withHeader(new AuthorizationBearer($access_token))
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Authorize using an access token
     *
     * @deprecated 5.1.1, disabled by default for new tenants as of 8 June
     * 2017. Open the browser to do social authentication instead, which is
     * what Google and Facebook are recommending.
     *
     * @param string $access_token
     * @param string $connection
     * @param string $scope
     * @param array  $additional_params
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/authentication#social-with-provider-s-access-token
     * @see https://developers.googleblog.com/2016/08/modernizing-oauth-interactions-in-native-apps.html
     * @see https://auth0.com/docs/api-auth/intro
     *
     * @codeCoverageIgnore - Deprecated
     */
    public function authorize_with_accesstoken(
        $access_token,
        $connection,
        $scope = 'openid',
        array $additional_params = []
    )
    {
        $data = array_merge(
            $additional_params,
            [
                'client_id' => $this->client_id,
                'access_token' => $access_token,
                'connection' => $connection,
                'scope' => $scope,
            ]
        );

        return $this->apiClient->method('post')
            ->addPath('oauth')
            ->addPath('access_token')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * DEPRECATED - This endpoint is part of the legacy authentication pipeline and
     * has been replaced in favor of the Password Grant. For more information on the
     * latest authentication pipeline refer to Introducing OIDC Conformant
     * Authentication.
     *
     * @deprecated 5.0.0, use `login` instead. Use only for passwordless verify
     *
     * @param string      $username
     * @param string      $password
     * @param string      $scope
     * @param null|string $connection
     * @param null|string $id_token
     * @param null|string $device
     *
     * @return mixed
     *
     * @throws ApiException
     *
     * @see https://auth0.com/docs/api/authentication#resource-owner
     * @see https://auth0.com/docs/api-auth/intro
     *
     * @codeCoverageIgnore - Deprecated
     */
    public function authorize_with_ro(
        $username,
        $password,
        $scope = 'openid',
        $connection = null,
        $id_token = null,
        $device = null
    )
    {
        $data = [
            'client_id' => $this->client_id,
            'username' => $username,
            'password' => $password,
            'scope' => $scope,
        ];
        if ($device !== null) {
            $data['device'] = $device;
        }

        if ($id_token !== null) {
            $data['id_token']   = $id_token;
            $data['grant_type'] = 'urn:ietf:params:oauth:grant-type:jwt-bearer';
        } else {
            if ($connection === null) {
                throw new ApiException(
                    'You need to specify a connection for grant_type=password authentication'
                );
            }

            $data['grant_type'] = 'password';
            $data['connection'] = $connection;
        }

        return $this->apiClient->method('post')
            ->addPath('oauth')
            ->addPath('ro')
            ->withBody(json_encode($data))
            ->call();
    }
    // phpcs:enable
}
