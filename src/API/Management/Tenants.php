<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Tenants.
 * Handles requests to the Tenants endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Tenants
 */
final class Tenants extends ManagementEndpoint
{
    /**
     * Return all tenant settings.
     * Required scope: `read:tenant_settings`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Tenants/tenant_settings_route
     */
    public function getSettings(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
            ->addPath('tenants', 'settings')
            ->withOptions($options)
            ->call();
    }

    /**
     * Update tenant settings.
     * Required scope: `update:tenant_settings`
     *
     * @param array<mixed>        $body    Updated settings to send to the API. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `body` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Tenants/patch_settings
     */
    public function updateSettings(
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('tenants', 'settings')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }
}
