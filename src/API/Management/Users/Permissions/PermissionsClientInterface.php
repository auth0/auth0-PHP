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
