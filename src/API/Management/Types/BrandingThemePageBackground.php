<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class BrandingThemePageBackground extends JsonSerializableType
{
    /**
     * @var string $backgroundColor Background color
     */
    #[JsonProperty('background_color')]
    private string $backgroundColor;

    /**
     * @var string $backgroundImageUrl Background image url
     */
    #[JsonProperty('background_image_url')]
    private string $backgroundImageUrl;

    /**
     * @var value-of<BrandingThemePageBackgroundPageLayoutEnum> $pageLayout
     */
    #[JsonProperty('page_layout')]
    private string $pageLayout;

    /**
     * @param array{
     *   backgroundColor: string,
     *   backgroundImageUrl: string,
     *   pageLayout: value-of<BrandingThemePageBackgroundPageLayoutEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->backgroundColor = $values['backgroundColor'];
        $this->backgroundImageUrl = $values['backgroundImageUrl'];
        $this->pageLayout = $values['pageLayout'];
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $value
     */
    public function setBackgroundColor(string $value): self
    {
        $this->backgroundColor = $value;
        $this->_setField('backgroundColor');
        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundImageUrl(): string
    {
        return $this->backgroundImageUrl;
    }

    /**
     * @param string $value
     */
    public function setBackgroundImageUrl(string $value): self
    {
        $this->backgroundImageUrl = $value;
        $this->_setField('backgroundImageUrl');
        return $this;
    }

    /**
     * @return value-of<BrandingThemePageBackgroundPageLayoutEnum>
     */
    public function getPageLayout(): string
    {
        return $this->pageLayout;
    }

    /**
     * @param value-of<BrandingThemePageBackgroundPageLayoutEnum> $value
     */
    public function setPageLayout(string $value): self
    {
        $this->pageLayout = $value;
        $this->_setField('pageLayout');
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
