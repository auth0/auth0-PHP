<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FormFieldChoiceConfig extends JsonSerializableType
{
    /**
     * @var ?bool $multiple
     */
    #[JsonProperty('multiple')]
    private ?bool $multiple;

    /**
     * @var ?array<FormFieldChoiceConfigOption> $options
     */
    #[JsonProperty('options'), ArrayType([FormFieldChoiceConfigOption::class])]
    private ?array $options;

    /**
     * @var ?FormFieldChoiceConfigAllowOther $allowOther
     */
    #[JsonProperty('allow_other')]
    private ?FormFieldChoiceConfigAllowOther $allowOther;

    /**
     * @param array{
     *   multiple?: ?bool,
     *   options?: ?array<FormFieldChoiceConfigOption>,
     *   allowOther?: ?FormFieldChoiceConfigAllowOther,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->multiple = $values['multiple'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->allowOther = $values['allowOther'] ?? null;
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
     * @return ?array<FormFieldChoiceConfigOption>
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param ?array<FormFieldChoiceConfigOption> $value
     */
    public function setOptions(?array $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
        return $this;
    }

    /**
     * @return ?FormFieldChoiceConfigAllowOther
     */
    public function getAllowOther(): ?FormFieldChoiceConfigAllowOther
    {
        return $this->allowOther;
    }

    /**
     * @param ?FormFieldChoiceConfigAllowOther $value
     */
    public function setAllowOther(?FormFieldChoiceConfigAllowOther $value = null): self
    {
        $this->allowOther = $value;
        $this->_setField('allowOther');
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
