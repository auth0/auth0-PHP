<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ActionModuleAction extends JsonSerializableType
{
    /**
     * @var ?string $actionId The unique ID of the action.
     */
    #[JsonProperty('action_id')]
    private ?string $actionId;

    /**
     * @var ?string $actionName The name of the action.
     */
    #[JsonProperty('action_name')]
    private ?string $actionName;

    /**
     * @var ?string $moduleVersionId The ID of the module version this action is using.
     */
    #[JsonProperty('module_version_id')]
    private ?string $moduleVersionId;

    /**
     * @var ?int $moduleVersionNumber The version number of the module this action is using.
     */
    #[JsonProperty('module_version_number')]
    private ?int $moduleVersionNumber;

    /**
     * @var ?array<ActionTrigger> $supportedTriggers The triggers that this action supports.
     */
    #[JsonProperty('supported_triggers'), ArrayType([ActionTrigger::class])]
    private ?array $supportedTriggers;

    /**
     * @param array{
     *   actionId?: ?string,
     *   actionName?: ?string,
     *   moduleVersionId?: ?string,
     *   moduleVersionNumber?: ?int,
     *   supportedTriggers?: ?array<ActionTrigger>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->actionId = $values['actionId'] ?? null;
        $this->actionName = $values['actionName'] ?? null;
        $this->moduleVersionId = $values['moduleVersionId'] ?? null;
        $this->moduleVersionNumber = $values['moduleVersionNumber'] ?? null;
        $this->supportedTriggers = $values['supportedTriggers'] ?? null;
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
    public function getActionName(): ?string
    {
        return $this->actionName;
    }

    /**
     * @param ?string $value
     */
    public function setActionName(?string $value = null): self
    {
        $this->actionName = $value;
        $this->_setField('actionName');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
