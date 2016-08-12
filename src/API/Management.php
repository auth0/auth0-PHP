<?php
namespace Auth0\SDK\Api;

use Auth0\SDK\API\Management\Blacklists;
use Auth0\SDK\API\Management\Clients;
use Auth0\SDK\API\Management\ClientGrants;
use Auth0\SDK\API\Management\Connections;
use Auth0\SDK\API\Management\DeviceCredentials;
use Auth0\SDK\API\Management\Emails;
use Auth0\SDK\API\Management\Jobs;
use Auth0\SDK\API\Management\Logs;
use Auth0\SDK\API\Management\ResourceServers;
use Auth0\SDK\API\Management\Rules;
use Auth0\SDK\API\Management\Stats;
use Auth0\SDK\API\Management\Tenants;
use Auth0\SDK\API\Management\Tickets;
use Auth0\SDK\API\Management\UserBlocks;
use Auth0\SDK\API\Management\Users;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;

class Management {

  private $token;
  private $domain;
  private $apiClient;
  private $guzzleOptions;

  public $blacklists;
  public $clients;
  public $client_grants;
  public $connections;
  public $deviceCredentials;
  public $emails;
  public $jobs;
  public $logs;
  public $rules;
  public $resource_servers;
  public $stats;
  public $tenants;
  public $tickets;
  public $userBlocks;
  public $users;

  public function __construct($token, $domain, $guzzleOptions = []) {
    $this->token = $token;
    $this->domain = $domain;
    $this->guzzleOptions = $guzzleOptions;
    
    $this->setApiClient();

    $this->blacklists = new Blacklists($this->apiClient);
    $this->clients = new Clients($this->apiClient);
    $this->client_grants = new ClientGrants($this->apiClient);
    $this->connections = new Connections($this->apiClient);
    $this->deviceCredentials = new DeviceCredentials($this->apiClient);
    $this->emails = new Emails($this->apiClient);
    $this->jobs = new Jobs($this->apiClient);
    $this->logs = new Logs($this->apiClient);
    $this->rules = new Rules($this->apiClient);
    $this->resource_servers = new ResourceServers($this->apiClient);
    $this->stats = new Stats($this->apiClient);
    $this->tenants = new Tenants($this->apiClient);
    $this->tickets = new Tickets($this->apiClient);
    $this->userBlocks = new UserBlocks($this->apiClient);
    $this->users = new Users($this->apiClient);
  }

  protected function setApiClient() {
    $apiDomain = "https://{$this->domain}";

    $client = new ApiClient([
        'domain' => $apiDomain,
        'basePath' => '/api/v2/',
        'guzzleOptions' => $this->guzzleOptions,
        'headers' => [
          new AuthorizationBearer($this->token)
        ]
    ]);

    $this->apiClient = $client;
  }
}