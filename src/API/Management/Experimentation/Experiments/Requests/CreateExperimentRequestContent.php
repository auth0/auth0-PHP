<?php

namespace Auth0\SDK\API\Management\Experimentation\Experiments\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\AuthenticationFlowEnum;
use Auth0\SDK\API\Management\Types\DefaultConfigEnum;
use Auth0\SDK\API\Management\Types\AllocationStrategyEnum;
use Auth0\SDK\API\Management\Types\AllocationRequestItem;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateExperimentRequestContent extends JsonSerializableType
{
    /**
     * @var string $name A human-readable name for the experiment
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description A description of the experiment
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var string $featureFlagId The ID of the feature flag this experiment is based on
     */
    #[JsonProperty('feature_flag_id')]
    private string $featureFlagId;

    /**
     * @var value-of<AuthenticationFlowEnum> $authenticationFlow
     */
    #[JsonProperty('authentication_flow')]
    private string $authenticationFlow;

    /**
     * @var ?value-of<DefaultConfigEnum> $defaultConfig Applies only to Auth0-managed flags. Controls where non-overridden config keys resolve from: 'tenant' inherits the tenant's live config so the experiment overlays only its changes, 'flag' uses the flag's frozen defaults for a complete config. Optional; defaults to 'tenant' when omitted. Rejected for customer-defined flags.
     */
    #[JsonProperty('default_config')]
    private ?string $defaultConfig;

    /**
     * @var ?value-of<AllocationStrategyEnum> $allocationStrategy The traffic allocation strategy for this experiment
     */
    #[JsonProperty('allocation_strategy')]
    private ?string $allocationStrategy;

    /**
     * @var ?array<AllocationRequestItem> $allocations Traffic allocations mapping variations to weights or segments
     */
    #[JsonProperty('allocations'), ArrayType([AllocationRequestItem::class])]
    private ?array $allocations;

    /**
     * @var ?array<int> $levels Ramp experiment levels configuration. A strictly-increasing sequence of exposure percentages, each an integer in [0, 100].
     */
    #[JsonProperty('levels'), ArrayType(['integer'])]
    private ?array $levels;

    /**
     * @param array{
     *   name: string,
     *   featureFlagId: string,
     *   authenticationFlow: value-of<AuthenticationFlowEnum>,
     *   description?: ?string,
     *   defaultConfig?: ?value-of<DefaultConfigEnum>,
     *   allocationStrategy?: ?value-of<AllocationStrategyEnum>,
     *   allocations?: ?array<AllocationRequestItem>,
     *   levels?: ?array<int>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->featureFlagId = $values['featureFlagId'];
        $this->authenticationFlow = $values['authenticationFlow'];
        $this->defaultConfig = $values['defaultConfig'] ?? null;
        $this->allocationStrategy = $values['allocationStrategy'] ?? null;
        $this->allocations = $values['allocations'] ?? null;
        $this->levels = $values['levels'] ?? null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return string
     */
    public function getFeatureFlagId(): string
    {
        return $this->featureFlagId;
    }

    /**
     * @param string $value
     */
    public function setFeatureFlagId(string $value): self
    {
        $this->featureFlagId = $value;
        $this->_setField('featureFlagId');
        return $this;
    }

    /**
     * @return value-of<AuthenticationFlowEnum>
     */
    public function getAuthenticationFlow(): string
    {
        return $this->authenticationFlow;
    }

    /**
     * @param value-of<AuthenticationFlowEnum> $value
     */
    public function setAuthenticationFlow(string $value): self
    {
        $this->authenticationFlow = $value;
        $this->_setField('authenticationFlow');
        return $this;
    }

    /**
     * @return ?value-of<DefaultConfigEnum>
     */
    public function getDefaultConfig(): ?string
    {
        return $this->defaultConfig;
    }

    /**
     * @param ?value-of<DefaultConfigEnum> $value
     */
    public function setDefaultConfig(?string $value = null): self
    {
        $this->defaultConfig = $value;
        $this->_setField('defaultConfig');
        return $this;
    }

    /**
     * @return ?value-of<AllocationStrategyEnum>
     */
    public function getAllocationStrategy(): ?string
    {
        return $this->allocationStrategy;
    }

    /**
     * @param ?value-of<AllocationStrategyEnum> $value
     */
    public function setAllocationStrategy(?string $value = null): self
    {
        $this->allocationStrategy = $value;
        $this->_setField('allocationStrategy');
        return $this;
    }

    /**
     * @return ?array<AllocationRequestItem>
     */
    public function getAllocations(): ?array
    {
        return $this->allocations;
    }

    /**
     * @param ?array<AllocationRequestItem> $value
     */
    public function setAllocations(?array $value = null): self
    {
        $this->allocations = $value;
        $this->_setField('allocations');
        return $this;
    }

    /**
     * @return ?array<int>
     */
    public function getLevels(): ?array
    {
        return $this->levels;
    }

    /**
     * @param ?array<int> $value
     */
    public function setLevels(?array $value = null): self
    {
        $this->levels = $value;
        $this->_setField('levels');
        return $this;
    }
}
