<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Represents the metadata of a group membership.
 */
class GroupMember extends JsonSerializableType
{
    /**
     * @var ?string $id Unique identifier for the member.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?value-of<GroupMemberTypeEnum> $memberType
     */
    #[JsonProperty('member_type')]
    private ?string $memberType;

    /**
     * @var ?value-of<GroupTypeEnum> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $connectionId Identifier for the connection this group belongs to (if a connection group).
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @var ?DateTime $createdAt Timestamp of when the membership was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @param array{
     *   id?: ?string,
     *   memberType?: ?value-of<GroupMemberTypeEnum>,
     *   type?: ?value-of<GroupTypeEnum>,
     *   connectionId?: ?string,
     *   createdAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->memberType = $values['memberType'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->connectionId = $values['connectionId'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?value-of<GroupMemberTypeEnum>
     */
    public function getMemberType(): ?string
    {
        return $this->memberType;
    }

    /**
     * @param ?value-of<GroupMemberTypeEnum> $value
     */
    public function setMemberType(?string $value = null): self
    {
        $this->memberType = $value;
        $this->_setField('memberType');
        return $this;
    }

    /**
     * @return ?value-of<GroupTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<GroupTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
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
