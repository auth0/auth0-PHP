<?php

namespace Auth0\SDK\API\Management\ResourceServers;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\ResourceServers\Requests\ListResourceServerRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ResourceServer;
use Auth0\SDK\API\Management\Core\Pagination\OffsetPager;
use Auth0\SDK\API\Management\Types\ListResourceServerOffsetPaginatedResponseContent;
use Auth0\SDK\API\Management\ResourceServers\Requests\CreateResourceServerRequestContent;
use Auth0\SDK\API\Management\Types\CreateResourceServerResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\ResourceServers\Requests\SearchResourceServersRequestParameters;
use Auth0\SDK\API\Management\Types\ResourceServerSearchResponse;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\SearchResourceServersResponseContent;
use Auth0\SDK\API\Management\ResourceServers\Requests\GetResourceServerRequestParameters;
use Auth0\SDK\API\Management\Types\GetResourceServerResponseContent;
use Auth0\SDK\API\Management\ResourceServers\Requests\UpdateResourceServerRequestContent;
use Auth0\SDK\API\Management\Types\UpdateResourceServerResponseContent;

class ResourceServersClient implements ResourceServersClientInterface
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

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
    public function list(ListResourceServerRequestParameters $request = new ListResourceServerRequestParameters(), ?array $options = null): Pager
    {
        return new OffsetPager(
            request: $request,
            getNextPage: fn (ListResourceServerRequestParameters $request) => $this->_list($request, $options),
            /* @phpstan-ignore-next-line */
            getOffset: fn (ListResourceServerRequestParameters $request) => $request?->getPage() ?? 0,
            setOffset: function (ListResourceServerRequestParameters $request, int $offset) {
                $request->setPage($offset);
            },
            getStep: null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListResourceServerOffsetPaginatedResponseContent $response) => $response?->getResourceServers() ?? [],
            /* @phpstan-ignore-next-line */
            hasNextPage: null,
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateResourceServerRequestContent $request, ?array $options = null): ?CreateResourceServerResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "resource-servers",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return CreateResourceServerResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
    public function search(SearchResourceServersRequestParameters $request = new SearchResourceServersRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (SearchResourceServersRequestParameters $request) => $this->_search($request, $options),
            setCursor: function (SearchResourceServersRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?SearchResourceServersResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?SearchResourceServersResponseContent $response) => $response?->getResourceServers() ?? [],
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, GetResourceServerRequestParameters $request = new GetResourceServerRequestParameters(), ?array $options = null): ?GetResourceServerResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "resource-servers/" . RawClient::encodePathParam($id),
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetResourceServerResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function delete(string $id, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "resource-servers/" . RawClient::encodePathParam($id),
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateResourceServerRequestContent $request = new UpdateResourceServerRequestContent(), ?array $options = null): ?UpdateResourceServerResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "resource-servers/" . RawClient::encodePathParam($id),
                    method: HttpMethod::PATCH,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return UpdateResourceServerResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Retrieve details of all APIs associated with your tenant.
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
     * @return ?ListResourceServerOffsetPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListResourceServerRequestParameters $request = new ListResourceServerRequestParameters(), ?array $options = null): ?ListResourceServerOffsetPaginatedResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getIdentifiers() != null) {
            $query['identifiers'] = $request->getIdentifiers();
        }
        if ($request->getPage() != null) {
            $query['page'] = $request->getPage();
        }
        if ($request->getPerPage() != null) {
            $query['per_page'] = $request->getPerPage();
        }
        if ($request->getIncludeTotals() != null) {
            $query['include_totals'] = $request->getIncludeTotals();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "resource-servers",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListResourceServerOffsetPaginatedResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Search resource servers using SCIM or Lucene filter syntax with low-latency, eventually consistent results. Use the parser parameter to specify "scim" or "lucene" syntax (default: "lucene"). This endpoint provides an alternative to the standard GET /resource-servers endpoint with better performance for complex queries.
     * Results may not reflect recent updates immediately.
     *
     * The `signing_secret` field is not supported by this endpoint.
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
     * @return ?SearchResourceServersResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _search(SearchResourceServersRequestParameters $request = new SearchResourceServersRequestParameters(), ?array $options = null): ?SearchResourceServersResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getQ() != null) {
            $query['q'] = $request->getQ();
        }
        if ($request->getParser() != null) {
            $query['parser'] = $request->getParser();
        }
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getSort() != null) {
            $query['sort'] = $request->getSort();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "resource-servers/search",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return SearchResourceServersResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
