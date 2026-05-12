<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * SSE message for group.member.added.
 */
class EventStreamCloudEventGroupMemberAdded extends JsonSerializableType
{
    /**
     * @var string $offset Opaque cursor representing position in the stream. Pass as the `from` query parameter to resume.
     */
    #[JsonProperty('offset')]
    private string $offset;

    /**
     * @var EventStreamCloudEventGroupMemberAddedCloudEvent $event
     */
    #[JsonProperty('event')]
    private EventStreamCloudEventGroupMemberAddedCloudEvent $event;

    /**
     * @param array{
     *   offset: string,
     *   event: EventStreamCloudEventGroupMemberAddedCloudEvent,
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
     * @return EventStreamCloudEventGroupMemberAddedCloudEvent
     */
    public function getEvent(): EventStreamCloudEventGroupMemberAddedCloudEvent
    {
        return $this->event;
    }

    /**
     * @param EventStreamCloudEventGroupMemberAddedCloudEvent $value
     */
    public function setEvent(EventStreamCloudEventGroupMemberAddedCloudEvent $value): self
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
