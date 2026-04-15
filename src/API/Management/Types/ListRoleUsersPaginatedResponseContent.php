<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListRoleUsersPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<RoleUser> $users
     */
    #[JsonProperty('users'), ArrayType([RoleUser::class])]
    private ?array $users;

    /**
     * @param array{
     *   next?: ?string,
     *   users?: ?array<RoleUser>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->users = $values['users'] ?? null;
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
     * @return ?array<RoleUser>
     */
    public function getUsers(): ?array
    {
        return $this->users;
    }

    /**
     * @param ?array<RoleUser> $value
     */
    public function setUsers(?array $value = null): self
    {
        $this->users = $value;
        $this->_setField('users');
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
