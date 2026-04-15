<?php

namespace Auth0\SDK\API\Management\Clients\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\ClientOidcBackchannelLogoutSettings;
use Auth0\SDK\API\Management\Types\ClientSessionTransferConfiguration;
use Auth0\SDK\API\Management\Types\ClientTokenEndpointAuthMethodEnum;
use Auth0\SDK\API\Management\Types\ClientAppTypeEnum;
use Auth0\SDK\API\Management\Types\ClientJwtConfiguration;
use Auth0\SDK\API\Management\Types\ClientEncryptionKey;
use Auth0\SDK\API\Management\Types\ClientAddons;
use Auth0\SDK\API\Management\Types\ClientMobile;
use Auth0\SDK\API\Management\Types\NativeSocialLogin;
use Auth0\SDK\API\Management\Types\ClientRefreshTokenConfiguration;
use Auth0\SDK\API\Management\Types\ClientDefaultOrganization;
use Auth0\SDK\API\Management\Types\ClientOrganizationUsageEnum;
use Auth0\SDK\API\Management\Types\ClientOrganizationRequireBehaviorEnum;
use Auth0\SDK\API\Management\Types\ClientOrganizationDiscoveryEnum;
use Auth0\SDK\API\Management\Types\ClientCreateAuthenticationMethod;
use Auth0\SDK\API\Management\Types\ClientSignedRequestObjectWithPublicKey;
use Auth0\SDK\API\Management\Types\ClientComplianceLevelEnum;
use Auth0\SDK\API\Management\Types\ClientTokenExchangeConfiguration;
use Auth0\SDK\API\Management\Types\CreateTokenQuota;
use Auth0\SDK\API\Management\Types\ExpressConfiguration;
use Auth0\SDK\API\Management\Types\AsyncApprovalNotificationsChannelsEnum;

class CreateClientRequestContent extends JsonSerializableType
{
    /**
     * @var string $name Name of this client (min length: 1 character, does not allow `<` or `>`).
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description Free text description of this client (max length: 140 characters).
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?string $logoUri URL of the logo to display for this client. Recommended size is 150x150 pixels.
     */
    #[JsonProperty('logo_uri')]
    private ?string $logoUri;

    /**
     * @var ?array<string> $callbacks Comma-separated list of URLs whitelisted for Auth0 to use as a callback to the client after authentication.
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
     * @var ?array<string> $allowedOrigins Comma-separated list of URLs allowed to make requests from JavaScript to Auth0 API (typically used with CORS). By default, all your callback URLs will be allowed. This field allows you to enter other origins if necessary. You can also use wildcards at the subdomain level (e.g., https://*.contoso.com). Query strings and hash information are not taken into account when validating these URLs.
     */
    #[JsonProperty('allowed_origins'), ArrayType(['string'])]
    private ?array $allowedOrigins;

    /**
     * @var ?array<string> $webOrigins Comma-separated list of allowed origins for use with <a href='https://auth0.com/docs/cross-origin-authentication'>Cross-Origin Authentication</a>, <a href='https://auth0.com/docs/flows/concepts/device-auth'>Device Flow</a>, and <a href='https://auth0.com/docs/protocols/oauth2#how-response-mode-works'>web message response mode</a>.
     */
    #[JsonProperty('web_origins'), ArrayType(['string'])]
    private ?array $webOrigins;

    /**
     * @var ?array<string> $clientAliases List of audiences/realms for SAML protocol. Used by the wsfed addon.
     */
    #[JsonProperty('client_aliases'), ArrayType(['string'])]
    private ?array $clientAliases;

    /**
     * @var ?array<string> $allowedClients List of allow clients and API ids that are allowed to make delegation requests. Empty means all all your clients are allowed.
     */
    #[JsonProperty('allowed_clients'), ArrayType(['string'])]
    private ?array $allowedClients;

    /**
     * @var ?array<string> $allowedLogoutUrls Comma-separated list of URLs that are valid to redirect to after logout from Auth0. Wildcards are allowed for subdomains.
     */
    #[JsonProperty('allowed_logout_urls'), ArrayType(['string'])]
    private ?array $allowedLogoutUrls;

    /**
     * @var ?array<string> $grantTypes List of grant types supported for this application. Can include `authorization_code`, `implicit`, `refresh_token`, `client_credentials`, `password`, `http://auth0.com/oauth/grant-type/password-realm`, `http://auth0.com/oauth/grant-type/mfa-oob`, `http://auth0.com/oauth/grant-type/mfa-otp`, `http://auth0.com/oauth/grant-type/mfa-recovery-code`, `urn:openid:params:grant-type:ciba`, `urn:ietf:params:oauth:grant-type:device_code`, and `urn:auth0:params:oauth:grant-type:token-exchange:federated-connection-access-token`.
     */
    #[JsonProperty('grant_types'), ArrayType(['string'])]
    private ?array $grantTypes;

    /**
     * @var ?value-of<ClientTokenEndpointAuthMethodEnum> $tokenEndpointAuthMethod
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
     * @var ?bool $oidcConformant Whether this client conforms to <a href='https://auth0.com/docs/api-auth/tutorials/adoption'>strict OIDC specifications</a> (true) or uses legacy features (false).
     */
    #[JsonProperty('oidc_conformant')]
    private ?bool $oidcConformant;

    /**
     * @var ?ClientJwtConfiguration $jwtConfiguration
     */
    #[JsonProperty('jwt_configuration')]
    private ?ClientJwtConfiguration $jwtConfiguration;

    /**
     * @var ?ClientEncryptionKey $encryptionKey
     */
    #[JsonProperty('encryption_key')]
    private ?ClientEncryptionKey $encryptionKey;

    /**
     * @var ?bool $sso Applies only to SSO clients and determines whether Auth0 will handle Single Sign On (true) or whether the Identity Provider will (false).
     */
    #[JsonProperty('sso')]
    private ?bool $sso;

    /**
     * @var ?bool $crossOriginAuthentication Whether this client can be used to make cross-origin authentication requests (true) or it is not allowed to make such requests (false).
     */
    #[JsonProperty('cross_origin_authentication')]
    private ?bool $crossOriginAuthentication;

    /**
     * @var ?string $crossOriginLoc URL of the location in your site where the cross origin verification takes place for the cross-origin auth flow when performing Auth in your own domain instead of Auth0 hosted login page.
     */
    #[JsonProperty('cross_origin_loc')]
    private ?string $crossOriginLoc;

    /**
     * @var ?bool $ssoDisabled <code>true</code> to disable Single Sign On, <code>false</code> otherwise (default: <code>false</code>)
     */
    #[JsonProperty('sso_disabled')]
    private ?bool $ssoDisabled;

    /**
     * @var ?bool $customLoginPageOn <code>true</code> if the custom login page is to be used, <code>false</code> otherwise. Defaults to <code>true</code>
     */
    #[JsonProperty('custom_login_page_on')]
    private ?bool $customLoginPageOn;

    /**
     * @var ?string $customLoginPage The content (HTML, CSS, JS) of the custom login page.
     */
    #[JsonProperty('custom_login_page')]
    private ?string $customLoginPage;

    /**
     * @var ?string $customLoginPagePreview The content (HTML, CSS, JS) of the custom login page. (Used on Previews)
     */
    #[JsonProperty('custom_login_page_preview')]
    private ?string $customLoginPagePreview;

    /**
     * @var ?string $formTemplate HTML form template to be used for WS-Federation.
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
     * @var ?ClientMobile $mobile
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
     * @var ?value-of<ClientOrganizationUsageEnum> $organizationUsage
     */
    #[JsonProperty('organization_usage')]
    private ?string $organizationUsage;

    /**
     * @var ?value-of<ClientOrganizationRequireBehaviorEnum> $organizationRequireBehavior
     */
    #[JsonProperty('organization_require_behavior')]
    private ?string $organizationRequireBehavior;

    /**
     * @var ?array<value-of<ClientOrganizationDiscoveryEnum>> $organizationDiscoveryMethods Defines the available methods for organization discovery during the `pre_login_prompt`. Users can discover their organization either by `email`, `organization_name` or both.
     */
    #[JsonProperty('organization_discovery_methods'), ArrayType(['string'])]
    private ?array $organizationDiscoveryMethods;

    /**
     * @var ?ClientCreateAuthenticationMethod $clientAuthenticationMethods
     */
    #[JsonProperty('client_authentication_methods')]
    private ?ClientCreateAuthenticationMethod $clientAuthenticationMethods;

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
     * @var ?ClientSignedRequestObjectWithPublicKey $signedRequestObject
     */
    #[JsonProperty('signed_request_object')]
    private ?ClientSignedRequestObjectWithPublicKey $signedRequestObject;

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
     * @var ?ClientTokenExchangeConfiguration $tokenExchange
     */
    #[JsonProperty('token_exchange')]
    private ?ClientTokenExchangeConfiguration $tokenExchange;

    /**
     * @var ?int $parRequestExpiry Specifies how long, in seconds, a Pushed Authorization Request URI remains valid
     */
    #[JsonProperty('par_request_expiry')]
    private ?int $parRequestExpiry;

    /**
     * @var ?CreateTokenQuota $tokenQuota
     */
    #[JsonProperty('token_quota')]
    private ?CreateTokenQuota $tokenQuota;

    /**
     * @var ?string $resourceServerIdentifier The identifier of the resource server that this client is linked to.
     */
    #[JsonProperty('resource_server_identifier')]
    private ?string $resourceServerIdentifier;

    /**
     * @var ?ExpressConfiguration $expressConfiguration
     */
    #[JsonProperty('express_configuration')]
    private ?ExpressConfiguration $expressConfiguration;

    /**
     * @var ?array<value-of<AsyncApprovalNotificationsChannelsEnum>> $asyncApprovalNotificationChannels
     */
    #[JsonProperty('async_approval_notification_channels'), ArrayType(['string'])]
    private ?array $asyncApprovalNotificationChannels;

    /**
     * @param array{
     *   name: string,
     *   description?: ?string,
     *   logoUri?: ?string,
     *   callbacks?: ?array<string>,
     *   oidcLogout?: ?ClientOidcBackchannelLogoutSettings,
     *   oidcBackchannelLogout?: ?ClientOidcBackchannelLogoutSettings,
     *   sessionTransfer?: ?ClientSessionTransferConfiguration,
     *   allowedOrigins?: ?array<string>,
     *   webOrigins?: ?array<string>,
     *   clientAliases?: ?array<string>,
     *   allowedClients?: ?array<string>,
     *   allowedLogoutUrls?: ?array<string>,
     *   grantTypes?: ?array<string>,
     *   tokenEndpointAuthMethod?: ?value-of<ClientTokenEndpointAuthMethodEnum>,
     *   isTokenEndpointIpHeaderTrusted?: ?bool,
     *   appType?: ?value-of<ClientAppTypeEnum>,
     *   isFirstParty?: ?bool,
     *   oidcConformant?: ?bool,
     *   jwtConfiguration?: ?ClientJwtConfiguration,
     *   encryptionKey?: ?ClientEncryptionKey,
     *   sso?: ?bool,
     *   crossOriginAuthentication?: ?bool,
     *   crossOriginLoc?: ?string,
     *   ssoDisabled?: ?bool,
     *   customLoginPageOn?: ?bool,
     *   customLoginPage?: ?string,
     *   customLoginPagePreview?: ?string,
     *   formTemplate?: ?string,
     *   addons?: ?ClientAddons,
     *   clientMetadata?: ?array<string, mixed>,
     *   mobile?: ?ClientMobile,
     *   initiateLoginUri?: ?string,
     *   nativeSocialLogin?: ?NativeSocialLogin,
     *   refreshToken?: ?ClientRefreshTokenConfiguration,
     *   defaultOrganization?: ?ClientDefaultOrganization,
     *   organizationUsage?: ?value-of<ClientOrganizationUsageEnum>,
     *   organizationRequireBehavior?: ?value-of<ClientOrganizationRequireBehaviorEnum>,
     *   organizationDiscoveryMethods?: ?array<value-of<ClientOrganizationDiscoveryEnum>>,
     *   clientAuthenticationMethods?: ?ClientCreateAuthenticationMethod,
     *   requirePushedAuthorizationRequests?: ?bool,
     *   requireProofOfPossession?: ?bool,
     *   signedRequestObject?: ?ClientSignedRequestObjectWithPublicKey,
     *   complianceLevel?: ?value-of<ClientComplianceLevelEnum>,
     *   skipNonVerifiableCallbackUriConfirmationPrompt?: ?bool,
     *   tokenExchange?: ?ClientTokenExchangeConfiguration,
     *   parRequestExpiry?: ?int,
     *   tokenQuota?: ?CreateTokenQuota,
     *   resourceServerIdentifier?: ?string,
     *   expressConfiguration?: ?ExpressConfiguration,
     *   asyncApprovalNotificationChannels?: ?array<value-of<AsyncApprovalNotificationsChannelsEnum>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->logoUri = $values['logoUri'] ?? null;
        $this->callbacks = $values['callbacks'] ?? null;
        $this->oidcLogout = $values['oidcLogout'] ?? null;
        $this->oidcBackchannelLogout = $values['oidcBackchannelLogout'] ?? null;
        $this->sessionTransfer = $values['sessionTransfer'] ?? null;
        $this->allowedOrigins = $values['allowedOrigins'] ?? null;
        $this->webOrigins = $values['webOrigins'] ?? null;
        $this->clientAliases = $values['clientAliases'] ?? null;
        $this->allowedClients = $values['allowedClients'] ?? null;
        $this->allowedLogoutUrls = $values['allowedLogoutUrls'] ?? null;
        $this->grantTypes = $values['grantTypes'] ?? null;
        $this->tokenEndpointAuthMethod = $values['tokenEndpointAuthMethod'] ?? null;
        $this->isTokenEndpointIpHeaderTrusted = $values['isTokenEndpointIpHeaderTrusted'] ?? null;
        $this->appType = $values['appType'] ?? null;
        $this->isFirstParty = $values['isFirstParty'] ?? null;
        $this->oidcConformant = $values['oidcConformant'] ?? null;
        $this->jwtConfiguration = $values['jwtConfiguration'] ?? null;
        $this->encryptionKey = $values['encryptionKey'] ?? null;
        $this->sso = $values['sso'] ?? null;
        $this->crossOriginAuthentication = $values['crossOriginAuthentication'] ?? null;
        $this->crossOriginLoc = $values['crossOriginLoc'] ?? null;
        $this->ssoDisabled = $values['ssoDisabled'] ?? null;
        $this->customLoginPageOn = $values['customLoginPageOn'] ?? null;
        $this->customLoginPage = $values['customLoginPage'] ?? null;
        $this->customLoginPagePreview = $values['customLoginPagePreview'] ?? null;
        $this->formTemplate = $values['formTemplate'] ?? null;
        $this->addons = $values['addons'] ?? null;
        $this->clientMetadata = $values['clientMetadata'] ?? null;
        $this->mobile = $values['mobile'] ?? null;
        $this->initiateLoginUri = $values['initiateLoginUri'] ?? null;
        $this->nativeSocialLogin = $values['nativeSocialLogin'] ?? null;
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
        $this->tokenQuota = $values['tokenQuota'] ?? null;
        $this->resourceServerIdentifier = $values['resourceServerIdentifier'] ?? null;
        $this->expressConfiguration = $values['expressConfiguration'] ?? null;
        $this->asyncApprovalNotificationChannels = $values['asyncApprovalNotificationChannels'] ?? null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
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
     * @return ?value-of<ClientTokenEndpointAuthMethodEnum>
     */
    public function getTokenEndpointAuthMethod(): ?string
    {
        return $this->tokenEndpointAuthMethod;
    }

    /**
     * @param ?value-of<ClientTokenEndpointAuthMethodEnum> $value
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
     * @return ?value-of<ClientOrganizationUsageEnum>
     */
    public function getOrganizationUsage(): ?string
    {
        return $this->organizationUsage;
    }

    /**
     * @param ?value-of<ClientOrganizationUsageEnum> $value
     */
    public function setOrganizationUsage(?string $value = null): self
    {
        $this->organizationUsage = $value;
        $this->_setField('organizationUsage');
        return $this;
    }

    /**
     * @return ?value-of<ClientOrganizationRequireBehaviorEnum>
     */
    public function getOrganizationRequireBehavior(): ?string
    {
        return $this->organizationRequireBehavior;
    }

    /**
     * @param ?value-of<ClientOrganizationRequireBehaviorEnum> $value
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
     * @return ?ClientCreateAuthenticationMethod
     */
    public function getClientAuthenticationMethods(): ?ClientCreateAuthenticationMethod
    {
        return $this->clientAuthenticationMethods;
    }

    /**
     * @param ?ClientCreateAuthenticationMethod $value
     */
    public function setClientAuthenticationMethods(?ClientCreateAuthenticationMethod $value = null): self
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
     * @return ?ClientSignedRequestObjectWithPublicKey
     */
    public function getSignedRequestObject(): ?ClientSignedRequestObjectWithPublicKey
    {
        return $this->signedRequestObject;
    }

    /**
     * @param ?ClientSignedRequestObjectWithPublicKey $value
     */
    public function setSignedRequestObject(?ClientSignedRequestObjectWithPublicKey $value = null): self
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
     * @return ?ClientTokenExchangeConfiguration
     */
    public function getTokenExchange(): ?ClientTokenExchangeConfiguration
    {
        return $this->tokenExchange;
    }

    /**
     * @param ?ClientTokenExchangeConfiguration $value
     */
    public function setTokenExchange(?ClientTokenExchangeConfiguration $value = null): self
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
     * @return ?CreateTokenQuota
     */
    public function getTokenQuota(): ?CreateTokenQuota
    {
        return $this->tokenQuota;
    }

    /**
     * @param ?CreateTokenQuota $value
     */
    public function setTokenQuota(?CreateTokenQuota $value = null): self
    {
        $this->tokenQuota = $value;
        $this->_setField('tokenQuota');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getResourceServerIdentifier(): ?string
    {
        return $this->resourceServerIdentifier;
    }

    /**
     * @param ?string $value
     */
    public function setResourceServerIdentifier(?string $value = null): self
    {
        $this->resourceServerIdentifier = $value;
        $this->_setField('resourceServerIdentifier');
        return $this;
    }

    /**
     * @return ?ExpressConfiguration
     */
    public function getExpressConfiguration(): ?ExpressConfiguration
    {
        return $this->expressConfiguration;
    }

    /**
     * @param ?ExpressConfiguration $value
     */
    public function setExpressConfiguration(?ExpressConfiguration $value = null): self
    {
        $this->expressConfiguration = $value;
        $this->_setField('expressConfiguration');
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
}
