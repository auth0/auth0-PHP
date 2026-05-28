<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommonOidc;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for the 'okta' connection
 */
class ConnectionOptionsOkta extends JsonSerializableType
{
    use ConnectionOptionsCommon;
    use ConnectionOptionsCommonOidc;

    /**
     * @var ?ConnectionAttributeMapOkta $attributeMap
     */
    #[JsonProperty('attribute_map')]
    private ?ConnectionAttributeMapOkta $attributeMap;

    /**
     * @var ?string $domain
     */
    #[JsonProperty('domain')]
    private ?string $domain;

    /**
     * @var ?value-of<ConnectionTypeEnumOkta> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @param array{
     *   clientId: string,
     *   nonPersistentAttrs?: ?array<string>,
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
     *   tokenEndpointJwtcaAudFormat?: ?value-of<ConnectionTokenEndpointJwtcaAudFormatEnumOidc>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   userinfoEndpoint?: ?string,
     *   attributeMap?: ?ConnectionAttributeMapOkta,
     *   domain?: ?string,
     *   type?: ?value-of<ConnectionTypeEnumOkta>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
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
        $this->tokenEndpointJwtcaAudFormat = $values['tokenEndpointJwtcaAudFormat'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->userinfoEndpoint = $values['userinfoEndpoint'] ?? null;
        $this->attributeMap = $values['attributeMap'] ?? null;
        $this->domain = $values['domain'] ?? null;
        $this->type = $values['type'] ?? null;
    }

    /**
     * @return ?ConnectionAttributeMapOkta
     */
    public function getAttributeMap(): ?ConnectionAttributeMapOkta
    {
        return $this->attributeMap;
    }

    /**
     * @param ?ConnectionAttributeMapOkta $value
     */
    public function setAttributeMap(?ConnectionAttributeMapOkta $value = null): self
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
     * @return ?value-of<ConnectionTypeEnumOkta>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<ConnectionTypeEnumOkta> $value
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
