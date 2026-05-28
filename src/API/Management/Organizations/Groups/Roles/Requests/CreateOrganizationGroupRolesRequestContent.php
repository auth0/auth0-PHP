<?php

namespace Auth0\SDK\API\Management\Organizations\Groups\Roles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateOrganizationGroupRolesRequestContent extends JsonSerializableType
{
    /**
     * @var array<string> $roles Array of role IDs to assign to organization group.
     */
    #[JsonProperty('roles'), ArrayType(['string'])]
    private array $roles;

    /**
     * @param array{
     *   roles: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->roles = $values['roles'];
    }

    /**
     * @return array<string>
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array<string> $value
     */
    public function setRoles(array $value): self
    {
        $this->roles = $value;
        $this->_setField('roles');
        return $this;
    }
}
