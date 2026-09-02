<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Options for the 'okta' connection
 */
class EventStreamCloudEventConnectionDeletedPreviousObject1Options extends JsonSerializableType
{
    /**
     * @var ?string $authorizationEndpoint URL of the identity provider's OAuth 2.0 authorization endpoint where users are redirected for authentication. Must be a valid HTTPS URL. This endpoint initiates the OAuth 2.0 authorization code flow.
     */
    #[JsonProperty('authorization_endpoint')]
    private ?string $authorizationEndpoint;

    /**
     * @var string $clientId OAuth 2.0 client identifier issued by the identity provider during application registration. This value identifies your Auth0 connection to the identity provider.
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsConnectionSettings $connectionSettings
     */
    #[JsonProperty('connection_settings')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsConnectionSettings $connectionSettings;

    /**
     * @var ?array<string> $domainAliases Email domains associated with this connection for Home Realm Discovery (HRD). When a user's email matches one of these domains, they are automatically routed to this connection during authentication.
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsDpopSigningAlgEnum> $dpopSigningAlg
     */
    #[JsonProperty('dpop_signing_alg')]
    private ?string $dpopSigningAlg;

    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens
     */
    #[JsonProperty('federated_connections_access_tokens')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens;

    /**
     * @var ?string $iconUrl https url of the icon to be shown
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?bool $idTokenSessionExpirySupported Indicates whether the identity provider supports session expiry via the id_token. If true, the system will use the session_expiry claim in the id_token to determine session expiry.
     */
    #[JsonProperty('id_token_session_expiry_supported')]
    private ?bool $idTokenSessionExpirySupported;

    /**
     * @var ?array<value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsIdTokenSignedResponseAlgsItemEnum>> $idTokenSignedResponseAlgs List of algorithms allowed to verify the ID tokens. Applicable when strategy=oidc or okta.
     */
    #[JsonProperty('id_token_signed_response_algs'), ArrayType(['string'])]
    private ?array $idTokenSignedResponseAlgs;

    /**
     * @var ?string $issuer The identity provider's unique issuer identifier URL (e.g., https://accounts.google.com). Must match the 'iss' claim in ID tokens from the identity provider.
     */
    #[JsonProperty('issuer')]
    private ?string $issuer;

    /**
     * @var ?string $jwksUri URL of the identity provider's JSON Web Key Set (JWKS) endpoint containing public keys for signature verification. Auth0 retrieves these keys to validate ID token signatures.
     */
    #[JsonProperty('jwks_uri')]
    private ?string $jwksUri;

    /**
     * @var ?array<string> $nonPersistentAttrs An array of user fields that should not be stored in the Auth0 database (https://auth0.com/docs/security/data-security/denylist)
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsOidcMetadata $oidcMetadata
     */
    #[JsonProperty('oidc_metadata')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsOidcMetadata $oidcMetadata;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsSchemaVersionEnum> $schemaVersion
     */
    #[JsonProperty('schema_version')]
    private ?string $schemaVersion;

    /**
     * @var ?string $scope Space-separated list of OAuth 2.0 scopes requested during authorization. Must include 'openid' (required by OIDC spec). Common values: 'openid profile email'. Additional scopes depend on the identity provider.
     */
    #[JsonProperty('scope')]
    private ?string $scope;

    /**
     * @var ?bool $sendBackChannelNonce When true and type is 'back_channel', includes a cryptographic nonce in authorization requests to prevent replay attacks. The identity provider must include this nonce in the ID token for validation.
     */
    #[JsonProperty('send_back_channel_nonce')]
    private ?bool $sendBackChannelNonce;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?string $tenantDomain Tenant domain
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?string $tokenEndpoint URL of the identity provider's OAuth 2.0 token endpoint where authorization codes are exchanged for access tokens. Must be a valid HTTPS URL. Required for authorization code flow but optional for implicit flow.
     */
    #[JsonProperty('token_endpoint')]
    private ?string $tokenEndpoint;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointAuthMethodEnum> $tokenEndpointAuthMethod
     */
    #[JsonProperty('token_endpoint_auth_method')]
    private ?string $tokenEndpointAuthMethod;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointAuthSigningAlgEnum> $tokenEndpointAuthSigningAlg
     */
    #[JsonProperty('token_endpoint_auth_signing_alg')]
    private ?string $tokenEndpointAuthSigningAlg;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointJwtcaAudFormatEnum> $tokenEndpointJwtcaAudFormat
     */
    #[JsonProperty('token_endpoint_jwtca_aud_format')]
    private ?string $tokenEndpointJwtcaAudFormat;

    /**
     * @var ?array<string, mixed> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => 'mixed'])]
    private ?array $upstreamParams;

    /**
     * @var ?bool $useOauthSpecScope When true, uses space-delimited scopes (per OAuth 2.0 spec) instead of comma-delimited when calling the identity provider's authorization endpoint. Only relevant when using the connection_scope parameter. See https://auth0.com/docs/authenticate/identity-providers/adding-scopes-for-an-external-idp#pass-scopes-to-authorize-endpoint
     */
    #[JsonProperty('useOauthSpecScope')]
    private ?bool $useOauthSpecScope;

    /**
     * @var ?string $userinfoEndpoint Optional URL of the identity provider's UserInfo endpoint. When configured with attribute mapping, Auth0 calls this endpoint to retrieve additional user profile claims using the access token.
     */
    #[JsonProperty('userinfo_endpoint')]
    private ?string $userinfoEndpoint;

    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsAttributeMap $attributeMap
     */
    #[JsonProperty('attribute_map')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsAttributeMap $attributeMap;

    /**
     * @var ?string $domain Domain of the Okta organization (e.g., dev-123456.okta.com). Should be just the domain of the okta server with no scheme or trailing backslash. Discovery runs only when connection.options.oidc_metadata is empty and a domain is provided
     */
    #[JsonProperty('domain')]
    private ?string $domain;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTypeEnum> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @param array{
     *   clientId: string,
     *   authorizationEndpoint?: ?string,
     *   connectionSettings?: ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsConnectionSettings,
     *   domainAliases?: ?array<string>,
     *   dpopSigningAlg?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsDpopSigningAlgEnum>,
     *   federatedConnectionsAccessTokens?: ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsFederatedConnectionsAccessTokens,
     *   iconUrl?: ?string,
     *   idTokenSessionExpirySupported?: ?bool,
     *   idTokenSignedResponseAlgs?: ?array<value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsIdTokenSignedResponseAlgsItemEnum>>,
     *   issuer?: ?string,
     *   jwksUri?: ?string,
     *   nonPersistentAttrs?: ?array<string>,
     *   oidcMetadata?: ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsOidcMetadata,
     *   schemaVersion?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsSchemaVersionEnum>,
     *   scope?: ?string,
     *   sendBackChannelNonce?: ?bool,
     *   setUserRootAttributes?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsSetUserRootAttributesEnum>,
     *   tenantDomain?: ?string,
     *   tokenEndpoint?: ?string,
     *   tokenEndpointAuthMethod?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointAuthMethodEnum>,
     *   tokenEndpointAuthSigningAlg?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointAuthSigningAlgEnum>,
     *   tokenEndpointJwtcaAudFormat?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointJwtcaAudFormatEnum>,
     *   upstreamParams?: ?array<string, mixed>,
     *   useOauthSpecScope?: ?bool,
     *   userinfoEndpoint?: ?string,
     *   attributeMap?: ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsAttributeMap,
     *   domain?: ?string,
     *   type?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTypeEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->authorizationEndpoint = $values['authorizationEndpoint'] ?? null;
        $this->clientId = $values['clientId'];
        $this->connectionSettings = $values['connectionSettings'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->dpopSigningAlg = $values['dpopSigningAlg'] ?? null;
        $this->federatedConnectionsAccessTokens = $values['federatedConnectionsAccessTokens'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->idTokenSessionExpirySupported = $values['idTokenSessionExpirySupported'] ?? null;
        $this->idTokenSignedResponseAlgs = $values['idTokenSignedResponseAlgs'] ?? null;
        $this->issuer = $values['issuer'] ?? null;
        $this->jwksUri = $values['jwksUri'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->oidcMetadata = $values['oidcMetadata'] ?? null;
        $this->schemaVersion = $values['schemaVersion'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->sendBackChannelNonce = $values['sendBackChannelNonce'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->tokenEndpoint = $values['tokenEndpoint'] ?? null;
        $this->tokenEndpointAuthMethod = $values['tokenEndpointAuthMethod'] ?? null;
        $this->tokenEndpointAuthSigningAlg = $values['tokenEndpointAuthSigningAlg'] ?? null;
        $this->tokenEndpointJwtcaAudFormat = $values['tokenEndpointJwtcaAudFormat'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->useOauthSpecScope = $values['useOauthSpecScope'] ?? null;
        $this->userinfoEndpoint = $values['userinfoEndpoint'] ?? null;
        $this->attributeMap = $values['attributeMap'] ?? null;
        $this->domain = $values['domain'] ?? null;
        $this->type = $values['type'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAuthorizationEndpoint(): ?string
    {
        return $this->authorizationEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setAuthorizationEndpoint(?string $value = null): self
    {
        $this->authorizationEndpoint = $value;
        $this->_setField('authorizationEndpoint');
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
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsConnectionSettings
     */
    public function getConnectionSettings(): ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsConnectionSettings
    {
        return $this->connectionSettings;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsConnectionSettings $value
     */
    public function setConnectionSettings(?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsConnectionSettings $value = null): self
    {
        $this->connectionSettings = $value;
        $this->_setField('connectionSettings');
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
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsDpopSigningAlgEnum>
     */
    public function getDpopSigningAlg(): ?string
    {
        return $this->dpopSigningAlg;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsDpopSigningAlgEnum> $value
     */
    public function setDpopSigningAlg(?string $value = null): self
    {
        $this->dpopSigningAlg = $value;
        $this->_setField('dpopSigningAlg');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsFederatedConnectionsAccessTokens
     */
    public function getFederatedConnectionsAccessTokens(): ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsFederatedConnectionsAccessTokens
    {
        return $this->federatedConnectionsAccessTokens;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsFederatedConnectionsAccessTokens $value
     */
    public function setFederatedConnectionsAccessTokens(?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsFederatedConnectionsAccessTokens $value = null): self
    {
        $this->federatedConnectionsAccessTokens = $value;
        $this->_setField('federatedConnectionsAccessTokens');
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
    public function getIdTokenSessionExpirySupported(): ?bool
    {
        return $this->idTokenSessionExpirySupported;
    }

    /**
     * @param ?bool $value
     */
    public function setIdTokenSessionExpirySupported(?bool $value = null): self
    {
        $this->idTokenSessionExpirySupported = $value;
        $this->_setField('idTokenSessionExpirySupported');
        return $this;
    }

    /**
     * @return ?array<value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsIdTokenSignedResponseAlgsItemEnum>>
     */
    public function getIdTokenSignedResponseAlgs(): ?array
    {
        return $this->idTokenSignedResponseAlgs;
    }

    /**
     * @param ?array<value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsIdTokenSignedResponseAlgsItemEnum>> $value
     */
    public function setIdTokenSignedResponseAlgs(?array $value = null): self
    {
        $this->idTokenSignedResponseAlgs = $value;
        $this->_setField('idTokenSignedResponseAlgs');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIssuer(): ?string
    {
        return $this->issuer;
    }

    /**
     * @param ?string $value
     */
    public function setIssuer(?string $value = null): self
    {
        $this->issuer = $value;
        $this->_setField('issuer');
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
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsOidcMetadata
     */
    public function getOidcMetadata(): ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsOidcMetadata
    {
        return $this->oidcMetadata;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsOidcMetadata $value
     */
    public function setOidcMetadata(?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsOidcMetadata $value = null): self
    {
        $this->oidcMetadata = $value;
        $this->_setField('oidcMetadata');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsSchemaVersionEnum>
     */
    public function getSchemaVersion(): ?string
    {
        return $this->schemaVersion;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsSchemaVersionEnum> $value
     */
    public function setSchemaVersion(?string $value = null): self
    {
        $this->schemaVersion = $value;
        $this->_setField('schemaVersion');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param ?string $value
     */
    public function setScope(?string $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSendBackChannelNonce(): ?bool
    {
        return $this->sendBackChannelNonce;
    }

    /**
     * @param ?bool $value
     */
    public function setSendBackChannelNonce(?bool $value = null): self
    {
        $this->sendBackChannelNonce = $value;
        $this->_setField('sendBackChannelNonce');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsSetUserRootAttributesEnum> $value
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
     * @return ?string
     */
    public function getTokenEndpoint(): ?string
    {
        return $this->tokenEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setTokenEndpoint(?string $value = null): self
    {
        $this->tokenEndpoint = $value;
        $this->_setField('tokenEndpoint');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointAuthMethodEnum>
     */
    public function getTokenEndpointAuthMethod(): ?string
    {
        return $this->tokenEndpointAuthMethod;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointAuthMethodEnum> $value
     */
    public function setTokenEndpointAuthMethod(?string $value = null): self
    {
        $this->tokenEndpointAuthMethod = $value;
        $this->_setField('tokenEndpointAuthMethod');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointAuthSigningAlgEnum>
     */
    public function getTokenEndpointAuthSigningAlg(): ?string
    {
        return $this->tokenEndpointAuthSigningAlg;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointAuthSigningAlgEnum> $value
     */
    public function setTokenEndpointAuthSigningAlg(?string $value = null): self
    {
        $this->tokenEndpointAuthSigningAlg = $value;
        $this->_setField('tokenEndpointAuthSigningAlg');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointJwtcaAudFormatEnum>
     */
    public function getTokenEndpointJwtcaAudFormat(): ?string
    {
        return $this->tokenEndpointJwtcaAudFormat;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTokenEndpointJwtcaAudFormatEnum> $value
     */
    public function setTokenEndpointJwtcaAudFormat(?string $value = null): self
    {
        $this->tokenEndpointJwtcaAudFormat = $value;
        $this->_setField('tokenEndpointJwtcaAudFormat');
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
    public function getUseOauthSpecScope(): ?bool
    {
        return $this->useOauthSpecScope;
    }

    /**
     * @param ?bool $value
     */
    public function setUseOauthSpecScope(?bool $value = null): self
    {
        $this->useOauthSpecScope = $value;
        $this->_setField('useOauthSpecScope');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserinfoEndpoint(): ?string
    {
        return $this->userinfoEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setUserinfoEndpoint(?string $value = null): self
    {
        $this->userinfoEndpoint = $value;
        $this->_setField('userinfoEndpoint');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsAttributeMap
     */
    public function getAttributeMap(): ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsAttributeMap
    {
        return $this->attributeMap;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsAttributeMap $value
     */
    public function setAttributeMap(?EventStreamCloudEventConnectionDeletedPreviousObject1OptionsAttributeMap $value = null): self
    {
        $this->attributeMap = $value;
        $this->_setField('attributeMap');
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
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject1OptionsTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
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
