<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * The Cross App Access resource app status configuration.
 */
class ConnectionProfileCrossAppAccessResourceAppStatus extends JsonSerializableType
{
    /**
     * @var value-of<ConnectionProfileCrossAppAccessResourceAppStatusDefaultValueEnum> $defaultValue
     */
    #[JsonProperty('default_value')]
    private string $defaultValue;

    /**
     * @var ?array<value-of<ConnectionProfileCrossAppAccessResourceAppStatusValueEnum>> $allowedValues
     */
    #[JsonProperty('allowed_values'), ArrayType(['string'])]
    private ?array $allowedValues;

    /**
     * @param array{
     *   defaultValue: value-of<ConnectionProfileCrossAppAccessResourceAppStatusDefaultValueEnum>,
     *   allowedValues?: ?array<value-of<ConnectionProfileCrossAppAccessResourceAppStatusValueEnum>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->defaultValue = $values['defaultValue'];
        $this->allowedValues = $values['allowedValues'] ?? null;
    }

    /**
     * @return value-of<ConnectionProfileCrossAppAccessResourceAppStatusDefaultValueEnum>
     */
    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    /**
     * @param value-of<ConnectionProfileCrossAppAccessResourceAppStatusDefaultValueEnum> $value
     */
    public function setDefaultValue(string $value): self
    {
        $this->defaultValue = $value;
        $this->_setField('defaultValue');
        return $this;
    }

    /**
     * @return ?array<value-of<ConnectionProfileCrossAppAccessResourceAppStatusValueEnum>>
     */
    public function getAllowedValues(): ?array
    {
        return $this->allowedValues;
    }

    /**
     * @param ?array<value-of<ConnectionProfileCrossAppAccessResourceAppStatusValueEnum>> $value
     */
    public function setAllowedValues(?array $value = null): self
    {
        $this->allowedValues = $value;
        $this->_setField('allowedValues');
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
