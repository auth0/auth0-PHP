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
class EventStreamCloudEventOrgGroupRoleDeletedPreviousObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectRole $role;

    /**
     * @var (
     *    EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup2
     * ) $group
     */
    #[JsonProperty('group'), Union(EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup0::class, EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup1::class, EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup2::class)]
    private EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup0|EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup1|EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup2 $group;

    /**
     * @var DateTime $createdAt The time at which the role was assigned to the group in the organization.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectOrganization,
     *   role: EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectRole,
     *   group: (
     *    EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup2
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
     * @return EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectRole
     */
    public function getRole(): EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectRole $value
     */
    public function setRole(EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectRole $value): self
    {
        $this->role = $value;
        $this->_setField('role');
        return $this;
    }

    /**
     * @return (
     *    EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup2
     * )
     */
    public function getGroup(): EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup0|EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup1|EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup2
    {
        return $this->group;
    }

    /**
     * @param (
     *    EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup0
     *   |EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup1
     *   |EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup2
     * ) $value
     */
    public function setGroup(EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup0|EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup1|EventStreamCloudEventOrgGroupRoleDeletedPreviousObjectGroup2 $value): self
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
