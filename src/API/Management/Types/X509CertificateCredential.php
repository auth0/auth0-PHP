<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class X509CertificateCredential extends JsonSerializableType
{
    /**
     * @var value-of<X509CertificateCredentialTypeEnum> $credentialType
     */
    #[JsonProperty('credential_type')]
    private string $credentialType;

    /**
     * @var ?string $name Friendly name for a credential.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var string $pem PEM-formatted X509 certificate. Must be JSON escaped.
     */
    #[JsonProperty('pem')]
    private string $pem;

    /**
     * @param array{
     *   credentialType: value-of<X509CertificateCredentialTypeEnum>,
     *   pem: string,
     *   name?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentialType = $values['credentialType'];
        $this->name = $values['name'] ?? null;
        $this->pem = $values['pem'];
    }

    /**
     * @return value-of<X509CertificateCredentialTypeEnum>
     */
    public function getCredentialType(): string
    {
        return $this->credentialType;
    }

    /**
     * @param value-of<X509CertificateCredentialTypeEnum> $value
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
     * @return string
     */
    public function getPem(): string
    {
        return $this->pem;
    }

    /**
     * @param string $value
     */
    public function setPem(string $value): self
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
