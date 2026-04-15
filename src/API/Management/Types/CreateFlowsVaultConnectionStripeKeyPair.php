<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateFlowsVaultConnectionStripeKeyPair extends JsonSerializableType
{
    /**
     * @var string $name Flows Vault Connection name.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var value-of<FlowsVaultConnectionAppIdStripeEnum> $appId
     */
    #[JsonProperty('app_id')]
    private string $appId;

    /**
     * @var FlowsVaultConnectioSetupStripeKeyPair $setup
     */
    #[JsonProperty('setup')]
    private FlowsVaultConnectioSetupStripeKeyPair $setup;

    /**
     * @param array{
     *   name: string,
     *   appId: value-of<FlowsVaultConnectionAppIdStripeEnum>,
     *   setup: FlowsVaultConnectioSetupStripeKeyPair,
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
     * @return value-of<FlowsVaultConnectionAppIdStripeEnum>
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @param value-of<FlowsVaultConnectionAppIdStripeEnum> $value
     */
    public function setAppId(string $value): self
    {
        $this->appId = $value;
        $this->_setField('appId');
        return $this;
    }

    /**
     * @return FlowsVaultConnectioSetupStripeKeyPair
     */
    public function getSetup(): FlowsVaultConnectioSetupStripeKeyPair
    {
        return $this->setup;
    }

    /**
     * @param FlowsVaultConnectioSetupStripeKeyPair $value
     */
    public function setSetup(FlowsVaultConnectioSetupStripeKeyPair $value): self
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
