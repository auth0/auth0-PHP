<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Roles.
 * Handles requests to the Roles endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Roles
 */
final class Roles extends ManagementEndpoint
{
    /**
     * Create a new Role.
     * Required scope: `create:roles`
     *
     * @param string              $name    Role name.
     * @param array<mixed>|null   $body    Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `name` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/post_roles
     */
    public function create(
        string $name,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$name] = Toolkit::filter([$name])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('roles')
            ->withBody(
                (object) Toolkit::merge([
                    'name' => $name,
                ], $body)
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Get all Roles
     * Required scope: `read:roles`
     *
     * @param array<int|string|null>|null $parameters Optional. Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null         $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_roles
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('roles')
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a single Role by ID.
     * Required scope: `read:roles`
     *
     * @param string              $id      Role ID to get.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_roles_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('roles', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a Role by ID.
     * Required scope: `update:roles`
     *
     * @param string              $id      Role ID update.
     * @param array<mixed>        $body    Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` or `body` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/patch_roles_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('roles', $id)
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a single Role by ID.
     * Required scope: `delete:roles`
     *
     * @param string              $id      Role ID to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/delete_roles_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('roles', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Associate permissions with a role.
     * Required scope: `update:roles`
     *
     * @param string              $id          Role ID to get permissions.
     * @param array<array>        $permissions Permissions to add, array of permission arrays.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` or `permissions` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/post_role_permission_assignment
     */
    public function addPermissions(
        string $id,
        array $permissions,
        ?RequestOptions $options = null
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

        return $this->getHttpClient()
            ->method('post')
            ->addPath('roles', $id, 'permissions')
            ->withBody($permissions)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get the permissions associated to a role.
     * Required scope: `read:roles`
     *
     * @param string              $id      Role ID to get permissions.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_role_permission
     */
    public function getPermissions(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('roles', $id, 'permissions')
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete permissions from a role.
     * Required scope: `update:roles`
     *
     * @param string              $id          Role ID to get permissions.
     * @param array<array>        $permissions Permissions to delete, array of permission arrays.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` or `permissions` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/delete_role_permission_assignment
     */
    public function removePermissions(
        string $id,
        array $permissions,
        ?RequestOptions $options = null
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

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('roles', $id, 'permissions')
            ->withBody($permissions)
            ->withOptions($options)
            ->call();
    }

    /**
     * Add one or more users to a role.
     * Required scope: `update:roles`
     *
     * @param string              $id      Role ID to add users.
     * @param array<string>       $users   Array of user IDs to add to the role.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` or `users` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/post_role_users
     */
    public function addUsers(
        string $id,
        array $users,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$users] = Toolkit::filter([$users])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$users, \Auth0\SDK\Exception\ArgumentException::missing('users')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('roles', $id, 'users')
            ->withBody(
                (object) [
                    'users' => $users,
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Get users assigned to a specific role.
     * Required scopes:
     * - `read:roles`
     * - `read:users`
     *
     * @param string              $id      Role ID assigned to users.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_role_user
     */
    public function getUsers(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('roles', $id, 'users')
            ->withOptions($options)
            ->call();
    }
}
