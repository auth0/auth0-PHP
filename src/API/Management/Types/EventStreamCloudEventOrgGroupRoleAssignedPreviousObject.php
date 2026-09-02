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
class EventStreamCloudEventOrgGroupRoleAssignedPreviousObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectRole $role;

    /**
     * @var (
     *    EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup0::class, EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup1::class, EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup2::class)]
    private EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup0|EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup1|EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup2 $group;

    /**
     * @var DateTime $createdAt The time at which the role was assigned to the group in the organization.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectOrganization,
     *   role: EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectRole,
     *   group: (
     *    EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup2
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
     * @return EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectRole
     */
    public function getRole(): EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectRole $value
     */
    public function setRole(EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectRole $value): self
    {
        $this->role = $value;
        $this->_setField('role');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup0|EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup1|EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup0|EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup1|EventStreamCloudEventOrgGroupRoleAssignedPreviousObjectGroup2 $value): self
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
