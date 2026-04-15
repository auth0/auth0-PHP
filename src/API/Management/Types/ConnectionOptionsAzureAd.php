<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'waad' connection
 */
class ConnectionOptionsAzureAd extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?bool $apiEnableUsers Enable users API
     */
    #[JsonProperty('api_enable_users')]
    private ?bool $apiEnableUsers;

    /**
     * @var ?string $appDomain
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
     * @var ?array<string> $domainAliases
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?bool $extAccessToken When false, prevents storing the user's Azure AD access token in the Auth0 user profile. When true (default), the access token is persisted for API access.
     */
    #[JsonProperty('ext_access_token')]
    private ?bool $extAccessToken;

    /**
     * @var ?bool $extAccountEnabled When false, prevents storing whether the user's Azure AD account is enabled. When true (default), the account enabled status is persisted in the user profile.
     */
    #[JsonProperty('ext_account_enabled')]
    private ?bool $extAccountEnabled;

    /**
     * @var ?bool $extAdmin
     */
    #[JsonProperty('ext_admin')]
    private ?bool $extAdmin;

    /**
     * @var ?bool $extAgreedTerms
     */
    #[JsonProperty('ext_agreed_terms')]
    private ?bool $extAgreedTerms;

    /**
     * @var ?bool $extAssignedLicenses When false, prevents storing the list of Microsoft 365/Office 365 licenses assigned to the user. When true (default), license information is persisted in the user profile.
     */
    #[JsonProperty('ext_assigned_licenses')]
    private ?bool $extAssignedLicenses;

    /**
     * @var ?bool $extAssignedPlans
     */
    #[JsonProperty('ext_assigned_plans')]
    private ?bool $extAssignedPlans;

    /**
     * @var ?bool $extAzureId When false, prevents storing the user's Azure ID identifier. When true (default), the Azure ID is persisted. Note: 'oid' (Object ID) is the recommended unique identifier for single-tenant connections.
     */
    #[JsonProperty('ext_azure_id')]
    private ?bool $extAzureId;

    /**
     * @var ?bool $extCity When false, prevents storing the user's city from Azure AD. When true (default), city information is persisted in the user profile.
     */
    #[JsonProperty('ext_city')]
    private ?bool $extCity;

    /**
     * @var ?bool $extCountry When false, prevents storing the user's country from Azure AD. When true (default), country information is persisted in the user profile.
     */
    #[JsonProperty('ext_country')]
    private ?bool $extCountry;

    /**
     * @var ?bool $extDepartment When false, prevents storing the user's department from Azure AD. When true (default), department information is persisted in the user profile.
     */
    #[JsonProperty('ext_department')]
    private ?bool $extDepartment;

    /**
     * @var ?bool $extDirSyncEnabled When false, prevents storing whether directory synchronization is enabled for the user. When true (default), directory sync status is persisted in the user profile.
     */
    #[JsonProperty('ext_dir_sync_enabled')]
    private ?bool $extDirSyncEnabled;

    /**
     * @var ?bool $extEmail When false, prevents storing the user's email address from Azure AD. When true (default), email is persisted in the user profile.
     */
    #[JsonProperty('ext_email')]
    private ?bool $extEmail;

    /**
     * @var ?bool $extExpiresIn When false, prevents storing the token expiration time (in seconds). When true (default), expiration information is persisted in the user profile.
     */
    #[JsonProperty('ext_expires_in')]
    private ?bool $extExpiresIn;

    /**
     * @var ?bool $extFamilyName When false, prevents storing the user's family name (last name) from Azure AD. When true (default), family name is persisted in the user profile.
     */
    #[JsonProperty('ext_family_name')]
    private ?bool $extFamilyName;

    /**
     * @var ?bool $extFax When false, prevents storing the user's fax number from Azure AD. When true (default), fax information is persisted in the user profile.
     */
    #[JsonProperty('ext_fax')]
    private ?bool $extFax;

    /**
     * @var ?bool $extGivenName When false, prevents storing the user's given name (first name) from Azure AD. When true (default), given name is persisted in the user profile.
     */
    #[JsonProperty('ext_given_name')]
    private ?bool $extGivenName;

    /**
     * @var ?bool $extGroupIds When false, prevents storing the list of Azure AD group IDs the user is a member of. When true (default), group membership IDs are persisted. See ext_groups for retrieving group details.
     */
    #[JsonProperty('ext_group_ids')]
    private ?bool $extGroupIds;

    /**
     * @var ?bool $extGroups
     */
    #[JsonProperty('ext_groups')]
    private ?bool $extGroups;

    /**
     * @var ?bool $extIsSuspended
     */
    #[JsonProperty('ext_is_suspended')]
    private ?bool $extIsSuspended;

    /**
     * @var ?bool $extJobTitle When false, prevents storing the user's job title from Azure AD. When true (default), job title information is persisted in the user profile.
     */
    #[JsonProperty('ext_job_title')]
    private ?bool $extJobTitle;

    /**
     * @var ?bool $extLastSync When false, prevents storing the timestamp of the last directory synchronization. When true (default), the last sync date is persisted in the user profile.
     */
    #[JsonProperty('ext_last_sync')]
    private ?bool $extLastSync;

    /**
     * @var ?bool $extMobile When false, prevents storing the user's mobile phone number from Azure AD. When true (default), mobile number is persisted in the user profile.
     */
    #[JsonProperty('ext_mobile')]
    private ?bool $extMobile;

    /**
     * @var ?bool $extName When false, prevents storing the user's full name from Azure AD. When true (default), full name is persisted in the user profile.
     */
    #[JsonProperty('ext_name')]
    private ?bool $extName;

    /**
     * @var ?bool $extNestedGroups When true, stores all groups the user is member of, including transitive group memberships (groups within groups). When false (default), only direct group memberships are included.
     */
    #[JsonProperty('ext_nested_groups')]
    private ?bool $extNestedGroups;

    /**
     * @var ?bool $extNickname When false, prevents storing the user's nickname or display name from Azure AD. When true (default), nickname is persisted in the user profile.
     */
    #[JsonProperty('ext_nickname')]
    private ?bool $extNickname;

    /**
     * @var ?bool $extOid When false, prevents storing the user's Object ID (oid) from Azure AD. When true (default), the oid is persisted. Note: 'oid' is the recommended unique identifier for single-tenant connections and required for SCIM.
     */
    #[JsonProperty('ext_oid')]
    private ?bool $extOid;

    /**
     * @var ?bool $extPhone When false, prevents storing the user's phone number from Azure AD. When true (default), phone number is persisted in the user profile.
     */
    #[JsonProperty('ext_phone')]
    private ?bool $extPhone;

    /**
     * @var ?bool $extPhysicalDeliveryOfficeName When false, prevents storing the user's office location from Azure AD. When true (default), office location is persisted in the user profile.
     */
    #[JsonProperty('ext_physical_delivery_office_name')]
    private ?bool $extPhysicalDeliveryOfficeName;

    /**
     * @var ?bool $extPostalCode When false, prevents storing the user's postal code from Azure AD. When true (default), postal code is persisted in the user profile.
     */
    #[JsonProperty('ext_postal_code')]
    private ?bool $extPostalCode;

    /**
     * @var ?bool $extPreferredLanguage When false, prevents storing the user's preferred language from Azure AD. When true (default), language preference is persisted in the user profile.
     */
    #[JsonProperty('ext_preferred_language')]
    private ?bool $extPreferredLanguage;

    /**
     * @var ?bool $extProfile
     */
    #[JsonProperty('ext_profile')]
    private ?bool $extProfile;

    /**
     * @var ?bool $extProvisionedPlans When false, prevents storing the list of service plans provisioned to the user. When true (default), provisioned plans are persisted in the user profile.
     */
    #[JsonProperty('ext_provisioned_plans')]
    private ?bool $extProvisionedPlans;

    /**
     * @var ?bool $extProvisioningErrors When false, prevents storing provisioning errors that occurred during synchronization. When true (default), error information is persisted. Useful for troubleshooting sync issues.
     */
    #[JsonProperty('ext_provisioning_errors')]
    private ?bool $extProvisioningErrors;

    /**
     * @var ?bool $extProxyAddresses When false, prevents storing all proxy email addresses (email aliases) for the user. When true (default), proxy addresses are persisted in the user profile.
     */
    #[JsonProperty('ext_proxy_addresses')]
    private ?bool $extProxyAddresses;

    /**
     * @var ?bool $extPuid When false, prevents storing the user's Passport User ID (puid). When true (default), puid is persisted in the user profile. Legacy attribute.
     */
    #[JsonProperty('ext_puid')]
    private ?bool $extPuid;

    /**
     * @var ?bool $extRefreshToken When false, prevents storing the Azure AD refresh token. When true (default), the refresh token is persisted for offline access. Required for token refresh in long-lived applications.
     */
    #[JsonProperty('ext_refresh_token')]
    private ?bool $extRefreshToken;

    /**
     * @var ?bool $extRoles When false, prevents storing Azure AD application roles assigned to the user. When true (default), role information is persisted. Useful for RBAC in applications.
     */
    #[JsonProperty('ext_roles')]
    private ?bool $extRoles;

    /**
     * @var ?bool $extState When false, prevents storing the user's state (province/region) from Azure AD. When true (default), state information is persisted in the user profile.
     */
    #[JsonProperty('ext_state')]
    private ?bool $extState;

    /**
     * @var ?bool $extStreet When false, prevents storing the user's street address from Azure AD. When true (default), street address is persisted in the user profile.
     */
    #[JsonProperty('ext_street')]
    private ?bool $extStreet;

    /**
     * @var ?bool $extTelephoneNumber When false, prevents storing the user's telephone number from Azure AD. When true (default), telephone number is persisted in the user profile.
     */
    #[JsonProperty('ext_telephoneNumber')]
    private ?bool $extTelephoneNumber;

    /**
     * @var ?bool $extTenantid When false, prevents storing the user's Azure AD tenant ID. When true (default), tenant ID is persisted. Useful for identifying which Azure AD organization the user belongs to.
     */
    #[JsonProperty('ext_tenantid')]
    private ?bool $extTenantid;

    /**
     * @var ?bool $extUpn When false, prevents storing the user's User Principal Name (UPN) from Azure AD. When true (default), UPN is persisted. UPN is the user's logon name (e.g., user@contoso.com).
     */
    #[JsonProperty('ext_upn')]
    private ?bool $extUpn;

    /**
     * @var ?bool $extUsageLocation When false, prevents storing the user's usage location for license assignment. When true (default), usage location is persisted in the user profile.
     */
    #[JsonProperty('ext_usage_location')]
    private ?bool $extUsageLocation;

    /**
     * @var ?bool $extUserId When false, prevents storing an alternative user ID. When true (default), this user ID is persisted in the user profile.
     */
    #[JsonProperty('ext_user_id')]
    private ?bool $extUserId;

    /**
     * @var ?ConnectionFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens
     */
    #[JsonProperty('federated_connections_access_tokens')]
    private ?ConnectionFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens;

    /**
     * @var ?bool $granted Indicates whether admin consent has been granted for the required Azure AD permissions. Read-only status field managed by Auth0 during the OAuth authorization flow.
     */
    #[JsonProperty('granted')]
    private ?bool $granted;

    /**
     * @var ?string $iconUrl
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?value-of<ConnectionIdentityApiEnumAzureAd> $identityApi
     */
    #[JsonProperty('identity_api')]
    private ?string $identityApi;

    /**
     * @var ?string $maxGroupsToRetrieve
     */
    #[JsonProperty('max_groups_to_retrieve')]
    private ?string $maxGroupsToRetrieve;

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
     * @var ?value-of<ConnectionShouldTrustEmailVerifiedConnectionEnum> $shouldTrustEmailVerifiedConnection
     */
    #[JsonProperty('should_trust_email_verified_connection')]
    private ?string $shouldTrustEmailVerifiedConnection;

    /**
     * @var ?string $tenantDomain
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?string $tenantId
     */
    #[JsonProperty('tenantId')]
    private ?string $tenantId;

    /**
     * @var ?array<string> $thumbprints
     */
    #[JsonProperty('thumbprints'), ArrayType(['string'])]
    private ?array $thumbprints;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @var ?bool $useWsfed Indicates WS-Federation protocol usage. When true, uses WS-Federation; when false, uses OpenID Connect.
     */
    #[JsonProperty('use_wsfed')]
    private ?bool $useWsfed;

    /**
     * @var ?bool $useCommonEndpoint
     */
    #[JsonProperty('useCommonEndpoint')]
    private ?bool $useCommonEndpoint;

    /**
     * @var ?value-of<ConnectionUseridAttributeEnumAzureAd> $useridAttribute
     */
    #[JsonProperty('userid_attribute')]
    private ?string $useridAttribute;

    /**
     * @var ?value-of<ConnectionWaadProtocolEnumAzureAd> $waadProtocol
     */
    #[JsonProperty('waad_protocol')]
    private ?string $waadProtocol;

    /**
     * @param array{
     *   clientId: string,
     *   nonPersistentAttrs?: ?array<string>,
     *   apiEnableUsers?: ?bool,
     *   appDomain?: ?string,
     *   appId?: ?string,
     *   basicProfile?: ?bool,
     *   clientSecret?: ?string,
     *   domainAliases?: ?array<string>,
     *   extAccessToken?: ?bool,
     *   extAccountEnabled?: ?bool,
     *   extAdmin?: ?bool,
     *   extAgreedTerms?: ?bool,
     *   extAssignedLicenses?: ?bool,
     *   extAssignedPlans?: ?bool,
     *   extAzureId?: ?bool,
     *   extCity?: ?bool,
     *   extCountry?: ?bool,
     *   extDepartment?: ?bool,
     *   extDirSyncEnabled?: ?bool,
     *   extEmail?: ?bool,
     *   extExpiresIn?: ?bool,
     *   extFamilyName?: ?bool,
     *   extFax?: ?bool,
     *   extGivenName?: ?bool,
     *   extGroupIds?: ?bool,
     *   extGroups?: ?bool,
     *   extIsSuspended?: ?bool,
     *   extJobTitle?: ?bool,
     *   extLastSync?: ?bool,
     *   extMobile?: ?bool,
     *   extName?: ?bool,
     *   extNestedGroups?: ?bool,
     *   extNickname?: ?bool,
     *   extOid?: ?bool,
     *   extPhone?: ?bool,
     *   extPhysicalDeliveryOfficeName?: ?bool,
     *   extPostalCode?: ?bool,
     *   extPreferredLanguage?: ?bool,
     *   extProfile?: ?bool,
     *   extProvisionedPlans?: ?bool,
     *   extProvisioningErrors?: ?bool,
     *   extProxyAddresses?: ?bool,
     *   extPuid?: ?bool,
     *   extRefreshToken?: ?bool,
     *   extRoles?: ?bool,
     *   extState?: ?bool,
     *   extStreet?: ?bool,
     *   extTelephoneNumber?: ?bool,
     *   extTenantid?: ?bool,
     *   extUpn?: ?bool,
     *   extUsageLocation?: ?bool,
     *   extUserId?: ?bool,
     *   federatedConnectionsAccessTokens?: ?ConnectionFederatedConnectionsAccessTokens,
     *   granted?: ?bool,
     *   iconUrl?: ?string,
     *   identityApi?: ?value-of<ConnectionIdentityApiEnumAzureAd>,
     *   maxGroupsToRetrieve?: ?string,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   shouldTrustEmailVerifiedConnection?: ?value-of<ConnectionShouldTrustEmailVerifiedConnectionEnum>,
     *   tenantDomain?: ?string,
     *   tenantId?: ?string,
     *   thumbprints?: ?array<string>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   useWsfed?: ?bool,
     *   useCommonEndpoint?: ?bool,
     *   useridAttribute?: ?value-of<ConnectionUseridAttributeEnumAzureAd>,
     *   waadProtocol?: ?value-of<ConnectionWaadProtocolEnumAzureAd>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->apiEnableUsers = $values['apiEnableUsers'] ?? null;
        $this->appDomain = $values['appDomain'] ?? null;
        $this->appId = $values['appId'] ?? null;
        $this->basicProfile = $values['basicProfile'] ?? null;
        $this->clientId = $values['clientId'];
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->extAccessToken = $values['extAccessToken'] ?? null;
        $this->extAccountEnabled = $values['extAccountEnabled'] ?? null;
        $this->extAdmin = $values['extAdmin'] ?? null;
        $this->extAgreedTerms = $values['extAgreedTerms'] ?? null;
        $this->extAssignedLicenses = $values['extAssignedLicenses'] ?? null;
        $this->extAssignedPlans = $values['extAssignedPlans'] ?? null;
        $this->extAzureId = $values['extAzureId'] ?? null;
        $this->extCity = $values['extCity'] ?? null;
        $this->extCountry = $values['extCountry'] ?? null;
        $this->extDepartment = $values['extDepartment'] ?? null;
        $this->extDirSyncEnabled = $values['extDirSyncEnabled'] ?? null;
        $this->extEmail = $values['extEmail'] ?? null;
        $this->extExpiresIn = $values['extExpiresIn'] ?? null;
        $this->extFamilyName = $values['extFamilyName'] ?? null;
        $this->extFax = $values['extFax'] ?? null;
        $this->extGivenName = $values['extGivenName'] ?? null;
        $this->extGroupIds = $values['extGroupIds'] ?? null;
        $this->extGroups = $values['extGroups'] ?? null;
        $this->extIsSuspended = $values['extIsSuspended'] ?? null;
        $this->extJobTitle = $values['extJobTitle'] ?? null;
        $this->extLastSync = $values['extLastSync'] ?? null;
        $this->extMobile = $values['extMobile'] ?? null;
        $this->extName = $values['extName'] ?? null;
        $this->extNestedGroups = $values['extNestedGroups'] ?? null;
        $this->extNickname = $values['extNickname'] ?? null;
        $this->extOid = $values['extOid'] ?? null;
        $this->extPhone = $values['extPhone'] ?? null;
        $this->extPhysicalDeliveryOfficeName = $values['extPhysicalDeliveryOfficeName'] ?? null;
        $this->extPostalCode = $values['extPostalCode'] ?? null;
        $this->extPreferredLanguage = $values['extPreferredLanguage'] ?? null;
        $this->extProfile = $values['extProfile'] ?? null;
        $this->extProvisionedPlans = $values['extProvisionedPlans'] ?? null;
        $this->extProvisioningErrors = $values['extProvisioningErrors'] ?? null;
        $this->extProxyAddresses = $values['extProxyAddresses'] ?? null;
        $this->extPuid = $values['extPuid'] ?? null;
        $this->extRefreshToken = $values['extRefreshToken'] ?? null;
        $this->extRoles = $values['extRoles'] ?? null;
        $this->extState = $values['extState'] ?? null;
        $this->extStreet = $values['extStreet'] ?? null;
        $this->extTelephoneNumber = $values['extTelephoneNumber'] ?? null;
        $this->extTenantid = $values['extTenantid'] ?? null;
        $this->extUpn = $values['extUpn'] ?? null;
        $this->extUsageLocation = $values['extUsageLocation'] ?? null;
        $this->extUserId = $values['extUserId'] ?? null;
        $this->federatedConnectionsAccessTokens = $values['federatedConnectionsAccessTokens'] ?? null;
        $this->granted = $values['granted'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->identityApi = $values['identityApi'] ?? null;
        $this->maxGroupsToRetrieve = $values['maxGroupsToRetrieve'] ?? null;
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
    public function getExtAccessToken(): ?bool
    {
        return $this->extAccessToken;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAccessToken(?bool $value = null): self
    {
        $this->extAccessToken = $value;
        $this->_setField('extAccessToken');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtAccountEnabled(): ?bool
    {
        return $this->extAccountEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAccountEnabled(?bool $value = null): self
    {
        $this->extAccountEnabled = $value;
        $this->_setField('extAccountEnabled');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtAdmin(): ?bool
    {
        return $this->extAdmin;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAdmin(?bool $value = null): self
    {
        $this->extAdmin = $value;
        $this->_setField('extAdmin');
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
    public function getExtAssignedLicenses(): ?bool
    {
        return $this->extAssignedLicenses;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAssignedLicenses(?bool $value = null): self
    {
        $this->extAssignedLicenses = $value;
        $this->_setField('extAssignedLicenses');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtAssignedPlans(): ?bool
    {
        return $this->extAssignedPlans;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAssignedPlans(?bool $value = null): self
    {
        $this->extAssignedPlans = $value;
        $this->_setField('extAssignedPlans');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtAzureId(): ?bool
    {
        return $this->extAzureId;
    }

    /**
     * @param ?bool $value
     */
    public function setExtAzureId(?bool $value = null): self
    {
        $this->extAzureId = $value;
        $this->_setField('extAzureId');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtCity(): ?bool
    {
        return $this->extCity;
    }

    /**
     * @param ?bool $value
     */
    public function setExtCity(?bool $value = null): self
    {
        $this->extCity = $value;
        $this->_setField('extCity');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtCountry(): ?bool
    {
        return $this->extCountry;
    }

    /**
     * @param ?bool $value
     */
    public function setExtCountry(?bool $value = null): self
    {
        $this->extCountry = $value;
        $this->_setField('extCountry');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtDepartment(): ?bool
    {
        return $this->extDepartment;
    }

    /**
     * @param ?bool $value
     */
    public function setExtDepartment(?bool $value = null): self
    {
        $this->extDepartment = $value;
        $this->_setField('extDepartment');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtDirSyncEnabled(): ?bool
    {
        return $this->extDirSyncEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setExtDirSyncEnabled(?bool $value = null): self
    {
        $this->extDirSyncEnabled = $value;
        $this->_setField('extDirSyncEnabled');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtEmail(): ?bool
    {
        return $this->extEmail;
    }

    /**
     * @param ?bool $value
     */
    public function setExtEmail(?bool $value = null): self
    {
        $this->extEmail = $value;
        $this->_setField('extEmail');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtExpiresIn(): ?bool
    {
        return $this->extExpiresIn;
    }

    /**
     * @param ?bool $value
     */
    public function setExtExpiresIn(?bool $value = null): self
    {
        $this->extExpiresIn = $value;
        $this->_setField('extExpiresIn');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtFamilyName(): ?bool
    {
        return $this->extFamilyName;
    }

    /**
     * @param ?bool $value
     */
    public function setExtFamilyName(?bool $value = null): self
    {
        $this->extFamilyName = $value;
        $this->_setField('extFamilyName');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtFax(): ?bool
    {
        return $this->extFax;
    }

    /**
     * @param ?bool $value
     */
    public function setExtFax(?bool $value = null): self
    {
        $this->extFax = $value;
        $this->_setField('extFax');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtGivenName(): ?bool
    {
        return $this->extGivenName;
    }

    /**
     * @param ?bool $value
     */
    public function setExtGivenName(?bool $value = null): self
    {
        $this->extGivenName = $value;
        $this->_setField('extGivenName');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtGroupIds(): ?bool
    {
        return $this->extGroupIds;
    }

    /**
     * @param ?bool $value
     */
    public function setExtGroupIds(?bool $value = null): self
    {
        $this->extGroupIds = $value;
        $this->_setField('extGroupIds');
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
     * @return ?bool
     */
    public function getExtJobTitle(): ?bool
    {
        return $this->extJobTitle;
    }

    /**
     * @param ?bool $value
     */
    public function setExtJobTitle(?bool $value = null): self
    {
        $this->extJobTitle = $value;
        $this->_setField('extJobTitle');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtLastSync(): ?bool
    {
        return $this->extLastSync;
    }

    /**
     * @param ?bool $value
     */
    public function setExtLastSync(?bool $value = null): self
    {
        $this->extLastSync = $value;
        $this->_setField('extLastSync');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtMobile(): ?bool
    {
        return $this->extMobile;
    }

    /**
     * @param ?bool $value
     */
    public function setExtMobile(?bool $value = null): self
    {
        $this->extMobile = $value;
        $this->_setField('extMobile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtName(): ?bool
    {
        return $this->extName;
    }

    /**
     * @param ?bool $value
     */
    public function setExtName(?bool $value = null): self
    {
        $this->extName = $value;
        $this->_setField('extName');
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
    public function getExtNickname(): ?bool
    {
        return $this->extNickname;
    }

    /**
     * @param ?bool $value
     */
    public function setExtNickname(?bool $value = null): self
    {
        $this->extNickname = $value;
        $this->_setField('extNickname');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtOid(): ?bool
    {
        return $this->extOid;
    }

    /**
     * @param ?bool $value
     */
    public function setExtOid(?bool $value = null): self
    {
        $this->extOid = $value;
        $this->_setField('extOid');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtPhone(): ?bool
    {
        return $this->extPhone;
    }

    /**
     * @param ?bool $value
     */
    public function setExtPhone(?bool $value = null): self
    {
        $this->extPhone = $value;
        $this->_setField('extPhone');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtPhysicalDeliveryOfficeName(): ?bool
    {
        return $this->extPhysicalDeliveryOfficeName;
    }

    /**
     * @param ?bool $value
     */
    public function setExtPhysicalDeliveryOfficeName(?bool $value = null): self
    {
        $this->extPhysicalDeliveryOfficeName = $value;
        $this->_setField('extPhysicalDeliveryOfficeName');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtPostalCode(): ?bool
    {
        return $this->extPostalCode;
    }

    /**
     * @param ?bool $value
     */
    public function setExtPostalCode(?bool $value = null): self
    {
        $this->extPostalCode = $value;
        $this->_setField('extPostalCode');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtPreferredLanguage(): ?bool
    {
        return $this->extPreferredLanguage;
    }

    /**
     * @param ?bool $value
     */
    public function setExtPreferredLanguage(?bool $value = null): self
    {
        $this->extPreferredLanguage = $value;
        $this->_setField('extPreferredLanguage');
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
     * @return ?bool
     */
    public function getExtProvisionedPlans(): ?bool
    {
        return $this->extProvisionedPlans;
    }

    /**
     * @param ?bool $value
     */
    public function setExtProvisionedPlans(?bool $value = null): self
    {
        $this->extProvisionedPlans = $value;
        $this->_setField('extProvisionedPlans');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtProvisioningErrors(): ?bool
    {
        return $this->extProvisioningErrors;
    }

    /**
     * @param ?bool $value
     */
    public function setExtProvisioningErrors(?bool $value = null): self
    {
        $this->extProvisioningErrors = $value;
        $this->_setField('extProvisioningErrors');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtProxyAddresses(): ?bool
    {
        return $this->extProxyAddresses;
    }

    /**
     * @param ?bool $value
     */
    public function setExtProxyAddresses(?bool $value = null): self
    {
        $this->extProxyAddresses = $value;
        $this->_setField('extProxyAddresses');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtPuid(): ?bool
    {
        return $this->extPuid;
    }

    /**
     * @param ?bool $value
     */
    public function setExtPuid(?bool $value = null): self
    {
        $this->extPuid = $value;
        $this->_setField('extPuid');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtRefreshToken(): ?bool
    {
        return $this->extRefreshToken;
    }

    /**
     * @param ?bool $value
     */
    public function setExtRefreshToken(?bool $value = null): self
    {
        $this->extRefreshToken = $value;
        $this->_setField('extRefreshToken');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtRoles(): ?bool
    {
        return $this->extRoles;
    }

    /**
     * @param ?bool $value
     */
    public function setExtRoles(?bool $value = null): self
    {
        $this->extRoles = $value;
        $this->_setField('extRoles');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtState(): ?bool
    {
        return $this->extState;
    }

    /**
     * @param ?bool $value
     */
    public function setExtState(?bool $value = null): self
    {
        $this->extState = $value;
        $this->_setField('extState');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtStreet(): ?bool
    {
        return $this->extStreet;
    }

    /**
     * @param ?bool $value
     */
    public function setExtStreet(?bool $value = null): self
    {
        $this->extStreet = $value;
        $this->_setField('extStreet');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtTelephoneNumber(): ?bool
    {
        return $this->extTelephoneNumber;
    }

    /**
     * @param ?bool $value
     */
    public function setExtTelephoneNumber(?bool $value = null): self
    {
        $this->extTelephoneNumber = $value;
        $this->_setField('extTelephoneNumber');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtTenantid(): ?bool
    {
        return $this->extTenantid;
    }

    /**
     * @param ?bool $value
     */
    public function setExtTenantid(?bool $value = null): self
    {
        $this->extTenantid = $value;
        $this->_setField('extTenantid');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtUpn(): ?bool
    {
        return $this->extUpn;
    }

    /**
     * @param ?bool $value
     */
    public function setExtUpn(?bool $value = null): self
    {
        $this->extUpn = $value;
        $this->_setField('extUpn');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtUsageLocation(): ?bool
    {
        return $this->extUsageLocation;
    }

    /**
     * @param ?bool $value
     */
    public function setExtUsageLocation(?bool $value = null): self
    {
        $this->extUsageLocation = $value;
        $this->_setField('extUsageLocation');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getExtUserId(): ?bool
    {
        return $this->extUserId;
    }

    /**
     * @param ?bool $value
     */
    public function setExtUserId(?bool $value = null): self
    {
        $this->extUserId = $value;
        $this->_setField('extUserId');
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
     * @return ?value-of<ConnectionIdentityApiEnumAzureAd>
     */
    public function getIdentityApi(): ?string
    {
        return $this->identityApi;
    }

    /**
     * @param ?value-of<ConnectionIdentityApiEnumAzureAd> $value
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
     * @return ?value-of<ConnectionShouldTrustEmailVerifiedConnectionEnum>
     */
    public function getShouldTrustEmailVerifiedConnection(): ?string
    {
        return $this->shouldTrustEmailVerifiedConnection;
    }

    /**
     * @param ?value-of<ConnectionShouldTrustEmailVerifiedConnectionEnum> $value
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
     * @return ?value-of<ConnectionUseridAttributeEnumAzureAd>
     */
    public function getUseridAttribute(): ?string
    {
        return $this->useridAttribute;
    }

    /**
     * @param ?value-of<ConnectionUseridAttributeEnumAzureAd> $value
     */
    public function setUseridAttribute(?string $value = null): self
    {
        $this->useridAttribute = $value;
        $this->_setField('useridAttribute');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionWaadProtocolEnumAzureAd>
     */
    public function getWaadProtocol(): ?string
    {
        return $this->waadProtocol;
    }

    /**
     * @param ?value-of<ConnectionWaadProtocolEnumAzureAd> $value
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
