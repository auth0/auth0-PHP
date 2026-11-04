<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListPortalsResponseContent extends JsonSerializableType
{
    /**
     * @var array<PortalSummary> $portals
     */
    #[JsonProperty('portals'), ArrayType([PortalSummary::class])]
    private array $portals;

    /**
     * @param array{
     *   portals: array<PortalSummary>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->portals = $values['portals'];
    }

    /**
     * @return array<PortalSummary>
     */
    public function getPortals(): array
    {
        return $this->portals;
    }

    /**
     * @param array<PortalSummary> $value
     */
    public function setPortals(array $value): self
    {
        $this->portals = $value;
        $this->_setField('portals');
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
