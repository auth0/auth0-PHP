<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class SegmentContainsExpression extends JsonSerializableType
{
    /**
     * @var array<string> $contains
     */
    #[JsonProperty('contains'), ArrayType(['string'])]
    private array $contains;

    /**
     * @param array{
     *   contains: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->contains = $values['contains'];
    }

    /**
     * @return array<string>
     */
    public function getContains(): array
    {
        return $this->contains;
    }

    /**
     * @param array<string> $value
     */
    public function setContains(array $value): self
    {
        $this->contains = $value;
        $this->_setField('contains');
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
