<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldNumberConfig extends JsonSerializableType
{
    /**
     * @var ?float $defaultValue
     */
    #[JsonProperty('default_value')]
    private ?float $defaultValue;

    /**
     * @var ?string $placeholder
     */
    #[JsonProperty('placeholder')]
    private ?string $placeholder;

    /**
     * @var ?float $minValue
     */
    #[JsonProperty('min_value')]
    private ?float $minValue;

    /**
     * @var ?float $maxValue
     */
    #[JsonProperty('max_value')]
    private ?float $maxValue;

    /**
     * @param array{
     *   defaultValue?: ?float,
     *   placeholder?: ?string,
     *   minValue?: ?float,
     *   maxValue?: ?float,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->defaultValue = $values['defaultValue'] ?? null;
        $this->placeholder = $values['placeholder'] ?? null;
        $this->minValue = $values['minValue'] ?? null;
        $this->maxValue = $values['maxValue'] ?? null;
    }

    /**
     * @return ?float
     */
    public function getDefaultValue(): ?float
    {
        return $this->defaultValue;
    }

    /**
     * @param ?float $value
     */
    public function setDefaultValue(?float $value = null): self
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
     * @return ?float
     */
    public function getMinValue(): ?float
    {
        return $this->minValue;
    }

    /**
     * @param ?float $value
     */
    public function setMinValue(?float $value = null): self
    {
        $this->minValue = $value;
        $this->_setField('minValue');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getMaxValue(): ?float
    {
        return $this->maxValue;
    }

    /**
     * @param ?float $value
     */
    public function setMaxValue(?float $value = null): self
    {
        $this->maxValue = $value;
        $this->_setField('maxValue');
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
