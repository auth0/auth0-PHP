<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Default organization discovery methods applied to matched clients.
 */
class ClientProfileClientConfigurationOrganizationDiscoveryMethods extends JsonSerializableType
{
    /**
     * @var ?array<value-of<ClientProfileClientConfigurationOrganizationDiscoveryMethodEnum>> $defaultValue
     */
    #[JsonProperty('default_value'), ArrayType(['string'])]
    private ?array $defaultValue;

    /**
     * @param array{
     *   defaultValue?: ?array<value-of<ClientProfileClientConfigurationOrganizationDiscoveryMethodEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->defaultValue = $values['defaultValue'] ?? null;
    }

    /**
     * @return ?array<value-of<ClientProfileClientConfigurationOrganizationDiscoveryMethodEnum>>
     */
    public function getDefaultValue(): ?array
    {
        return $this->defaultValue;
    }

    /**
     * @param ?array<value-of<ClientProfileClientConfigurationOrganizationDiscoveryMethodEnum>> $value
     */
    public function setDefaultValue(?array $value = null): self
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
