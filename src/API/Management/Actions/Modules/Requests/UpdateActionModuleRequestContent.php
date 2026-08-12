<?php

namespace Auth0\SDK\API\Management\Actions\Modules\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\ActionModuleSecretRequest;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\ActionModuleDependencyRequest;

class UpdateActionModuleRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $code The source code of the action module.
     */
    #[JsonProperty('code')]
    private ?string $code;

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
     * @param array{
     *   code?: ?string,
     *   secrets?: ?array<ActionModuleSecretRequest>,
     *   dependencies?: ?array<ActionModuleDependencyRequest>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->code = $values['code'] ?? null;
        $this->secrets = $values['secrets'] ?? null;
        $this->dependencies = $values['dependencies'] ?? null;
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
}
