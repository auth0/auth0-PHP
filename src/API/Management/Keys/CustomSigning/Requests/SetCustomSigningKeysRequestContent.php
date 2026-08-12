<?php

namespace Auth0\SDK\API\Management\Keys\CustomSigning\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\CustomSigningKeyJwk;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class SetCustomSigningKeysRequestContent extends JsonSerializableType
{
    /**
     * @var array<CustomSigningKeyJwk> $keys An array of custom public signing keys.
     */
    #[JsonProperty('keys'), ArrayType([CustomSigningKeyJwk::class])]
    private array $keys;

    /**
     * @param array{
     *   keys: array<CustomSigningKeyJwk>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->keys = $values['keys'];
    }

    /**
     * @return array<CustomSigningKeyJwk>
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * @param array<CustomSigningKeyJwk> $value
     */
    public function setKeys(array $value): self
    {
        $this->keys = $value;
        $this->_setField('keys');
        return $this;
    }
}
