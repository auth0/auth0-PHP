<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\HttpClientBuilder;
use Auth0\SDK\API\Management\Blacklists;
use Auth0\SDK\API\Management\ClientGrants;
use Auth0\SDK\API\Management\Clients;
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
use Auth0\SDK\Hydrator\ArrayHydrator;
use Auth0\SDK\Hydrator\Hydrator;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;

/**
 * Class to communicate with Auth0 Management API
 *
 * @link https://auth0.com/docs/api/management/v2
 */
final class Management
{
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
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @param string          $token
     * @param string          $domain
     * @param HttpClient|null $client
     * @param Hydrator|null   $hydrator
     */
    public function __construct($token, $domain, HttpClient $client = null, Hydrator $hydrator = null)
    {
        $this->token = $token;
        $this->domain = $domain;

        $httpClientBuilder = new HttpClientBuilder($domain.'/api/v2/', $client);
        $httpClientBuilder->addHeader('Authorization', 'Bearer '.$token);
        $this->httpClient = $httpClientBuilder->buildHttpClient();
        $this->hydrator = $hydrator ?: new ArrayHydrator();
    }

    /**
     * @return Blacklists
     */
    public function blacklists()
    {
        return new Blacklists($this->httpClient, $this->hydrator);
    }

    /**
     * @return Clients
     */
    public function clients()
    {
        return new Clients($this->httpClient, $this->hydrator);
    }

    /**
     * @return ClientGrants
     */
    public function clientGrants()
    {
        return new ClientGrants($this->httpClient, $this->hydrator);
    }

    /**
     * @return Connections
     */
    public function connections()
    {
        return new Connections($this->httpClient, $this->hydrator);
    }

    /**
     * @return DeviceCredentials
     */
    public function deviceCredentials()
    {
        return new DeviceCredentials($this->httpClient, $this->hydrator);
    }

    /**
     * @return Emails
     */
    public function emails()
    {
        return new Emails($this->httpClient, $this->hydrator);
    }

    /**
     * @return Jobs
     */
    public function jobs()
    {
        return new Jobs($this->httpClient, $this->hydrator);
    }

    /**
     * @return Logs
     */
    public function logs()
    {
        return new Logs($this->httpClient, $this->hydrator);
    }

    /**
     * @return Rules
     */
    public function rules()
    {
        return new Rules($this->httpClient, $this->hydrator);
    }

    /**
     * @return ResourceServers
     */
    public function resourceServers()
    {
        return new ResourceServers($this->httpClient, $this->hydrator);
    }

    /**
     * @return Stats
     */
    public function stats()
    {
        return new Stats($this->httpClient, $this->hydrator);
    }

    /**
     * @return Tenants
     */
    public function tenants()
    {
        return new Tenants($this->httpClient, $this->hydrator);
    }

    /**
     * @return Tickets
     */
    public function tickets()
    {
        return new Tickets($this->httpClient, $this->hydrator);
    }

    /**
     * @return UserBlocks
     */
    public function userBlocks()
    {
        return new UserBlocks($this->httpClient, $this->hydrator);
    }

    /**
     * @return Users
     */
    public function users()
    {
        return new Users($this->httpClient, $this->hydrator);
    }
}
