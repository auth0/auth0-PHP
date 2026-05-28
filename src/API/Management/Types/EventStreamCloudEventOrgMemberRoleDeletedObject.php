<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content.
 */
class EventStreamCloudEventOrgMemberRoleDeletedObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberRoleDeletedObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgMemberRoleDeletedObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgMemberRoleDeletedObjectUser $user
     */
    #[JsonProperty('user')]
    private EventStreamCloudEventOrgMemberRoleDeletedObjectUser $user;

    /**
     * @var EventStreamCloudEventOrgMemberRoleDeletedObjectRole $role
     */
    #[JsonProperty('role')]
    private EventStreamCloudEventOrgMemberRoleDeletedObjectRole $role;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgMemberRoleDeletedObjectOrganization,
     *   user: EventStreamCloudEventOrgMemberRoleDeletedObjectUser,
     *   role: EventStreamCloudEventOrgMemberRoleDeletedObjectRole,
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
     * @return EventStreamCloudEventOrgMemberRoleDeletedObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgMemberRoleDeletedObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleDeletedObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgMemberRoleDeletedObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleDeletedObjectUser
     */
    public function getUser(): EventStreamCloudEventOrgMemberRoleDeletedObjectUser
    {
        return $this->user;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleDeletedObjectUser $value
     */
    public function setUser(EventStreamCloudEventOrgMemberRoleDeletedObjectUser $value): self
    {
        $this->user = $value;
        $this->_setField('user');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberRoleDeletedObjectRole
     */
    public function getRole(): EventStreamCloudEventOrgMemberRoleDeletedObjectRole
    {
        return $this->role;
    }

    /**
     * @param EventStreamCloudEventOrgMemberRoleDeletedObjectRole $value
     */
    public function setRole(EventStreamCloudEventOrgMemberRoleDeletedObjectRole $value): self
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
