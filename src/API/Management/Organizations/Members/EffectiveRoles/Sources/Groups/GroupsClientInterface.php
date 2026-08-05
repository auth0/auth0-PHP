<?php

namespace Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\Sources\Groups;

use Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\Sources\Groups\Requests\ListOrganizationMemberRoleSourceGroupsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Group;

interface GroupsClientInterface
{
    /**
     * Lists the groups which grant the org member a given role.
     *
     * Example:
     * ```php
     * $client->organizations->members->effectiveRoles->sources->groups->list(
     *     'id',
     *     'user_id',
     *     new ListOrganizationMemberRoleSourceGroupsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *         'roleId' => 'role_id',
     *     ]),
     * );
     * ```
     *
     * @param string $id Organization identifier.
     * @param string $userId ID of the user to list role source groups for.
     * @param ListOrganizationMemberRoleSourceGroupsRequestParameters $request
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
    public function list(string $id, string $userId, ListOrganizationMemberRoleSourceGroupsRequestParameters $request, ?array $options = null): Pager;
}
