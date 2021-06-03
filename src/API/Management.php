<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\API\Management\Blacklists;
use Auth0\SDK\API\Management\ClientGrants;
use Auth0\SDK\API\Management\Clients;
use Auth0\SDK\API\Management\Connections;
use Auth0\SDK\API\Management\DeviceCredentials;
use Auth0\SDK\API\Management\Emails;
use Auth0\SDK\API\Management\EmailTemplates;
use Auth0\SDK\API\Management\Grants;
use Auth0\SDK\API\Management\Guardian;
use Auth0\SDK\API\Management\Jobs;
use Auth0\SDK\API\Management\Logs;
use Auth0\SDK\API\Management\LogStreams;
use Auth0\SDK\API\Management\Organizations;
use Auth0\SDK\API\Management\ResourceServers;
use Auth0\SDK\API\Management\Roles;
use Auth0\SDK\API\Management\Rules;
use Auth0\SDK\API\Management\Stats;
use Auth0\SDK\API\Management\Tenants;
use Auth0\SDK\API\Management\Tickets;
use Auth0\SDK\API\Management\UserBlocks;
use Auth0\SDK\API\Management\Users;
use Auth0\SDK\API\Management\UsersByEmail;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponse;
use Auth0\SDK\Utility\HttpResponsePaginator;

/**
 * Class Management
 */
final class Management
{
    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private SdkConfiguration $configuration;

    /**
     * Instance of Auth0\SDK\API\Utility\HttpClient
     */
    private HttpClient $httpClient;

    /**
     * Instance of Auth0\SDK\API\Management\Blacklists
     */
    private ?Blacklists $blacklists = null;

    /**
     * Instance of Auth0\SDK\API\Management\Clients
     */
    private ?Clients $clients = null;

    /**
     * Instance of Auth0\SDK\API\Management\ClientGrants
     */
    private ?ClientGrants $clientGrants = null;

    /**
     * Instance of Auth0\SDK\API\Management\Connections
     */
    private ?Connections $connections = null;

    /**
     * Instance of Auth0\SDK\API\Management\DeviceCredentials
     */
    private ?DeviceCredentials $deviceCredentials = null;

    /**
     * Instance of Auth0\SDK\API\Management\Emails
     */
    private ?Emails $emails = null;

    /**
     * Instance of Auth0\SDK\API\Management\EmailTemplates
     */
    private ?EmailTemplates $emailTemplates = null;

    /**
     * Instance of Auth0\SDK\API\Management\Jobs
     */
    private ?Jobs $jobs = null;

    /**
     * Instance of Auth0\SDK\API\Management\Grants
     */
    private ?Grants $grants = null;

    /**
     * Instance of Auth0\SDK\API\Management\Guardian
     */
    private ?Guardian $guardian = null;

    /**
     * Instance of Auth0\SDK\API\Management\Logs
     */
    private ?Logs $logs = null;

    /**
     * Instance of Auth0\SDK\API\Management\LogStreams
     */
    private ?LogStreams $logStreams = null;

    /**
     * Instance of Auth0\SDK\API\Management\Organizations
     */
    private ?Organizations $organizations = null;

    /**
     * Instance of Auth0\SDK\API\Management\Roles
     */
    private ?Roles $roles = null;

    /**
     * Instance of Auth0\SDK\API\Management\Rules
     */
    private ?Rules $rules = null;

    /**
     * Instance of Auth0\SDK\API\Management\ResourceServers
     */
    private ?ResourceServers $resourceServers = null;

    /**
     * Instance of Auth0\SDK\API\Management\Stats
     */
    private ?Stats $stats = null;

    /**
     * Instance of Auth0\SDK\API\Management\Tenants
     */
    private ?Tenants $tenants = null;

    /**
     * Instance of Auth0\SDK\API\Management\Tickets
     */
    private ?Tickets $tickets = null;

    /**
     * Instance of Auth0\SDK\API\Management\UserBlocks
     */
    private ?UserBlocks $userBlocks = null;

    /**
     * Instance of Auth0\SDK\API\Management\Users
     */
    private ?Users $users = null;

    /**
     * Instance of Auth0\SDK\API\Management\UsersByEmail
     */
    private ?UsersByEmail $usersByEmail = null;

    /**
     * Management constructor.
     *
     * @param SdkConfiguration|array<mixed> $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     *
     * @psalm-suppress DocblockTypeContradiction
     */
    public function __construct(
        $configuration
    ) {
        // If we're passed an array, construct a new SdkConfiguration from that structure.
        if (is_array($configuration)) {
            $configuration = new SdkConfiguration($configuration);
        }

        // We only accept an SdkConfiguration type.
        if (! $configuration instanceof SdkConfiguration) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresConfiguration();
        }

        // Store the configuration internally.
        $this->configuration = & $configuration;

        // Retrieve any configured management token.
        $managementToken = $configuration->getManagementToken();

        // If no token was provided, try to get one.
        if ($managementToken === null) {
            $auth = new Authentication($configuration);
            $response = $auth->clientCredentials(['audience' => $configuration->buildDomainUri() . '/api/v2/']);

            if (HttpResponse::wasSuccessful($response)) {
                $response = HttpResponse::decodeContent($response);

                if (isset($response['access_token'])) {
                    $managementToken = $response['access_token'];
                }
            }
        }

        // No management token could be acquired.
        if ($managementToken === null) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresManagementToken();
        }

        // Build the API client using the management token.
        $this->httpClient = new HttpClient($this->configuration, '/api/v2/', ['Authorization' => 'Bearer ' . $managementToken]);
    }

    /**
     * Return the HttpClient instance being used for management API requests.
     */
    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * Return an instance of HttpRequest representing the last issued request.
     */
    public function getLastRequest(): ?HttpRequest
    {
        return $this->httpClient->getLastRequest();
    }

    /**
     * Return a ResponsePaginator instance configured for the last HttpRequest.
     */
    public function getResponsePaginator(): HttpResponsePaginator
    {
        return new HttpResponsePaginator($this->httpClient);
    }

    /**
     * Return an instance of the Blacklists class.
     */
    public function blacklists(): Blacklists
    {
        if ($this->blacklists === null) {
            $this->blacklists = new Blacklists($this->httpClient);
        }

        return $this->blacklists;
    }

    /**
     * Return an instance of the Clients class.
     */
    public function clients(): Clients
    {
        if ($this->clients === null) {
            $this->clients = new Clients($this->httpClient);
        }

        return $this->clients;
    }

    /**
     * Return an instance of the ClientGrants class.
     */
    public function clientGrants(): ClientGrants
    {
        if ($this->clientGrants === null) {
            $this->clientGrants = new ClientGrants($this->httpClient);
        }

        return $this->clientGrants;
    }

    /**
     * Return an instance of the Connections class.
     */
    public function connections(): Connections
    {
        if ($this->connections === null) {
            $this->connections = new Connections($this->httpClient);
        }

        return $this->connections;
    }

    /**
     * Return an instance of the DeviceCredentials class.
     */
    public function deviceCredentials(): DeviceCredentials
    {
        if ($this->deviceCredentials === null) {
            $this->deviceCredentials = new DeviceCredentials($this->httpClient);
        }

        return $this->deviceCredentials;
    }

    /**
     * Return an instance of the Emails class.
     */
    public function emails(): Emails
    {
        if ($this->emails === null) {
            $this->emails = new Emails($this->httpClient);
        }

        return $this->emails;
    }

    /**
     * Return an instance of the EmailTemplates class.
     */
    public function emailTemplates(): EmailTemplates
    {
        if ($this->emailTemplates === null) {
            $this->emailTemplates = new EmailTemplates($this->httpClient);
        }

        return $this->emailTemplates;
    }

    /**
     * Return an instance of the Grants class.
     */
    public function grants(): Grants
    {
        if ($this->grants === null) {
            $this->grants = new Grants($this->httpClient);
        }

        return $this->grants;
    }

    /**
     * Return an instance of the Guardian class.
     */
    public function guardian(): Guardian
    {
        if ($this->guardian === null) {
            $this->guardian = new Guardian($this->httpClient);
        }

        return $this->guardian;
    }

    /**
     * Return an instance of the Jobs class.
     */
    public function jobs(): Jobs
    {
        if ($this->jobs === null) {
            $this->jobs = new Jobs($this->httpClient);
        }

        return $this->jobs;
    }

    /**
     * Return an instance of the Logs class.
     */
    public function logs(): Logs
    {
        if ($this->logs === null) {
            $this->logs = new Logs($this->httpClient);
        }

        return $this->logs;
    }

    /**
     * Return an instance of the LogStreams class.
     */
    public function logStreams(): LogStreams
    {
        if ($this->logStreams === null) {
            $this->logStreams = new LogStreams($this->httpClient);
        }

        return $this->logStreams;
    }

    /**
     * Return an instance of the Organizations class.
     */
    public function organizations(): Organizations
    {
        if ($this->organizations === null) {
            $this->organizations = new Organizations($this->httpClient);
        }

        return $this->organizations;
    }

    /**
     * Return an instance of the Roles class.
     */
    public function roles(): Roles
    {
        if ($this->roles === null) {
            $this->roles = new Roles($this->httpClient);
        }

        return $this->roles;
    }

    /**
     * Return an instance of the Rules class.
     */
    public function rules(): Rules
    {
        if ($this->rules === null) {
            $this->rules = new Rules($this->httpClient);
        }

        return $this->rules;
    }

    /**
     * Return an instance of the ResourceServers class.
     */
    public function resourceServers(): ResourceServers
    {
        if ($this->resourceServers === null) {
            $this->resourceServers = new ResourceServers($this->httpClient);
        }

        return $this->resourceServers;
    }

    /**
     * Return an instance of the Stats class.
     */
    public function stats(): Stats
    {
        if ($this->stats === null) {
            $this->stats = new Stats($this->httpClient);
        }

        return $this->stats;
    }

    /**
     * Return an instance of the Tenants class.
     */
    public function tenants(): Tenants
    {
        if ($this->tenants === null) {
            $this->tenants = new Tenants($this->httpClient);
        }

        return $this->tenants;
    }

    /**
     * Return an instance of the Tickets class.
     */
    public function tickets(): Tickets
    {
        if ($this->tickets === null) {
            $this->tickets = new Tickets($this->httpClient);
        }

        return $this->tickets;
    }

    /**
     * Return an instance of the UserBlocks class.
     */
    public function userBlocks(): UserBlocks
    {
        if ($this->userBlocks === null) {
            $this->userBlocks = new UserBlocks($this->httpClient);
        }

        return $this->userBlocks;
    }

    /**
     * Return an instance of the Users class.
     */
    public function users(): Users
    {
        if ($this->users === null) {
            $this->users = new Users($this->httpClient);
        }

        return $this->users;
    }

    /**
     * Return an instance of the UsersByEmail class.
     */
    public function usersByEmail(): UsersByEmail
    {
        if ($this->usersByEmail === null) {
            $this->usersByEmail = new UsersByEmail($this->httpClient);
        }

        return $this->usersByEmail;
    }
}
