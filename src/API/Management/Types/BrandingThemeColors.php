<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class BrandingThemeColors extends JsonSerializableType
{
    /**
     * @var ?string $baseFocusColor Base Focus Color
     */
    #[JsonProperty('base_focus_color')]
    private ?string $baseFocusColor;

    /**
     * @var ?string $baseHoverColor Base Hover Color
     */
    #[JsonProperty('base_hover_color')]
    private ?string $baseHoverColor;

    /**
     * @var string $bodyText Body text
     */
    #[JsonProperty('body_text')]
    private string $bodyText;

    /**
     * @var ?value-of<BrandingThemeColorsCaptchaWidgetThemeEnum> $captchaWidgetTheme
     */
    #[JsonProperty('captcha_widget_theme')]
    private ?string $captchaWidgetTheme;

    /**
     * @var string $error Error
     */
    #[JsonProperty('error')]
    private string $error;

    /**
     * @var string $header Header
     */
    #[JsonProperty('header')]
    private string $header;

    /**
     * @var string $icons Icons
     */
    #[JsonProperty('icons')]
    private string $icons;

    /**
     * @var string $inputBackground Input background
     */
    #[JsonProperty('input_background')]
    private string $inputBackground;

    /**
     * @var string $inputBorder Input border
     */
    #[JsonProperty('input_border')]
    private string $inputBorder;

    /**
     * @var string $inputFilledText Input filled text
     */
    #[JsonProperty('input_filled_text')]
    private string $inputFilledText;

    /**
     * @var string $inputLabelsPlaceholders Input labels & placeholders
     */
    #[JsonProperty('input_labels_placeholders')]
    private string $inputLabelsPlaceholders;

    /**
     * @var string $linksFocusedComponents Links & focused components
     */
    #[JsonProperty('links_focused_components')]
    private string $linksFocusedComponents;

    /**
     * @var string $primaryButton Primary button
     */
    #[JsonProperty('primary_button')]
    private string $primaryButton;

    /**
     * @var string $primaryButtonLabel Primary button label
     */
    #[JsonProperty('primary_button_label')]
    private string $primaryButtonLabel;

    /**
     * @var ?string $readOnlyBackground Read only background
     */
    #[JsonProperty('read_only_background')]
    private ?string $readOnlyBackground;

    /**
     * @var string $secondaryButtonBorder Secondary button border
     */
    #[JsonProperty('secondary_button_border')]
    private string $secondaryButtonBorder;

    /**
     * @var string $secondaryButtonLabel Secondary button label
     */
    #[JsonProperty('secondary_button_label')]
    private string $secondaryButtonLabel;

    /**
     * @var string $success Success
     */
    #[JsonProperty('success')]
    private string $success;

    /**
     * @var string $widgetBackground Widget background
     */
    #[JsonProperty('widget_background')]
    private string $widgetBackground;

    /**
     * @var string $widgetBorder Widget border
     */
    #[JsonProperty('widget_border')]
    private string $widgetBorder;

    /**
     * @param array{
     *   bodyText: string,
     *   error: string,
     *   header: string,
     *   icons: string,
     *   inputBackground: string,
     *   inputBorder: string,
     *   inputFilledText: string,
     *   inputLabelsPlaceholders: string,
     *   linksFocusedComponents: string,
     *   primaryButton: string,
     *   primaryButtonLabel: string,
     *   secondaryButtonBorder: string,
     *   secondaryButtonLabel: string,
     *   success: string,
     *   widgetBackground: string,
     *   widgetBorder: string,
     *   baseFocusColor?: ?string,
     *   baseHoverColor?: ?string,
     *   captchaWidgetTheme?: ?value-of<BrandingThemeColorsCaptchaWidgetThemeEnum>,
     *   readOnlyBackground?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->baseFocusColor = $values['baseFocusColor'] ?? null;
        $this->baseHoverColor = $values['baseHoverColor'] ?? null;
        $this->bodyText = $values['bodyText'];
        $this->captchaWidgetTheme = $values['captchaWidgetTheme'] ?? null;
        $this->error = $values['error'];
        $this->header = $values['header'];
        $this->icons = $values['icons'];
        $this->inputBackground = $values['inputBackground'];
        $this->inputBorder = $values['inputBorder'];
        $this->inputFilledText = $values['inputFilledText'];
        $this->inputLabelsPlaceholders = $values['inputLabelsPlaceholders'];
        $this->linksFocusedComponents = $values['linksFocusedComponents'];
        $this->primaryButton = $values['primaryButton'];
        $this->primaryButtonLabel = $values['primaryButtonLabel'];
        $this->readOnlyBackground = $values['readOnlyBackground'] ?? null;
        $this->secondaryButtonBorder = $values['secondaryButtonBorder'];
        $this->secondaryButtonLabel = $values['secondaryButtonLabel'];
        $this->success = $values['success'];
        $this->widgetBackground = $values['widgetBackground'];
        $this->widgetBorder = $values['widgetBorder'];
    }

    /**
     * @return ?string
     */
    public function getBaseFocusColor(): ?string
    {
        return $this->baseFocusColor;
    }

    /**
     * @param ?string $value
     */
    public function setBaseFocusColor(?string $value = null): self
    {
        $this->baseFocusColor = $value;
        $this->_setField('baseFocusColor');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getBaseHoverColor(): ?string
    {
        return $this->baseHoverColor;
    }

    /**
     * @param ?string $value
     */
    public function setBaseHoverColor(?string $value = null): self
    {
        $this->baseHoverColor = $value;
        $this->_setField('baseHoverColor');
        return $this;
    }

    /**
     * @return string
     */
    public function getBodyText(): string
    {
        return $this->bodyText;
    }

    /**
     * @param string $value
     */
    public function setBodyText(string $value): self
    {
        $this->bodyText = $value;
        $this->_setField('bodyText');
        return $this;
    }

    /**
     * @return ?value-of<BrandingThemeColorsCaptchaWidgetThemeEnum>
     */
    public function getCaptchaWidgetTheme(): ?string
    {
        return $this->captchaWidgetTheme;
    }

    /**
     * @param ?value-of<BrandingThemeColorsCaptchaWidgetThemeEnum> $value
     */
    public function setCaptchaWidgetTheme(?string $value = null): self
    {
        $this->captchaWidgetTheme = $value;
        $this->_setField('captchaWidgetTheme');
        return $this;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $value
     */
    public function setError(string $value): self
    {
        $this->error = $value;
        $this->_setField('error');
        return $this;
    }

    /**
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * @param string $value
     */
    public function setHeader(string $value): self
    {
        $this->header = $value;
        $this->_setField('header');
        return $this;
    }

    /**
     * @return string
     */
    public function getIcons(): string
    {
        return $this->icons;
    }

    /**
     * @param string $value
     */
    public function setIcons(string $value): self
    {
        $this->icons = $value;
        $this->_setField('icons');
        return $this;
    }

    /**
     * @return string
     */
    public function getInputBackground(): string
    {
        return $this->inputBackground;
    }

    /**
     * @param string $value
     */
    public function setInputBackground(string $value): self
    {
        $this->inputBackground = $value;
        $this->_setField('inputBackground');
        return $this;
    }

    /**
     * @return string
     */
    public function getInputBorder(): string
    {
        return $this->inputBorder;
    }

    /**
     * @param string $value
     */
    public function setInputBorder(string $value): self
    {
        $this->inputBorder = $value;
        $this->_setField('inputBorder');
        return $this;
    }

    /**
     * @return string
     */
    public function getInputFilledText(): string
    {
        return $this->inputFilledText;
    }

    /**
     * @param string $value
     */
    public function setInputFilledText(string $value): self
    {
        $this->inputFilledText = $value;
        $this->_setField('inputFilledText');
        return $this;
    }

    /**
     * @return string
     */
    public function getInputLabelsPlaceholders(): string
    {
        return $this->inputLabelsPlaceholders;
    }

    /**
     * @param string $value
     */
    public function setInputLabelsPlaceholders(string $value): self
    {
        $this->inputLabelsPlaceholders = $value;
        $this->_setField('inputLabelsPlaceholders');
        return $this;
    }

    /**
     * @return string
     */
    public function getLinksFocusedComponents(): string
    {
        return $this->linksFocusedComponents;
    }

    /**
     * @param string $value
     */
    public function setLinksFocusedComponents(string $value): self
    {
        $this->linksFocusedComponents = $value;
        $this->_setField('linksFocusedComponents');
        return $this;
    }

    /**
     * @return string
     */
    public function getPrimaryButton(): string
    {
        return $this->primaryButton;
    }

    /**
     * @param string $value
     */
    public function setPrimaryButton(string $value): self
    {
        $this->primaryButton = $value;
        $this->_setField('primaryButton');
        return $this;
    }

    /**
     * @return string
     */
    public function getPrimaryButtonLabel(): string
    {
        return $this->primaryButtonLabel;
    }

    /**
     * @param string $value
     */
    public function setPrimaryButtonLabel(string $value): self
    {
        $this->primaryButtonLabel = $value;
        $this->_setField('primaryButtonLabel');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getReadOnlyBackground(): ?string
    {
        return $this->readOnlyBackground;
    }

    /**
     * @param ?string $value
     */
    public function setReadOnlyBackground(?string $value = null): self
    {
        $this->readOnlyBackground = $value;
        $this->_setField('readOnlyBackground');
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondaryButtonBorder(): string
    {
        return $this->secondaryButtonBorder;
    }

    /**
     * @param string $value
     */
    public function setSecondaryButtonBorder(string $value): self
    {
        $this->secondaryButtonBorder = $value;
        $this->_setField('secondaryButtonBorder');
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondaryButtonLabel(): string
    {
        return $this->secondaryButtonLabel;
    }

    /**
     * @param string $value
     */
    public function setSecondaryButtonLabel(string $value): self
    {
        $this->secondaryButtonLabel = $value;
        $this->_setField('secondaryButtonLabel');
        return $this;
    }

    /**
     * @return string
     */
    public function getSuccess(): string
    {
        return $this->success;
    }

    /**
     * @param string $value
     */
    public function setSuccess(string $value): self
    {
        $this->success = $value;
        $this->_setField('success');
        return $this;
    }

    /**
     * @return string
     */
    public function getWidgetBackground(): string
    {
        return $this->widgetBackground;
    }

    /**
     * @param string $value
     */
    public function setWidgetBackground(string $value): self
    {
        $this->widgetBackground = $value;
        $this->_setField('widgetBackground');
        return $this;
    }

    /**
     * @return string
     */
    public function getWidgetBorder(): string
    {
        return $this->widgetBorder;
    }

    /**
     * @param string $value
     */
    public function setWidgetBorder(string $value): self
    {
        $this->widgetBorder = $value;
        $this->_setField('widgetBorder');
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
