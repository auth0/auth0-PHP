<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListUserConsentSigningKeysResponseContent extends JsonSerializableType
{
    /**
     * @var array<ConsentSigningKey> $keys The consent signing keys registered for the user.
     */
    #[JsonProperty('keys'), ArrayType([ConsentSigningKey::class])]
    private array $keys;

    /**
     * @param array{
     *   keys: array<ConsentSigningKey>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->keys = $values['keys'];
    }

    /**
     * @return array<ConsentSigningKey>
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * @param array<ConsentSigningKey> $value
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
