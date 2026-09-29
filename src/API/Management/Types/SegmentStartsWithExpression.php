<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class SegmentStartsWithExpression extends JsonSerializableType
{
    /**
     * @var array<string> $startsWith
     */
    #[JsonProperty('starts_with'), ArrayType(['string'])]
    private array $startsWith;

    /**
     * @param array{
     *   startsWith: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->startsWith = $values['startsWith'];
    }

    /**
     * @return array<string>
     */
    public function getStartsWith(): array
    {
        return $this->startsWith;
    }

    /**
     * @param array<string> $value
     */
    public function setStartsWith(array $value): self
    {
        $this->startsWith = $value;
        $this->_setField('startsWith');
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
