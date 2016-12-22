<?php
namespace Auth0\SDK\API;

use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;
use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\Exception\ApiException;
use GuzzleHttp\Psr7;

class Authentication {

  private $client_id;
  private $client_secret;
  private $domain;
  private $apiClient;
  private $guzzleOptions;

  public function __construct($domain, $client_id = null, $client_secret = null, $guzzleOptions = []) {

    $this->client_id = $client_id;
    $this->client_secret = $client_secret;
    $this->domain = $domain;
    $this->guzzleOptions = $guzzleOptions;

    $this->setApiClient();

    if (!empty($client_id) && !empty($client_secret)) {
      $this->access_token = $this->oauth_token($client_id, $client_secret);
    }

  }

  protected function setApiClient() {
    $apiDomain = "https://{$this->domain}";

    $client = new ApiClient([
        'domain' => $apiDomain,
        'basePath' => '/',
        'guzzleOptions' => $this->guzzleOptions
    ]);

    $this->apiClient = $client;
  }

  public function get_oauth_client($client_secret, $redirect_uri, $extra_params = []) {

    if (empty($this->client_id)) {
      throw new ApiException('client_id was not set.');
    }

    $extra_params['domain'] = $this->domain;
    $extra_params['client_id'] = $this->client_id;
    $extra_params['client_secret'] = $client_secret;
    $extra_params['redirect_uri'] = $redirect_uri;

    return new Oauth2Client($extra_params);
  }

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

  public function get_logout_link($returnTo = null, $client_id = null) {

    $params = [];
    if ($returnTo !== null) {
      $params['returnTo'] = $returnTo;
    }
    if ($client_id !== null) {
      $params['client_id'] = $client_id;
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

    return $this->apiClient->post()
      ->oauth()
      ->access_token()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();
  }

  public function authorize_with_ro($username, $password, $scope = 'openid', $connection = null, $id_token = null, $device = null){

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
      $data['id_token'] = $id_token;
      $data['grant_type'] = 'urn:ietf:params:oauth:grant-type:jwt-bearer';
    } else {
      if ($connection === null) {
        throw new ApiException('You need to specify a conection for grant_type=password authentication');
      }
      $data['grant_type'] = 'password';
      $data['connection'] = $connection;
    }

    return $this->apiClient->post()
      ->oauth()
      ->ro()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();
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

    return $this->apiClient->post()
      ->passwordless()
      ->start()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();
  }

  public function sms_passwordless_start($phone_number){

    $data = [
      'client_id' => $this->client_id,
      'connection' => 'sms',
      'phone_number' => $phone_number,
    ];

    return $this->apiClient->post()
      ->passwordless()
      ->start()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();
  }

  public function sms_code_passwordless_verify($phone_number, $code, $scope = 'openid'){

    return $this->authorize_with_ro($phone_number, $code, $scope, 'sms');

  }

  public function email_code_passwordless_verify($email, $code, $scope = 'openid'){

    return $this->authorize_with_ro($email, $code, $scope, 'email');

  }

  public function userinfo($access_token){

    return $this->apiClient->get()
      ->userinfo()
      ->withHeader(new ContentType('application/json'))
      ->withHeader(new AuthorizationBearer($access_token))
      ->call();

  }

  public function tokeninfo($id_token){

    return $this->apiClient->get()
      ->tokeninfo()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode([
        'id_token' => $id_token
      ]))
      ->call();

  }

  public function delegation($id_token, $type, $target_client_id, $api_type, $aditional_params = [], $scope = 'openid', $grant_type = 'urn:ietf:params:oauth:grant-type:jwt-bearer'){

    if (! in_array($type, ['id_token', 'refresh_token'])) {
      throw new ApiException('Delegation type must be id_token or refresh_token');
    }

    $data = array_merge($aditional_params,[
      'client_id' => $this->client_id,
      'target' => $target_client_id,
      'grant_type' => $grant_type,
      'scope' => $scope,
      'api_type' => $api_type,
      $type => $id_token,
    ]);

    return $this->apiClient->post()
      ->delegation()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();

  }

  public function get_access_token() {
    return $this->access_token;
  }

  public function impersonate($user_id, $protocol, $impersonator_id, $client_id, $additionalParameters=[]){

    $data = [
      'protocol' => $protocol,
      'impersonator_id' => $impersonator_id,
      'client_id' => $client_id,
      'additionalParameters' => $additionalParameters,
    ];

    return $this->apiClient->post()
      ->users($user_id)
      ->impersonate()
      ->withHeader(new ContentType('application/json'))
      ->withHeader(new AuthorizationBearer($this->access_token['access_token']))
      ->withBody(json_encode($data))
      ->call();

  }

  /**
   * Makes a call to the `oauth/token` endpoint
   *
   * @method oauthToken
   * @param {Object} options:
   * @param {Object} options.grantType
   * @param {Object} options.client_id
   * @param {Object} options.client_secret [optional] Only if grant type: client_credentials
   * @param {Object} options.username  [optional] Only if grant type: password/password-realm
   * @param {Object} options.password  [optional] Only if grant type: password/password-realm
   * @param {Object} options.scope     [optional]
   * @param {Object} options.audience  [optional]
   * @param {Function} cb
   */
  public function oauth_token($options) {
    if (! isset($options['client_id'])) {
      $options['client_id'] = $this->client_id;
    }

    if (! isset($options['grant_type'])) {
      throw new ApiException('client_id is mandatory');
    }

    return $this->apiClient->post()
      ->oauth()
      ->token()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($options))
      ->call();
  }

  /**
   * Makes a call to the `oauth/token` endpoint with `password-realm` grant type
   *
   * @method login_with_default_directory
   * @param {Object} options:
   * @param {Object} options.username
   * @param {Object} options.password
   * @param {Object} options.realm
   * @param {Object} options.scope [optional]
   * @param {Object} options.scope [audience]
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
   * @method login_with_default_directory
   * @param {Object} options: https://auth0.com/docs/api-auth/grant/client-credentials
   * @param {Object} options.client_id
   * @param {Object} options.client_secret
   * @param {Object} options.scope [optional]
   * @param {Object} options.scope [audience]
   */
  public function client_credentials($options) {
    if (! isset($options['client_secret'])) {
      throw new ApiException('client_secret is mandatory');
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

    return $this->apiClient->post()
      ->dbconnections()
      ->signup()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();
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

    return $this->apiClient->post()
      ->dbconnections()
      ->change_password()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();
  }
}
