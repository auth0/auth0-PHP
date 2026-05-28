<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * The event content.
 */
class EventStreamCloudEventGroupRoleAssignedObject extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupRoleAssignedObjectGroup0
     *   |EventStreamCloudEventGroupRoleAssignedObjectGroup1
     *   |EventStreamCloudEventGroupRoleAssignedObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventGroupRoleAssignedObjectGroup0::class, EventStreamCloudEventGroupRoleAssignedObjectGroup1::class, EventStreamCloudEventGroupRoleAssignedObjectGroup2::class)]
    private EventStreamCloudEventGroupRoleAssignedObjectGroup0|EventStreamCloudEventGroupRoleAssignedObjectGroup1|EventStreamCloudEventGroupRoleAssignedObjectGroup2 $group;

    /**
     * @var EventStreamCloudEventGroupRoleAssignedObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventGroupRoleAssignedObjectRole $role;

    /**
     * @var DateTime $createdAt The time at which the role was assigned to the group.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @param array{
     *   group: (
     *    EventStreamCloudEventGroupRoleAssignedObjectGroup0
     *   |EventStreamCloudEventGroupRoleAssignedObjectGroup1
     *   |EventStreamCloudEventGroupRoleAssignedObjectGroup2
     * ),
     *   role: EventStreamCloudEventGroupRoleAssignedObjectRole,
     *   createdAt: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->group = $values['group'];
        $this->role = $values['role'];
        $this->createdAt = $values['createdAt'];
    }

    /**
     * @return (
     *    EventStreamCloudEventGroupRoleAssignedObjectGroup0
     *   |EventStreamCloudEventGroupRoleAssignedObjectGroup1
     *   |EventStreamCloudEventGroupRoleAssignedObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventGroupRoleAssignedObjectGroup0|EventStreamCloudEventGroupRoleAssignedObjectGroup1|EventStreamCloudEventGroupRoleAssignedObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupRoleAssignedObjectGroup0
     *   |EventStreamCloudEventGroupRoleAssignedObjectGroup1
     *   |EventStreamCloudEventGroupRoleAssignedObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventGroupRoleAssignedObjectGroup0|EventStreamCloudEventGroupRoleAssignedObjectGroup1|EventStreamCloudEventGroupRoleAssignedObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
        return $this;
    }

    /**
     * @return EventStreamCloudEventGroupRoleAssignedObjectRole
     */
    public function getRole(): EventStreamCloudEventGroupRoleAssignedObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventGroupRoleAssignedObjectRole $value
     */
    public function setRole(EventStreamCloudEventGroupRoleAssignedObjectRole $value): self
    {
        $this->role = $value;
        $this->_setField('role');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
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
