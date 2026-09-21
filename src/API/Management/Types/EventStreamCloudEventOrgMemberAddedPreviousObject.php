<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content as it was prior to the change described by this event, when applicable.
 */
class EventStreamCloudEventOrgMemberAddedPreviousObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberAddedPreviousObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgMemberAddedPreviousObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgMemberAddedPreviousObjectUser $user
     */
    #[JsonProperty('user')]
    private EventStreamCloudEventOrgMemberAddedPreviousObjectUser $user;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgMemberAddedPreviousObjectOrganization,
     *   user: EventStreamCloudEventOrgMemberAddedPreviousObjectUser,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->user = $values['user'];
    }

    /**
     * @return EventStreamCloudEventOrgMemberAddedPreviousObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgMemberAddedPreviousObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgMemberAddedPreviousObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgMemberAddedPreviousObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberAddedPreviousObjectUser
     */
    public function getUser(): EventStreamCloudEventOrgMemberAddedPreviousObjectUser
    {
        return $this->user;
    }

    /**
     * @param EventStreamCloudEventOrgMemberAddedPreviousObjectUser $value
     */
    public function setUser(EventStreamCloudEventOrgMemberAddedPreviousObjectUser $value): self
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
