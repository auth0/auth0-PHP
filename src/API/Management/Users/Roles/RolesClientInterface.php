<?php

namespace Auth0\SDK\API\Management\Users\Roles;

use Auth0\SDK\API\Management\Users\Roles\Requests\ListUserRolesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Role;
use Auth0\SDK\API\Management\Users\Roles\Requests\AssignUserRolesRequestContent;
use Auth0\SDK\API\Management\Users\Roles\Requests\DeleteUserRolesRequestContent;

interface RolesClientInterface
{
    /**
     * Retrieve detailed list of all user roles currently assigned to a user.
     *
     * **Note**: This action retrieves all roles assigned to a user in the context of your whole tenant. To retrieve Organization-specific roles, use the following endpoint: [Get user roles assigned to an Organization member](https://auth0.com/docs/api/management/v2/organizations/get-organization-member-roles).
     *
     * @param string $id ID of the user to list roles for.
     * @param ListUserRolesRequestParameters $request
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
    public function list(string $id, ListUserRolesRequestParameters $request = new ListUserRolesRequestParameters(), ?array $options = null): Pager;

    /**
     * Assign one or more existing user roles to a user. For more information, review [Role-Based Access Control](https://auth0.com/docs/manage-users/access-control/rbac).
     *
     * **Note**: New roles cannot be created through this action. Additionally, this action is used to assign roles to a user in the context of your whole tenant. To assign roles in the context of a specific Organization, use the following endpoint: [Assign user roles to an Organization member](https://auth0.com/docs/api/management/v2/organizations/post-organization-member-roles).
     *
     * @param string $id ID of the user to associate roles with.
     * @param AssignUserRolesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function assign(string $id, AssignUserRolesRequestContent $request, ?array $options = null): void;

    /**
     * Remove one or more specified user roles assigned to a user.
     *
     * **Note**: This action removes a role from a user in the context of your whole tenant. If you want to unassign a role from a user in the context of a specific Organization, use the following endpoint: [Delete user roles from an Organization member](https://auth0.com/docs/api/management/v2/organizations/delete-organization-member-roles).
     *
     * @param string $id ID of the user to remove roles from.
     * @param DeleteUserRolesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, DeleteUserRolesRequestContent $request, ?array $options = null): void;
}
