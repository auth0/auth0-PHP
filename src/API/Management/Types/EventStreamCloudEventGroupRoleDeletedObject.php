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
class EventStreamCloudEventGroupRoleDeletedObject extends JsonSerializableType
{
    /**
     * @var (
     *    EventStreamCloudEventGroupRoleDeletedObjectGroup0
     *   |EventStreamCloudEventGroupRoleDeletedObjectGroup1
     *   |EventStreamCloudEventGroupRoleDeletedObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventGroupRoleDeletedObjectGroup0::class, EventStreamCloudEventGroupRoleDeletedObjectGroup1::class, EventStreamCloudEventGroupRoleDeletedObjectGroup2::class)]
    private EventStreamCloudEventGroupRoleDeletedObjectGroup0|EventStreamCloudEventGroupRoleDeletedObjectGroup1|EventStreamCloudEventGroupRoleDeletedObjectGroup2 $group;

    /**
     * @var EventStreamCloudEventGroupRoleDeletedObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventGroupRoleDeletedObjectRole $role;

    /**
     * @var DateTime $deletedAt The time at which the role was removed from the group.
     */
    #[JsonProperty('deleted_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $deletedAt;

    /**
     * @param array{
     *   group: (
     *    EventStreamCloudEventGroupRoleDeletedObjectGroup0
     *   |EventStreamCloudEventGroupRoleDeletedObjectGroup1
     *   |EventStreamCloudEventGroupRoleDeletedObjectGroup2
     * ),
     *   role: EventStreamCloudEventGroupRoleDeletedObjectRole,
     *   deletedAt: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->group = $values['group'];
        $this->role = $values['role'];
        $this->deletedAt = $values['deletedAt'];
    }

    /**
     * @return (
     *    EventStreamCloudEventGroupRoleDeletedObjectGroup0
     *   |EventStreamCloudEventGroupRoleDeletedObjectGroup1
     *   |EventStreamCloudEventGroupRoleDeletedObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventGroupRoleDeletedObjectGroup0|EventStreamCloudEventGroupRoleDeletedObjectGroup1|EventStreamCloudEventGroupRoleDeletedObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventGroupRoleDeletedObjectGroup0
     *   |EventStreamCloudEventGroupRoleDeletedObjectGroup1
     *   |EventStreamCloudEventGroupRoleDeletedObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventGroupRoleDeletedObjectGroup0|EventStreamCloudEventGroupRoleDeletedObjectGroup1|EventStreamCloudEventGroupRoleDeletedObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
        return $this;
    }

    /**
     * @return EventStreamCloudEventGroupRoleDeletedObjectRole
     */
    public function getRole(): EventStreamCloudEventGroupRoleDeletedObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventGroupRoleDeletedObjectRole $value
     */
    public function setRole(EventStreamCloudEventGroupRoleDeletedObjectRole $value): self
    {
        $this->role = $value;
        $this->_setField('role');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDeletedAt(): DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setDeletedAt(DateTime $value): self
    {
        $this->deletedAt = $value;
        $this->_setField('deletedAt');
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
