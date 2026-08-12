<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupSecretApiKey extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectioSetupTypeApiKeyEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $secretKey
     */
    #[JsonProperty('secret_key')]
    private string $secretKey;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectioSetupTypeApiKeyEnum>,
     *   secretKey: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->secretKey = $values['secretKey'];
    }

    /**
     * @return value-of<FlowsVaultConnectioSetupTypeApiKeyEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectioSetupTypeApiKeyEnum> $value
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
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @param string $value
     */
    public function setSecretKey(string $value): self
    {
        $this->secretKey = $value;
        $this->_setField('secretKey');
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
