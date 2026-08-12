<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content.
 */
class EventStreamCloudEventOrgMemberRoleAssignedObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberRoleAssignedObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgMemberRoleAssignedObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgMemberRoleAssignedObjectUser $user
     */
    #[JsonProperty('user')]
    private EventStreamCloudEventOrgMemberRoleAssignedObjectUser $user;

    /**
     * @var EventStreamCloudEventOrgMemberRoleAssignedObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventOrgMemberRoleAssignedObjectRole $role;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgMemberRoleAssignedObjectOrganization,
     *   user: EventStreamCloudEventOrgMemberRoleAssignedObjectUser,
     *   role: EventStreamCloudEventOrgMemberRoleAssignedObjectRole,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->user = $values['user'];
        $this->role = $values['role'];
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleAssignedObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgMemberRoleAssignedObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleAssignedObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgMemberRoleAssignedObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleAssignedObjectUser
     */
    public function getUser(): EventStreamCloudEventOrgMemberRoleAssignedObjectUser
    {
        return $this->user;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleAssignedObjectUser $value
     */
    public function setUser(EventStreamCloudEventOrgMemberRoleAssignedObjectUser $value): self
    {
        $this->user = $value;
        $this->_setField('user');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleAssignedObjectRole
     */
    public function getRole(): EventStreamCloudEventOrgMemberRoleAssignedObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleAssignedObjectRole $value
     */
    public function setRole(EventStreamCloudEventOrgMemberRoleAssignedObjectRole $value): self
    {
        $this->role = $value;
        $this->_setField('role');
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
