<?php

namespace Auth0\SDK\API\Management\Organizations\Clients;

use Auth0\SDK\API\Management\Organizations\Clients\Requests\ListOrganizationClientsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationClient;
use Auth0\SDK\API\Management\Organizations\Clients\Requests\CreateOrganizationClientsRequestContent;
use Auth0\SDK\API\Management\Organizations\Clients\Requests\DeleteOrganizationClientsRequestContent;
use Auth0\SDK\API\Management\Types\GetOrganizationClientResponseContent;
use Auth0\SDK\API\Management\Organizations\Clients\Requests\UpdateOrganizationClientRequestContent;
use Auth0\SDK\API\Management\Types\UpdateOrganizationClientResponseContent;

interface ClientsClientInterface
{
    /**
     * List all clients associated with an organization, using checkpoint pagination.
     * <ul>
     *   <li>
     *     <b>Note</b>: The first time you call this endpoint, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no further results are remaining.
     *   </li>
     * </ul>
     *
     * Example:
     * ```php
     * $client->organizations->clients->list(
     *     'id',
     *     new ListOrganizationClientsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param string $id ID of the organization.
     * @param ListOrganizationClientsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationClient>
     */
    public function list(string $id, ListOrganizationClientsRequestParameters $request = new ListOrganizationClientsRequestParameters(), ?array $options = null): Pager;

    /**
     * Associate one or more clients with an organization.
     *
     * Example:
     * ```php
     * $client->organizations->clients->create(
     *     'id',
     *     new CreateOrganizationClientsRequestContent([
     *         'clients' => [
     *             new CreateOrganizationClientRequestItem([
     *                 'clientId' => 'client_id',
     *                 'useForMemberAccess' => true,
     *             ]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id ID of the organization.
     * @param CreateOrganizationClientsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<OrganizationClient>
     */
    public function create(string $id, CreateOrganizationClientsRequestContent $request, ?array $options = null): ?array;

    /**
     * Remove one or more client associations from an organization.
     *
     * Example:
     * ```php
     * $client->organizations->clients->delete(
     *     'id',
     *     new DeleteOrganizationClientsRequestContent([
     *         'clients' => [
     *             'clients',
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id ID of the organization.
     * @param DeleteOrganizationClientsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, DeleteOrganizationClientsRequestContent $request, ?array $options = null): void;

    /**
     * Get a specific client association for an organization.
     *
     * Example:
     * ```php
     * $client->organizations->clients->get(
     *     'id',
     *     'client_id',
     * );
     * ```
     *
     * @param string $id ID of the organization.
     * @param string $clientId ID of the client association to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationClientResponseContent
     */
    public function get(string $id, string $clientId, ?array $options = null): ?GetOrganizationClientResponseContent;

    /**
     * Update an organization client association.
     *
     * Example:
     * ```php
     * $client->organizations->clients->update(
     *     'id',
     *     'client_id',
     *     new UpdateOrganizationClientRequestContent([]),
     * );
     * ```
     *
     * @param string $id ID of the organization.
     * @param string $clientId ID of the client association to update.
     * @param UpdateOrganizationClientRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateOrganizationClientResponseContent
     */
    public function update(string $id, string $clientId, UpdateOrganizationClientRequestContent $request = new UpdateOrganizationClientRequestContent(), ?array $options = null): ?UpdateOrganizationClientResponseContent;
}
