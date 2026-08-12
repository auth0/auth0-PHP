<?php

namespace Auth0\SDK\API\Management\Actions\Triggers\Bindings\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\ActionBindingWithRef;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateActionBindingsRequestContent extends JsonSerializableType
{
    /**
     * @var ?array<ActionBindingWithRef> $bindings The actions that will be bound to this trigger. The order in which they are included will be the order in which they are executed.
     */
    #[JsonProperty('bindings'), ArrayType([ActionBindingWithRef::class])]
    private ?array $bindings;

    /**
     * @param array{
     *   bindings?: ?array<ActionBindingWithRef>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->bindings = $values['bindings'] ?? null;
    }

    /**
     * @return ?array<ActionBindingWithRef>
     */
    public function getBindings(): ?array
    {
        return $this->bindings;
    }

    /**
     * @param ?array<ActionBindingWithRef> $value
     */
    public function setBindings(?array $value = null): self
    {
        $this->bindings = $value;
        $this->_setField('bindings');
        return $this;
    }
}
