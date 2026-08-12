<?php

namespace Auth0\SDK\API\Management\Actions\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\ActionTrigger;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\ActionVersionDependency;
use Auth0\SDK\API\Management\Types\ActionSecretRequest;
use Auth0\SDK\API\Management\Types\ActionModuleReference;

class CreateActionRequestContent extends JsonSerializableType
{
    /**
     * @var string $name The name of an action.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var array<ActionTrigger> $supportedTriggers The list of triggers that this action supports. At this time, an action can only target a single trigger at a time.
     */
    #[JsonProperty('supported_triggers'), ArrayType([ActionTrigger::class])]
    private array $supportedTriggers;

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
     * @var ?array<ActionSecretRequest> $secrets The list of secrets that are included in an action or a version of an action.
     */
    #[JsonProperty('secrets'), ArrayType([ActionSecretRequest::class])]
    private ?array $secrets;

    /**
     * @var ?array<ActionModuleReference> $modules The list of action modules and their versions used by this action.
     */
    #[JsonProperty('modules'), ArrayType([ActionModuleReference::class])]
    private ?array $modules;

    /**
     * @var ?bool $deploy True if the action should be deployed after creation.
     */
    #[JsonProperty('deploy')]
    private ?bool $deploy;

    /**
     * @param array{
     *   name: string,
     *   supportedTriggers: array<ActionTrigger>,
     *   code?: ?string,
     *   dependencies?: ?array<ActionVersionDependency>,
     *   runtime?: ?string,
     *   secrets?: ?array<ActionSecretRequest>,
     *   modules?: ?array<ActionModuleReference>,
     *   deploy?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->supportedTriggers = $values['supportedTriggers'];
        $this->code = $values['code'] ?? null;
        $this->dependencies = $values['dependencies'] ?? null;
        $this->runtime = $values['runtime'] ?? null;
        $this->secrets = $values['secrets'] ?? null;
        $this->modules = $values['modules'] ?? null;
        $this->deploy = $values['deploy'] ?? null;
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
     * @return array<ActionTrigger>
     */
    public function getSupportedTriggers(): array
    {
        return $this->supportedTriggers;
    }

    /**
     * @param array<ActionTrigger> $value
     */
    public function setSupportedTriggers(array $value): self
    {
        $this->supportedTriggers = $value;
        $this->_setField('supportedTriggers');
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
     * @return ?array<ActionSecretRequest>
     */
    public function getSecrets(): ?array
    {
        return $this->secrets;
    }

    /**
     * @param ?array<ActionSecretRequest> $value
     */
    public function setSecrets(?array $value = null): self
    {
        $this->secrets = $value;
        $this->_setField('secrets');
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
}
