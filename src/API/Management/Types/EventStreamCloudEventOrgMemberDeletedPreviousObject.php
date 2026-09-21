<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content as it was prior to the change described by this event, when applicable.
 */
class EventStreamCloudEventOrgMemberDeletedPreviousObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberDeletedPreviousObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgMemberDeletedPreviousObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgMemberDeletedPreviousObjectUser $user
     */
    #[JsonProperty('user')]
    private EventStreamCloudEventOrgMemberDeletedPreviousObjectUser $user;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgMemberDeletedPreviousObjectOrganization,
     *   user: EventStreamCloudEventOrgMemberDeletedPreviousObjectUser,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->user = $values['user'];
    }

    /**
     * @return EventStreamCloudEventOrgMemberDeletedPreviousObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgMemberDeletedPreviousObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgMemberDeletedPreviousObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgMemberDeletedPreviousObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberDeletedPreviousObjectUser
     */
    public function getUser(): EventStreamCloudEventOrgMemberDeletedPreviousObjectUser
    {
        return $this->user;
    }

    /**
     * @param EventStreamCloudEventOrgMemberDeletedPreviousObjectUser $value
     */
    public function setUser(EventStreamCloudEventOrgMemberDeletedPreviousObjectUser $value): self
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
