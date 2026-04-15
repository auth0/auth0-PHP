<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class RollbackActionModuleResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id The unique ID of the module.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name The name of the module.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $code The source code from the module's draft version.
     */
    #[JsonProperty('code')]
    private ?string $code;

    /**
     * @var ?array<ActionModuleDependency> $dependencies The npm dependencies from the module's draft version.
     */
    #[JsonProperty('dependencies'), ArrayType([ActionModuleDependency::class])]
    private ?array $dependencies;

    /**
     * @var ?array<ActionModuleSecret> $secrets The secrets from the module's draft version (names and timestamps only, values never returned).
     */
    #[JsonProperty('secrets'), ArrayType([ActionModuleSecret::class])]
    private ?array $secrets;

    /**
     * @var ?int $actionsUsingModuleTotal The number of deployed actions using this module.
     */
    #[JsonProperty('actions_using_module_total')]
    private ?int $actionsUsingModuleTotal;

    /**
     * @var ?bool $allChangesPublished Whether all draft changes have been published as a version.
     */
    #[JsonProperty('all_changes_published')]
    private ?bool $allChangesPublished;

    /**
     * @var ?int $latestVersionNumber The version number of the latest published version. Omitted if no versions have been published.
     */
    #[JsonProperty('latest_version_number')]
    private ?int $latestVersionNumber;

    /**
     * @var ?DateTime $createdAt Timestamp when the module was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt Timestamp when the module was last updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @var ?ActionModuleVersionReference $latestVersion
     */
    #[JsonProperty('latest_version')]
    private ?ActionModuleVersionReference $latestVersion;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   code?: ?string,
     *   dependencies?: ?array<ActionModuleDependency>,
     *   secrets?: ?array<ActionModuleSecret>,
     *   actionsUsingModuleTotal?: ?int,
     *   allChangesPublished?: ?bool,
     *   latestVersionNumber?: ?int,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   latestVersion?: ?ActionModuleVersionReference,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->code = $values['code'] ?? null;
        $this->dependencies = $values['dependencies'] ?? null;
        $this->secrets = $values['secrets'] ?? null;
        $this->actionsUsingModuleTotal = $values['actionsUsingModuleTotal'] ?? null;
        $this->allChangesPublished = $values['allChangesPublished'] ?? null;
        $this->latestVersionNumber = $values['latestVersionNumber'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->latestVersion = $values['latestVersion'] ?? null;
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
     * @return ?array<ActionModuleDependency>
     */
    public function getDependencies(): ?array
    {
        return $this->dependencies;
    }

    /**
     * @param ?array<ActionModuleDependency> $value
     */
    public function setDependencies(?array $value = null): self
    {
        $this->dependencies = $value;
        $this->_setField('dependencies');
        return $this;
    }

    /**
     * @return ?array<ActionModuleSecret>
     */
    public function getSecrets(): ?array
    {
        return $this->secrets;
    }

    /**
     * @param ?array<ActionModuleSecret> $value
     */
    public function setSecrets(?array $value = null): self
    {
        $this->secrets = $value;
        $this->_setField('secrets');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getActionsUsingModuleTotal(): ?int
    {
        return $this->actionsUsingModuleTotal;
    }

    /**
     * @param ?int $value
     */
    public function setActionsUsingModuleTotal(?int $value = null): self
    {
        $this->actionsUsingModuleTotal = $value;
        $this->_setField('actionsUsingModuleTotal');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllChangesPublished(): ?bool
    {
        return $this->allChangesPublished;
    }

    /**
     * @param ?bool $value
     */
    public function setAllChangesPublished(?bool $value = null): self
    {
        $this->allChangesPublished = $value;
        $this->_setField('allChangesPublished');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLatestVersionNumber(): ?int
    {
        return $this->latestVersionNumber;
    }

    /**
     * @param ?int $value
     */
    public function setLatestVersionNumber(?int $value = null): self
    {
        $this->latestVersionNumber = $value;
        $this->_setField('latestVersionNumber');
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
     * @return ?ActionModuleVersionReference
     */
    public function getLatestVersion(): ?ActionModuleVersionReference
    {
        return $this->latestVersion;
    }

    /**
     * @param ?ActionModuleVersionReference $value
     */
    public function setLatestVersion(?ActionModuleVersionReference $value = null): self
    {
        $this->latestVersion = $value;
        $this->_setField('latestVersion');
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
