<?php

namespace Auth0\SDK\API\Management\Organizations\Connections;

use Auth0\SDK\API\Management\Organizations\Connections\Requests\ListOrganizationAllConnectionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationAllConnectionPost;
use Auth0\SDK\API\Management\Organizations\Connections\Requests\CreateOrganizationAllConnectionRequestParameters;
use Auth0\SDK\API\Management\Types\CreateOrganizationAllConnectionResponseContent;
use Auth0\SDK\API\Management\Types\GetOrganizationAllConnectionResponseContent;
use Auth0\SDK\API\Management\Organizations\Connections\Requests\UpdateOrganizationConnectionRequestParameters;
use Auth0\SDK\API\Management\Types\UpdateOrganizationAllConnectionResponseContent;

interface ConnectionsClientInterface
{
    /**
     * Example:
     * ```php
     * $client->organizations->connections->list(
     *     'id',
     *     new ListOrganizationAllConnectionsRequestParameters([
     *         'page' => 1,
     *         'perPage' => 1,
     *         'includeTotals' => true,
     *         'isEnabled' => true,
     *     ]),
     * );
     * ```
     *
     * @param string $id Organization identifier.
     * @param ListOrganizationAllConnectionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationAllConnectionPost>
     */
    public function list(string $id, ListOrganizationAllConnectionsRequestParameters $request = new ListOrganizationAllConnectionsRequestParameters(), ?array $options = null): Pager;

    /**
     * Example:
     * ```php
     * $client->organizations->connections->create(
     *     'id',
     *     new CreateOrganizationAllConnectionRequestParameters([
     *         'connectionId' => 'connection_id',
     *     ]),
     * );
     * ```
     *
     * @param string $id Organization identifier.
     * @param CreateOrganizationAllConnectionRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateOrganizationAllConnectionResponseContent
     */
    public function create(string $id, CreateOrganizationAllConnectionRequestParameters $request, ?array $options = null): ?CreateOrganizationAllConnectionResponseContent;

    /**
     * Example:
     * ```php
     * $client->organizations->connections->get(
     *     'id',
     *     'connection_id',
     * );
     * ```
     *
     * @param string $id Organization identifier.
     * @param string $connectionId Connection identifier.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationAllConnectionResponseContent
     */
    public function get(string $id, string $connectionId, ?array $options = null): ?GetOrganizationAllConnectionResponseContent;

    /**
     * Example:
     * ```php
     * $client->organizations->connections->delete(
     *     'id',
     *     'connection_id',
     * );
     * ```
     *
     * @param string $id Organization identifier.
     * @param string $connectionId Connection identifier.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $connectionId, ?array $options = null): void;

    /**
     * Example:
     * ```php
     * $client->organizations->connections->update(
     *     'id',
     *     'connection_id',
     *     new UpdateOrganizationConnectionRequestParameters([]),
     * );
     * ```
     *
     * @param string $id Organization identifier.
     * @param string $connectionId Connection identifier.
     * @param UpdateOrganizationConnectionRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateOrganizationAllConnectionResponseContent
     */
    public function update(string $id, string $connectionId, UpdateOrganizationConnectionRequestParameters $request = new UpdateOrganizationConnectionRequestParameters(), ?array $options = null): ?UpdateOrganizationAllConnectionResponseContent;
}
