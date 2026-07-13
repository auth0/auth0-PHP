<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for storing identity provider tokens in Auth0's Token Vault. When active, Auth0 securely stores access and refresh tokens from federated logins, enabling your application to make authenticated API calls on behalf of users.
 */
class EventStreamCloudEventConnectionDeletedObject7OptionsFederatedConnectionsAccessTokens extends JsonSerializableType
{
    /**
     * @var bool $active Enables refresh tokens and access tokens collection for federated connections
     */
    #[JsonProperty('active')]
    private bool $active;

    /**
     * @param array{
     *   active: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->active = $values['active'];
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
