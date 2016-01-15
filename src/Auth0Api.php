<?php
namespace Auth0\SDK\API;

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

    $this->connections = new ApiConnections($this->apiClient);
    $this->clients = new ApiClients($this->apiClient);
    $this->users = new ApiUsers($this->apiClient);
    $this->rules = new ApiRules($this->apiClient);
  }

  protected static function setApiClient() {
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