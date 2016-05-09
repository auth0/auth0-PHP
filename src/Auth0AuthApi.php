<?php
namespace Auth0\SDK;

use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\API\Helpers\ApiClient;

class Auth0AuthApi {

  private $client_id;
  private $client_secret;
  private $domain;
  private $apiClient;
  private $guzzleOptions;

  public function __construct($domain, $client_id, $client_secret = null, $guzzleOptions = []) {
    $this->client_id = $client_id;
    $this->client_secret = $client_secret;
    $this->domain = $domain;
    $this->guzzleOptions = $guzzleOptions;
    
    $this->setApiClient();
  }

  protected function setApiClient() {
    $apiDomain = "https://{$this->domain}";

    $client = new ApiClient([
        'domain' => $apiDomain,
        'basePath' => '/api/v2/',
        'guzzleOptions' => $this->guzzleOptions
    ]);

    $this->apiClient = $client;
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

    $query_string = implode('&', array_map(function($key,$value){
      return "$key=$value";
    }, array_keys($aditional_params), $aditional_params));

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

    $data = array_merge($aditional_params, [
      'client_id' => $this->client_id,
      'username' => $username,
      'password' => $password,
      'scope' => $scope,
    ]);

    if ($id_token !== null) {
      $aditional_params['id_token'] = $id_token;
      $aditional_params['device'] = $device;
      $aditional_params['grant_type'] = 'urn:ietf:params:oauth:grant-type:jwt-bearer';
    } else {
      if ($connection === null) {
        throw new ApiException();
      }
      $aditional_params['grant_type'] = 'password';
      $aditional_params['connection'] = $connection;
    }

    return $this->apiClient->post()
      ->oauth()
      ->ro()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($aditional_params))
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
      ->withBody(json_encode($aditional_params))
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
      ->withBody(json_encode($aditional_params))
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
      ->call([
          'id_token' => $id_token
        ]);

  }
}