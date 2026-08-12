<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormBlockNextButton extends JsonSerializableType
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
     * @var value-of<FormBlockTypeNextButtonConst> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var FormBlockNextButtonConfig $config
     */
    #[JsonProperty('config')]
    private FormBlockNextButtonConfig $config;

    /**
     * @param array{
     *   id: string,
     *   category: value-of<FormComponentCategoryBlockConst>,
     *   type: value-of<FormBlockTypeNextButtonConst>,
     *   config: FormBlockNextButtonConfig,
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
     * @return value-of<FormBlockTypeNextButtonConst>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FormBlockTypeNextButtonConst> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return FormBlockNextButtonConfig
     */
    public function getConfig(): FormBlockNextButtonConfig
    {
        return $this->config;
    }

    /**
     * @param FormBlockNextButtonConfig $value
     */
    public function setConfig(FormBlockNextButtonConfig $value): self
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
