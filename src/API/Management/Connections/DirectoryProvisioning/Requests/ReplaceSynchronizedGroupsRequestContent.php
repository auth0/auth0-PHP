<?php

namespace Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\SynchronizedGroupPayload;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ReplaceSynchronizedGroupsRequestContent extends JsonSerializableType
{
    /**
     * @var array<SynchronizedGroupPayload> $groups Array of Google Workspace Directory group objects to synchronize.
     */
    #[JsonProperty('groups'), ArrayType([SynchronizedGroupPayload::class])]
    private array $groups;

    /**
     * @param array{
     *   groups: array<SynchronizedGroupPayload>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->groups = $values['groups'];
    }

    /**
     * @return array<SynchronizedGroupPayload>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param array<SynchronizedGroupPayload> $value
     */
    public function setGroups(array $value): self
    {
        $this->groups = $value;
        $this->_setField('groups');
        return $this;
    }
}
