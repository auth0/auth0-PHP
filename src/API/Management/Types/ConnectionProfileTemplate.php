<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * The structure of the template, which can be used as the payload for creating or updating a Connection Profile.
 */
class ConnectionProfileTemplate extends JsonSerializableType
{
    /**
     * @var ?string $name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?ConnectionProfileOrganization $organization
     */
    #[JsonProperty('organization')]
    private ?ConnectionProfileOrganization $organization;

    /**
     * @var ?string $connectionNamePrefixTemplate
     */
    #[JsonProperty('connection_name_prefix_template')]
    private ?string $connectionNamePrefixTemplate;

    /**
     * @var ?array<value-of<EnabledFeaturesEnum>> $enabledFeatures
     */
    #[JsonProperty('enabled_features'), ArrayType(['string'])]
    private ?array $enabledFeatures;

    /**
     * @var ?ConnectionProfileConfig $connectionConfig
     */
    #[JsonProperty('connection_config')]
    private ?ConnectionProfileConfig $connectionConfig;

    /**
     * @var ?ConnectionProfileStrategyOverrides $strategyOverrides
     */
    #[JsonProperty('strategy_overrides')]
    private ?ConnectionProfileStrategyOverrides $strategyOverrides;

    /**
     * @param array{
     *   name?: ?string,
     *   organization?: ?ConnectionProfileOrganization,
     *   connectionNamePrefixTemplate?: ?string,
     *   enabledFeatures?: ?array<value-of<EnabledFeaturesEnum>>,
     *   connectionConfig?: ?ConnectionProfileConfig,
     *   strategyOverrides?: ?ConnectionProfileStrategyOverrides,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->organization = $values['organization'] ?? null;
        $this->connectionNamePrefixTemplate = $values['connectionNamePrefixTemplate'] ?? null;
        $this->enabledFeatures = $values['enabledFeatures'] ?? null;
        $this->connectionConfig = $values['connectionConfig'] ?? null;
        $this->strategyOverrides = $values['strategyOverrides'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?ConnectionProfileOrganization
     */
    public function getOrganization(): ?ConnectionProfileOrganization
    {
        return $this->organization;
    }

    /**
     * @param ?ConnectionProfileOrganization $value
     */
    public function setOrganization(?ConnectionProfileOrganization $value = null): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getConnectionNamePrefixTemplate(): ?string
    {
        return $this->connectionNamePrefixTemplate;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionNamePrefixTemplate(?string $value = null): self
    {
        $this->connectionNamePrefixTemplate = $value;
        $this->_setField('connectionNamePrefixTemplate');
        return $this;
    }

    /**
     * @return ?array<value-of<EnabledFeaturesEnum>>
     */
    public function getEnabledFeatures(): ?array
    {
        return $this->enabledFeatures;
    }

    /**
     * @param ?array<value-of<EnabledFeaturesEnum>> $value
     */
    public function setEnabledFeatures(?array $value = null): self
    {
        $this->enabledFeatures = $value;
        $this->_setField('enabledFeatures');
        return $this;
    }

    /**
     * @return ?ConnectionProfileConfig
     */
    public function getConnectionConfig(): ?ConnectionProfileConfig
    {
        return $this->connectionConfig;
    }

    /**
     * @param ?ConnectionProfileConfig $value
     */
    public function setConnectionConfig(?ConnectionProfileConfig $value = null): self
    {
        $this->connectionConfig = $value;
        $this->_setField('connectionConfig');
        return $this;
    }

    /**
     * @return ?ConnectionProfileStrategyOverrides
     */
    public function getStrategyOverrides(): ?ConnectionProfileStrategyOverrides
    {
        return $this->strategyOverrides;
    }

    /**
     * @param ?ConnectionProfileStrategyOverrides $value
     */
    public function setStrategyOverrides(?ConnectionProfileStrategyOverrides $value = null): self
    {
        $this->strategyOverrides = $value;
        $this->_setField('strategyOverrides');
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
