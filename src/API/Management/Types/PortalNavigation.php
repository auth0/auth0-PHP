<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PortalNavigation extends JsonSerializableType
{
    /**
     * @var ?Sidebar $sidebar
     */
    #[JsonProperty('sidebar')]
    private ?Sidebar $sidebar;

    /**
     * @param array{
     *   sidebar?: ?Sidebar,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->sidebar = $values['sidebar'] ?? null;
    }

    /**
     * @return ?Sidebar
     */
    public function getSidebar(): ?Sidebar
    {
        return $this->sidebar;
    }

    /**
     * @param ?Sidebar $value
     */
    public function setSidebar(?Sidebar $value = null): self
    {
        $this->sidebar = $value;
        $this->_setField('sidebar');
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
