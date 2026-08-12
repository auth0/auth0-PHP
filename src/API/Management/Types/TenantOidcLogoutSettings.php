<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Settings related to OIDC RP-initiated Logout
 */
class TenantOidcLogoutSettings extends JsonSerializableType
{
    /**
     * @var ?bool $rpLogoutEndSessionEndpointDiscovery Enable the end_session_endpoint URL in the .well-known discovery configuration
     */
    #[JsonProperty('rp_logout_end_session_endpoint_discovery')]
    private ?bool $rpLogoutEndSessionEndpointDiscovery;

    /**
     * @param array{
     *   rpLogoutEndSessionEndpointDiscovery?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->rpLogoutEndSessionEndpointDiscovery = $values['rpLogoutEndSessionEndpointDiscovery'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getRpLogoutEndSessionEndpointDiscovery(): ?bool
    {
        return $this->rpLogoutEndSessionEndpointDiscovery;
    }

    /**
     * @param ?bool $value
     */
    public function setRpLogoutEndSessionEndpointDiscovery(?bool $value = null): self
    {
        $this->rpLogoutEndSessionEndpointDiscovery = $value;
        $this->_setField('rpLogoutEndSessionEndpointDiscovery');
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
