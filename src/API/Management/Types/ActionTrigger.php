<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ActionTrigger extends JsonSerializableType
{
    /**
     * @var value-of<ActionTriggerTypeEnum> $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?string $version The version of a trigger. v1, v2, etc.
     */
    #[JsonProperty('version')]
    private ?string $version;

    /**
     * @var ?string $status status points to the trigger status.
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?array<string> $runtimes runtimes supported by this trigger.
     */
    #[JsonProperty('runtimes'), ArrayType(['string'])]
    private ?array $runtimes;

    /**
     * @var ?string $defaultRuntime Runtime that will be used when none is specified when creating an action.
     */
    #[JsonProperty('default_runtime')]
    private ?string $defaultRuntime;

    /**
     * @var ?array<ActionTriggerCompatibleTrigger> $compatibleTriggers compatible_triggers informs which other trigger supports the same event and api.
     */
    #[JsonProperty('compatible_triggers'), ArrayType([ActionTriggerCompatibleTrigger::class])]
    private ?array $compatibleTriggers;

    /**
     * @var ?value-of<ActionBindingTypeEnum> $bindingPolicy
     */
    #[JsonProperty('binding_policy')]
    private ?string $bindingPolicy;

    /**
     * @param array{
     *   id: value-of<ActionTriggerTypeEnum>,
     *   version?: ?string,
     *   status?: ?string,
     *   runtimes?: ?array<string>,
     *   defaultRuntime?: ?string,
     *   compatibleTriggers?: ?array<ActionTriggerCompatibleTrigger>,
     *   bindingPolicy?: ?value-of<ActionBindingTypeEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->version = $values['version'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->runtimes = $values['runtimes'] ?? null;
        $this->defaultRuntime = $values['defaultRuntime'] ?? null;
        $this->compatibleTriggers = $values['compatibleTriggers'] ?? null;
        $this->bindingPolicy = $values['bindingPolicy'] ?? null;
    }

    /**
     * @return value-of<ActionTriggerTypeEnum>
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param value-of<ActionTriggerTypeEnum> $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @param ?string $value
     */
    public function setVersion(?string $value = null): self
    {
        $this->version = $value;
        $this->_setField('version');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?string $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getRuntimes(): ?array
    {
        return $this->runtimes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setRuntimes(?array $value = null): self
    {
        $this->runtimes = $value;
        $this->_setField('runtimes');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDefaultRuntime(): ?string
    {
        return $this->defaultRuntime;
    }

    /**
     * @param ?string $value
     */
    public function setDefaultRuntime(?string $value = null): self
    {
        $this->defaultRuntime = $value;
        $this->_setField('defaultRuntime');
        return $this;
    }

    /**
     * @return ?array<ActionTriggerCompatibleTrigger>
     */
    public function getCompatibleTriggers(): ?array
    {
        return $this->compatibleTriggers;
    }

    /**
     * @param ?array<ActionTriggerCompatibleTrigger> $value
     */
    public function setCompatibleTriggers(?array $value = null): self
    {
        $this->compatibleTriggers = $value;
        $this->_setField('compatibleTriggers');
        return $this;
    }

    /**
     * @return ?value-of<ActionBindingTypeEnum>
     */
    public function getBindingPolicy(): ?string
    {
        return $this->bindingPolicy;
    }

    /**
     * @param ?value-of<ActionBindingTypeEnum> $value
     */
    public function setBindingPolicy(?string $value = null): self
    {
        $this->bindingPolicy = $value;
        $this->_setField('bindingPolicy');
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
