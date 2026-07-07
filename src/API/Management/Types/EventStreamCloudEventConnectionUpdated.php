<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * SSE message for connection.updated.
 */
class EventStreamCloudEventConnectionUpdated extends JsonSerializableType
{
    /**
     * @var string $offset Opaque cursor representing position in the stream. Pass as the `from` query parameter to resume.
     */
    #[JsonProperty('offset')]
    private string $offset;

    /**
     * @var EventStreamCloudEventConnectionUpdatedCloudEvent $event
     */
    #[JsonProperty('event')]
    private EventStreamCloudEventConnectionUpdatedCloudEvent $event;

    /**
     * @param array{
     *   offset: string,
     *   event: EventStreamCloudEventConnectionUpdatedCloudEvent,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->offset = $values['offset'];
        $this->event = $values['event'];
    }

    /**
     * @return string
     */
    public function getOffset(): string
    {
        return $this->offset;
    }

    /**
     * @param string $value
     */
    public function setOffset(string $value): self
    {
        $this->offset = $value;
        $this->_setField('offset');
        return $this;
    }

    /**
     * @return EventStreamCloudEventConnectionUpdatedCloudEvent
     */
    public function getEvent(): EventStreamCloudEventConnectionUpdatedCloudEvent
    {
        return $this->event;
    }

    /**
     * @param EventStreamCloudEventConnectionUpdatedCloudEvent $value
     */
    public function setEvent(EventStreamCloudEventConnectionUpdatedCloudEvent $value): self
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
