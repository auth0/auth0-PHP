<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class BrandingThemeFonts extends JsonSerializableType
{
    /**
     * @var BrandingThemeFontBodyText $bodyText
     */
    #[JsonProperty('body_text')]
    private BrandingThemeFontBodyText $bodyText;

    /**
     * @var BrandingThemeFontButtonsText $buttonsText
     */
    #[JsonProperty('buttons_text')]
    private BrandingThemeFontButtonsText $buttonsText;

    /**
     * @var string $fontUrl Font URL
     */
    #[JsonProperty('font_url')]
    private string $fontUrl;

    /**
     * @var BrandingThemeFontInputLabels $inputLabels
     */
    #[JsonProperty('input_labels')]
    private BrandingThemeFontInputLabels $inputLabels;

    /**
     * @var BrandingThemeFontLinks $links
     */
    #[JsonProperty('links')]
    private BrandingThemeFontLinks $links;

    /**
     * @var value-of<BrandingThemeFontLinksStyleEnum> $linksStyle
     */
    #[JsonProperty('links_style')]
    private string $linksStyle;

    /**
     * @var float $referenceTextSize Reference text size
     */
    #[JsonProperty('reference_text_size')]
    private float $referenceTextSize;

    /**
     * @var BrandingThemeFontSubtitle $subtitle
     */
    #[JsonProperty('subtitle')]
    private BrandingThemeFontSubtitle $subtitle;

    /**
     * @var BrandingThemeFontTitle $title
     */
    #[JsonProperty('title')]
    private BrandingThemeFontTitle $title;

    /**
     * @param array{
     *   bodyText: BrandingThemeFontBodyText,
     *   buttonsText: BrandingThemeFontButtonsText,
     *   fontUrl: string,
     *   inputLabels: BrandingThemeFontInputLabels,
     *   links: BrandingThemeFontLinks,
     *   linksStyle: value-of<BrandingThemeFontLinksStyleEnum>,
     *   referenceTextSize: float,
     *   subtitle: BrandingThemeFontSubtitle,
     *   title: BrandingThemeFontTitle,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->bodyText = $values['bodyText'];
        $this->buttonsText = $values['buttonsText'];
        $this->fontUrl = $values['fontUrl'];
        $this->inputLabels = $values['inputLabels'];
        $this->links = $values['links'];
        $this->linksStyle = $values['linksStyle'];
        $this->referenceTextSize = $values['referenceTextSize'];
        $this->subtitle = $values['subtitle'];
        $this->title = $values['title'];
    }

    /**
     * @return BrandingThemeFontBodyText
     */
    public function getBodyText(): BrandingThemeFontBodyText
    {
        return $this->bodyText;
    }

    /**
     * @param BrandingThemeFontBodyText $value
     */
    public function setBodyText(BrandingThemeFontBodyText $value): self
    {
        $this->bodyText = $value;
        $this->_setField('bodyText');
        return $this;
    }

    /**
     * @return BrandingThemeFontButtonsText
     */
    public function getButtonsText(): BrandingThemeFontButtonsText
    {
        return $this->buttonsText;
    }

    /**
     * @param BrandingThemeFontButtonsText $value
     */
    public function setButtonsText(BrandingThemeFontButtonsText $value): self
    {
        $this->buttonsText = $value;
        $this->_setField('buttonsText');
        return $this;
    }

    /**
     * @return string
     */
    public function getFontUrl(): string
    {
        return $this->fontUrl;
    }

    /**
     * @param string $value
     */
    public function setFontUrl(string $value): self
    {
        $this->fontUrl = $value;
        $this->_setField('fontUrl');
        return $this;
    }

    /**
     * @return BrandingThemeFontInputLabels
     */
    public function getInputLabels(): BrandingThemeFontInputLabels
    {
        return $this->inputLabels;
    }

    /**
     * @param BrandingThemeFontInputLabels $value
     */
    public function setInputLabels(BrandingThemeFontInputLabels $value): self
    {
        $this->inputLabels = $value;
        $this->_setField('inputLabels');
        return $this;
    }

    /**
     * @return BrandingThemeFontLinks
     */
    public function getLinks(): BrandingThemeFontLinks
    {
        return $this->links;
    }

    /**
     * @param BrandingThemeFontLinks $value
     */
    public function setLinks(BrandingThemeFontLinks $value): self
    {
        $this->links = $value;
        $this->_setField('links');
        return $this;
    }

    /**
     * @return value-of<BrandingThemeFontLinksStyleEnum>
     */
    public function getLinksStyle(): string
    {
        return $this->linksStyle;
    }

    /**
     * @param value-of<BrandingThemeFontLinksStyleEnum> $value
     */
    public function setLinksStyle(string $value): self
    {
        $this->linksStyle = $value;
        $this->_setField('linksStyle');
        return $this;
    }

    /**
     * @return float
     */
    public function getReferenceTextSize(): float
    {
        return $this->referenceTextSize;
    }

    /**
     * @param float $value
     */
    public function setReferenceTextSize(float $value): self
    {
        $this->referenceTextSize = $value;
        $this->_setField('referenceTextSize');
        return $this;
    }

    /**
     * @return BrandingThemeFontSubtitle
     */
    public function getSubtitle(): BrandingThemeFontSubtitle
    {
        return $this->subtitle;
    }

    /**
     * @param BrandingThemeFontSubtitle $value
     */
    public function setSubtitle(BrandingThemeFontSubtitle $value): self
    {
        $this->subtitle = $value;
        $this->_setField('subtitle');
        return $this;
    }

    /**
     * @return BrandingThemeFontTitle
     */
    public function getTitle(): BrandingThemeFontTitle
    {
        return $this->title;
    }

    /**
     * @param BrandingThemeFontTitle $value
     */
    public function setTitle(BrandingThemeFontTitle $value): self
    {
        $this->title = $value;
        $this->_setField('title');
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
