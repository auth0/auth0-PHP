<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\Group;
use DateTime;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Date;

class UserGroupsResponseSchema extends JsonSerializableType
{
    use Group;

    /**
     * @var ?DateTime $membershipCreatedAt Timestamp of when the group membership was added.
     */
    #[JsonProperty('membership_created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $membershipCreatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   externalId?: ?string,
     *   connectionId?: ?string,
     *   tenantName?: ?string,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   membershipCreatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->externalId = $values['externalId'] ?? null;
        $this->connectionId = $values['connectionId'] ?? null;
        $this->tenantName = $values['tenantName'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->membershipCreatedAt = $values['membershipCreatedAt'] ?? null;
    }

    /**
     * @return ?DateTime
     */
    public function getMembershipCreatedAt(): ?DateTime
    {
        return $this->membershipCreatedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setMembershipCreatedAt(?DateTime $value = null): self
    {
        $this->membershipCreatedAt = $value;
        $this->_setField('membershipCreatedAt');
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
