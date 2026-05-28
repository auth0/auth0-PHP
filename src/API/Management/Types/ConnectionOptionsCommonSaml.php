<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Common options for SAML-based enterprise connections (shared by samlp and pingfederate).
 */
class ConnectionOptionsCommonSaml extends JsonSerializableType
{
    /**
     * @var ?ConnectionAssertionDecryptionSettings $assertionDecryptionSettings
     */
    #[JsonProperty('assertion_decryption_settings')]
    private ?ConnectionAssertionDecryptionSettings $assertionDecryptionSettings;

    /**
     * @var ?string $cert
     */
    #[JsonProperty('cert')]
    private ?string $cert;

    /**
     * @var (
     *    ConnectionDecryptionKeySamlCert
     *   |string
     * )|null $decryptionKey
     */
    #[JsonProperty('decryptionKey'), Union(ConnectionDecryptionKeySamlCert::class, 'string', 'null')]
    private ConnectionDecryptionKeySamlCert|string|null $decryptionKey;

    /**
     * @var ?value-of<ConnectionDigestAlgorithmEnumSaml> $digestAlgorithm
     */
    #[JsonProperty('digestAlgorithm')]
    private ?string $digestAlgorithm;

    /**
     * @var ?array<string> $domainAliases
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?string $entityId
     */
    #[JsonProperty('entityId')]
    private ?string $entityId;

    /**
     * @var ?string $iconUrl
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?ConnectionOptionsIdpinitiatedSaml $idpinitiated
     */
    #[JsonProperty('idpinitiated')]
    private ?ConnectionOptionsIdpinitiatedSaml $idpinitiated;

    /**
     * @var ?value-of<ConnectionProtocolBindingEnumSaml> $protocolBinding
     */
    #[JsonProperty('protocolBinding')]
    private ?string $protocolBinding;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?string $signInEndpoint
     */
    #[JsonProperty('signInEndpoint')]
    private ?string $signInEndpoint;

    /**
     * @var ?bool $signSamlRequest
     */
    #[JsonProperty('signSAMLRequest')]
    private ?bool $signSamlRequest;

    /**
     * @var ?value-of<ConnectionSignatureAlgorithmEnumSaml> $signatureAlgorithm
     */
    #[JsonProperty('signatureAlgorithm')]
    private ?string $signatureAlgorithm;

    /**
     * @var ?string $tenantDomain
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?array<string> $thumbprints
     */
    #[JsonProperty('thumbprints'), ArrayType(['string'])]
    private ?array $thumbprints;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @param array{
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
     * } $values
     */
    public function __construct(
        array $values = [],
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
    }

    /**
     * @return ?ConnectionAssertionDecryptionSettings
     */
    public function getAssertionDecryptionSettings(): ?ConnectionAssertionDecryptionSettings
    {
        return $this->assertionDecryptionSettings;
    }

    /**
     * @param ?ConnectionAssertionDecryptionSettings $value
     */
    public function setAssertionDecryptionSettings(?ConnectionAssertionDecryptionSettings $value = null): self
    {
        $this->assertionDecryptionSettings = $value;
        $this->_setField('assertionDecryptionSettings');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCert(): ?string
    {
        return $this->cert;
    }

    /**
     * @param ?string $value
     */
    public function setCert(?string $value = null): self
    {
        $this->cert = $value;
        $this->_setField('cert');
        return $this;
    }

    /**
     * @return (
     *    ConnectionDecryptionKeySamlCert
     *   |string
     * )|null
     */
    public function getDecryptionKey(): ConnectionDecryptionKeySamlCert|string|null
    {
        return $this->decryptionKey;
    }

    /**
     * @param (
     *    ConnectionDecryptionKeySamlCert
     *   |string
     * )|null $value
     */
    public function setDecryptionKey(ConnectionDecryptionKeySamlCert|string|null $value = null): self
    {
        $this->decryptionKey = $value;
        $this->_setField('decryptionKey');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionDigestAlgorithmEnumSaml>
     */
    public function getDigestAlgorithm(): ?string
    {
        return $this->digestAlgorithm;
    }

    /**
     * @param ?value-of<ConnectionDigestAlgorithmEnumSaml> $value
     */
    public function setDigestAlgorithm(?string $value = null): self
    {
        $this->digestAlgorithm = $value;
        $this->_setField('digestAlgorithm');
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
     * @return ?string
     */
    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    /**
     * @param ?string $value
     */
    public function setEntityId(?string $value = null): self
    {
        $this->entityId = $value;
        $this->_setField('entityId');
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
     * @return ?ConnectionOptionsIdpinitiatedSaml
     */
    public function getIdpinitiated(): ?ConnectionOptionsIdpinitiatedSaml
    {
        return $this->idpinitiated;
    }

    /**
     * @param ?ConnectionOptionsIdpinitiatedSaml $value
     */
    public function setIdpinitiated(?ConnectionOptionsIdpinitiatedSaml $value = null): self
    {
        $this->idpinitiated = $value;
        $this->_setField('idpinitiated');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionProtocolBindingEnumSaml>
     */
    public function getProtocolBinding(): ?string
    {
        return $this->protocolBinding;
    }

    /**
     * @param ?value-of<ConnectionProtocolBindingEnumSaml> $value
     */
    public function setProtocolBinding(?string $value = null): self
    {
        $this->protocolBinding = $value;
        $this->_setField('protocolBinding');
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
    public function getSignInEndpoint(): ?string
    {
        return $this->signInEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setSignInEndpoint(?string $value = null): self
    {
        $this->signInEndpoint = $value;
        $this->_setField('signInEndpoint');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSignSamlRequest(): ?bool
    {
        return $this->signSamlRequest;
    }

    /**
     * @param ?bool $value
     */
    public function setSignSamlRequest(?bool $value = null): self
    {
        $this->signSamlRequest = $value;
        $this->_setField('signSamlRequest');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionSignatureAlgorithmEnumSaml>
     */
    public function getSignatureAlgorithm(): ?string
    {
        return $this->signatureAlgorithm;
    }

    /**
     * @param ?value-of<ConnectionSignatureAlgorithmEnumSaml> $value
     */
    public function setSignatureAlgorithm(?string $value = null): self
    {
        $this->signatureAlgorithm = $value;
        $this->_setField('signatureAlgorithm');
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
     * @return ?array<string>
     */
    public function getThumbprints(): ?array
    {
        return $this->thumbprints;
    }

    /**
     * @param ?array<string> $value
     */
    public function setThumbprints(?array $value = null): self
    {
        $this->thumbprints = $value;
        $this->_setField('thumbprints');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
