<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content.
 */
class EventStreamCloudEventOrgMemberAddedObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgMemberAddedObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgMemberAddedObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgMemberAddedObjectUser $user
     */
    #[JsonProperty('user')]
    private EventStreamCloudEventOrgMemberAddedObjectUser $user;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgMemberAddedObjectOrganization,
     *   user: EventStreamCloudEventOrgMemberAddedObjectUser,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->user = $values['user'];
    }

    /**
     * @return EventStreamCloudEventOrgMemberAddedObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgMemberAddedObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgMemberAddedObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgMemberAddedObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgMemberAddedObjectUser
     */
    public function getUser(): EventStreamCloudEventOrgMemberAddedObjectUser
    {
        return $this->user;
    }

    /**
     * @param EventStreamCloudEventOrgMemberAddedObjectUser $value
     */
    public function setUser(EventStreamCloudEventOrgMemberAddedObjectUser $value): self
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
