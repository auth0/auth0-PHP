<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommonSaml;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for the 'pingfederate' connection
 */
class ConnectionOptionsPingFederate extends JsonSerializableType
{
    use ConnectionOptionsCommonSaml;
    use ConnectionOptionsCommon;

    /**
     * @var string $pingFederateBaseUrl
     */
    #[JsonProperty('pingFederateBaseUrl')]
    private string $pingFederateBaseUrl;

    /**
     * @var ?string $signingCert
     */
    #[JsonProperty('signingCert')]
    private ?string $signingCert;

    /**
     * @param array{
     *   pingFederateBaseUrl: string,
     *   assertionDecryptionSettings?: ?ConnectionAssertionDecryptionSettings,
     *   cert?: ?string,
     *   decryptionKey?: (
     *    ConnectionDecryptionKeySamlCert
     *   |string
     * )|null,
     *   digestAlgorithm?: ?value-of<ConnectionDigestAlgorithmEnumSaml>,
     *   domainAliases?: ?array<string>,
     *   entityId?: ?string,
     *   iconUrl?: ?string,
     *   idpinitiated?: ?ConnectionOptionsIdpinitiatedSaml,
     *   protocolBinding?: ?value-of<ConnectionProtocolBindingEnumSaml>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   signInEndpoint?: ?string,
     *   signSamlRequest?: ?bool,
     *   signatureAlgorithm?: ?value-of<ConnectionSignatureAlgorithmEnumSaml>,
     *   tenantDomain?: ?string,
     *   thumbprints?: ?array<string>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   nonPersistentAttrs?: ?array<string>,
     *   signingCert?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->assertionDecryptionSettings = $values['assertionDecryptionSettings'] ?? null;
        $this->cert = $values['cert'] ?? null;
        $this->decryptionKey = $values['decryptionKey'] ?? null;
        $this->digestAlgorithm = $values['digestAlgorithm'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->entityId = $values['entityId'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->idpinitiated = $values['idpinitiated'] ?? null;
        $this->protocolBinding = $values['protocolBinding'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->signInEndpoint = $values['signInEndpoint'] ?? null;
        $this->signSamlRequest = $values['signSamlRequest'] ?? null;
        $this->signatureAlgorithm = $values['signatureAlgorithm'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->thumbprints = $values['thumbprints'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->pingFederateBaseUrl = $values['pingFederateBaseUrl'];
        $this->signingCert = $values['signingCert'] ?? null;
    }

    /**
     * @return string
     */
    public function getPingFederateBaseUrl(): string
    {
        return $this->pingFederateBaseUrl;
    }

    /**
     * @param string $value
     */
    public function setPingFederateBaseUrl(string $value): self
    {
        $this->pingFederateBaseUrl = $value;
        $this->_setField('pingFederateBaseUrl');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSigningCert(): ?string
    {
        return $this->signingCert;
    }

    /**
     * @param ?string $value
     */
    public function setSigningCert(?string $value = null): self
    {
        $this->signingCert = $value;
        $this->_setField('signingCert');
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
