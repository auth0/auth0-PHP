<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListFlowExecutionsPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next Opaque identifier for use with the <i>from</i> query parameter for the next page of results.<br/>This identifier is valid for 24 hours.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<FlowExecutionSummary> $executions
     */
    #[JsonProperty('executions'), ArrayType([FlowExecutionSummary::class])]
    private ?array $executions;

    /**
     * @param array{
     *   next?: ?string,
     *   executions?: ?array<FlowExecutionSummary>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->executions = $values['executions'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @param ?string $value
     */
    public function setNext(?string $value = null): self
    {
        $this->next = $value;
        $this->_setField('next');
        return $this;
    }

    /**
     * @return ?array<FlowExecutionSummary>
     */
    public function getExecutions(): ?array
    {
        return $this->executions;
    }

    /**
     * @param ?array<FlowExecutionSummary> $value
     */
    public function setExecutions(?array $value = null): self
    {
        $this->executions = $value;
        $this->_setField('executions');
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
