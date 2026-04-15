<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for validation
 */
class ConnectionValidationOptions extends JsonSerializableType
{
    /**
     * @var ?ConnectionUsernameValidationOptions $username
     */
    #[JsonProperty('username')]
    private ?ConnectionUsernameValidationOptions $username;

    /**
     * @param array{
     *   username?: ?ConnectionUsernameValidationOptions,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->username = $values['username'] ?? null;
    }

    /**
     * @return ?ConnectionUsernameValidationOptions
     */
    public function getUsername(): ?ConnectionUsernameValidationOptions
    {
        return $this->username;
    }

    /**
     * @param ?ConnectionUsernameValidationOptions $value
     */
    public function setUsername(?ConnectionUsernameValidationOptions $value = null): self
    {
        $this->username = $value;
        $this->_setField('username');
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
