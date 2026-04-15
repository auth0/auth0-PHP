<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class ListEventStreamsResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<(
     *    EventStreamWebhookResponseContent
     *   |EventStreamEventBridgeResponseContent
     *   |EventStreamActionResponseContent
     * )> $eventStreams
     */
    #[JsonProperty('eventStreams'), ArrayType([new Union(EventStreamWebhookResponseContent::class, EventStreamEventBridgeResponseContent::class, EventStreamActionResponseContent::class)])]
    private ?array $eventStreams;

    /**
     * @var ?string $next Opaque identifier for use with the <i>from</i> query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   eventStreams?: ?array<(
     *    EventStreamWebhookResponseContent
     *   |EventStreamEventBridgeResponseContent
     *   |EventStreamActionResponseContent
     * )>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->eventStreams = $values['eventStreams'] ?? null;
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return ?array<(
     *    EventStreamWebhookResponseContent
     *   |EventStreamEventBridgeResponseContent
     *   |EventStreamActionResponseContent
     * )>
     */
    public function getEventStreams(): ?array
    {
        return $this->eventStreams;
    }

    /**
     * @param ?array<(
     *    EventStreamWebhookResponseContent
     *   |EventStreamEventBridgeResponseContent
     *   |EventStreamActionResponseContent
     * )> $value
     */
    public function setEventStreams(?array $value = null): self
    {
        $this->eventStreams = $value;
        $this->_setField('eventStreams');
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
