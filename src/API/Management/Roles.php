<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\RolesInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Roles.
 * Handles requests to the Roles endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Roles
 */
final class Roles extends ManagementEndpoint implements RolesInterface
{
    public function create(
        string $name,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$name] = Toolkit::filter([$name])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        /* @var array<mixed> $body */

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
        ])->isString();

        return $this->getHttpClient()->
            method('post')->
            addPath('roles')->
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
            addPath('roles')->
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
            addPath('roles', $id)->
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
            addPath('roles', $id)->
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
            addPath('roles', $id)->
            withOptions($options)->
            call();
    }

    public function addPermissions(
        string $id,
        array $permissions,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$permissions] = Toolkit::filter([$permissions])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$permissions, \Auth0\SDK\Exception\ArgumentException::missing('permissions')],
        ])->isPermissions();

        [$permissions] = Toolkit::filter([$permissions])->array()->permissions();

        return $this->getHttpClient()->
            method('post')->
            addPath('roles', $id, 'permissions')->
            withBody($permissions)->
            withOptions($options)->
            call();
    }

    public function getPermissions(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('roles', $id, 'permissions')->
            withOptions($options)->
            call();
    }

    public function removePermissions(
        string $id,
        array $permissions,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$permissions] = Toolkit::filter([$permissions])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$permissions, \Auth0\SDK\Exception\ArgumentException::missing('permissions')],
        ])->isPermissions();

        [$permissions] = Toolkit::filter([$permissions])->array()->permissions();

        return $this->getHttpClient()->
            method('delete')->
            addPath('roles', $id, 'permissions')->
            withBody($permissions)->
            withOptions($options)->
            call();
    }

    public function addUsers(
        string $id,
        array $users,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$users] = Toolkit::filter([$users])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$users, \Auth0\SDK\Exception\ArgumentException::missing('users')],
        ])->isArray();

        return $this->getHttpClient()->
            method('post')->
            addPath('roles', $id, 'users')->
            withBody(
                (object) [
                    'users' => $users,
                ],
            )->
            withOptions($options)->
            call();
    }

    public function getUsers(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('roles', $id, 'users')->
            withOptions($options)->
            call();
    }
}
