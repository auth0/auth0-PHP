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
class EventStreamCloudEventGroupRoleDeletedPreviousObject extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup0::class, EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup1::class, EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup2::class)]
    private EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup0|EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup1|EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup2 $group;

    /**
     * @var EventStreamCloudEventGroupRoleDeletedPreviousObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventGroupRoleDeletedPreviousObjectRole $role;

    /**
     * @var DateTime $createdAt The time at which the role was assigned to the group.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @param array{
     *   group: (
     *    EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup2
     * ),
     *   role: EventStreamCloudEventGroupRoleDeletedPreviousObjectRole,
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
     *    EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup0|EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup1|EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup0|EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup1|EventStreamCloudEventGroupRoleDeletedPreviousObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
        return $this;
    }

    /**
     * @return EventStreamCloudEventGroupRoleDeletedPreviousObjectRole
     */
    public function getRole(): EventStreamCloudEventGroupRoleDeletedPreviousObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventGroupRoleDeletedPreviousObjectRole $value
     */
    public function setRole(EventStreamCloudEventGroupRoleDeletedPreviousObjectRole $value): self
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
