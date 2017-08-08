<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\HttpClientBuilder;
use Auth0\SDK\API\Helpers\ResponseMediator;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\Exception\InvalidArgumentException;
use Auth0\SDK\Hydrator\ArrayHydrator;
use Auth0\SDK\Hydrator\Hydrator;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;

/**
 * Class to communicate with Auth0 Authentication API
 *
 * @link https://auth0.com/docs/api/authentication
 */
final class Authentication extends BaseApi
{
    /**
     * @var null|string
     */
    private $clientId;

    /**
     * @var null|string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string|null
     */
    private $audience;

    /**
     * @var string|null
     */
    private $scope;

    /**
     * @param string          $domain
     * @param string|null     $clientId
     * @param string|null     $clientSecret
     * @param string|null     $audience
     * @param string|null     $scope
     * @param HttpClient|null $client
     */
    public function __construct(
        $domain,
        $clientId = null,
        $clientSecret = null,
        $audience = null,
        $scope = null,
        HttpClient $client = null,
        Hydrator $hydrator = null
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->domain = $domain;
        $this->audience = $audience;
        $this->scope = $scope;
        $hydrator = $hydrator ?: new ArrayHydrator();

        parent::__construct((new HttpClientBuilder($domain, $client))->buildHttpClient(), $hydrator);
    }

    /**
     * Builds and returns the `/authorize` url in order to initialize a new authN/authZ transaction.
     *
     * @link https://auth0.com/docs/api/authentication#!#get--authorize_db
     *
     * @param string $responseType
     * @param string $redirectUri
     * @param string|null $connection
     * @param string|null $state
     * @param array $additionalParams
     *
     * @return string
     */
    public function getAuthorizeLink($responseType, $redirectUri, $connection = null, $state = null, array $additionalParams = [])
    {
        $additionalParams['response_type'] = $responseType;
        $additionalParams['redirect_uri'] = $redirectUri;
        $additionalParams['client_id'] = $this->clientId;

        if ($connection !== null) {
            $additionalParams['connection'] = $connection;
        }

        if ($state !== null) {
            $additionalParams['state'] = $state;
        }

        return sprintf('https://%s/authorize?%s', $this->domain, http_build_query($additionalParams));
    }

    /**
     * @param string $clientId
     * @param string $connection
     *
     * @return string
     */
    public function getSamlpLink($clientId, $connection = '')
    {
        return sprintf('https://%s/samlp/%s?connection=%s', $this->domain, $clientId, $connection);
    }

    /**
     * @param string $clientId
     *
     * @return string
     */
    public function getSamlpMetadataLink($clientId)
    {
        return sprintf('https://%s/samlp/metadata/%s', $this->domain, $clientId);
    }

    /**
     * @param string $clientId
     *
     * @return string
     */
    public function getWsfedLink($clientId)
    {
        return sprintf('https://%s/wsfed/%s', $this->domain, $clientId);
    }

    /**
     *
     * @return string
     */
    public function getWsfedMetadataLink()
    {
        return sprintf('https://%s/wsfed/FederationMetadata/2007-06/FederationMetadata.xml', $this->domain);
    }

    /**
     * Builds and returns the Logout url in order to termiate a SSO session.
     *
     * @link https://auth0.com/docs/api/authentication#logout
     *
     * @param string|null $returnTo
     * @param string|null $clientId
     * @param bool $federated
     *
     * @return string
     */
    public function getLogoutLink($returnTo = null, $clientId = null, $federated = false)
    {
        $params = [];
        if ($returnTo !== null) {
            $params['returnTo'] = $returnTo;
        }
        if ($clientId !== null) {
            $params['client_id'] = $clientId;
        }
        if ($federated) {
            $params['federated'] = '';
        }

        return sprintf('https://%s/v2/logout?%s', $this->domain, http_build_query($params));
    }

    /**
     * @param string $accessToken
     * @param string $connection
     * @param string $scope
     * @param array $additionalParams
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    public function authorizeWithAccessToken($accessToken, $connection, $scope = 'openid', array $additionalParams = [])
    {
        $data = array_merge($additionalParams, [
            'client_id'    => $this->clientId,
            'access_token' => $accessToken,
            'connection'   => $connection,
            'scope'        => $scope,
        ]);

        $response = $this->httpClient->post('/oauth/access_token', [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @param string $email
     * @param string $type
     * @param array $authParams
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    public function emailPasswordlessStart($email, $type, array $authParams = [])
    {
        $data = [
            'client_id'  => $this->clientId,
            'connection' => 'email',
            'send'       => $type,
            'email'      => $email,
        ];

        if (!empty($authParams)) {
            $data['authParams'] = $authParams;
        }

        $response = $this->httpClient->post('/passwordless/start', [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @param string $phoneNumber
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    public function smsPasswordlessStart($phoneNumber)
    {
        $data = [
            'client_id'    => $this->clientId,
            'connection'   => 'sms',
            'phone_number' => $phoneNumber,
        ];

        $response = $this->httpClient->post('/passwordless/start', [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @param string $accessToken
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    public function userInfo($accessToken)
    {
        $response = $this->httpClient->get('/userinfo', ['Authorization' => 'Bearer '.$accessToken]);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @param string $accessToken
     * @param string $userId
     * @param string $protocol
     * @param string $impersonatorId
     * @param string $clientId
     * @param array $additionalParameters
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    public function impersonate($accessToken, $userId, $protocol, $impersonatorId, $clientId, array $additionalParameters = [])
    {
        $data = [
            'protocol'             => $protocol,
            'impersonator_id'      => $impersonatorId,
            'client_id'            => $clientId,
            'additionalParameters' => $additionalParameters,
        ];

        $response = $this->httpClient->post(sprintf('/users/%s/impersonate', $userId), ['Authorization' => 'Bearer '.$accessToken], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * Makes a call to the `oauth/token` endpoint.
     *
     * @param string $grantType
     * @param array $options {
     *      @var string $client_id     Optional. Will use $this->clientId as default
     *      @var string $client_secret Optional. Only if grant type: client_credentials. Will use $this->clientId as default
     *      @var string $username      Optional. Only if grant type: password/password-realm
     *      @var string $password      Optional. Only if grant type: password/password-realm
     *      @var string $scope         Optional.
     *      @var string $audience      Optional.
     * }
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    private function oauthToken($grantType, array $options)
    {
        if (!isset($options['client_id'])) {
            $options['client_id'] = $this->clientId;
        }

        if (!isset($options['client_secret'])) {
            $options['client_secret'] = $this->clientSecret;
        }

        $options['grant_type'] = $grantType;

        $response = $this->httpClient->post('/oauth/token', [], json_encode($options));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `authorization_code` grant type.
     *
     * @param string $code
     * @param string $redirectUri
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    public function codeExchange($code, $redirectUri)
    {
        $options = [];

        $options['client_secret'] = $this->clientSecret;
        $options['redirect_uri'] = $redirectUri;
        $options['code'] = $code;

        return $this->oauthToken('authorization_code', $options);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password-realm` grant type.
     *
     * @param string $username
     * @param string $password
     * @param string $realm
     * @param string $scope
     * @param string $audience
     *
     * @throws InvalidArgumentException
     *
     *
     * @return array
     */
    public function login($username, $password, $realm, $scope = null, $audience = null)
    {
        $options = [];

        $options['username'] = $username;
        $options['password'] = $password;
        $options['realm'] = $realm;

        if (!empty($scope)) {
            $options['scope'] = $scope;
        }

        if (!empty($audience)) {
            $options['audience'] = $audience;
        }

        return $this->oauthToken('http://auth0.com/oauth/grant-type/password-realm', $options);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `password` grant type.
     *
     * @link https://auth0.com/docs/api-auth/grant/password
     *
     * @param string $username
     * @param string $password
     * @param string $scope
     * @param string $audience
     *
     * @throws InvalidArgumentException
     *
     * @return array
     */
    public function loginWithDefaultDirectory($username, $password, $scope = null, $audience = null)
    {
        $options = [];

        $options['username'] = $username;
        $options['password'] = $password;

        if (!empty($scope)) {
            $options['scope'] = $scope;
        }

        if (!empty($audience)) {
            $options['audience'] = $audience;
        }

        return $this->oauthToken('password', $options);
    }

    /**
     * Makes a call to the `oauth/token` endpoint with `client_credentials` grant type.
     *
     * @link https://auth0.com/docs/api-auth/grant/client-credentials
     *
     * @param array $options {
     *
     *      @var string $client_id     If none set, we use $this->clientId
     *      @var string $client_secret If none set, we use $this->clientSecret
     *      @var string $scope         Optional. If none set, we use $this->scope
     *      @var string $audience      Optional. If none set, we use $this->audience
     * }
     *
     * @throws InvalidArgumentException
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function clientCredentials(array $options = [])
    {
        if (!isset($options['client_secret'])) {
            $options['client_secret'] = $this->clientSecret;
        }

        if (empty($options['client_secret'])) {
            throw new InvalidArgumentException('client_secret is mandatory');
        }

        if (!isset($options['client_id'])) {
            $options['client_id'] = $this->clientId;
        }

        if (empty($options['client_id'])) {
            throw new InvalidArgumentException('client_id is mandatory');
        }

        if (!isset($options['scope'])) {
            $options['scope'] = $this->scope;
        }

        if (!isset($options['audience'])) {
            $options['audience'] = $this->audience;
        }

        return $this->oauthToken('client_credentials', $options);
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $connection
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function dbconnectionsSignup($email, $password, $connection)
    {
        $data = [
            'client_id'  => $this->clientId,
            'email'      => $email,
            'password'   => $password,
            'connection' => $connection,
        ];

        $response = $this->httpClient->post('/dbconnections/signup', [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @param string $email
     * @param string $connection
     * @param string|null $password
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function dbconnectionsChangePassword($email, $connection, $password = null)
    {
        $data = [
            'client_id'  => $this->clientId,
            'email'      => $email,
            'connection' => $connection,
        ];

        if ($password !== null) {
            $data['password'] = $password;
        }

        $response = $this->httpClient->post('/dbconnections/change_password', [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
