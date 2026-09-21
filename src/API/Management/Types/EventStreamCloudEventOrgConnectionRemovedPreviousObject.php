<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content as it was prior to the change described by this event, when applicable.
 */
class EventStreamCloudEventOrgConnectionRemovedPreviousObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgConnectionRemovedPreviousObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgConnectionRemovedPreviousObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgConnectionRemovedPreviousObjectConnection $connection
     */
    #[JsonProperty('connection')]
    private EventStreamCloudEventOrgConnectionRemovedPreviousObjectConnection $connection;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgConnectionRemovedPreviousObjectOrganization,
     *   connection: EventStreamCloudEventOrgConnectionRemovedPreviousObjectConnection,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->connection = $values['connection'];
    }

    /**
     * @return EventStreamCloudEventOrgConnectionRemovedPreviousObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgConnectionRemovedPreviousObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgConnectionRemovedPreviousObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgConnectionRemovedPreviousObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgConnectionRemovedPreviousObjectConnection
     */
    public function getConnection(): EventStreamCloudEventOrgConnectionRemovedPreviousObjectConnection
    {
        return $this->connection;
    }

    /**
     * @param EventStreamCloudEventOrgConnectionRemovedPreviousObjectConnection $value
     */
    public function setConnection(EventStreamCloudEventOrgConnectionRemovedPreviousObjectConnection $value): self
    {
        $this->connection = $value;
        $this->_setField('connection');
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
