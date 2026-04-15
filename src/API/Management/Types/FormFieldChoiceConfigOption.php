<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldChoiceConfigOption extends JsonSerializableType
{
    /**
     * @var string $value
     */
    #[JsonProperty('value')]
    private string $value;

    /**
     * @var string $label
     */
    #[JsonProperty('label')]
    private string $label;

    /**
     * @param array{
     *   value: string,
     *   label: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->value = $values['value'];
        $this->label = $values['label'];
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        $this->_setField('value');
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $value
     */
    public function setLabel(string $value): self
    {
        $this->label = $value;
        $this->_setField('label');
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
