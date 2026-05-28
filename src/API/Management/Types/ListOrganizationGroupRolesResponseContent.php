<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationGroupRolesResponseContent extends JsonSerializableType
{
    /**
     * @var array<Role> $roles
     */
    #[JsonProperty('roles'), ArrayType([Role::class])]
    private array $roles;

    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   roles: array<Role>,
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
     * @return array<Role>
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array<Role> $value
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
