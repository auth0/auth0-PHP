<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configure the purpose of a connection to be used for connected accounts and Token Vault.
 */
class ConnectionConnectedAccountsPurpose extends JsonSerializableType
{
    /**
     * @var bool $active
     */
    #[JsonProperty('active')]
    private bool $active;

    /**
     * @var ?bool $crossAppAccess
     */
    #[JsonProperty('cross_app_access')]
    private ?bool $crossAppAccess;

    /**
     * @param array{
     *   active: bool,
     *   crossAppAccess?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->active = $values['active'];
        $this->crossAppAccess = $values['crossAppAccess'] ?? null;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
