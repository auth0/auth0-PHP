<?php

namespace Auth0\SDK\API\Management\ClientGrants\Organizations;

use Auth0\SDK\API\Management\ClientGrants\Organizations\Requests\ListClientGrantOrganizationsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Organization;

interface OrganizationsClientInterface
{
    /**
     * Example:
     * ```php
     * $client->clientGrants->organizations->list(
     *     'id',
     *     new ListClientGrantOrganizationsRequestParameters([
     *         'includeTotals' => true,
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param string $id ID of the client grant
     * @param ListClientGrantOrganizationsRequestParameters $request
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
    public function list(string $id, ListClientGrantOrganizationsRequestParameters $request = new ListClientGrantOrganizationsRequestParameters(), ?array $options = null): Pager;
}
