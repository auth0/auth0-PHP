<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Tenants.
 * Handles requests to the Tenants endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Tenants
 */
class Tenants extends GenericResource
{
    /**
     * Return all tenant settings.
     * Required scope: `read:tenant_settings`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Tenants/tenant_settings_route
     */
    public function get(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('get')
            ->addPath('tenants', 'settings')
            ->withOptions($options)
            ->call();
    }

    /**
     * Update tenant settings.
     * Required scope: `update:tenant_settings`
     *
     * @param array               $body    Updated settings to send to the API. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Tenants/patch_settings
     */
    public function update(
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('patch')
            ->addPath('tenants', 'settings')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }
}
