<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldDateConfig extends JsonSerializableType
{
    /**
     * @var ?value-of<FormFieldDateConfigFormatEnum> $format
     */
    #[JsonProperty('format')]
    private ?string $format;

    /**
     * @var ?string $defaultValue
     */
    #[JsonProperty('default_value')]
    private ?string $defaultValue;

    /**
     * @param array{
     *   format?: ?value-of<FormFieldDateConfigFormatEnum>,
     *   defaultValue?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->format = $values['format'] ?? null;
        $this->defaultValue = $values['defaultValue'] ?? null;
    }

    /**
     * @return ?value-of<FormFieldDateConfigFormatEnum>
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param ?value-of<FormFieldDateConfigFormatEnum> $value
     */
    public function setFormat(?string $value = null): self
    {
        $this->format = $value;
        $this->_setField('format');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
