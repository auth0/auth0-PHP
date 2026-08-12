<?php

namespace Auth0\SDK\API\Management\Roles\Permissions;

use Auth0\SDK\API\Management\Roles\Permissions\Requests\ListRolePermissionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\PermissionsResponsePayload;
use Auth0\SDK\API\Management\Roles\Permissions\Requests\AddRolePermissionsRequestContent;
use Auth0\SDK\API\Management\Roles\Permissions\Requests\DeleteRolePermissionsRequestContent;

interface PermissionsClientInterface
{
    /**
     * Retrieve detailed list (name, description, resource server) of permissions granted by a specified user role.
     *
     * Example:
     * ```php
     * $client->roles->permissions->list(
     *     'id',
     *     new ListRolePermissionsRequestParameters([
     *         'perPage' => 1,
     *         'page' => 1,
     *         'includeTotals' => true,
     *     ]),
     * );
     * ```
     *
     * @param string $id ID of the role to list granted permissions.
     * @param ListRolePermissionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<PermissionsResponsePayload>
     */
    public function list(string $id, ListRolePermissionsRequestParameters $request = new ListRolePermissionsRequestParameters(), ?array $options = null): Pager;

    /**
     * Add one or more [permissions](https://auth0.com/docs/manage-users/access-control/configure-core-rbac/manage-permissions) to a specified user role.
     *
     * Example:
     * ```php
     * $client->roles->permissions->add(
     *     'id',
     *     new AddRolePermissionsRequestContent([
     *         'permissions' => [
     *             new PermissionRequestPayload([
     *                 'resourceServerIdentifier' => 'resource_server_identifier',
     *                 'permissionName' => 'permission_name',
     *             ]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id ID of the role to add permissions to.
     * @param AddRolePermissionsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function add(string $id, AddRolePermissionsRequestContent $request, ?array $options = null): void;

    /**
     * Remove one or more [permissions](https://auth0.com/docs/manage-users/access-control/configure-core-rbac/manage-permissions) from a specified user role.
     *
     * Example:
     * ```php
     * $client->roles->permissions->delete(
     *     'id',
     *     new DeleteRolePermissionsRequestContent([
     *         'permissions' => [
     *             new PermissionRequestPayload([
     *                 'resourceServerIdentifier' => 'resource_server_identifier',
     *                 'permissionName' => 'permission_name',
     *             ]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id ID of the role to remove permissions from.
     * @param DeleteRolePermissionsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, DeleteRolePermissionsRequestContent $request, ?array $options = null): void;
}
