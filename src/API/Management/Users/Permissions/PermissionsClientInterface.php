<?php

namespace Auth0\SDK\API\Management\Users\Permissions;

use Auth0\SDK\API\Management\Users\Permissions\Requests\ListUserPermissionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserPermissionSchema;
use Auth0\SDK\API\Management\Users\Permissions\Requests\CreateUserPermissionsRequestContent;
use Auth0\SDK\API\Management\Users\Permissions\Requests\DeleteUserPermissionsRequestContent;

interface PermissionsClientInterface
{
    /**
     * Retrieve all permissions associated with the user.
     *
     * **Note**: Returns only permissions from direct assignments and directly assigned roles. For permissions a user has via group-based role assignments, use `GET /api/v2/users/{id}/effective-permissions`.
     *
     * Example:
     * ```php
     * $client->users->permissions->list(
     *     'id',
     *     new ListUserPermissionsRequestParameters([
     *         'perPage' => 1,
     *         'page' => 1,
     *         'includeTotals' => true,
     *     ]),
     * );
     * ```
     *
     * @param string $id ID of the user to retrieve the permissions for.
     * @param ListUserPermissionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserPermissionSchema>
     */
    public function list(string $id, ListUserPermissionsRequestParameters $request = new ListUserPermissionsRequestParameters(), ?array $options = null): Pager;

    /**
     * Assign permissions to a user.
     *
     * Example:
     * ```php
     * $client->users->permissions->create(
     *     'id',
     *     new CreateUserPermissionsRequestContent([
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
     * @param string $id ID of the user to assign permissions to.
     * @param CreateUserPermissionsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function create(string $id, CreateUserPermissionsRequestContent $request, ?array $options = null): void;

    /**
     * Remove permissions from a user.
     *
     * Example:
     * ```php
     * $client->users->permissions->delete(
     *     'id',
     *     new DeleteUserPermissionsRequestContent([
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
     * @param string $id ID of the user to remove permissions from.
     * @param DeleteUserPermissionsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, DeleteUserPermissionsRequestContent $request, ?array $options = null): void;
}
