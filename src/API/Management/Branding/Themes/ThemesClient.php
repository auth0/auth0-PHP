<?php

namespace Auth0\SDK\API\Management\Branding\Themes;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Branding\Themes\Requests\CreateBrandingThemeRequestContent;
use Auth0\SDK\API\Management\Types\CreateBrandingThemeResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\GetBrandingDefaultThemeResponseContent;
use Auth0\SDK\API\Management\Types\GetBrandingThemeResponseContent;
use Auth0\SDK\API\Management\Branding\Themes\Requests\UpdateBrandingThemeRequestContent;
use Auth0\SDK\API\Management\Types\UpdateBrandingThemeResponseContent;

class ThemesClient implements ThemesClientInterface
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateBrandingThemeRequestContent $request, ?array $options = null): ?CreateBrandingThemeResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "branding/themes",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return CreateBrandingThemeResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function getDefault(?array $options = null): ?GetBrandingDefaultThemeResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "branding/themes/default",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetBrandingDefaultThemeResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $themeId, ?array $options = null): ?GetBrandingThemeResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "branding/themes/" . RawClient::encodePathParam($themeId),
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetBrandingThemeResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function delete(string $themeId, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "branding/themes/" . RawClient::encodePathParam($themeId),
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $themeId, UpdateBrandingThemeRequestContent $request, ?array $options = null): ?UpdateBrandingThemeResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "branding/themes/" . RawClient::encodePathParam($themeId),
                    method: HttpMethod::PATCH,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return UpdateBrandingThemeResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
