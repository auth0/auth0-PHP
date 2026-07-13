<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationRoleMembersResponseContent extends JsonSerializableType
{
    /**
     * @var array<RoleMember> $members List of members assigned to the role within the organization.
     */
    #[JsonProperty('members'), ArrayType([RoleMember::class])]
    private array $members;

    /**
     * @var ?string $next Cursor for the next page of results. Absent when there are no more results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   members: array<RoleMember>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->members = $values['members'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<RoleMember>
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @param array<RoleMember> $value
     */
    public function setMembers(array $value): self
    {
        $this->members = $value;
        $this->_setField('members');
        return $this;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
