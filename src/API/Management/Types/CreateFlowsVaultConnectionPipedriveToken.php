<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateFlowsVaultConnectionPipedriveToken extends JsonSerializableType
{
    /**
     * @var string $name Flows Vault Connection name.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var value-of<FlowsVaultConnectionAppIdPipedriveEnum> $appId
     */
    #[JsonProperty('app_id')]
    private string $appId;

    /**
     * @var FlowsVaultConnectioSetupToken $setup
     */
    #[JsonProperty('setup')]
    private FlowsVaultConnectioSetupToken $setup;

    /**
     * @param array{
     *   name: string,
     *   appId: value-of<FlowsVaultConnectionAppIdPipedriveEnum>,
     *   setup: FlowsVaultConnectioSetupToken,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->appId = $values['appId'];
        $this->setup = $values['setup'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return value-of<FlowsVaultConnectionAppIdPipedriveEnum>
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @param value-of<FlowsVaultConnectionAppIdPipedriveEnum> $value
     */
    public function setAppId(string $value): self
    {
        $this->appId = $value;
        $this->_setField('appId');
        return $this;
    }

    /**
     * @return FlowsVaultConnectioSetupToken
     */
    public function getSetup(): FlowsVaultConnectioSetupToken
    {
        return $this->setup;
    }

    /**
     * @param FlowsVaultConnectioSetupToken $value
     */
    public function setSetup(FlowsVaultConnectioSetupToken $value): self
    {
        $this->setup = $value;
        $this->_setField('setup');
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
