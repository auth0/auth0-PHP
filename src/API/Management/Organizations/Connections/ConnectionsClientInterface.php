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
