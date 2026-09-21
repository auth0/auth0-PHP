<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event content as it was prior to the change described by this event, when applicable.
 */
class EventStreamCloudEventGroupMemberAddedPreviousObject extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupMemberAddedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventGroupMemberAddedPreviousObjectGroup0::class, EventStreamCloudEventGroupMemberAddedPreviousObjectGroup1::class, EventStreamCloudEventGroupMemberAddedPreviousObjectGroup2::class)]
    private EventStreamCloudEventGroupMemberAddedPreviousObjectGroup0|EventStreamCloudEventGroupMemberAddedPreviousObjectGroup1|EventStreamCloudEventGroupMemberAddedPreviousObjectGroup2 $group;

    /**
     * @var (
     *    EventStreamCloudEventGroupMemberAddedPreviousObjectMember0
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectMember1
     * ) $member
     */
    #[JsonProperty('member'), Union(EventStreamCloudEventGroupMemberAddedPreviousObjectMember0::class, EventStreamCloudEventGroupMemberAddedPreviousObjectMember1::class)]
    private EventStreamCloudEventGroupMemberAddedPreviousObjectMember0|EventStreamCloudEventGroupMemberAddedPreviousObjectMember1 $member;

    /**
     * @param array{
     *   group: (
     *    EventStreamCloudEventGroupMemberAddedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectGroup2
     * ),
     *   member: (
     *    EventStreamCloudEventGroupMemberAddedPreviousObjectMember0
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectMember1
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
     *    EventStreamCloudEventGroupMemberAddedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventGroupMemberAddedPreviousObjectGroup0|EventStreamCloudEventGroupMemberAddedPreviousObjectGroup1|EventStreamCloudEventGroupMemberAddedPreviousObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupMemberAddedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventGroupMemberAddedPreviousObjectGroup0|EventStreamCloudEventGroupMemberAddedPreviousObjectGroup1|EventStreamCloudEventGroupMemberAddedPreviousObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventGroupMemberAddedPreviousObjectMember0
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectMember1
     * )
     */
    public function getMember(): EventStreamCloudEventGroupMemberAddedPreviousObjectMember0|EventStreamCloudEventGroupMemberAddedPreviousObjectMember1
    {
        return $this->member;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupMemberAddedPreviousObjectMember0
     *   |EventStreamCloudEventGroupMemberAddedPreviousObjectMember1
     * ) $value
     */
    public function setMember(EventStreamCloudEventGroupMemberAddedPreviousObjectMember0|EventStreamCloudEventGroupMemberAddedPreviousObjectMember1 $value): self
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
