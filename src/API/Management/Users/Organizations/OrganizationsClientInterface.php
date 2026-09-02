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
     * This endpoint supports two types of pagination:
     *
     * - Offset pagination
     * - Checkpoint pagination
     *
     * Checkpoint pagination must be used if you need to retrieve more than 1000 organizations.
     *
     * **Checkpoint Pagination**
     *
     * To search by checkpoint, use the following parameters:
     *
     * - `from`: Optional id from which to start selection.
     * - `take`: The total number of entries to retrieve when using the `from` parameter. Defaults to 50.
     *
     * **Note**: The first time you call this endpoint using checkpoint pagination, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no pages are remaining.
     *
     * Example:
     * ```php
     * $client->users->organizations->list(
     *     'id',
     *     new ListUserOrganizationsRequestParameters([
     *         'page' => 1,
     *         'perPage' => 1,
     *         'includeTotals' => true,
     *     ]),
     * );
     * ```
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
