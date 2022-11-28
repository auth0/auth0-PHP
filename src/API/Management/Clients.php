<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\ClientsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Clients.
 * Handles requests to the Clients endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Clients
 */
final class Clients extends ManagementEndpoint implements ClientsInterface
{
    public function create(
        string $name,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$name] = Toolkit::filter([$name])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
        ])->isString();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('clients')->
            withBody(
                (object) Toolkit::merge([
                    'name' => $name,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        /* @var array<int|string|null> $parameters */

        return $this->getHttpClient()->
            method('get')->
            addPath('clients')->
            withParams($parameters)->
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
            addPath('clients', $id)->
            withOptions($options)->
            call();
    }

    public function update(
        string $id,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('patch')->
            addPath('clients', $id)->
            withBody($body ?? [])->
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
            addPath('clients', $id)->
            withOptions($options)->
            call();
    }
}
