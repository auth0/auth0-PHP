<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class UpdateExperimentResponseContent extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var string $featureFlagId
     */
    #[JsonProperty('feature_flag_id')]
    private string $featureFlagId;

    /**
     * @var ?string $featureFlagName
     */
    #[JsonProperty('feature_flag_name')]
    private ?string $featureFlagName;

    /**
     * @var string $authenticationFlow
     */
    #[JsonProperty('authentication_flow')]
    private string $authenticationFlow;

    /**
     * @var value-of<AllocationStrategyEnum> $allocationStrategy
     */
    #[JsonProperty('allocation_strategy')]
    private string $allocationStrategy;

    /**
     * @var value-of<ExperimentStatusEnum> $status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @var bool $isValid
     */
    #[JsonProperty('is_valid')]
    private bool $isValid;

    /**
     * @var ?value-of<DefaultConfigEnum> $defaultConfig
     */
    #[JsonProperty('default_config')]
    private ?string $defaultConfig;

    /**
     * @var ?array<string, mixed> $featureFlagSnapshot
     */
    #[JsonProperty('feature_flag_snapshot'), ArrayType(['string' => 'mixed'])]
    private ?array $featureFlagSnapshot;

    /**
     * @var array<AllocationItem> $allocations
     */
    #[JsonProperty('allocations'), ArrayType([AllocationItem::class])]
    private array $allocations;

    /**
     * @var array<string> $editableFields Fields that may be mutated given the experiment's current status. Computed at response time; always current with the API's enforcement logic.
     */
    #[JsonProperty('editable_fields'), ArrayType(['string'])]
    private array $editableFields;

    /**
     * @var ?array<int> $levels Ramp experiment levels configuration.
     */
    #[JsonProperty('levels'), ArrayType(['integer'])]
    private ?array $levels;

    /**
     * @var ?int $currentLevel Read-only. The active exposure percentage for the current ramp step. Null when no ramp schedule is active.
     */
    #[JsonProperty('current_level')]
    private ?int $currentLevel;

    /**
     * @var ?DateTime $startedAt
     */
    #[JsonProperty('started_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $startedAt;

    /**
     * @var ?DateTime $endedAt
     */
    #[JsonProperty('ended_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $endedAt;

    /**
     * @var DateTime $createdAt
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   featureFlagId: string,
     *   authenticationFlow: string,
     *   allocationStrategy: value-of<AllocationStrategyEnum>,
     *   status: value-of<ExperimentStatusEnum>,
     *   isValid: bool,
     *   allocations: array<AllocationItem>,
     *   editableFields: array<string>,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   description?: ?string,
     *   featureFlagName?: ?string,
     *   defaultConfig?: ?value-of<DefaultConfigEnum>,
     *   featureFlagSnapshot?: ?array<string, mixed>,
     *   levels?: ?array<int>,
     *   currentLevel?: ?int,
     *   startedAt?: ?DateTime,
     *   endedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->featureFlagId = $values['featureFlagId'];
        $this->featureFlagName = $values['featureFlagName'] ?? null;
        $this->authenticationFlow = $values['authenticationFlow'];
        $this->allocationStrategy = $values['allocationStrategy'];
        $this->status = $values['status'];
        $this->isValid = $values['isValid'];
        $this->defaultConfig = $values['defaultConfig'] ?? null;
        $this->featureFlagSnapshot = $values['featureFlagSnapshot'] ?? null;
        $this->allocations = $values['allocations'];
        $this->editableFields = $values['editableFields'];
        $this->levels = $values['levels'] ?? null;
        $this->currentLevel = $values['currentLevel'] ?? null;
        $this->startedAt = $values['startedAt'] ?? null;
        $this->endedAt = $values['endedAt'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
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
     * @return ?string
     */
    public function getFeatureFlagName(): ?string
    {
        return $this->featureFlagName;
    }

    /**
     * @param ?string $value
     */
    public function setFeatureFlagName(?string $value = null): self
    {
        $this->featureFlagName = $value;
        $this->_setField('featureFlagName');
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthenticationFlow(): string
    {
        return $this->authenticationFlow;
    }

    /**
     * @param string $value
     */
    public function setAuthenticationFlow(string $value): self
    {
        $this->authenticationFlow = $value;
        $this->_setField('authenticationFlow');
        return $this;
    }

    /**
     * @return value-of<AllocationStrategyEnum>
     */
    public function getAllocationStrategy(): string
    {
        return $this->allocationStrategy;
    }

    /**
     * @param value-of<AllocationStrategyEnum> $value
     */
    public function setAllocationStrategy(string $value): self
    {
        $this->allocationStrategy = $value;
        $this->_setField('allocationStrategy');
        return $this;
    }

    /**
     * @return value-of<ExperimentStatusEnum>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param value-of<ExperimentStatusEnum> $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $value
     */
    public function setIsValid(bool $value): self
    {
        $this->isValid = $value;
        $this->_setField('isValid');
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
     * @return ?array<string, mixed>
     */
    public function getFeatureFlagSnapshot(): ?array
    {
        return $this->featureFlagSnapshot;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setFeatureFlagSnapshot(?array $value = null): self
    {
        $this->featureFlagSnapshot = $value;
        $this->_setField('featureFlagSnapshot');
        return $this;
    }

    /**
     * @return array<AllocationItem>
     */
    public function getAllocations(): array
    {
        return $this->allocations;
    }

    /**
     * @param array<AllocationItem> $value
     */
    public function setAllocations(array $value): self
    {
        $this->allocations = $value;
        $this->_setField('allocations');
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getEditableFields(): array
    {
        return $this->editableFields;
    }

    /**
     * @param array<string> $value
     */
    public function setEditableFields(array $value): self
    {
        $this->editableFields = $value;
        $this->_setField('editableFields');
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

    /**
     * @return ?int
     */
    public function getCurrentLevel(): ?int
    {
        return $this->currentLevel;
    }

    /**
     * @param ?int $value
     */
    public function setCurrentLevel(?int $value = null): self
    {
        $this->currentLevel = $value;
        $this->_setField('currentLevel');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getStartedAt(): ?DateTime
    {
        return $this->startedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setStartedAt(?DateTime $value = null): self
    {
        $this->startedAt = $value;
        $this->_setField('startedAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getEndedAt(): ?DateTime
    {
        return $this->endedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setEndedAt(?DateTime $value = null): self
    {
        $this->endedAt = $value;
        $this->_setField('endedAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
