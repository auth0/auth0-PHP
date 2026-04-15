<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ClientSigningKey extends JsonSerializableType
{
    /**
     * @var ?string $pkcs7 Signing certificate public key and chain in PKCS#7 (.P7B) format.
     */
    #[JsonProperty('pkcs7')]
    private ?string $pkcs7;

    /**
     * @var ?string $cert Signing certificate public key in X.509 (.CER) format.
     */
    #[JsonProperty('cert')]
    private ?string $cert;

    /**
     * @var ?string $subject Subject name for this certificate in the format `/CN={domain}`.
     */
    #[JsonProperty('subject')]
    private ?string $subject;

    /**
     * @param array{
     *   pkcs7?: ?string,
     *   cert?: ?string,
     *   subject?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->pkcs7 = $values['pkcs7'] ?? null;
        $this->cert = $values['cert'] ?? null;
        $this->subject = $values['subject'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getPkcs7(): ?string
    {
        return $this->pkcs7;
    }

    /**
     * @param ?string $value
     */
    public function setPkcs7(?string $value = null): self
    {
        $this->pkcs7 = $value;
        $this->_setField('pkcs7');
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
     * @return ?string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param ?string $value
     */
    public function setSubject(?string $value = null): self
    {
        $this->subject = $value;
        $this->_setField('subject');
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
