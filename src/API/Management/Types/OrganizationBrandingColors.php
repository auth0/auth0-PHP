<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Color scheme used to customize the login pages.
 */
class OrganizationBrandingColors extends JsonSerializableType
{
    /**
     * @var string $primary HEX Color for primary elements.
     */
    #[JsonProperty('primary')]
    private string $primary;

    /**
     * @var string $pageBackground HEX Color for background.
     */
    #[JsonProperty('page_background')]
    private string $pageBackground;

    /**
     * @param array{
     *   primary: string,
     *   pageBackground: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->primary = $values['primary'];
        $this->pageBackground = $values['pageBackground'];
    }

    /**
     * @return string
     */
    public function getPrimary(): string
    {
        return $this->primary;
    }

    /**
     * @param string $value
     */
    public function setPrimary(string $value): self
    {
        $this->primary = $value;
        $this->_setField('primary');
        return $this;
    }

    /**
     * @return string
     */
    public function getPageBackground(): string
    {
        return $this->pageBackground;
    }

    /**
     * @param string $value
     */
    public function setPageBackground(string $value): self
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
