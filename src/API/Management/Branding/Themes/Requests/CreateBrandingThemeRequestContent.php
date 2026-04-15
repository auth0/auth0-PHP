<?php

namespace Auth0\SDK\API\Management\Branding\Themes\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\BrandingThemeBorders;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\BrandingThemeColors;
use Auth0\SDK\API\Management\Types\BrandingThemeFonts;
use Auth0\SDK\API\Management\Types\BrandingThemePageBackground;
use Auth0\SDK\API\Management\Types\BrandingThemeWidget;

class CreateBrandingThemeRequestContent extends JsonSerializableType
{
    /**
     * @var BrandingThemeBorders $borders
     */
    #[JsonProperty('borders')]
    private BrandingThemeBorders $borders;

    /**
     * @var BrandingThemeColors $colors
     */
    #[JsonProperty('colors')]
    private BrandingThemeColors $colors;

    /**
     * @var ?string $displayName Display Name
     */
    #[JsonProperty('displayName')]
    private ?string $displayName;

    /**
     * @var BrandingThemeFonts $fonts
     */
    #[JsonProperty('fonts')]
    private BrandingThemeFonts $fonts;

    /**
     * @var BrandingThemePageBackground $pageBackground
     */
    #[JsonProperty('page_background')]
    private BrandingThemePageBackground $pageBackground;

    /**
     * @var BrandingThemeWidget $widget
     */
    #[JsonProperty('widget')]
    private BrandingThemeWidget $widget;

    /**
     * @param array{
     *   borders: BrandingThemeBorders,
     *   colors: BrandingThemeColors,
     *   fonts: BrandingThemeFonts,
     *   pageBackground: BrandingThemePageBackground,
     *   widget: BrandingThemeWidget,
     *   displayName?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->borders = $values['borders'];
        $this->colors = $values['colors'];
        $this->displayName = $values['displayName'] ?? null;
        $this->fonts = $values['fonts'];
        $this->pageBackground = $values['pageBackground'];
        $this->widget = $values['widget'];
    }

    /**
     * @return BrandingThemeBorders
     */
    public function getBorders(): BrandingThemeBorders
    {
        return $this->borders;
    }

    /**
     * @param BrandingThemeBorders $value
     */
    public function setBorders(BrandingThemeBorders $value): self
    {
        $this->borders = $value;
        $this->_setField('borders');
        return $this;
    }

    /**
     * @return BrandingThemeColors
     */
    public function getColors(): BrandingThemeColors
    {
        return $this->colors;
    }

    /**
     * @param BrandingThemeColors $value
     */
    public function setColors(BrandingThemeColors $value): self
    {
        $this->colors = $value;
        $this->_setField('colors');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param ?string $value
     */
    public function setDisplayName(?string $value = null): self
    {
        $this->displayName = $value;
        $this->_setField('displayName');
        return $this;
    }

    /**
     * @return BrandingThemeFonts
     */
    public function getFonts(): BrandingThemeFonts
    {
        return $this->fonts;
    }

    /**
     * @param BrandingThemeFonts $value
     */
    public function setFonts(BrandingThemeFonts $value): self
    {
        $this->fonts = $value;
        $this->_setField('fonts');
        return $this;
    }

    /**
     * @return BrandingThemePageBackground
     */
    public function getPageBackground(): BrandingThemePageBackground
    {
        return $this->pageBackground;
    }

    /**
     * @param BrandingThemePageBackground $value
     */
    public function setPageBackground(BrandingThemePageBackground $value): self
    {
        $this->pageBackground = $value;
        $this->_setField('pageBackground');
        return $this;
    }

    /**
     * @return BrandingThemeWidget
     */
    public function getWidget(): BrandingThemeWidget
    {
        return $this->widget;
    }

    /**
     * @param BrandingThemeWidget $value
     */
    public function setWidget(BrandingThemeWidget $value): self
    {
        $this->widget = $value;
        $this->_setField('widget');
        return $this;
    }
}
