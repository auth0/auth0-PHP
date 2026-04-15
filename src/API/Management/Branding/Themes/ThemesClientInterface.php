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
