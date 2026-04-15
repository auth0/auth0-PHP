<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionFlowStoreVarsParams extends JsonSerializableType
{
    /**
     * @var array<string, mixed> $vars
     */
    #[JsonProperty('vars'), ArrayType(['string' => 'mixed'])]
    private array $vars;

    /**
     * @param array{
     *   vars: array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->vars = $values['vars'];
    }

    /**
     * @return array<string, mixed>
     */
    public function getVars(): array
    {
        return $this->vars;
    }

    /**
     * @param array<string, mixed> $value
     */
    public function setVars(array $value): self
    {
        $this->vars = $value;
        $this->_setField('vars');
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
