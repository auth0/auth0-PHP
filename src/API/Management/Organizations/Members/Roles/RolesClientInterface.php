<?php

namespace Auth0\SDK\API\Management\Organizations\Members\Roles;

use Auth0\SDK\API\Management\Organizations\Members\Roles\Requests\ListOrganizationMemberRolesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Role;
use Auth0\SDK\API\Management\Organizations\Members\Roles\Requests\AssignOrganizationMemberRolesRequestContent;
use Auth0\SDK\API\Management\Organizations\Members\Roles\Requests\DeleteOrganizationMemberRolesRequestContent;

interface RolesClientInterface
{
    /**
     * Retrieve detailed list of roles assigned to a given user within the context of a specific Organization.
     *
     * Users can be members of multiple Organizations with unique roles assigned for each membership. This action only returns the roles associated with the specified Organization; any roles assigned to the user within other Organizations are not included.
     *
     * @param string $id Organization identifier.
     * @param string $userId ID of the user to associate roles with.
     * @param ListOrganizationMemberRolesRequestParameters $request
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
    public function list(string $id, string $userId, ListOrganizationMemberRolesRequestParameters $request = new ListOrganizationMemberRolesRequestParameters(), ?array $options = null): Pager;

    /**
     * Assign one or more [roles](https://auth0.com/docs/manage-users/access-control/rbac) to a user to determine their access for a specific Organization.
     *
     * Users can be members of multiple Organizations with unique roles assigned for each membership. This action assigns roles to a user only for the specified Organization. Roles cannot be assigned to a user across multiple Organizations in the same call.
     *
     * @param string $id Organization identifier.
     * @param string $userId ID of the user to associate roles with.
     * @param AssignOrganizationMemberRolesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function assign(string $id, string $userId, AssignOrganizationMemberRolesRequestContent $request, ?array $options = null): void;

    /**
     * Remove one or more Organization-specific [roles](https://auth0.com/docs/manage-users/access-control/rbac) from a given user.
     *
     * Users can be members of multiple Organizations with unique roles assigned for each membership. This action removes roles from a user in relation to the specified Organization. Roles assigned to the user within a different Organization cannot be managed in the same call.
     *
     * @param string $id Organization identifier.
     * @param string $userId User ID of the organization member to remove roles from.
     * @param DeleteOrganizationMemberRolesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $userId, DeleteOrganizationMemberRolesRequestContent $request, ?array $options = null): void;
}
