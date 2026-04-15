<?php

namespace Auth0\SDK\API\Management\Tenants\Settings;

use Auth0\SDK\API\Management\Tenants\Settings\Requests\GetTenantSettingsRequestParameters;
use Auth0\SDK\API\Management\Types\GetTenantSettingsResponseContent;
use Auth0\SDK\API\Management\Tenants\Settings\Requests\UpdateTenantSettingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateTenantSettingsResponseContent;

interface SettingsClientInterface
{
    /**
     * Retrieve tenant settings. A list of fields to include or exclude may also be specified.
     *
     * @param GetTenantSettingsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetTenantSettingsResponseContent
     */
    public function get(GetTenantSettingsRequestParameters $request = new GetTenantSettingsRequestParameters(), ?array $options = null): ?GetTenantSettingsResponseContent;

    /**
     * Update settings for a tenant.
     *
     * @param UpdateTenantSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateTenantSettingsResponseContent
     */
    public function update(UpdateTenantSettingsRequestContent $request = new UpdateTenantSettingsRequestContent(), ?array $options = null): ?UpdateTenantSettingsResponseContent;
}
