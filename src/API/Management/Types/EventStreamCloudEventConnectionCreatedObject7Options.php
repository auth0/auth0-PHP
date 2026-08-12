<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Options for the 'waad' connection
 */
class EventStreamCloudEventConnectionCreatedObject7Options extends JsonSerializableType
{
    /**
     * @var ?bool $apiEnableUsers Enable users API
     */
    #[JsonProperty('api_enable_users')]
    private ?bool $apiEnableUsers;

    /**
     * @var ?string $appDomain The Azure AD application domain (e.g., 'contoso.onmicrosoft.com'). Used primarily with WS-Federation protocol and Azure AD v1 endpoints.
     */
    #[JsonProperty('app_domain')]
    private ?string $appDomain;

    /**
     * @var ?string $appId The Application ID URI (App ID URI) for the Azure AD application. Required when using Azure AD v1 with the Resource Owner Password flow. Used to identify the resource being requested in OAuth token requests.
     */
    #[JsonProperty('app_id')]
    private ?string $appId;

    /**
     * @var ?bool $basicProfile Includes basic user profile information from Azure AD (name, email, given_name, family_name). Always enabled and required - represents the minimum profile data retrieved during authentication.
     */
    #[JsonProperty('basic_profile')]
    private ?bool $basicProfile;

    /**
     * @var ?DateTime $certRolloverNotification Timestamp of the last certificate expiring soon notification.
     */
    #[JsonProperty('cert_rollover_notification'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $certRolloverNotification;

    /**
     * @var string $clientId OAuth 2.0 client identifier issued by the identity provider during application registration. This value identifies your Auth0 connection to the identity provider.
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @var ?string $domain The primary Azure AD tenant domain (e.g., 'contoso.onmicrosoft.com' or 'contoso.com').
     */
    #[JsonProperty('domain')]
    private ?string $domain;

    /**
     * @var ?array<string> $domainAliases Alternative domain names associated with this Azure AD tenant. Allows users from multiple verified domains to authenticate through this connection. Can be an array of domain strings.
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?bool $extGroups When enabled (true), retrieves and stores Azure AD security group memberships for the user. Requires Microsoft Graph API permissions (Directory.Read.All). Allows configuring max_groups_to_retrieve.
     */
    #[JsonProperty('ext_groups')]
    private ?bool $extGroups;

    /**
     * @var ?bool $extNestedGroups When true, stores all groups the user is member of, including transitive group memberships (groups within groups). When false (default), only direct group memberships are included.
     */
    #[JsonProperty('ext_nested_groups')]
    private ?bool $extNestedGroups;

    /**
     * @var ?bool $extProfile When enabled (true), retrieves extended profile attributes from Azure AD via Microsoft Graph API (job title, department, office location, etc.). Requires Graph API permissions. Only available with Azure AD v1 or when explicitly enabled for v2.
     */
    #[JsonProperty('ext_profile')]
    private ?bool $extProfile;

    /**
     * @var ?EventStreamCloudEventConnectionCreatedObject7OptionsFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens
     */
    #[JsonProperty('federated_connections_access_tokens')]
    private ?EventStreamCloudEventConnectionCreatedObject7OptionsFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens;

    /**
     * @var ?bool $granted Indicates whether admin consent has been granted for the required Azure AD permissions. Read-only status field managed by Auth0 during the OAuth authorization flow.
     */
    #[JsonProperty('granted')]
    private ?bool $granted;

    /**
     * @var ?string $iconUrl URL for the connection icon displayed in Auth0 login pages. Accepts HTTPS URLs. Used for visual branding in authentication flows.
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsIdentityApiEnum> $identityApi
     */
    #[JsonProperty('identity_api')]
    private ?string $identityApi;

    /**
     * @var ?string $maxGroupsToRetrieve Maximum number of Azure AD groups to retrieve per user during authentication. Helps prevent performance issues for users in many groups. Only applies when ext_groups is enabled. Leave empty to use platform default.
     */
    #[JsonProperty('max_groups_to_retrieve')]
    private ?string $maxGroupsToRetrieve;

    /**
     * @var ?array<string> $nonPersistentAttrs An array of user fields that should not be stored in the Auth0 database (https://auth0.com/docs/security/data-security/denylist)
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @var ?array<string> $scope OAuth 2.0 scopes to request from Azure AD during authentication. Each scope represents a permission (e.g., 'User.Read', 'Group.Read.All'). Only applies with Microsoft Identity Platform v2.0. See Microsoft Graph permissions reference for available scopes.
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private ?array $scope;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsShouldTrustEmailVerifiedConnectionEnum> $shouldTrustEmailVerifiedConnection
     */
    #[JsonProperty('should_trust_email_verified_connection')]
    private ?string $shouldTrustEmailVerifiedConnection;

    /**
     * @var ?string $tenantDomain
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?string $tenantId The Azure AD tenant ID as a UUID. The unique identifier for your Azure AD organization. Must be a valid 36-character UUID.
     */
    #[JsonProperty('tenantId')]
    private ?string $tenantId;

    /**
     * @var ?array<string> $thumbprints Array of certificate thumbprints (SHA-128/SHA-256/SHA-512 hex hashes) for validating SAML signatures. Used with WS-Federation protocol. Maximum 20 thumbprints. Each thumbprint must be a hexadecimal string.
     */
    #[JsonProperty('thumbprints'), ArrayType(['string'])]
    private ?array $thumbprints;

    /**
     * @var ?array<string, mixed> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => 'mixed'])]
    private ?array $upstreamParams;

    /**
     * @var ?bool $useWsfed Indicates WS-Federation protocol usage. When true, uses WS-Federation; when false, uses OpenID Connect.
     */
    #[JsonProperty('use_wsfed')]
    private ?bool $useWsfed;

    /**
     * @var ?bool $useCommonEndpoint When enabled (true), uses the Azure AD common endpoint for multi-tenant authentication. Allows users from any Azure AD organization to sign in. Requires userid_attribute set to 'sub' (not 'oid'). Cannot be used with SCIM provisioning. Defaults to false.
     */
    #[JsonProperty('useCommonEndpoint')]
    private ?bool $useCommonEndpoint;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsUseridAttributeEnum> $useridAttribute
     */
    #[JsonProperty('userid_attribute')]
    private ?string $useridAttribute;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsWaadProtocolEnum> $waadProtocol
     */
    #[JsonProperty('waad_protocol')]
    private ?string $waadProtocol;

    /**
     * @param array{
     *   clientId: string,
     *   apiEnableUsers?: ?bool,
     *   appDomain?: ?string,
     *   appId?: ?string,
     *   basicProfile?: ?bool,
     *   certRolloverNotification?: ?DateTime,
     *   domain?: ?string,
     *   domainAliases?: ?array<string>,
     *   extGroups?: ?bool,
     *   extNestedGroups?: ?bool,
     *   extProfile?: ?bool,
     *   federatedConnectionsAccessTokens?: ?EventStreamCloudEventConnectionCreatedObject7OptionsFederatedConnectionsAccessTokens,
     *   granted?: ?bool,
     *   iconUrl?: ?string,
     *   identityApi?: ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsIdentityApiEnum>,
     *   maxGroupsToRetrieve?: ?string,
     *   nonPersistentAttrs?: ?array<string>,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsSetUserRootAttributesEnum>,
     *   shouldTrustEmailVerifiedConnection?: ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsShouldTrustEmailVerifiedConnectionEnum>,
     *   tenantDomain?: ?string,
     *   tenantId?: ?string,
     *   thumbprints?: ?array<string>,
     *   upstreamParams?: ?array<string, mixed>,
     *   useWsfed?: ?bool,
     *   useCommonEndpoint?: ?bool,
     *   useridAttribute?: ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsUseridAttributeEnum>,
     *   waadProtocol?: ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsWaadProtocolEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->apiEnableUsers = $values['apiEnableUsers'] ?? null;
        $this->appDomain = $values['appDomain'] ?? null;
        $this->appId = $values['appId'] ?? null;
        $this->basicProfile = $values['basicProfile'] ?? null;
        $this->certRolloverNotification = $values['certRolloverNotification'] ?? null;
        $this->clientId = $values['clientId'];
        $this->domain = $values['domain'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->extGroups = $values['extGroups'] ?? null;
        $this->extNestedGroups = $values['extNestedGroups'] ?? null;
        $this->extProfile = $values['extProfile'] ?? null;
        $this->federatedConnectionsAccessTokens = $values['federatedConnectionsAccessTokens'] ?? null;
        $this->granted = $values['granted'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->identityApi = $values['identityApi'] ?? null;
        $this->maxGroupsToRetrieve = $values['maxGroupsToRetrieve'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->shouldTrustEmailVerifiedConnection = $values['shouldTrustEmailVerifiedConnection'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->tenantId = $values['tenantId'] ?? null;
        $this->thumbprints = $values['thumbprints'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->useWsfed = $values['useWsfed'] ?? null;
        $this->useCommonEndpoint = $values['useCommonEndpoint'] ?? null;
        $this->useridAttribute = $values['useridAttribute'] ?? null;
        $this->waadProtocol = $values['waadProtocol'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getApiEnableUsers(): ?bool
    {
        return $this->apiEnableUsers;
    }

    /**
     * @param ?bool $value
     */
    public function setApiEnableUsers(?bool $value = null): self
    {
        $this->apiEnableUsers = $value;
        $this->_setField('apiEnableUsers');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAppDomain(): ?string
    {
        return $this->appDomain;
    }

    /**
     * @param ?string $value
     */
    public function setAppDomain(?string $value = null): self
    {
        $this->appDomain = $value;
        $this->_setField('appDomain');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAppId(): ?string
    {
        return $this->appId;
    }

    /**
     * @param ?string $value
     */
    public function setAppId(?string $value = null): self
    {
        $this->appId = $value;
        $this->_setField('appId');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBasicProfile(): ?bool
    {
        return $this->basicProfile;
    }

    /**
     * @param ?bool $value
     */
    public function setBasicProfile(?bool $value = null): self
    {
        $this->basicProfile = $value;
        $this->_setField('basicProfile');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCertRolloverNotification(): ?DateTime
    {
        return $this->certRolloverNotification;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCertRolloverNotification(?DateTime $value = null): self
    {
        $this->certRolloverNotification = $value;
        $this->_setField('certRolloverNotification');
        return $this;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $value
     */
    public function setClientId(string $value): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param ?string $value
     */
    public function setDomain(?string $value = null): self
    {
        $this->domain = $value;
        $this->_setField('domain');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getDomainAliases(): ?array
    {
        return $this->domainAliases;
    }

    /**
     * @param ?array<string> $value
     */
    public function setDomainAliases(?array $value = null): self
    {
        $this->domainAliases = $value;
        $this->_setField('domainAliases');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtGroups(): ?bool
    {
        return $this->extGroups;
    }

    /**
     * @param ?bool $value
     */
    public function setExtGroups(?bool $value = null): self
    {
        $this->extGroups = $value;
        $this->_setField('extGroups');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtNestedGroups(): ?bool
    {
        return $this->extNestedGroups;
    }

    /**
     * @param ?bool $value
     */
    public function setExtNestedGroups(?bool $value = null): self
    {
        $this->extNestedGroups = $value;
        $this->_setField('extNestedGroups');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtProfile(): ?bool
    {
        return $this->extProfile;
    }

    /**
     * @param ?bool $value
     */
    public function setExtProfile(?bool $value = null): self
    {
        $this->extProfile = $value;
        $this->_setField('extProfile');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionCreatedObject7OptionsFederatedConnectionsAccessTokens
     */
    public function getFederatedConnectionsAccessTokens(): ?EventStreamCloudEventConnectionCreatedObject7OptionsFederatedConnectionsAccessTokens
    {
        return $this->federatedConnectionsAccessTokens;
    }

    /**
     * @param ?EventStreamCloudEventConnectionCreatedObject7OptionsFederatedConnectionsAccessTokens $value
     */
    public function setFederatedConnectionsAccessTokens(?EventStreamCloudEventConnectionCreatedObject7OptionsFederatedConnectionsAccessTokens $value = null): self
    {
        $this->federatedConnectionsAccessTokens = $value;
        $this->_setField('federatedConnectionsAccessTokens');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGranted(): ?bool
    {
        return $this->granted;
    }

    /**
     * @param ?bool $value
     */
    public function setGranted(?bool $value = null): self
    {
        $this->granted = $value;
        $this->_setField('granted');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    /**
     * @param ?string $value
     */
    public function setIconUrl(?string $value = null): self
    {
        $this->iconUrl = $value;
        $this->_setField('iconUrl');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsIdentityApiEnum>
     */
    public function getIdentityApi(): ?string
    {
        return $this->identityApi;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsIdentityApiEnum> $value
     */
    public function setIdentityApi(?string $value = null): self
    {
        $this->identityApi = $value;
        $this->_setField('identityApi');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMaxGroupsToRetrieve(): ?string
    {
        return $this->maxGroupsToRetrieve;
    }

    /**
     * @param ?string $value
     */
    public function setMaxGroupsToRetrieve(?string $value = null): self
    {
        $this->maxGroupsToRetrieve = $value;
        $this->_setField('maxGroupsToRetrieve');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getNonPersistentAttrs(): ?array
    {
        return $this->nonPersistentAttrs;
    }

    /**
     * @param ?array<string> $value
     */
    public function setNonPersistentAttrs(?array $value = null): self
    {
        $this->nonPersistentAttrs = $value;
        $this->_setField('nonPersistentAttrs');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getScope(): ?array
    {
        return $this->scope;
    }

    /**
     * @param ?array<string> $value
     */
    public function setScope(?array $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsSetUserRootAttributesEnum> $value
     */
    public function setSetUserRootAttributes(?string $value = null): self
    {
        $this->setUserRootAttributes = $value;
        $this->_setField('setUserRootAttributes');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsShouldTrustEmailVerifiedConnectionEnum>
     */
    public function getShouldTrustEmailVerifiedConnection(): ?string
    {
        return $this->shouldTrustEmailVerifiedConnection;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsShouldTrustEmailVerifiedConnectionEnum> $value
     */
    public function setShouldTrustEmailVerifiedConnection(?string $value = null): self
    {
        $this->shouldTrustEmailVerifiedConnection = $value;
        $this->_setField('shouldTrustEmailVerifiedConnection');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTenantDomain(): ?string
    {
        return $this->tenantDomain;
    }

    /**
     * @param ?string $value
     */
    public function setTenantDomain(?string $value = null): self
    {
        $this->tenantDomain = $value;
        $this->_setField('tenantDomain');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }

    /**
     * @param ?string $value
     */
    public function setTenantId(?string $value = null): self
    {
        $this->tenantId = $value;
        $this->_setField('tenantId');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getThumbprints(): ?array
    {
        return $this->thumbprints;
    }

    /**
     * @param ?array<string> $value
     */
    public function setThumbprints(?array $value = null): self
    {
        $this->thumbprints = $value;
        $this->_setField('thumbprints');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getUpstreamParams(): ?array
    {
        return $this->upstreamParams;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setUpstreamParams(?array $value = null): self
    {
        $this->upstreamParams = $value;
        $this->_setField('upstreamParams');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUseWsfed(): ?bool
    {
        return $this->useWsfed;
    }

    /**
     * @param ?bool $value
     */
    public function setUseWsfed(?bool $value = null): self
    {
        $this->useWsfed = $value;
        $this->_setField('useWsfed');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUseCommonEndpoint(): ?bool
    {
        return $this->useCommonEndpoint;
    }

    /**
     * @param ?bool $value
     */
    public function setUseCommonEndpoint(?bool $value = null): self
    {
        $this->useCommonEndpoint = $value;
        $this->_setField('useCommonEndpoint');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsUseridAttributeEnum>
     */
    public function getUseridAttribute(): ?string
    {
        return $this->useridAttribute;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsUseridAttributeEnum> $value
     */
    public function setUseridAttribute(?string $value = null): self
    {
        $this->useridAttribute = $value;
        $this->_setField('useridAttribute');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsWaadProtocolEnum>
     */
    public function getWaadProtocol(): ?string
    {
        return $this->waadProtocol;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedObject7OptionsWaadProtocolEnum> $value
     */
    public function setWaadProtocol(?string $value = null): self
    {
        $this->waadProtocol = $value;
        $this->_setField('waadProtocol');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
