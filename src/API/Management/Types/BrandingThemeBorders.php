<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class BrandingThemeBorders extends JsonSerializableType
{
    /**
     * @var float $buttonBorderRadius Button border radius
     */
    #[JsonProperty('button_border_radius')]
    private float $buttonBorderRadius;

    /**
     * @var float $buttonBorderWeight Button border weight
     */
    #[JsonProperty('button_border_weight')]
    private float $buttonBorderWeight;

    /**
     * @var value-of<BrandingThemeBordersButtonsStyleEnum> $buttonsStyle
     */
    #[JsonProperty('buttons_style')]
    private string $buttonsStyle;

    /**
     * @var float $inputBorderRadius Input border radius
     */
    #[JsonProperty('input_border_radius')]
    private float $inputBorderRadius;

    /**
     * @var float $inputBorderWeight Input border weight
     */
    #[JsonProperty('input_border_weight')]
    private float $inputBorderWeight;

    /**
     * @var value-of<BrandingThemeBordersInputsStyleEnum> $inputsStyle
     */
    #[JsonProperty('inputs_style')]
    private string $inputsStyle;

    /**
     * @var bool $showWidgetShadow Show widget shadow
     */
    #[JsonProperty('show_widget_shadow')]
    private bool $showWidgetShadow;

    /**
     * @var float $widgetBorderWeight Widget border weight
     */
    #[JsonProperty('widget_border_weight')]
    private float $widgetBorderWeight;

    /**
     * @var float $widgetCornerRadius Widget corner radius
     */
    #[JsonProperty('widget_corner_radius')]
    private float $widgetCornerRadius;

    /**
     * @param array{
     *   buttonBorderRadius: float,
     *   buttonBorderWeight: float,
     *   buttonsStyle: value-of<BrandingThemeBordersButtonsStyleEnum>,
     *   inputBorderRadius: float,
     *   inputBorderWeight: float,
     *   inputsStyle: value-of<BrandingThemeBordersInputsStyleEnum>,
     *   showWidgetShadow: bool,
     *   widgetBorderWeight: float,
     *   widgetCornerRadius: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->buttonBorderRadius = $values['buttonBorderRadius'];
        $this->buttonBorderWeight = $values['buttonBorderWeight'];
        $this->buttonsStyle = $values['buttonsStyle'];
        $this->inputBorderRadius = $values['inputBorderRadius'];
        $this->inputBorderWeight = $values['inputBorderWeight'];
        $this->inputsStyle = $values['inputsStyle'];
        $this->showWidgetShadow = $values['showWidgetShadow'];
        $this->widgetBorderWeight = $values['widgetBorderWeight'];
        $this->widgetCornerRadius = $values['widgetCornerRadius'];
    }

    /**
     * @return float
     */
    public function getButtonBorderRadius(): float
    {
        return $this->buttonBorderRadius;
    }

    /**
     * @param float $value
     */
    public function setButtonBorderRadius(float $value): self
    {
        $this->buttonBorderRadius = $value;
        $this->_setField('buttonBorderRadius');
        return $this;
    }

    /**
     * @return float
     */
    public function getButtonBorderWeight(): float
    {
        return $this->buttonBorderWeight;
    }

    /**
     * @param float $value
     */
    public function setButtonBorderWeight(float $value): self
    {
        $this->buttonBorderWeight = $value;
        $this->_setField('buttonBorderWeight');
        return $this;
    }

    /**
     * @return value-of<BrandingThemeBordersButtonsStyleEnum>
     */
    public function getButtonsStyle(): string
    {
        return $this->buttonsStyle;
    }

    /**
     * @param value-of<BrandingThemeBordersButtonsStyleEnum> $value
     */
    public function setButtonsStyle(string $value): self
    {
        $this->buttonsStyle = $value;
        $this->_setField('buttonsStyle');
        return $this;
    }

    /**
     * @return float
     */
    public function getInputBorderRadius(): float
    {
        return $this->inputBorderRadius;
    }

    /**
     * @param float $value
     */
    public function setInputBorderRadius(float $value): self
    {
        $this->inputBorderRadius = $value;
        $this->_setField('inputBorderRadius');
        return $this;
    }

    /**
     * @return float
     */
    public function getInputBorderWeight(): float
    {
        return $this->inputBorderWeight;
    }

    /**
     * @param float $value
     */
    public function setInputBorderWeight(float $value): self
    {
        $this->inputBorderWeight = $value;
        $this->_setField('inputBorderWeight');
        return $this;
    }

    /**
     * @return value-of<BrandingThemeBordersInputsStyleEnum>
     */
    public function getInputsStyle(): string
    {
        return $this->inputsStyle;
    }

    /**
     * @param value-of<BrandingThemeBordersInputsStyleEnum> $value
     */
    public function setInputsStyle(string $value): self
    {
        $this->inputsStyle = $value;
        $this->_setField('inputsStyle');
        return $this;
    }

    /**
     * @return bool
     */
    public function getShowWidgetShadow(): bool
    {
        return $this->showWidgetShadow;
    }

    /**
     * @param bool $value
     */
    public function setShowWidgetShadow(bool $value): self
    {
        $this->showWidgetShadow = $value;
        $this->_setField('showWidgetShadow');
        return $this;
    }

    /**
     * @return float
     */
    public function getWidgetBorderWeight(): float
    {
        return $this->widgetBorderWeight;
    }

    /**
     * @param float $value
     */
    public function setWidgetBorderWeight(float $value): self
    {
        $this->widgetBorderWeight = $value;
        $this->_setField('widgetBorderWeight');
        return $this;
    }

    /**
     * @return float
     */
    public function getWidgetCornerRadius(): float
    {
        return $this->widgetCornerRadius;
    }

    /**
     * @param float $value
     */
    public function setWidgetCornerRadius(float $value): self
    {
        $this->widgetCornerRadius = $value;
        $this->_setField('widgetCornerRadius');
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
