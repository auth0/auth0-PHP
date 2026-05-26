<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Connection group with updated_at timestamp
 */
class EventStreamCloudEventGroupUpdatedObject0 extends JsonSerializableType
{
    /**
     * @var string $id The unique identifier for the group.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $name The name of the group.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $externalId The external identifier for the group.
     */
    #[JsonProperty('external_id')]
    private ?string $externalId;

    /**
     * @var DateTime $createdAt Date and time when this entity was created (ISO_8601 format).
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var value-of<EventStreamCloudEventGroupUpdatedObject0TypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $connectionId The connection ID associated with the group.
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var DateTime $updatedAt Date and time when this entity was last updated/modified (ISO_8601 format).
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   createdAt: DateTime,
     *   type: value-of<EventStreamCloudEventGroupUpdatedObject0TypeEnum>,
     *   connectionId: string,
     *   updatedAt: DateTime,
     *   externalId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->externalId = $values['externalId'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->type = $values['type'];
        $this->connectionId = $values['connectionId'];
        $this->updatedAt = $values['updatedAt'];
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
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
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return value-of<EventStreamCloudEventGroupUpdatedObject0TypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<EventStreamCloudEventGroupUpdatedObject0TypeEnum> $value
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
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
