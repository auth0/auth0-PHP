<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldTextConfig extends JsonSerializableType
{
    /**
     * @var ?bool $multiline
     */
    #[JsonProperty('multiline')]
    private ?bool $multiline;

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
     * @var ?int $minLength
     */
    #[JsonProperty('min_length')]
    private ?int $minLength;

    /**
     * @var ?int $maxLength
     */
    #[JsonProperty('max_length')]
    private ?int $maxLength;

    /**
     * @param array{
     *   multiline?: ?bool,
     *   defaultValue?: ?string,
     *   placeholder?: ?string,
     *   minLength?: ?int,
     *   maxLength?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->multiline = $values['multiline'] ?? null;
        $this->defaultValue = $values['defaultValue'] ?? null;
        $this->placeholder = $values['placeholder'] ?? null;
        $this->minLength = $values['minLength'] ?? null;
        $this->maxLength = $values['maxLength'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getMultiline(): ?bool
    {
        return $this->multiline;
    }

    /**
     * @param ?bool $value
     */
    public function setMultiline(?bool $value = null): self
    {
        $this->multiline = $value;
        $this->_setField('multiline');
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
     * @return ?int
     */
    public function getMinLength(): ?int
    {
        return $this->minLength;
    }

    /**
     * @param ?int $value
     */
    public function setMinLength(?int $value = null): self
    {
        $this->minLength = $value;
        $this->_setField('minLength');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }

    /**
     * @param ?int $value
     */
    public function setMaxLength(?int $value = null): self
    {
        $this->maxLength = $value;
        $this->_setField('maxLength');
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
