<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class BrandingThemeWidget extends JsonSerializableType
{
    /**
     * @var value-of<BrandingThemeWidgetHeaderTextAlignmentEnum> $headerTextAlignment
     */
    #[JsonProperty('header_text_alignment')]
    private string $headerTextAlignment;

    /**
     * @var float $logoHeight Logo height
     */
    #[JsonProperty('logo_height')]
    private float $logoHeight;

    /**
     * @var value-of<BrandingThemeWidgetLogoPositionEnum> $logoPosition
     */
    #[JsonProperty('logo_position')]
    private string $logoPosition;

    /**
     * @var string $logoUrl Logo url
     */
    #[JsonProperty('logo_url')]
    private string $logoUrl;

    /**
     * @var value-of<BrandingThemeWidgetSocialButtonsLayoutEnum> $socialButtonsLayout
     */
    #[JsonProperty('social_buttons_layout')]
    private string $socialButtonsLayout;

    /**
     * @param array{
     *   headerTextAlignment: value-of<BrandingThemeWidgetHeaderTextAlignmentEnum>,
     *   logoHeight: float,
     *   logoPosition: value-of<BrandingThemeWidgetLogoPositionEnum>,
     *   logoUrl: string,
     *   socialButtonsLayout: value-of<BrandingThemeWidgetSocialButtonsLayoutEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->headerTextAlignment = $values['headerTextAlignment'];
        $this->logoHeight = $values['logoHeight'];
        $this->logoPosition = $values['logoPosition'];
        $this->logoUrl = $values['logoUrl'];
        $this->socialButtonsLayout = $values['socialButtonsLayout'];
    }

    /**
     * @return value-of<BrandingThemeWidgetHeaderTextAlignmentEnum>
     */
    public function getHeaderTextAlignment(): string
    {
        return $this->headerTextAlignment;
    }

    /**
     * @param value-of<BrandingThemeWidgetHeaderTextAlignmentEnum> $value
     */
    public function setHeaderTextAlignment(string $value): self
    {
        $this->headerTextAlignment = $value;
        $this->_setField('headerTextAlignment');
        return $this;
    }

    /**
     * @return float
     */
    public function getLogoHeight(): float
    {
        return $this->logoHeight;
    }

    /**
     * @param float $value
     */
    public function setLogoHeight(float $value): self
    {
        $this->logoHeight = $value;
        $this->_setField('logoHeight');
        return $this;
    }

    /**
     * @return value-of<BrandingThemeWidgetLogoPositionEnum>
     */
    public function getLogoPosition(): string
    {
        return $this->logoPosition;
    }

    /**
     * @param value-of<BrandingThemeWidgetLogoPositionEnum> $value
     */
    public function setLogoPosition(string $value): self
    {
        $this->logoPosition = $value;
        $this->_setField('logoPosition');
        return $this;
    }

    /**
     * @return string
     */
    public function getLogoUrl(): string
    {
        return $this->logoUrl;
    }

    /**
     * @param string $value
     */
    public function setLogoUrl(string $value): self
    {
        $this->logoUrl = $value;
        $this->_setField('logoUrl');
        return $this;
    }

    /**
     * @return value-of<BrandingThemeWidgetSocialButtonsLayoutEnum>
     */
    public function getSocialButtonsLayout(): string
    {
        return $this->socialButtonsLayout;
    }

    /**
     * @param value-of<BrandingThemeWidgetSocialButtonsLayoutEnum> $value
     */
    public function setSocialButtonsLayout(string $value): self
    {
        $this->socialButtonsLayout = $value;
        $this->_setField('socialButtonsLayout');
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
