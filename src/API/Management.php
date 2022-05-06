<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\API\Management\Actions;
use Auth0\SDK\API\Management\AttackProtection;
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
use Auth0\SDK\Contract\API\Management\AttackProtectionInterface;
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
        if ($managementToken === null && $cache !== null) {
            $item = $cache->getItem('managementAccessToken');
            if ($item->isHit()) {
                $managementToken = $item->get();
                /** @var int|string|null $managementToken */
            }
        }

        // If no token was provided or available from cache, try to get one.
        if ($managementToken === null && $this->configuration->hasClientSecret()) {
            $authentication = $authentication ?? new Authentication($this->configuration);
            $response = $authentication->clientCredentials(['audience' => $this->configuration->formatDomain(true) . '/api/v2/']);
            $decoded = HttpResponse::decodeContent($response);

            /** @var array{access_token?: (string|null), expires_in?: (int|string), error?: int|string, error_description?: int|string} $decoded */

            if (HttpResponse::wasSuccessful($response)) {
                if (isset($decoded['access_token'])) {
                    $managementToken = $decoded['access_token'];

                    // If cache is available, store the token.
                    if ($cache !== null) {
                        $cachedKey = $cache->getItem('managementAccessToken');
                        $cachedKey->set($managementToken);
                        $cachedKey->expiresAfter((int) ($decoded['expires_in'] ?? 3600));

                        $cache->save($cachedKey);
                    }
                }
            } elseif (isset($decoded['error'])) {
                $errorMessage = (string) $decoded['error'];
                if (isset($decoded['error_description'])) {
                    $errorMessage .= ': ' . (string) $decoded['error_description'];
                }
                throw \Auth0\SDK\Exception\NetworkException::requestRejected($errorMessage);
            }
        }

        // No management token could be acquired.
        if ($managementToken === null) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresManagementToken();
        }

        // Build the API client using the management token.
        return $this->httpClient = new HttpClient($this->configuration, HttpClient::CONTEXT_MANAGEMENT_CLIENT, '/api/v2/', ['Authorization' => 'Bearer ' . (string) $managementToken]);
    }

    public function getLastRequest(): ?HttpRequest
    {
        return $this->getHttpClient()->getLastRequest();
    }

    public function getResponsePaginator(): HttpResponsePaginator
    {
        return new HttpResponsePaginator($this->getHttpClient());
    }

    public function actions(): ActionsInterface
    {
        $class = $this->getClassInstance(Actions::class);
        /** @var ActionsInterface $class */
        return $class;
    }

    public function attackProtection(): AttackProtectionInterface
    {
        $class = $this->getClassInstance(AttackProtection::class);
        /** @var AttackProtectionInterface $class */
        return $class;
    }

    public function blacklists(): BlacklistsInterface
    {
        $class = $this->getClassInstance(Blacklists::class);
        /** @var BlacklistsInterface $class */
        return $class;
    }

    public function clients(): ClientsInterface
    {
        $class = $this->getClassInstance(Clients::class);
        /** @var ClientsInterface $class */
        return $class;
    }

    public function connections(): ConnectionsInterface
    {
        $class = $this->getClassInstance(Connections::class);
        /** @var ConnectionsInterface $class */
        return $class;
    }

    public function clientGrants(): ClientGrantsInterface
    {
        $class = $this->getClassInstance(ClientGrants::class);
        /** @var ClientGrantsInterface $class */
        return $class;
    }

    public function deviceCredentials(): DeviceCredentialsInterface
    {
        $class = $this->getClassInstance(DeviceCredentials::class);
        /** @var DeviceCredentialsInterface $class */
        return $class;
    }

    public function emails(): EmailsInterface
    {
        $class = $this->getClassInstance(Emails::class);
        /** @var EmailsInterface $class */
        return $class;
    }

    public function emailTemplates(): EmailTemplatesInterface
    {
        $class = $this->getClassInstance(EmailTemplates::class);
        /** @var EmailTemplatesInterface $class */
        return $class;
    }

    public function grants(): GrantsInterface
    {
        $class = $this->getClassInstance(Grants::class);
        /** @var GrantsInterface $class */
        return $class;
    }

    public function guardian(): GuardianInterface
    {
        $class = $this->getClassInstance(Guardian::class);
        /** @var GuardianInterface $class */
        return $class;
    }

    public function jobs(): JobsInterface
    {
        $class = $this->getClassInstance(Jobs::class);
        /** @var JobsInterface $class */
        return $class;
    }

    public function logs(): LogsInterface
    {
        $class = $this->getClassInstance(Logs::class);
        /** @var LogsInterface $class */
        return $class;
    }

    public function logStreams(): LogStreamsInterface
    {
        $class = $this->getClassInstance(LogStreams::class);
        /** @var LogStreamsInterface $class */
        return $class;
    }

    public function organizations(): OrganizationsInterface
    {
        $class = $this->getClassInstance(Organizations::class);
        /** @var OrganizationsInterface $class */
        return $class;
    }

    public function roles(): RolesInterface
    {
        $class = $this->getClassInstance(Roles::class);
        /** @var RolesInterface $class */
        return $class;
    }

    public function rules(): RulesInterface
    {
        $class = $this->getClassInstance(Rules::class);
        /** @var RulesInterface $class */
        return $class;
    }

    public function resourceServers(): ResourceServersInterface
    {
        $class = $this->getClassInstance(ResourceServers::class);
        /** @var ResourceServersInterface $class */
        return $class;
    }

    public function stats(): StatsInterface
    {
        $class = $this->getClassInstance(Stats::class);
        /** @var StatsInterface $class */
        return $class;
    }

    public function tenants(): TenantsInterface
    {
        $class = $this->getClassInstance(Tenants::class);
        /** @var TenantsInterface $class */
        return $class;
    }

    public function tickets(): TicketsInterface
    {
        $class = $this->getClassInstance(Tickets::class);
        /** @var TicketsInterface $class */
        return $class;
    }

    public function userBlocks(): UserBlocksInterface
    {
        $class = $this->getClassInstance(UserBlocks::class);
        /** @var UserBlocksInterface $class */
        return $class;
    }

    public function users(): UsersInterface
    {
        $class = $this->getClassInstance(Users::class);
        /** @var UsersInterface $class */
        return $class;
    }

    public function usersByEmail(): UsersByEmailInterface
    {
        $class = $this->getClassInstance(UsersByEmail::class);
        /** @var UsersByEmailInterface $class */
        return $class;
    }

    /**
     * Return an instance of Api Management Class.
     *
     * @return object
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
