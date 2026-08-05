<?php

namespace Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\SynchronizedGroupSelectionId;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class DeleteSynchronizedGroupsRequestContent extends JsonSerializableType
{
    /**
     * @var array<SynchronizedGroupSelectionId> $groups Array of groups to remove from the selection set.
     */
    #[JsonProperty('groups'), ArrayType([SynchronizedGroupSelectionId::class])]
    private array $groups;

    /**
     * @param array{
     *   groups: array<SynchronizedGroupSelectionId>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->groups = $values['groups'];
    }

    /**
     * @return array<SynchronizedGroupSelectionId>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param array<SynchronizedGroupSelectionId> $value
     */
    public function setGroups(array $value): self
    {
        $this->groups = $value;
        $this->_setField('groups');
        return $this;
    }
}
