<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use DateTime;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Date;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Options for the 'google-apps' connection
 */
class EventStreamCloudEventConnectionUpdatedObject6Options extends JsonSerializableType
{
    /**
     * @var ?DateTime $adminAccessTokenExpiresin Expiration timestamp for the `admin_access_token` in ISO 8601 format. Auth0 uses this value to determine when to refresh the token.
     */
    #[JsonProperty('admin_access_token_expiresin'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $adminAccessTokenExpiresin;

    /**
     * @var ?bool $allowSettingLoginScopes When true, allows customization of OAuth scopes requested during user login. Custom scopes are appended to the mandatory email and profile scopes. When false or omitted, only the default email and profile scopes are used. This property is automatically enabled when Token Vault or Connected Accounts features are activated.
     */
    #[JsonProperty('allow_setting_login_scopes')]
    private ?bool $allowSettingLoginScopes;

    /**
     * @var ?bool $apiEnableGroups Enables integration with the Google Workspace Admin SDK Directory API for groups. When true, Auth0 can synchronize groups & group memberships and supports inbound directory provisioning for groups. Defaults to false.
     */
    #[JsonProperty('api_enable_groups')]
    private ?bool $apiEnableGroups;

    /**
     * @var ?bool $apiEnableUsers Enables integration with the Google Workspace Admin SDK Directory API. When true, Auth0 can retrieve extended user attributes (admin status, suspension status, group memberships) and supports inbound directory provisioning (SCIM). Defaults to true.
     */
    #[JsonProperty('api_enable_users')]
    private ?bool $apiEnableUsers;

    /**
     * @var string $clientId Your Google OAuth 2.0 client ID. You can find this in your [Google Cloud Console](https://console.cloud.google.com/apis/credentials) under the OAuth 2.0 Client IDs section.
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @var ?string $domain Primary Google Workspace domain name that users must belong to.
     */
    #[JsonProperty('domain')]
    private ?string $domain;

    /**
     * @var ?array<string> $domainAliases Email domains associated with this connection for Home Realm Discovery (HRD). When a user's email matches one of these domains, they are automatically routed to this connection during authentication.
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?bool $email Whether the OAuth flow requests the `email` scope.
     */
    #[JsonProperty('email')]
    private ?bool $email;

    /**
     * @var ?bool $extAgreedTerms Fetches the `agreedToTerms` flag from the Google Directory profile.
     */
    #[JsonProperty('ext_agreed_terms')]
    private ?bool $extAgreedTerms;

    /**
     * @var ?bool $extGroups Enables enrichment with Google group memberships (required for `ext_groups_extended`).
     */
    #[JsonProperty('ext_groups')]
    private ?bool $extGroups;

    /**
     * @var ?bool $extGroupsExtended Controls whether enriched group entries include `id`, `email`, `name` (true) or only the group name (false); can only be set when `ext_groups` is true.
     */
    #[JsonProperty('ext_groups_extended')]
    private ?bool $extGroupsExtended;

    /**
     * @var ?bool $extIsAdmin Fetches the Google Directory admin flag for the signing-in user.
     */
    #[JsonProperty('ext_is_admin')]
    private ?bool $extIsAdmin;

    /**
     * @var ?bool $extIsSuspended Fetches the Google Directory suspended flag for the signing-in user.
     */
    #[JsonProperty('ext_is_suspended')]
    private ?bool $extIsSuspended;

    /**
     * @var ?EventStreamCloudEventConnectionUpdatedObject6OptionsFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens
     */
    #[JsonProperty('federated_connections_access_tokens')]
    private ?EventStreamCloudEventConnectionUpdatedObject6OptionsFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens;

    /**
     * @var ?bool $handleLoginFromSocial When enabled, users who sign in with their Google account through a social login will be automatically routed to this Google Workspace connection if their email domain matches the configured tenant_domain or domain_aliases. This ensures enterprise users authenticate through their organization's Google Workspace identity provider rather than through a generic Google social login, enabling access to directory-based attributes and enforcing organizational security policies. Defaults to true for new connections.
     */
    #[JsonProperty('handle_login_from_social')]
    private ?bool $handleLoginFromSocial;

    /**
     * @var ?string $iconUrl URL for the connection icon displayed in Auth0 login pages. Accepts HTTPS URLs. Used for visual branding in authentication flows.
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?bool $mapUserIdToId Determines how Auth0 generates the user_id for Google Workspace users. When false (default), the user's email address is used. When true, Google's stable numeric user ID is used instead, which persists even if the user's email changes. This setting can only be configured when creating the connection and cannot be changed afterward.
     */
    #[JsonProperty('map_user_id_to_id')]
    private ?bool $mapUserIdToId;

    /**
     * @var ?array<string> $nonPersistentAttrs An array of user fields that should not be stored in the Auth0 database (https://auth0.com/docs/security/data-security/denylist)
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @var ?bool $profile Whether the OAuth flow requests the `profile` scope.
     */
    #[JsonProperty('profile')]
    private ?bool $profile;

    /**
     * @var ?array<string> $scope Additional OAuth scopes requested beyond the default `email profile` scopes; ignored unless `allow_setting_login_scopes` is true.
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private ?array $scope;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionUpdatedObject6OptionsSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?string $tenantDomain The Google Workspace primary domain used to identify the organization during authentication.
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?array<string, mixed> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => 'mixed'])]
    private ?array $upstreamParams;

    /**
     * @param array{
     *   clientId: string,
     *   adminAccessTokenExpiresin?: ?DateTime,
     *   allowSettingLoginScopes?: ?bool,
     *   apiEnableGroups?: ?bool,
     *   apiEnableUsers?: ?bool,
     *   domain?: ?string,
     *   domainAliases?: ?array<string>,
     *   email?: ?bool,
     *   extAgreedTerms?: ?bool,
     *   extGroups?: ?bool,
     *   extGroupsExtended?: ?bool,
     *   extIsAdmin?: ?bool,
     *   extIsSuspended?: ?bool,
     *   federatedConnectionsAccessTokens?: ?EventStreamCloudEventConnectionUpdatedObject6OptionsFederatedConnectionsAccessTokens,
     *   handleLoginFromSocial?: ?bool,
     *   iconUrl?: ?string,
     *   mapUserIdToId?: ?bool,
     *   nonPersistentAttrs?: ?array<string>,
     *   profile?: ?bool,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<EventStreamCloudEventConnectionUpdatedObject6OptionsSetUserRootAttributesEnum>,
     *   tenantDomain?: ?string,
     *   upstreamParams?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->adminAccessTokenExpiresin = $values['adminAccessTokenExpiresin'] ?? null;
        $this->allowSettingLoginScopes = $values['allowSettingLoginScopes'] ?? null;
        $this->apiEnableGroups = $values['apiEnableGroups'] ?? null;
        $this->apiEnableUsers = $values['apiEnableUsers'] ?? null;
        $this->clientId = $values['clientId'];
        $this->domain = $values['domain'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->extAgreedTerms = $values['extAgreedTerms'] ?? null;
        $this->extGroups = $values['extGroups'] ?? null;
        $this->extGroupsExtended = $values['extGroupsExtended'] ?? null;
        $this->extIsAdmin = $values['extIsAdmin'] ?? null;
        $this->extIsSuspended = $values['extIsSuspended'] ?? null;
        $this->federatedConnectionsAccessTokens = $values['federatedConnectionsAccessTokens'] ?? null;
        $this->handleLoginFromSocial = $values['handleLoginFromSocial'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->mapUserIdToId = $values['mapUserIdToId'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
    }

    /**
     * @return ?DateTime
     */
    public function getAdminAccessTokenExpiresin(): ?DateTime
    {
        return $this->adminAccessTokenExpiresin;
    }

    /**
     * @param ?DateTime $value
     */
    public function setAdminAccessTokenExpiresin(?DateTime $value = null): self
    {
        $this->adminAccessTokenExpiresin = $value;
        $this->_setField('adminAccessTokenExpiresin');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowSettingLoginScopes(): ?bool
    {
        return $this->allowSettingLoginScopes;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowSettingLoginScopes(?bool $value = null): self
    {
        $this->allowSettingLoginScopes = $value;
        $this->_setField('allowSettingLoginScopes');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getApiEnableGroups(): ?bool
    {
        return $this->apiEnableGroups;
    }

    /**
     * @param ?bool $value
     */
    public function setApiEnableGroups(?bool $value = null): self
    {
        $this->apiEnableGroups = $value;
        $this->_setField('apiEnableGroups');
        return $this;
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
    public function getEmail(): ?bool
    {
        return $this->email;
    }

    /**
     * @param ?bool $value
     */
    public function setEmail(?bool $value = null): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtAgreedTerms(): ?bool
    {
        return $this->extAgreedTerms;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAgreedTerms(?bool $value = null): self
    {
        $this->extAgreedTerms = $value;
        $this->_setField('extAgreedTerms');
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
    public function getExtGroupsExtended(): ?bool
    {
        return $this->extGroupsExtended;
    }

    /**
     * @param ?bool $value
     */
    public function setExtGroupsExtended(?bool $value = null): self
    {
        $this->extGroupsExtended = $value;
        $this->_setField('extGroupsExtended');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtIsAdmin(): ?bool
    {
        return $this->extIsAdmin;
    }

    /**
     * @param ?bool $value
     */
    public function setExtIsAdmin(?bool $value = null): self
    {
        $this->extIsAdmin = $value;
        $this->_setField('extIsAdmin');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtIsSuspended(): ?bool
    {
        return $this->extIsSuspended;
    }

    /**
     * @param ?bool $value
     */
    public function setExtIsSuspended(?bool $value = null): self
    {
        $this->extIsSuspended = $value;
        $this->_setField('extIsSuspended');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionUpdatedObject6OptionsFederatedConnectionsAccessTokens
     */
    public function getFederatedConnectionsAccessTokens(): ?EventStreamCloudEventConnectionUpdatedObject6OptionsFederatedConnectionsAccessTokens
    {
        return $this->federatedConnectionsAccessTokens;
    }

    /**
     * @param ?EventStreamCloudEventConnectionUpdatedObject6OptionsFederatedConnectionsAccessTokens $value
     */
    public function setFederatedConnectionsAccessTokens(?EventStreamCloudEventConnectionUpdatedObject6OptionsFederatedConnectionsAccessTokens $value = null): self
    {
        $this->federatedConnectionsAccessTokens = $value;
        $this->_setField('federatedConnectionsAccessTokens');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getHandleLoginFromSocial(): ?bool
    {
        return $this->handleLoginFromSocial;
    }

    /**
     * @param ?bool $value
     */
    public function setHandleLoginFromSocial(?bool $value = null): self
    {
        $this->handleLoginFromSocial = $value;
        $this->_setField('handleLoginFromSocial');
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
     * @return ?bool
     */
    public function getMapUserIdToId(): ?bool
    {
        return $this->mapUserIdToId;
    }

    /**
     * @param ?bool $value
     */
    public function setMapUserIdToId(?bool $value = null): self
    {
        $this->mapUserIdToId = $value;
        $this->_setField('mapUserIdToId');
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
     * @return ?bool
     */
    public function getProfile(): ?bool
    {
        return $this->profile;
    }

    /**
     * @param ?bool $value
     */
    public function setProfile(?bool $value = null): self
    {
        $this->profile = $value;
        $this->_setField('profile');
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
     * @return ?value-of<EventStreamCloudEventConnectionUpdatedObject6OptionsSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionUpdatedObject6OptionsSetUserRootAttributesEnum> $value
     */
    public function setSetUserRootAttributes(?string $value = null): self
    {
        $this->setUserRootAttributes = $value;
        $this->_setField('setUserRootAttributes');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
