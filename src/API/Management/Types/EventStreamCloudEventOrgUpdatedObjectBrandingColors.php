<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Color scheme used to customize the login pages.
 */
class EventStreamCloudEventOrgUpdatedObjectBrandingColors extends JsonSerializableType
{
    /**
     * @var ?string $primary HEX Color for primary elements.
     */
    #[JsonProperty('primary')]
    private ?string $primary;

    /**
     * @var ?string $pageBackground HEX Color for background.
     */
    #[JsonProperty('page_background')]
    private ?string $pageBackground;

    /**
     * @param array{
     *   primary?: ?string,
     *   pageBackground?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->primary = $values['primary'] ?? null;
        $this->pageBackground = $values['pageBackground'] ?? null;
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
    public function getPageBackground(): ?string
    {
        return $this->pageBackground;
    }

    /**
     * @param ?string $value
     */
    public function setPageBackground(?string $value = null): self
    {
        $this->pageBackground = $value;
        $this->_setField('pageBackground');
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
