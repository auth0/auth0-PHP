<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListActionTriggersResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<ActionTrigger> $triggers
     */
    #[JsonProperty('triggers'), ArrayType([ActionTrigger::class])]
    private ?array $triggers;

    /**
     * @param array{
     *   triggers?: ?array<ActionTrigger>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->triggers = $values['triggers'] ?? null;
    }

    /**
     * @return ?array<ActionTrigger>
     */
    public function getTriggers(): ?array
    {
        return $this->triggers;
    }

    /**
     * @param ?array<ActionTrigger> $value
     */
    public function setTriggers(?array $value = null): self
    {
        $this->triggers = $value;
        $this->_setField('triggers');
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
