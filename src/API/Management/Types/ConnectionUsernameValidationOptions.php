<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ConnectionUsernameValidationOptions extends JsonSerializableType
{
    /**
     * @var int $min
     */
    #[JsonProperty('min')]
    private int $min;

    /**
     * @var int $max
     */
    #[JsonProperty('max')]
    private int $max;

    /**
     * @param array{
     *   min: int,
     *   max: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->min = $values['min'];
        $this->max = $values['max'];
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param int $value
     */
    public function setMin(int $value): self
    {
        $this->min = $value;
        $this->_setField('min');
        return $this;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $value
     */
    public function setMax(int $value): self
    {
        $this->max = $value;
        $this->_setField('max');
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
