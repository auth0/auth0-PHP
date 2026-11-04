<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class Sidebar extends JsonSerializableType
{
    /**
     * @var ?array<SidebarComponent> $components
     */
    #[JsonProperty('components'), ArrayType([SidebarComponent::class])]
    private ?array $components;

    /**
     * @param array{
     *   components?: ?array<SidebarComponent>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->components = $values['components'] ?? null;
    }

    /**
     * @return ?array<SidebarComponent>
     */
    public function getComponents(): ?array
    {
        return $this->components;
    }

    /**
     * @param ?array<SidebarComponent> $value
     */
    public function setComponents(?array $value = null): self
    {
        $this->components = $value;
        $this->_setField('components');
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
