<?php
namespace Auth0\SDK\API;

use Auth0\SDK\API\Management\Blacklists;
use Auth0\SDK\API\Management\Clients;
use Auth0\SDK\API\Management\ClientGrants;
use Auth0\SDK\API\Management\Connections;
use Auth0\SDK\API\Management\DeviceCredentials;
use Auth0\SDK\API\Management\Emails;
use Auth0\SDK\API\Management\EmailTemplates;
use Auth0\SDK\API\Management\Grants;
use Auth0\SDK\API\Management\Jobs;
use Auth0\SDK\API\Management\Logs;
use Auth0\SDK\API\Management\ResourceServers;
use Auth0\SDK\API\Management\Roles;
use Auth0\SDK\API\Management\Rules;
use Auth0\SDK\API\Management\Stats;
use Auth0\SDK\API\Management\Tenants;
use Auth0\SDK\API\Management\Tickets;
use Auth0\SDK\API\Management\UserBlocks;
use Auth0\SDK\API\Management\Users;
use Auth0\SDK\API\Management\UsersByEmail;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;

class Management
{

    /**
     * @var ApiClient
     */
    private $apiClient;

    /**
     * @var Blacklists
     */
    private $blacklists;

    /**
     * @var Clients
     */
    private $clients;

    /**
     * @var ClientGrants
     */
    private $client_grants;

    /**
     * @var Connections
     */
    private $connections;

    /**
     * @var DeviceCredentials
     */
    private $deviceCredentials;

    /**
     * @var Emails
     */
    private $emails;

    /**
     * @var EmailTemplates
     */
    private $emailTemplates;

    /**
     * @var Jobs
     */
    private $jobs;

    /**
     * @var Grants
     */
    private $grants;

    /**
     * @var Logs
     */
    private $logs;

    /**
     * @var Roles
     */
    private $roles;

    /**
     * @var Rules
     */
    private $rules;

    /**
     * @var ResourceServers
     */
    private $resource_servers;

    /**
     * @var Stats
     */
    private $stats;

    /**
     * @var Tenants
     */
    private $tenants;

    /**
     * @var Tickets
     */
    private $tickets;

    /**
     * @var UserBlocks
     */
    private $userBlocks;

    /**
     * @var Users
     */
    private $users;

    /**
     * @var UsersByEmail
     */
    private $usersByEmail;

    /**
     * Management constructor.
     *
     * @param string      $token
     * @param string      $domain
     * @param array       $guzzleOptions
     * @param string|null $returnType
     */
    public function __construct(string $token, string $domain, array $guzzleOptions = [], ?string $returnType = null)
    {
        $this->apiClient = new ApiClient([
            'domain' => 'https://'.$domain,
            'basePath' => '/api/v2/',
            'guzzleOptions' => $guzzleOptions,
            'returnType' => $returnType,
            'headers' => [
                new AuthorizationBearer($token)
            ]
        ]);
    }

    /**
     * Return an instance of the Blacklists class.
     *
     * @return Blacklists
     */
    public function blacklists() : Blacklists
    {
        if (! $this->blacklists instanceof Blacklists) {
            $this->blacklists = new Blacklists($this->apiClient);
        }

        return $this->blacklists;
    }

    /**
     * Return an instance of the Clients class.
     *
     * @return Clients
     */
    public function clients() : Clients
    {
        if (! $this->clients instanceof Clients) {
            $this->clients = new Clients($this->apiClient);
        }

        return $this->clients;
    }

    /**
     * Return an instance of the ClientGrants class.
     *
     * @return ClientGrants
     */
    public function clientGrants() : ClientGrants
    {
        if (! $this->client_grants instanceof ClientGrants) {
            $this->client_grants = new ClientGrants($this->apiClient);
        }

        return $this->client_grants;
    }

    /**
     * Return an instance of the Connections class.
     *
     * @return Connections
     */
    public function connections() : Connections
    {
        if (! $this->connections instanceof Connections) {
            $this->connections = new Connections($this->apiClient);
        }

        return $this->connections;
    }

    /**
     * Return an instance of the DeviceCredentials class.
     *
     * @return DeviceCredentials
     */
    public function deviceCredentials() : DeviceCredentials
    {
        if (! $this->deviceCredentials instanceof DeviceCredentials) {
            $this->deviceCredentials = new DeviceCredentials($this->apiClient);
        }

        return $this->deviceCredentials;
    }

    /**
     * Return an instance of the Emails class.
     *
     * @return Emails
     */
    public function emails() : Emails
    {
        if (! $this->emails instanceof Emails) {
            $this->emails = new Emails($this->apiClient);
        }

        return $this->emails;
    }

    /**
     * Return an instance of the EmailTemplates class.
     *
     * @return EmailTemplates
     */
    public function emailTemplates() : EmailTemplates
    {
        if (! $this->emailTemplates instanceof EmailTemplates) {
            $this->emailTemplates = new EmailTemplates($this->apiClient);
        }

        return $this->emailTemplates;
    }

    /**
     * Return an instance of the Grants class.
     *
     * @return Grants
     */
    public function grants() : Grants
    {
        if (! $this->grants instanceof Grants) {
            $this->grants = new Grants($this->apiClient);
        }

        return $this->grants;
    }

    /**
     * Return an instance of the Jobs class.
     *
     * @return Jobs
     */
    public function jobs() : Jobs
    {
        if (! $this->jobs instanceof Jobs) {
            $this->jobs = new Jobs($this->apiClient);
        }

        return $this->jobs;
    }

    /**
     * Return an instance of the Logs class.
     *
     * @return Logs
     */
    public function logs() : Logs
    {
        if (! $this->logs instanceof Logs) {
            $this->logs = new Logs($this->apiClient);
        }

        return $this->logs;
    }

    /**
     * Return an instance of the Roles class.
     *
     * @return Roles
     */
    public function roles() : Roles
    {
        if (! $this->roles instanceof Roles) {
            $this->roles = new Roles($this->apiClient);
        }

        return $this->roles;
    }

    /**
     * Return an instance of the Rules class.
     *
     * @return Rules
     */
    public function rules() : Rules
    {
        if (! $this->rules instanceof Rules) {
            $this->rules = new Rules($this->apiClient);
        }

        return $this->rules;
    }

    /**
     * Return an instance of the ResourceServers class.
     *
     * @return ResourceServers
     */
    public function resourceServers() : ResourceServers
    {
        if (! $this->resource_servers instanceof ResourceServers) {
            $this->resource_servers = new ResourceServers($this->apiClient);
        }

        return $this->resource_servers;
    }

    /**
     * Return an instance of the Stats class.
     *
     * @return Stats
     */
    public function stats() : Stats
    {
        if (! $this->stats instanceof Stats) {
            $this->stats = new Stats($this->apiClient);
        }

        return $this->stats;
    }

    /**
     * Return an instance of the Tenants class.
     *
     * @return Tenants
     */
    public function tenants() : Tenants
    {
        if (! $this->tenants instanceof Tenants) {
            $this->tenants = new Tenants($this->apiClient);
        }

        return $this->tenants;
    }

    /**
     * Return an instance of the Tickets class.
     *
     * @return Tickets
     */
    public function tickets() : Tickets
    {
        if (! $this->tickets instanceof Tickets) {
            $this->tickets = new Tickets($this->apiClient);
        }

        return $this->tickets;
    }

    /**
     * Return an instance of the UserBlocks class.
     *
     * @return UserBlocks
     */
    public function userBlocks() : UserBlocks
    {
        if (! $this->userBlocks instanceof UserBlocks) {
            $this->userBlocks = new UserBlocks($this->apiClient);
        }

        return $this->userBlocks;
    }

    /**
     * Return an instance of the Users class.
     *
     * @return Users
     */
    public function users() : Users
    {
        if (! $this->users instanceof Users) {
            $this->users = new Users($this->apiClient);
        }

        return $this->users;
    }

    /**
     * Return an instance of the UsersByEmail class.
     *
     * @return UsersByEmail
     */
    public function usersByEmail() : UsersByEmail
    {
        if (! $this->usersByEmail instanceof UsersByEmail) {
            $this->usersByEmail = new UsersByEmail($this->apiClient);
        }

        return $this->usersByEmail;
    }
}
