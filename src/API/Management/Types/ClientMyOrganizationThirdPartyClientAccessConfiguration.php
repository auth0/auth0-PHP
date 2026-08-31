<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * The third-party client access configuration for the My Organization Configuration.
 */
class ClientMyOrganizationThirdPartyClientAccessConfiguration extends JsonSerializableType
{
    /**
     * @var value-of<ClientMyOrganizationConfigurationThirdPartyClientAccessDefaultValueEnum> $defaultValue
     */
    #[JsonProperty('default_value')]
    private string $defaultValue;

    /**
     * @var array<value-of<ClientMyOrganizationConfigurationThirdPartyClientAccessAllowedValuesEnum>> $allowedValues The allowed third-party client access values for the My Organization Configuration.
     */
    #[JsonProperty('allowed_values'), ArrayType(['string'])]
    private array $allowedValues;

    /**
     * @param array{
     *   defaultValue: value-of<ClientMyOrganizationConfigurationThirdPartyClientAccessDefaultValueEnum>,
     *   allowedValues: array<value-of<ClientMyOrganizationConfigurationThirdPartyClientAccessAllowedValuesEnum>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->defaultValue = $values['defaultValue'];
        $this->allowedValues = $values['allowedValues'];
    }

    /**
     * @return value-of<ClientMyOrganizationConfigurationThirdPartyClientAccessDefaultValueEnum>
     */
    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    /**
     * @param value-of<ClientMyOrganizationConfigurationThirdPartyClientAccessDefaultValueEnum> $value
     */
    public function setDefaultValue(string $value): self
    {
        $this->defaultValue = $value;
        $this->_setField('defaultValue');
        return $this;
    }

    /**
     * @return array<value-of<ClientMyOrganizationConfigurationThirdPartyClientAccessAllowedValuesEnum>>
     */
    public function getAllowedValues(): array
    {
        return $this->allowedValues;
    }

    /**
     * @param array<value-of<ClientMyOrganizationConfigurationThirdPartyClientAccessAllowedValuesEnum>> $value
     */
    public function setAllowedValues(array $value): self
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
