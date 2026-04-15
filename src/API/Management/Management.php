<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Management\Actions\ActionsClient;
use Auth0\SDK\API\Management\Branding\BrandingClient;
use Auth0\SDK\API\Management\ClientGrants\ClientGrantsClient;
use Auth0\SDK\API\Management\Clients\ClientsClient;
use Auth0\SDK\API\Management\ConnectionProfiles\ConnectionProfilesClient;
use Auth0\SDK\API\Management\Connections\ConnectionsClient;
use Auth0\SDK\API\Management\CustomDomains\CustomDomainsClient;
use Auth0\SDK\API\Management\DeviceCredentials\DeviceCredentialsClient;
use Auth0\SDK\API\Management\EmailTemplates\EmailTemplatesClient;
use Auth0\SDK\API\Management\EventStreams\EventStreamsClient;
use Auth0\SDK\API\Management\Flows\FlowsClient;
use Auth0\SDK\API\Management\Forms\FormsClient;
use Auth0\SDK\API\Management\UserGrants\UserGrantsClient;
use Auth0\SDK\API\Management\Groups\GroupsClient;
use Auth0\SDK\API\Management\Hooks\HooksClient;
use Auth0\SDK\API\Management\Jobs\JobsClient;
use Auth0\SDK\API\Management\LogStreams\LogStreamsClient;
use Auth0\SDK\API\Management\Logs\LogsClient;
use Auth0\SDK\API\Management\NetworkAcls\NetworkAclsClient;
use Auth0\SDK\API\Management\Organizations\OrganizationsClient;
use Auth0\SDK\API\Management\Prompts\PromptsClient;
use Auth0\SDK\API\Management\RefreshTokens\RefreshTokensClient;
use Auth0\SDK\API\Management\ResourceServers\ResourceServersClient;
use Auth0\SDK\API\Management\Roles\RolesClient;
use Auth0\SDK\API\Management\Rules\RulesClient;
use Auth0\SDK\API\Management\RulesConfigs\RulesConfigsClient;
use Auth0\SDK\API\Management\SelfServiceProfiles\SelfServiceProfilesClient;
use Auth0\SDK\API\Management\Sessions\SessionsClient;
use Auth0\SDK\API\Management\Stats\StatsClient;
use Auth0\SDK\API\Management\SupplementalSignals\SupplementalSignalsClient;
use Auth0\SDK\API\Management\Tickets\TicketsClient;
use Auth0\SDK\API\Management\TokenExchangeProfiles\TokenExchangeProfilesClient;
use Auth0\SDK\API\Management\UserAttributeProfiles\UserAttributeProfilesClient;
use Auth0\SDK\API\Management\UserBlocks\UserBlocksClient;
use Auth0\SDK\API\Management\Users\UsersClient;
use Auth0\SDK\API\Management\Anomaly\AnomalyClient;
use Auth0\SDK\API\Management\AttackProtection\AttackProtectionClient;
use Auth0\SDK\API\Management\Emails\EmailsClient;
use Auth0\SDK\API\Management\Guardian\GuardianClient;
use Auth0\SDK\API\Management\Keys\KeysClient;
use Auth0\SDK\API\Management\RiskAssessments\RiskAssessmentsClient;
use Auth0\SDK\API\Management\Tenants\TenantsClient;
use Auth0\SDK\API\Management\VerifiableCredentials\VerifiableCredentialsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Actions\ActionsClientInterface;
use Auth0\SDK\API\Management\Branding\BrandingClientInterface;
use Auth0\SDK\API\Management\ClientGrants\ClientGrantsClientInterface;
use Auth0\SDK\API\Management\Clients\ClientsClientInterface;
use Auth0\SDK\API\Management\ConnectionProfiles\ConnectionProfilesClientInterface;
use Auth0\SDK\API\Management\Connections\ConnectionsClientInterface;
use Auth0\SDK\API\Management\CustomDomains\CustomDomainsClientInterface;
use Auth0\SDK\API\Management\DeviceCredentials\DeviceCredentialsClientInterface;
use Auth0\SDK\API\Management\EmailTemplates\EmailTemplatesClientInterface;
use Auth0\SDK\API\Management\EventStreams\EventStreamsClientInterface;
use Auth0\SDK\API\Management\Flows\FlowsClientInterface;
use Auth0\SDK\API\Management\Forms\FormsClientInterface;
use Auth0\SDK\API\Management\UserGrants\UserGrantsClientInterface;
use Auth0\SDK\API\Management\Groups\GroupsClientInterface;
use Auth0\SDK\API\Management\Hooks\HooksClientInterface;
use Auth0\SDK\API\Management\Jobs\JobsClientInterface;
use Auth0\SDK\API\Management\LogStreams\LogStreamsClientInterface;
use Auth0\SDK\API\Management\Logs\LogsClientInterface;
use Auth0\SDK\API\Management\NetworkAcls\NetworkAclsClientInterface;
use Auth0\SDK\API\Management\Organizations\OrganizationsClientInterface;
use Auth0\SDK\API\Management\Prompts\PromptsClientInterface;
use Auth0\SDK\API\Management\RefreshTokens\RefreshTokensClientInterface;
use Auth0\SDK\API\Management\ResourceServers\ResourceServersClientInterface;
use Auth0\SDK\API\Management\Roles\RolesClientInterface;
use Auth0\SDK\API\Management\Rules\RulesClientInterface;
use Auth0\SDK\API\Management\RulesConfigs\RulesConfigsClientInterface;
use Auth0\SDK\API\Management\SelfServiceProfiles\SelfServiceProfilesClientInterface;
use Auth0\SDK\API\Management\Sessions\SessionsClientInterface;
use Auth0\SDK\API\Management\Stats\StatsClientInterface;
use Auth0\SDK\API\Management\SupplementalSignals\SupplementalSignalsClientInterface;
use Auth0\SDK\API\Management\Tickets\TicketsClientInterface;
use Auth0\SDK\API\Management\TokenExchangeProfiles\TokenExchangeProfilesClientInterface;
use Auth0\SDK\API\Management\UserAttributeProfiles\UserAttributeProfilesClientInterface;
use Auth0\SDK\API\Management\UserBlocks\UserBlocksClientInterface;
use Auth0\SDK\API\Management\Users\UsersClientInterface;
use Auth0\SDK\API\Management\Anomaly\AnomalyClientInterface;
use Auth0\SDK\API\Management\AttackProtection\AttackProtectionClientInterface;
use Auth0\SDK\API\Management\Emails\EmailsClientInterface;
use Auth0\SDK\API\Management\Guardian\GuardianClientInterface;
use Auth0\SDK\API\Management\Keys\KeysClientInterface;
use Auth0\SDK\API\Management\RiskAssessments\RiskAssessmentsClientInterface;
use Auth0\SDK\API\Management\Tenants\TenantsClientInterface;
use Auth0\SDK\API\Management\VerifiableCredentials\VerifiableCredentialsClientInterface;

class Management implements ManagementInterface
{
    /**
     * @var ActionsClient $actions
     */
    public ActionsClient $actions;

    /**
     * @var BrandingClient $branding
     */
    public BrandingClient $branding;

    /**
     * @var ClientGrantsClient $clientGrants
     */
    public ClientGrantsClient $clientGrants;

    /**
     * @var ClientsClient $clients
     */
    public ClientsClient $clients;

    /**
     * @var ConnectionProfilesClient $connectionProfiles
     */
    public ConnectionProfilesClient $connectionProfiles;

    /**
     * @var ConnectionsClient $connections
     */
    public ConnectionsClient $connections;

    /**
     * @var CustomDomainsClient $customDomains
     */
    public CustomDomainsClient $customDomains;

    /**
     * @var DeviceCredentialsClient $deviceCredentials
     */
    public DeviceCredentialsClient $deviceCredentials;

    /**
     * @var EmailTemplatesClient $emailTemplates
     */
    public EmailTemplatesClient $emailTemplates;

    /**
     * @var EventStreamsClient $eventStreams
     */
    public EventStreamsClient $eventStreams;

    /**
     * @var FlowsClient $flows
     */
    public FlowsClient $flows;

    /**
     * @var FormsClient $forms
     */
    public FormsClient $forms;

    /**
     * @var UserGrantsClient $userGrants
     */
    public UserGrantsClient $userGrants;

    /**
     * @var GroupsClient $groups
     */
    public GroupsClient $groups;

    /**
     * @var HooksClient $hooks
     */
    public HooksClient $hooks;

    /**
     * @var JobsClient $jobs
     */
    public JobsClient $jobs;

    /**
     * @var LogStreamsClient $logStreams
     */
    public LogStreamsClient $logStreams;

    /**
     * @var LogsClient $logs
     */
    public LogsClient $logs;

    /**
     * @var NetworkAclsClient $networkAcls
     */
    public NetworkAclsClient $networkAcls;

    /**
     * @var OrganizationsClient $organizations
     */
    public OrganizationsClient $organizations;

    /**
     * @var PromptsClient $prompts
     */
    public PromptsClient $prompts;

    /**
     * @var RefreshTokensClient $refreshTokens
     */
    public RefreshTokensClient $refreshTokens;

    /**
     * @var ResourceServersClient $resourceServers
     */
    public ResourceServersClient $resourceServers;

    /**
     * @var RolesClient $roles
     */
    public RolesClient $roles;

    /**
     * @var RulesClient $rules
     */
    public RulesClient $rules;

    /**
     * @var RulesConfigsClient $rulesConfigs
     */
    public RulesConfigsClient $rulesConfigs;

    /**
     * @var SelfServiceProfilesClient $selfServiceProfiles
     */
    public SelfServiceProfilesClient $selfServiceProfiles;

    /**
     * @var SessionsClient $sessions
     */
    public SessionsClient $sessions;

    /**
     * @var StatsClient $stats
     */
    public StatsClient $stats;

    /**
     * @var SupplementalSignalsClient $supplementalSignals
     */
    public SupplementalSignalsClient $supplementalSignals;

    /**
     * @var TicketsClient $tickets
     */
    public TicketsClient $tickets;

    /**
     * @var TokenExchangeProfilesClient $tokenExchangeProfiles
     */
    public TokenExchangeProfilesClient $tokenExchangeProfiles;

    /**
     * @var UserAttributeProfilesClient $userAttributeProfiles
     */
    public UserAttributeProfilesClient $userAttributeProfiles;

    /**
     * @var UserBlocksClient $userBlocks
     */
    public UserBlocksClient $userBlocks;

    /**
     * @var UsersClient $users
     */
    public UsersClient $users;

    /**
     * @var AnomalyClient $anomaly
     */
    public AnomalyClient $anomaly;

    /**
     * @var AttackProtectionClient $attackProtection
     */
    public AttackProtectionClient $attackProtection;

    /**
     * @var EmailsClient $emails
     */
    public EmailsClient $emails;

    /**
     * @var GuardianClient $guardian
     */
    public GuardianClient $guardian;

    /**
     * @var KeysClient $keys
     */
    public KeysClient $keys;

    /**
     * @var RiskAssessmentsClient $riskAssessments
     */
    public RiskAssessmentsClient $riskAssessments;

    /**
     * @var TenantsClient $tenants
     */
    public TenantsClient $tenants;

    /**
     * @var VerifiableCredentialsClient $verifiableCredentials
     */
    public VerifiableCredentialsClient $verifiableCredentials;

    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param string $token The token to use for authentication.
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        string $token,
        ?array $options = null,
    ) {
        $defaultHeaders = [
            'Authorization' => "Bearer $token",
            'X-Fern-Language' => 'PHP',
            'X-Fern-SDK-Name' => 'Auth0\SDK\API\Management',
            'X-Fern-SDK-Version' => '0.0.0',
            'User-Agent' => 'auth0/auth0-php/0.0.0',
        ];

        $this->options = $options ?? [];

        $this->options['headers'] = array_merge(
            $defaultHeaders,
            $this->options['headers'] ?? [],
        );

        $this->client = new RawClient(
            options: $this->options,
        );

        $this->actions = new ActionsClient($this->client, $this->options);
        $this->branding = new BrandingClient($this->client, $this->options);
        $this->clientGrants = new ClientGrantsClient($this->client, $this->options);
        $this->clients = new ClientsClient($this->client, $this->options);
        $this->connectionProfiles = new ConnectionProfilesClient($this->client, $this->options);
        $this->connections = new ConnectionsClient($this->client, $this->options);
        $this->customDomains = new CustomDomainsClient($this->client, $this->options);
        $this->deviceCredentials = new DeviceCredentialsClient($this->client, $this->options);
        $this->emailTemplates = new EmailTemplatesClient($this->client, $this->options);
        $this->eventStreams = new EventStreamsClient($this->client, $this->options);
        $this->flows = new FlowsClient($this->client, $this->options);
        $this->forms = new FormsClient($this->client, $this->options);
        $this->userGrants = new UserGrantsClient($this->client, $this->options);
        $this->groups = new GroupsClient($this->client, $this->options);
        $this->hooks = new HooksClient($this->client, $this->options);
        $this->jobs = new JobsClient($this->client, $this->options);
        $this->logStreams = new LogStreamsClient($this->client, $this->options);
        $this->logs = new LogsClient($this->client, $this->options);
        $this->networkAcls = new NetworkAclsClient($this->client, $this->options);
        $this->organizations = new OrganizationsClient($this->client, $this->options);
        $this->prompts = new PromptsClient($this->client, $this->options);
        $this->refreshTokens = new RefreshTokensClient($this->client, $this->options);
        $this->resourceServers = new ResourceServersClient($this->client, $this->options);
        $this->roles = new RolesClient($this->client, $this->options);
        $this->rules = new RulesClient($this->client, $this->options);
        $this->rulesConfigs = new RulesConfigsClient($this->client, $this->options);
        $this->selfServiceProfiles = new SelfServiceProfilesClient($this->client, $this->options);
        $this->sessions = new SessionsClient($this->client, $this->options);
        $this->stats = new StatsClient($this->client, $this->options);
        $this->supplementalSignals = new SupplementalSignalsClient($this->client, $this->options);
        $this->tickets = new TicketsClient($this->client, $this->options);
        $this->tokenExchangeProfiles = new TokenExchangeProfilesClient($this->client, $this->options);
        $this->userAttributeProfiles = new UserAttributeProfilesClient($this->client, $this->options);
        $this->userBlocks = new UserBlocksClient($this->client, $this->options);
        $this->users = new UsersClient($this->client, $this->options);
        $this->anomaly = new AnomalyClient($this->client, $this->options);
        $this->attackProtection = new AttackProtectionClient($this->client, $this->options);
        $this->emails = new EmailsClient($this->client, $this->options);
        $this->guardian = new GuardianClient($this->client, $this->options);
        $this->keys = new KeysClient($this->client, $this->options);
        $this->riskAssessments = new RiskAssessmentsClient($this->client, $this->options);
        $this->tenants = new TenantsClient($this->client, $this->options);
        $this->verifiableCredentials = new VerifiableCredentialsClient($this->client, $this->options);
    }

    /**
     * @return ActionsClientInterface
     */
    public function getActions(): ActionsClientInterface
    {
        return $this->actions;
    }

    /**
     * @return BrandingClientInterface
     */
    public function getBranding(): BrandingClientInterface
    {
        return $this->branding;
    }

    /**
     * @return ClientGrantsClientInterface
     */
    public function getClientGrants(): ClientGrantsClientInterface
    {
        return $this->clientGrants;
    }

    /**
     * @return ClientsClientInterface
     */
    public function getClients(): ClientsClientInterface
    {
        return $this->clients;
    }

    /**
     * @return ConnectionProfilesClientInterface
     */
    public function getConnectionProfiles(): ConnectionProfilesClientInterface
    {
        return $this->connectionProfiles;
    }

    /**
     * @return ConnectionsClientInterface
     */
    public function getConnections(): ConnectionsClientInterface
    {
        return $this->connections;
    }

    /**
     * @return CustomDomainsClientInterface
     */
    public function getCustomDomains(): CustomDomainsClientInterface
    {
        return $this->customDomains;
    }

    /**
     * @return DeviceCredentialsClientInterface
     */
    public function getDeviceCredentials(): DeviceCredentialsClientInterface
    {
        return $this->deviceCredentials;
    }

    /**
     * @return EmailTemplatesClientInterface
     */
    public function getEmailTemplates(): EmailTemplatesClientInterface
    {
        return $this->emailTemplates;
    }

    /**
     * @return EventStreamsClientInterface
     */
    public function getEventStreams(): EventStreamsClientInterface
    {
        return $this->eventStreams;
    }

    /**
     * @return FlowsClientInterface
     */
    public function getFlows(): FlowsClientInterface
    {
        return $this->flows;
    }

    /**
     * @return FormsClientInterface
     */
    public function getForms(): FormsClientInterface
    {
        return $this->forms;
    }

    /**
     * @return UserGrantsClientInterface
     */
    public function getUserGrants(): UserGrantsClientInterface
    {
        return $this->userGrants;
    }

    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface
    {
        return $this->groups;
    }

    /**
     * @return HooksClientInterface
     */
    public function getHooks(): HooksClientInterface
    {
        return $this->hooks;
    }

    /**
     * @return JobsClientInterface
     */
    public function getJobs(): JobsClientInterface
    {
        return $this->jobs;
    }

    /**
     * @return LogStreamsClientInterface
     */
    public function getLogStreams(): LogStreamsClientInterface
    {
        return $this->logStreams;
    }

    /**
     * @return LogsClientInterface
     */
    public function getLogs(): LogsClientInterface
    {
        return $this->logs;
    }

    /**
     * @return NetworkAclsClientInterface
     */
    public function getNetworkAcls(): NetworkAclsClientInterface
    {
        return $this->networkAcls;
    }

    /**
     * @return OrganizationsClientInterface
     */
    public function getOrganizations(): OrganizationsClientInterface
    {
        return $this->organizations;
    }

    /**
     * @return PromptsClientInterface
     */
    public function getPrompts(): PromptsClientInterface
    {
        return $this->prompts;
    }

    /**
     * @return RefreshTokensClientInterface
     */
    public function getRefreshTokens(): RefreshTokensClientInterface
    {
        return $this->refreshTokens;
    }

    /**
     * @return ResourceServersClientInterface
     */
    public function getResourceServers(): ResourceServersClientInterface
    {
        return $this->resourceServers;
    }

    /**
     * @return RolesClientInterface
     */
    public function getRoles(): RolesClientInterface
    {
        return $this->roles;
    }

    /**
     * @return RulesClientInterface
     */
    public function getRules(): RulesClientInterface
    {
        return $this->rules;
    }

    /**
     * @return RulesConfigsClientInterface
     */
    public function getRulesConfigs(): RulesConfigsClientInterface
    {
        return $this->rulesConfigs;
    }

    /**
     * @return SelfServiceProfilesClientInterface
     */
    public function getSelfServiceProfiles(): SelfServiceProfilesClientInterface
    {
        return $this->selfServiceProfiles;
    }

    /**
     * @return SessionsClientInterface
     */
    public function getSessions(): SessionsClientInterface
    {
        return $this->sessions;
    }

    /**
     * @return StatsClientInterface
     */
    public function getStats(): StatsClientInterface
    {
        return $this->stats;
    }

    /**
     * @return SupplementalSignalsClientInterface
     */
    public function getSupplementalSignals(): SupplementalSignalsClientInterface
    {
        return $this->supplementalSignals;
    }

    /**
     * @return TicketsClientInterface
     */
    public function getTickets(): TicketsClientInterface
    {
        return $this->tickets;
    }

    /**
     * @return TokenExchangeProfilesClientInterface
     */
    public function getTokenExchangeProfiles(): TokenExchangeProfilesClientInterface
    {
        return $this->tokenExchangeProfiles;
    }

    /**
     * @return UserAttributeProfilesClientInterface
     */
    public function getUserAttributeProfiles(): UserAttributeProfilesClientInterface
    {
        return $this->userAttributeProfiles;
    }

    /**
     * @return UserBlocksClientInterface
     */
    public function getUserBlocks(): UserBlocksClientInterface
    {
        return $this->userBlocks;
    }

    /**
     * @return UsersClientInterface
     */
    public function getUsers(): UsersClientInterface
    {
        return $this->users;
    }

    /**
     * @return AnomalyClientInterface
     */
    public function getAnomaly(): AnomalyClientInterface
    {
        return $this->anomaly;
    }

    /**
     * @return AttackProtectionClientInterface
     */
    public function getAttackProtection(): AttackProtectionClientInterface
    {
        return $this->attackProtection;
    }

    /**
     * @return EmailsClientInterface
     */
    public function getEmails(): EmailsClientInterface
    {
        return $this->emails;
    }

    /**
     * @return GuardianClientInterface
     */
    public function getGuardian(): GuardianClientInterface
    {
        return $this->guardian;
    }

    /**
     * @return KeysClientInterface
     */
    public function getKeys(): KeysClientInterface
    {
        return $this->keys;
    }

    /**
     * @return RiskAssessmentsClientInterface
     */
    public function getRiskAssessments(): RiskAssessmentsClientInterface
    {
        return $this->riskAssessments;
    }

    /**
     * @return TenantsClientInterface
     */
    public function getTenants(): TenantsClientInterface
    {
        return $this->tenants;
    }

    /**
     * @return VerifiableCredentialsClientInterface
     */
    public function getVerifiableCredentials(): VerifiableCredentialsClientInterface
    {
        return $this->verifiableCredentials;
    }
}
