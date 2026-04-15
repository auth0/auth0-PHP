<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupToken extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectioSetupTypeTokenEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $token
     */
    #[JsonProperty('token')]
    private string $token;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectioSetupTypeTokenEnum>,
     *   token: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->token = $values['token'];
    }

    /**
     * @return value-of<FlowsVaultConnectioSetupTypeTokenEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectioSetupTypeTokenEnum> $value
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
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $value
     */
    public function setToken(string $value): self
    {
        $this->token = $value;
        $this->_setField('token');
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
