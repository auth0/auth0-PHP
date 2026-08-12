<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionJsonCreateJsonParams extends JsonSerializableType
{
    /**
     * @var array<string, mixed> $object
     */
    #[JsonProperty('object'), ArrayType(['string' => 'mixed'])]
    private array $object;

    /**
     * @param array{
     *   object: array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->object = $values['object'];
    }

    /**
     * @return array<string, mixed>
     */
    public function getObject(): array
    {
        return $this->object;
    }

    /**
     * @param array<string, mixed> $value
     */
    public function setObject(array $value): self
    {
        $this->object = $value;
        $this->_setField('object');
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
