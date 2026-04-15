<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'google-apps' connection
 */
class ConnectionOptionsGoogleApps extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?string $adminAccessToken
     */
    #[JsonProperty('admin_access_token')]
    private ?string $adminAccessToken;

    /**
     * @var ?DateTime $adminAccessTokenExpiresin
     */
    #[JsonProperty('admin_access_token_expiresin'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $adminAccessTokenExpiresin;

    /**
     * @var ?string $adminRefreshToken
     */
    #[JsonProperty('admin_refresh_token')]
    private ?string $adminRefreshToken;

    /**
     * @var ?bool $allowSettingLoginScopes When true, allows customization of OAuth scopes requested during user login. Custom scopes are appended to the mandatory email and profile scopes. When false or omitted, only the default email and profile scopes are used. This property is automatically enabled when Token Vault or Connected Accounts features are activated.
     */
    #[JsonProperty('allow_setting_login_scopes')]
    private ?bool $allowSettingLoginScopes;

    /**
     * @var ?bool $apiEnableGroups
     */
    #[JsonProperty('api_enable_groups')]
    private ?bool $apiEnableGroups;

    /**
     * @var ?bool $apiEnableUsers
     */
    #[JsonProperty('api_enable_users')]
    private ?bool $apiEnableUsers;

    /**
     * @var string $clientId
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @var ?string $clientSecret
     */
    #[JsonProperty('client_secret')]
    private ?string $clientSecret;

    /**
     * @var ?string $domain
     */
    #[JsonProperty('domain')]
    private ?string $domain;

    /**
     * @var ?array<string> $domainAliases
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?bool $email Whether the OAuth flow requests the `email` scope.
     */
    #[JsonProperty('email')]
    private ?bool $email;

    /**
     * @var ?bool $extAgreedTerms
     */
    #[JsonProperty('ext_agreed_terms')]
    private ?bool $extAgreedTerms;

    /**
     * @var ?bool $extGroups
     */
    #[JsonProperty('ext_groups')]
    private ?bool $extGroups;

    /**
     * @var ?bool $extGroupsExtended Controls whether enriched group entries include `id`, `email`, `name` (true) or only the group name (false); can only be set when `ext_groups` is true.
     */
    #[JsonProperty('ext_groups_extended')]
    private ?bool $extGroupsExtended;

    /**
     * @var ?bool $extIsAdmin
     */
    #[JsonProperty('ext_is_admin')]
    private ?bool $extIsAdmin;

    /**
     * @var ?bool $extIsSuspended
     */
    #[JsonProperty('ext_is_suspended')]
    private ?bool $extIsSuspended;

    /**
     * @var ?ConnectionFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens
     */
    #[JsonProperty('federated_connections_access_tokens')]
    private ?ConnectionFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens;

    /**
     * @var ?bool $handleLoginFromSocial
     */
    #[JsonProperty('handle_login_from_social')]
    private ?bool $handleLoginFromSocial;

    /**
     * @var ?string $iconUrl
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?bool $mapUserIdToId Determines how Auth0 generates the user_id for Google Workspace users. When false (default), the user's email address is used. When true, Google's stable numeric user ID is used instead, which persists even if the user's email changes. This setting can only be configured when creating the connection and cannot be changed afterward.
     */
    #[JsonProperty('map_user_id_to_id')]
    private ?bool $mapUserIdToId;

    /**
     * @var ?bool $profile Whether the OAuth flow requests the `profile` scope.
     */
    #[JsonProperty('profile')]
    private ?bool $profile;

    /**
     * @var ?array<string> $scope
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private ?array $scope;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?string $tenantDomain
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @param array{
     *   clientId: string,
     *   nonPersistentAttrs?: ?array<string>,
     *   adminAccessToken?: ?string,
     *   adminAccessTokenExpiresin?: ?DateTime,
     *   adminRefreshToken?: ?string,
     *   allowSettingLoginScopes?: ?bool,
     *   apiEnableGroups?: ?bool,
     *   apiEnableUsers?: ?bool,
     *   clientSecret?: ?string,
     *   domain?: ?string,
     *   domainAliases?: ?array<string>,
     *   email?: ?bool,
     *   extAgreedTerms?: ?bool,
     *   extGroups?: ?bool,
     *   extGroupsExtended?: ?bool,
     *   extIsAdmin?: ?bool,
     *   extIsSuspended?: ?bool,
     *   federatedConnectionsAccessTokens?: ?ConnectionFederatedConnectionsAccessTokens,
     *   handleLoginFromSocial?: ?bool,
     *   iconUrl?: ?string,
     *   mapUserIdToId?: ?bool,
     *   profile?: ?bool,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   tenantDomain?: ?string,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->adminAccessToken = $values['adminAccessToken'] ?? null;
        $this->adminAccessTokenExpiresin = $values['adminAccessTokenExpiresin'] ?? null;
        $this->adminRefreshToken = $values['adminRefreshToken'] ?? null;
        $this->allowSettingLoginScopes = $values['allowSettingLoginScopes'] ?? null;
        $this->apiEnableGroups = $values['apiEnableGroups'] ?? null;
        $this->apiEnableUsers = $values['apiEnableUsers'] ?? null;
        $this->clientId = $values['clientId'];
        $this->clientSecret = $values['clientSecret'] ?? null;
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
        $this->profile = $values['profile'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAdminAccessToken(): ?string
    {
        return $this->adminAccessToken;
    }

    /**
     * @param ?string $value
     */
    public function setAdminAccessToken(?string $value = null): self
    {
        $this->adminAccessToken = $value;
        $this->_setField('adminAccessToken');
        return $this;
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
     * @return ?string
     */
    public function getAdminRefreshToken(): ?string
    {
        return $this->adminRefreshToken;
    }

    /**
     * @param ?string $value
     */
    public function setAdminRefreshToken(?string $value = null): self
    {
        $this->adminRefreshToken = $value;
        $this->_setField('adminRefreshToken');
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
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * @param ?string $value
     */
    public function setClientSecret(?string $value = null): self
    {
        $this->clientSecret = $value;
        $this->_setField('clientSecret');
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
     * @return ?ConnectionFederatedConnectionsAccessTokens
     */
    public function getFederatedConnectionsAccessTokens(): ?ConnectionFederatedConnectionsAccessTokens
    {
        return $this->federatedConnectionsAccessTokens;
    }

    /**
     * @param ?ConnectionFederatedConnectionsAccessTokens $value
     */
    public function setFederatedConnectionsAccessTokens(?ConnectionFederatedConnectionsAccessTokens $value = null): self
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
     * @return ?value-of<ConnectionSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<ConnectionSetUserRootAttributesEnum> $value
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
     * @return ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>
     */
    public function getUpstreamParams(): ?array
    {
        return $this->upstreamParams;
    }

    /**
     * @param ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $value
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
