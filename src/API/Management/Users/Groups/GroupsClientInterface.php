<?php

namespace Auth0\SDK\API\Management\Users\Groups;

use Auth0\SDK\API\Management\Users\Groups\Requests\GetUserGroupsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserGroupsResponseSchema;

interface GroupsClientInterface
{
    /**
     * List all groups to which this user belongs.
     *
     * @param string $id ID of the user to list groups for.
     * @param GetUserGroupsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserGroupsResponseSchema>
     */
    public function get(string $id, GetUserGroupsRequestParameters $request = new GetUserGroupsRequestParameters(), ?array $options = null): Pager;
}
