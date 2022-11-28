<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\TenantsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Tenants.
 * Handles requests to the Tenants endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Tenants
 */
final class Tenants extends ManagementEndpoint implements TenantsInterface
{
    public function getSettings(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('tenants', 'settings')->
            withOptions($options)->
            call();
    }

    public function updateSettings(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('patch')->
            addPath('tenants', 'settings')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }
}
