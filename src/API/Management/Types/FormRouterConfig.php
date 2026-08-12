<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class FormRouterConfig extends JsonSerializableType
{
    /**
     * @var ?array<FormRouterRule> $rules
     */
    #[JsonProperty('rules'), ArrayType([FormRouterRule::class])]
    private ?array $rules;

    /**
     * @var (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null $fallback
     */
    #[JsonProperty('fallback'), Union('string', 'null')]
    private string|null $fallback;

    /**
     * @param array{
     *   rules?: ?array<FormRouterRule>,
     *   fallback?: (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->rules = $values['rules'] ?? null;
        $this->fallback = $values['fallback'] ?? null;
    }

    /**
     * @return ?array<FormRouterRule>
     */
    public function getRules(): ?array
    {
        return $this->rules;
    }

    /**
     * @param ?array<FormRouterRule> $value
     */
    public function setRules(?array $value = null): self
    {
        $this->rules = $value;
        $this->_setField('rules');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null
     */
    public function getFallback(): string|null
    {
        return $this->fallback;
    }

    /**
     * @param (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null $value
     */
    public function setFallback(string|null $value = null): self
    {
        $this->fallback = $value;
        $this->_setField('fallback');
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
