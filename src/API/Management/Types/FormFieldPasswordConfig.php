<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldPasswordConfig extends JsonSerializableType
{
    /**
     * @var ?value-of<FormFieldPasswordConfigHashEnum> $hash
     */
    #[JsonProperty('hash')]
    private ?string $hash;

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
     * @var ?bool $complexity
     */
    #[JsonProperty('complexity')]
    private ?bool $complexity;

    /**
     * @var ?bool $nist
     */
    #[JsonProperty('nist')]
    private ?bool $nist;

    /**
     * @var ?bool $strengthMeter
     */
    #[JsonProperty('strength_meter')]
    private ?bool $strengthMeter;

    /**
     * @param array{
     *   hash?: ?value-of<FormFieldPasswordConfigHashEnum>,
     *   placeholder?: ?string,
     *   minLength?: ?int,
     *   maxLength?: ?int,
     *   complexity?: ?bool,
     *   nist?: ?bool,
     *   strengthMeter?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->hash = $values['hash'] ?? null;
        $this->placeholder = $values['placeholder'] ?? null;
        $this->minLength = $values['minLength'] ?? null;
        $this->maxLength = $values['maxLength'] ?? null;
        $this->complexity = $values['complexity'] ?? null;
        $this->nist = $values['nist'] ?? null;
        $this->strengthMeter = $values['strengthMeter'] ?? null;
    }

    /**
     * @return ?value-of<FormFieldPasswordConfigHashEnum>
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * @param ?value-of<FormFieldPasswordConfigHashEnum> $value
     */
    public function setHash(?string $value = null): self
    {
        $this->hash = $value;
        $this->_setField('hash');
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
     * @return ?bool
     */
    public function getComplexity(): ?bool
    {
        return $this->complexity;
    }

    /**
     * @param ?bool $value
     */
    public function setComplexity(?bool $value = null): self
    {
        $this->complexity = $value;
        $this->_setField('complexity');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getNist(): ?bool
    {
        return $this->nist;
    }

    /**
     * @param ?bool $value
     */
    public function setNist(?bool $value = null): self
    {
        $this->nist = $value;
        $this->_setField('nist');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getStrengthMeter(): ?bool
    {
        return $this->strengthMeter;
    }

    /**
     * @param ?bool $value
     */
    public function setStrengthMeter(?bool $value = null): self
    {
        $this->strengthMeter = $value;
        $this->_setField('strengthMeter');
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
