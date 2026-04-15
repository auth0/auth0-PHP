<?php

namespace Auth0\SDK\API\Management\Clients\Connections;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Clients\Connections\Requests\ConnectionsGetRequest;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ConnectionForList;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListClientConnectionsResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class ConnectionsClient implements ConnectionsClientInterface
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
     * Retrieve all connections that are enabled for the specified <a href="https://www.auth0.com/docs/get-started/applications"> Application</a>, using checkpoint pagination. A list of fields to include or exclude for each connection may also be specified.
     * <ul>
     *   <li>
     *     This endpoint requires the <code>read:connections</code> scope and any one of <code>read:clients</code> or <code>read:client_summary</code>.
     *   </li>
     *   <li>
     *     <b>Note</b>: The first time you call this endpoint, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no further results are remaining.
     *   </li>
     * </ul>
     *
     * @param string $id ID of the client for which to retrieve enabled connections.
     * @param ConnectionsGetRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ConnectionForList>
     */
    public function get(string $id, ConnectionsGetRequest $request = new ConnectionsGetRequest(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ConnectionsGetRequest $request) => $this->_get($id, $request, $options),
            setCursor: function (ConnectionsGetRequest $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListClientConnectionsResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListClientConnectionsResponseContent $response) => $response?->getConnections() ?? [],
        );
    }

    /**
     * Retrieve all connections that are enabled for the specified <a href="https://www.auth0.com/docs/get-started/applications"> Application</a>, using checkpoint pagination. A list of fields to include or exclude for each connection may also be specified.
     * <ul>
     *   <li>
     *     This endpoint requires the <code>read:connections</code> scope and any one of <code>read:clients</code> or <code>read:client_summary</code>.
     *   </li>
     *   <li>
     *     <b>Note</b>: The first time you call this endpoint, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no further results are remaining.
     *   </li>
     * </ul>
     *
     * @param string $id ID of the client for which to retrieve enabled connections.
     * @param ConnectionsGetRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListClientConnectionsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _get(string $id, ConnectionsGetRequest $request = new ConnectionsGetRequest(), ?array $options = null): ?ListClientConnectionsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getStrategy() != null) {
            $query['strategy'] = $request->getStrategy();
        }
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "clients/{$id}/connections",
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
                return ListClientConnectionsResponseContent::fromJson($json);
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
