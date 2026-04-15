<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldChoiceConfigAllowOther extends JsonSerializableType
{
    /**
     * @var ?bool $enabled
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

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
     *   enabled?: ?bool,
     *   label?: ?string,
     *   placeholder?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabled = $values['enabled'] ?? null;
        $this->label = $values['label'] ?? null;
        $this->placeholder = $values['placeholder'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
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
