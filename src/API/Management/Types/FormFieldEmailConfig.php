<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldEmailConfig extends JsonSerializableType
{
    /**
     * @var ?string $defaultValue
     */
    #[JsonProperty('default_value')]
    private ?string $defaultValue;

    /**
     * @var ?string $placeholder
     */
    #[JsonProperty('placeholder')]
    private ?string $placeholder;

    /**
     * @param array{
     *   defaultValue?: ?string,
     *   placeholder?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->defaultValue = $values['defaultValue'] ?? null;
        $this->placeholder = $values['placeholder'] ?? null;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
