<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetAllKeysNetworkAclsResponseContent extends JsonSerializableType
{
    /**
     * @var array<NetworkAclKey> $keys The tenant's Network ACL Keys.
     */
    #[JsonProperty('keys'), ArrayType([NetworkAclKey::class])]
    private array $keys;

    /**
     * @param array{
     *   keys: array<NetworkAclKey>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->keys = $values['keys'];
    }

    /**
     * @return array<NetworkAclKey>
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * @param array<NetworkAclKey> $value
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
