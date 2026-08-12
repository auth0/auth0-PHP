<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FormFieldCardsConfig extends JsonSerializableType
{
    /**
     * @var ?bool $hideLabels
     */
    #[JsonProperty('hide_labels')]
    private ?bool $hideLabels;

    /**
     * @var ?bool $multiple
     */
    #[JsonProperty('multiple')]
    private ?bool $multiple;

    /**
     * @var ?array<FormFieldCardsConfigOption> $options
     */
    #[JsonProperty('options'), ArrayType([FormFieldCardsConfigOption::class])]
    private ?array $options;

    /**
     * @param array{
     *   hideLabels?: ?bool,
     *   multiple?: ?bool,
     *   options?: ?array<FormFieldCardsConfigOption>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->hideLabels = $values['hideLabels'] ?? null;
        $this->multiple = $values['multiple'] ?? null;
        $this->options = $values['options'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getHideLabels(): ?bool
    {
        return $this->hideLabels;
    }

    /**
     * @param ?bool $value
     */
    public function setHideLabels(?bool $value = null): self
    {
        $this->hideLabels = $value;
        $this->_setField('hideLabels');
        return $this;
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
     * @return ?array<FormFieldCardsConfigOption>
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param ?array<FormFieldCardsConfigOption> $value
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
