<?php

namespace Auth0\SDK\API\Management\Users\Organizations;

use Auth0\SDK\API\Management\Users\Organizations\Requests\ListUserOrganizationsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Organization;

interface OrganizationsClientInterface
{
    /**
     * Retrieve list of the specified user's current Organization memberships. User must be specified by user ID. For more information, review [Auth0 Organizations](https://auth0.com/docs/manage-users/organizations).
     *
     * @param string $id ID of the user to retrieve the organizations for.
     * @param ListUserOrganizationsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Organization>
     */
    public function list(string $id, ListUserOrganizationsRequestParameters $request = new ListUserOrganizationsRequestParameters(), ?array $options = null): Pager;
}
