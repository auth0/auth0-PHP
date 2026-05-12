<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateClientResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $clientId ID of this client.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $tenant Name of the tenant this client belongs to.
     */
    #[JsonProperty('tenant')]
    private ?string $tenant;

    /**
     * @var ?string $name Name of this client (min length: 1 character, does not allow `<` or `>`).
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $description Free text description of this client (max length: 140 characters).
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?bool $global Whether this is your global 'All Applications' client representing legacy tenant settings (true) or a regular client (false).
     */
    #[JsonProperty('global')]
    private ?bool $global;

    /**
     * @var ?string $clientSecret Client secret (which you must not make public).
     */
    #[JsonProperty('client_secret')]
    private ?string $clientSecret;

    /**
     * @var ?value-of<ClientAppTypeEnum> $appType
     */
    #[JsonProperty('app_type')]
    private ?string $appType;

    /**
     * @var ?string $logoUri URL of the logo to display for this client. Recommended size is 150x150 pixels.
     */
    #[JsonProperty('logo_uri')]
    private ?string $logoUri;

    /**
     * @var ?bool $isFirstParty Whether this client a first party client (true) or not (false).
     */
    #[JsonProperty('is_first_party')]
    private ?bool $isFirstParty;

    /**
     * @var ?bool $oidcConformant Whether this client conforms to <a href='https://auth0.com/docs/api-auth/tutorials/adoption'>strict OIDC specifications</a> (true) or uses legacy features (false).
     */
    #[JsonProperty('oidc_conformant')]
    private ?bool $oidcConformant;

    /**
     * @var ?array<string> $callbacks Comma-separated list of URLs whitelisted for Auth0 to use as a callback to the client after authentication.
     */
    #[JsonProperty('callbacks'), ArrayType(['string'])]
    private ?array $callbacks;

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
     * @var ?ClientSessionTransferConfiguration $sessionTransfer
     */
    #[JsonProperty('session_transfer')]
    private ?ClientSessionTransferConfiguration $sessionTransfer;

    /**
     * @var ?ClientOidcBackchannelLogoutSettings $oidcLogout
     */
    #[JsonProperty('oidc_logout')]
    private ?ClientOidcBackchannelLogoutSettings $oidcLogout;

    /**
     * @var ?array<string> $grantTypes List of grant types supported for this application. Can include `authorization_code`, `implicit`, `refresh_token`, `client_credentials`, `password`, `http://auth0.com/oauth/grant-type/password-realm`, `http://auth0.com/oauth/grant-type/mfa-oob`, `http://auth0.com/oauth/grant-type/mfa-otp`, `http://auth0.com/oauth/grant-type/mfa-recovery-code`, `urn:openid:params:grant-type:ciba`, `urn:ietf:params:oauth:grant-type:device_code`, and `urn:auth0:params:oauth:grant-type:token-exchange:federated-connection-access-token`.
     */
    #[JsonProperty('grant_types'), ArrayType(['string'])]
    private ?array $grantTypes;

    /**
     * @var ?ClientJwtConfiguration $jwtConfiguration
     */
    #[JsonProperty('jwt_configuration')]
    private ?ClientJwtConfiguration $jwtConfiguration;

    /**
     * @var ?array<ClientSigningKey> $signingKeys
     */
    #[JsonProperty('signing_keys'), ArrayType([ClientSigningKey::class])]
    private ?array $signingKeys;

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
     * @var ?bool $ssoDisabled Whether Single Sign On is disabled (true) or enabled (true). Defaults to true.
     */
    #[JsonProperty('sso_disabled')]
    private ?bool $ssoDisabled;

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
     * @var ?bool $customLoginPageOn Whether a custom login page is to be used (true) or the default provided login page (false).
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
     * @var ?TokenQuota $tokenQuota
     */
    #[JsonProperty('token_quota')]
    private ?TokenQuota $tokenQuota;

    /**
     * @var ?ExpressConfiguration $expressConfiguration
     */
    #[JsonProperty('express_configuration')]
    private ?ExpressConfiguration $expressConfiguration;

    /**
     * @var ?ClientMyOrganizationResponseConfiguration $myOrganizationConfiguration
     */
    #[JsonProperty('my_organization_configuration')]
    private ?ClientMyOrganizationResponseConfiguration $myOrganizationConfiguration;

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
     * @var ?string $resourceServerIdentifier The identifier of the resource server that this client is linked to.
     */
    #[JsonProperty('resource_server_identifier')]
    private ?string $resourceServerIdentifier;

    /**
     * @var ?array<value-of<AsyncApprovalNotificationsChannelsEnum>> $asyncApprovalNotificationChannels
     */
    #[JsonProperty('async_approval_notification_channels'), ArrayType(['string'])]
    private ?array $asyncApprovalNotificationChannels;

    /**
     * @var ?value-of<ClientExternalMetadataTypeEnum> $externalMetadataType
     */
    #[JsonProperty('external_metadata_type')]
    private ?string $externalMetadataType;

    /**
     * @var ?value-of<ClientExternalMetadataCreatedByEnum> $externalMetadataCreatedBy
     */
    #[JsonProperty('external_metadata_created_by')]
    private ?string $externalMetadataCreatedBy;

    /**
     * @var ?string $externalClientId An alternate client identifier to be used during authorization flows. Only supports CIMD-based client identifiers.
     */
    #[JsonProperty('external_client_id')]
    private ?string $externalClientId;

    /**
     * @var ?string $jwksUri URL for the JSON Web Key Set (JWKS) containing the public keys used for private_key_jwt authentication. Only present for CIMD clients using private_key_jwt authentication.
     */
    #[JsonProperty('jwks_uri')]
    private ?string $jwksUri;

    /**
     * @param array{
     *   clientId?: ?string,
     *   tenant?: ?string,
     *   name?: ?string,
     *   description?: ?string,
     *   global?: ?bool,
     *   clientSecret?: ?string,
     *   appType?: ?value-of<ClientAppTypeEnum>,
     *   logoUri?: ?string,
     *   isFirstParty?: ?bool,
     *   oidcConformant?: ?bool,
     *   callbacks?: ?array<string>,
     *   allowedOrigins?: ?array<string>,
     *   webOrigins?: ?array<string>,
     *   clientAliases?: ?array<string>,
     *   allowedClients?: ?array<string>,
     *   allowedLogoutUrls?: ?array<string>,
     *   sessionTransfer?: ?ClientSessionTransferConfiguration,
     *   oidcLogout?: ?ClientOidcBackchannelLogoutSettings,
     *   grantTypes?: ?array<string>,
     *   jwtConfiguration?: ?ClientJwtConfiguration,
     *   signingKeys?: ?array<ClientSigningKey>,
     *   encryptionKey?: ?ClientEncryptionKey,
     *   sso?: ?bool,
     *   ssoDisabled?: ?bool,
     *   crossOriginAuthentication?: ?bool,
     *   crossOriginLoc?: ?string,
     *   customLoginPageOn?: ?bool,
     *   customLoginPage?: ?string,
     *   customLoginPagePreview?: ?string,
     *   formTemplate?: ?string,
     *   addons?: ?ClientAddons,
     *   tokenEndpointAuthMethod?: ?value-of<ClientTokenEndpointAuthMethodEnum>,
     *   isTokenEndpointIpHeaderTrusted?: ?bool,
     *   clientMetadata?: ?array<string, mixed>,
     *   mobile?: ?ClientMobile,
     *   initiateLoginUri?: ?string,
     *   refreshToken?: ?ClientRefreshTokenConfiguration,
     *   defaultOrganization?: ?ClientDefaultOrganization,
     *   organizationUsage?: ?value-of<ClientOrganizationUsageEnum>,
     *   organizationRequireBehavior?: ?value-of<ClientOrganizationRequireBehaviorEnum>,
     *   organizationDiscoveryMethods?: ?array<value-of<ClientOrganizationDiscoveryEnum>>,
     *   clientAuthenticationMethods?: ?ClientAuthenticationMethod,
     *   requirePushedAuthorizationRequests?: ?bool,
     *   requireProofOfPossession?: ?bool,
     *   signedRequestObject?: ?ClientSignedRequestObjectWithCredentialId,
     *   complianceLevel?: ?value-of<ClientComplianceLevelEnum>,
     *   skipNonVerifiableCallbackUriConfirmationPrompt?: ?bool,
     *   tokenExchange?: ?ClientTokenExchangeConfiguration,
     *   parRequestExpiry?: ?int,
     *   tokenQuota?: ?TokenQuota,
     *   expressConfiguration?: ?ExpressConfiguration,
     *   myOrganizationConfiguration?: ?ClientMyOrganizationResponseConfiguration,
     *   thirdPartySecurityMode?: ?value-of<ClientThirdPartySecurityModeEnum>,
     *   redirectionPolicy?: ?value-of<ClientRedirectionPolicyEnum>,
     *   resourceServerIdentifier?: ?string,
     *   asyncApprovalNotificationChannels?: ?array<value-of<AsyncApprovalNotificationsChannelsEnum>>,
     *   externalMetadataType?: ?value-of<ClientExternalMetadataTypeEnum>,
     *   externalMetadataCreatedBy?: ?value-of<ClientExternalMetadataCreatedByEnum>,
     *   externalClientId?: ?string,
     *   jwksUri?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clientId = $values['clientId'] ?? null;
        $this->tenant = $values['tenant'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->global = $values['global'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->appType = $values['appType'] ?? null;
        $this->logoUri = $values['logoUri'] ?? null;
        $this->isFirstParty = $values['isFirstParty'] ?? null;
        $this->oidcConformant = $values['oidcConformant'] ?? null;
        $this->callbacks = $values['callbacks'] ?? null;
        $this->allowedOrigins = $values['allowedOrigins'] ?? null;
        $this->webOrigins = $values['webOrigins'] ?? null;
        $this->clientAliases = $values['clientAliases'] ?? null;
        $this->allowedClients = $values['allowedClients'] ?? null;
        $this->allowedLogoutUrls = $values['allowedLogoutUrls'] ?? null;
        $this->sessionTransfer = $values['sessionTransfer'] ?? null;
        $this->oidcLogout = $values['oidcLogout'] ?? null;
        $this->grantTypes = $values['grantTypes'] ?? null;
        $this->jwtConfiguration = $values['jwtConfiguration'] ?? null;
        $this->signingKeys = $values['signingKeys'] ?? null;
        $this->encryptionKey = $values['encryptionKey'] ?? null;
        $this->sso = $values['sso'] ?? null;
        $this->ssoDisabled = $values['ssoDisabled'] ?? null;
        $this->crossOriginAuthentication = $values['crossOriginAuthentication'] ?? null;
        $this->crossOriginLoc = $values['crossOriginLoc'] ?? null;
        $this->customLoginPageOn = $values['customLoginPageOn'] ?? null;
        $this->customLoginPage = $values['customLoginPage'] ?? null;
        $this->customLoginPagePreview = $values['customLoginPagePreview'] ?? null;
        $this->formTemplate = $values['formTemplate'] ?? null;
        $this->addons = $values['addons'] ?? null;
        $this->tokenEndpointAuthMethod = $values['tokenEndpointAuthMethod'] ?? null;
        $this->isTokenEndpointIpHeaderTrusted = $values['isTokenEndpointIpHeaderTrusted'] ?? null;
        $this->clientMetadata = $values['clientMetadata'] ?? null;
        $this->mobile = $values['mobile'] ?? null;
        $this->initiateLoginUri = $values['initiateLoginUri'] ?? null;
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
        $this->expressConfiguration = $values['expressConfiguration'] ?? null;
        $this->myOrganizationConfiguration = $values['myOrganizationConfiguration'] ?? null;
        $this->thirdPartySecurityMode = $values['thirdPartySecurityMode'] ?? null;
        $this->redirectionPolicy = $values['redirectionPolicy'] ?? null;
        $this->resourceServerIdentifier = $values['resourceServerIdentifier'] ?? null;
        $this->asyncApprovalNotificationChannels = $values['asyncApprovalNotificationChannels'] ?? null;
        $this->externalMetadataType = $values['externalMetadataType'] ?? null;
        $this->externalMetadataCreatedBy = $values['externalMetadataCreatedBy'] ?? null;
        $this->externalClientId = $values['externalClientId'] ?? null;
        $this->jwksUri = $values['jwksUri'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    /**
     * @param ?string $value
     */
    public function setTenant(?string $value = null): self
    {
        $this->tenant = $value;
        $this->_setField('tenant');
        return $this;
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
     * @return ?bool
     */
    public function getGlobal(): ?bool
    {
        return $this->global;
    }

    /**
     * @param ?bool $value
     */
    public function setGlobal(?bool $value = null): self
    {
        $this->global = $value;
        $this->_setField('global');
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
     * @return ?array<ClientSigningKey>
     */
    public function getSigningKeys(): ?array
    {
        return $this->signingKeys;
    }

    /**
     * @param ?array<ClientSigningKey> $value
     */
    public function setSigningKeys(?array $value = null): self
    {
        $this->signingKeys = $value;
        $this->_setField('signingKeys');
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
     * @return ?TokenQuota
     */
    public function getTokenQuota(): ?TokenQuota
    {
        return $this->tokenQuota;
    }

    /**
     * @param ?TokenQuota $value
     */
    public function setTokenQuota(?TokenQuota $value = null): self
    {
        $this->tokenQuota = $value;
        $this->_setField('tokenQuota');
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
     * @return ?ClientMyOrganizationResponseConfiguration
     */
    public function getMyOrganizationConfiguration(): ?ClientMyOrganizationResponseConfiguration
    {
        return $this->myOrganizationConfiguration;
    }

    /**
     * @param ?ClientMyOrganizationResponseConfiguration $value
     */
    public function setMyOrganizationConfiguration(?ClientMyOrganizationResponseConfiguration $value = null): self
    {
        $this->myOrganizationConfiguration = $value;
        $this->_setField('myOrganizationConfiguration');
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
     * @return ?value-of<ClientExternalMetadataTypeEnum>
     */
    public function getExternalMetadataType(): ?string
    {
        return $this->externalMetadataType;
    }

    /**
     * @param ?value-of<ClientExternalMetadataTypeEnum> $value
     */
    public function setExternalMetadataType(?string $value = null): self
    {
        $this->externalMetadataType = $value;
        $this->_setField('externalMetadataType');
        return $this;
    }

    /**
     * @return ?value-of<ClientExternalMetadataCreatedByEnum>
     */
    public function getExternalMetadataCreatedBy(): ?string
    {
        return $this->externalMetadataCreatedBy;
    }

    /**
     * @param ?value-of<ClientExternalMetadataCreatedByEnum> $value
     */
    public function setExternalMetadataCreatedBy(?string $value = null): self
    {
        $this->externalMetadataCreatedBy = $value;
        $this->_setField('externalMetadataCreatedBy');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExternalClientId(): ?string
    {
        return $this->externalClientId;
    }

    /**
     * @param ?string $value
     */
    public function setExternalClientId(?string $value = null): self
    {
        $this->externalClientId = $value;
        $this->_setField('externalClientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getJwksUri(): ?string
    {
        return $this->jwksUri;
    }

    /**
     * @param ?string $value
     */
    public function setJwksUri(?string $value = null): self
    {
        $this->jwksUri = $value;
        $this->_setField('jwksUri');
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
