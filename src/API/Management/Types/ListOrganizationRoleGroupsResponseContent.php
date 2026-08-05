<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Checkpoint paginated list of groups assigned to a role within an organization.
 */
class ListOrganizationRoleGroupsResponseContent extends JsonSerializableType
{
    /**
     * @var array<RoleGroup> $groups
     */
    #[JsonProperty('groups'), ArrayType([RoleGroup::class])]
    private array $groups;

    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   groups: array<RoleGroup>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->groups = $values['groups'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<RoleGroup>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param array<RoleGroup> $value
     */
    public function setGroups(array $value): self
    {
        $this->groups = $value;
        $this->_setField('groups');
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
