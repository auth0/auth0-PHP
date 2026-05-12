<?php

namespace Auth0\SDK\API\Management\Branding\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\UpdateBrandingColors;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\UpdateBrandingIdentifiers;
use Auth0\SDK\API\Management\Types\UpdateBrandingFont;

class UpdateBrandingRequestContent extends JsonSerializableType
{
    /**
     * @var ?UpdateBrandingColors $colors
     */
    #[JsonProperty('colors')]
    private ?UpdateBrandingColors $colors;

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
     * @var ?UpdateBrandingIdentifiers $identifiers
     */
    #[JsonProperty('identifiers')]
    private ?UpdateBrandingIdentifiers $identifiers;

    /**
     * @var ?UpdateBrandingFont $font
     */
    #[JsonProperty('font')]
    private ?UpdateBrandingFont $font;

    /**
     * @param array{
     *   colors?: ?UpdateBrandingColors,
     *   faviconUrl?: ?string,
     *   logoUrl?: ?string,
     *   identifiers?: ?UpdateBrandingIdentifiers,
     *   font?: ?UpdateBrandingFont,
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
     * @return ?UpdateBrandingColors
     */
    public function getColors(): ?UpdateBrandingColors
    {
        return $this->colors;
    }

    /**
     * @param ?UpdateBrandingColors $value
     */
    public function setColors(?UpdateBrandingColors $value = null): self
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
     * @return ?UpdateBrandingIdentifiers
     */
    public function getIdentifiers(): ?UpdateBrandingIdentifiers
    {
        return $this->identifiers;
    }

    /**
     * @param ?UpdateBrandingIdentifiers $value
     */
    public function setIdentifiers(?UpdateBrandingIdentifiers $value = null): self
    {
        $this->identifiers = $value;
        $this->_setField('identifiers');
        return $this;
    }

    /**
     * @return ?UpdateBrandingFont
     */
    public function getFont(): ?UpdateBrandingFont
    {
        return $this->font;
    }

    /**
     * @param ?UpdateBrandingFont $value
     */
    public function setFont(?UpdateBrandingFont $value = null): self
    {
        $this->font = $value;
        $this->_setField('font');
        return $this;
    }
}
