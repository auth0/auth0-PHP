<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * The event content as it was prior to the change described by this event, when applicable.
 */
class EventStreamCloudEventGroupRoleAssignedPreviousObject extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup0::class, EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup1::class, EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup2::class)]
    private EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup0|EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup1|EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup2 $group;

    /**
     * @var EventStreamCloudEventGroupRoleAssignedPreviousObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventGroupRoleAssignedPreviousObjectRole $role;

    /**
     * @var DateTime $createdAt The time at which the role was assigned to the group.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @param array{
     *   group: (
     *    EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup2
     * ),
     *   role: EventStreamCloudEventGroupRoleAssignedPreviousObjectRole,
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
     *    EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup0|EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup1|EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup0|EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup1|EventStreamCloudEventGroupRoleAssignedPreviousObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
        return $this;
    }

    /**
     * @return EventStreamCloudEventGroupRoleAssignedPreviousObjectRole
     */
    public function getRole(): EventStreamCloudEventGroupRoleAssignedPreviousObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventGroupRoleAssignedPreviousObjectRole $value
     */
    public function setRole(EventStreamCloudEventGroupRoleAssignedPreviousObjectRole $value): self
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
