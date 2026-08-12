<?php

namespace Auth0\SDK\API\Management\Roles\Users\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class AssignRoleUsersRequestContent extends JsonSerializableType
{
    /**
     * @var array<string> $users user_id's of the users to assign the role to.
     */
    #[JsonProperty('users'), ArrayType(['string'])]
    private array $users;

    /**
     * @param array{
     *   users: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->users = $values['users'];
    }

    /**
     * @return array<string>
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param array<string> $value
     */
    public function setUsers(array $value): self
    {
        $this->users = $value;
        $this->_setField('users');
        return $this;
    }
}
