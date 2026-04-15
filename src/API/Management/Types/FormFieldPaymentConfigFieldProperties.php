<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldPaymentConfigFieldProperties extends JsonSerializableType
{
    /**
     * @var ?string $label
     */
    #[JsonProperty('label')]
    private ?string $label;

    /**
     * @var ?string $placeholder
     */
    #[JsonProperty('placeholder')]
    private ?string $placeholder;

    /**
     * @param array{
     *   label?: ?string,
     *   placeholder?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->label = $values['label'] ?? null;
        $this->placeholder = $values['placeholder'] ?? null;
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
