<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for delegation (impersonation) access using Session Transfer Tokens
 */
class ClientSessionTransferDelegationConfiguration extends JsonSerializableType
{
    /**
     * @var ?bool $allowDelegatedAccess Indicates whether delegation (impersonation) access is allowed using Session Transfer Tokens. Default value is `false`.
     */
    #[JsonProperty('allow_delegated_access')]
    private ?bool $allowDelegatedAccess;

    /**
     * @var ?value-of<ClientSessionTransferDelegationDeviceBindingEnum> $enforceDeviceBinding
     */
    #[JsonProperty('enforce_device_binding')]
    private ?string $enforceDeviceBinding;

    /**
     * @param array{
     *   allowDelegatedAccess?: ?bool,
     *   enforceDeviceBinding?: ?value-of<ClientSessionTransferDelegationDeviceBindingEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->allowDelegatedAccess = $values['allowDelegatedAccess'] ?? null;
        $this->enforceDeviceBinding = $values['enforceDeviceBinding'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getAllowDelegatedAccess(): ?bool
    {
        return $this->allowDelegatedAccess;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowDelegatedAccess(?bool $value = null): self
    {
        $this->allowDelegatedAccess = $value;
        $this->_setField('allowDelegatedAccess');
        return $this;
    }

    /**
     * @return ?value-of<ClientSessionTransferDelegationDeviceBindingEnum>
     */
    public function getEnforceDeviceBinding(): ?string
    {
        return $this->enforceDeviceBinding;
    }

    /**
     * @param ?value-of<ClientSessionTransferDelegationDeviceBindingEnum> $value
     */
    public function setEnforceDeviceBinding(?string $value = null): self
    {
        $this->enforceDeviceBinding = $value;
        $this->_setField('enforceDeviceBinding');
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
