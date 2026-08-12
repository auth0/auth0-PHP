<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormRouter extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var value-of<FormNodeTypeRouterConst> $type
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
     * @var ?FormRouterConfig $config
     */
    #[JsonProperty('config')]
    private ?FormRouterConfig $config;

    /**
     * @param array{
     *   id: string,
     *   type: value-of<FormNodeTypeRouterConst>,
     *   coordinates?: ?FormNodeCoordinates,
     *   alias?: ?string,
     *   config?: ?FormRouterConfig,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->type = $values['type'];
        $this->coordinates = $values['coordinates'] ?? null;
        $this->alias = $values['alias'] ?? null;
        $this->config = $values['config'] ?? null;
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
     * @return value-of<FormNodeTypeRouterConst>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FormNodeTypeRouterConst> $value
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
     * @return ?FormRouterConfig
     */
    public function getConfig(): ?FormRouterConfig
    {
        return $this->config;
    }

    /**
     * @param ?FormRouterConfig $value
     */
    public function setConfig(?FormRouterConfig $value = null): self
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
