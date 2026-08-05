<?php

namespace Auth0\SDK\API\Management\Branding\Themes;

use Auth0\SDK\API\Management\Branding\Themes\Requests\CreateBrandingThemeRequestContent;
use Auth0\SDK\API\Management\Types\CreateBrandingThemeResponseContent;
use Auth0\SDK\API\Management\Types\GetBrandingDefaultThemeResponseContent;
use Auth0\SDK\API\Management\Types\GetBrandingThemeResponseContent;
use Auth0\SDK\API\Management\Branding\Themes\Requests\UpdateBrandingThemeRequestContent;
use Auth0\SDK\API\Management\Types\UpdateBrandingThemeResponseContent;

interface ThemesClientInterface
{
    /**
     * Create branding theme.
     *
     * Example:
     * ```php
     * $client->branding->themes->create(
     *     new CreateBrandingThemeRequestContent([
     *         'borders' => new BrandingThemeBorders([
     *             'buttonBorderRadius' => 1.1,
     *             'buttonBorderWeight' => 1.1,
     *             'buttonsStyle' => BrandingThemeBordersButtonsStyleEnum::Pill->value,
     *             'inputBorderRadius' => 1.1,
     *             'inputBorderWeight' => 1.1,
     *             'inputsStyle' => BrandingThemeBordersInputsStyleEnum::Pill->value,
     *             'showWidgetShadow' => true,
     *             'widgetBorderWeight' => 1.1,
     *             'widgetCornerRadius' => 1.1,
     *         ]),
     *         'colors' => new BrandingThemeColors([
     *             'bodyText' => 'body_text',
     *             'error' => 'error',
     *             'header' => 'header',
     *             'icons' => 'icons',
     *             'inputBackground' => 'input_background',
     *             'inputBorder' => 'input_border',
     *             'inputFilledText' => 'input_filled_text',
     *             'inputLabelsPlaceholders' => 'input_labels_placeholders',
     *             'linksFocusedComponents' => 'links_focused_components',
     *             'primaryButton' => 'primary_button',
     *             'primaryButtonLabel' => 'primary_button_label',
     *             'secondaryButtonBorder' => 'secondary_button_border',
     *             'secondaryButtonLabel' => 'secondary_button_label',
     *             'success' => 'success',
     *             'widgetBackground' => 'widget_background',
     *             'widgetBorder' => 'widget_border',
     *         ]),
     *         'fonts' => new BrandingThemeFonts([
     *             'bodyText' => new BrandingThemeFontBodyText([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'buttonsText' => new BrandingThemeFontButtonsText([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'fontUrl' => 'font_url',
     *             'inputLabels' => new BrandingThemeFontInputLabels([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'links' => new BrandingThemeFontLinks([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'linksStyle' => BrandingThemeFontLinksStyleEnum::Normal->value,
     *             'referenceTextSize' => 1.1,
     *             'subtitle' => new BrandingThemeFontSubtitle([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'title' => new BrandingThemeFontTitle([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *         ]),
     *         'pageBackground' => new BrandingThemePageBackground([
     *             'backgroundColor' => 'background_color',
     *             'backgroundImageUrl' => 'background_image_url',
     *             'pageLayout' => BrandingThemePageBackgroundPageLayoutEnum::Center->value,
     *         ]),
     *         'widget' => new BrandingThemeWidget([
     *             'headerTextAlignment' => BrandingThemeWidgetHeaderTextAlignmentEnum::Center->value,
     *             'logoHeight' => 1.1,
     *             'logoPosition' => BrandingThemeWidgetLogoPositionEnum::Center->value,
     *             'logoUrl' => 'logo_url',
     *             'socialButtonsLayout' => BrandingThemeWidgetSocialButtonsLayoutEnum::Bottom->value,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param CreateBrandingThemeRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateBrandingThemeResponseContent
     */
    public function create(CreateBrandingThemeRequestContent $request, ?array $options = null): ?CreateBrandingThemeResponseContent;

    /**
     * Retrieve default branding theme.
     *
     * Example:
     * ```php
     * $client->branding->themes->getDefault();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetBrandingDefaultThemeResponseContent
     */
    public function getDefault(?array $options = null): ?GetBrandingDefaultThemeResponseContent;

    /**
     * Retrieve branding theme.
     *
     * Example:
     * ```php
     * $client->branding->themes->get(
     *     'themeId',
     * );
     * ```
     *
     * @param string $themeId The ID of the theme
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetBrandingThemeResponseContent
     */
    public function get(string $themeId, ?array $options = null): ?GetBrandingThemeResponseContent;

    /**
     * Delete branding theme.
     *
     * Example:
     * ```php
     * $client->branding->themes->delete(
     *     'themeId',
     * );
     * ```
     *
     * @param string $themeId The ID of the theme
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $themeId, ?array $options = null): void;

    /**
     * Update branding theme.
     *
     * Example:
     * ```php
     * $client->branding->themes->update(
     *     'themeId',
     *     new UpdateBrandingThemeRequestContent([
     *         'borders' => new BrandingThemeBorders([
     *             'buttonBorderRadius' => 1.1,
     *             'buttonBorderWeight' => 1.1,
     *             'buttonsStyle' => BrandingThemeBordersButtonsStyleEnum::Pill->value,
     *             'inputBorderRadius' => 1.1,
     *             'inputBorderWeight' => 1.1,
     *             'inputsStyle' => BrandingThemeBordersInputsStyleEnum::Pill->value,
     *             'showWidgetShadow' => true,
     *             'widgetBorderWeight' => 1.1,
     *             'widgetCornerRadius' => 1.1,
     *         ]),
     *         'colors' => new BrandingThemeColors([
     *             'bodyText' => 'body_text',
     *             'error' => 'error',
     *             'header' => 'header',
     *             'icons' => 'icons',
     *             'inputBackground' => 'input_background',
     *             'inputBorder' => 'input_border',
     *             'inputFilledText' => 'input_filled_text',
     *             'inputLabelsPlaceholders' => 'input_labels_placeholders',
     *             'linksFocusedComponents' => 'links_focused_components',
     *             'primaryButton' => 'primary_button',
     *             'primaryButtonLabel' => 'primary_button_label',
     *             'secondaryButtonBorder' => 'secondary_button_border',
     *             'secondaryButtonLabel' => 'secondary_button_label',
     *             'success' => 'success',
     *             'widgetBackground' => 'widget_background',
     *             'widgetBorder' => 'widget_border',
     *         ]),
     *         'fonts' => new BrandingThemeFonts([
     *             'bodyText' => new BrandingThemeFontBodyText([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'buttonsText' => new BrandingThemeFontButtonsText([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'fontUrl' => 'font_url',
     *             'inputLabels' => new BrandingThemeFontInputLabels([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'links' => new BrandingThemeFontLinks([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'linksStyle' => BrandingThemeFontLinksStyleEnum::Normal->value,
     *             'referenceTextSize' => 1.1,
     *             'subtitle' => new BrandingThemeFontSubtitle([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *             'title' => new BrandingThemeFontTitle([
     *                 'bold' => true,
     *                 'size' => 1.1,
     *             ]),
     *         ]),
     *         'pageBackground' => new BrandingThemePageBackground([
     *             'backgroundColor' => 'background_color',
     *             'backgroundImageUrl' => 'background_image_url',
     *             'pageLayout' => BrandingThemePageBackgroundPageLayoutEnum::Center->value,
     *         ]),
     *         'widget' => new BrandingThemeWidget([
     *             'headerTextAlignment' => BrandingThemeWidgetHeaderTextAlignmentEnum::Center->value,
     *             'logoHeight' => 1.1,
     *             'logoPosition' => BrandingThemeWidgetLogoPositionEnum::Center->value,
     *             'logoUrl' => 'logo_url',
     *             'socialButtonsLayout' => BrandingThemeWidgetSocialButtonsLayoutEnum::Bottom->value,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param string $themeId The ID of the theme
     * @param UpdateBrandingThemeRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateBrandingThemeResponseContent
     */
    public function update(string $themeId, UpdateBrandingThemeRequestContent $request, ?array $options = null): ?UpdateBrandingThemeResponseContent;
}
