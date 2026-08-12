<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class GetActionVersionResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id The unique id of an action version.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $actionId The id of the action to which this version belongs.
     */
    #[JsonProperty('action_id')]
    private ?string $actionId;

    /**
     * @var ?string $code The source code of this specific version of the action.
     */
    #[JsonProperty('code')]
    private ?string $code;

    /**
     * @var ?array<ActionVersionDependency> $dependencies The list of third party npm modules, and their versions, that this specific version depends on.
     */
    #[JsonProperty('dependencies'), ArrayType([ActionVersionDependency::class])]
    private ?array $dependencies;

    /**
     * @var ?bool $deployed Indicates if this specific version is the currently one deployed.
     */
    #[JsonProperty('deployed')]
    private ?bool $deployed;

    /**
     * @var ?string $runtime The Node runtime. For example: `node22`
     */
    #[JsonProperty('runtime')]
    private ?string $runtime;

    /**
     * @var ?array<ActionSecretResponse> $secrets The list of secrets that are included in an action or a version of an action.
     */
    #[JsonProperty('secrets'), ArrayType([ActionSecretResponse::class])]
    private ?array $secrets;

    /**
     * @var ?value-of<ActionVersionBuildStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?float $number The index of this version in list of versions for the action.
     */
    #[JsonProperty('number')]
    private ?float $number;

    /**
     * @var ?array<ActionError> $errors Any errors that occurred while the version was being built.
     */
    #[JsonProperty('errors'), ArrayType([ActionError::class])]
    private ?array $errors;

    /**
     * @var ?ActionBase $action
     */
    #[JsonProperty('action')]
    private ?ActionBase $action;

    /**
     * @var ?DateTime $builtAt The time when this version was built successfully.
     */
    #[JsonProperty('built_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $builtAt;

    /**
     * @var ?DateTime $createdAt The time when this version was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The time when a version was updated. Versions are never updated externally. Only Auth0 will update an action version as it is being built.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @var ?array<ActionTrigger> $supportedTriggers The list of triggers that this version supports. At this time, a version can only target a single trigger at a time.
     */
    #[JsonProperty('supported_triggers'), ArrayType([ActionTrigger::class])]
    private ?array $supportedTriggers;

    /**
     * @var ?array<ActionModuleReference> $modules The list of action modules and their versions used by this action version.
     */
    #[JsonProperty('modules'), ArrayType([ActionModuleReference::class])]
    private ?array $modules;

    /**
     * @param array{
     *   id?: ?string,
     *   actionId?: ?string,
     *   code?: ?string,
     *   dependencies?: ?array<ActionVersionDependency>,
     *   deployed?: ?bool,
     *   runtime?: ?string,
     *   secrets?: ?array<ActionSecretResponse>,
     *   status?: ?value-of<ActionVersionBuildStatusEnum>,
     *   number?: ?float,
     *   errors?: ?array<ActionError>,
     *   action?: ?ActionBase,
     *   builtAt?: ?DateTime,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   supportedTriggers?: ?array<ActionTrigger>,
     *   modules?: ?array<ActionModuleReference>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->actionId = $values['actionId'] ?? null;
        $this->code = $values['code'] ?? null;
        $this->dependencies = $values['dependencies'] ?? null;
        $this->deployed = $values['deployed'] ?? null;
        $this->runtime = $values['runtime'] ?? null;
        $this->secrets = $values['secrets'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->number = $values['number'] ?? null;
        $this->errors = $values['errors'] ?? null;
        $this->action = $values['action'] ?? null;
        $this->builtAt = $values['builtAt'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->supportedTriggers = $values['supportedTriggers'] ?? null;
        $this->modules = $values['modules'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getActionId(): ?string
    {
        return $this->actionId;
    }

    /**
     * @param ?string $value
     */
    public function setActionId(?string $value = null): self
    {
        $this->actionId = $value;
        $this->_setField('actionId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param ?string $value
     */
    public function setCode(?string $value = null): self
    {
        $this->code = $value;
        $this->_setField('code');
        return $this;
    }

    /**
     * @return ?array<ActionVersionDependency>
     */
    public function getDependencies(): ?array
    {
        return $this->dependencies;
    }

    /**
     * @param ?array<ActionVersionDependency> $value
     */
    public function setDependencies(?array $value = null): self
    {
        $this->dependencies = $value;
        $this->_setField('dependencies');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDeployed(): ?bool
    {
        return $this->deployed;
    }

    /**
     * @param ?bool $value
     */
    public function setDeployed(?bool $value = null): self
    {
        $this->deployed = $value;
        $this->_setField('deployed');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRuntime(): ?string
    {
        return $this->runtime;
    }

    /**
     * @param ?string $value
     */
    public function setRuntime(?string $value = null): self
    {
        $this->runtime = $value;
        $this->_setField('runtime');
        return $this;
    }

    /**
     * @return ?array<ActionSecretResponse>
     */
    public function getSecrets(): ?array
    {
        return $this->secrets;
    }

    /**
     * @param ?array<ActionSecretResponse> $value
     */
    public function setSecrets(?array $value = null): self
    {
        $this->secrets = $value;
        $this->_setField('secrets');
        return $this;
    }

    /**
     * @return ?value-of<ActionVersionBuildStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<ActionVersionBuildStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getNumber(): ?float
    {
        return $this->number;
    }

    /**
     * @param ?float $value
     */
    public function setNumber(?float $value = null): self
    {
        $this->number = $value;
        $this->_setField('number');
        return $this;
    }

    /**
     * @return ?array<ActionError>
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @param ?array<ActionError> $value
     */
    public function setErrors(?array $value = null): self
    {
        $this->errors = $value;
        $this->_setField('errors');
        return $this;
    }

    /**
     * @return ?ActionBase
     */
    public function getAction(): ?ActionBase
    {
        return $this->action;
    }

    /**
     * @param ?ActionBase $value
     */
    public function setAction(?ActionBase $value = null): self
    {
        $this->action = $value;
        $this->_setField('action');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getBuiltAt(): ?DateTime
    {
        return $this->builtAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setBuiltAt(?DateTime $value = null): self
    {
        $this->builtAt = $value;
        $this->_setField('builtAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setUpdatedAt(?DateTime $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return ?array<ActionTrigger>
     */
    public function getSupportedTriggers(): ?array
    {
        return $this->supportedTriggers;
    }

    /**
     * @param ?array<ActionTrigger> $value
     */
    public function setSupportedTriggers(?array $value = null): self
    {
        $this->supportedTriggers = $value;
        $this->_setField('supportedTriggers');
        return $this;
    }

    /**
     * @return ?array<ActionModuleReference>
     */
    public function getModules(): ?array
    {
        return $this->modules;
    }

    /**
     * @param ?array<ActionModuleReference> $value
     */
    public function setModules(?array $value = null): self
    {
        $this->modules = $value;
        $this->_setField('modules');
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
