<?php

namespace Auth0\SDK\API\Management\ResourceServers;

use Auth0\SDK\API\Management\ResourceServers\Requests\ListResourceServerRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ResourceServer;
use Auth0\SDK\API\Management\ResourceServers\Requests\CreateResourceServerRequestContent;
use Auth0\SDK\API\Management\Types\CreateResourceServerResponseContent;
use Auth0\SDK\API\Management\ResourceServers\Requests\SearchResourceServersRequestParameters;
use Auth0\SDK\API\Management\Types\ResourceServerSearchResponse;
use Auth0\SDK\API\Management\ResourceServers\Requests\GetResourceServerRequestParameters;
use Auth0\SDK\API\Management\Types\GetResourceServerResponseContent;
use Auth0\SDK\API\Management\ResourceServers\Requests\UpdateResourceServerRequestContent;
use Auth0\SDK\API\Management\Types\UpdateResourceServerResponseContent;

interface ResourceServersClientInterface
{
    /**
     * Retrieve details of all APIs associated with your tenant.
     *
     * Example:
     * ```php
     * $client->resourceServers->list(
     *     new ListResourceServerRequestParameters([
     *         'identifiers' => [
     *             'identifiers',
     *         ],
     *         'page' => 1,
     *         'perPage' => 1,
     *         'includeTotals' => true,
     *         'includeFields' => true,
     *     ]),
     * );
     * ```
     *
     * @param ListResourceServerRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ResourceServer>
     */
    public function list(ListResourceServerRequestParameters $request = new ListResourceServerRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new API associated with your tenant. Note that all new APIs must be registered with Auth0. For more information, read <a href="https://www.auth0.com/docs/get-started/apis"> APIs</a>.
     *
     * Example:
     * ```php
     * $client->resourceServers->create(
     *     new CreateResourceServerRequestContent([
     *         'identifier' => 'identifier',
     *     ]),
     * );
     * ```
     *
     * @param CreateResourceServerRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateResourceServerResponseContent
     */
    public function create(CreateResourceServerRequestContent $request, ?array $options = null): ?CreateResourceServerResponseContent;

    /**
     * Search resource servers using SCIM or Lucene filter syntax with low-latency, eventually consistent results. Use the parser parameter to specify "scim" or "lucene" syntax (default: "lucene"). This endpoint provides an alternative to the standard GET /resource-servers endpoint with better performance for complex queries.
     * Results may not reflect recent updates immediately.
     *
     * The `signing_secret` field is not supported by this endpoint.
     *
     * Example:
     * ```php
     * $client->resourceServers->search(
     *     new SearchResourceServersRequestParameters([
     *         'q' => 'q',
     *         'parser' => SearchParserEnum::Scim->value,
     *         'fields' => 'fields',
     *         'includeFields' => true,
     *         'take' => 1,
     *         'from' => 'from',
     *         'sort' => ResourceServerSortFieldEnum::Identifier->value,
     *     ]),
     * );
     * ```
     *
     * @param SearchResourceServersRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ResourceServerSearchResponse>
     */
    public function search(SearchResourceServersRequestParameters $request = new SearchResourceServersRequestParameters(), ?array $options = null): Pager;

    /**
     * Retrieve <a href="https://auth0.com/docs/apis">API</a> details with the given ID.
     *
     * Example:
     * ```php
     * $client->resourceServers->get(
     *     'id',
     *     new GetResourceServerRequestParameters([
     *         'includeFields' => true,
     *     ]),
     * );
     * ```
     *
     * @param string $id ID or audience of the resource server to retrieve.
     * @param GetResourceServerRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetResourceServerResponseContent
     */
    public function get(string $id, GetResourceServerRequestParameters $request = new GetResourceServerRequestParameters(), ?array $options = null): ?GetResourceServerResponseContent;

    /**
     * Delete an existing API by ID. For more information, read <a href="https://www.auth0.com/docs/get-started/apis/api-settings">API Settings</a>.
     *
     * Example:
     * ```php
     * $client->resourceServers->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID or the audience of the resource server to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;

    /**
     * Change an existing API setting by resource server ID. For more information, read <a href="https://www.auth0.com/docs/get-started/apis/api-settings">API Settings</a>.
     *
     * Example:
     * ```php
     * $client->resourceServers->update(
     *     'id',
     *     new UpdateResourceServerRequestContent([]),
     * );
     * ```
     *
     * @param string $id ID or audience of the resource server to update.
     * @param UpdateResourceServerRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateResourceServerResponseContent
     */
    public function update(string $id, UpdateResourceServerRequestContent $request = new UpdateResourceServerRequestContent(), ?array $options = null): ?UpdateResourceServerResponseContent;
}
