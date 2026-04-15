<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for Google Workspace Directory Sync during the self-service flow.
 */
class SelfServiceProfileSsoTicketGoogleWorkspaceConfig extends JsonSerializableType
{
    /**
     * @var bool $syncUsers Whether to enable Google Workspace Directory Sync for users during the self-service flow.
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
