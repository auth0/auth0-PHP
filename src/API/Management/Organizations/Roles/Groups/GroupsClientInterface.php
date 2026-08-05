<?php

namespace Auth0\SDK\API\Management\Organizations\Roles\Groups;

use Auth0\SDK\API\Management\Organizations\Roles\Groups\Requests\ListOrganizationRoleGroupsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\RoleGroup;

interface GroupsClientInterface
{
    /**
     * Retrieve the list of groups assigned to a role in the context of an organization.
     *
     * Example:
     * ```php
     * $client->organizations->roles->groups->list(
     *     'organization_id',
     *     'role_id',
     *     new ListOrganizationRoleGroupsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param string $organizationId ID of the organization.
     * @param string $roleId ID of the role.
     * @param ListOrganizationRoleGroupsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<RoleGroup>
     */
    public function list(string $organizationId, string $roleId, ListOrganizationRoleGroupsRequestParameters $request = new ListOrganizationRoleGroupsRequestParameters(), ?array $options = null): Pager;
}
