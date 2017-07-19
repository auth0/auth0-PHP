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
     * @param string          $token
     * @param string          $domain
     * @param HttpClient|null $client
     */
    public function __construct($token, $domain, HttpClient $client = null)
    {
        $this->token = $token;
        $this->domain = $domain;

        $httpClientBuilder = new HttpClientBuilder($domain.'/api/v2/', $client);
        $httpClientBuilder->addHeader('Authorization', 'Bearer '.$token);
        $this->httpClient = $httpClientBuilder->buildHttpClient();
    }

    /**
     * @return Blacklists
     */
    public function blacklists()
    {
        return new Blacklists($this->httpClient);
    }

    /**
     * @return Clients
     */
    public function clients()
    {
        return new Clients($this->httpClient);
    }

    /**
     * @return ClientGrants
     */
    public function clientGrants()
    {
        return new ClientGrants($this->httpClient);
    }

    /**
     * @return Connections
     */
    public function connections()
    {
        return new Connections($this->httpClient);
    }

    /**
     * @return DeviceCredentials
     */
    public function deviceCredentials()
    {
        return new DeviceCredentials($this->httpClient);
    }

    /**
     * @return Emails
     */
    public function emails()
    {
        return new Emails($this->httpClient);
    }

    /**
     * @return Jobs
     */
    public function jobs()
    {
        return new Jobs($this->httpClient);
    }

    /**
     * @return Logs
     */
    public function logs()
    {
        return new Logs($this->httpClient);
    }

    /**
     * @return Rules
     */
    public function rules()
    {
        return new Rules($this->httpClient);
    }

    /**
     * @return ResourceServers
     */
    public function resourceServers()
    {
        return new ResourceServers($this->httpClient);
    }

    /**
     * @return Stats
     */
    public function stats()
    {
        return new Stats($this->httpClient);
    }

    /**
     * @return Tenants
     */
    public function tenants()
    {
        return new Tenants($this->httpClient);
    }

    /**
     * @return Tickets
     */
    public function tickets()
    {
        return new Tickets($this->httpClient);
    }

    /**
     * @return UserBlocks
     */
    public function userBlocks()
    {
        return new UserBlocks($this->httpClient);
    }

    /**
     * @return Users
     */
    public function users()
    {
        return new Users($this->httpClient);
    }
}
