<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Federated Connections Access Tokens
 */
class ConnectionFederatedConnectionsAccessTokens extends JsonSerializableType
{
    /**
     * @var ?bool $active Enables refresh tokens and access tokens collection for federated connections
     */
    #[JsonProperty('active')]
    private ?bool $active;

    /**
     * @param array{
     *   active?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->active = $values['active'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param ?bool $value
     */
    public function setActive(?bool $value = null): self
    {
        $this->active = $value;
        $this->_setField('active');
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
