<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationMemberEffectiveRolesResponseContent extends JsonSerializableType
{
    /**
     * @var array<OrganizationMemberEffectiveRole> $roles
     */
    #[JsonProperty('roles'), ArrayType([OrganizationMemberEffectiveRole::class])]
    private array $roles;

    /**
     * @var ?string $next Cursor for the next page of results
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   roles: array<OrganizationMemberEffectiveRole>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->roles = $values['roles'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<OrganizationMemberEffectiveRole>
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array<OrganizationMemberEffectiveRole> $value
     */
    public function setRoles(array $value): self
    {
        $this->roles = $value;
        $this->_setField('roles');
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
