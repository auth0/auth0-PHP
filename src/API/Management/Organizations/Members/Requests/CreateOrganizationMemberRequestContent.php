<?php

namespace Auth0\SDK\API\Management\Organizations\Members\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateOrganizationMemberRequestContent extends JsonSerializableType
{
    /**
     * @var array<string> $members List of user IDs to add to the organization as members.
     */
    #[JsonProperty('members'), ArrayType(['string'])]
    private array $members;

    /**
     * @param array{
     *   members: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->members = $values['members'];
    }

    /**
     * @return array<string>
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @param array<string> $value
     */
    public function setMembers(array $value): self
    {
        $this->members = $value;
        $this->_setField('members');
        return $this;
    }
}
