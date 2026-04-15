<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldBooleanConfig extends JsonSerializableType
{
    /**
     * @var ?bool $defaultValue
     */
    #[JsonProperty('default_value')]
    private ?bool $defaultValue;

    /**
     * @var ?FormFieldBooleanConfigOptions $options
     */
    #[JsonProperty('options')]
    private ?FormFieldBooleanConfigOptions $options;

    /**
     * @param array{
     *   defaultValue?: ?bool,
     *   options?: ?FormFieldBooleanConfigOptions,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->defaultValue = $values['defaultValue'] ?? null;
        $this->options = $values['options'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getDefaultValue(): ?bool
    {
        return $this->defaultValue;
    }

    /**
     * @param ?bool $value
     */
    public function setDefaultValue(?bool $value = null): self
    {
        $this->defaultValue = $value;
        $this->_setField('defaultValue');
        return $this;
    }

    /**
     * @return ?FormFieldBooleanConfigOptions
     */
    public function getOptions(): ?FormFieldBooleanConfigOptions
    {
        return $this->options;
    }

    /**
     * @param ?FormFieldBooleanConfigOptions $value
     */
    public function setOptions(?FormFieldBooleanConfigOptions $value = null): self
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
