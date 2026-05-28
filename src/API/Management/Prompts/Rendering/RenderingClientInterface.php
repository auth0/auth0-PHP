<?php

namespace Auth0\SDK\API\Management\Prompts\Rendering;

use Auth0\SDK\API\Management\Prompts\Rendering\Requests\ListAculsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ListAculsResponseContentItem;
use Auth0\SDK\API\Management\Prompts\Rendering\Requests\BulkUpdateAculRequestContent;
use Auth0\SDK\API\Management\Types\BulkUpdateAculResponseContent;
use Auth0\SDK\API\Management\Types\PromptGroupNameEnum;
use Auth0\SDK\API\Management\Types\ScreenGroupNameEnum;
use Auth0\SDK\API\Management\Types\GetAculResponseContent;
use Auth0\SDK\API\Management\Prompts\Rendering\Requests\UpdateAculRequestContent;
use Auth0\SDK\API\Management\Types\UpdateAculResponseContent;

interface RenderingClientInterface
{
    /**
     * Get render setting configurations for all screens.
     *
     * @param ListAculsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ListAculsResponseContentItem>
     */
    public function list(ListAculsRequestParameters $request = new ListAculsRequestParameters(), ?array $options = null): Pager;

    /**
     * Learn more about [configuring render settings](https://auth0.com/docs/customize/login-pages/advanced-customizations/getting-started/configure-acul-screens) for advanced customization.
     *
     * @param BulkUpdateAculRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?BulkUpdateAculResponseContent
     */
    public function bulkUpdate(BulkUpdateAculRequestContent $request, ?array $options = null): ?BulkUpdateAculResponseContent;

    /**
     * Get render settings for a screen.
     *
     * @param value-of<PromptGroupNameEnum> $prompt Name of the prompt
     * @param value-of<ScreenGroupNameEnum> $screen Name of the screen
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetAculResponseContent
     */
    public function get(string $prompt, string $screen, ?array $options = null): ?GetAculResponseContent;

    /**
     * Learn more about [configuring render settings](https://auth0.com/docs/customize/login-pages/advanced-customizations/getting-started/configure-acul-screens) for advanced customization.
     *
     * @param value-of<PromptGroupNameEnum> $prompt Name of the prompt
     * @param value-of<ScreenGroupNameEnum> $screen Name of the screen
     * @param UpdateAculRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateAculResponseContent
     */
    public function update(string $prompt, string $screen, UpdateAculRequestContent $request = new UpdateAculRequestContent(), ?array $options = null): ?UpdateAculResponseContent;
}
