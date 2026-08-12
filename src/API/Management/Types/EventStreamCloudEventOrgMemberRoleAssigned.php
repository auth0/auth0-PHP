<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * SSE message for organization.member.role.assigned.
 */
class EventStreamCloudEventOrgMemberRoleAssigned extends JsonSerializableType
{
    /**
     * @var string $offset Opaque cursor representing position in the stream. Pass as the `from` query parameter to resume.
     */
    #[JsonProperty('offset')]
    private string $offset;

    /**
     * @var EventStreamCloudEventOrgMemberRoleAssignedCloudEvent $event
     */
    #[JsonProperty('event')]
    private EventStreamCloudEventOrgMemberRoleAssignedCloudEvent $event;

    /**
     * @param array{
     *   offset: string,
     *   event: EventStreamCloudEventOrgMemberRoleAssignedCloudEvent,
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
     * @return EventStreamCloudEventOrgMemberRoleAssignedCloudEvent
     */
    public function getEvent(): EventStreamCloudEventOrgMemberRoleAssignedCloudEvent
    {
        return $this->event;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleAssignedCloudEvent $value
     */
    public function setEvent(EventStreamCloudEventOrgMemberRoleAssignedCloudEvent $value): self
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
