<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListUserEffectivePermissionsResponseContent extends JsonSerializableType
{
    /**
     * @var array<UserEffectivePermissionResponseContent> $permissions List of permissions assigned to the user.
     */
    #[JsonProperty('permissions'), ArrayType([UserEffectivePermissionResponseContent::class])]
    private array $permissions;

    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   permissions: array<UserEffectivePermissionResponseContent>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->permissions = $values['permissions'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<UserEffectivePermissionResponseContent>
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @param array<UserEffectivePermissionResponseContent> $value
     */
    public function setPermissions(array $value): self
    {
        $this->permissions = $value;
        $this->_setField('permissions');
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
