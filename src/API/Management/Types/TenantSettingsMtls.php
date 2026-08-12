<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * mTLS configuration.
 */
class TenantSettingsMtls extends JsonSerializableType
{
    /**
     * @var ?bool $enableEndpointAliases If true, enables mTLS endpoint aliases
     */
    #[JsonProperty('enable_endpoint_aliases')]
    private ?bool $enableEndpointAliases;

    /**
     * @param array{
     *   enableEndpointAliases?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enableEndpointAliases = $values['enableEndpointAliases'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getEnableEndpointAliases(): ?bool
    {
        return $this->enableEndpointAliases;
    }

    /**
     * @param ?bool $value
     */
    public function setEnableEndpointAliases(?bool $value = null): self
    {
        $this->enableEndpointAliases = $value;
        $this->_setField('enableEndpointAliases');
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
