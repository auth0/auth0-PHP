<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content as it was prior to the change described by this event, when applicable.
 */
class EventStreamCloudEventOrgMemberRoleDeletedPreviousObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectUser $user
     */
    #[JsonProperty('user')]
    private EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectUser $user;

    /**
     * @var EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectRole $role;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectOrganization,
     *   user: EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectUser,
     *   role: EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectRole,
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
     * @return EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectUser
     */
    public function getUser(): EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectUser
    {
        return $this->user;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectUser $value
     */
    public function setUser(EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectUser $value): self
    {
        $this->user = $value;
        $this->_setField('user');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectRole
     */
    public function getRole(): EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectRole $value
     */
    public function setRole(EventStreamCloudEventOrgMemberRoleDeletedPreviousObjectRole $value): self
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
