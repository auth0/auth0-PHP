<?php

namespace Auth0\SDK\API\Management\Actions\Modules\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\ActionModuleSecretRequest;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\ActionModuleDependencyRequest;

class CreateActionModuleRequestContent extends JsonSerializableType
{
    /**
     * @var string $name The name of the action module.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $code The source code of the action module.
     */
    #[JsonProperty('code')]
    private string $code;

    /**
     * @var ?array<ActionModuleSecretRequest> $secrets The secrets to associate with the action module.
     */
    #[JsonProperty('secrets'), ArrayType([ActionModuleSecretRequest::class])]
    private ?array $secrets;

    /**
     * @var ?array<ActionModuleDependencyRequest> $dependencies The npm dependencies of the action module.
     */
    #[JsonProperty('dependencies'), ArrayType([ActionModuleDependencyRequest::class])]
    private ?array $dependencies;

    /**
     * @var ?string $apiVersion The API version of the module.
     */
    #[JsonProperty('api_version')]
    private ?string $apiVersion;

    /**
     * @var ?bool $publish Whether to publish the module immediately after creation.
     */
    #[JsonProperty('publish')]
    private ?bool $publish;

    /**
     * @param array{
     *   name: string,
     *   code: string,
     *   secrets?: ?array<ActionModuleSecretRequest>,
     *   dependencies?: ?array<ActionModuleDependencyRequest>,
     *   apiVersion?: ?string,
     *   publish?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->code = $values['code'];
        $this->secrets = $values['secrets'] ?? null;
        $this->dependencies = $values['dependencies'] ?? null;
        $this->apiVersion = $values['apiVersion'] ?? null;
        $this->publish = $values['publish'] ?? null;
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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $value
     */
    public function setCode(string $value): self
    {
        $this->code = $value;
        $this->_setField('code');
        return $this;
    }

    /**
     * @return ?array<ActionModuleSecretRequest>
     */
    public function getSecrets(): ?array
    {
        return $this->secrets;
    }

    /**
     * @param ?array<ActionModuleSecretRequest> $value
     */
    public function setSecrets(?array $value = null): self
    {
        $this->secrets = $value;
        $this->_setField('secrets');
        return $this;
    }

    /**
     * @return ?array<ActionModuleDependencyRequest>
     */
    public function getDependencies(): ?array
    {
        return $this->dependencies;
    }

    /**
     * @param ?array<ActionModuleDependencyRequest> $value
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
    public function getApiVersion(): ?string
    {
        return $this->apiVersion;
    }

    /**
     * @param ?string $value
     */
    public function setApiVersion(?string $value = null): self
    {
        $this->apiVersion = $value;
        $this->_setField('apiVersion');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPublish(): ?bool
    {
        return $this->publish;
    }

    /**
     * @param ?bool $value
     */
    public function setPublish(?bool $value = null): self
    {
        $this->publish = $value;
        $this->_setField('publish');
        return $this;
    }
}
