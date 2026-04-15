<?php

namespace Auth0\SDK\API\Management\Roles\Users;

use Auth0\SDK\API\Management\Roles\Users\Requests\ListRoleUsersRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\RoleUser;
use Auth0\SDK\API\Management\Roles\Users\Requests\AssignRoleUsersRequestContent;

interface UsersClientInterface
{
    /**
     * Retrieve list of users associated with a specific role. For Dashboard instructions, review <a href="https://auth0.com/docs/manage-users/access-control/configure-core-rbac/roles/view-users-assigned-to-roles">View Users Assigned to Roles</a>.
     *
     * This endpoint supports two types of pagination:
     * <ul>
     * <li>Offset pagination</li>
     * <li>Checkpoint pagination</li>
     * </ul>
     *
     * Checkpoint pagination must be used if you need to retrieve more than 1000 organization members.
     *
     * <h2>Checkpoint Pagination</h2>
     *
     * To search by checkpoint, use the following parameters:
     * <ul>
     * <li><code>from</code>: Optional id from which to start selection.</li>
     * <li><code>take</code>: The total amount of entries to retrieve when using the from parameter. Defaults to 50.</li>
     * </ul>
     *
     * <b>Note</b>: The first time you call this endpoint using checkpoint pagination, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no pages are remaining.
     *
     * @param string $id ID of the role to retrieve a list of users associated with.
     * @param ListRoleUsersRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<RoleUser>
     */
    public function list(string $id, ListRoleUsersRequestParameters $request = new ListRoleUsersRequestParameters(), ?array $options = null): Pager;

    /**
     * Assign one or more users to an existing user role. To learn more, review <a href="https://auth0.com/docs/manage-users/access-control/rbac">Role-Based Access Control</a>.
     *
     * <b>Note</b>: New roles cannot be created through this action.
     *
     * @param string $id ID of the role to assign users to.
     * @param AssignRoleUsersRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function assign(string $id, AssignRoleUsersRequestContent $request, ?array $options = null): void;
}
