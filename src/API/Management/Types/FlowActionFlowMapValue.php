<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionFlowMapValue extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?string $alias
     */
    #[JsonProperty('alias')]
    private ?string $alias;

    /**
     * @var value-of<FlowActionFlowMapValueType> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var value-of<FlowActionFlowMapValueAction> $action
     */
    #[JsonProperty('action')]
    private string $action;

    /**
     * @var ?bool $allowFailure
     */
    #[JsonProperty('allow_failure')]
    private ?bool $allowFailure;

    /**
     * @var ?bool $maskOutput
     */
    #[JsonProperty('mask_output')]
    private ?bool $maskOutput;

    /**
     * @var FlowActionFlowMapValueParams $params
     */
    #[JsonProperty('params')]
    private FlowActionFlowMapValueParams $params;

    /**
     * @param array{
     *   id: string,
     *   type: value-of<FlowActionFlowMapValueType>,
     *   action: value-of<FlowActionFlowMapValueAction>,
     *   params: FlowActionFlowMapValueParams,
     *   alias?: ?string,
     *   allowFailure?: ?bool,
     *   maskOutput?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->alias = $values['alias'] ?? null;
        $this->type = $values['type'];
        $this->action = $values['action'];
        $this->allowFailure = $values['allowFailure'] ?? null;
        $this->maskOutput = $values['maskOutput'] ?? null;
        $this->params = $values['params'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @param ?string $value
     */
    public function setAlias(?string $value = null): self
    {
        $this->alias = $value;
        $this->_setField('alias');
        return $this;
    }

    /**
     * @return value-of<FlowActionFlowMapValueType>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowActionFlowMapValueType> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return value-of<FlowActionFlowMapValueAction>
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param value-of<FlowActionFlowMapValueAction> $value
     */
    public function setAction(string $value): self
    {
        $this->action = $value;
        $this->_setField('action');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowFailure(): ?bool
    {
        return $this->allowFailure;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowFailure(?bool $value = null): self
    {
        $this->allowFailure = $value;
        $this->_setField('allowFailure');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getMaskOutput(): ?bool
    {
        return $this->maskOutput;
    }

    /**
     * @param ?bool $value
     */
    public function setMaskOutput(?bool $value = null): self
    {
        $this->maskOutput = $value;
        $this->_setField('maskOutput');
        return $this;
    }

    /**
     * @return FlowActionFlowMapValueParams
     */
    public function getParams(): FlowActionFlowMapValueParams
    {
        return $this->params;
    }

    /**
     * @param FlowActionFlowMapValueParams $value
     */
    public function setParams(FlowActionFlowMapValueParams $value): self
    {
        $this->params = $value;
        $this->_setField('params');
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
