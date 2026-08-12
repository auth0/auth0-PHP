<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event content.
 */
class EventStreamCloudEventGroupMemberAddedObject extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupMemberAddedObjectGroup0
     *   |EventStreamCloudEventGroupMemberAddedObjectGroup1
     *   |EventStreamCloudEventGroupMemberAddedObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventGroupMemberAddedObjectGroup0::class, EventStreamCloudEventGroupMemberAddedObjectGroup1::class, EventStreamCloudEventGroupMemberAddedObjectGroup2::class)]
    private EventStreamCloudEventGroupMemberAddedObjectGroup0|EventStreamCloudEventGroupMemberAddedObjectGroup1|EventStreamCloudEventGroupMemberAddedObjectGroup2 $group;

    /**
     * @var (
     *    EventStreamCloudEventGroupMemberAddedObjectMember0
     *   |EventStreamCloudEventGroupMemberAddedObjectMember1
     * ) $member
     */
    #[JsonProperty('member'), Union(EventStreamCloudEventGroupMemberAddedObjectMember0::class, EventStreamCloudEventGroupMemberAddedObjectMember1::class)]
    private EventStreamCloudEventGroupMemberAddedObjectMember0|EventStreamCloudEventGroupMemberAddedObjectMember1 $member;

    /**
     * @param array{
     *   group: (
     *    EventStreamCloudEventGroupMemberAddedObjectGroup0
     *   |EventStreamCloudEventGroupMemberAddedObjectGroup1
     *   |EventStreamCloudEventGroupMemberAddedObjectGroup2
     * ),
     *   member: (
     *    EventStreamCloudEventGroupMemberAddedObjectMember0
     *   |EventStreamCloudEventGroupMemberAddedObjectMember1
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
     *    EventStreamCloudEventGroupMemberAddedObjectGroup0
     *   |EventStreamCloudEventGroupMemberAddedObjectGroup1
     *   |EventStreamCloudEventGroupMemberAddedObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventGroupMemberAddedObjectGroup0|EventStreamCloudEventGroupMemberAddedObjectGroup1|EventStreamCloudEventGroupMemberAddedObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupMemberAddedObjectGroup0
     *   |EventStreamCloudEventGroupMemberAddedObjectGroup1
     *   |EventStreamCloudEventGroupMemberAddedObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventGroupMemberAddedObjectGroup0|EventStreamCloudEventGroupMemberAddedObjectGroup1|EventStreamCloudEventGroupMemberAddedObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventGroupMemberAddedObjectMember0
     *   |EventStreamCloudEventGroupMemberAddedObjectMember1
     * )
     */
    public function getMember(): EventStreamCloudEventGroupMemberAddedObjectMember0|EventStreamCloudEventGroupMemberAddedObjectMember1
    {
        return $this->member;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupMemberAddedObjectMember0
     *   |EventStreamCloudEventGroupMemberAddedObjectMember1
     * ) $value
     */
    public function setMember(EventStreamCloudEventGroupMemberAddedObjectMember0|EventStreamCloudEventGroupMemberAddedObjectMember1 $value): self
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
