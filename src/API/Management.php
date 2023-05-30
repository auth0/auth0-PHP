<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\API\Management\{Actions, AttackProtection, Blacklists, ClientGrants, Clients, Connections, DeviceCredentials, EmailTemplates, Emails, Grants, Guardian, Jobs, LogStreams, Logs, Organizations, ResourceServers, Roles, Rules, Stats, Tenants, Tickets, UserBlocks, Users, UsersByEmail};
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\API\Management\{ActionsInterface, AttackProtectionInterface, BlacklistsInterface, ClientGrantsInterface, ClientsInterface, ConnectionsInterface, DeviceCredentialsInterface, EmailTemplatesInterface, EmailsInterface, GrantsInterface, GuardianInterface, JobsInterface, LogStreamsInterface, LogsInterface, OrganizationsInterface, ResourceServersInterface, RolesInterface, RulesInterface, StatsInterface, TenantsInterface, TicketsInterface, UserBlocksInterface, UsersByEmailInterface, UsersInterface};
use Auth0\SDK\Contract\API\{AuthenticationInterface, ManagementInterface};
use Auth0\SDK\Utility\{HttpClient, HttpRequest, HttpResponse, HttpResponsePaginator};
use Psr\Cache\CacheItemPoolInterface;

use function is_array;

final class Management extends ClientAbstract implements ManagementInterface
{
    /**
     * Instance of Auth0\SDK\API\Utility\HttpClient.
     */
    private ?HttpClient $httpClient = null;

    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private ?SdkConfiguration $validatedConfiguration = null;

    /**
     * Management constructor.
     *
     * @param array<mixed>|SdkConfiguration $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when an invalidation `configuration` is provided
     *
     * @psalm-suppress DocblockTypeContradiction
     */
    public function __construct(
        private SdkConfiguration | array $configuration,
    ) {
        $this->getConfiguration();
    }

    public function actions(): ActionsInterface
    {
        return Actions::instance($this->getHttpClient());
    }

    public function attackProtection(): AttackProtectionInterface
    {
        return AttackProtection::instance($this->getHttpClient());
    }

    public function blacklists(): BlacklistsInterface
    {
        return Blacklists::instance($this->getHttpClient());
    }

    public function clientGrants(): ClientGrantsInterface
    {
        return ClientGrants::instance($this->getHttpClient());
    }

    public function clients(): ClientsInterface
    {
        return Clients::instance($this->getHttpClient());
    }

    public function connections(): ConnectionsInterface
    {
        return Connections::instance($this->getHttpClient());
    }

    public function deviceCredentials(): DeviceCredentialsInterface
    {
        return DeviceCredentials::instance($this->getHttpClient());
    }

    public function emails(): EmailsInterface
    {
        return Emails::instance($this->getHttpClient());
    }

    public function emailTemplates(): EmailTemplatesInterface
    {
        return EmailTemplates::instance($this->getHttpClient());
    }

    public function getConfiguration(): SdkConfiguration
    {
        if (! $this->validatedConfiguration instanceof SdkConfiguration) {
            if (is_array($this->configuration)) {
                return $this->validatedConfiguration = new SdkConfiguration($this->configuration);
            }

            return $this->validatedConfiguration = $this->configuration;
        }

        return $this->validatedConfiguration;
    }

    public function getHttpClient(
        ?AuthenticationInterface $authentication = null,
    ): HttpClient {
        if ($this->httpClient instanceof HttpClient) {
            return $this->httpClient;
        }

        // Retrieve any configured management token.
        $managementToken = $this->getConfiguration()->getManagementToken();

        // PSR-6 cache to use for management access token caching.
        $cache = $this->getConfiguration()->getManagementTokenCache();

        // If no token was provided, try to get one from cache.
        if (null === $managementToken && $cache instanceof CacheItemPoolInterface) {
            $item = $cache->getItem('managementAccessToken');

            if ($item->isHit()) {
                $managementToken = $item->get();
            }
        }

        // If no token was provided or available from cache, try to get one.
        if (null === $managementToken && $this->getConfiguration()->hasClientSecret()) {
            $authentication ??= new Authentication($this->getConfiguration());
            $response = $authentication->clientCredentials(['audience' => $this->getConfiguration()->formatDomain(true) . '/api/v2/']);
            $decoded = HttpResponse::decodeContent($response);

            /** @var array{access_token?: (null|string), expires_in?: (int|string), error?: int|string, error_description?: int|string} $decoded */
            if (HttpResponse::wasSuccessful($response)) {
                if (isset($decoded['access_token'])) {
                    $managementToken = $decoded['access_token'];

                    // If cache is available, store the token.
                    if ($cache instanceof CacheItemPoolInterface) {
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

        /** @var null|int|string $managementToken */

        // Build the API client using the management token.
        return $this->httpClient = new HttpClient($this->getConfiguration(), HttpClient::CONTEXT_MANAGEMENT_CLIENT, '/api/v2/', ['Authorization' => 'Bearer ' . (string) $managementToken]);
    }

    public function getResponsePaginator(): HttpResponsePaginator
    {
        return new HttpResponsePaginator($this->getHttpClient());
    }

    public function grants(): GrantsInterface
    {
        return Grants::instance($this->getHttpClient());
    }

    public function guardian(): GuardianInterface
    {
        return Guardian::instance($this->getHttpClient());
    }

    public function jobs(): JobsInterface
    {
        return Jobs::instance($this->getHttpClient());
    }

    public function logs(): LogsInterface
    {
        return Logs::instance($this->getHttpClient());
    }

    public function logStreams(): LogStreamsInterface
    {
        return LogStreams::instance($this->getHttpClient());
    }

    public function organizations(): OrganizationsInterface
    {
        return Organizations::instance($this->getHttpClient());
    }

    public function resourceServers(): ResourceServersInterface
    {
        return ResourceServers::instance($this->getHttpClient());
    }

    public function roles(): RolesInterface
    {
        return Roles::instance($this->getHttpClient());
    }

    public function rules(): RulesInterface
    {
        return Rules::instance($this->getHttpClient());
    }

    public function stats(): StatsInterface
    {
        return Stats::instance($this->getHttpClient());
    }

    public function tenants(): TenantsInterface
    {
        return Tenants::instance($this->getHttpClient());
    }

    public function tickets(): TicketsInterface
    {
        return Tickets::instance($this->getHttpClient());
    }

    public function userBlocks(): UserBlocksInterface
    {
        return UserBlocks::instance($this->getHttpClient());
    }

    public function users(): UsersInterface
    {
        return Users::instance($this->getHttpClient());
    }

    public function usersByEmail(): UsersByEmailInterface
    {
        return UsersByEmail::instance($this->getHttpClient());
    }
}
