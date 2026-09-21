<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Provisioning settings for a connection profile strategy override.
 */
class ConnectionProfileStrategyOverridesProvisioning extends JsonSerializableType
{
    /**
     * @var ?ConnectionProfileProvisioningScim $scim
     */
    #[JsonProperty('scim')]
    private ?ConnectionProfileProvisioningScim $scim;

    /**
     * @param array{
     *   scim?: ?ConnectionProfileProvisioningScim,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->scim = $values['scim'] ?? null;
    }

    /**
     * @return ?ConnectionProfileProvisioningScim
     */
    public function getScim(): ?ConnectionProfileProvisioningScim
    {
        return $this->scim;
    }

    /**
     * @param ?ConnectionProfileProvisioningScim $value
     */
    public function setScim(?ConnectionProfileProvisioningScim $value = null): self
    {
        $this->scim = $value;
        $this->_setField('scim');
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
