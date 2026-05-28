<?php

namespace Auth0\SDK\API\Management\Clients\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\ClientOidcBackchannelLogoutSettings;
use Auth0\SDK\API\Management\Types\ClientSessionTransferConfiguration;
use Auth0\SDK\API\Management\Types\ClientJwtConfiguration;
use Auth0\SDK\API\Management\Types\ClientEncryptionKey;
use Auth0\SDK\API\Management\Types\ClientTokenEndpointAuthMethodOrNullEnum;
use Auth0\SDK\API\Management\Types\ClientAppTypeEnum;
use Auth0\SDK\API\Management\Types\UpdateTokenQuota;
use Auth0\SDK\API\Management\Types\ClientAddons;
use Auth0\SDK\API\Management\Types\ClientMobile;
use Auth0\SDK\API\Management\Types\NativeSocialLogin;
use Auth0\SDK\API\Management\Types\FedCmLogin;
use Auth0\SDK\API\Management\Types\ClientRefreshTokenConfiguration;
use Auth0\SDK\API\Management\Types\ClientDefaultOrganization;
use Auth0\SDK\API\Management\Types\ClientOrganizationUsagePatchEnum;
use Auth0\SDK\API\Management\Types\ClientOrganizationRequireBehaviorPatchEnum;
use Auth0\SDK\API\Management\Types\ClientOrganizationDiscoveryEnum;
use Auth0\SDK\API\Management\Types\ClientAuthenticationMethod;
use Auth0\SDK\API\Management\Types\ClientSignedRequestObjectWithCredentialId;
use Auth0\SDK\API\Management\Types\ClientComplianceLevelEnum;
use Auth0\SDK\API\Management\Types\ClientTokenExchangeConfigurationOrNull;
use Auth0\SDK\API\Management\Types\ExpressConfigurationOrNull;
use Auth0\SDK\API\Management\Types\ClientMyOrganizationPatchConfiguration;
use Auth0\SDK\API\Management\Types\AsyncApprovalNotificationsChannelsEnum;
use Auth0\SDK\API\Management\Types\ClientThirdPartySecurityModeEnum;
use Auth0\SDK\API\Management\Types\ClientRedirectionPolicyEnum;

class UpdateClientRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $name The name of the client. Must contain at least one character. Does not allow '<' or '>'.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $description Free text description of the purpose of the Client. (Max character length: <code>140</code>)
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?string $clientSecret The secret used to sign tokens for the client
     */
    #[JsonProperty('client_secret')]
    private ?string $clientSecret;

    /**
     * @var ?string $logoUri The URL of the client logo (recommended size: 150x150)
     */
    #[JsonProperty('logo_uri')]
    private ?string $logoUri;

    /**
     * @var ?array<string> $callbacks A set of URLs that are valid to call back from Auth0 when authenticating users
     */
    #[JsonProperty('callbacks'), ArrayType(['string'])]
    private ?array $callbacks;

    /**
     * @var ?ClientOidcBackchannelLogoutSettings $oidcLogout
     */
    #[JsonProperty('oidc_logout')]
    private ?ClientOidcBackchannelLogoutSettings $oidcLogout;

    /**
     * @var ?ClientOidcBackchannelLogoutSettings $oidcBackchannelLogout Configuration for OIDC backchannel logout (deprecated, in favor of oidc_logout)
     */
    #[JsonProperty('oidc_backchannel_logout')]
    private ?ClientOidcBackchannelLogoutSettings $oidcBackchannelLogout;

    /**
     * @var ?ClientSessionTransferConfiguration $sessionTransfer
     */
    #[JsonProperty('session_transfer')]
    private ?ClientSessionTransferConfiguration $sessionTransfer;

    /**
     * @var ?array<string> $allowedOrigins A set of URLs that represents valid origins for CORS
     */
    #[JsonProperty('allowed_origins'), ArrayType(['string'])]
    private ?array $allowedOrigins;

    /**
     * @var ?array<string> $webOrigins A set of URLs that represents valid web origins for use with web message response mode
     */
    #[JsonProperty('web_origins'), ArrayType(['string'])]
    private ?array $webOrigins;

    /**
     * @var ?array<string> $grantTypes A set of grant types that the client is authorized to use. Can include `authorization_code`, `implicit`, `refresh_token`, `client_credentials`, `password`, `http://auth0.com/oauth/grant-type/password-realm`, `http://auth0.com/oauth/grant-type/mfa-oob`, `http://auth0.com/oauth/grant-type/mfa-otp`, `http://auth0.com/oauth/grant-type/mfa-recovery-code`, `urn:openid:params:grant-type:ciba`, `urn:ietf:params:oauth:grant-type:device_code`, and `urn:auth0:params:oauth:grant-type:token-exchange:federated-connection-access-token`.
     */
    #[JsonProperty('grant_types'), ArrayType(['string'])]
    private ?array $grantTypes;

    /**
     * @var ?array<string> $clientAliases List of audiences for SAML protocol
     */
    #[JsonProperty('client_aliases'), ArrayType(['string'])]
    private ?array $clientAliases;

    /**
     * @var ?array<string> $allowedClients Ids of clients that will be allowed to perform delegation requests. Clients that will be allowed to make delegation request. By default, all your clients will be allowed. This field allows you to specify specific clients
     */
    #[JsonProperty('allowed_clients'), ArrayType(['string'])]
    private ?array $allowedClients;

    /**
     * @var ?array<string> $allowedLogoutUrls URLs that are valid to redirect to after logout from Auth0
     */
    #[JsonProperty('allowed_logout_urls'), ArrayType(['string'])]
    private ?array $allowedLogoutUrls;

    /**
     * @var ?ClientJwtConfiguration $jwtConfiguration An object that holds settings related to how JWTs are created
     */
    #[JsonProperty('jwt_configuration')]
    private ?ClientJwtConfiguration $jwtConfiguration;

    /**
     * @var ?ClientEncryptionKey $encryptionKey The client's encryption key
     */
    #[JsonProperty('encryption_key')]
    private ?ClientEncryptionKey $encryptionKey;

    /**
     * @var ?bool $sso <code>true</code> to use Auth0 instead of the IdP to do Single Sign On, <code>false</code> otherwise (default: <code>false</code>)
     */
    #[JsonProperty('sso')]
    private ?bool $sso;

    /**
     * @var ?bool $crossOriginAuthentication <code>true</code> if this client can be used to make cross-origin authentication requests, <code>false</code> otherwise if cross origin is disabled
     */
    #[JsonProperty('cross_origin_authentication')]
    private ?bool $crossOriginAuthentication;

    /**
     * @var ?string $crossOriginLoc URL for the location in your site where the cross origin verification takes place for the cross-origin auth flow when performing Auth in your own domain instead of Auth0 hosted login page.
     */
    #[JsonProperty('cross_origin_loc')]
    private ?string $crossOriginLoc;

    /**
     * @var ?bool $ssoDisabled <code>true</code> to disable Single Sign On, <code>false</code> otherwise (default: <code>false</code>)
     */
    #[JsonProperty('sso_disabled')]
    private ?bool $ssoDisabled;

    /**
     * @var ?bool $customLoginPageOn <code>true</code> if the custom login page is to be used, <code>false</code> otherwise.
     */
    #[JsonProperty('custom_login_page_on')]
    private ?bool $customLoginPageOn;

    /**
     * @var ?value-of<ClientTokenEndpointAuthMethodOrNullEnum> $tokenEndpointAuthMethod
     */
    #[JsonProperty('token_endpoint_auth_method')]
    private ?string $tokenEndpointAuthMethod;

    /**
     * @var ?bool $isTokenEndpointIpHeaderTrusted If true, trust that the IP specified in the `auth0-forwarded-for` header is the end-user's IP for brute-force-protection on token endpoint.
     */
    #[JsonProperty('is_token_endpoint_ip_header_trusted')]
    private ?bool $isTokenEndpointIpHeaderTrusted;

    /**
     * @var ?value-of<ClientAppTypeEnum> $appType
     */
    #[JsonProperty('app_type')]
    private ?string $appType;

    /**
     * @var ?bool $isFirstParty Whether this client a first party client or not
     */
    #[JsonProperty('is_first_party')]
    private ?bool $isFirstParty;

    /**
     * @var ?bool $oidcConformant Whether this client will conform to strict OIDC specifications
     */
    #[JsonProperty('oidc_conformant')]
    private ?bool $oidcConformant;

    /**
     * @var ?string $customLoginPage The content (HTML, CSS, JS) of the custom login page
     */
    #[JsonProperty('custom_login_page')]
    private ?string $customLoginPage;

    /**
     * @var ?string $customLoginPagePreview
     */
    #[JsonProperty('custom_login_page_preview')]
    private ?string $customLoginPagePreview;

    /**
     * @var ?UpdateTokenQuota $tokenQuota
     */
    #[JsonProperty('token_quota')]
    private ?UpdateTokenQuota $tokenQuota;

    /**
     * @var ?string $formTemplate Form template for WS-Federation protocol
     */
    #[JsonProperty('form_template')]
    private ?string $formTemplate;

    /**
     * @var ?ClientAddons $addons
     */
    #[JsonProperty('addons')]
    private ?ClientAddons $addons;

    /**
     * @var ?array<string, mixed> $clientMetadata
     */
    #[JsonProperty('client_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $clientMetadata;

    /**
     * @var ?ClientMobile $mobile Configuration related to native mobile apps
     */
    #[JsonProperty('mobile')]
    private ?ClientMobile $mobile;

    /**
     * @var ?string $initiateLoginUri Initiate login uri, must be https
     */
    #[JsonProperty('initiate_login_uri')]
    private ?string $initiateLoginUri;

    /**
     * @var ?NativeSocialLogin $nativeSocialLogin
     */
    #[JsonProperty('native_social_login')]
    private ?NativeSocialLogin $nativeSocialLogin;

    /**
     * @var ?FedCmLogin $fedcmLogin
     */
    #[JsonProperty('fedcm_login')]
    private ?FedCmLogin $fedcmLogin;

    /**
     * @var ?ClientRefreshTokenConfiguration $refreshToken
     */
    #[JsonProperty('refresh_token')]
    private ?ClientRefreshTokenConfiguration $refreshToken;

    /**
     * @var ?ClientDefaultOrganization $defaultOrganization
     */
    #[JsonProperty('default_organization')]
    private ?ClientDefaultOrganization $defaultOrganization;

    /**
     * @var ?value-of<ClientOrganizationUsagePatchEnum> $organizationUsage
     */
    #[JsonProperty('organization_usage')]
    private ?string $organizationUsage;

    /**
     * @var ?value-of<ClientOrganizationRequireBehaviorPatchEnum> $organizationRequireBehavior
     */
    #[JsonProperty('organization_require_behavior')]
    private ?string $organizationRequireBehavior;

    /**
     * @var ?array<value-of<ClientOrganizationDiscoveryEnum>> $organizationDiscoveryMethods Defines the available methods for organization discovery during the `pre_login_prompt`. Users can discover their organization either by `email`, `organization_name` or both.
     */
    #[JsonProperty('organization_discovery_methods'), ArrayType(['string'])]
    private ?array $organizationDiscoveryMethods;

    /**
     * @var ?ClientAuthenticationMethod $clientAuthenticationMethods
     */
    #[JsonProperty('client_authentication_methods')]
    private ?ClientAuthenticationMethod $clientAuthenticationMethods;

    /**
     * @var ?bool $requirePushedAuthorizationRequests Makes the use of Pushed Authorization Requests mandatory for this client
     */
    #[JsonProperty('require_pushed_authorization_requests')]
    private ?bool $requirePushedAuthorizationRequests;

    /**
     * @var ?bool $requireProofOfPossession Makes the use of Proof-of-Possession mandatory for this client
     */
    #[JsonProperty('require_proof_of_possession')]
    private ?bool $requireProofOfPossession;

    /**
     * @var ?ClientSignedRequestObjectWithCredentialId $signedRequestObject
     */
    #[JsonProperty('signed_request_object')]
    private ?ClientSignedRequestObjectWithCredentialId $signedRequestObject;

    /**
     * @var ?value-of<ClientComplianceLevelEnum> $complianceLevel
     */
    #[JsonProperty('compliance_level')]
    private ?string $complianceLevel;

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
     * @var ?ClientTokenExchangeConfigurationOrNull $tokenExchange
     */
    #[JsonProperty('token_exchange')]
    private ?ClientTokenExchangeConfigurationOrNull $tokenExchange;

    /**
     * @var ?int $parRequestExpiry Specifies how long, in seconds, a Pushed Authorization Request URI remains valid
     */
    #[JsonProperty('par_request_expiry')]
    private ?int $parRequestExpiry;

    /**
     * @var ?ExpressConfigurationOrNull $expressConfiguration
     */
    #[JsonProperty('express_configuration')]
    private ?ExpressConfigurationOrNull $expressConfiguration;

    /**
     * @var ?ClientMyOrganizationPatchConfiguration $myOrganizationConfiguration
     */
    #[JsonProperty('my_organization_configuration')]
    private ?ClientMyOrganizationPatchConfiguration $myOrganizationConfiguration;

    /**
     * @var ?array<value-of<AsyncApprovalNotificationsChannelsEnum>> $asyncApprovalNotificationChannels
     */
    #[JsonProperty('async_approval_notification_channels'), ArrayType(['string'])]
    private ?array $asyncApprovalNotificationChannels;

    /**
     * @var ?value-of<ClientThirdPartySecurityModeEnum> $thirdPartySecurityMode
     */
    #[JsonProperty('third_party_security_mode')]
    private ?string $thirdPartySecurityMode;

    /**
     * @var ?value-of<ClientRedirectionPolicyEnum> $redirectionPolicy
     */
    #[JsonProperty('redirection_policy')]
    private ?string $redirectionPolicy;

    /**
     * @param array{
     *   name?: ?string,
     *   description?: ?string,
     *   clientSecret?: ?string,
     *   logoUri?: ?string,
     *   callbacks?: ?array<string>,
     *   oidcLogout?: ?ClientOidcBackchannelLogoutSettings,
     *   oidcBackchannelLogout?: ?ClientOidcBackchannelLogoutSettings,
     *   sessionTransfer?: ?ClientSessionTransferConfiguration,
     *   allowedOrigins?: ?array<string>,
     *   webOrigins?: ?array<string>,
     *   grantTypes?: ?array<string>,
     *   clientAliases?: ?array<string>,
     *   allowedClients?: ?array<string>,
     *   allowedLogoutUrls?: ?array<string>,
     *   jwtConfiguration?: ?ClientJwtConfiguration,
     *   encryptionKey?: ?ClientEncryptionKey,
     *   sso?: ?bool,
     *   crossOriginAuthentication?: ?bool,
     *   crossOriginLoc?: ?string,
     *   ssoDisabled?: ?bool,
     *   customLoginPageOn?: ?bool,
     *   tokenEndpointAuthMethod?: ?value-of<ClientTokenEndpointAuthMethodOrNullEnum>,
     *   isTokenEndpointIpHeaderTrusted?: ?bool,
     *   appType?: ?value-of<ClientAppTypeEnum>,
     *   isFirstParty?: ?bool,
     *   oidcConformant?: ?bool,
     *   customLoginPage?: ?string,
     *   customLoginPagePreview?: ?string,
     *   tokenQuota?: ?UpdateTokenQuota,
     *   formTemplate?: ?string,
     *   addons?: ?ClientAddons,
     *   clientMetadata?: ?array<string, mixed>,
     *   mobile?: ?ClientMobile,
     *   initiateLoginUri?: ?string,
     *   nativeSocialLogin?: ?NativeSocialLogin,
     *   fedcmLogin?: ?FedCmLogin,
     *   refreshToken?: ?ClientRefreshTokenConfiguration,
     *   defaultOrganization?: ?ClientDefaultOrganization,
     *   organizationUsage?: ?value-of<ClientOrganizationUsagePatchEnum>,
     *   organizationRequireBehavior?: ?value-of<ClientOrganizationRequireBehaviorPatchEnum>,
     *   organizationDiscoveryMethods?: ?array<value-of<ClientOrganizationDiscoveryEnum>>,
     *   clientAuthenticationMethods?: ?ClientAuthenticationMethod,
     *   requirePushedAuthorizationRequests?: ?bool,
     *   requireProofOfPossession?: ?bool,
     *   signedRequestObject?: ?ClientSignedRequestObjectWithCredentialId,
     *   complianceLevel?: ?value-of<ClientComplianceLevelEnum>,
     *   skipNonVerifiableCallbackUriConfirmationPrompt?: ?bool,
     *   tokenExchange?: ?ClientTokenExchangeConfigurationOrNull,
     *   parRequestExpiry?: ?int,
     *   expressConfiguration?: ?ExpressConfigurationOrNull,
     *   myOrganizationConfiguration?: ?ClientMyOrganizationPatchConfiguration,
     *   asyncApprovalNotificationChannels?: ?array<value-of<AsyncApprovalNotificationsChannelsEnum>>,
     *   thirdPartySecurityMode?: ?value-of<ClientThirdPartySecurityModeEnum>,
     *   redirectionPolicy?: ?value-of<ClientRedirectionPolicyEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->logoUri = $values['logoUri'] ?? null;
        $this->callbacks = $values['callbacks'] ?? null;
        $this->oidcLogout = $values['oidcLogout'] ?? null;
        $this->oidcBackchannelLogout = $values['oidcBackchannelLogout'] ?? null;
        $this->sessionTransfer = $values['sessionTransfer'] ?? null;
        $this->allowedOrigins = $values['allowedOrigins'] ?? null;
        $this->webOrigins = $values['webOrigins'] ?? null;
        $this->grantTypes = $values['grantTypes'] ?? null;
        $this->clientAliases = $values['clientAliases'] ?? null;
        $this->allowedClients = $values['allowedClients'] ?? null;
        $this->allowedLogoutUrls = $values['allowedLogoutUrls'] ?? null;
        $this->jwtConfiguration = $values['jwtConfiguration'] ?? null;
        $this->encryptionKey = $values['encryptionKey'] ?? null;
        $this->sso = $values['sso'] ?? null;
        $this->crossOriginAuthentication = $values['crossOriginAuthentication'] ?? null;
        $this->crossOriginLoc = $values['crossOriginLoc'] ?? null;
        $this->ssoDisabled = $values['ssoDisabled'] ?? null;
        $this->customLoginPageOn = $values['customLoginPageOn'] ?? null;
        $this->tokenEndpointAuthMethod = $values['tokenEndpointAuthMethod'] ?? null;
        $this->isTokenEndpointIpHeaderTrusted = $values['isTokenEndpointIpHeaderTrusted'] ?? null;
        $this->appType = $values['appType'] ?? null;
        $this->isFirstParty = $values['isFirstParty'] ?? null;
        $this->oidcConformant = $values['oidcConformant'] ?? null;
        $this->customLoginPage = $values['customLoginPage'] ?? null;
        $this->customLoginPagePreview = $values['customLoginPagePreview'] ?? null;
        $this->tokenQuota = $values['tokenQuota'] ?? null;
        $this->formTemplate = $values['formTemplate'] ?? null;
        $this->addons = $values['addons'] ?? null;
        $this->clientMetadata = $values['clientMetadata'] ?? null;
        $this->mobile = $values['mobile'] ?? null;
        $this->initiateLoginUri = $values['initiateLoginUri'] ?? null;
        $this->nativeSocialLogin = $values['nativeSocialLogin'] ?? null;
        $this->fedcmLogin = $values['fedcmLogin'] ?? null;
        $this->refreshToken = $values['refreshToken'] ?? null;
        $this->defaultOrganization = $values['defaultOrganization'] ?? null;
        $this->organizationUsage = $values['organizationUsage'] ?? null;
        $this->organizationRequireBehavior = $values['organizationRequireBehavior'] ?? null;
        $this->organizationDiscoveryMethods = $values['organizationDiscoveryMethods'] ?? null;
        $this->clientAuthenticationMethods = $values['clientAuthenticationMethods'] ?? null;
        $this->requirePushedAuthorizationRequests = $values['requirePushedAuthorizationRequests'] ?? null;
        $this->requireProofOfPossession = $values['requireProofOfPossession'] ?? null;
        $this->signedRequestObject = $values['signedRequestObject'] ?? null;
        $this->complianceLevel = $values['complianceLevel'] ?? null;
        $this->skipNonVerifiableCallbackUriConfirmationPrompt = $values['skipNonVerifiableCallbackUriConfirmationPrompt'] ?? null;
        $this->tokenExchange = $values['tokenExchange'] ?? null;
        $this->parRequestExpiry = $values['parRequestExpiry'] ?? null;
        $this->expressConfiguration = $values['expressConfiguration'] ?? null;
        $this->myOrganizationConfiguration = $values['myOrganizationConfiguration'] ?? null;
        $this->asyncApprovalNotificationChannels = $values['asyncApprovalNotificationChannels'] ?? null;
        $this->thirdPartySecurityMode = $values['thirdPartySecurityMode'] ?? null;
        $this->redirectionPolicy = $values['redirectionPolicy'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
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
    public function getLogoUri(): ?string
    {
        return $this->logoUri;
    }

    /**
     * @param ?string $value
     */
    public function setLogoUri(?string $value = null): self
    {
        $this->logoUri = $value;
        $this->_setField('logoUri');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getCallbacks(): ?array
    {
        return $this->callbacks;
    }

    /**
     * @param ?array<string> $value
     */
    public function setCallbacks(?array $value = null): self
    {
        $this->callbacks = $value;
        $this->_setField('callbacks');
        return $this;
    }

    /**
     * @return ?ClientOidcBackchannelLogoutSettings
     */
    public function getOidcLogout(): ?ClientOidcBackchannelLogoutSettings
    {
        return $this->oidcLogout;
    }

    /**
     * @param ?ClientOidcBackchannelLogoutSettings $value
     */
    public function setOidcLogout(?ClientOidcBackchannelLogoutSettings $value = null): self
    {
        $this->oidcLogout = $value;
        $this->_setField('oidcLogout');
        return $this;
    }

    /**
     * @return ?ClientOidcBackchannelLogoutSettings
     */
    public function getOidcBackchannelLogout(): ?ClientOidcBackchannelLogoutSettings
    {
        return $this->oidcBackchannelLogout;
    }

    /**
     * @param ?ClientOidcBackchannelLogoutSettings $value
     */
    public function setOidcBackchannelLogout(?ClientOidcBackchannelLogoutSettings $value = null): self
    {
        $this->oidcBackchannelLogout = $value;
        $this->_setField('oidcBackchannelLogout');
        return $this;
    }

    /**
     * @return ?ClientSessionTransferConfiguration
     */
    public function getSessionTransfer(): ?ClientSessionTransferConfiguration
    {
        return $this->sessionTransfer;
    }

    /**
     * @param ?ClientSessionTransferConfiguration $value
     */
    public function setSessionTransfer(?ClientSessionTransferConfiguration $value = null): self
    {
        $this->sessionTransfer = $value;
        $this->_setField('sessionTransfer');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getAllowedOrigins(): ?array
    {
        return $this->allowedOrigins;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAllowedOrigins(?array $value = null): self
    {
        $this->allowedOrigins = $value;
        $this->_setField('allowedOrigins');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getWebOrigins(): ?array
    {
        return $this->webOrigins;
    }

    /**
     * @param ?array<string> $value
     */
    public function setWebOrigins(?array $value = null): self
    {
        $this->webOrigins = $value;
        $this->_setField('webOrigins');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getGrantTypes(): ?array
    {
        return $this->grantTypes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setGrantTypes(?array $value = null): self
    {
        $this->grantTypes = $value;
        $this->_setField('grantTypes');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getClientAliases(): ?array
    {
        return $this->clientAliases;
    }

    /**
     * @param ?array<string> $value
     */
    public function setClientAliases(?array $value = null): self
    {
        $this->clientAliases = $value;
        $this->_setField('clientAliases');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getAllowedClients(): ?array
    {
        return $this->allowedClients;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAllowedClients(?array $value = null): self
    {
        $this->allowedClients = $value;
        $this->_setField('allowedClients');
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
     * @return ?ClientJwtConfiguration
     */
    public function getJwtConfiguration(): ?ClientJwtConfiguration
    {
        return $this->jwtConfiguration;
    }

    /**
     * @param ?ClientJwtConfiguration $value
     */
    public function setJwtConfiguration(?ClientJwtConfiguration $value = null): self
    {
        $this->jwtConfiguration = $value;
        $this->_setField('jwtConfiguration');
        return $this;
    }

    /**
     * @return ?ClientEncryptionKey
     */
    public function getEncryptionKey(): ?ClientEncryptionKey
    {
        return $this->encryptionKey;
    }

    /**
     * @param ?ClientEncryptionKey $value
     */
    public function setEncryptionKey(?ClientEncryptionKey $value = null): self
    {
        $this->encryptionKey = $value;
        $this->_setField('encryptionKey');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSso(): ?bool
    {
        return $this->sso;
    }

    /**
     * @param ?bool $value
     */
    public function setSso(?bool $value = null): self
    {
        $this->sso = $value;
        $this->_setField('sso');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCrossOriginAuthentication(): ?bool
    {
        return $this->crossOriginAuthentication;
    }

    /**
     * @param ?bool $value
     */
    public function setCrossOriginAuthentication(?bool $value = null): self
    {
        $this->crossOriginAuthentication = $value;
        $this->_setField('crossOriginAuthentication');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCrossOriginLoc(): ?string
    {
        return $this->crossOriginLoc;
    }

    /**
     * @param ?string $value
     */
    public function setCrossOriginLoc(?string $value = null): self
    {
        $this->crossOriginLoc = $value;
        $this->_setField('crossOriginLoc');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSsoDisabled(): ?bool
    {
        return $this->ssoDisabled;
    }

    /**
     * @param ?bool $value
     */
    public function setSsoDisabled(?bool $value = null): self
    {
        $this->ssoDisabled = $value;
        $this->_setField('ssoDisabled');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCustomLoginPageOn(): ?bool
    {
        return $this->customLoginPageOn;
    }

    /**
     * @param ?bool $value
     */
    public function setCustomLoginPageOn(?bool $value = null): self
    {
        $this->customLoginPageOn = $value;
        $this->_setField('customLoginPageOn');
        return $this;
    }

    /**
     * @return ?value-of<ClientTokenEndpointAuthMethodOrNullEnum>
     */
    public function getTokenEndpointAuthMethod(): ?string
    {
        return $this->tokenEndpointAuthMethod;
    }

    /**
     * @param ?value-of<ClientTokenEndpointAuthMethodOrNullEnum> $value
     */
    public function setTokenEndpointAuthMethod(?string $value = null): self
    {
        $this->tokenEndpointAuthMethod = $value;
        $this->_setField('tokenEndpointAuthMethod');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsTokenEndpointIpHeaderTrusted(): ?bool
    {
        return $this->isTokenEndpointIpHeaderTrusted;
    }

    /**
     * @param ?bool $value
     */
    public function setIsTokenEndpointIpHeaderTrusted(?bool $value = null): self
    {
        $this->isTokenEndpointIpHeaderTrusted = $value;
        $this->_setField('isTokenEndpointIpHeaderTrusted');
        return $this;
    }

    /**
     * @return ?value-of<ClientAppTypeEnum>
     */
    public function getAppType(): ?string
    {
        return $this->appType;
    }

    /**
     * @param ?value-of<ClientAppTypeEnum> $value
     */
    public function setAppType(?string $value = null): self
    {
        $this->appType = $value;
        $this->_setField('appType');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsFirstParty(): ?bool
    {
        return $this->isFirstParty;
    }

    /**
     * @param ?bool $value
     */
    public function setIsFirstParty(?bool $value = null): self
    {
        $this->isFirstParty = $value;
        $this->_setField('isFirstParty');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getOidcConformant(): ?bool
    {
        return $this->oidcConformant;
    }

    /**
     * @param ?bool $value
     */
    public function setOidcConformant(?bool $value = null): self
    {
        $this->oidcConformant = $value;
        $this->_setField('oidcConformant');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCustomLoginPage(): ?string
    {
        return $this->customLoginPage;
    }

    /**
     * @param ?string $value
     */
    public function setCustomLoginPage(?string $value = null): self
    {
        $this->customLoginPage = $value;
        $this->_setField('customLoginPage');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCustomLoginPagePreview(): ?string
    {
        return $this->customLoginPagePreview;
    }

    /**
     * @param ?string $value
     */
    public function setCustomLoginPagePreview(?string $value = null): self
    {
        $this->customLoginPagePreview = $value;
        $this->_setField('customLoginPagePreview');
        return $this;
    }

    /**
     * @return ?UpdateTokenQuota
     */
    public function getTokenQuota(): ?UpdateTokenQuota
    {
        return $this->tokenQuota;
    }

    /**
     * @param ?UpdateTokenQuota $value
     */
    public function setTokenQuota(?UpdateTokenQuota $value = null): self
    {
        $this->tokenQuota = $value;
        $this->_setField('tokenQuota');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFormTemplate(): ?string
    {
        return $this->formTemplate;
    }

    /**
     * @param ?string $value
     */
    public function setFormTemplate(?string $value = null): self
    {
        $this->formTemplate = $value;
        $this->_setField('formTemplate');
        return $this;
    }

    /**
     * @return ?ClientAddons
     */
    public function getAddons(): ?ClientAddons
    {
        return $this->addons;
    }

    /**
     * @param ?ClientAddons $value
     */
    public function setAddons(?ClientAddons $value = null): self
    {
        $this->addons = $value;
        $this->_setField('addons');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getClientMetadata(): ?array
    {
        return $this->clientMetadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setClientMetadata(?array $value = null): self
    {
        $this->clientMetadata = $value;
        $this->_setField('clientMetadata');
        return $this;
    }

    /**
     * @return ?ClientMobile
     */
    public function getMobile(): ?ClientMobile
    {
        return $this->mobile;
    }

    /**
     * @param ?ClientMobile $value
     */
    public function setMobile(?ClientMobile $value = null): self
    {
        $this->mobile = $value;
        $this->_setField('mobile');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getInitiateLoginUri(): ?string
    {
        return $this->initiateLoginUri;
    }

    /**
     * @param ?string $value
     */
    public function setInitiateLoginUri(?string $value = null): self
    {
        $this->initiateLoginUri = $value;
        $this->_setField('initiateLoginUri');
        return $this;
    }

    /**
     * @return ?NativeSocialLogin
     */
    public function getNativeSocialLogin(): ?NativeSocialLogin
    {
        return $this->nativeSocialLogin;
    }

    /**
     * @param ?NativeSocialLogin $value
     */
    public function setNativeSocialLogin(?NativeSocialLogin $value = null): self
    {
        $this->nativeSocialLogin = $value;
        $this->_setField('nativeSocialLogin');
        return $this;
    }

    /**
     * @return ?FedCmLogin
     */
    public function getFedcmLogin(): ?FedCmLogin
    {
        return $this->fedcmLogin;
    }

    /**
     * @param ?FedCmLogin $value
     */
    public function setFedcmLogin(?FedCmLogin $value = null): self
    {
        $this->fedcmLogin = $value;
        $this->_setField('fedcmLogin');
        return $this;
    }

    /**
     * @return ?ClientRefreshTokenConfiguration
     */
    public function getRefreshToken(): ?ClientRefreshTokenConfiguration
    {
        return $this->refreshToken;
    }

    /**
     * @param ?ClientRefreshTokenConfiguration $value
     */
    public function setRefreshToken(?ClientRefreshTokenConfiguration $value = null): self
    {
        $this->refreshToken = $value;
        $this->_setField('refreshToken');
        return $this;
    }

    /**
     * @return ?ClientDefaultOrganization
     */
    public function getDefaultOrganization(): ?ClientDefaultOrganization
    {
        return $this->defaultOrganization;
    }

    /**
     * @param ?ClientDefaultOrganization $value
     */
    public function setDefaultOrganization(?ClientDefaultOrganization $value = null): self
    {
        $this->defaultOrganization = $value;
        $this->_setField('defaultOrganization');
        return $this;
    }

    /**
     * @return ?value-of<ClientOrganizationUsagePatchEnum>
     */
    public function getOrganizationUsage(): ?string
    {
        return $this->organizationUsage;
    }

    /**
     * @param ?value-of<ClientOrganizationUsagePatchEnum> $value
     */
    public function setOrganizationUsage(?string $value = null): self
    {
        $this->organizationUsage = $value;
        $this->_setField('organizationUsage');
        return $this;
    }

    /**
     * @return ?value-of<ClientOrganizationRequireBehaviorPatchEnum>
     */
    public function getOrganizationRequireBehavior(): ?string
    {
        return $this->organizationRequireBehavior;
    }

    /**
     * @param ?value-of<ClientOrganizationRequireBehaviorPatchEnum> $value
     */
    public function setOrganizationRequireBehavior(?string $value = null): self
    {
        $this->organizationRequireBehavior = $value;
        $this->_setField('organizationRequireBehavior');
        return $this;
    }

    /**
     * @return ?array<value-of<ClientOrganizationDiscoveryEnum>>
     */
    public function getOrganizationDiscoveryMethods(): ?array
    {
        return $this->organizationDiscoveryMethods;
    }

    /**
     * @param ?array<value-of<ClientOrganizationDiscoveryEnum>> $value
     */
    public function setOrganizationDiscoveryMethods(?array $value = null): self
    {
        $this->organizationDiscoveryMethods = $value;
        $this->_setField('organizationDiscoveryMethods');
        return $this;
    }

    /**
     * @return ?ClientAuthenticationMethod
     */
    public function getClientAuthenticationMethods(): ?ClientAuthenticationMethod
    {
        return $this->clientAuthenticationMethods;
    }

    /**
     * @param ?ClientAuthenticationMethod $value
     */
    public function setClientAuthenticationMethods(?ClientAuthenticationMethod $value = null): self
    {
        $this->clientAuthenticationMethods = $value;
        $this->_setField('clientAuthenticationMethods');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRequirePushedAuthorizationRequests(): ?bool
    {
        return $this->requirePushedAuthorizationRequests;
    }

    /**
     * @param ?bool $value
     */
    public function setRequirePushedAuthorizationRequests(?bool $value = null): self
    {
        $this->requirePushedAuthorizationRequests = $value;
        $this->_setField('requirePushedAuthorizationRequests');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRequireProofOfPossession(): ?bool
    {
        return $this->requireProofOfPossession;
    }

    /**
     * @param ?bool $value
     */
    public function setRequireProofOfPossession(?bool $value = null): self
    {
        $this->requireProofOfPossession = $value;
        $this->_setField('requireProofOfPossession');
        return $this;
    }

    /**
     * @return ?ClientSignedRequestObjectWithCredentialId
     */
    public function getSignedRequestObject(): ?ClientSignedRequestObjectWithCredentialId
    {
        return $this->signedRequestObject;
    }

    /**
     * @param ?ClientSignedRequestObjectWithCredentialId $value
     */
    public function setSignedRequestObject(?ClientSignedRequestObjectWithCredentialId $value = null): self
    {
        $this->signedRequestObject = $value;
        $this->_setField('signedRequestObject');
        return $this;
    }

    /**
     * @return ?value-of<ClientComplianceLevelEnum>
     */
    public function getComplianceLevel(): ?string
    {
        return $this->complianceLevel;
    }

    /**
     * @param ?value-of<ClientComplianceLevelEnum> $value
     */
    public function setComplianceLevel(?string $value = null): self
    {
        $this->complianceLevel = $value;
        $this->_setField('complianceLevel');
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
     * @return ?ClientTokenExchangeConfigurationOrNull
     */
    public function getTokenExchange(): ?ClientTokenExchangeConfigurationOrNull
    {
        return $this->tokenExchange;
    }

    /**
     * @param ?ClientTokenExchangeConfigurationOrNull $value
     */
    public function setTokenExchange(?ClientTokenExchangeConfigurationOrNull $value = null): self
    {
        $this->tokenExchange = $value;
        $this->_setField('tokenExchange');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getParRequestExpiry(): ?int
    {
        return $this->parRequestExpiry;
    }

    /**
     * @param ?int $value
     */
    public function setParRequestExpiry(?int $value = null): self
    {
        $this->parRequestExpiry = $value;
        $this->_setField('parRequestExpiry');
        return $this;
    }

    /**
     * @return ?ExpressConfigurationOrNull
     */
    public function getExpressConfiguration(): ?ExpressConfigurationOrNull
    {
        return $this->expressConfiguration;
    }

    /**
     * @param ?ExpressConfigurationOrNull $value
     */
    public function setExpressConfiguration(?ExpressConfigurationOrNull $value = null): self
    {
        $this->expressConfiguration = $value;
        $this->_setField('expressConfiguration');
        return $this;
    }

    /**
     * @return ?ClientMyOrganizationPatchConfiguration
     */
    public function getMyOrganizationConfiguration(): ?ClientMyOrganizationPatchConfiguration
    {
        return $this->myOrganizationConfiguration;
    }

    /**
     * @param ?ClientMyOrganizationPatchConfiguration $value
     */
    public function setMyOrganizationConfiguration(?ClientMyOrganizationPatchConfiguration $value = null): self
    {
        $this->myOrganizationConfiguration = $value;
        $this->_setField('myOrganizationConfiguration');
        return $this;
    }

    /**
     * @return ?array<value-of<AsyncApprovalNotificationsChannelsEnum>>
     */
    public function getAsyncApprovalNotificationChannels(): ?array
    {
        return $this->asyncApprovalNotificationChannels;
    }

    /**
     * @param ?array<value-of<AsyncApprovalNotificationsChannelsEnum>> $value
     */
    public function setAsyncApprovalNotificationChannels(?array $value = null): self
    {
        $this->asyncApprovalNotificationChannels = $value;
        $this->_setField('asyncApprovalNotificationChannels');
        return $this;
    }

    /**
     * @return ?value-of<ClientThirdPartySecurityModeEnum>
     */
    public function getThirdPartySecurityMode(): ?string
    {
        return $this->thirdPartySecurityMode;
    }

    /**
     * @param ?value-of<ClientThirdPartySecurityModeEnum> $value
     */
    public function setThirdPartySecurityMode(?string $value = null): self
    {
        $this->thirdPartySecurityMode = $value;
        $this->_setField('thirdPartySecurityMode');
        return $this;
    }

    /**
     * @return ?value-of<ClientRedirectionPolicyEnum>
     */
    public function getRedirectionPolicy(): ?string
    {
        return $this->redirectionPolicy;
    }

    /**
     * @param ?value-of<ClientRedirectionPolicyEnum> $value
     */
    public function setRedirectionPolicy(?string $value = null): self
    {
        $this->redirectionPolicy = $value;
        $this->_setField('redirectionPolicy');
        return $this;
    }
}
