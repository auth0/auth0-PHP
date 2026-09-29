<?php

namespace Auth0\SDK\API\Management\Experimentation\Segments\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\SegmentRule;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateSegmentRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $name A human-readable name for the segment
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $description A description of the segment
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?array<SegmentRule> $rules Replaces the entire rules array. Each rule is limited to 4KB and the whole segment to 10KB (serialized).
     */
    #[JsonProperty('rules'), ArrayType([SegmentRule::class])]
    private ?array $rules;

    /**
     * @param array{
     *   name?: ?string,
     *   description?: ?string,
     *   rules?: ?array<SegmentRule>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->rules = $values['rules'] ?? null;
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
     * @return ?array<SegmentRule>
     */
    public function getRules(): ?array
    {
        return $this->rules;
    }

    /**
     * @param ?array<SegmentRule> $value
     */
    public function setRules(?array $value = null): self
    {
        $this->rules = $value;
        $this->_setField('rules');
        return $this;
    }
}
