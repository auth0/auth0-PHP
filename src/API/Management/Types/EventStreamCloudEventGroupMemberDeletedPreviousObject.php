<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event content as it was prior to the change described by this event, when applicable.
 */
class EventStreamCloudEventGroupMemberDeletedPreviousObject extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup0::class, EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup1::class, EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup2::class)]
    private EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup0|EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup1|EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup2 $group;

    /**
     * @var (
     *    EventStreamCloudEventGroupMemberDeletedPreviousObjectMember0
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectMember1
     * ) $member
     */
    #[JsonProperty('member'), Union(EventStreamCloudEventGroupMemberDeletedPreviousObjectMember0::class, EventStreamCloudEventGroupMemberDeletedPreviousObjectMember1::class)]
    private EventStreamCloudEventGroupMemberDeletedPreviousObjectMember0|EventStreamCloudEventGroupMemberDeletedPreviousObjectMember1 $member;

    /**
     * @param array{
     *   group: (
     *    EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup2
     * ),
     *   member: (
     *    EventStreamCloudEventGroupMemberDeletedPreviousObjectMember0
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectMember1
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->group = $values['group'];
        $this->member = $values['member'];
    }

    /**
     * @return (
     *    EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup0|EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup1|EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup0|EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup1|EventStreamCloudEventGroupMemberDeletedPreviousObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventGroupMemberDeletedPreviousObjectMember0
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectMember1
     * )
     */
    public function getMember(): EventStreamCloudEventGroupMemberDeletedPreviousObjectMember0|EventStreamCloudEventGroupMemberDeletedPreviousObjectMember1
    {
        return $this->member;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupMemberDeletedPreviousObjectMember0
     *   |EventStreamCloudEventGroupMemberDeletedPreviousObjectMember1
     * ) $value
     */
    public function setMember(EventStreamCloudEventGroupMemberDeletedPreviousObjectMember0|EventStreamCloudEventGroupMemberDeletedPreviousObjectMember1 $value): self
    {
        $this->member = $value;
        $this->_setField('member');
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
