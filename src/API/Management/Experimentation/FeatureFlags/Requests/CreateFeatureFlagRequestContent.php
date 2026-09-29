<?php

namespace Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\FeatureFlagConfigParam;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateFeatureFlagRequestContent extends JsonSerializableType
{
    /**
     * @var string $name A human-readable name for the feature flag
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description A description of what this feature flag controls
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var array<string, FeatureFlagConfigParam> $parameters
     */
    #[JsonProperty('parameters'), ArrayType(['string' => FeatureFlagConfigParam::class])]
    private array $parameters;

    /**
     * @param array{
     *   name: string,
     *   parameters: array<string, FeatureFlagConfigParam>,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->parameters = $values['parameters'];
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
     * @return array<string, FeatureFlagConfigParam>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array<string, FeatureFlagConfigParam> $value
     */
    public function setParameters(array $value): self
    {
        $this->parameters = $value;
        $this->_setField('parameters');
        return $this;
    }
}
