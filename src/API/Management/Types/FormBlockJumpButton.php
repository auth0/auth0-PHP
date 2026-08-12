<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormBlockJumpButton extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var value-of<FormComponentCategoryBlockConst> $category
     */
    #[JsonProperty('category')]
    private string $category;

    /**
     * @var value-of<FormBlockTypeJumpButtonConst> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var FormBlockJumpButtonConfig $config
     */
    #[JsonProperty('config')]
    private FormBlockJumpButtonConfig $config;

    /**
     * @param array{
     *   id: string,
     *   category: value-of<FormComponentCategoryBlockConst>,
     *   type: value-of<FormBlockTypeJumpButtonConst>,
     *   config: FormBlockJumpButtonConfig,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->category = $values['category'];
        $this->type = $values['type'];
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
     * @return value-of<FormComponentCategoryBlockConst>
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param value-of<FormComponentCategoryBlockConst> $value
     */
    public function setCategory(string $value): self
    {
        $this->category = $value;
        $this->_setField('category');
        return $this;
    }

    /**
     * @return value-of<FormBlockTypeJumpButtonConst>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FormBlockTypeJumpButtonConst> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return FormBlockJumpButtonConfig
     */
    public function getConfig(): FormBlockJumpButtonConfig
    {
        return $this->config;
    }

    /**
     * @param FormBlockJumpButtonConfig $value
     */
    public function setConfig(FormBlockJumpButtonConfig $value): self
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
