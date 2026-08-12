<?php

namespace Auth0\SDK\API\Management\Organizations\ClientGrants;

use Auth0\SDK\API\Management\Organizations\ClientGrants\Requests\ListOrganizationClientGrantsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationClientGrant;
use Auth0\SDK\API\Management\Organizations\ClientGrants\Requests\AssociateOrganizationClientGrantRequestContent;
use Auth0\SDK\API\Management\Types\AssociateOrganizationClientGrantResponseContent;

interface ClientGrantsClientInterface
{
    /**
     * Example:
     * ```php
     * $client->organizations->clientGrants->list(
     *     'id',
     *     new ListOrganizationClientGrantsRequestParameters([
     *         'audience' => 'audience',
     *         'clientId' => 'client_id',
     *         'grantIds' => [
     *             'grant_ids',
     *         ],
     *         'page' => 1,
     *         'perPage' => 1,
     *         'includeTotals' => true,
     *     ]),
     * );
     * ```
     *
     * @param string $id Organization identifier.
     * @param ListOrganizationClientGrantsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationClientGrant>
     */
    public function list(string $id, ListOrganizationClientGrantsRequestParameters $request = new ListOrganizationClientGrantsRequestParameters(), ?array $options = null): Pager;

    /**
     * Example:
     * ```php
     * $client->organizations->clientGrants->create(
     *     'id',
     *     new AssociateOrganizationClientGrantRequestContent([
     *         'grantId' => 'grant_id',
     *     ]),
     * );
     * ```
     *
     * @param string $id Organization identifier.
     * @param AssociateOrganizationClientGrantRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AssociateOrganizationClientGrantResponseContent
     */
    public function create(string $id, AssociateOrganizationClientGrantRequestContent $request, ?array $options = null): ?AssociateOrganizationClientGrantResponseContent;

    /**
     * Example:
     * ```php
     * $client->organizations->clientGrants->delete(
     *     'id',
     *     'grant_id',
     * );
     * ```
     *
     * @param string $id Organization identifier.
     * @param string $grantId The Client Grant ID to remove from the organization
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $grantId, ?array $options = null): void;
}
