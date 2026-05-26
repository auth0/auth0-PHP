<?php

namespace Auth0\SDK\API\Management;

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
use Auth0\SDK\API\Management\Events\EventsClientInterface;
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
use Auth0\SDK\API\Management\RateLimitPolicies\RateLimitPoliciesClientInterface;
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

interface ManagementInterface
{
    /**
     * @return ActionsClientInterface
     */
    public function getActions(): ActionsClientInterface;

    /**
     * @return BrandingClientInterface
     */
    public function getBranding(): BrandingClientInterface;

    /**
     * @return ClientGrantsClientInterface
     */
    public function getClientGrants(): ClientGrantsClientInterface;

    /**
     * @return ClientsClientInterface
     */
    public function getClients(): ClientsClientInterface;

    /**
     * @return ConnectionProfilesClientInterface
     */
    public function getConnectionProfiles(): ConnectionProfilesClientInterface;

    /**
     * @return ConnectionsClientInterface
     */
    public function getConnections(): ConnectionsClientInterface;

    /**
     * @return CustomDomainsClientInterface
     */
    public function getCustomDomains(): CustomDomainsClientInterface;

    /**
     * @return DeviceCredentialsClientInterface
     */
    public function getDeviceCredentials(): DeviceCredentialsClientInterface;

    /**
     * @return EmailTemplatesClientInterface
     */
    public function getEmailTemplates(): EmailTemplatesClientInterface;

    /**
     * @return EventStreamsClientInterface
     */
    public function getEventStreams(): EventStreamsClientInterface;

    /**
     * @return EventsClientInterface
     */
    public function getEvents(): EventsClientInterface;

    /**
     * @return FlowsClientInterface
     */
    public function getFlows(): FlowsClientInterface;

    /**
     * @return FormsClientInterface
     */
    public function getForms(): FormsClientInterface;

    /**
     * @return UserGrantsClientInterface
     */
    public function getUserGrants(): UserGrantsClientInterface;

    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface;

    /**
     * @return HooksClientInterface
     */
    public function getHooks(): HooksClientInterface;

    /**
     * @return JobsClientInterface
     */
    public function getJobs(): JobsClientInterface;

    /**
     * @return LogStreamsClientInterface
     */
    public function getLogStreams(): LogStreamsClientInterface;

    /**
     * @return LogsClientInterface
     */
    public function getLogs(): LogsClientInterface;

    /**
     * @return NetworkAclsClientInterface
     */
    public function getNetworkAcls(): NetworkAclsClientInterface;

    /**
     * @return OrganizationsClientInterface
     */
    public function getOrganizations(): OrganizationsClientInterface;

    /**
     * @return PromptsClientInterface
     */
    public function getPrompts(): PromptsClientInterface;

    /**
     * @return RateLimitPoliciesClientInterface
     */
    public function getRateLimitPolicies(): RateLimitPoliciesClientInterface;

    /**
     * @return RefreshTokensClientInterface
     */
    public function getRefreshTokens(): RefreshTokensClientInterface;

    /**
     * @return ResourceServersClientInterface
     */
    public function getResourceServers(): ResourceServersClientInterface;

    /**
     * @return RolesClientInterface
     */
    public function getRoles(): RolesClientInterface;

    /**
     * @return RulesClientInterface
     */
    public function getRules(): RulesClientInterface;

    /**
     * @return RulesConfigsClientInterface
     */
    public function getRulesConfigs(): RulesConfigsClientInterface;

    /**
     * @return SelfServiceProfilesClientInterface
     */
    public function getSelfServiceProfiles(): SelfServiceProfilesClientInterface;

    /**
     * @return SessionsClientInterface
     */
    public function getSessions(): SessionsClientInterface;

    /**
     * @return StatsClientInterface
     */
    public function getStats(): StatsClientInterface;

    /**
     * @return SupplementalSignalsClientInterface
     */
    public function getSupplementalSignals(): SupplementalSignalsClientInterface;

    /**
     * @return TicketsClientInterface
     */
    public function getTickets(): TicketsClientInterface;

    /**
     * @return TokenExchangeProfilesClientInterface
     */
    public function getTokenExchangeProfiles(): TokenExchangeProfilesClientInterface;

    /**
     * @return UserAttributeProfilesClientInterface
     */
    public function getUserAttributeProfiles(): UserAttributeProfilesClientInterface;

    /**
     * @return UserBlocksClientInterface
     */
    public function getUserBlocks(): UserBlocksClientInterface;

    /**
     * @return UsersClientInterface
     */
    public function getUsers(): UsersClientInterface;

    /**
     * @return AnomalyClientInterface
     */
    public function getAnomaly(): AnomalyClientInterface;

    /**
     * @return AttackProtectionClientInterface
     */
    public function getAttackProtection(): AttackProtectionClientInterface;

    /**
     * @return EmailsClientInterface
     */
    public function getEmails(): EmailsClientInterface;

    /**
     * @return GuardianClientInterface
     */
    public function getGuardian(): GuardianClientInterface;

    /**
     * @return KeysClientInterface
     */
    public function getKeys(): KeysClientInterface;

    /**
     * @return RiskAssessmentsClientInterface
     */
    public function getRiskAssessments(): RiskAssessmentsClientInterface;

    /**
     * @return TenantsClientInterface
     */
    public function getTenants(): TenantsClientInterface;

    /**
     * @return VerifiableCredentialsClientInterface
     */
    public function getVerifiableCredentials(): VerifiableCredentialsClientInterface;
}
