<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * JWKS representing an array of custom public signing keys.
 */
class SetCustomSigningKeysResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<CustomSigningKeyJwk> $keys An array of custom public signing keys.
     */
    #[JsonProperty('keys'), ArrayType([CustomSigningKeyJwk::class])]
    private ?array $keys;

    /**
     * @param array{
     *   keys?: ?array<CustomSigningKeyJwk>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->keys = $values['keys'] ?? null;
    }

    /**
     * @return ?array<CustomSigningKeyJwk>
     */
    public function getKeys(): ?array
    {
        return $this->keys;
    }

    /**
     * @param ?array<CustomSigningKeyJwk> $value
     */
    public function setKeys(?array $value = null): self
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
