<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFlow extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var value-of<FormNodeTypeFlowConst> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var ?FormNodeCoordinates $coordinates
     */
    #[JsonProperty('coordinates')]
    private ?FormNodeCoordinates $coordinates;

    /**
     * @var ?string $alias
     */
    #[JsonProperty('alias')]
    private ?string $alias;

    /**
     * @var FormFlowConfig $config
     */
    #[JsonProperty('config')]
    private FormFlowConfig $config;

    /**
     * @param array{
     *   id: string,
     *   type: value-of<FormNodeTypeFlowConst>,
     *   config: FormFlowConfig,
     *   coordinates?: ?FormNodeCoordinates,
     *   alias?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->type = $values['type'];
        $this->coordinates = $values['coordinates'] ?? null;
        $this->alias = $values['alias'] ?? null;
        $this->config = $values['config'];
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
     * @return value-of<FormNodeTypeFlowConst>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FormNodeTypeFlowConst> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?FormNodeCoordinates
     */
    public function getCoordinates(): ?FormNodeCoordinates
    {
        return $this->coordinates;
    }

    /**
     * @param ?FormNodeCoordinates $value
     */
    public function setCoordinates(?FormNodeCoordinates $value = null): self
    {
        $this->coordinates = $value;
        $this->_setField('coordinates');
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
     * @return FormFlowConfig
     */
    public function getConfig(): FormFlowConfig
    {
        return $this->config;
    }

    /**
     * @param FormFlowConfig $value
     */
    public function setConfig(FormFlowConfig $value): self
    {
        $this->config = $value;
        $this->_setField('config');
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
