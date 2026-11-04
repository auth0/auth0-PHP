<?php

namespace Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\FeatureFlagConfigParam;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\FeatureFlagStatusEnum;

class UpdateFeatureFlagRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $name A human-readable name for the feature flag
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $description A description of what this feature flag controls
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?array<string, FeatureFlagConfigParam> $parameters
     */
    #[JsonProperty('parameters'), ArrayType(['string' => FeatureFlagConfigParam::class])]
    private ?array $parameters;

    /**
     * @var ?value-of<FeatureFlagStatusEnum> $status Target lifecycle status (draft → active, draft → archived, active → archived). Activating a flag requires at least 2 variations. When combined with field edits, the edits and the transition are applied together; if the transition is rejected, no edits are applied.
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @param array{
     *   name?: ?string,
     *   description?: ?string,
     *   parameters?: ?array<string, FeatureFlagConfigParam>,
     *   status?: ?value-of<FeatureFlagStatusEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->parameters = $values['parameters'] ?? null;
        $this->status = $values['status'] ?? null;
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
     * @return ?array<string, FeatureFlagConfigParam>
     */
    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    /**
     * @param ?array<string, FeatureFlagConfigParam> $value
     */
    public function setParameters(?array $value = null): self
    {
        $this->parameters = $value;
        $this->_setField('parameters');
        return $this;
    }

    /**
     * @return ?value-of<FeatureFlagStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<FeatureFlagStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }
}
