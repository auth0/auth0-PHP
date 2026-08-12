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
class EventStreamCloudEventOrgGroupRoleDeletedObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgGroupRoleDeletedObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgGroupRoleDeletedObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgGroupRoleDeletedObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventOrgGroupRoleDeletedObjectRole $role;

    /**
     * @var (
     *    EventStreamCloudEventOrgGroupRoleDeletedObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleDeletedObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleDeletedObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventOrgGroupRoleDeletedObjectGroup0::class, EventStreamCloudEventOrgGroupRoleDeletedObjectGroup1::class, EventStreamCloudEventOrgGroupRoleDeletedObjectGroup2::class)]
    private EventStreamCloudEventOrgGroupRoleDeletedObjectGroup0|EventStreamCloudEventOrgGroupRoleDeletedObjectGroup1|EventStreamCloudEventOrgGroupRoleDeletedObjectGroup2 $group;

    /**
     * @var DateTime $deletedAt The time at which the role was removed from the group in the organization.
     */
    #[JsonProperty('deleted_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $deletedAt;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgGroupRoleDeletedObjectOrganization,
     *   role: EventStreamCloudEventOrgGroupRoleDeletedObjectRole,
     *   group: (
     *    EventStreamCloudEventOrgGroupRoleDeletedObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleDeletedObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleDeletedObjectGroup2
     * ),
     *   deletedAt: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->role = $values['role'];
        $this->group = $values['group'];
        $this->deletedAt = $values['deletedAt'];
    }

    /**
     * @return EventStreamCloudEventOrgGroupRoleDeletedObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgGroupRoleDeletedObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleDeletedObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgGroupRoleDeletedObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgGroupRoleDeletedObjectRole
     */
    public function getRole(): EventStreamCloudEventOrgGroupRoleDeletedObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleDeletedObjectRole $value
     */
    public function setRole(EventStreamCloudEventOrgGroupRoleDeletedObjectRole $value): self
    {
        $this->role = $value;
        $this->_setField('role');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventOrgGroupRoleDeletedObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleDeletedObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleDeletedObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventOrgGroupRoleDeletedObjectGroup0|EventStreamCloudEventOrgGroupRoleDeletedObjectGroup1|EventStreamCloudEventOrgGroupRoleDeletedObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventOrgGroupRoleDeletedObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleDeletedObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleDeletedObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventOrgGroupRoleDeletedObjectGroup0|EventStreamCloudEventOrgGroupRoleDeletedObjectGroup1|EventStreamCloudEventOrgGroupRoleDeletedObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
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
