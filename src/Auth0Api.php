<?php
namespace Auth0\SDK;

use Auth0\SDK\API\Connections;
use Auth0\SDK\API\Clients;
use Auth0\SDK\API\Users;
use Auth0\SDK\API\Rules;

use Auth0\SDK\API\Helpers\ApiCLient;
use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;

class Auth0Api {

  private $token;
  private $domain;
  private $apiClient;

  public $connections;
  public $clients;
  public $users;
  public $rules;

  public function __construct($token, $domain) {
    $this->token = $token;
    $this->domain = $domain;
    
    $this->setApiClient();

    $this->connections = new Connections($this->apiClient);
    $this->clients = new Clients($this->apiClient);
    $this->users = new Users($this->apiClient);
    $this->rules = new Rules($this->apiClient);
  }

  protected function setApiClient() {
    $apiDomain = "https://{$this->domain}";

    $client = new ApiClient([
        'domain' => $apiDomain,
        'basePath' => '/api/v2',
        'headers' => [
          new AuthorizationBearer($this->token)
        ]
    ]);

    $this->apiClient = $client;
  }
}