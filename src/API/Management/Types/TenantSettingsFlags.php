<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Flags used to change the behavior of this tenant.
 */
class TenantSettingsFlags extends JsonSerializableType
{
    /**
     * @var ?bool $changePwdFlowV1 Whether to use the older v1 change password flow (true, not recommended except for backward compatibility) or the newer safer flow (false, recommended).
     */
    #[JsonProperty('change_pwd_flow_v1')]
    private ?bool $changePwdFlowV1;

    /**
     * @var ?bool $enableApisSection Whether the APIs section is enabled (true) or disabled (false).
     */
    #[JsonProperty('enable_apis_section')]
    private ?bool $enableApisSection;

    /**
     * @var ?bool $disableImpersonation Whether the impersonation functionality has been disabled (true) or not (false). Read-only.
     */
    #[JsonProperty('disable_impersonation')]
    private ?bool $disableImpersonation;

    /**
     * @var ?bool $enableClientConnections Whether all current connections should be enabled when a new client (application) is created (true, default) or not (false).
     */
    #[JsonProperty('enable_client_connections')]
    private ?bool $enableClientConnections;

    /**
     * @var ?bool $enablePipeline2 Whether advanced API Authorization scenarios are enabled (true) or disabled (false).
     */
    #[JsonProperty('enable_pipeline2')]
    private ?bool $enablePipeline2;

    /**
     * @var ?bool $allowLegacyDelegationGrantTypes If enabled, clients are able to add legacy delegation grants.
     */
    #[JsonProperty('allow_legacy_delegation_grant_types')]
    private ?bool $allowLegacyDelegationGrantTypes;

    /**
     * @var ?bool $allowLegacyRoGrantTypes If enabled, clients are able to add legacy RO grants.
     */
    #[JsonProperty('allow_legacy_ro_grant_types')]
    private ?bool $allowLegacyRoGrantTypes;

    /**
     * @var ?bool $allowLegacyTokeninfoEndpoint Whether the legacy `/tokeninfo` endpoint is enabled for your account (true) or unavailable (false).
     */
    #[JsonProperty('allow_legacy_tokeninfo_endpoint')]
    private ?bool $allowLegacyTokeninfoEndpoint;

    /**
     * @var ?bool $enableLegacyProfile Whether ID tokens and the userinfo endpoint includes a complete user profile (true) or only OpenID Connect claims (false).
     */
    #[JsonProperty('enable_legacy_profile')]
    private ?bool $enableLegacyProfile;

    /**
     * @var ?bool $enableIdtokenApi2 Whether ID tokens can be used to authorize some types of requests to API v2 (true) not not (false).
     */
    #[JsonProperty('enable_idtoken_api2')]
    private ?bool $enableIdtokenApi2;

    /**
     * @var ?bool $enablePublicSignupUserExistsError Whether the public sign up process shows a user_exists error (true) or a generic error (false) if the user already exists.
     */
    #[JsonProperty('enable_public_signup_user_exists_error')]
    private ?bool $enablePublicSignupUserExistsError;

    /**
     * @var ?bool $enableSso Whether users are prompted to confirm log in before SSO redirection (false) or are not prompted (true).
     */
    #[JsonProperty('enable_sso')]
    private ?bool $enableSso;

    /**
     * @var ?bool $allowChangingEnableSso Whether the `enable_sso` setting can be changed (true) or not (false).
     */
    #[JsonProperty('allow_changing_enable_sso')]
    private ?bool $allowChangingEnableSso;

    /**
     * @var ?bool $disableClickjackProtectionHeaders Whether classic Universal Login prompts include additional security headers to prevent clickjacking (true) or no safeguard (false).
     */
    #[JsonProperty('disable_clickjack_protection_headers')]
    private ?bool $disableClickjackProtectionHeaders;

    /**
     * @var ?bool $noDiscloseEnterpriseConnections Do not Publish Enterprise Connections Information with IdP domains on the lock configuration file.
     */
    #[JsonProperty('no_disclose_enterprise_connections')]
    private ?bool $noDiscloseEnterpriseConnections;

    /**
     * @var ?bool $enforceClientAuthenticationOnPasswordlessStart Enforce client authentication for passwordless start.
     */
    #[JsonProperty('enforce_client_authentication_on_passwordless_start')]
    private ?bool $enforceClientAuthenticationOnPasswordlessStart;

    /**
     * @var ?bool $enableAdfsWaadEmailVerification Enables the email verification flow during login for Azure AD and ADFS connections
     */
    #[JsonProperty('enable_adfs_waad_email_verification')]
    private ?bool $enableAdfsWaadEmailVerification;

    /**
     * @var ?bool $revokeRefreshTokenGrant Delete underlying grant when a Refresh Token is revoked via the Authentication API.
     */
    #[JsonProperty('revoke_refresh_token_grant')]
    private ?bool $revokeRefreshTokenGrant;

    /**
     * @var ?bool $dashboardLogStreamsNext Enables beta access to log streaming changes
     */
    #[JsonProperty('dashboard_log_streams_next')]
    private ?bool $dashboardLogStreamsNext;

    /**
     * @var ?bool $dashboardInsightsView Enables new insights activity page view
     */
    #[JsonProperty('dashboard_insights_view')]
    private ?bool $dashboardInsightsView;

    /**
     * @var ?bool $disableFieldsMapFix Disables SAML fields map fix for bad mappings with repeated attributes
     */
    #[JsonProperty('disable_fields_map_fix')]
    private ?bool $disableFieldsMapFix;

    /**
     * @var ?bool $mfaShowFactorListOnEnrollment Used to allow users to pick what factor to enroll of the available MFA factors.
     */
    #[JsonProperty('mfa_show_factor_list_on_enrollment')]
    private ?bool $mfaShowFactorListOnEnrollment;

    /**
     * @var ?bool $removeAlgFromJwks Removes alg property from jwks .well-known endpoint
     */
    #[JsonProperty('remove_alg_from_jwks')]
    private ?bool $removeAlgFromJwks;

    /**
     * @var ?bool $improvedSignupBotDetectionInClassic Improves bot detection during signup in classic universal login
     */
    #[JsonProperty('improved_signup_bot_detection_in_classic')]
    private ?bool $improvedSignupBotDetectionInClassic;

    /**
     * @var ?bool $genaiTrial This tenant signed up for the Auth4GenAI trail
     */
    #[JsonProperty('genai_trial')]
    private ?bool $genaiTrial;

    /**
     * @var ?bool $enableDynamicClientRegistration Whether third-party developers can <a href="https://auth0.com/docs/api-auth/dynamic-client-registration">dynamically register</a> applications for your APIs (true) or not (false). This flag enables dynamic client registration.
     */
    #[JsonProperty('enable_dynamic_client_registration')]
    private ?bool $enableDynamicClientRegistration;

    /**
     * @var ?bool $disableManagementApiSmsObfuscation If true, SMS phone numbers will not be obfuscated in Management API GET calls.
     */
    #[JsonProperty('disable_management_api_sms_obfuscation')]
    private ?bool $disableManagementApiSmsObfuscation;

    /**
     * @var ?bool $trustAzureAdfsEmailVerifiedConnectionProperty Changes email_verified behavior for Azure AD/ADFS connections when enabled. Sets email_verified to false otherwise.
     */
    #[JsonProperty('trust_azure_adfs_email_verified_connection_property')]
    private ?bool $trustAzureAdfsEmailVerifiedConnectionProperty;

    /**
     * @var ?bool $customDomainsProvisioning If true, custom domains feature will be enabled for tenant.
     */
    #[JsonProperty('custom_domains_provisioning')]
    private ?bool $customDomainsProvisioning;

    /**
     * @param array{
     *   changePwdFlowV1?: ?bool,
     *   enableApisSection?: ?bool,
     *   disableImpersonation?: ?bool,
     *   enableClientConnections?: ?bool,
     *   enablePipeline2?: ?bool,
     *   allowLegacyDelegationGrantTypes?: ?bool,
     *   allowLegacyRoGrantTypes?: ?bool,
     *   allowLegacyTokeninfoEndpoint?: ?bool,
     *   enableLegacyProfile?: ?bool,
     *   enableIdtokenApi2?: ?bool,
     *   enablePublicSignupUserExistsError?: ?bool,
     *   enableSso?: ?bool,
     *   allowChangingEnableSso?: ?bool,
     *   disableClickjackProtectionHeaders?: ?bool,
     *   noDiscloseEnterpriseConnections?: ?bool,
     *   enforceClientAuthenticationOnPasswordlessStart?: ?bool,
     *   enableAdfsWaadEmailVerification?: ?bool,
     *   revokeRefreshTokenGrant?: ?bool,
     *   dashboardLogStreamsNext?: ?bool,
     *   dashboardInsightsView?: ?bool,
     *   disableFieldsMapFix?: ?bool,
     *   mfaShowFactorListOnEnrollment?: ?bool,
     *   removeAlgFromJwks?: ?bool,
     *   improvedSignupBotDetectionInClassic?: ?bool,
     *   genaiTrial?: ?bool,
     *   enableDynamicClientRegistration?: ?bool,
     *   disableManagementApiSmsObfuscation?: ?bool,
     *   trustAzureAdfsEmailVerifiedConnectionProperty?: ?bool,
     *   customDomainsProvisioning?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->changePwdFlowV1 = $values['changePwdFlowV1'] ?? null;
        $this->enableApisSection = $values['enableApisSection'] ?? null;
        $this->disableImpersonation = $values['disableImpersonation'] ?? null;
        $this->enableClientConnections = $values['enableClientConnections'] ?? null;
        $this->enablePipeline2 = $values['enablePipeline2'] ?? null;
        $this->allowLegacyDelegationGrantTypes = $values['allowLegacyDelegationGrantTypes'] ?? null;
        $this->allowLegacyRoGrantTypes = $values['allowLegacyRoGrantTypes'] ?? null;
        $this->allowLegacyTokeninfoEndpoint = $values['allowLegacyTokeninfoEndpoint'] ?? null;
        $this->enableLegacyProfile = $values['enableLegacyProfile'] ?? null;
        $this->enableIdtokenApi2 = $values['enableIdtokenApi2'] ?? null;
        $this->enablePublicSignupUserExistsError = $values['enablePublicSignupUserExistsError'] ?? null;
        $this->enableSso = $values['enableSso'] ?? null;
        $this->allowChangingEnableSso = $values['allowChangingEnableSso'] ?? null;
        $this->disableClickjackProtectionHeaders = $values['disableClickjackProtectionHeaders'] ?? null;
        $this->noDiscloseEnterpriseConnections = $values['noDiscloseEnterpriseConnections'] ?? null;
        $this->enforceClientAuthenticationOnPasswordlessStart = $values['enforceClientAuthenticationOnPasswordlessStart'] ?? null;
        $this->enableAdfsWaadEmailVerification = $values['enableAdfsWaadEmailVerification'] ?? null;
        $this->revokeRefreshTokenGrant = $values['revokeRefreshTokenGrant'] ?? null;
        $this->dashboardLogStreamsNext = $values['dashboardLogStreamsNext'] ?? null;
        $this->dashboardInsightsView = $values['dashboardInsightsView'] ?? null;
        $this->disableFieldsMapFix = $values['disableFieldsMapFix'] ?? null;
        $this->mfaShowFactorListOnEnrollment = $values['mfaShowFactorListOnEnrollment'] ?? null;
        $this->removeAlgFromJwks = $values['removeAlgFromJwks'] ?? null;
        $this->improvedSignupBotDetectionInClassic = $values['improvedSignupBotDetectionInClassic'] ?? null;
        $this->genaiTrial = $values['genaiTrial'] ?? null;
        $this->enableDynamicClientRegistration = $values['enableDynamicClientRegistration'] ?? null;
        $this->disableManagementApiSmsObfuscation = $values['disableManagementApiSmsObfuscation'] ?? null;
        $this->trustAzureAdfsEmailVerifiedConnectionProperty = $values['trustAzureAdfsEmailVerifiedConnectionProperty'] ?? null;
        $this->customDomainsProvisioning = $values['customDomainsProvisioning'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getChangePwdFlowV1(): ?bool
    {
        return $this->changePwdFlowV1;
    }

    /**
     * @param ?bool $value
     */
    public function setChangePwdFlowV1(?bool $value = null): self
    {
        $this->changePwdFlowV1 = $value;
        $this->_setField('changePwdFlowV1');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnableApisSection(): ?bool
    {
        return $this->enableApisSection;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableApisSection(?bool $value = null): self
    {
        $this->enableApisSection = $value;
        $this->_setField('enableApisSection');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableImpersonation(): ?bool
    {
        return $this->disableImpersonation;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableImpersonation(?bool $value = null): self
    {
        $this->disableImpersonation = $value;
        $this->_setField('disableImpersonation');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnableClientConnections(): ?bool
    {
        return $this->enableClientConnections;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableClientConnections(?bool $value = null): self
    {
        $this->enableClientConnections = $value;
        $this->_setField('enableClientConnections');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnablePipeline2(): ?bool
    {
        return $this->enablePipeline2;
    }

    /**
     * @param ?bool $value
     */
    public function setEnablePipeline2(?bool $value = null): self
    {
        $this->enablePipeline2 = $value;
        $this->_setField('enablePipeline2');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowLegacyDelegationGrantTypes(): ?bool
    {
        return $this->allowLegacyDelegationGrantTypes;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowLegacyDelegationGrantTypes(?bool $value = null): self
    {
        $this->allowLegacyDelegationGrantTypes = $value;
        $this->_setField('allowLegacyDelegationGrantTypes');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowLegacyRoGrantTypes(): ?bool
    {
        return $this->allowLegacyRoGrantTypes;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowLegacyRoGrantTypes(?bool $value = null): self
    {
        $this->allowLegacyRoGrantTypes = $value;
        $this->_setField('allowLegacyRoGrantTypes');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowLegacyTokeninfoEndpoint(): ?bool
    {
        return $this->allowLegacyTokeninfoEndpoint;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowLegacyTokeninfoEndpoint(?bool $value = null): self
    {
        $this->allowLegacyTokeninfoEndpoint = $value;
        $this->_setField('allowLegacyTokeninfoEndpoint');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnableLegacyProfile(): ?bool
    {
        return $this->enableLegacyProfile;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableLegacyProfile(?bool $value = null): self
    {
        $this->enableLegacyProfile = $value;
        $this->_setField('enableLegacyProfile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnableIdtokenApi2(): ?bool
    {
        return $this->enableIdtokenApi2;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableIdtokenApi2(?bool $value = null): self
    {
        $this->enableIdtokenApi2 = $value;
        $this->_setField('enableIdtokenApi2');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnablePublicSignupUserExistsError(): ?bool
    {
        return $this->enablePublicSignupUserExistsError;
    }

    /**
     * @param ?bool $value
     */
    public function setEnablePublicSignupUserExistsError(?bool $value = null): self
    {
        $this->enablePublicSignupUserExistsError = $value;
        $this->_setField('enablePublicSignupUserExistsError');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnableSso(): ?bool
    {
        return $this->enableSso;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableSso(?bool $value = null): self
    {
        $this->enableSso = $value;
        $this->_setField('enableSso');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowChangingEnableSso(): ?bool
    {
        return $this->allowChangingEnableSso;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowChangingEnableSso(?bool $value = null): self
    {
        $this->allowChangingEnableSso = $value;
        $this->_setField('allowChangingEnableSso');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableClickjackProtectionHeaders(): ?bool
    {
        return $this->disableClickjackProtectionHeaders;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableClickjackProtectionHeaders(?bool $value = null): self
    {
        $this->disableClickjackProtectionHeaders = $value;
        $this->_setField('disableClickjackProtectionHeaders');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getNoDiscloseEnterpriseConnections(): ?bool
    {
        return $this->noDiscloseEnterpriseConnections;
    }

    /**
     * @param ?bool $value
     */
    public function setNoDiscloseEnterpriseConnections(?bool $value = null): self
    {
        $this->noDiscloseEnterpriseConnections = $value;
        $this->_setField('noDiscloseEnterpriseConnections');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnforceClientAuthenticationOnPasswordlessStart(): ?bool
    {
        return $this->enforceClientAuthenticationOnPasswordlessStart;
    }

    /**
     * @param ?bool $value
     */
    public function setEnforceClientAuthenticationOnPasswordlessStart(?bool $value = null): self
    {
        $this->enforceClientAuthenticationOnPasswordlessStart = $value;
        $this->_setField('enforceClientAuthenticationOnPasswordlessStart');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnableAdfsWaadEmailVerification(): ?bool
    {
        return $this->enableAdfsWaadEmailVerification;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableAdfsWaadEmailVerification(?bool $value = null): self
    {
        $this->enableAdfsWaadEmailVerification = $value;
        $this->_setField('enableAdfsWaadEmailVerification');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRevokeRefreshTokenGrant(): ?bool
    {
        return $this->revokeRefreshTokenGrant;
    }

    /**
     * @param ?bool $value
     */
    public function setRevokeRefreshTokenGrant(?bool $value = null): self
    {
        $this->revokeRefreshTokenGrant = $value;
        $this->_setField('revokeRefreshTokenGrant');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDashboardLogStreamsNext(): ?bool
    {
        return $this->dashboardLogStreamsNext;
    }

    /**
     * @param ?bool $value
     */
    public function setDashboardLogStreamsNext(?bool $value = null): self
    {
        $this->dashboardLogStreamsNext = $value;
        $this->_setField('dashboardLogStreamsNext');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDashboardInsightsView(): ?bool
    {
        return $this->dashboardInsightsView;
    }

    /**
     * @param ?bool $value
     */
    public function setDashboardInsightsView(?bool $value = null): self
    {
        $this->dashboardInsightsView = $value;
        $this->_setField('dashboardInsightsView');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableFieldsMapFix(): ?bool
    {
        return $this->disableFieldsMapFix;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableFieldsMapFix(?bool $value = null): self
    {
        $this->disableFieldsMapFix = $value;
        $this->_setField('disableFieldsMapFix');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getMfaShowFactorListOnEnrollment(): ?bool
    {
        return $this->mfaShowFactorListOnEnrollment;
    }

    /**
     * @param ?bool $value
     */
    public function setMfaShowFactorListOnEnrollment(?bool $value = null): self
    {
        $this->mfaShowFactorListOnEnrollment = $value;
        $this->_setField('mfaShowFactorListOnEnrollment');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRemoveAlgFromJwks(): ?bool
    {
        return $this->removeAlgFromJwks;
    }

    /**
     * @param ?bool $value
     */
    public function setRemoveAlgFromJwks(?bool $value = null): self
    {
        $this->removeAlgFromJwks = $value;
        $this->_setField('removeAlgFromJwks');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getImprovedSignupBotDetectionInClassic(): ?bool
    {
        return $this->improvedSignupBotDetectionInClassic;
    }

    /**
     * @param ?bool $value
     */
    public function setImprovedSignupBotDetectionInClassic(?bool $value = null): self
    {
        $this->improvedSignupBotDetectionInClassic = $value;
        $this->_setField('improvedSignupBotDetectionInClassic');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getGenaiTrial(): ?bool
    {
        return $this->genaiTrial;
    }

    /**
     * @param ?bool $value
     */
    public function setGenaiTrial(?bool $value = null): self
    {
        $this->genaiTrial = $value;
        $this->_setField('genaiTrial');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnableDynamicClientRegistration(): ?bool
    {
        return $this->enableDynamicClientRegistration;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableDynamicClientRegistration(?bool $value = null): self
    {
        $this->enableDynamicClientRegistration = $value;
        $this->_setField('enableDynamicClientRegistration');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableManagementApiSmsObfuscation(): ?bool
    {
        return $this->disableManagementApiSmsObfuscation;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableManagementApiSmsObfuscation(?bool $value = null): self
    {
        $this->disableManagementApiSmsObfuscation = $value;
        $this->_setField('disableManagementApiSmsObfuscation');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getTrustAzureAdfsEmailVerifiedConnectionProperty(): ?bool
    {
        return $this->trustAzureAdfsEmailVerifiedConnectionProperty;
    }

    /**
     * @param ?bool $value
     */
    public function setTrustAzureAdfsEmailVerifiedConnectionProperty(?bool $value = null): self
    {
        $this->trustAzureAdfsEmailVerifiedConnectionProperty = $value;
        $this->_setField('trustAzureAdfsEmailVerifiedConnectionProperty');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCustomDomainsProvisioning(): ?bool
    {
        return $this->customDomainsProvisioning;
    }

    /**
     * @param ?bool $value
     */
    public function setCustomDomainsProvisioning(?bool $value = null): self
    {
        $this->customDomainsProvisioning = $value;
        $this->_setField('customDomainsProvisioning');
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
