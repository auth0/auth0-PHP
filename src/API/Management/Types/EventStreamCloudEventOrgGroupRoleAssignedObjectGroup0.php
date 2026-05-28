<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Reference to a connection group
 */
class EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0 extends JsonSerializableType
{
    /**
     * @var string $id The unique identifier for the group.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?string $externalId The external identifier for the group.
     */
    #[JsonProperty('external_id')]
    private ?string $externalId;

    /**
     * @var value-of<EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0TypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $connectionId The connection ID associated with the group.
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @param array{
     *   id: string,
     *   type: value-of<EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0TypeEnum>,
     *   connectionId: string,
     *   externalId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->externalId = $values['externalId'] ?? null;
        $this->type = $values['type'];
        $this->connectionId = $values['connectionId'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @param ?string $value
     */
    public function setExternalId(?string $value = null): self
    {
        $this->externalId = $value;
        $this->_setField('externalId');
        return $this;
    }

    /**
     * @return value-of<EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0TypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<EventStreamCloudEventOrgGroupRoleAssignedObjectGroup0TypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
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
