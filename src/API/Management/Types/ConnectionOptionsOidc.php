<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommonOidc;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for the 'oidc' connection
 */
class ConnectionOptionsOidc extends JsonSerializableType
{
    use ConnectionOptionsCommonOidc;
    use ConnectionOptionsCommon;

    /**
     * @var ?ConnectionAttributeMapOidc $attributeMap
     */
    #[JsonProperty('attribute_map')]
    private ?ConnectionAttributeMapOidc $attributeMap;

    /**
     * @var ?string $discoveryUrl
     */
    #[JsonProperty('discovery_url')]
    private ?string $discoveryUrl;

    /**
     * @var ?value-of<ConnectionTypeEnumOidc> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @param array{
     *   clientId: string,
     *   authorizationEndpoint?: ?string,
     *   clientSecret?: ?string,
     *   connectionSettings?: ?ConnectionConnectionSettings,
     *   domainAliases?: ?array<string>,
     *   dpopSigningAlg?: ?value-of<ConnectionDpopSigningAlgEnum>,
     *   federatedConnectionsAccessTokens?: ?ConnectionFederatedConnectionsAccessTokens,
     *   iconUrl?: ?string,
     *   idTokenSignedResponseAlgs?: ?array<value-of<ConnectionIdTokenSignedResponseAlgEnum>>,
     *   issuer?: ?string,
     *   jwksUri?: ?string,
     *   oidcMetadata?: ?ConnectionOptionsOidcMetadata,
     *   scope?: ?string,
     *   sendBackChannelNonce?: ?bool,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   tenantDomain?: ?string,
     *   tokenEndpoint?: ?string,
     *   tokenEndpointAuthMethod?: ?value-of<ConnectionTokenEndpointAuthMethodEnum>,
     *   tokenEndpointAuthSigningAlg?: ?value-of<ConnectionTokenEndpointAuthSigningAlgEnum>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   userinfoEndpoint?: ?string,
     *   nonPersistentAttrs?: ?array<string>,
     *   attributeMap?: ?ConnectionAttributeMapOidc,
     *   discoveryUrl?: ?string,
     *   type?: ?value-of<ConnectionTypeEnumOidc>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->authorizationEndpoint = $values['authorizationEndpoint'] ?? null;
        $this->clientId = $values['clientId'];
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->connectionSettings = $values['connectionSettings'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->dpopSigningAlg = $values['dpopSigningAlg'] ?? null;
        $this->federatedConnectionsAccessTokens = $values['federatedConnectionsAccessTokens'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->idTokenSignedResponseAlgs = $values['idTokenSignedResponseAlgs'] ?? null;
        $this->issuer = $values['issuer'] ?? null;
        $this->jwksUri = $values['jwksUri'] ?? null;
        $this->oidcMetadata = $values['oidcMetadata'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->sendBackChannelNonce = $values['sendBackChannelNonce'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->tokenEndpoint = $values['tokenEndpoint'] ?? null;
        $this->tokenEndpointAuthMethod = $values['tokenEndpointAuthMethod'] ?? null;
        $this->tokenEndpointAuthSigningAlg = $values['tokenEndpointAuthSigningAlg'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->userinfoEndpoint = $values['userinfoEndpoint'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->attributeMap = $values['attributeMap'] ?? null;
        $this->discoveryUrl = $values['discoveryUrl'] ?? null;
        $this->type = $values['type'] ?? null;
    }

    /**
     * @return ?ConnectionAttributeMapOidc
     */
    public function getAttributeMap(): ?ConnectionAttributeMapOidc
    {
        return $this->attributeMap;
    }

    /**
     * @param ?ConnectionAttributeMapOidc $value
     */
    public function setAttributeMap(?ConnectionAttributeMapOidc $value = null): self
    {
        $this->attributeMap = $value;
        $this->_setField('attributeMap');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDiscoveryUrl(): ?string
    {
        return $this->discoveryUrl;
    }

    /**
     * @param ?string $value
     */
    public function setDiscoveryUrl(?string $value = null): self
    {
        $this->discoveryUrl = $value;
        $this->_setField('discoveryUrl');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionTypeEnumOidc>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<ConnectionTypeEnumOidc> $value
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
