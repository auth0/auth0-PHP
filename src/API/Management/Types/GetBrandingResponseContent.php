<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetBrandingResponseContent extends JsonSerializableType
{
    /**
     * @var ?BrandingColors $colors
     */
    #[JsonProperty('colors')]
    private ?BrandingColors $colors;

    /**
     * @var ?string $faviconUrl URL for the favicon. Must use HTTPS.
     */
    #[JsonProperty('favicon_url')]
    private ?string $faviconUrl;

    /**
     * @var ?string $logoUrl URL for the logo. Must use HTTPS.
     */
    #[JsonProperty('logo_url')]
    private ?string $logoUrl;

    /**
     * @var ?BrandingIdentifiers $identifiers
     */
    #[JsonProperty('identifiers')]
    private ?BrandingIdentifiers $identifiers;

    /**
     * @var ?BrandingFont $font
     */
    #[JsonProperty('font')]
    private ?BrandingFont $font;

    /**
     * @param array{
     *   colors?: ?BrandingColors,
     *   faviconUrl?: ?string,
     *   logoUrl?: ?string,
     *   identifiers?: ?BrandingIdentifiers,
     *   font?: ?BrandingFont,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->colors = $values['colors'] ?? null;
        $this->faviconUrl = $values['faviconUrl'] ?? null;
        $this->logoUrl = $values['logoUrl'] ?? null;
        $this->identifiers = $values['identifiers'] ?? null;
        $this->font = $values['font'] ?? null;
    }

    /**
     * @return ?BrandingColors
     */
    public function getColors(): ?BrandingColors
    {
        return $this->colors;
    }

    /**
     * @param ?BrandingColors $value
     */
    public function setColors(?BrandingColors $value = null): self
    {
        $this->colors = $value;
        $this->_setField('colors');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFaviconUrl(): ?string
    {
        return $this->faviconUrl;
    }

    /**
     * @param ?string $value
     */
    public function setFaviconUrl(?string $value = null): self
    {
        $this->faviconUrl = $value;
        $this->_setField('faviconUrl');
        return $this;
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
     * @return ?BrandingIdentifiers
     */
    public function getIdentifiers(): ?BrandingIdentifiers
    {
        return $this->identifiers;
    }

    /**
     * @param ?BrandingIdentifiers $value
     */
    public function setIdentifiers(?BrandingIdentifiers $value = null): self
    {
        $this->identifiers = $value;
        $this->_setField('identifiers');
        return $this;
    }

    /**
     * @return ?BrandingFont
     */
    public function getFont(): ?BrandingFont
    {
        return $this->font;
    }

    /**
     * @param ?BrandingFont $value
     */
    public function setFont(?BrandingFont $value = null): self
    {
        $this->font = $value;
        $this->_setField('font');
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
