<?php
namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\HttpClientBuilder;
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

use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;

class Management {

    /**
     * @var string
     */
  private $token;

    /**
     * @var string
     */
  private $domain;

    /**
     * @var HttpMethodsClient
     */
  private $httpClient;

    /**
     * @var array
     */
  private $guzzleOptions;

    /**
     * @var Blacklists
     */
  public $blacklists;

    /**
     * @var Clients
     */
  public $clients;

    /**
     * @var ClientGrants
     */
  public $client_grants;

    /**
     * @var Connections
     */
  public $connections;

    /**
     * @var DeviceCredentials
     */
  public $deviceCredentials;

    /**
     * @var Emails
     */
  public $emails;

    /**
     * @var Jobs
     */
  public $jobs;

    /**
     * @var Logs
     */
  public $logs;

    /**
     * @var Rules
     */
  public $rules;

    /**
     * @var ResourceServers
     */
  public $resource_servers;

    /**
     * @var Stats
     */
  public $stats;

    /**
     * @var Tenants
     */
  public $tenants;

    /**
     * @var Tickets
     */
  public $tickets;

    /**
     * @var UserBlocks
     */
  public $userBlocks;

    /**
     * @var Users
     */
  public $users;

    /**
     * Management constructor.
     *
     * @param string $token
     * @param string $domain
     * @param HttpClient|null $client
     */
  public function __construct($token, $domain, HttpClient $client = null) {
    $this->token = $token;
    $this->domain = $domain;

    $httpClientBuilder = new HttpClientBuilder($domain.'/api/v2/', $client);
    $httpClientBuilder->addHeader('Authorization', 'Bearer '.$token);
    $this->httpClient = $httpClientBuilder->buildHttpClient();

    $this->blacklists = new Blacklists($this->httpClient);
    $this->clients = new Clients($this->httpClient);
    $this->client_grants = new ClientGrants($this->httpClient);
    $this->connections = new Connections($this->httpClient);
    $this->deviceCredentials = new DeviceCredentials($this->httpClient);
    $this->emails = new Emails($this->httpClient);
    $this->jobs = new Jobs($this->httpClient);
    $this->logs = new Logs($this->httpClient);
    $this->rules = new Rules($this->httpClient);
    $this->resource_servers = new ResourceServers($this->httpClient);
    $this->stats = new Stats($this->httpClient);
    $this->tenants = new Tenants($this->httpClient);
    $this->tickets = new Tickets($this->httpClient);
    $this->userBlocks = new UserBlocks($this->httpClient);
    $this->users = new Users($this->httpClient);
  }
}