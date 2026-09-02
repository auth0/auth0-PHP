<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content as it was prior to the change described by this event, when applicable.
 */
class EventStreamCloudEventOrgMemberRoleAssignedPreviousObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectUser $user
     */
    #[JsonProperty('user')]
    private EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectUser $user;

    /**
     * @var EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectRole $role;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectOrganization,
     *   user: EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectUser,
     *   role: EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectRole,
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
     * @return EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectUser
     */
    public function getUser(): EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectUser
    {
        return $this->user;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectUser $value
     */
    public function setUser(EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectUser $value): self
    {
        $this->user = $value;
        $this->_setField('user');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectRole
     */
    public function getRole(): EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectRole $value
     */
    public function setRole(EventStreamCloudEventOrgMemberRoleAssignedPreviousObjectRole $value): self
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
