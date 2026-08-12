<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateHookResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $triggerId Trigger ID
     */
    #[JsonProperty('triggerId')]
    private ?string $triggerId;

    /**
     * @var ?string $id ID of this hook.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name Name of this hook.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?bool $enabled Whether this hook will be executed (true) or ignored (false).
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @var ?string $script Code to be executed when this hook runs.
     */
    #[JsonProperty('script')]
    private ?string $script;

    /**
     * @var ?array<string, string> $dependencies
     */
    #[JsonProperty('dependencies'), ArrayType(['string' => 'string'])]
    private ?array $dependencies;

    /**
     * @param array{
     *   triggerId?: ?string,
     *   id?: ?string,
     *   name?: ?string,
     *   enabled?: ?bool,
     *   script?: ?string,
     *   dependencies?: ?array<string, string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->triggerId = $values['triggerId'] ?? null;
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
        $this->script = $values['script'] ?? null;
        $this->dependencies = $values['dependencies'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getTriggerId(): ?string
    {
        return $this->triggerId;
    }

    /**
     * @param ?string $value
     */
    public function setTriggerId(?string $value = null): self
    {
        $this->triggerId = $value;
        $this->_setField('triggerId');
        return $this;
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
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScript(): ?string
    {
        return $this->script;
    }

    /**
     * @param ?string $value
     */
    public function setScript(?string $value = null): self
    {
        $this->script = $value;
        $this->_setField('script');
        return $this;
    }

    /**
     * @return ?array<string, string>
     */
    public function getDependencies(): ?array
    {
        return $this->dependencies;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setDependencies(?array $value = null): self
    {
        $this->dependencies = $value;
        $this->_setField('dependencies');
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
