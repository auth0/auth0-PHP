<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationInvitationsOffsetPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?float $start
     */
    #[JsonProperty('start')]
    private ?float $start;

    /**
     * @var ?float $limit
     */
    #[JsonProperty('limit')]
    private ?float $limit;

    /**
     * @var ?array<OrganizationInvitation> $invitations
     */
    #[JsonProperty('invitations'), ArrayType([OrganizationInvitation::class])]
    private ?array $invitations;

    /**
     * @param array{
     *   start?: ?float,
     *   limit?: ?float,
     *   invitations?: ?array<OrganizationInvitation>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->start = $values['start'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->invitations = $values['invitations'] ?? null;
    }

    /**
     * @return ?float
     */
    public function getStart(): ?float
    {
        return $this->start;
    }

    /**
     * @param ?float $value
     */
    public function setStart(?float $value = null): self
    {
        $this->start = $value;
        $this->_setField('start');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getLimit(): ?float
    {
        return $this->limit;
    }

    /**
     * @param ?float $value
     */
    public function setLimit(?float $value = null): self
    {
        $this->limit = $value;
        $this->_setField('limit');
        return $this;
    }

    /**
     * @return ?array<OrganizationInvitation>
     */
    public function getInvitations(): ?array
    {
        return $this->invitations;
    }

    /**
     * @param ?array<OrganizationInvitation> $value
     */
    public function setInvitations(?array $value = null): self
    {
        $this->invitations = $value;
        $this->_setField('invitations');
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
