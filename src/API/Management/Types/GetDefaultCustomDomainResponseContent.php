<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class GetDefaultCustomDomainResponseContent extends JsonSerializableType
{
    /**
     * @var string $customDomainId ID of the custom domain.
     */
    #[JsonProperty('custom_domain_id')]
    private string $customDomainId;

    /**
     * @var string $domain Domain name.
     */
    #[JsonProperty('domain')]
    private string $domain;

    /**
     * @var bool $primary Whether this is a primary domain (true) or not (false).
     */
    #[JsonProperty('primary')]
    private bool $primary;

    /**
     * @var ?bool $isDefault Whether this is the default custom domain (true) or not (false).
     */
    #[JsonProperty('is_default')]
    private ?bool $isDefault;

    /**
     * @var value-of<CustomDomainStatusFilterEnum> $status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @var value-of<CustomDomainTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var ?string $originDomainName Intermediate address.
     */
    #[JsonProperty('origin_domain_name')]
    private ?string $originDomainName;

    /**
     * @var ?DomainVerification $verification
     */
    #[JsonProperty('verification')]
    private ?DomainVerification $verification;

    /**
     * @var ?string $customClientIpHeader The HTTP header to fetch the client's IP address
     */
    #[JsonProperty('custom_client_ip_header')]
    private ?string $customClientIpHeader;

    /**
     * @var ?string $tlsPolicy The TLS version policy
     */
    #[JsonProperty('tls_policy')]
    private ?string $tlsPolicy;

    /**
     * @var ?array<string, ?string> $domainMetadata
     */
    #[JsonProperty('domain_metadata'), ArrayType(['string' => new Union('string', 'null')])]
    private ?array $domainMetadata;

    /**
     * @var ?DomainCertificate $certificate
     */
    #[JsonProperty('certificate')]
    private ?DomainCertificate $certificate;

    /**
     * @var ?string $relyingPartyIdentifier Relying Party ID (rpId) to be used for Passkeys on this custom domain. If not present, the full domain will be used.
     */
    #[JsonProperty('relying_party_identifier')]
    private ?string $relyingPartyIdentifier;

    /**
     * @param array{
     *   customDomainId: string,
     *   domain: string,
     *   primary: bool,
     *   status: value-of<CustomDomainStatusFilterEnum>,
     *   type: value-of<CustomDomainTypeEnum>,
     *   isDefault?: ?bool,
     *   originDomainName?: ?string,
     *   verification?: ?DomainVerification,
     *   customClientIpHeader?: ?string,
     *   tlsPolicy?: ?string,
     *   domainMetadata?: ?array<string, ?string>,
     *   certificate?: ?DomainCertificate,
     *   relyingPartyIdentifier?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->customDomainId = $values['customDomainId'];
        $this->domain = $values['domain'];
        $this->primary = $values['primary'];
        $this->isDefault = $values['isDefault'] ?? null;
        $this->status = $values['status'];
        $this->type = $values['type'];
        $this->originDomainName = $values['originDomainName'] ?? null;
        $this->verification = $values['verification'] ?? null;
        $this->customClientIpHeader = $values['customClientIpHeader'] ?? null;
        $this->tlsPolicy = $values['tlsPolicy'] ?? null;
        $this->domainMetadata = $values['domainMetadata'] ?? null;
        $this->certificate = $values['certificate'] ?? null;
        $this->relyingPartyIdentifier = $values['relyingPartyIdentifier'] ?? null;
    }

    /**
     * @return string
     */
    public function getCustomDomainId(): string
    {
        return $this->customDomainId;
    }

    /**
     * @param string $value
     */
    public function setCustomDomainId(string $value): self
    {
        $this->customDomainId = $value;
        $this->_setField('customDomainId');
        return $this;
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
     * @return bool
     */
    public function getPrimary(): bool
    {
        return $this->primary;
    }

    /**
     * @param bool $value
     */
    public function setPrimary(bool $value): self
    {
        $this->primary = $value;
        $this->_setField('primary');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    /**
     * @param ?bool $value
     */
    public function setIsDefault(?bool $value = null): self
    {
        $this->isDefault = $value;
        $this->_setField('isDefault');
        return $this;
    }

    /**
     * @return value-of<CustomDomainStatusFilterEnum>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param value-of<CustomDomainStatusFilterEnum> $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return value-of<CustomDomainTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<CustomDomainTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getOriginDomainName(): ?string
    {
        return $this->originDomainName;
    }

    /**
     * @param ?string $value
     */
    public function setOriginDomainName(?string $value = null): self
    {
        $this->originDomainName = $value;
        $this->_setField('originDomainName');
        return $this;
    }

    /**
     * @return ?DomainVerification
     */
    public function getVerification(): ?DomainVerification
    {
        return $this->verification;
    }

    /**
     * @param ?DomainVerification $value
     */
    public function setVerification(?DomainVerification $value = null): self
    {
        $this->verification = $value;
        $this->_setField('verification');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCustomClientIpHeader(): ?string
    {
        return $this->customClientIpHeader;
    }

    /**
     * @param ?string $value
     */
    public function setCustomClientIpHeader(?string $value = null): self
    {
        $this->customClientIpHeader = $value;
        $this->_setField('customClientIpHeader');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTlsPolicy(): ?string
    {
        return $this->tlsPolicy;
    }

    /**
     * @param ?string $value
     */
    public function setTlsPolicy(?string $value = null): self
    {
        $this->tlsPolicy = $value;
        $this->_setField('tlsPolicy');
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
     * @return ?DomainCertificate
     */
    public function getCertificate(): ?DomainCertificate
    {
        return $this->certificate;
    }

    /**
     * @param ?DomainCertificate $value
     */
    public function setCertificate(?DomainCertificate $value = null): self
    {
        $this->certificate = $value;
        $this->_setField('certificate');
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
