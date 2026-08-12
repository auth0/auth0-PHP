<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configure the purpose of a connection to be used for connected accounts and Token Vault.
 */
class ConnectionConnectedAccountsPurposeXaa extends JsonSerializableType
{
    /**
     * @var ?bool $crossAppAccess
     */
    #[JsonProperty('cross_app_access')]
    private ?bool $crossAppAccess;

    /**
     * @var bool $active
     */
    #[JsonProperty('active')]
    private bool $active;

    /**
     * @var ?bool $allowMissingUserId When true, allows storing a connected account without an upstream identity provider user id. At most one such connected account is allowed per user per connection. Default false preserves the strict behaviour (an upstream user id is required).
     */
    #[JsonProperty('allow_missing_user_id')]
    private ?bool $allowMissingUserId;

    /**
     * @param array{
     *   active: bool,
     *   crossAppAccess?: ?bool,
     *   allowMissingUserId?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->crossAppAccess = $values['crossAppAccess'] ?? null;
        $this->active = $values['active'];
        $this->allowMissingUserId = $values['allowMissingUserId'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getCrossAppAccess(): ?bool
    {
        return $this->crossAppAccess;
    }

    /**
     * @param ?bool $value
     */
    public function setCrossAppAccess(?bool $value = null): self
    {
        $this->crossAppAccess = $value;
        $this->_setField('crossAppAccess');
        return $this;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $value
     */
    public function setActive(bool $value): self
    {
        $this->active = $value;
        $this->_setField('active');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowMissingUserId(): ?bool
    {
        return $this->allowMissingUserId;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowMissingUserId(?bool $value = null): self
    {
        $this->allowMissingUserId = $value;
        $this->_setField('allowMissingUserId');
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
