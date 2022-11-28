<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\ConnectionsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Connections.
 * Handles requests to the Connections endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Connections
 */
final class Connections extends ManagementEndpoint implements ConnectionsInterface
{
    public function create(
        string $name,
        string $strategy,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$name, $strategy] = Toolkit::filter([$name, $strategy])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
            [$strategy, \Auth0\SDK\Exception\ArgumentException::missing('strategy')],
        ])->isString();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('connections')->
            withBody(
                (object) Toolkit::merge([
                    'name'     => $name,
                    'strategy' => $strategy,
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
            addPath('connections')->
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
            addPath('connections', $id)->
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
            addPath('connections', $id)->
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
            addPath('connections', $id)->
            withOptions($options)->
            call();
    }

    public function deleteUser(
        string $id,
        string $email,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $email] = Toolkit::filter([$id, $email])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$email, \Auth0\SDK\Exception\ArgumentException::missing('email')],
        ])->isEmail();

        return $this->getHttpClient()->
            method('delete')->
            addPath('connections', $id, 'users')->
            withParam('email', $email)->
            withOptions($options)->
            call();
    }
}
