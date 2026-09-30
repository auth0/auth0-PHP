<?php

namespace Auth0\SDK\API\Management\Experimentation\FeatureFlags\Variations\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateVariationRequestContent extends JsonSerializableType
{
    /**
     * @var string $name A human-readable name for the variation
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description A description of what this variation controls
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var array<string, mixed> $overrides Configuration overrides for this variation; keys must exist in the parent flag parameters. Empty {} is the baseline (control) variation that overrides nothing.
     */
    #[JsonProperty('overrides'), ArrayType(['string' => 'mixed'])]
    private array $overrides;

    /**
     * @param array{
     *   name: string,
     *   overrides: array<string, mixed>,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->overrides = $values['overrides'];
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
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOverrides(): array
    {
        return $this->overrides;
    }

    /**
     * @param array<string, mixed> $value
     */
    public function setOverrides(array $value): self
    {
        $this->overrides = $value;
        $this->_setField('overrides');
        return $this;
    }
}
