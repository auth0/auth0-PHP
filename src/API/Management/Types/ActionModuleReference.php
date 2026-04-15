<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Reference to a module and its version used by an action.
 */
class ActionModuleReference extends JsonSerializableType
{
    /**
     * @var ?string $moduleId The unique ID of the module.
     */
    #[JsonProperty('module_id')]
    private ?string $moduleId;

    /**
     * @var ?string $moduleName The name of the module.
     */
    #[JsonProperty('module_name')]
    private ?string $moduleName;

    /**
     * @var ?string $moduleVersionId The ID of the specific module version.
     */
    #[JsonProperty('module_version_id')]
    private ?string $moduleVersionId;

    /**
     * @var ?int $moduleVersionNumber The version number of the module.
     */
    #[JsonProperty('module_version_number')]
    private ?int $moduleVersionNumber;

    /**
     * @param array{
     *   moduleId?: ?string,
     *   moduleName?: ?string,
     *   moduleVersionId?: ?string,
     *   moduleVersionNumber?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->moduleId = $values['moduleId'] ?? null;
        $this->moduleName = $values['moduleName'] ?? null;
        $this->moduleVersionId = $values['moduleVersionId'] ?? null;
        $this->moduleVersionNumber = $values['moduleVersionNumber'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getModuleId(): ?string
    {
        return $this->moduleId;
    }

    /**
     * @param ?string $value
     */
    public function setModuleId(?string $value = null): self
    {
        $this->moduleId = $value;
        $this->_setField('moduleId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getModuleName(): ?string
    {
        return $this->moduleName;
    }

    /**
     * @param ?string $value
     */
    public function setModuleName(?string $value = null): self
    {
        $this->moduleName = $value;
        $this->_setField('moduleName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getModuleVersionId(): ?string
    {
        return $this->moduleVersionId;
    }

    /**
     * @param ?string $value
     */
    public function setModuleVersionId(?string $value = null): self
    {
        $this->moduleVersionId = $value;
        $this->_setField('moduleVersionId');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getModuleVersionNumber(): ?int
    {
        return $this->moduleVersionNumber;
    }

    /**
     * @param ?int $value
     */
    public function setModuleVersionNumber(?int $value = null): self
    {
        $this->moduleVersionNumber = $value;
        $this->_setField('moduleVersionNumber');
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
