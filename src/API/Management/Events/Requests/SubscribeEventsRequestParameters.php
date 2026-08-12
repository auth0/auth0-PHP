<?php

namespace Auth0\SDK\API\Management\Events\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\EventStreamSubscribeEventsEventTypeEnum;

class SubscribeEventsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $from Opaque token representing position in the stream. If not provided, stream will start from the latest events.
     */
    private ?string $from;

    /**
     * @var ?string $fromTimestamp RFC-3339 timestamp indicating where to start streaming events from. This should only be used on the initial query when a cursor may not be available. Subsequent requests should use the cursor (from) as it will be more accurate.
     */
    private ?string $fromTimestamp;

    /**
     * @var ?array<?value-of<EventStreamSubscribeEventsEventTypeEnum>> $eventType Event type(s) to listen for. Specify multiple times for multiple types (e.g., ?event_type=user.created&event_type=user.updated). If not provided, all event types will be streamed.
     */
    private ?array $eventType;

    /**
     * @param array{
     *   from?: ?string,
     *   fromTimestamp?: ?string,
     *   eventType?: ?array<?value-of<EventStreamSubscribeEventsEventTypeEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->from = $values['from'] ?? null;
        $this->fromTimestamp = $values['fromTimestamp'] ?? null;
        $this->eventType = $values['eventType'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFromTimestamp(): ?string
    {
        return $this->fromTimestamp;
    }

    /**
     * @param ?string $value
     */
    public function setFromTimestamp(?string $value = null): self
    {
        $this->fromTimestamp = $value;
        $this->_setField('fromTimestamp');
        return $this;
    }

    /**
     * @return ?array<?value-of<EventStreamSubscribeEventsEventTypeEnum>>
     */
    public function getEventType(): ?array
    {
        return $this->eventType;
    }

    /**
     * @param ?array<?value-of<EventStreamSubscribeEventsEventTypeEnum>> $value
     */
    public function setEventType(?array $value = null): self
    {
        $this->eventType = $value;
        $this->_setField('eventType');
        return $this;
    }
}
