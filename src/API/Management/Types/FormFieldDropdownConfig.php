<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FormFieldDropdownConfig extends JsonSerializableType
{
    /**
     * @var ?bool $multiple
     */
    #[JsonProperty('multiple')]
    private ?bool $multiple;

    /**
     * @var ?array<FormFieldDropdownConfigOption> $options
     */
    #[JsonProperty('options'), ArrayType([FormFieldDropdownConfigOption::class])]
    private ?array $options;

    /**
     * @var ?string $placeholder
     */
    #[JsonProperty('placeholder')]
    private ?string $placeholder;

    /**
     * @param array{
     *   multiple?: ?bool,
     *   options?: ?array<FormFieldDropdownConfigOption>,
     *   placeholder?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->multiple = $values['multiple'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->placeholder = $values['placeholder'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getMultiple(): ?bool
    {
        return $this->multiple;
    }

    /**
     * @param ?bool $value
     */
    public function setMultiple(?bool $value = null): self
    {
        $this->multiple = $value;
        $this->_setField('multiple');
        return $this;
    }

    /**
     * @return ?array<FormFieldDropdownConfigOption>
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param ?array<FormFieldDropdownConfigOption> $value
     */
    public function setOptions(?array $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
