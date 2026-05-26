<?php

namespace Auth0\SDK\API\Management\Traits;

use Auth0\SDK\API\Management\Types\ConnectionConnectionSettings;
use Auth0\SDK\API\Management\Types\ConnectionDpopSigningAlgEnum;
use Auth0\SDK\API\Management\Types\ConnectionFederatedConnectionsAccessTokens;
use Auth0\SDK\API\Management\Types\ConnectionIdTokenSignedResponseAlgEnum;
use Auth0\SDK\API\Management\Types\ConnectionOptionsOidcMetadata;
use Auth0\SDK\API\Management\Types\ConnectionSetUserRootAttributesEnum;
use Auth0\SDK\API\Management\Types\ConnectionTokenEndpointAuthMethodEnum;
use Auth0\SDK\API\Management\Types\ConnectionTokenEndpointAuthSigningAlgEnum;
use Auth0\SDK\API\Management\Types\ConnectionTokenEndpointJwtcaAudFormatEnumOidc;
use Auth0\SDK\API\Management\Types\ConnectionUpstreamAlias;
use Auth0\SDK\API\Management\Types\ConnectionUpstreamValue;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * common options for OIDC connections
 *
 * @property ?string $authorizationEndpoint
 * @property string $clientId
 * @property ?string $clientSecret
 * @property ?ConnectionConnectionSettings $connectionSettings
 * @property ?array<string> $domainAliases
 * @property ?value-of<ConnectionDpopSigningAlgEnum> $dpopSigningAlg
 * @property ?ConnectionFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens
 * @property ?string $iconUrl
 * @property ?array<value-of<ConnectionIdTokenSignedResponseAlgEnum>> $idTokenSignedResponseAlgs
 * @property ?string $issuer
 * @property ?string $jwksUri
 * @property ?ConnectionOptionsOidcMetadata $oidcMetadata
 * @property ?string $scope
 * @property ?bool $sendBackChannelNonce
 * @property ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
 * @property ?string $tenantDomain
 * @property ?string $tokenEndpoint
 * @property ?value-of<ConnectionTokenEndpointAuthMethodEnum> $tokenEndpointAuthMethod
 * @property ?value-of<ConnectionTokenEndpointAuthSigningAlgEnum> $tokenEndpointAuthSigningAlg
 * @property ?value-of<ConnectionTokenEndpointJwtcaAudFormatEnumOidc> $tokenEndpointJwtcaAudFormat
 * @property ?array<string, (
 *    ConnectionUpstreamAlias
 *   |ConnectionUpstreamValue
 * )|null> $upstreamParams
 * @property ?string $userinfoEndpoint
 */
trait ConnectionOptionsCommonOidc
{
    /**
     * @var ?string $authorizationEndpoint
     */
    #[JsonProperty('authorization_endpoint')]
    private ?string $authorizationEndpoint;

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
     * @var ?ConnectionConnectionSettings $connectionSettings
     */
    #[JsonProperty('connection_settings')]
    private ?ConnectionConnectionSettings $connectionSettings;

    /**
     * @var ?array<string> $domainAliases
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?value-of<ConnectionDpopSigningAlgEnum> $dpopSigningAlg
     */
    #[JsonProperty('dpop_signing_alg')]
    private ?string $dpopSigningAlg;

    /**
     * @var ?ConnectionFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens
     */
    #[JsonProperty('federated_connections_access_tokens')]
    private ?ConnectionFederatedConnectionsAccessTokens $federatedConnectionsAccessTokens;

    /**
     * @var ?string $iconUrl
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?array<value-of<ConnectionIdTokenSignedResponseAlgEnum>> $idTokenSignedResponseAlgs
     */
    #[JsonProperty('id_token_signed_response_algs'), ArrayType(['string'])]
    private ?array $idTokenSignedResponseAlgs;

    /**
     * @var ?string $issuer
     */
    #[JsonProperty('issuer')]
    private ?string $issuer;

    /**
     * @var ?string $jwksUri
     */
    #[JsonProperty('jwks_uri')]
    private ?string $jwksUri;

    /**
     * @var ?ConnectionOptionsOidcMetadata $oidcMetadata
     */
    #[JsonProperty('oidc_metadata')]
    private ?ConnectionOptionsOidcMetadata $oidcMetadata;

    /**
     * @var ?string $scope
     */
    #[JsonProperty('scope')]
    private ?string $scope;

    /**
     * @var ?bool $sendBackChannelNonce
     */
    #[JsonProperty('send_back_channel_nonce')]
    private ?bool $sendBackChannelNonce;

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
     * @var ?string $tokenEndpoint
     */
    #[JsonProperty('token_endpoint')]
    private ?string $tokenEndpoint;

    /**
     * @var ?value-of<ConnectionTokenEndpointAuthMethodEnum> $tokenEndpointAuthMethod
     */
    #[JsonProperty('token_endpoint_auth_method')]
    private ?string $tokenEndpointAuthMethod;

    /**
     * @var ?value-of<ConnectionTokenEndpointAuthSigningAlgEnum> $tokenEndpointAuthSigningAlg
     */
    #[JsonProperty('token_endpoint_auth_signing_alg')]
    private ?string $tokenEndpointAuthSigningAlg;

    /**
     * @var ?value-of<ConnectionTokenEndpointJwtcaAudFormatEnumOidc> $tokenEndpointJwtcaAudFormat
     */
    #[JsonProperty('token_endpoint_jwtca_aud_format')]
    private ?string $tokenEndpointJwtcaAudFormat;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @var ?string $userinfoEndpoint
     */
    #[JsonProperty('userinfo_endpoint')]
    private ?string $userinfoEndpoint;

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
     * @return ?ConnectionConnectionSettings
     */
    public function getConnectionSettings(): ?ConnectionConnectionSettings
    {
        return $this->connectionSettings;
    }

    /**
     * @param ?ConnectionConnectionSettings $value
     */
    public function setConnectionSettings(?ConnectionConnectionSettings $value = null): self
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
     * @return ?value-of<ConnectionDpopSigningAlgEnum>
     */
    public function getDpopSigningAlg(): ?string
    {
        return $this->dpopSigningAlg;
    }

    /**
     * @param ?value-of<ConnectionDpopSigningAlgEnum> $value
     */
    public function setDpopSigningAlg(?string $value = null): self
    {
        $this->dpopSigningAlg = $value;
        $this->_setField('dpopSigningAlg');
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
     * @return ?array<value-of<ConnectionIdTokenSignedResponseAlgEnum>>
     */
    public function getIdTokenSignedResponseAlgs(): ?array
    {
        return $this->idTokenSignedResponseAlgs;
    }

    /**
     * @param ?array<value-of<ConnectionIdTokenSignedResponseAlgEnum>> $value
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
     * @return ?ConnectionOptionsOidcMetadata
     */
    public function getOidcMetadata(): ?ConnectionOptionsOidcMetadata
    {
        return $this->oidcMetadata;
    }

    /**
     * @param ?ConnectionOptionsOidcMetadata $value
     */
    public function setOidcMetadata(?ConnectionOptionsOidcMetadata $value = null): self
    {
        $this->oidcMetadata = $value;
        $this->_setField('oidcMetadata');
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
     * @return ?value-of<ConnectionTokenEndpointAuthMethodEnum>
     */
    public function getTokenEndpointAuthMethod(): ?string
    {
        return $this->tokenEndpointAuthMethod;
    }

    /**
     * @param ?value-of<ConnectionTokenEndpointAuthMethodEnum> $value
     */
    public function setTokenEndpointAuthMethod(?string $value = null): self
    {
        $this->tokenEndpointAuthMethod = $value;
        $this->_setField('tokenEndpointAuthMethod');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionTokenEndpointAuthSigningAlgEnum>
     */
    public function getTokenEndpointAuthSigningAlg(): ?string
    {
        return $this->tokenEndpointAuthSigningAlg;
    }

    /**
     * @param ?value-of<ConnectionTokenEndpointAuthSigningAlgEnum> $value
     */
    public function setTokenEndpointAuthSigningAlg(?string $value = null): self
    {
        $this->tokenEndpointAuthSigningAlg = $value;
        $this->_setField('tokenEndpointAuthSigningAlg');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionTokenEndpointJwtcaAudFormatEnumOidc>
     */
    public function getTokenEndpointJwtcaAudFormat(): ?string
    {
        return $this->tokenEndpointJwtcaAudFormat;
    }

    /**
     * @param ?value-of<ConnectionTokenEndpointJwtcaAudFormatEnumOidc> $value
     */
    public function setTokenEndpointJwtcaAudFormat(?string $value = null): self
    {
        $this->tokenEndpointJwtcaAudFormat = $value;
        $this->_setField('tokenEndpointJwtcaAudFormat');
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
}
