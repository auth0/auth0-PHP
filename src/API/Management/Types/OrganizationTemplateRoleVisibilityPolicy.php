<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Controls role visibility for organization administrators.
 */
class OrganizationTemplateRoleVisibilityPolicy extends JsonSerializableType
{
    /**
     * @var value-of<OrganizationTemplateRoleVisibilityEnum> $defaultValue
     */
    #[JsonProperty('default_value')]
    private string $defaultValue;

    /**
     * @var ?array<OrganizationTemplateRoleVisibilityOverride> $overrides Role-specific visibility overrides.
     */
    #[JsonProperty('overrides'), ArrayType([OrganizationTemplateRoleVisibilityOverride::class])]
    private ?array $overrides;

    /**
     * @param array{
     *   defaultValue: value-of<OrganizationTemplateRoleVisibilityEnum>,
     *   overrides?: ?array<OrganizationTemplateRoleVisibilityOverride>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->defaultValue = $values['defaultValue'];
        $this->overrides = $values['overrides'] ?? null;
    }

    /**
     * @return value-of<OrganizationTemplateRoleVisibilityEnum>
     */
    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    /**
     * @param value-of<OrganizationTemplateRoleVisibilityEnum> $value
     */
    public function setDefaultValue(string $value): self
    {
        $this->defaultValue = $value;
        $this->_setField('defaultValue');
        return $this;
    }

    /**
     * @return ?array<OrganizationTemplateRoleVisibilityOverride>
     */
    public function getOverrides(): ?array
    {
        return $this->overrides;
    }

    /**
     * @param ?array<OrganizationTemplateRoleVisibilityOverride> $value
     */
    public function setOverrides(?array $value = null): self
    {
        $this->overrides = $value;
        $this->_setField('overrides');
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
