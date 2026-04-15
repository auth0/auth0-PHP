<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class IntegrationRequiredParamOption extends JsonSerializableType
{
    /**
     * @var ?string $value The value of an option that will be used within the application.
     */
    #[JsonProperty('value')]
    private ?string $value;

    /**
     * @var ?string $label The display value of an option suitable for displaying in a UI.
     */
    #[JsonProperty('label')]
    private ?string $label;

    /**
     * @param array{
     *   value?: ?string,
     *   label?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->value = $values['value'] ?? null;
        $this->label = $values['label'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param ?string $value
     */
    public function setValue(?string $value = null): self
    {
        $this->value = $value;
        $this->_setField('value');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
