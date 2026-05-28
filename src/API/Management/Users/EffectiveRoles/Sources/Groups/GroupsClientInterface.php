<?php

namespace Auth0\SDK\API\Management\Users\EffectiveRoles\Sources\Groups;

use Auth0\SDK\API\Management\Users\EffectiveRoles\Sources\Groups\Requests\ListUserRoleSourceGroupsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Group;

interface GroupsClientInterface
{
    /**
     * Lists the groups that grant a user a specific role.
     *
     * @param string $id ID of the user to list role source groups for.
     * @param ListUserRoleSourceGroupsRequestParameters $request
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
    public function list(string $id, ListUserRoleSourceGroupsRequestParameters $request, ?array $options = null): Pager;
}
