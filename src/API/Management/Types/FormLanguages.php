<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormLanguages extends JsonSerializableType
{
    /**
     * @var ?string $primary
     */
    #[JsonProperty('primary')]
    private ?string $primary;

    /**
     * @var ?string $default
     */
    #[JsonProperty('default')]
    private ?string $default;

    /**
     * @param array{
     *   primary?: ?string,
     *   default?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->primary = $values['primary'] ?? null;
        $this->default = $values['default'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getPrimary(): ?string
    {
        return $this->primary;
    }

    /**
     * @param ?string $value
     */
    public function setPrimary(?string $value = null): self
    {
        $this->primary = $value;
        $this->_setField('primary');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDefault(): ?string
    {
        return $this->default;
    }

    /**
     * @param ?string $value
     */
    public function setDefault(?string $value = null): self
    {
        $this->default = $value;
        $this->_setField('default');
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
