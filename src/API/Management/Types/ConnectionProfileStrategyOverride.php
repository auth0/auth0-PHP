<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Connection Profile Strategy Override
 */
class ConnectionProfileStrategyOverride extends JsonSerializableType
{
    /**
     * @var ?array<value-of<EnabledFeaturesEnum>> $enabledFeatures
     */
    #[JsonProperty('enabled_features'), ArrayType(['string'])]
    private ?array $enabledFeatures;

    /**
     * @var ?ConnectionProfileStrategyOverridesConnectionConfig $connectionConfig
     */
    #[JsonProperty('connection_config')]
    private ?ConnectionProfileStrategyOverridesConnectionConfig $connectionConfig;

    /**
     * @param array{
     *   enabledFeatures?: ?array<value-of<EnabledFeaturesEnum>>,
     *   connectionConfig?: ?ConnectionProfileStrategyOverridesConnectionConfig,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabledFeatures = $values['enabledFeatures'] ?? null;
        $this->connectionConfig = $values['connectionConfig'] ?? null;
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
     * @return ?ConnectionProfileStrategyOverridesConnectionConfig
     */
    public function getConnectionConfig(): ?ConnectionProfileStrategyOverridesConnectionConfig
    {
        return $this->connectionConfig;
    }

    /**
     * @param ?ConnectionProfileStrategyOverridesConnectionConfig $value
     */
    public function setConnectionConfig(?ConnectionProfileStrategyOverridesConnectionConfig $value = null): self
    {
        $this->connectionConfig = $value;
        $this->_setField('connectionConfig');
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
