<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Provisioning settings for connections created from this profile.
 */
class ConnectionProfileProvisioning extends JsonSerializableType
{
    /**
     * @var ?ConnectionProfileProvisioningScim $scim
     */
    #[JsonProperty('scim')]
    private ?ConnectionProfileProvisioningScim $scim;

    /**
     * @var ?ConnectionProfileProvisioningGoogleWorkspace $googleWorkspace
     */
    #[JsonProperty('google_workspace')]
    private ?ConnectionProfileProvisioningGoogleWorkspace $googleWorkspace;

    /**
     * @param array{
     *   scim?: ?ConnectionProfileProvisioningScim,
     *   googleWorkspace?: ?ConnectionProfileProvisioningGoogleWorkspace,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->scim = $values['scim'] ?? null;
        $this->googleWorkspace = $values['googleWorkspace'] ?? null;
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
     * @return ?ConnectionProfileProvisioningGoogleWorkspace
     */
    public function getGoogleWorkspace(): ?ConnectionProfileProvisioningGoogleWorkspace
    {
        return $this->googleWorkspace;
    }

    /**
     * @param ?ConnectionProfileProvisioningGoogleWorkspace $value
     */
    public function setGoogleWorkspace(?ConnectionProfileProvisioningGoogleWorkspace $value = null): self
    {
        $this->googleWorkspace = $value;
        $this->_setField('googleWorkspace');
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
