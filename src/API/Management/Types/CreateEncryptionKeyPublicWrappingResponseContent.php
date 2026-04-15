<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateEncryptionKeyPublicWrappingResponseContent extends JsonSerializableType
{
    /**
     * @var string $publicKey Public wrapping key in PEM format
     */
    #[JsonProperty('public_key')]
    private string $publicKey;

    /**
     * @var value-of<EncryptionKeyPublicWrappingAlgorithm> $algorithm
     */
    #[JsonProperty('algorithm')]
    private string $algorithm;

    /**
     * @param array{
     *   publicKey: string,
     *   algorithm: value-of<EncryptionKeyPublicWrappingAlgorithm>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->publicKey = $values['publicKey'];
        $this->algorithm = $values['algorithm'];
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @param string $value
     */
    public function setPublicKey(string $value): self
    {
        $this->publicKey = $value;
        $this->_setField('publicKey');
        return $this;
    }

    /**
     * @return value-of<EncryptionKeyPublicWrappingAlgorithm>
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * @param value-of<EncryptionKeyPublicWrappingAlgorithm> $value
     */
    public function setAlgorithm(string $value): self
    {
        $this->algorithm = $value;
        $this->_setField('algorithm');
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
