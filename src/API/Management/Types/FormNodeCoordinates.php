<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormNodeCoordinates extends JsonSerializableType
{
    /**
     * @var int $x
     */
    #[JsonProperty('x')]
    private int $x;

    /**
     * @var int $y
     */
    #[JsonProperty('y')]
    private int $y;

    /**
     * @param array{
     *   x: int,
     *   y: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->x = $values['x'];
        $this->y = $values['y'];
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $value
     */
    public function setX(int $value): self
    {
        $this->x = $value;
        $this->_setField('x');
        return $this;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $value
     */
    public function setY(int $value): self
    {
        $this->y = $value;
        $this->_setField('y');
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
