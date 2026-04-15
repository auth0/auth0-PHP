<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * The latest published version as a reference object. Omitted if no versions have been published.
 */
class ActionModuleVersionReference extends JsonSerializableType
{
    /**
     * @var ?string $id The unique ID of the version.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?int $versionNumber The version number.
     */
    #[JsonProperty('version_number')]
    private ?int $versionNumber;

    /**
     * @var ?string $code The source code from this version.
     */
    #[JsonProperty('code')]
    private ?string $code;

    /**
     * @var ?array<ActionModuleDependency> $dependencies The npm dependencies from this version.
     */
    #[JsonProperty('dependencies'), ArrayType([ActionModuleDependency::class])]
    private ?array $dependencies;

    /**
     * @var ?array<ActionModuleSecret> $secrets The secrets from this version (names and timestamps only, values never returned).
     */
    #[JsonProperty('secrets'), ArrayType([ActionModuleSecret::class])]
    private ?array $secrets;

    /**
     * @var ?DateTime $createdAt Timestamp when the version was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @param array{
     *   id?: ?string,
     *   versionNumber?: ?int,
     *   code?: ?string,
     *   dependencies?: ?array<ActionModuleDependency>,
     *   secrets?: ?array<ActionModuleSecret>,
     *   createdAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->versionNumber = $values['versionNumber'] ?? null;
        $this->code = $values['code'] ?? null;
        $this->dependencies = $values['dependencies'] ?? null;
        $this->secrets = $values['secrets'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
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
     * @return ?int
     */
    public function getVersionNumber(): ?int
    {
        return $this->versionNumber;
    }

    /**
     * @param ?int $value
     */
    public function setVersionNumber(?int $value = null): self
    {
        $this->versionNumber = $value;
        $this->_setField('versionNumber');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
