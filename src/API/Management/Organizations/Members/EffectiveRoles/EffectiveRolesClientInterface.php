<?php

namespace Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles;

use Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\Requests\ListOrganizationMemberEffectiveRolesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationMemberEffectiveRole;
use Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\Sources\SourcesClientInterface;

interface EffectiveRolesClientInterface
{
    /**
     * Lists the roles assigned to an organization member directly or through group membership.
     *
     * @param string $id Organization identifier.
     * @param string $userId ID of the user to list effective roles for.
     * @param ListOrganizationMemberEffectiveRolesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationMemberEffectiveRole>
     */
    public function list(string $id, string $userId, ListOrganizationMemberEffectiveRolesRequestParameters $request = new ListOrganizationMemberEffectiveRolesRequestParameters(), ?array $options = null): Pager;

    /**
     * @return SourcesClientInterface
     */
    public function getSources(): SourcesClientInterface;
}
