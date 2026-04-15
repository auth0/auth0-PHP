<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SelfServiceProfileBrandingProperties extends JsonSerializableType
{
    /**
     * @var ?string $logoUrl
     */
    #[JsonProperty('logo_url')]
    private ?string $logoUrl;

    /**
     * @var ?SelfServiceProfileBrandingColors $colors
     */
    #[JsonProperty('colors')]
    private ?SelfServiceProfileBrandingColors $colors;

    /**
     * @param array{
     *   logoUrl?: ?string,
     *   colors?: ?SelfServiceProfileBrandingColors,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->logoUrl = $values['logoUrl'] ?? null;
        $this->colors = $values['colors'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * @param ?string $value
     */
    public function setLogoUrl(?string $value = null): self
    {
        $this->logoUrl = $value;
        $this->_setField('logoUrl');
        return $this;
    }

    /**
     * @return ?SelfServiceProfileBrandingColors
     */
    public function getColors(): ?SelfServiceProfileBrandingColors
    {
        return $this->colors;
    }

    /**
     * @param ?SelfServiceProfileBrandingColors $value
     */
    public function setColors(?SelfServiceProfileBrandingColors $value = null): self
    {
        $this->colors = $value;
        $this->_setField('colors');
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
