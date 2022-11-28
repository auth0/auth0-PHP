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
 * Class Management.
 */
final class Management implements ManagementInterface
{
    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private ?SdkConfiguration $validatedConfiguration = null;

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
     * @param  array<mixed>|SdkConfiguration  $configuration  Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when an invalidation `configuration` is provided
     *
     * @psalm-suppress DocblockTypeContradiction
     */
    public function __construct(
        private SdkConfiguration|array $configuration,
    ) {
        $this->getConfiguration();
    }

    public function getConfiguration(): SdkConfiguration
    {
        if (null === $this->validatedConfiguration) {
            if (\is_array($this->configuration)) {
                return $this->validatedConfiguration = new SdkConfiguration($this->configuration);
            }

            return $this->validatedConfiguration = $this->configuration;
        }

        return $this->validatedConfiguration;
    }

    public function getHttpClient(
        ?Authentication $authentication = null,
    ): HttpClient {
        if (null !== $this->httpClient) {
            return $this->httpClient;
        }

        // Retrieve any configured management token.
        $managementToken = $this->getConfiguration()->getManagementToken();

        // PSR-6 cache to use for management access token caching.
        $cache = $this->getConfiguration()->getManagementTokenCache();

        // If no token was provided, try to get one from cache.
        if (null === $managementToken && null !== $cache) {
            $item = $cache->getItem('managementAccessToken');

            if ($item->isHit()) {
                $managementToken = $item->get();
                /* @var int|string|null $managementToken */
            }
        }

        // If no token was provided or available from cache, try to get one.
        if (null === $managementToken && $this->getConfiguration()->hasClientSecret()) {
            $authentication ??= new Authentication($this->getConfiguration());
            $response = $authentication->clientCredentials(['audience' => $this->getConfiguration()->formatDomain(true) . '/api/v2/']);
            $decoded = HttpResponse::decodeContent($response);

            /* @var array{access_token?: (string|null), expires_in?: (int|string), error?: int|string, error_description?: int|string} $decoded */

            if (HttpResponse::wasSuccessful($response)) {
                if (isset($decoded['access_token'])) {
                    $managementToken = $decoded['access_token'];

                    // If cache is available, store the token.
                    if (null !== $cache) {
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
        if (null === $managementToken) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresManagementToken();
        }

        // Build the API client using the management token.
        return $this->httpClient = new HttpClient($this->getConfiguration(), HttpClient::CONTEXT_MANAGEMENT_CLIENT, '/api/v2/', ['Authorization' => 'Bearer ' . (string) $managementToken]);
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
        return $this->getClassInstance(Actions::class);
        /* @var ActionsInterface $class */
    }

    public function attackProtection(): AttackProtectionInterface
    {
        return $this->getClassInstance(AttackProtection::class);
        /* @var AttackProtectionInterface $class */
    }

    public function blacklists(): BlacklistsInterface
    {
        return $this->getClassInstance(Blacklists::class);
        /* @var BlacklistsInterface $class */
    }

    public function clients(): ClientsInterface
    {
        return $this->getClassInstance(Clients::class);
        /* @var ClientsInterface $class */
    }

    public function connections(): ConnectionsInterface
    {
        return $this->getClassInstance(Connections::class);
        /* @var ConnectionsInterface $class */
    }

    public function clientGrants(): ClientGrantsInterface
    {
        return $this->getClassInstance(ClientGrants::class);
        /* @var ClientGrantsInterface $class */
    }

    public function deviceCredentials(): DeviceCredentialsInterface
    {
        return $this->getClassInstance(DeviceCredentials::class);
        /* @var DeviceCredentialsInterface $class */
    }

    public function emails(): EmailsInterface
    {
        return $this->getClassInstance(Emails::class);
        /* @var EmailsInterface $class */
    }

    public function emailTemplates(): EmailTemplatesInterface
    {
        return $this->getClassInstance(EmailTemplates::class);
        /* @var EmailTemplatesInterface $class */
    }

    public function grants(): GrantsInterface
    {
        return $this->getClassInstance(Grants::class);
        /* @var GrantsInterface $class */
    }

    public function guardian(): GuardianInterface
    {
        return $this->getClassInstance(Guardian::class);
        /* @var GuardianInterface $class */
    }

    public function jobs(): JobsInterface
    {
        return $this->getClassInstance(Jobs::class);
        /* @var JobsInterface $class */
    }

    public function logs(): LogsInterface
    {
        return $this->getClassInstance(Logs::class);
        /* @var LogsInterface $class */
    }

    public function logStreams(): LogStreamsInterface
    {
        return $this->getClassInstance(LogStreams::class);
        /* @var LogStreamsInterface $class */
    }

    public function organizations(): OrganizationsInterface
    {
        return $this->getClassInstance(Organizations::class);
        /* @var OrganizationsInterface $class */
    }

    public function roles(): RolesInterface
    {
        return $this->getClassInstance(Roles::class);
        /* @var RolesInterface $class */
    }

    public function rules(): RulesInterface
    {
        return $this->getClassInstance(Rules::class);
        /* @var RulesInterface $class */
    }

    public function resourceServers(): ResourceServersInterface
    {
        return $this->getClassInstance(ResourceServers::class);
        /* @var ResourceServersInterface $class */
    }

    public function stats(): StatsInterface
    {
        return $this->getClassInstance(Stats::class);
        /* @var StatsInterface $class */
    }

    public function tenants(): TenantsInterface
    {
        return $this->getClassInstance(Tenants::class);
        /* @var TenantsInterface $class */
    }

    public function tickets(): TicketsInterface
    {
        return $this->getClassInstance(Tickets::class);
        /* @var TicketsInterface $class */
    }

    public function userBlocks(): UserBlocksInterface
    {
        return $this->getClassInstance(UserBlocks::class);
        /* @var UserBlocksInterface $class */
    }

    public function users(): UsersInterface
    {
        return $this->getClassInstance(Users::class);
        /* @var UsersInterface $class */
    }

    public function usersByEmail(): UsersByEmailInterface
    {
        return $this->getClassInstance(UsersByEmail::class);
        /* @var UsersByEmailInterface $class */
    }

    /**
     * Return an instance of Api Management Class.
     *
     * @return object
     */
    private function getClassInstance(
        string $className,
    ) {
        if (! isset($this->instances[$className])) {
            $this->instances[$className] = new $className($this->getHttpClient());
        }

        return $this->instances[$className];
    }
}
