<?php

namespace Auth0\SDK\API\Management\Users\EffectivePermissions;

use Auth0\SDK\API\Management\Users\EffectivePermissions\Requests\ListUserEffectivePermissionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserEffectivePermissionResponseContent;
use Auth0\SDK\API\Management\Users\EffectivePermissions\Sources\SourcesClientInterface;

interface EffectivePermissionsClientInterface
{
    /**
     * Returns the list of effective permissions for a user, taking into account permissions granted directly to the user, as well as those inherited through roles and group memberships.
     *
     * @param string $id ID of the user to retrieve the permissions for.
     * @param ListUserEffectivePermissionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserEffectivePermissionResponseContent>
     */
    public function list(string $id, ListUserEffectivePermissionsRequestParameters $request, ?array $options = null): Pager;

    /**
     * @return SourcesClientInterface
     */
    public function getSources(): SourcesClientInterface;
}
