<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Default organization prompt behavior applied to matched clients.
 */
class ClientProfileClientConfigurationOrganizationRequireBehavior extends JsonSerializableType
{
    /**
     * @var ?value-of<ClientProfileClientConfigurationOrganizationRequireBehaviorEnum> $defaultValue
     */
    #[JsonProperty('default_value')]
    private ?string $defaultValue;

    /**
     * @param array{
     *   defaultValue?: ?value-of<ClientProfileClientConfigurationOrganizationRequireBehaviorEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->defaultValue = $values['defaultValue'] ?? null;
    }

    /**
     * @return ?value-of<ClientProfileClientConfigurationOrganizationRequireBehaviorEnum>
     */
    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    /**
     * @param ?value-of<ClientProfileClientConfigurationOrganizationRequireBehaviorEnum> $value
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
