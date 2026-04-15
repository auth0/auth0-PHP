<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateFlowsVaultConnectionHttpOauthClientCredentials extends JsonSerializableType
{
    /**
     * @var string $name Flows Vault Connection name.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var value-of<FlowsVaultConnectionAppIdHttpEnum> $appId
     */
    #[JsonProperty('app_id')]
    private string $appId;

    /**
     * @var FlowsVaultConnectionHttpOauthClientCredentialsSetup $setup
     */
    #[JsonProperty('setup')]
    private FlowsVaultConnectionHttpOauthClientCredentialsSetup $setup;

    /**
     * @param array{
     *   name: string,
     *   appId: value-of<FlowsVaultConnectionAppIdHttpEnum>,
     *   setup: FlowsVaultConnectionHttpOauthClientCredentialsSetup,
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
     * @return value-of<FlowsVaultConnectionAppIdHttpEnum>
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @param value-of<FlowsVaultConnectionAppIdHttpEnum> $value
     */
    public function setAppId(string $value): self
    {
        $this->appId = $value;
        $this->_setField('appId');
        return $this;
    }

    /**
     * @return FlowsVaultConnectionHttpOauthClientCredentialsSetup
     */
    public function getSetup(): FlowsVaultConnectionHttpOauthClientCredentialsSetup
    {
        return $this->setup;
    }

    /**
     * @param FlowsVaultConnectionHttpOauthClientCredentialsSetup $value
     */
    public function setSetup(FlowsVaultConnectionHttpOauthClientCredentialsSetup $value): self
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
