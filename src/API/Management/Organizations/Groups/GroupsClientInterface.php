<?php

namespace Auth0\SDK\API\Management\Organizations\Groups;

use Auth0\SDK\API\Management\Organizations\Groups\Requests\ListOrganizationGroupsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Group;
use Auth0\SDK\API\Management\Organizations\Groups\Roles\RolesClientInterface;

interface GroupsClientInterface
{
    /**
     * Lists the groups that are assigned to the specified organization.
     *
     * @param string $organizationId ID of the organization
     * @param ListOrganizationGroupsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Group>
     */
    public function list(string $organizationId, ListOrganizationGroupsRequestParameters $request = new ListOrganizationGroupsRequestParameters(), ?array $options = null): Pager;

    /**
     * @return RolesClientInterface
     */
    public function getRoles(): RolesClientInterface;
}
