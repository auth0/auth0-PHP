<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionAuth0SendRequest extends JsonSerializableType
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
     * @var value-of<FlowActionAuth0SendRequestType> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var value-of<FlowActionAuth0SendRequestAction> $action
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
     * @var FlowActionAuth0SendRequestParams $params
     */
    #[JsonProperty('params')]
    private FlowActionAuth0SendRequestParams $params;

    /**
     * @param array{
     *   id: string,
     *   type: value-of<FlowActionAuth0SendRequestType>,
     *   action: value-of<FlowActionAuth0SendRequestAction>,
     *   params: FlowActionAuth0SendRequestParams,
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
     * @return value-of<FlowActionAuth0SendRequestType>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowActionAuth0SendRequestType> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return value-of<FlowActionAuth0SendRequestAction>
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param value-of<FlowActionAuth0SendRequestAction> $value
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
     * @return FlowActionAuth0SendRequestParams
     */
    public function getParams(): FlowActionAuth0SendRequestParams
    {
        return $this->params;
    }

    /**
     * @param FlowActionAuth0SendRequestParams $value
     */
    public function setParams(FlowActionAuth0SendRequestParams $value): self
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
