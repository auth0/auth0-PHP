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
class EventStreamCloudEventOrgGroupRoleAssignedObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgGroupRoleAssignedObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgGroupRoleAssignedObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgGroupRoleAssignedObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventOrgGroupRoleAssignedObjectRole $role;

    /**
     * @var (
     *    EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleAssignedObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleAssignedObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0::class, EventStreamCloudEventOrgGroupRoleAssignedObjectGroup1::class, EventStreamCloudEventOrgGroupRoleAssignedObjectGroup2::class)]
    private EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0|EventStreamCloudEventOrgGroupRoleAssignedObjectGroup1|EventStreamCloudEventOrgGroupRoleAssignedObjectGroup2 $group;

    /**
     * @var DateTime $createdAt The time at which the role was assigned to the group in the organization.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgGroupRoleAssignedObjectOrganization,
     *   role: EventStreamCloudEventOrgGroupRoleAssignedObjectRole,
     *   group: (
     *    EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleAssignedObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleAssignedObjectGroup2
     * ),
     *   createdAt: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->role = $values['role'];
        $this->group = $values['group'];
        $this->createdAt = $values['createdAt'];
    }

    /**
     * @return EventStreamCloudEventOrgGroupRoleAssignedObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgGroupRoleAssignedObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleAssignedObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgGroupRoleAssignedObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgGroupRoleAssignedObjectRole
     */
    public function getRole(): EventStreamCloudEventOrgGroupRoleAssignedObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleAssignedObjectRole $value
     */
    public function setRole(EventStreamCloudEventOrgGroupRoleAssignedObjectRole $value): self
    {
        $this->role = $value;
        $this->_setField('role');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleAssignedObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleAssignedObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0|EventStreamCloudEventOrgGroupRoleAssignedObjectGroup1|EventStreamCloudEventOrgGroupRoleAssignedObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleAssignedObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleAssignedObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0|EventStreamCloudEventOrgGroupRoleAssignedObjectGroup1|EventStreamCloudEventOrgGroupRoleAssignedObjectGroup2 $value): self
    {
        $this->group = $value;
        $this->_setField('group');
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
