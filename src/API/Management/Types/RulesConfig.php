<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class RulesConfig extends JsonSerializableType
{
    /**
     * @var ?string $key Key for a rules config variable.
     */
    #[JsonProperty('key')]
    private ?string $key;

    /**
     * @param array{
     *   key?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->key = $values['key'] ?? null;
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
