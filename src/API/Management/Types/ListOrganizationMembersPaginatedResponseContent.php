<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationMembersPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<OrganizationMember> $members
     */
    #[JsonProperty('members'), ArrayType([OrganizationMember::class])]
    private ?array $members;

    /**
     * @param array{
     *   next?: ?string,
     *   members?: ?array<OrganizationMember>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->members = $values['members'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @param ?string $value
     */
    public function setNext(?string $value = null): self
    {
        $this->next = $value;
        $this->_setField('next');
        return $this;
    }

    /**
     * @return ?array<OrganizationMember>
     */
    public function getMembers(): ?array
    {
        return $this->members;
    }

    /**
     * @param ?array<OrganizationMember> $value
     */
    public function setMembers(?array $value = null): self
    {
        $this->members = $value;
        $this->_setField('members');
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
