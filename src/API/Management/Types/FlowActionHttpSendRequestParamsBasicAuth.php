<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionHttpSendRequestParamsBasicAuth extends JsonSerializableType
{
    /**
     * @var ?string $username
     */
    #[JsonProperty('username')]
    private ?string $username;

    /**
     * @var ?string $password
     */
    #[JsonProperty('password')]
    private ?string $password;

    /**
     * @param array{
     *   username?: ?string,
     *   password?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->username = $values['username'] ?? null;
        $this->password = $values['password'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param ?string $value
     */
    public function setUsername(?string $value = null): self
    {
        $this->username = $value;
        $this->_setField('username');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param ?string $value
     */
    public function setPassword(?string $value = null): self
    {
        $this->password = $value;
        $this->_setField('password');
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
