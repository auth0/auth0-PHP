<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Reference to an organization group
 */
class EventStreamCloudEventGroupMemberDeletedObjectGroup1 extends JsonSerializableType
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
     * @var value-of<EventStreamCloudEventGroupMemberDeletedObjectGroup1TypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $organizationId The organization ID associated with the group.
     */
    #[JsonProperty('organization_id')]
    private string $organizationId;

    /**
     * @param array{
     *   id: string,
     *   type: value-of<EventStreamCloudEventGroupMemberDeletedObjectGroup1TypeEnum>,
     *   organizationId: string,
     *   externalId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->externalId = $values['externalId'] ?? null;
        $this->type = $values['type'];
        $this->organizationId = $values['organizationId'];
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
     * @return value-of<EventStreamCloudEventGroupMemberDeletedObjectGroup1TypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<EventStreamCloudEventGroupMemberDeletedObjectGroup1TypeEnum> $value
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
    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    /**
     * @param string $value
     */
    public function setOrganizationId(string $value): self
    {
        $this->organizationId = $value;
        $this->_setField('organizationId');
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
