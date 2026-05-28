<?php

namespace Auth0\SDK\API\Management\Roles\Groups\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class DeleteRoleGroupsRequestContent extends JsonSerializableType
{
    /**
     * @var array<string> $groups Array of group IDs to remove from the role.
     */
    #[JsonProperty('groups'), ArrayType(['string'])]
    private array $groups;

    /**
     * @param array{
     *   groups: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->groups = $values['groups'];
    }

    /**
     * @return array<string>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param array<string> $value
     */
    public function setGroups(array $value): self
    {
        $this->groups = $value;
        $this->_setField('groups');
        return $this;
    }
}
