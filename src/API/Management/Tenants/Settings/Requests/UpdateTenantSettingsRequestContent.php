<?php

namespace Auth0\SDK\API\Management\Tenants\Settings\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\TenantSettingsPasswordPage;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\TenantSettingsDeviceFlow;
use Auth0\SDK\API\Management\Types\TenantSettingsGuardianPage;
use Auth0\SDK\API\Management\Types\TenantSettingsErrorPage;
use Auth0\SDK\API\Management\Types\DefaultTokenQuota;
use Auth0\SDK\API\Management\Types\TenantSettingsFlags;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\TenantSettingsSupportedLocalesEnum;
use Auth0\SDK\API\Management\Types\SessionCookieSchema;
use Auth0\SDK\API\Management\Types\TenantSettingsSessions;
use Auth0\SDK\API\Management\Types\TenantOidcLogoutSettings;
use Auth0\SDK\API\Management\Types\TenantSettingsMtls;
use Auth0\SDK\API\Management\Types\TenantSettingsResourceParameterProfile;
use Auth0\SDK\API\Management\Types\TenantSettingsDynamicClientRegistrationSecurityMode;

class UpdateTenantSettingsRequestContent extends JsonSerializableType
{
    /**
     * @var ?TenantSettingsPasswordPage $changePassword
     */
    #[JsonProperty('change_password')]
    private ?TenantSettingsPasswordPage $changePassword;

    /**
     * @var ?TenantSettingsDeviceFlow $deviceFlow Device Flow configuration.
     */
    #[JsonProperty('device_flow')]
    private ?TenantSettingsDeviceFlow $deviceFlow;

    /**
     * @var ?TenantSettingsGuardianPage $guardianMfaPage
     */
    #[JsonProperty('guardian_mfa_page')]
    private ?TenantSettingsGuardianPage $guardianMfaPage;

    /**
     * @var ?string $defaultAudience Default audience for API Authorization.
     */
    #[JsonProperty('default_audience')]
    private ?string $defaultAudience;

    /**
     * @var ?string $defaultDirectory Name of connection used for password grants at the `/token` endpoint. The following connection types are supported: LDAP, AD, Database Connections, Passwordless, Windows Azure Active Directory, ADFS.
     */
    #[JsonProperty('default_directory')]
    private ?string $defaultDirectory;

    /**
     * @var ?TenantSettingsErrorPage $errorPage
     */
    #[JsonProperty('error_page')]
    private ?TenantSettingsErrorPage $errorPage;

    /**
     * @var ?DefaultTokenQuota $defaultTokenQuota
     */
    #[JsonProperty('default_token_quota')]
    private ?DefaultTokenQuota $defaultTokenQuota;

    /**
     * @var ?TenantSettingsFlags $flags
     */
    #[JsonProperty('flags')]
    private ?TenantSettingsFlags $flags;

    /**
     * @var ?string $friendlyName Friendly name for this tenant.
     */
    #[JsonProperty('friendly_name')]
    private ?string $friendlyName;

    /**
     * @var ?string $pictureUrl URL of logo to be shown for this tenant (recommended size: 150x150)
     */
    #[JsonProperty('picture_url')]
    private ?string $pictureUrl;

    /**
     * @var ?string $supportEmail End-user support email.
     */
    #[JsonProperty('support_email')]
    private ?string $supportEmail;

    /**
     * @var ?string $supportUrl End-user support url.
     */
    #[JsonProperty('support_url')]
    private ?string $supportUrl;

    /**
     * @var ?array<string> $allowedLogoutUrls URLs that are valid to redirect to after logout from Auth0.
     */
    #[JsonProperty('allowed_logout_urls'), ArrayType(['string'])]
    private ?array $allowedLogoutUrls;

    /**
     * @var ?int $sessionLifetime Number of hours a session will stay valid.
     */
    #[JsonProperty('session_lifetime')]
    private ?int $sessionLifetime;

    /**
     * @var ?int $idleSessionLifetime Number of hours for which a session can be inactive before the user must log in again.
     */
    #[JsonProperty('idle_session_lifetime')]
    private ?int $idleSessionLifetime;

    /**
     * @var ?int $ephemeralSessionLifetime Number of hours an ephemeral (non-persistent) session will stay valid.
     */
    #[JsonProperty('ephemeral_session_lifetime')]
    private ?int $ephemeralSessionLifetime;

    /**
     * @var ?int $idleEphemeralSessionLifetime Number of hours for which an ephemeral (non-persistent) session can be inactive before the user must log in again.
     */
    #[JsonProperty('idle_ephemeral_session_lifetime')]
    private ?int $idleEphemeralSessionLifetime;

    /**
     * @var ?string $sandboxVersion Selected sandbox version for the extensibility environment
     */
    #[JsonProperty('sandbox_version')]
    private ?string $sandboxVersion;

    /**
     * @var ?string $legacySandboxVersion Selected legacy sandbox version for the extensibility environment
     */
    #[JsonProperty('legacy_sandbox_version')]
    private ?string $legacySandboxVersion;

    /**
     * @var ?string $defaultRedirectionUri The default absolute redirection uri, must be https
     */
    #[JsonProperty('default_redirection_uri')]
    private ?string $defaultRedirectionUri;

    /**
     * @var ?array<value-of<TenantSettingsSupportedLocalesEnum>> $enabledLocales Supported locales for the user interface
     */
    #[JsonProperty('enabled_locales'), ArrayType(['string'])]
    private ?array $enabledLocales;

    /**
     * @var ?SessionCookieSchema $sessionCookie
     */
    #[JsonProperty('session_cookie')]
    private ?SessionCookieSchema $sessionCookie;

    /**
     * @var ?TenantSettingsSessions $sessions
     */
    #[JsonProperty('sessions')]
    private ?TenantSettingsSessions $sessions;

    /**
     * @var ?TenantOidcLogoutSettings $oidcLogout
     */
    #[JsonProperty('oidc_logout')]
    private ?TenantOidcLogoutSettings $oidcLogout;

    /**
     * @var ?bool $customizeMfaInPostloginAction Whether to enable flexible factors for MFA in the PostLogin action
     */
    #[JsonProperty('customize_mfa_in_postlogin_action')]
    private ?bool $customizeMfaInPostloginAction;

    /**
     * @var ?bool $allowOrganizationNameInAuthenticationApi Whether to accept an organization name instead of an ID on auth endpoints
     */
    #[JsonProperty('allow_organization_name_in_authentication_api')]
    private ?bool $allowOrganizationNameInAuthenticationApi;

    /**
     * @var ?array<string> $acrValuesSupported Supported ACR values
     */
    #[JsonProperty('acr_values_supported'), ArrayType(['string'])]
    private ?array $acrValuesSupported;

    /**
     * @var ?TenantSettingsMtls $mtls
     */
    #[JsonProperty('mtls')]
    private ?TenantSettingsMtls $mtls;

    /**
     * @var ?bool $pushedAuthorizationRequestsSupported Enables the use of Pushed Authorization Requests
     */
    #[JsonProperty('pushed_authorization_requests_supported')]
    private ?bool $pushedAuthorizationRequestsSupported;

    /**
     * @var ?bool $authorizationResponseIssParameterSupported Supports iss parameter in authorization responses
     */
    #[JsonProperty('authorization_response_iss_parameter_supported')]
    private ?bool $authorizationResponseIssParameterSupported;

    /**
     * Controls whether a confirmation prompt is shown during login flows when the redirect URI uses non-verifiable callback URIs (for example, a custom URI schema such as `myapp://`, or `localhost`).
     * If set to true, a confirmation prompt will not be shown. We recommend that this is set to false for improved protection from malicious apps.
     * See https://auth0.com/docs/secure/security-guidance/measures-against-app-impersonation for more information.
     *
     * @var ?bool $skipNonVerifiableCallbackUriConfirmationPrompt
     */
    #[JsonProperty('skip_non_verifiable_callback_uri_confirmation_prompt')]
    private ?bool $skipNonVerifiableCallbackUriConfirmationPrompt;

    /**
     * @var ?value-of<TenantSettingsResourceParameterProfile> $resourceParameterProfile
     */
    #[JsonProperty('resource_parameter_profile')]
    private ?string $resourceParameterProfile;

    /**
     * @var ?bool $clientIdMetadataDocumentSupported Whether the authorization server supports retrieving client metadata from a client_id URL.
     */
    #[JsonProperty('client_id_metadata_document_supported')]
    private ?bool $clientIdMetadataDocumentSupported;

    /**
     * @var ?bool $enableAiGuide Whether Auth0 Guide (AI-powered assistance) is enabled for this tenant.
     */
    #[JsonProperty('enable_ai_guide')]
    private ?bool $enableAiGuide;

    /**
     * @var ?bool $phoneConsolidatedExperience Whether Phone Consolidated Experience is enabled for this tenant.
     */
    #[JsonProperty('phone_consolidated_experience')]
    private ?bool $phoneConsolidatedExperience;

    /**
     * @var ?value-of<TenantSettingsDynamicClientRegistrationSecurityMode> $dynamicClientRegistrationSecurityMode
     */
    #[JsonProperty('dynamic_client_registration_security_mode')]
    private ?string $dynamicClientRegistrationSecurityMode;

    /**
     * @param array{
     *   changePassword?: ?TenantSettingsPasswordPage,
     *   deviceFlow?: ?TenantSettingsDeviceFlow,
     *   guardianMfaPage?: ?TenantSettingsGuardianPage,
     *   defaultAudience?: ?string,
     *   defaultDirectory?: ?string,
     *   errorPage?: ?TenantSettingsErrorPage,
     *   defaultTokenQuota?: ?DefaultTokenQuota,
     *   flags?: ?TenantSettingsFlags,
     *   friendlyName?: ?string,
     *   pictureUrl?: ?string,
     *   supportEmail?: ?string,
     *   supportUrl?: ?string,
     *   allowedLogoutUrls?: ?array<string>,
     *   sessionLifetime?: ?int,
     *   idleSessionLifetime?: ?int,
     *   ephemeralSessionLifetime?: ?int,
     *   idleEphemeralSessionLifetime?: ?int,
     *   sandboxVersion?: ?string,
     *   legacySandboxVersion?: ?string,
     *   defaultRedirectionUri?: ?string,
     *   enabledLocales?: ?array<value-of<TenantSettingsSupportedLocalesEnum>>,
     *   sessionCookie?: ?SessionCookieSchema,
     *   sessions?: ?TenantSettingsSessions,
     *   oidcLogout?: ?TenantOidcLogoutSettings,
     *   customizeMfaInPostloginAction?: ?bool,
     *   allowOrganizationNameInAuthenticationApi?: ?bool,
     *   acrValuesSupported?: ?array<string>,
     *   mtls?: ?TenantSettingsMtls,
     *   pushedAuthorizationRequestsSupported?: ?bool,
     *   authorizationResponseIssParameterSupported?: ?bool,
     *   skipNonVerifiableCallbackUriConfirmationPrompt?: ?bool,
     *   resourceParameterProfile?: ?value-of<TenantSettingsResourceParameterProfile>,
     *   clientIdMetadataDocumentSupported?: ?bool,
     *   enableAiGuide?: ?bool,
     *   phoneConsolidatedExperience?: ?bool,
     *   dynamicClientRegistrationSecurityMode?: ?value-of<TenantSettingsDynamicClientRegistrationSecurityMode>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->changePassword = $values['changePassword'] ?? null;
        $this->deviceFlow = $values['deviceFlow'] ?? null;
        $this->guardianMfaPage = $values['guardianMfaPage'] ?? null;
        $this->defaultAudience = $values['defaultAudience'] ?? null;
        $this->defaultDirectory = $values['defaultDirectory'] ?? null;
        $this->errorPage = $values['errorPage'] ?? null;
        $this->defaultTokenQuota = $values['defaultTokenQuota'] ?? null;
        $this->flags = $values['flags'] ?? null;
        $this->friendlyName = $values['friendlyName'] ?? null;
        $this->pictureUrl = $values['pictureUrl'] ?? null;
        $this->supportEmail = $values['supportEmail'] ?? null;
        $this->supportUrl = $values['supportUrl'] ?? null;
        $this->allowedLogoutUrls = $values['allowedLogoutUrls'] ?? null;
        $this->sessionLifetime = $values['sessionLifetime'] ?? null;
        $this->idleSessionLifetime = $values['idleSessionLifetime'] ?? null;
        $this->ephemeralSessionLifetime = $values['ephemeralSessionLifetime'] ?? null;
        $this->idleEphemeralSessionLifetime = $values['idleEphemeralSessionLifetime'] ?? null;
        $this->sandboxVersion = $values['sandboxVersion'] ?? null;
        $this->legacySandboxVersion = $values['legacySandboxVersion'] ?? null;
        $this->defaultRedirectionUri = $values['defaultRedirectionUri'] ?? null;
        $this->enabledLocales = $values['enabledLocales'] ?? null;
        $this->sessionCookie = $values['sessionCookie'] ?? null;
        $this->sessions = $values['sessions'] ?? null;
        $this->oidcLogout = $values['oidcLogout'] ?? null;
        $this->customizeMfaInPostloginAction = $values['customizeMfaInPostloginAction'] ?? null;
        $this->allowOrganizationNameInAuthenticationApi = $values['allowOrganizationNameInAuthenticationApi'] ?? null;
        $this->acrValuesSupported = $values['acrValuesSupported'] ?? null;
        $this->mtls = $values['mtls'] ?? null;
        $this->pushedAuthorizationRequestsSupported = $values['pushedAuthorizationRequestsSupported'] ?? null;
        $this->authorizationResponseIssParameterSupported = $values['authorizationResponseIssParameterSupported'] ?? null;
        $this->skipNonVerifiableCallbackUriConfirmationPrompt = $values['skipNonVerifiableCallbackUriConfirmationPrompt'] ?? null;
        $this->resourceParameterProfile = $values['resourceParameterProfile'] ?? null;
        $this->clientIdMetadataDocumentSupported = $values['clientIdMetadataDocumentSupported'] ?? null;
        $this->enableAiGuide = $values['enableAiGuide'] ?? null;
        $this->phoneConsolidatedExperience = $values['phoneConsolidatedExperience'] ?? null;
        $this->dynamicClientRegistrationSecurityMode = $values['dynamicClientRegistrationSecurityMode'] ?? null;
    }

    /**
     * @return ?TenantSettingsPasswordPage
     */
    public function getChangePassword(): ?TenantSettingsPasswordPage
    {
        return $this->changePassword;
    }

    /**
     * @param ?TenantSettingsPasswordPage $value
     */
    public function setChangePassword(?TenantSettingsPasswordPage $value = null): self
    {
        $this->changePassword = $value;
        $this->_setField('changePassword');
        return $this;
    }

    /**
     * @return ?TenantSettingsDeviceFlow
     */
    public function getDeviceFlow(): ?TenantSettingsDeviceFlow
    {
        return $this->deviceFlow;
    }

    /**
     * @param ?TenantSettingsDeviceFlow $value
     */
    public function setDeviceFlow(?TenantSettingsDeviceFlow $value = null): self
    {
        $this->deviceFlow = $value;
        $this->_setField('deviceFlow');
        return $this;
    }

    /**
     * @return ?TenantSettingsGuardianPage
     */
    public function getGuardianMfaPage(): ?TenantSettingsGuardianPage
    {
        return $this->guardianMfaPage;
    }

    /**
     * @param ?TenantSettingsGuardianPage $value
     */
    public function setGuardianMfaPage(?TenantSettingsGuardianPage $value = null): self
    {
        $this->guardianMfaPage = $value;
        $this->_setField('guardianMfaPage');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDefaultAudience(): ?string
    {
        return $this->defaultAudience;
    }

    /**
     * @param ?string $value
     */
    public function setDefaultAudience(?string $value = null): self
    {
        $this->defaultAudience = $value;
        $this->_setField('defaultAudience');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDefaultDirectory(): ?string
    {
        return $this->defaultDirectory;
    }

    /**
     * @param ?string $value
     */
    public function setDefaultDirectory(?string $value = null): self
    {
        $this->defaultDirectory = $value;
        $this->_setField('defaultDirectory');
        return $this;
    }

    /**
     * @return ?TenantSettingsErrorPage
     */
    public function getErrorPage(): ?TenantSettingsErrorPage
    {
        return $this->errorPage;
    }

    /**
     * @param ?TenantSettingsErrorPage $value
     */
    public function setErrorPage(?TenantSettingsErrorPage $value = null): self
    {
        $this->errorPage = $value;
        $this->_setField('errorPage');
        return $this;
    }

    /**
     * @return ?DefaultTokenQuota
     */
    public function getDefaultTokenQuota(): ?DefaultTokenQuota
    {
        return $this->defaultTokenQuota;
    }

    /**
     * @param ?DefaultTokenQuota $value
     */
    public function setDefaultTokenQuota(?DefaultTokenQuota $value = null): self
    {
        $this->defaultTokenQuota = $value;
        $this->_setField('defaultTokenQuota');
        return $this;
    }

    /**
     * @return ?TenantSettingsFlags
     */
    public function getFlags(): ?TenantSettingsFlags
    {
        return $this->flags;
    }

    /**
     * @param ?TenantSettingsFlags $value
     */
    public function setFlags(?TenantSettingsFlags $value = null): self
    {
        $this->flags = $value;
        $this->_setField('flags');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFriendlyName(): ?string
    {
        return $this->friendlyName;
    }

    /**
     * @param ?string $value
     */
    public function setFriendlyName(?string $value = null): self
    {
        $this->friendlyName = $value;
        $this->_setField('friendlyName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    /**
     * @param ?string $value
     */
    public function setPictureUrl(?string $value = null): self
    {
        $this->pictureUrl = $value;
        $this->_setField('pictureUrl');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSupportEmail(): ?string
    {
        return $this->supportEmail;
    }

    /**
     * @param ?string $value
     */
    public function setSupportEmail(?string $value = null): self
    {
        $this->supportEmail = $value;
        $this->_setField('supportEmail');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSupportUrl(): ?string
    {
        return $this->supportUrl;
    }

    /**
     * @param ?string $value
     */
    public function setSupportUrl(?string $value = null): self
    {
        $this->supportUrl = $value;
        $this->_setField('supportUrl');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getAllowedLogoutUrls(): ?array
    {
        return $this->allowedLogoutUrls;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAllowedLogoutUrls(?array $value = null): self
    {
        $this->allowedLogoutUrls = $value;
        $this->_setField('allowedLogoutUrls');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getSessionLifetime(): ?int
    {
        return $this->sessionLifetime;
    }

    /**
     * @param ?int $value
     */
    public function setSessionLifetime(?int $value = null): self
    {
        $this->sessionLifetime = $value;
        $this->_setField('sessionLifetime');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getIdleSessionLifetime(): ?int
    {
        return $this->idleSessionLifetime;
    }

    /**
     * @param ?int $value
     */
    public function setIdleSessionLifetime(?int $value = null): self
    {
        $this->idleSessionLifetime = $value;
        $this->_setField('idleSessionLifetime');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getEphemeralSessionLifetime(): ?int
    {
        return $this->ephemeralSessionLifetime;
    }

    /**
     * @param ?int $value
     */
    public function setEphemeralSessionLifetime(?int $value = null): self
    {
        $this->ephemeralSessionLifetime = $value;
        $this->_setField('ephemeralSessionLifetime');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getIdleEphemeralSessionLifetime(): ?int
    {
        return $this->idleEphemeralSessionLifetime;
    }

    /**
     * @param ?int $value
     */
    public function setIdleEphemeralSessionLifetime(?int $value = null): self
    {
        $this->idleEphemeralSessionLifetime = $value;
        $this->_setField('idleEphemeralSessionLifetime');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSandboxVersion(): ?string
    {
        return $this->sandboxVersion;
    }

    /**
     * @param ?string $value
     */
    public function setSandboxVersion(?string $value = null): self
    {
        $this->sandboxVersion = $value;
        $this->_setField('sandboxVersion');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLegacySandboxVersion(): ?string
    {
        return $this->legacySandboxVersion;
    }

    /**
     * @param ?string $value
     */
    public function setLegacySandboxVersion(?string $value = null): self
    {
        $this->legacySandboxVersion = $value;
        $this->_setField('legacySandboxVersion');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDefaultRedirectionUri(): ?string
    {
        return $this->defaultRedirectionUri;
    }

    /**
     * @param ?string $value
     */
    public function setDefaultRedirectionUri(?string $value = null): self
    {
        $this->defaultRedirectionUri = $value;
        $this->_setField('defaultRedirectionUri');
        return $this;
    }

    /**
     * @return ?array<value-of<TenantSettingsSupportedLocalesEnum>>
     */
    public function getEnabledLocales(): ?array
    {
        return $this->enabledLocales;
    }

    /**
     * @param ?array<value-of<TenantSettingsSupportedLocalesEnum>> $value
     */
    public function setEnabledLocales(?array $value = null): self
    {
        $this->enabledLocales = $value;
        $this->_setField('enabledLocales');
        return $this;
    }

    /**
     * @return ?SessionCookieSchema
     */
    public function getSessionCookie(): ?SessionCookieSchema
    {
        return $this->sessionCookie;
    }

    /**
     * @param ?SessionCookieSchema $value
     */
    public function setSessionCookie(?SessionCookieSchema $value = null): self
    {
        $this->sessionCookie = $value;
        $this->_setField('sessionCookie');
        return $this;
    }

    /**
     * @return ?TenantSettingsSessions
     */
    public function getSessions(): ?TenantSettingsSessions
    {
        return $this->sessions;
    }

    /**
     * @param ?TenantSettingsSessions $value
     */
    public function setSessions(?TenantSettingsSessions $value = null): self
    {
        $this->sessions = $value;
        $this->_setField('sessions');
        return $this;
    }

    /**
     * @return ?TenantOidcLogoutSettings
     */
    public function getOidcLogout(): ?TenantOidcLogoutSettings
    {
        return $this->oidcLogout;
    }

    /**
     * @param ?TenantOidcLogoutSettings $value
     */
    public function setOidcLogout(?TenantOidcLogoutSettings $value = null): self
    {
        $this->oidcLogout = $value;
        $this->_setField('oidcLogout');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCustomizeMfaInPostloginAction(): ?bool
    {
        return $this->customizeMfaInPostloginAction;
    }

    /**
     * @param ?bool $value
     */
    public function setCustomizeMfaInPostloginAction(?bool $value = null): self
    {
        $this->customizeMfaInPostloginAction = $value;
        $this->_setField('customizeMfaInPostloginAction');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowOrganizationNameInAuthenticationApi(): ?bool
    {
        return $this->allowOrganizationNameInAuthenticationApi;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowOrganizationNameInAuthenticationApi(?bool $value = null): self
    {
        $this->allowOrganizationNameInAuthenticationApi = $value;
        $this->_setField('allowOrganizationNameInAuthenticationApi');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getAcrValuesSupported(): ?array
    {
        return $this->acrValuesSupported;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAcrValuesSupported(?array $value = null): self
    {
        $this->acrValuesSupported = $value;
        $this->_setField('acrValuesSupported');
        return $this;
    }

    /**
     * @return ?TenantSettingsMtls
     */
    public function getMtls(): ?TenantSettingsMtls
    {
        return $this->mtls;
    }

    /**
     * @param ?TenantSettingsMtls $value
     */
    public function setMtls(?TenantSettingsMtls $value = null): self
    {
        $this->mtls = $value;
        $this->_setField('mtls');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPushedAuthorizationRequestsSupported(): ?bool
    {
        return $this->pushedAuthorizationRequestsSupported;
    }

    /**
     * @param ?bool $value
     */
    public function setPushedAuthorizationRequestsSupported(?bool $value = null): self
    {
        $this->pushedAuthorizationRequestsSupported = $value;
        $this->_setField('pushedAuthorizationRequestsSupported');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAuthorizationResponseIssParameterSupported(): ?bool
    {
        return $this->authorizationResponseIssParameterSupported;
    }

    /**
     * @param ?bool $value
     */
    public function setAuthorizationResponseIssParameterSupported(?bool $value = null): self
    {
        $this->authorizationResponseIssParameterSupported = $value;
        $this->_setField('authorizationResponseIssParameterSupported');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSkipNonVerifiableCallbackUriConfirmationPrompt(): ?bool
    {
        return $this->skipNonVerifiableCallbackUriConfirmationPrompt;
    }

    /**
     * @param ?bool $value
     */
    public function setSkipNonVerifiableCallbackUriConfirmationPrompt(?bool $value = null): self
    {
        $this->skipNonVerifiableCallbackUriConfirmationPrompt = $value;
        $this->_setField('skipNonVerifiableCallbackUriConfirmationPrompt');
        return $this;
    }

    /**
     * @return ?value-of<TenantSettingsResourceParameterProfile>
     */
    public function getResourceParameterProfile(): ?string
    {
        return $this->resourceParameterProfile;
    }

    /**
     * @param ?value-of<TenantSettingsResourceParameterProfile> $value
     */
    public function setResourceParameterProfile(?string $value = null): self
    {
        $this->resourceParameterProfile = $value;
        $this->_setField('resourceParameterProfile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getClientIdMetadataDocumentSupported(): ?bool
    {
        return $this->clientIdMetadataDocumentSupported;
    }

    /**
     * @param ?bool $value
     */
    public function setClientIdMetadataDocumentSupported(?bool $value = null): self
    {
        $this->clientIdMetadataDocumentSupported = $value;
        $this->_setField('clientIdMetadataDocumentSupported');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnableAiGuide(): ?bool
    {
        return $this->enableAiGuide;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableAiGuide(?bool $value = null): self
    {
        $this->enableAiGuide = $value;
        $this->_setField('enableAiGuide');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPhoneConsolidatedExperience(): ?bool
    {
        return $this->phoneConsolidatedExperience;
    }

    /**
     * @param ?bool $value
     */
    public function setPhoneConsolidatedExperience(?bool $value = null): self
    {
        $this->phoneConsolidatedExperience = $value;
        $this->_setField('phoneConsolidatedExperience');
        return $this;
    }

    /**
     * @return ?value-of<TenantSettingsDynamicClientRegistrationSecurityMode>
     */
    public function getDynamicClientRegistrationSecurityMode(): ?string
    {
        return $this->dynamicClientRegistrationSecurityMode;
    }

    /**
     * @param ?value-of<TenantSettingsDynamicClientRegistrationSecurityMode> $value
     */
    public function setDynamicClientRegistrationSecurityMode(?string $value = null): self
    {
        $this->dynamicClientRegistrationSecurityMode = $value;
        $this->_setField('dynamicClientRegistrationSecurityMode');
        return $this;
    }
}
