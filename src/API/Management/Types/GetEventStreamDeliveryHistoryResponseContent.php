<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Metadata about a specific attempt to deliver an event
 */
class GetEventStreamDeliveryHistoryResponseContent extends JsonSerializableType
{
    /**
     * @var string $id Unique identifier for the delivery
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $eventStreamId Unique identifier for the event stream.
     */
    #[JsonProperty('event_stream_id')]
    private string $eventStreamId;

    /**
     * @var value-of<EventStreamDeliveryStatusEnum> $status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @var value-of<EventStreamDeliveryEventTypeEnum> $eventType
     */
    #[JsonProperty('event_type')]
    private string $eventType;

    /**
     * @var array<EventStreamDeliveryAttempt> $attempts Results of delivery attempts
     */
    #[JsonProperty('attempts'), ArrayType([EventStreamDeliveryAttempt::class])]
    private array $attempts;

    /**
     * @var ?EventStreamCloudEvent $event
     */
    #[JsonProperty('event')]
    private ?EventStreamCloudEvent $event;

    /**
     * @param array{
     *   id: string,
     *   eventStreamId: string,
     *   status: value-of<EventStreamDeliveryStatusEnum>,
     *   eventType: value-of<EventStreamDeliveryEventTypeEnum>,
     *   attempts: array<EventStreamDeliveryAttempt>,
     *   event?: ?EventStreamCloudEvent,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->eventStreamId = $values['eventStreamId'];
        $this->status = $values['status'];
        $this->eventType = $values['eventType'];
        $this->attempts = $values['attempts'];
        $this->event = $values['event'] ?? null;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return string
     */
    public function getEventStreamId(): string
    {
        return $this->eventStreamId;
    }

    /**
     * @param string $value
     */
    public function setEventStreamId(string $value): self
    {
        $this->eventStreamId = $value;
        $this->_setField('eventStreamId');
        return $this;
    }

    /**
     * @return value-of<EventStreamDeliveryStatusEnum>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param value-of<EventStreamDeliveryStatusEnum> $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return value-of<EventStreamDeliveryEventTypeEnum>
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }

    /**
     * @param value-of<EventStreamDeliveryEventTypeEnum> $value
     */
    public function setEventType(string $value): self
    {
        $this->eventType = $value;
        $this->_setField('eventType');
        return $this;
    }

    /**
     * @return array<EventStreamDeliveryAttempt>
     */
    public function getAttempts(): array
    {
        return $this->attempts;
    }

    /**
     * @param array<EventStreamDeliveryAttempt> $value
     */
    public function setAttempts(array $value): self
    {
        $this->attempts = $value;
        $this->_setField('attempts');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEvent
     */
    public function getEvent(): ?EventStreamCloudEvent
    {
        return $this->event;
    }

    /**
     * @param ?EventStreamCloudEvent $value
     */
    public function setEvent(?EventStreamCloudEvent $value = null): self
    {
        $this->event = $value;
        $this->_setField('event');
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
