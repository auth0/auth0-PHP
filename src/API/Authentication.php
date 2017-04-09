<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\HttpClientBuilder;
use Auth0\SDK\API\Helpers\ResponseMediator;
use Auth0\SDK\Exception\ApiException;
use GuzzleHttp\Psr7;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;

class Authentication {

  private $client_id;
  private $client_secret;
  private $domain;

    /**
     * @var HttpMethodsClient
     */
  private $httpClient;

    /**
     *
     * @param string      $domain
     * @param string|null $client_id
     * @param string|null $client_secret
     * @param string|null $audience
     * @param string|null $scope
     * @param HttpClient|null $client
     */
  public function __construct($domain, $client_id = null, $client_secret = null, $audience = null, $scope = null, HttpClient $client = null) {

    $this->client_id = $client_id;
    $this->client_secret = $client_secret;
    $this->domain = $domain;
    $this->audience = $audience;
    $this->scope = $scope;

    $this->httpClient = (new HttpClientBuilder($domain, $client))->buildHttpClient();
  }

  /**
   * Builds and returns the `/authorize` url in order to initialize a new authN/authZ transaction
   *
   * @method get_authorize_link https://auth0.com/docs/api/authentication#!#get--authorize_db
   * @param {String} response_type
   * @param {String} redirect_uri
   * @param {String} connection [optional]
   * @param {String} state      [optional]
   * @param {Object} aditional_params      [optional]
   */
  public function get_authorize_link($response_type, $redirect_uri, $connection = null, $state = null, $aditional_params = []) {

    $aditional_params['response_type'] = $response_type;
    $aditional_params['redirect_uri'] = $redirect_uri;
    $aditional_params['client_id'] = $this->client_id;

    if($connection !== null) {
      $aditional_params['connection'] = $connection;
    }

    if($state !== null) {
      $aditional_params['state'] = $state;
    }

    $query_string = Psr7\build_query($aditional_params);

    return "https://{$this->domain}/authorize?$query_string";
  }

  public function get_samlp_link($client_id, $connection = '') {

    return "https://{$this->domain}/samlp/$client_id?connection=$connection";

  }

  public function get_samlp_metadata_link($client_id) {

    return "https://{$this->domain}/samlp/metadata/$client_id";

  }

  public function get_wsfed_link($client_id) {

    return "https://{$this->domain}/wsfed/$client_id";

  }

  public function get_wsfed_metadata_link() {

    return "https://{$this->domain}/wsfed/FederationMetadata/2007-06/FederationMetadata.xml";

  }

  /**
   * Builds and returns the Logout url in order to termiate a SSO session
   *
   * @method get_logout_link https://auth0.com/docs/api/authentication#logout
   * @param {String} returnTo
   * @param {String} client_id
   * @param {Boolean} federated
   */
  public function get_logout_link($returnTo = null, $client_id = null, $federated = false) {

    $params = [];
    if ($returnTo !== null) {
      $params['returnTo'] = $returnTo;
    }
    if ($client_id !== null) {
      $params['client_id'] = $client_id;
    }
    if ($federated) {
      $params['federated'] = "";
    }

    $query_string = Psr7\build_query($params);

    return "https://{$this->domain}/v2/logout?$query_string";
  }

  public function authorize_with_accesstoken($access_token, $connection, $scope = 'openid', $aditional_params = []){

    $data = array_merge($aditional_params, [
      'client_id' => $this->client_id,
      'access_token' => $access_token,
      'connection' => $connection,
      'scope' => $scope,
    ]);

    $response = $this->httpClient->post('/oauth/access_token', [], json_encode($data));

    return ResponseMediator::getContent($response);
  }

  public function email_passwordless_start($email, $type, $authParams = []){

    $data = [
      'client_id' => $this->client_id,
      'connection' => 'email',
      'send' => $type,
      'email' => $email,
    ];

    if (! empty($authParams)) {
      $data['authParams'] = $authParams;
    }

    $response = $this->httpClient->post('/passwordless/start', [], json_encode($data));

    return ResponseMediator::getContent($response);
  }

  public function sms_passwordless_start($phone_number){

    $data = [
      'client_id' => $this->client_id,
      'connection' => 'sms',
      'phone_number' => $phone_number,
    ];


    $response = $this->httpClient->post('/passwordless/start', [], json_encode($data));

    return ResponseMediator::getContent($response);

  }

  /**
   * @param $accessToken
   *
   * @return array|string
   */
  public function userinfo($accessToken)
  {
      $response = $this->httpClient->get('/userinfo', ['Authorization' => 'Bearer '.$accessToken], json_encode($data));

      return ResponseMediator::getContent($response);
  }

  public function impersonate($access_token, $user_id, $protocol, $impersonator_id, $client_id, $additionalParameters=[]){

    $data = [
      'protocol' => $protocol,
      'impersonator_id' => $impersonator_id,
      'client_id' => $client_id,
      'additionalParameters' => $additionalParameters,
    ];

    $response = $this->httpClient->post(sprintf('/users/%s/impersonate', $user_id), ['Authorization' => 'Bearer '.$access_token], json_encode($data));

    return ResponseMediator::getContent($response);
  }

  /**
   * Makes a call to the `oauth/token` endpoint
   *
   * @method oauth_token
   * @param {Object} options:
   * @param {Object} options.grantType
   * @param {Object} options.client_id
   * @param {Object} options.client_secret [optional] Only if grant type: client_credentials
   * @param {Object} options.username  [optional] Only if grant type: password/password-realm
   * @param {Object} options.password  [optional] Only if grant type: password/password-realm
   * @param {Object} options.scope     [optional]
   * @param {Object} options.audience  [optional]
   */
  public function oauth_token($options = []) {
    if (! isset($options['client_id'])) {
      $options['client_id'] = $this->client_id;
    }

    if (! isset($options['client_secret'])) {
      $options['client_secret'] = $this->client_secret;
    }

    if (! isset($options['grant_type'])) {
      throw new ApiException('grant_type is mandatory');
    }

    $response = $this->httpClient->post('/oauth/token', [], json_encode($options));

    return ResponseMediator::getContent($response);
  }

  /**
   * Makes a call to the `oauth/token` endpoint with `authorization_code` grant type
   *
   * @method code_exchange
   * @param {Object} code
   */
  public function code_exchange($code, $redirect_uri) {
    $options = [];

    $options['client_secret'] = $this->client_secret;
    $options['redirect_uri'] = $redirect_uri;
    $options['code'] = $code;
    $options['grant_type'] = 'authorization_code';

    return $this->oauth_token($options);
  }

  /**
   * Makes a call to the `oauth/token` endpoint with `password-realm` grant type
   *
   * @method login
   * @param {Object} options:
   * @param {Object} options.username
   * @param {Object} options.password
   * @param {Object} options.realm
   * @param {Object} options.scope [optional]
   * @param {Object} options.audience [optional]
   */
  public function login($options) {
    if (! isset($options['username'])) {
      throw new ApiException('username is mandatory');
    }

    if (! isset($options['password'])) {
      throw new ApiException('password is mandatory');
    }

    if (! isset($options['realm'])) {
      throw new ApiException('realm is mandatory');
    }

    $options['grant_type'] = 'http://auth0.com/oauth/grant-type/password-realm';

    return $this->oauth_token($options);
  }

  /**
   * Makes a call to the `oauth/token` endpoint with `password` grant type
   *
   * @method login_with_default_directory
   * @param {Object} options: https://auth0.com/docs/api-auth/grant/password
   * @param {Object} options.username
   * @param {Object} options.password
   * @param {Object} options.scope [optional]
   * @param {Object} options.scope [audience]
   */
  public function login_with_default_directory($options) {
    if (! isset($options['username'])) {
      throw new ApiException('username is mandatory');
    }

    if (! isset($options['password'])) {
      throw new ApiException('password is mandatory');
    }

    $options['grant_type'] = 'password';

    return $this->oauth_token($options);
  }

  /**
   * Makes a call to the `oauth/token` endpoint with `client_credentials` grant type
   *
   * @method client_credentials
   * @param {Object} options: https://auth0.com/docs/api-auth/grant/client-credentials
   * @param {Object} options.client_id
   * @param {Object} options.client_secret
   * @param {Object} options.scope [optional]
   * @param {Object} options.audience [optional]
   */
  public function client_credentials($options) {
    if (!isset($options['client_secret'])) {
      $options['client_secret'] = $this->client_secret;
    }
    if (empty($options['client_secret'])) {
      throw new ApiException('client_secret is mandatory');
    }

    if (!isset($options['client_id'])) {
      $options['client_id'] = $this->client_id;
    }
    if (empty($options['client_id'])) {
      throw new ApiException('client_id is mandatory');
    }

    if (!isset($options['scope'])) {
      $options['scope'] = $this->scope;
    }
    if (!isset($options['audience'])) {
      $options['audience'] = $this->audience;
    }

    $options['grant_type'] = 'client_credentials';

    return $this->oauth_token($options);
  }

  public function dbconnections_signup($email, $password, $connection) {

    $data = [
      'client_id' => $this->client_id,
      'email' => $email,
      'password' => $password,
      'connection' => $connection,
    ];


    $response = $this->httpClient->post('/dbconnections/signup', [], json_encode($data));

    return ResponseMediator::getContent($response);
  }

  public function dbconnections_change_password($email, $connection, $password = null) {

    $data = [
      'client_id' => $this->client_id,
      'email' => $email,
      'connection' => $connection,
    ];

    if ($password !== null) {
      $data['password'] = $password;
    }

    $response = $this->httpClient->post('/dbconnections/change_password', [], json_encode($data));

    return ResponseMediator::getContent($response);
  }
}