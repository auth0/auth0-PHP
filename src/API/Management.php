<?php
declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\API\Header\AuthorizationBearer;
use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Management\Blacklists;
use Auth0\SDK\API\Management\Clients;
use Auth0\SDK\API\Management\ClientGrants;
use Auth0\SDK\API\Management\Connections;
use Auth0\SDK\API\Management\DeviceCredentials;
use Auth0\SDK\API\Management\Emails;
use Auth0\SDK\API\Management\EmailTemplates;
use Auth0\SDK\API\Management\Grants;
use Auth0\SDK\API\Management\Guardian;
use Auth0\SDK\API\Management\Jobs;
use Auth0\SDK\API\Management\Logs;
use Auth0\SDK\API\Management\LogStreams;
use Auth0\SDK\API\Management\ResourceServers;
use Auth0\SDK\API\Management\Roles;
use Auth0\SDK\API\Management\Rules;
use Auth0\SDK\API\Management\Stats;
use Auth0\SDK\API\Management\Tenants;
use Auth0\SDK\API\Management\Tickets;
use Auth0\SDK\API\Management\UserBlocks;
use Auth0\SDK\API\Management\Users;
use Auth0\SDK\API\Management\UsersByEmail;

/**
 * Class Management
 *
 * @package Auth0\SDK\API
 */
class Management
{

    /**
     * Instance of Auth0\SDK\API\Helpers\ApiClient
     *
     * @var ApiClient
     */
    private $apiClient;

    /**
     * Instance of Auth0\SDK\API\Management\Blacklists
     *
     * @var Blacklists
     */
    private $blacklists;

    /**
     * Instance of Auth0\SDK\API\Management\Clients
     *
     * @var Clients
     */
    private $clients;

    /**
     * Instance of Auth0\SDK\API\Management\ClientGrants
     *
     * @var ClientGrants
     */
    private $clientGrants;

    /**
     * Instance of Auth0\SDK\API\Management\Connections
     *
     * @var Connections
     */
    private $connections;

    /**
     * Instance of Auth0\SDK\API\Management\DeviceCredentials
     *
     * @var DeviceCredentials
     */
    private $deviceCredentials;

    /**
     * Instance of Auth0\SDK\API\Management\Emails
     *
     * @var Emails
     */
    private $emails;

    /**
     * Instance of Auth0\SDK\API\Management\EmailTemplates
     *
     * @var EmailTemplates
     */
    private $emailTemplates;

    /**
     * Instance of Auth0\SDK\API\Management\Jobs
     *
     * @var Jobs
     */
    private $jobs;

    /**
     * Instance of Auth0\SDK\API\Management\Grants
     *
     * @var Grants
     */
    private $grants;

    /**
     * Instance of Auth0\SDK\API\Management\Guardian
     *
     * @var Guardian
     */
    private $guardian;

    /**
     * Instance of Auth0\SDK\API\Management\Logs
     *
     * @var Logs
     */
    private $logs;

    /**
     * Instance of Auth0\SDK\API\Management\LogStreams
     *
     * @var LogStreams
     */
    private $logStreams;

    /**
     * Instance of Auth0\SDK\API\Management\Roles
     *
     * @var Roles
     */
    private $roles;

    /**
     * Instance of Auth0\SDK\API\Management\Rules
     *
     * @var Rules
     */
    private $rules;

    /**
     * Instance of Auth0\SDK\API\Management\ResourceServers
     *
     * @var ResourceServers
     */
    private $resourceServers;

    /**
     * Instance of Auth0\SDK\API\Management\Stats
     *
     * @var Stats
     */
    private $stats;

    /**
     * Instance of Auth0\SDK\API\Management\Tenants
     *
     * @var Tenants
     */
    private $tenants;

    /**
     * Instance of Auth0\SDK\API\Management\Tickets
     *
     * @var Tickets
     */
    private $tickets;

    /**
     * Instance of Auth0\SDK\API\Management\UserBlocks
     *
     * @var UserBlocks
     */
    private $userBlocks;

    /**
     * Instance of Auth0\SDK\API\Management\Users
     *
     * @var Users
     */
    private $users;

    /**
     * Instance of Auth0\SDK\API\Management\UsersByEmail
     *
     * @var UsersByEmail
     */
    private $usersByEmail;

    /**
     * Management constructor.
     *
     * @param string      $token         Access token for the Management API.
     * @param string      $domain        Management API domain.
     * @param array       $guzzleOptions Options for the Guzzle HTTP library.
     * @param null|string $returnType    Return type for the HTTP request. Can be one of:
     *         - `headers` to return only the response headers.
     *         - `body` (default) to return only the response body.
     *         - `object` to return the entire Reponse object.
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
        if (! $this->clientGrants instanceof ClientGrants) {
            $this->clientGrants = new ClientGrants($this->apiClient);
        }

        return $this->clientGrants;
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
     * Return an instance of the Guardian class.
     *
     * @return Guardian
     */
    public function guardian() : Guardian
    {
        if (! $this->guardian instanceof Guardian) {
            $this->guardian = new Guardian($this->apiClient);
        }

        return $this->guardian;
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
     * Return an instance of the LogStreams class.
     *
     * @return LogStreams
     */
    public function logStreams() : LogStreams
    {
        if (! $this->logStreams instanceof LogStreams) {
            $this->logStreams = new LogStreams($this->apiClient);
        }

        return $this->logStreams;
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
        if (! $this->resourceServers instanceof ResourceServers) {
            $this->resourceServers = new ResourceServers($this->apiClient);
        }

        return $this->resourceServers;
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
