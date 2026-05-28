<?php

namespace Auth0\SDK\API\Management\Roles;

use Auth0\SDK\API\Management\Roles\Requests\ListRolesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Role;
use Auth0\SDK\API\Management\Roles\Requests\CreateRoleRequestContent;
use Auth0\SDK\API\Management\Types\CreateRoleResponseContent;
use Auth0\SDK\API\Management\Types\GetRoleResponseContent;
use Auth0\SDK\API\Management\Roles\Requests\UpdateRoleRequestContent;
use Auth0\SDK\API\Management\Types\UpdateRoleResponseContent;
use Auth0\SDK\API\Management\Roles\Groups\GroupsClientInterface;
use Auth0\SDK\API\Management\Roles\Permissions\PermissionsClientInterface;
use Auth0\SDK\API\Management\Roles\Users\UsersClientInterface;

interface RolesClientInterface
{
    /**
     * Retrieve detailed list of user roles created in your tenant.
     *
     * **Note**: The returned list does not include standard roles available for tenant members, such as Admin or Support Access.
     *
     * @param ListRolesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Role>
     */
    public function list(ListRolesRequestParameters $request = new ListRolesRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a user role for [Role-Based Access Control](https://auth0.com/docs/manage-users/access-control/rbac).
     *
     * **Note**: New roles are not associated with any permissions by default. To assign existing permissions to your role, review Associate Permissions with a Role. To create new permissions, review Add API Permissions.
     *
     * @param CreateRoleRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateRoleResponseContent
     */
    public function create(CreateRoleRequestContent $request, ?array $options = null): ?CreateRoleResponseContent;

    /**
     * Retrieve details about a specific [user role](https://auth0.com/docs/manage-users/access-control/rbac) specified by ID.
     *
     * @param string $id ID of the role to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetRoleResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetRoleResponseContent;

    /**
     * Delete a specific [user role](https://auth0.com/docs/manage-users/access-control/rbac) from your tenant. Once deleted, it is removed from any user who was previously assigned that role. This action cannot be undone.
     *
     * @param string $id ID of the role to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;

    /**
     * Modify the details of a specific [user role](https://auth0.com/docs/manage-users/access-control/rbac) specified by ID.
     *
     * @param string $id ID of the role to update.
     * @param UpdateRoleRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateRoleResponseContent
     */
    public function update(string $id, UpdateRoleRequestContent $request = new UpdateRoleRequestContent(), ?array $options = null): ?UpdateRoleResponseContent;

    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface;

    /**
     * @return PermissionsClientInterface
     */
    public function getPermissions(): PermissionsClientInterface;

    /**
     * @return UsersClientInterface
     */
    public function getUsers(): UsersClientInterface;
}
