<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface TenantsInterface.
 */
interface TenantsInterface
{
    /**
     * Return all tenant settings.
     * Required scope: `read:tenant_settings`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Tenants/tenant_settings_route
     */
    public function getSettings(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update tenant settings.
     * Required scope: `update:tenant_settings`.
     *
     * @param  array<mixed>  $body  Updated settings to send to the API. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `body` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Tenants/patch_settings
     */
    public function updateSettings(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
