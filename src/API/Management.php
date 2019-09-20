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
     *
     * @var string
     */
    private $token;

    /**
     *
     * @var string
     */
    private $domain;

    /**
     *
     * @var ApiClient
     */
    private $apiClient;

    /**
     *
     * @var array
     */
    private $guzzleOptions;

    /**
     *
     * @var string
     */
    private $returnType;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->blacklists() instead.
     *
     * @var Blacklists
     */
    public $blacklists;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->clients() instead.
     *
     * @var Clients
     */
    public $clients;

    /**
     * @deprecated 5.6.0, will be renamed and lose public access; use $this->clientGrants() instead.
     *
     * @var ClientGrants
     */
    public $client_grants;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->connections() instead.
     *
     * @var Connections
     */
    public $connections;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->deviceCredentials() instead.
     *
     * @var DeviceCredentials
     */
    public $deviceCredentials;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->emails() instead.
     *
     * @var Emails
     */
    public $emails;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->emailTemplates() instead.
     *
     * @var EmailTemplates
     */
    public $emailTemplates;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->jobs() instead.
     *
     * @var Jobs
     */
    public $jobs;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->grants() instead.
     *
     * @var Grants
     */
    public $grants;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->logs() instead.
     *
     * @var Logs
     */
    public $logs;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->roles() instead.
     *
     * @var Roles
     */
    public $roles;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->rules() instead.
     *
     * @var Rules
     */
    public $rules;

    /**
     * @deprecated 5.6.0, will be renamed and lose public access; use $this->resourceServers() instead.
     *
     * @var ResourceServers
     */
    public $resource_servers;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->stats() instead.
     *
     * @var Stats
     */
    public $stats;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->tenants() instead.
     *
     * @var Tenants
     */
    public $tenants;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->tickets() instead.
     *
     * @var Tickets
     */
    public $tickets;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->userBlocks() instead.
     *
     * @var UserBlocks
     */
    public $userBlocks;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->users() instead.
     *
     * @var Users
     */
    public $users;

    /**
     * @deprecated 5.6.0, will lose public access; use $this->usersByEmail() instead.
     *
     * @var UsersByEmail
     */
    public $usersByEmail;

    /**
     * Management constructor.
     *
     * @param string      $token
     * @param string      $domain
     * @param array       $guzzleOptions
     * @param string|null $returnType
     */
    public function __construct($token, $domain, $guzzleOptions = [], $returnType = null)
    {
        $this->token         = $token;
        $this->domain        = $domain;
        $this->guzzleOptions = $guzzleOptions;
        $this->returnType    = $returnType;

        $this->setApiClient();

        $this->blacklists        = new Blacklists($this->apiClient);
        $this->clients           = new Clients($this->apiClient);
        $this->client_grants     = new ClientGrants($this->apiClient);
        $this->connections       = new Connections($this->apiClient);
        $this->deviceCredentials = new DeviceCredentials($this->apiClient);
        $this->emails            = new Emails($this->apiClient);
        $this->emailTemplates    = new EmailTemplates($this->apiClient);
        $this->grants            = new Grants($this->apiClient);
        $this->jobs              = new Jobs($this->apiClient);
        $this->logs              = new Logs($this->apiClient);
        $this->roles             = new Roles($this->apiClient);
        $this->rules             = new Rules($this->apiClient);
        $this->resource_servers  = new ResourceServers($this->apiClient);
        $this->stats             = new Stats($this->apiClient);
        $this->tenants           = new Tenants($this->apiClient);
        $this->tickets           = new Tickets($this->apiClient);
        $this->userBlocks        = new UserBlocks($this->apiClient);
        $this->users             = new Users($this->apiClient);
        $this->usersByEmail      = new UsersByEmail($this->apiClient);
    }

    /**
     * Return an instance of the Blacklists class.
     *
     * @return Blacklists
     */
    public function blacklists()
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
    public function clients()
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
    public function clientGrants()
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
    public function connections()
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
    public function deviceCredentials()
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
    public function emails()
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
    public function emailTemplates()
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
    public function grants()
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
    public function jobs()
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
    public function logs()
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
    public function roles()
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
    public function rules()
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
    public function resourceServers()
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
    public function stats()
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
    public function tenants()
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
    public function tickets()
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
    public function userBlocks()
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
    public function users()
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
    public function usersByEmail()
    {
        if (! $this->usersByEmail instanceof UsersByEmail) {
            $this->usersByEmail = new UsersByEmail($this->apiClient);
        }

        return $this->usersByEmail;
    }

    protected function setApiClient()
    {
        $apiDomain = "https://{$this->domain}";

        $client = new ApiClient([
            'domain' => $apiDomain,
            'basePath' => '/api/v2/',
            'guzzleOptions' => $this->guzzleOptions,
            'returnType' => $this->returnType,
            'headers' => [
                new AuthorizationBearer($this->token)
            ]
        ]);

        $this->apiClient = $client;
    }
}
