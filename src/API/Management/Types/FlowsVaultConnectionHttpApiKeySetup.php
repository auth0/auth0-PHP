<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectionHttpApiKeySetup extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectionSetupTypeApiKeyEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $value
     */
    #[JsonProperty('value')]
    private string $value;

    /**
     * @var value-of<FlowsVaultConnectionHttpApiKeySetupInEnum> $in
     */
    #[JsonProperty('in')]
    private string $in;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectionSetupTypeApiKeyEnum>,
     *   name: string,
     *   value: string,
     *   in: value-of<FlowsVaultConnectionHttpApiKeySetupInEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->name = $values['name'];
        $this->value = $values['value'];
        $this->in = $values['in'];
    }

    /**
     * @return value-of<FlowsVaultConnectionSetupTypeApiKeyEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectionSetupTypeApiKeyEnum> $value
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
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        $this->_setField('value');
        return $this;
    }

    /**
     * @return value-of<FlowsVaultConnectionHttpApiKeySetupInEnum>
     */
    public function getIn(): string
    {
        return $this->in;
    }

    /**
     * @param value-of<FlowsVaultConnectionHttpApiKeySetupInEnum> $value
     */
    public function setIn(string $value): self
    {
        $this->in = $value;
        $this->_setField('in');
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
