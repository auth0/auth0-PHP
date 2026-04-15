<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Key pair with 'key' and 'cert' properties.
 */
class ConnectionDecryptionKeySamlCert extends JsonSerializableType
{
    /**
     * @var ?string $cert Base64-encoded X.509 certificate in PEM format.
     */
    #[JsonProperty('cert')]
    private ?string $cert;

    /**
     * @var ?string $key Private key in PEM format.
     */
    #[JsonProperty('key')]
    private ?string $key;

    /**
     * @param array{
     *   cert?: ?string,
     *   key?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->cert = $values['cert'] ?? null;
        $this->key = $values['key'] ?? null;
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
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param ?string $value
     */
    public function setKey(?string $value = null): self
    {
        $this->key = $value;
        $this->_setField('key');
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
