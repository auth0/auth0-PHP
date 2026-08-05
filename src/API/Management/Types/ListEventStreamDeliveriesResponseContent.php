<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListEventStreamDeliveriesResponseContent extends JsonSerializableType
{
    /**
     * @var array<EventStreamDelivery> $deliveries List of event stream deliveries
     */
    #[JsonProperty('deliveries'), ArrayType([EventStreamDelivery::class])]
    private array $deliveries;

    /**
     * @var ?string $next The cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   deliveries: array<EventStreamDelivery>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->deliveries = $values['deliveries'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<EventStreamDelivery>
     */
    public function getDeliveries(): array
    {
        return $this->deliveries;
    }

    /**
     * @param array<EventStreamDelivery> $value
     */
    public function setDeliveries(array $value): self
    {
        $this->deliveries = $value;
        $this->_setField('deliveries');
        return $this;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
