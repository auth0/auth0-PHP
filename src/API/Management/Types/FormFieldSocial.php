<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldSocial extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var value-of<FormComponentCategoryFieldConst> $category
     */
    #[JsonProperty('category')]
    private string $category;

    /**
     * @var value-of<FormFieldTypeSocialConst> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var ?FormFieldSocialConfig $config
     */
    #[JsonProperty('config')]
    private ?FormFieldSocialConfig $config;

    /**
     * @var ?string $label
     */
    #[JsonProperty('label')]
    private ?string $label;

    /**
     * @var ?string $hint
     */
    #[JsonProperty('hint')]
    private ?string $hint;

    /**
     * @var ?bool $required
     */
    #[JsonProperty('required')]
    private ?bool $required;

    /**
     * @var ?bool $sensitive
     */
    #[JsonProperty('sensitive')]
    private ?bool $sensitive;

    /**
     * @param array{
     *   id: string,
     *   category: value-of<FormComponentCategoryFieldConst>,
     *   type: value-of<FormFieldTypeSocialConst>,
     *   config?: ?FormFieldSocialConfig,
     *   label?: ?string,
     *   hint?: ?string,
     *   required?: ?bool,
     *   sensitive?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->category = $values['category'];
        $this->type = $values['type'];
        $this->config = $values['config'] ?? null;
        $this->label = $values['label'] ?? null;
        $this->hint = $values['hint'] ?? null;
        $this->required = $values['required'] ?? null;
        $this->sensitive = $values['sensitive'] ?? null;
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
     * @return value-of<FormComponentCategoryFieldConst>
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param value-of<FormComponentCategoryFieldConst> $value
     */
    public function setCategory(string $value): self
    {
        $this->category = $value;
        $this->_setField('category');
        return $this;
    }

    /**
     * @return value-of<FormFieldTypeSocialConst>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FormFieldTypeSocialConst> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?FormFieldSocialConfig
     */
    public function getConfig(): ?FormFieldSocialConfig
    {
        return $this->config;
    }

    /**
     * @param ?FormFieldSocialConfig $value
     */
    public function setConfig(?FormFieldSocialConfig $value = null): self
    {
        $this->config = $value;
        $this->_setField('config');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param ?string $value
     */
    public function setLabel(?string $value = null): self
    {
        $this->label = $value;
        $this->_setField('label');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getHint(): ?string
    {
        return $this->hint;
    }

    /**
     * @param ?string $value
     */
    public function setHint(?string $value = null): self
    {
        $this->hint = $value;
        $this->_setField('hint');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRequired(): ?bool
    {
        return $this->required;
    }

    /**
     * @param ?bool $value
     */
    public function setRequired(?bool $value = null): self
    {
        $this->required = $value;
        $this->_setField('required');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSensitive(): ?bool
    {
        return $this->sensitive;
    }

    /**
     * @param ?bool $value
     */
    public function setSensitive(?bool $value = null): self
    {
        $this->sensitive = $value;
        $this->_setField('sensitive');
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
