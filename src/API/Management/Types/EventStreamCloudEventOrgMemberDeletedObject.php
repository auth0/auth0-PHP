<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content.
 */
class EventStreamCloudEventOrgMemberDeletedObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberDeletedObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgMemberDeletedObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgMemberDeletedObjectUser $user
     */
    #[JsonProperty('user')]
    private EventStreamCloudEventOrgMemberDeletedObjectUser $user;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgMemberDeletedObjectOrganization,
     *   user: EventStreamCloudEventOrgMemberDeletedObjectUser,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->user = $values['user'];
    }

    /**
     * @return EventStreamCloudEventOrgMemberDeletedObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgMemberDeletedObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgMemberDeletedObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgMemberDeletedObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberDeletedObjectUser
     */
    public function getUser(): EventStreamCloudEventOrgMemberDeletedObjectUser
    {
        return $this->user;
    }

    /**
     * @param EventStreamCloudEventOrgMemberDeletedObjectUser $value
     */
    public function setUser(EventStreamCloudEventOrgMemberDeletedObjectUser $value): self
    {
        $this->user = $value;
        $this->_setField('user');
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
