<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\UsersInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Users.
 * Handles requests to the Users endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Users
 */
final class Users extends ManagementEndpoint implements UsersInterface
{
    public function create(
        string $connection,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$connection] = Toolkit::filter([$connection])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$connection, \Auth0\SDK\Exception\ArgumentException::missing('connection')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('users')->
            withBody(
                (object) Toolkit::merge([
                    'connection' => $connection,
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
            addPath('users')->
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
            addPath('users', $id)->
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
            addPath('users', $id)->
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
            addPath('users', $id)->
            withOptions($options)->
            call();
    }

    public function linkAccount(
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
            method('post')->
            addPath('users', $id, 'identities')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function unlinkAccount(
        string $id,
        string $provider,
        string $identityId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $provider, $identityId] = Toolkit::filter([$id, $provider, $identityId])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$provider, \Auth0\SDK\Exception\ArgumentException::missing('provider')],
            [$identityId, \Auth0\SDK\Exception\ArgumentException::missing('identityId')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('users', $id, 'identities', $provider, $identityId)->
            withOptions($options)->
            call();
    }

    public function addRoles(
        string $id,
        array $roles,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$roles] = Toolkit::filter([$roles])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$roles, \Auth0\SDK\Exception\ArgumentException::missing('roles')],
        ])->isArray();

        return $this->getHttpClient()->
            method('post')->
            addPath('users', $id, 'roles')->
            withBody(
                (object) [
                    'roles' => $roles,
                ],
            )->
            withOptions($options)->
            call();
    }

    public function getRoles(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('users', $id, 'roles')->
            withOptions($options)->
            call();
    }

    public function removeRoles(
        string $id,
        array $roles,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$roles] = Toolkit::filter([$roles])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$roles, \Auth0\SDK\Exception\ArgumentException::missing('roles')],
        ])->isArray();

        return $this->getHttpClient()->
            method('delete')->
            addPath('users', $id, 'roles')->
            withBody(
                (object) [
                    'roles' => $roles,
                ],
            )->
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
            addPath('users', $id, 'permissions')->
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
            addPath('users', $id, 'permissions')->
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
            addPath('users', $id, 'permissions')->
            withBody($permissions)->
            withOptions($options)->
            call();
    }

    public function getLogs(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('users', $id, 'logs')->
            withOptions($options)->
            call();
    }

    public function getOrganizations(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('users', $id, 'organizations')->
            withOptions($options)->
            call();
    }

    public function getEnrollments(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('users', $id, 'enrollments')->
            withOptions($options)->
            call();
    }

    public function createRecoveryCode(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('post')->
            addPath('users', $id, 'recovery-code-regeneration')->
            withOptions($options)->
            call();
    }

    public function invalidateBrowsers(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('post')->
            addPath('users', $id, 'multifactor', 'actions', 'invalidate-remember-browser')->
            withOptions($options)->
            call();
    }

    public function deleteMultifactorProvider(
        string $id,
        string $provider,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id, $provider] = Toolkit::filter([$id, $provider])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$provider, \Auth0\SDK\Exception\ArgumentException::missing('provider')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('users', $id, 'multifactor', $provider)->
            withOptions($options)->
            call();
    }
}
