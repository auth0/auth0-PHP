<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Encryption used for WsFed responses with this client.
 */
class ClientEncryptionKey extends JsonSerializableType
{
    /**
     * @var ?string $pub Encryption Public RSA Key.
     */
    #[JsonProperty('pub')]
    private ?string $pub;

    /**
     * @var ?string $cert Encryption certificate for public key in X.509 (.CER) format.
     */
    #[JsonProperty('cert')]
    private ?string $cert;

    /**
     * @var ?string $subject Encryption certificate name for this certificate in the format `/CN={domain}`.
     */
    #[JsonProperty('subject')]
    private ?string $subject;

    /**
     * @param array{
     *   pub?: ?string,
     *   cert?: ?string,
     *   subject?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->pub = $values['pub'] ?? null;
        $this->cert = $values['cert'] ?? null;
        $this->subject = $values['subject'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getPub(): ?string
    {
        return $this->pub;
    }

    /**
     * @param ?string $value
     */
    public function setPub(?string $value = null): self
    {
        $this->pub = $value;
        $this->_setField('pub');
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
