<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CertificateSubjectDnCredential extends JsonSerializableType
{
    /**
     * @var value-of<CertificateSubjectDnCredentialTypeEnum> $credentialType
     */
    #[JsonProperty('credential_type')]
    private string $credentialType;

    /**
     * @var ?string $name Friendly name for a credential.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $subjectDn Subject Distinguished Name. Mutually exclusive with `pem` property. Applies to `cert_subject_dn` credential type.
     */
    #[JsonProperty('subject_dn')]
    private ?string $subjectDn;

    /**
     * @var ?string $pem PEM-formatted X509 certificate. Must be JSON escaped. Mutually exclusive with `subject_dn` property.
     */
    #[JsonProperty('pem')]
    private ?string $pem;

    /**
     * @param array{
     *   credentialType: value-of<CertificateSubjectDnCredentialTypeEnum>,
     *   name?: ?string,
     *   subjectDn?: ?string,
     *   pem?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentialType = $values['credentialType'];
        $this->name = $values['name'] ?? null;
        $this->subjectDn = $values['subjectDn'] ?? null;
        $this->pem = $values['pem'] ?? null;
    }

    /**
     * @return value-of<CertificateSubjectDnCredentialTypeEnum>
     */
    public function getCredentialType(): string
    {
        return $this->credentialType;
    }

    /**
     * @param value-of<CertificateSubjectDnCredentialTypeEnum> $value
     */
    public function setCredentialType(string $value): self
    {
        $this->credentialType = $value;
        $this->_setField('credentialType');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSubjectDn(): ?string
    {
        return $this->subjectDn;
    }

    /**
     * @param ?string $value
     */
    public function setSubjectDn(?string $value = null): self
    {
        $this->subjectDn = $value;
        $this->_setField('subjectDn');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPem(): ?string
    {
        return $this->pem;
    }

    /**
     * @param ?string $value
     */
    public function setPem(?string $value = null): self
    {
        $this->pem = $value;
        $this->_setField('pem');
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
