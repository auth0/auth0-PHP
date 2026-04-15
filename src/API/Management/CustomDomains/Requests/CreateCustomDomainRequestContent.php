<?php

namespace Auth0\SDK\API\Management\CustomDomains\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\CustomDomainProvisioningTypeEnum;
use Auth0\SDK\API\Management\Types\CustomDomainVerificationMethodEnum;
use Auth0\SDK\API\Management\Types\CustomDomainTlsPolicyEnum;
use Auth0\SDK\API\Management\Types\CustomDomainCustomClientIpHeaderEnum;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class CreateCustomDomainRequestContent extends JsonSerializableType
{
    /**
     * @var string $domain Domain name.
     */
    #[JsonProperty('domain')]
    private string $domain;

    /**
     * @var value-of<CustomDomainProvisioningTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var ?value-of<CustomDomainVerificationMethodEnum> $verificationMethod
     */
    #[JsonProperty('verification_method')]
    private ?string $verificationMethod;

    /**
     * @var ?value-of<CustomDomainTlsPolicyEnum> $tlsPolicy
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
     * @var ?string $relyingPartyIdentifier Relying Party ID (rpId) to be used for Passkeys on this custom domain. If not provided, the full domain will be used.
     */
    #[JsonProperty('relying_party_identifier')]
    private ?string $relyingPartyIdentifier;

    /**
     * @param array{
     *   domain: string,
     *   type: value-of<CustomDomainProvisioningTypeEnum>,
     *   verificationMethod?: ?value-of<CustomDomainVerificationMethodEnum>,
     *   tlsPolicy?: ?value-of<CustomDomainTlsPolicyEnum>,
     *   customClientIpHeader?: ?value-of<CustomDomainCustomClientIpHeaderEnum>,
     *   domainMetadata?: ?array<string, ?string>,
     *   relyingPartyIdentifier?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->domain = $values['domain'];
        $this->type = $values['type'];
        $this->verificationMethod = $values['verificationMethod'] ?? null;
        $this->tlsPolicy = $values['tlsPolicy'] ?? null;
        $this->customClientIpHeader = $values['customClientIpHeader'] ?? null;
        $this->domainMetadata = $values['domainMetadata'] ?? null;
        $this->relyingPartyIdentifier = $values['relyingPartyIdentifier'] ?? null;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $value
     */
    public function setDomain(string $value): self
    {
        $this->domain = $value;
        $this->_setField('domain');
        return $this;
    }

    /**
     * @return value-of<CustomDomainProvisioningTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<CustomDomainProvisioningTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?value-of<CustomDomainVerificationMethodEnum>
     */
    public function getVerificationMethod(): ?string
    {
        return $this->verificationMethod;
    }

    /**
     * @param ?value-of<CustomDomainVerificationMethodEnum> $value
     */
    public function setVerificationMethod(?string $value = null): self
    {
        $this->verificationMethod = $value;
        $this->_setField('verificationMethod');
        return $this;
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
