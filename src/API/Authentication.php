<?php
namespace Auth0\SDK\API;

use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;
use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\Exception\ApiException;
use GuzzleHttp\Psr7;

class Authentication {

    /**
     * @var string
     */
  private $client_id;

    /**
     * @var string
     */
  private $client_secret;

    /**
     * @var string
     */
  private $domain;

    /**
     * @var ApiClient
     */
  private $apiClient;

    /**
     * @var array
     */
  private $guzzleOptions;

    /**
     * Authentication constructor.
     * @param string $domain
     * @param string|null $client_id
     * @param string|null $client_secret
     * @param array $guzzleOptions
     */
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

    /**
     * @param string $client_secret
     * @param string $redirect_uri
     * @param array $extra_params
     * @return Oauth2Client
     * @throws ApiException
     */
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

    /**
     * @param string $response_type
     * @param string $redirect_uri
     * @param null|string $connection
     * @param null|string $state
     * @param array $aditional_params
     * @return string
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

    /**
     * @param string $client_id
     * @param string $connection
     * @return string
     */
  public function get_samlp_link($client_id, $connection = '') {

    return "https://{$this->domain}/samlp/$client_id?connection=$connection";

  }

    /**
     * @param string $client_id
     * @return string
     */
  public function get_samlp_metadata_link($client_id) {

    return "https://{$this->domain}/samlp/metadata/$client_id";

  }

    /**
     * @param string $client_id
     * @return string
     */
  public function get_wsfed_link($client_id) {

    return "https://{$this->domain}/wsfed/$client_id";

  }

    /**
     * @return string
     */
  public function get_wsfed_metadata_link() {

    return "https://{$this->domain}/wsfed/FederationMetadata/2007-06/FederationMetadata.xml";

  }

    /**
     * @param null|string $returnTo
     * @param null|string $client_id
     * @return string
     */
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

    /**
     * @param string $access_token
     * @param string $connection
     * @param string $scope
     * @param array $aditional_params
     * @return mixed
     */
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

    /**
     * @param string $username
     * @param string $password
     * @param string $scope
     * @param null|string $connection
     * @param null|string $id_token
     * @param null|string $device
     * @return mixed
     * @throws ApiException
     */
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

    /**
     * @param string $email
     * @param string $type
     * @param array $authParams
     * @return mixed
     */
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

    /**
     * @param string $phone_number
     * @return mixed
     */
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

    /**
     * @param string $phone_number
     * @param string $code
     * @param string $scope
     * @return mixed
     */
  public function sms_code_passwordless_verify($phone_number, $code, $scope = 'openid'){

    return $this->authorize_with_ro($phone_number, $code, $scope, 'sms');

  }

    /**
     * @param string $email
     * @param string $code
     * @param string $scope
     * @return mixed
     */
  public function email_code_passwordless_verify($email, $code, $scope = 'openid'){

    return $this->authorize_with_ro($email, $code, $scope, 'email');

  }

    /**
     * @param string$access_token
     * @return mixed
     */
  public function userinfo($access_token){

    return $this->apiClient->get()
      ->userinfo()
      ->withHeader(new ContentType('application/json'))
      ->withHeader(new AuthorizationBearer($access_token))
      ->call();

  }

    /**
     * @param string $id_token
     * @return mixed
     */
  public function tokeninfo($id_token){

    return $this->apiClient->get()
      ->tokeninfo()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode([
        'id_token' => $id_token
      ]))
      ->call();

  }

    /**
     * @param string $id_token
     * @param string $type
     * @param string $target_client_id
     * @param string $api_type
     * @param array $aditional_params
     * @param string $scope
     * @param string $grant_type
     * @return mixed
     * @throws ApiException
     */
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

    /**
     * @return string
     */
  public function get_access_token() {
    return $this->access_token;
  }

    /**
     * @param string $user_id
     * @param string $protocol
     * @param string $impersonator_id
     * @param string $client_id
     * @param array $additionalParameters
     * @return mixed
     */
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
     * @param string$client_id
     * @param string$client_secret
     * @param string $grant_type
     * @param null|string $code
     * @param null|string $audience
     * @param null|string $scope
     * @return mixed
     */
  public function oauth_token($client_id, $client_secret, $grant_type = 'client_credentials', $code = null, $audience = null, $scope = null) {

    $data = [
      'client_id' => $client_id,
      'client_secret' => $client_secret,
      'grant_type' => $grant_type,
    ];

    if ($audience !== null) {
      $data['audience'] = $audience;
    }

    if ($scope !== null) {
      $data['scope'] = $scope;
    }

    if ($code !== null) {
      $data['code'] = $code;
    }

    return $this->apiClient->post()
      ->oauth()
      ->token()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();
  }

    /**
     * @param string $email
     * @param string $password
     * @param string $connection
     * @return mixed
     */
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

    /**
     * @param string $email
     * @param string $connection
     * @param null|string $password
     * @return mixed
     */
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
