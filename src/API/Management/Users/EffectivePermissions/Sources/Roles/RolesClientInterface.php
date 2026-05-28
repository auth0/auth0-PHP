<?php

namespace Auth0\SDK\API\Management\Users\EffectivePermissions\Sources\Roles;

use Auth0\SDK\API\Management\Users\EffectivePermissions\Sources\Roles\Requests\ListUserEffectivePermissionRoleSourceRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserEffectivePermissionRoleSourceResponseContent;

interface RolesClientInterface
{
    /**
     * Lists the roles which grant the user a given permission, including roles assigned directly to the user and those inherited through group memberships.
     *
     * @param string $id ID of the user to retrieve the permissions for.
     * @param ListUserEffectivePermissionRoleSourceRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserEffectivePermissionRoleSourceResponseContent>
     */
    public function list(string $id, ListUserEffectivePermissionRoleSourceRequestParameters $request, ?array $options = null): Pager;
}
