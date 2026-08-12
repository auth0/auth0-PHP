<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Param are form input values, primarily utilized when specifying secrets and
 * configuration values for actions.
 *
 * These are especially important for partner integrations -- but can be
 * exposed to tenant admins as well if they want to parameterize their custom
 * actions.
 */
class IntegrationRequiredParam extends JsonSerializableType
{
    /**
     * @var ?value-of<IntegrationRequiredParamTypeEnum> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $name The name of the parameter.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?bool $required The flag for if this parameter is required.
     */
    #[JsonProperty('required')]
    private ?bool $required;

    /**
     * @var ?bool $optional The temp flag for if this parameter is required (experimental; for Labs use only).
     */
    #[JsonProperty('optional')]
    private ?bool $optional;

    /**
     * @var ?string $label The short label for this parameter.
     */
    #[JsonProperty('label')]
    private ?string $label;

    /**
     * @var ?string $description The lengthier description for this parameter.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?string $defaultValue The default value for this parameter.
     */
    #[JsonProperty('default_value')]
    private ?string $defaultValue;

    /**
     * @var ?string $placeholder Placeholder text for this parameter.
     */
    #[JsonProperty('placeholder')]
    private ?string $placeholder;

    /**
     * @var ?array<IntegrationRequiredParamOption> $options The allowable options for this param.
     */
    #[JsonProperty('options'), ArrayType([IntegrationRequiredParamOption::class])]
    private ?array $options;

    /**
     * @param array{
     *   type?: ?value-of<IntegrationRequiredParamTypeEnum>,
     *   name?: ?string,
     *   required?: ?bool,
     *   optional?: ?bool,
     *   label?: ?string,
     *   description?: ?string,
     *   defaultValue?: ?string,
     *   placeholder?: ?string,
     *   options?: ?array<IntegrationRequiredParamOption>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->required = $values['required'] ?? null;
        $this->optional = $values['optional'] ?? null;
        $this->label = $values['label'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->defaultValue = $values['defaultValue'] ?? null;
        $this->placeholder = $values['placeholder'] ?? null;
        $this->options = $values['options'] ?? null;
    }

    /**
     * @return ?value-of<IntegrationRequiredParamTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<IntegrationRequiredParamTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
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
    public function getOptional(): ?bool
    {
        return $this->optional;
    }

    /**
     * @param ?bool $value
     */
    public function setOptional(?bool $value = null): self
    {
        $this->optional = $value;
        $this->_setField('optional');
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    /**
     * @param ?string $value
     */
    public function setDefaultValue(?string $value = null): self
    {
        $this->defaultValue = $value;
        $this->_setField('defaultValue');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    /**
     * @param ?string $value
     */
    public function setPlaceholder(?string $value = null): self
    {
        $this->placeholder = $value;
        $this->_setField('placeholder');
        return $this;
    }

    /**
     * @return ?array<IntegrationRequiredParamOption>
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param ?array<IntegrationRequiredParamOption> $value
     */
    public function setOptions(?array $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
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
