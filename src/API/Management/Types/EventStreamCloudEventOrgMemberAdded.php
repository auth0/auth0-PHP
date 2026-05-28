<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * SSE message for organization.member.added.
 */
class EventStreamCloudEventOrgMemberAdded extends JsonSerializableType
{
    /**
     * @var string $offset Opaque cursor representing position in the stream. Pass as the `from` query parameter to resume.
     */
    #[JsonProperty('offset')]
    private string $offset;

    /**
     * @var EventStreamCloudEventOrgMemberAddedCloudEvent $event
     */
    #[JsonProperty('event')]
    private EventStreamCloudEventOrgMemberAddedCloudEvent $event;

    /**
     * @param array{
     *   offset: string,
     *   event: EventStreamCloudEventOrgMemberAddedCloudEvent,
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
     * @return EventStreamCloudEventOrgMemberAddedCloudEvent
     */
    public function getEvent(): EventStreamCloudEventOrgMemberAddedCloudEvent
    {
        return $this->event;
    }

    /**
     * @param EventStreamCloudEventOrgMemberAddedCloudEvent $value
     */
    public function setEvent(EventStreamCloudEventOrgMemberAddedCloudEvent $value): self
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
