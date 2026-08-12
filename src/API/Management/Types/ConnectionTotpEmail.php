<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ConnectionTotpEmail extends JsonSerializableType
{
    /**
     * @var ?int $length
     */
    #[JsonProperty('length')]
    private ?int $length;

    /**
     * @var ?int $timeStep
     */
    #[JsonProperty('time_step')]
    private ?int $timeStep;

    /**
     * @param array{
     *   length?: ?int,
     *   timeStep?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->length = $values['length'] ?? null;
        $this->timeStep = $values['timeStep'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param ?int $value
     */
    public function setLength(?int $value = null): self
    {
        $this->length = $value;
        $this->_setField('length');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTimeStep(): ?int
    {
        return $this->timeStep;
    }

    /**
     * @param ?int $value
     */
    public function setTimeStep(?int $value = null): self
    {
        $this->timeStep = $value;
        $this->_setField('timeStep');
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
