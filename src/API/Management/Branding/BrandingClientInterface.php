<?php

namespace Auth0\SDK\API\Management\Branding;

use Auth0\SDK\API\Management\Types\GetBrandingResponseContent;
use Auth0\SDK\API\Management\Branding\Requests\UpdateBrandingRequestContent;
use Auth0\SDK\API\Management\Types\UpdateBrandingResponseContent;
use Auth0\SDK\API\Management\Branding\Templates\TemplatesClientInterface;
use Auth0\SDK\API\Management\Branding\Themes\ThemesClientInterface;
use Auth0\SDK\API\Management\Branding\Phone\PhoneClientInterface;

interface BrandingClientInterface
{
    /**
     * Retrieve branding settings.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetBrandingResponseContent
     */
    public function get(?array $options = null): ?GetBrandingResponseContent;

    /**
     * Update branding settings.
     *
     * @param UpdateBrandingRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateBrandingResponseContent
     */
    public function update(UpdateBrandingRequestContent $request = new UpdateBrandingRequestContent(), ?array $options = null): ?UpdateBrandingResponseContent;

    /**
     * @return TemplatesClientInterface
     */
    public function getTemplates(): TemplatesClientInterface;

    /**
     * @return ThemesClientInterface
     */
    public function getThemes(): ThemesClientInterface;

    /**
     * @return PhoneClientInterface
     */
    public function getPhone(): PhoneClientInterface;
}
