<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupJwt extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectioSetupTypeJwtEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var value-of<FlowsVaultConnectioSetupJwtAlgorithmEnum> $algorithm
     */
    #[JsonProperty('algorithm')]
    private string $algorithm;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectioSetupTypeJwtEnum>,
     *   algorithm: value-of<FlowsVaultConnectioSetupJwtAlgorithmEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->algorithm = $values['algorithm'];
    }

    /**
     * @return value-of<FlowsVaultConnectioSetupTypeJwtEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectioSetupTypeJwtEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return value-of<FlowsVaultConnectioSetupJwtAlgorithmEnum>
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * @param value-of<FlowsVaultConnectioSetupJwtAlgorithmEnum> $value
     */
    public function setAlgorithm(string $value): self
    {
        $this->algorithm = $value;
        $this->_setField('algorithm');
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
