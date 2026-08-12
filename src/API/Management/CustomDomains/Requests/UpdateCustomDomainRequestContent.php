<?php

namespace Auth0\SDK\API\Management\CustomDomains\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\CustomDomainTlsPolicyEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\CustomDomainCustomClientIpHeaderEnum;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class UpdateCustomDomainRequestContent extends JsonSerializableType
{
    /**
     * @var ?value-of<CustomDomainTlsPolicyEnum> $tlsPolicy recommended includes TLS 1.2
     */
    #[JsonProperty('tls_policy')]
    private ?string $tlsPolicy;

    /**
     * @var ?value-of<CustomDomainCustomClientIpHeaderEnum> $customClientIpHeader
     */
    #[JsonProperty('custom_client_ip_header')]
    private ?string $customClientIpHeader;

    /**
     * @var ?array<string, ?string> $domainMetadata
     */
    #[JsonProperty('domain_metadata'), ArrayType(['string' => new Union('string', 'null')])]
    private ?array $domainMetadata;

    /**
     * @var ?string $relyingPartyIdentifier Relying Party ID (rpId) to be used for Passkeys on this custom domain. Set to null to remove the rpId and fall back to using the full domain.
     */
    #[JsonProperty('relying_party_identifier')]
    private ?string $relyingPartyIdentifier;

    /**
     * @param array{
     *   tlsPolicy?: ?value-of<CustomDomainTlsPolicyEnum>,
     *   customClientIpHeader?: ?value-of<CustomDomainCustomClientIpHeaderEnum>,
     *   domainMetadata?: ?array<string, ?string>,
     *   relyingPartyIdentifier?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->tlsPolicy = $values['tlsPolicy'] ?? null;
        $this->customClientIpHeader = $values['customClientIpHeader'] ?? null;
        $this->domainMetadata = $values['domainMetadata'] ?? null;
        $this->relyingPartyIdentifier = $values['relyingPartyIdentifier'] ?? null;
    }

    /**
     * @return ?value-of<CustomDomainTlsPolicyEnum>
     */
    public function getTlsPolicy(): ?string
    {
        return $this->tlsPolicy;
    }

    /**
     * @param ?value-of<CustomDomainTlsPolicyEnum> $value
     */
    public function setTlsPolicy(?string $value = null): self
    {
        $this->tlsPolicy = $value;
        $this->_setField('tlsPolicy');
        return $this;
    }

    /**
     * @return ?value-of<CustomDomainCustomClientIpHeaderEnum>
     */
    public function getCustomClientIpHeader(): ?string
    {
        return $this->customClientIpHeader;
    }

    /**
     * @param ?value-of<CustomDomainCustomClientIpHeaderEnum> $value
     */
    public function setCustomClientIpHeader(?string $value = null): self
    {
        $this->customClientIpHeader = $value;
        $this->_setField('customClientIpHeader');
        return $this;
    }

    /**
     * @return ?array<string, ?string>
     */
    public function getDomainMetadata(): ?array
    {
        return $this->domainMetadata;
    }

    /**
     * @param ?array<string, ?string> $value
     */
    public function setDomainMetadata(?array $value = null): self
    {
        $this->domainMetadata = $value;
        $this->_setField('domainMetadata');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRelyingPartyIdentifier(): ?string
    {
        return $this->relyingPartyIdentifier;
    }

    /**
     * @param ?string $value
     */
    public function setRelyingPartyIdentifier(?string $value = null): self
    {
        $this->relyingPartyIdentifier = $value;
        $this->_setField('relyingPartyIdentifier');
        return $this;
    }
}
