<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectionHttpBasicAuthSetup extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectionSetupTypeBasicAuthEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $username
     */
    #[JsonProperty('username')]
    private string $username;

    /**
     * @var ?string $password
     */
    #[JsonProperty('password')]
    private ?string $password;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectionSetupTypeBasicAuthEnum>,
     *   username: string,
     *   password?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->username = $values['username'];
        $this->password = $values['password'] ?? null;
    }

    /**
     * @return value-of<FlowsVaultConnectionSetupTypeBasicAuthEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectionSetupTypeBasicAuthEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $value
     */
    public function setUsername(string $value): self
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
