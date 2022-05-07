<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface RolesInterface
 */
interface RolesInterface
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
    ): ResponseInterface;

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
    ): ResponseInterface;

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
    ): ResponseInterface;

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
    ): ResponseInterface;

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
    ): ResponseInterface;

    /**
     * Associate permissions with a role.
     * Required scope: `update:roles`
     *
     * @param string                                                                                        $id          Role ID to get permissions.
     * @param array{permissions: array<array{permission_name: string, resource_server_identifier: string}>} $permissions Permissions to add, array of permission arrays.
     * @param RequestOptions|null                                                                           $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
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
    ): ResponseInterface;

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
    ): ResponseInterface;

    /**
     * Delete permissions from a role.
     * Required scope: `update:roles`
     *
     * @param string                                                                                        $id          Role ID to get permissions.
     * @param array{permissions: array<array{permission_name: string, resource_server_identifier: string}>} $permissions Permissions to delete, array of permission arrays.
     * @param RequestOptions|null                                                                           $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
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
    ): ResponseInterface;

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
    ): ResponseInterface;

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
    ): ResponseInterface;
}
