<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateActionBindingsResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<ActionBinding> $bindings
     */
    #[JsonProperty('bindings'), ArrayType([ActionBinding::class])]
    private ?array $bindings;

    /**
     * @param array{
     *   bindings?: ?array<ActionBinding>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->bindings = $values['bindings'] ?? null;
    }

    /**
     * @return ?array<ActionBinding>
     */
    public function getBindings(): ?array
    {
        return $this->bindings;
    }

    /**
     * @param ?array<ActionBinding> $value
     */
    public function setBindings(?array $value = null): self
    {
        $this->bindings = $value;
        $this->_setField('bindings');
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
