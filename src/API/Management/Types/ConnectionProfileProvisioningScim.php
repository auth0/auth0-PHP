<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * SCIM provisioning settings.
 */
class ConnectionProfileProvisioningScim extends JsonSerializableType
{
    /**
     * @var ConnectionProfileProvisioningScimTokens $tokens
     */
    #[JsonProperty('tokens')]
    private ConnectionProfileProvisioningScimTokens $tokens;

    /**
     * @param array{
     *   tokens: ConnectionProfileProvisioningScimTokens,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tokens = $values['tokens'];
    }

    /**
     * @return ConnectionProfileProvisioningScimTokens
     */
    public function getTokens(): ConnectionProfileProvisioningScimTokens
    {
        return $this->tokens;
    }

    /**
     * @param ConnectionProfileProvisioningScimTokens $value
     */
    public function setTokens(ConnectionProfileProvisioningScimTokens $value): self
    {
        $this->tokens = $value;
        $this->_setField('tokens');
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
