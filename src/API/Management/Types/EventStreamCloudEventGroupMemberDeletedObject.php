<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event content.
 */
class EventStreamCloudEventGroupMemberDeletedObject extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupMemberDeletedObjectGroup0
     *   |EventStreamCloudEventGroupMemberDeletedObjectGroup1
     *   |EventStreamCloudEventGroupMemberDeletedObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventGroupMemberDeletedObjectGroup0::class, EventStreamCloudEventGroupMemberDeletedObjectGroup1::class, EventStreamCloudEventGroupMemberDeletedObjectGroup2::class)]
    private EventStreamCloudEventGroupMemberDeletedObjectGroup0|EventStreamCloudEventGroupMemberDeletedObjectGroup1|EventStreamCloudEventGroupMemberDeletedObjectGroup2 $group;

    /**
     * @var (
     *    EventStreamCloudEventGroupMemberDeletedObjectMember0
     *   |EventStreamCloudEventGroupMemberDeletedObjectMember1
     * ) $member
     */
    #[JsonProperty('member'), Union(EventStreamCloudEventGroupMemberDeletedObjectMember0::class, EventStreamCloudEventGroupMemberDeletedObjectMember1::class)]
    private EventStreamCloudEventGroupMemberDeletedObjectMember0|EventStreamCloudEventGroupMemberDeletedObjectMember1 $member;

    /**
     * @param array{
     *   group: (
     *    EventStreamCloudEventGroupMemberDeletedObjectGroup0
     *   |EventStreamCloudEventGroupMemberDeletedObjectGroup1
     *   |EventStreamCloudEventGroupMemberDeletedObjectGroup2
     * ),
     *   member: (
     *    EventStreamCloudEventGroupMemberDeletedObjectMember0
     *   |EventStreamCloudEventGroupMemberDeletedObjectMember1
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
     *    EventStreamCloudEventGroupMemberDeletedObjectGroup0
     *   |EventStreamCloudEventGroupMemberDeletedObjectGroup1
     *   |EventStreamCloudEventGroupMemberDeletedObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventGroupMemberDeletedObjectGroup0|EventStreamCloudEventGroupMemberDeletedObjectGroup1|EventStreamCloudEventGroupMemberDeletedObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupMemberDeletedObjectGroup0
     *   |EventStreamCloudEventGroupMemberDeletedObjectGroup1
     *   |EventStreamCloudEventGroupMemberDeletedObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventGroupMemberDeletedObjectGroup0|EventStreamCloudEventGroupMemberDeletedObjectGroup1|EventStreamCloudEventGroupMemberDeletedObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventGroupMemberDeletedObjectMember0
     *   |EventStreamCloudEventGroupMemberDeletedObjectMember1
     * )
     */
    public function getMember(): EventStreamCloudEventGroupMemberDeletedObjectMember0|EventStreamCloudEventGroupMemberDeletedObjectMember1
    {
        return $this->member;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupMemberDeletedObjectMember0
     *   |EventStreamCloudEventGroupMemberDeletedObjectMember1
     * ) $value
     */
    public function setMember(EventStreamCloudEventGroupMemberDeletedObjectMember0|EventStreamCloudEventGroupMemberDeletedObjectMember1 $value): self
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
