<?php

namespace Auth0\SDK\API\Management\Organizations\Roles\Members;

use Auth0\SDK\API\Management\Organizations\Roles\Members\Requests\ListOrganizationRoleMembersRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\RoleMember;

interface MembersClientInterface
{
    /**
     * List the organization members assigned a specific role within the context of an organization.
     *
     * @param string $id ID of the organization.
     * @param string $roleId ID of the role to retrieve the assigned members for.
     * @param ListOrganizationRoleMembersRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<RoleMember>
     */
    public function list(string $id, string $roleId, ListOrganizationRoleMembersRequestParameters $request = new ListOrganizationRoleMembersRequestParameters(), ?array $options = null): Pager;
}
