<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Certificate information. This object is relevant only for Custom Domains with Auth0-Managed Certificates.
 */
class DomainCertificate extends JsonSerializableType
{
    /**
     * @var ?value-of<DomainCertificateStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?string $errorMsg A user-friendly error message will be presented if the certificate status is provisioning_failed or renewing_failed.
     */
    #[JsonProperty('error_msg')]
    private ?string $errorMsg;

    /**
     * @var ?value-of<DomainCertificateAuthorityEnum> $certificateAuthority
     */
    #[JsonProperty('certificate_authority')]
    private ?string $certificateAuthority;

    /**
     * @var ?string $renewsBefore The certificate will be renewed prior to this date.
     */
    #[JsonProperty('renews_before')]
    private ?string $renewsBefore;

    /**
     * @param array{
     *   status?: ?value-of<DomainCertificateStatusEnum>,
     *   errorMsg?: ?string,
     *   certificateAuthority?: ?value-of<DomainCertificateAuthorityEnum>,
     *   renewsBefore?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->status = $values['status'] ?? null;
        $this->errorMsg = $values['errorMsg'] ?? null;
        $this->certificateAuthority = $values['certificateAuthority'] ?? null;
        $this->renewsBefore = $values['renewsBefore'] ?? null;
    }

    /**
     * @return ?value-of<DomainCertificateStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<DomainCertificateStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getErrorMsg(): ?string
    {
        return $this->errorMsg;
    }

    /**
     * @param ?string $value
     */
    public function setErrorMsg(?string $value = null): self
    {
        $this->errorMsg = $value;
        $this->_setField('errorMsg');
        return $this;
    }

    /**
     * @return ?value-of<DomainCertificateAuthorityEnum>
     */
    public function getCertificateAuthority(): ?string
    {
        return $this->certificateAuthority;
    }

    /**
     * @param ?value-of<DomainCertificateAuthorityEnum> $value
     */
    public function setCertificateAuthority(?string $value = null): self
    {
        $this->certificateAuthority = $value;
        $this->_setField('certificateAuthority');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRenewsBefore(): ?string
    {
        return $this->renewsBefore;
    }

    /**
     * @param ?string $value
     */
    public function setRenewsBefore(?string $value = null): self
    {
        $this->renewsBefore = $value;
        $this->_setField('renewsBefore');
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
