<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Google Workspace provisioning settings.
 */
class ConnectionProfileProvisioningGoogleWorkspace extends JsonSerializableType
{
    /**
     * @var bool $syncUsers
     */
    #[JsonProperty('sync_users')]
    private bool $syncUsers;

    /**
     * @param array{
     *   syncUsers: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->syncUsers = $values['syncUsers'];
    }

    /**
     * @return bool
     */
    public function getSyncUsers(): bool
    {
        return $this->syncUsers;
    }

    /**
     * @param bool $value
     */
    public function setSyncUsers(bool $value): self
    {
        $this->syncUsers = $value;
        $this->_setField('syncUsers');
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
