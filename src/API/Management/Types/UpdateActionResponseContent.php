<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class UpdateActionResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id The unique ID of the action.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name The name of an action.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?array<ActionTrigger> $supportedTriggers The list of triggers that this action supports. At this time, an action can only target a single trigger at a time.
     */
    #[JsonProperty('supported_triggers'), ArrayType([ActionTrigger::class])]
    private ?array $supportedTriggers;

    /**
     * @var ?bool $allChangesDeployed True if all of an Action's contents have been deployed.
     */
    #[JsonProperty('all_changes_deployed')]
    private ?bool $allChangesDeployed;

    /**
     * @var ?DateTime $createdAt The time when this action was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The time when this action was updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @var ?string $code The source code of the action.
     */
    #[JsonProperty('code')]
    private ?string $code;

    /**
     * @var ?array<ActionVersionDependency> $dependencies The list of third party npm modules, and their versions, that this action depends on.
     */
    #[JsonProperty('dependencies'), ArrayType([ActionVersionDependency::class])]
    private ?array $dependencies;

    /**
     * @var ?string $runtime The Node runtime. For example: `node22`, defaults to `node22`
     */
    #[JsonProperty('runtime')]
    private ?string $runtime;

    /**
     * @var ?array<ActionSecretResponse> $secrets The list of secrets that are included in an action or a version of an action.
     */
    #[JsonProperty('secrets'), ArrayType([ActionSecretResponse::class])]
    private ?array $secrets;

    /**
     * @var ?ActionDeployedVersion $deployedVersion
     */
    #[JsonProperty('deployed_version')]
    private ?ActionDeployedVersion $deployedVersion;

    /**
     * @var ?string $installedIntegrationId installed_integration_id is the fk reference to the InstalledIntegration entity.
     */
    #[JsonProperty('installed_integration_id')]
    private ?string $installedIntegrationId;

    /**
     * @var ?Integration $integration
     */
    #[JsonProperty('integration')]
    private ?Integration $integration;

    /**
     * @var ?value-of<ActionBuildStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?DateTime $builtAt The time when this action was built successfully.
     */
    #[JsonProperty('built_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $builtAt;

    /**
     * @var ?bool $deploy True if the action should be deployed after creation.
     */
    #[JsonProperty('deploy')]
    private ?bool $deploy;

    /**
     * @var ?array<ActionModuleReference> $modules The list of action modules and their versions used by this action.
     */
    #[JsonProperty('modules'), ArrayType([ActionModuleReference::class])]
    private ?array $modules;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   supportedTriggers?: ?array<ActionTrigger>,
     *   allChangesDeployed?: ?bool,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   code?: ?string,
     *   dependencies?: ?array<ActionVersionDependency>,
     *   runtime?: ?string,
     *   secrets?: ?array<ActionSecretResponse>,
     *   deployedVersion?: ?ActionDeployedVersion,
     *   installedIntegrationId?: ?string,
     *   integration?: ?Integration,
     *   status?: ?value-of<ActionBuildStatusEnum>,
     *   builtAt?: ?DateTime,
     *   deploy?: ?bool,
     *   modules?: ?array<ActionModuleReference>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->supportedTriggers = $values['supportedTriggers'] ?? null;
        $this->allChangesDeployed = $values['allChangesDeployed'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->code = $values['code'] ?? null;
        $this->dependencies = $values['dependencies'] ?? null;
        $this->runtime = $values['runtime'] ?? null;
        $this->secrets = $values['secrets'] ?? null;
        $this->deployedVersion = $values['deployedVersion'] ?? null;
        $this->installedIntegrationId = $values['installedIntegrationId'] ?? null;
        $this->integration = $values['integration'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->builtAt = $values['builtAt'] ?? null;
        $this->deploy = $values['deploy'] ?? null;
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
     * @return ?bool
     */
    public function getAllChangesDeployed(): ?bool
    {
        return $this->allChangesDeployed;
    }

    /**
     * @param ?bool $value
     */
    public function setAllChangesDeployed(?bool $value = null): self
    {
        $this->allChangesDeployed = $value;
        $this->_setField('allChangesDeployed');
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
     * @return ?ActionDeployedVersion
     */
    public function getDeployedVersion(): ?ActionDeployedVersion
    {
        return $this->deployedVersion;
    }

    /**
     * @param ?ActionDeployedVersion $value
     */
    public function setDeployedVersion(?ActionDeployedVersion $value = null): self
    {
        $this->deployedVersion = $value;
        $this->_setField('deployedVersion');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getInstalledIntegrationId(): ?string
    {
        return $this->installedIntegrationId;
    }

    /**
     * @param ?string $value
     */
    public function setInstalledIntegrationId(?string $value = null): self
    {
        $this->installedIntegrationId = $value;
        $this->_setField('installedIntegrationId');
        return $this;
    }

    /**
     * @return ?Integration
     */
    public function getIntegration(): ?Integration
    {
        return $this->integration;
    }

    /**
     * @param ?Integration $value
     */
    public function setIntegration(?Integration $value = null): self
    {
        $this->integration = $value;
        $this->_setField('integration');
        return $this;
    }

    /**
     * @return ?value-of<ActionBuildStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<ActionBuildStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
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
     * @return ?bool
     */
    public function getDeploy(): ?bool
    {
        return $this->deploy;
    }

    /**
     * @param ?bool $value
     */
    public function setDeploy(?bool $value = null): self
    {
        $this->deploy = $value;
        $this->_setField('deploy');
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
