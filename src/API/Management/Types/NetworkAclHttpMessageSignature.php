<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * HTTP Message Signature configuration.
 */
class NetworkAclHttpMessageSignature extends JsonSerializableType
{
    /**
     * @var array<NetworkAclHttpMessageSignatureKey> $keys
     */
    #[JsonProperty('keys'), ArrayType([NetworkAclHttpMessageSignatureKey::class])]
    private array $keys;

    /**
     * @param array{
     *   keys: array<NetworkAclHttpMessageSignatureKey>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->keys = $values['keys'];
    }

    /**
     * @return array<NetworkAclHttpMessageSignatureKey>
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * @param array<NetworkAclHttpMessageSignatureKey> $value
     */
    public function setKeys(array $value): self
    {
        $this->keys = $value;
        $this->_setField('keys');
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
