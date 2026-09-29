<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FeatureFlagConfigParam extends JsonSerializableType
{
    /**
     * @var value-of<FeatureFlagConfigParamTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var mixed $value
     */
    #[JsonProperty('value')]
    private mixed $value;

    /**
     * @var ?string $description A human-readable description of the parameter
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @param array{
     *   type: value-of<FeatureFlagConfigParamTypeEnum>,
     *   value: mixed,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->value = $values['value'];
        $this->description = $values['description'] ?? null;
    }

    /**
     * @return value-of<FeatureFlagConfigParamTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FeatureFlagConfigParamTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue(mixed $value): self
    {
        $this->value = $value;
        $this->_setField('value');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
