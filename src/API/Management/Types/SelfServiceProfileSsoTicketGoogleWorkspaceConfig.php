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
     * @var ?bool $syncGroups Whether to enable Google Workspace Directory Sync for groups during the self-service flow.
     */
    #[JsonProperty('sync_groups')]
    private ?bool $syncGroups;

    /**
     * @param array{
     *   syncUsers: bool,
     *   syncGroups?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->syncUsers = $values['syncUsers'];
        $this->syncGroups = $values['syncGroups'] ?? null;
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
     * @return ?bool
     */
    public function getSyncGroups(): ?bool
    {
        return $this->syncGroups;
    }

    /**
     * @param ?bool $value
     */
    public function setSyncGroups(?bool $value = null): self
    {
        $this->syncGroups = $value;
        $this->_setField('syncGroups');
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
