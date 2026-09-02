<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Controls whether connections from this template are used for organization discovery.
 */
class OrganizationTemplateUseForOrganizationDiscovery extends JsonSerializableType
{
    /**
     * @var bool $defaultValue The default value for organization discovery.
     */
    #[JsonProperty('default_value')]
    private bool $defaultValue;

    /**
     * @var ?array<bool> $allowedValues The allowed values for organization discovery.
     */
    #[JsonProperty('allowed_values'), ArrayType(['bool'])]
    private ?array $allowedValues;

    /**
     * @param array{
     *   defaultValue: bool,
     *   allowedValues?: ?array<bool>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->defaultValue = $values['defaultValue'];
        $this->allowedValues = $values['allowedValues'] ?? null;
    }

    /**
     * @return bool
     */
    public function getDefaultValue(): bool
    {
        return $this->defaultValue;
    }

    /**
     * @param bool $value
     */
    public function setDefaultValue(bool $value): self
    {
        $this->defaultValue = $value;
        $this->_setField('defaultValue');
        return $this;
    }

    /**
     * @return ?array<bool>
     */
    public function getAllowedValues(): ?array
    {
        return $this->allowedValues;
    }

    /**
     * @param ?array<bool> $value
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
