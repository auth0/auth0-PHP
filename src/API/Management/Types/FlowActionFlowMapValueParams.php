<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionFlowMapValueParams extends JsonSerializableType
{
    /**
     * @var (
     *    string
     *   |float
     * ) $input
     */
    #[JsonProperty('input'), Union('string', 'float')]
    private string|float $input;

    /**
     * @var ?array<string, mixed> $cases
     */
    #[JsonProperty('cases'), ArrayType(['string' => 'mixed'])]
    private ?array $cases;

    /**
     * @var (
     *    string
     *   |float
     *   |array<string, mixed>
     *   |array<mixed>
     * )|null $fallback
     */
    #[JsonProperty('fallback'), Union('string', 'float', ['string' => 'mixed'], ['mixed'], 'null')]
    private string|float|array|null $fallback;

    /**
     * @param array{
     *   input: (
     *    string
     *   |float
     * ),
     *   cases?: ?array<string, mixed>,
     *   fallback?: (
     *    string
     *   |float
     *   |array<string, mixed>
     *   |array<mixed>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->input = $values['input'];
        $this->cases = $values['cases'] ?? null;
        $this->fallback = $values['fallback'] ?? null;
    }

    /**
     * @return (
     *    string
     *   |float
     * )
     */
    public function getInput(): string|float
    {
        return $this->input;
    }

    /**
     * @param (
     *    string
     *   |float
     * ) $value
     */
    public function setInput(string|float $value): self
    {
        $this->input = $value;
        $this->_setField('input');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getCases(): ?array
    {
        return $this->cases;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setCases(?array $value = null): self
    {
        $this->cases = $value;
        $this->_setField('cases');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |float
     *   |array<string, mixed>
     *   |array<mixed>
     * )|null
     */
    public function getFallback(): string|float|array|null
    {
        return $this->fallback;
    }

    /**
     * @param (
     *    string
     *   |float
     *   |array<string, mixed>
     *   |array<mixed>
     * )|null $value
     */
    public function setFallback(string|float|array|null $value = null): self
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
