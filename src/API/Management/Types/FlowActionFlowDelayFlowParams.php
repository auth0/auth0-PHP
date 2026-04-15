<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class FlowActionFlowDelayFlowParams extends JsonSerializableType
{
    /**
     * @var (
     *    int
     *   |string
     * ) $number
     */
    #[JsonProperty('number'), Union('integer', 'string')]
    private int|string $number;

    /**
     * @var ?value-of<FlowActionFlowDelayFlowParamsUnits> $units
     */
    #[JsonProperty('units')]
    private ?string $units;

    /**
     * @param array{
     *   number: (
     *    int
     *   |string
     * ),
     *   units?: ?value-of<FlowActionFlowDelayFlowParamsUnits>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->number = $values['number'];
        $this->units = $values['units'] ?? null;
    }

    /**
     * @return (
     *    int
     *   |string
     * )
     */
    public function getNumber(): int|string
    {
        return $this->number;
    }

    /**
     * @param (
     *    int
     *   |string
     * ) $value
     */
    public function setNumber(int|string $value): self
    {
        $this->number = $value;
        $this->_setField('number');
        return $this;
    }

    /**
     * @return ?value-of<FlowActionFlowDelayFlowParamsUnits>
     */
    public function getUnits(): ?string
    {
        return $this->units;
    }

    /**
     * @param ?value-of<FlowActionFlowDelayFlowParamsUnits> $value
     */
    public function setUnits(?string $value = null): self
    {
        $this->units = $value;
        $this->_setField('units');
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
