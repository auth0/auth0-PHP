<?php

namespace Auth0\SDK\API\Management\Experimentation\Experiments\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\AuthenticationFlowEnum;
use Auth0\SDK\API\Management\Types\AllocationRequestItem;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\DefaultConfigEnum;

class UpdateExperimentRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $name A human-readable name for the experiment
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $description A description of the experiment
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?value-of<AuthenticationFlowEnum> $authenticationFlow Specifies the target authentication flow for this experiment. This field can only be modified on draft experiments. Must be one of: authentication, mfa_enrollment, mfa_challenge, password_reset, passkey_enrollment, or all. Note that the all value targets every flow at once, but requires that this is the only active experiment.
     */
    #[JsonProperty('authentication_flow')]
    private ?string $authenticationFlow;

    /**
     * @var ?array<AllocationRequestItem> $allocations Replaces all traffic allocations. Cannot be modified while the experiment is active.
     */
    #[JsonProperty('allocations'), ArrayType([AllocationRequestItem::class])]
    private ?array $allocations;

    /**
     * @var ?value-of<DefaultConfigEnum> $defaultConfig Applies only to Auth0-managed flags. Controls where non-overridden config keys resolve from: 'tenant' inherits the tenant's live config, 'flag' uses the flag's frozen defaults. Can only be modified on draft experiments. Rejected for customer-defined flags.
     */
    #[JsonProperty('default_config')]
    private ?string $defaultConfig;

    /**
     * @var ?array<int> $levels Ramp experiment levels configuration. A strictly-increasing sequence of exposure percentages, each an integer in [0, 100]. Can only be modified on draft experiments.
     */
    #[JsonProperty('levels'), ArrayType(['integer'])]
    private ?array $levels;

    /**
     * @param array{
     *   name?: ?string,
     *   description?: ?string,
     *   authenticationFlow?: ?value-of<AuthenticationFlowEnum>,
     *   allocations?: ?array<AllocationRequestItem>,
     *   defaultConfig?: ?value-of<DefaultConfigEnum>,
     *   levels?: ?array<int>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->authenticationFlow = $values['authenticationFlow'] ?? null;
        $this->allocations = $values['allocations'] ?? null;
        $this->defaultConfig = $values['defaultConfig'] ?? null;
        $this->levels = $values['levels'] ?? null;
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
     * @return ?value-of<AuthenticationFlowEnum>
     */
    public function getAuthenticationFlow(): ?string
    {
        return $this->authenticationFlow;
    }

    /**
     * @param ?value-of<AuthenticationFlowEnum> $value
     */
    public function setAuthenticationFlow(?string $value = null): self
    {
        $this->authenticationFlow = $value;
        $this->_setField('authenticationFlow');
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
