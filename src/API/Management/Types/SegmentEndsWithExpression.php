<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class SegmentEndsWithExpression extends JsonSerializableType
{
    /**
     * @var array<string> $endsWith
     */
    #[JsonProperty('ends_with'), ArrayType(['string'])]
    private array $endsWith;

    /**
     * @param array{
     *   endsWith: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->endsWith = $values['endsWith'];
    }

    /**
     * @return array<string>
     */
    public function getEndsWith(): array
    {
        return $this->endsWith;
    }

    /**
     * @param array<string> $value
     */
    public function setEndsWith(array $value): self
    {
        $this->endsWith = $value;
        $this->_setField('endsWith');
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
