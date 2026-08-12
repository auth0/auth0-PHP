<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The event content.
 */
class EventStreamCloudEventOrgConnectionRemovedObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgConnectionRemovedObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgConnectionRemovedObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgConnectionRemovedObjectConnection $connection
     */
    #[JsonProperty('connection')]
    private EventStreamCloudEventOrgConnectionRemovedObjectConnection $connection;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgConnectionRemovedObjectOrganization,
     *   connection: EventStreamCloudEventOrgConnectionRemovedObjectConnection,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->connection = $values['connection'];
    }

    /**
     * @return EventStreamCloudEventOrgConnectionRemovedObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgConnectionRemovedObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgConnectionRemovedObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgConnectionRemovedObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgConnectionRemovedObjectConnection
     */
    public function getConnection(): EventStreamCloudEventOrgConnectionRemovedObjectConnection
    {
        return $this->connection;
    }

    /**
     * @param EventStreamCloudEventOrgConnectionRemovedObjectConnection $value
     */
    public function setConnection(EventStreamCloudEventOrgConnectionRemovedObjectConnection $value): self
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
