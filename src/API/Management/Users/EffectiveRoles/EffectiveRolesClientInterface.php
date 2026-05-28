<?php

namespace Auth0\SDK\API\Management\Users\EffectiveRoles;

use Auth0\SDK\API\Management\Users\EffectiveRoles\Requests\ListUserEffectiveRolesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserEffectiveRole;
use Auth0\SDK\API\Management\Users\EffectiveRoles\Sources\SourcesClientInterface;

interface EffectiveRolesClientInterface
{
    /**
     * Retrieve detailed list of effective roles for a user, including roles assigned directly and through group memberships.
     *
     * @param string $id ID of the user to list effective roles for.
     * @param ListUserEffectiveRolesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserEffectiveRole>
     */
    public function list(string $id, ListUserEffectiveRolesRequestParameters $request = new ListUserEffectiveRolesRequestParameters(), ?array $options = null): Pager;

    /**
     * @return SourcesClientInterface
     */
    public function getSources(): SourcesClientInterface;
}
