<?php

namespace Auth0\SDK\API\Management\Hooks\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\HookTriggerIdEnum;

class CreateHookRequestContent extends JsonSerializableType
{
    /**
     * @var string $name Name of this hook.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $script Code to be executed when this hook runs.
     */
    #[JsonProperty('script')]
    private string $script;

    /**
     * @var ?bool $enabled Whether this hook will be executed (true) or ignored (false).
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @var ?array<string, string> $dependencies
     */
    #[JsonProperty('dependencies'), ArrayType(['string' => 'string'])]
    private ?array $dependencies;

    /**
     * @var value-of<HookTriggerIdEnum> $triggerId Execution stage of this rule. Can be `credentials-exchange`, `pre-user-registration`, `post-user-registration`, `post-change-password`, or `send-phone-message`.
     */
    #[JsonProperty('triggerId')]
    private string $triggerId;

    /**
     * @param array{
     *   name: string,
     *   script: string,
     *   triggerId: value-of<HookTriggerIdEnum>,
     *   enabled?: ?bool,
     *   dependencies?: ?array<string, string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->script = $values['script'];
        $this->enabled = $values['enabled'] ?? null;
        $this->dependencies = $values['dependencies'] ?? null;
        $this->triggerId = $values['triggerId'];
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
     * @return string
     */
    public function getScript(): string
    {
        return $this->script;
    }

    /**
     * @param string $value
     */
    public function setScript(string $value): self
    {
        $this->script = $value;
        $this->_setField('script');
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
     * @return value-of<HookTriggerIdEnum>
     */
    public function getTriggerId(): string
    {
        return $this->triggerId;
    }

    /**
     * @param value-of<HookTriggerIdEnum> $value
     */
    public function setTriggerId(string $value): self
    {
        $this->triggerId = $value;
        $this->_setField('triggerId');
        return $this;
    }
}
