<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\ResourceServersInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ResourceServers.
 * Handles requests to the Resource Servers endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Resource_Servers
 */
final class ResourceServers extends ManagementEndpoint implements ResourceServersInterface
{
    public function create(
        string $identifier,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$identifier] = Toolkit::filter([$identifier])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$identifier, \Auth0\SDK\Exception\ArgumentException::missing('identifier')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('resource-servers')->
            withBody(
                (object) Toolkit::merge([
                    'identifier' => $identifier,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function getAll(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('resource-servers')->
            withOptions($options)->
            call();
    }

    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('resource-servers', $id)->
            withOptions($options)->
            call();
    }

    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('patch')->
            addPath('resource-servers', $id)->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('resource-servers', $id)->
            withOptions($options)->
            call();
    }
}
