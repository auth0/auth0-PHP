<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ResourceServerScope extends JsonSerializableType
{
    /**
     * @var string $value Value of this scope.
     */
    #[JsonProperty('value')]
    private string $value;

    /**
     * @var ?string $description User-friendly description of this scope.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @param array{
     *   value: string,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->value = $values['value'];
        $this->description = $values['description'] ?? null;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): self
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
