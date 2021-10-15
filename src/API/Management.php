<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\API\Management\Actions;
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
use Auth0\SDK\Contract\API\Management\ActionsInterface;
use Auth0\SDK\Contract\API\Management\BlacklistsInterface;
use Auth0\SDK\Contract\API\Management\ClientGrantsInterface;
use Auth0\SDK\Contract\API\Management\ClientsInterface;
use Auth0\SDK\Contract\API\Management\ConnectionsInterface;
use Auth0\SDK\Contract\API\Management\DeviceCredentialsInterface;
use Auth0\SDK\Contract\API\Management\EmailsInterface;
use Auth0\SDK\Contract\API\Management\EmailTemplatesInterface;
use Auth0\SDK\Contract\API\Management\GrantsInterface;
use Auth0\SDK\Contract\API\Management\GuardianInterface;
use Auth0\SDK\Contract\API\Management\JobsInterface;
use Auth0\SDK\Contract\API\Management\LogsInterface;
use Auth0\SDK\Contract\API\Management\LogStreamsInterface;
use Auth0\SDK\Contract\API\Management\OrganizationsInterface;
use Auth0\SDK\Contract\API\Management\ResourceServersInterface;
use Auth0\SDK\Contract\API\Management\RolesInterface;
use Auth0\SDK\Contract\API\Management\RulesInterface;
use Auth0\SDK\Contract\API\Management\StatsInterface;
use Auth0\SDK\Contract\API\Management\TenantsInterface;
use Auth0\SDK\Contract\API\Management\TicketsInterface;
use Auth0\SDK\Contract\API\Management\UserBlocksInterface;
use Auth0\SDK\Contract\API\Management\UsersByEmailInterface;
use Auth0\SDK\Contract\API\Management\UsersInterface;
use Auth0\SDK\Contract\API\ManagementInterface;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponse;
use Auth0\SDK\Utility\HttpResponsePaginator;

/**
 * Class Management
 */
final class Management implements ManagementInterface
{
    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private SdkConfiguration $configuration;

    /**
     * Instance of Auth0\SDK\API\Utility\HttpClient.
     */
    private ?HttpClient $httpClient = null;

    /**
     * Cache of Management singletons.
     *
     * @var array<object>
     */
    private array $instances = [];

    /**
     * Management constructor.
     *
     * @param SdkConfiguration|array<mixed> $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When an invalidation `configuration` is provided.
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
        $this->configuration = $configuration;
    }

    /**
     * Return the HttpClient instance being used for management API requests.
     *
     * @param Authentication|null $authentication Optional. An Instance of Authentication for use during client credential exchange. One will be created, when necessary, if not provided.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a Management Token is not able to be obtained.
     */
    public function getHttpClient(
        ?Authentication $authentication = null
    ): HttpClient {
        if ($this->httpClient !== null) {
            return $this->httpClient;
        }

        // Retrieve any configured management token.
        $managementToken = $this->configuration->getManagementToken();

        // PSR-6 cache to use for management access token caching.
        $cache = $this->configuration->getManagementTokenCache();

        // If no token was provided, try to get one from cache.
        if ($managementToken === null) {
            if ($cache !== null) {
                $item = $cache->getItem('managementAccessToken');
                if ($item->isHit()) {
                    $managementToken = $item->get();
                }
            }
        }

        // If no token was provided or available from cache, try to get one.
        if ($managementToken === null && $this->configuration->hasClientSecret()) {
            $authentication = $authentication ?? new Authentication($this->configuration);
            $response = $authentication->clientCredentials(['audience' => $this->configuration->formatDomain(true) . '/api/v2/']);

            if (HttpResponse::wasSuccessful($response)) {
                $response = HttpResponse::decodeContent($response);

                if (isset($response['access_token'])) {
                    $managementToken = $response['access_token'];

                    // If cache is available, store the token.
                    if ($cache !== null) {
                        $cachedKey = $cache->getItem('managementAccessToken');
                        $cachedKey->set($managementToken);
                        $cachedKey->expiresAfter((int) ($response['expires_in'] ?? 3600));

                        $cache->save($cachedKey);
                    }
                }
            }
        }

        // No management token could be acquired.
        if ($managementToken === null) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresManagementToken();
        }

        // Build the API client using the management token.
        return $this->httpClient = new HttpClient($this->configuration, HttpClient::CONTEXT_MANAGEMENT_CLIENT, '/api/v2/', ['Authorization' => 'Bearer ' . (string) $managementToken]);
    }

    /**
     * Return an instance of HttpRequest representing the last issued request.
     */
    public function getLastRequest(): ?HttpRequest
    {
        return $this->getHttpClient()->getLastRequest();
    }

    /**
     * Return a ResponsePaginator instance configured for the last HttpRequest.
     */
    public function getResponsePaginator(): HttpResponsePaginator
    {
        return new HttpResponsePaginator($this->getHttpClient());
    }

    public function actions(): ActionsInterface
    {
        return $this->getClassInstance(Actions::class);
    }

    public function blacklists(): BlacklistsInterface
    {
        return $this->getClassInstance(Blacklists::class);
    }

    public function clients(): ClientsInterface
    {
        return $this->getClassInstance(Clients::class);
    }

    public function connections(): ConnectionsInterface
    {
        return $this->getClassInstance(Connections::class);
    }

    public function clientGrants(): ClientGrantsInterface
    {
        return $this->getClassInstance(ClientGrants::class);
    }

    public function deviceCredentials(): DeviceCredentialsInterface
    {
        return $this->getClassInstance(DeviceCredentials::class);
    }

    public function emails(): EmailsInterface
    {
        return $this->getClassInstance(Emails::class);
    }

    public function emailTemplates(): EmailTemplatesInterface
    {
        return $this->getClassInstance(EmailTemplates::class);
    }

    public function grants(): GrantsInterface
    {
        return $this->getClassInstance(Grants::class);
    }

    public function guardian(): GuardianInterface
    {
        return $this->getClassInstance(Guardian::class);
    }

    public function jobs(): JobsInterface
    {
        return $this->getClassInstance(Jobs::class);
    }

    public function logs(): LogsInterface
    {
        return $this->getClassInstance(Logs::class);
    }

    public function logStreams(): LogStreamsInterface
    {
        return $this->getClassInstance(LogStreams::class);
    }

    public function organizations(): OrganizationsInterface
    {
        return $this->getClassInstance(Organizations::class);
    }

    public function roles(): RolesInterface
    {
        return $this->getClassInstance(Roles::class);
    }

    public function rules(): RulesInterface
    {
        return $this->getClassInstance(Rules::class);
    }

    public function resourceServers(): ResourceServersInterface
    {
        return $this->getClassInstance(ResourceServers::class);
    }

    public function stats(): StatsInterface
    {
        return $this->getClassInstance(Stats::class);
    }

    public function tenants(): TenantsInterface
    {
        return $this->getClassInstance(Tenants::class);
    }

    public function tickets(): TicketsInterface
    {
        return $this->getClassInstance(Tickets::class);
    }

    public function userBlocks(): UserBlocksInterface
    {
        return $this->getClassInstance(UserBlocks::class);
    }

    public function users(): UsersInterface
    {
        return $this->getClassInstance(Users::class);
    }

    public function usersByEmail(): UsersByEmailInterface
    {
        return $this->getClassInstance(UsersByEmail::class);
    }

    /**
     * Return an instance of Api Management Class.
     *
     * @return mixed
     */
    private function getClassInstance(
        string $className
    ) {
        if (! isset($this->instances[$className])) {
            $this->instances[$className] = new $className($this->getHttpClient());
        }

        return $this->instances[$className];
    }
}
