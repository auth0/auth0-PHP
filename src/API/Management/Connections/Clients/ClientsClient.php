<?php

namespace Auth0\SDK\API\Management\Connections\Clients;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Connections\Clients\Requests\GetConnectionEnabledClientsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ConnectionEnabledClient;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\GetConnectionEnabledClientsResponseContent;
use Auth0\SDK\API\Management\Types\UpdateEnabledClientConnectionsRequestContentItem;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Auth0\SDK\API\Management\Core\Json\JsonSerializer;
use Psr\Http\Client\ClientExceptionInterface;
use JsonException;

class ClientsClient implements ClientsClientInterface
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
     * Retrieve all clients that have the specified <a href="https://auth0.com/docs/authenticate/identity-providers">connection</a> enabled.
     *
     * <b>Note</b>: The first time you call this endpoint, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no further results are remaining.
     *
     * @param string $id The id of the connection for which enabled clients are to be retrieved
     * @param GetConnectionEnabledClientsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ConnectionEnabledClient>
     */
    public function get(string $id, GetConnectionEnabledClientsRequestParameters $request = new GetConnectionEnabledClientsRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (GetConnectionEnabledClientsRequestParameters $request) => $this->_get($id, $request, $options),
            setCursor: function (GetConnectionEnabledClientsRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?GetConnectionEnabledClientsResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?GetConnectionEnabledClientsResponseContent $response) => $response?->getClients() ?? [],
        );
    }

    /**
     * @param string $id The id of the connection to modify
     * @param array<UpdateEnabledClientConnectionsRequestContentItem> $request
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
    public function update(string $id, array $request, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}/clients",
                    method: HttpMethod::PATCH,
                    body: JsonSerializer::serializeArray($request, [UpdateEnabledClientConnectionsRequestContentItem::class]),
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
     * Retrieve all clients that have the specified <a href="https://auth0.com/docs/authenticate/identity-providers">connection</a> enabled.
     *
     * <b>Note</b>: The first time you call this endpoint, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no further results are remaining.
     *
     * @param string $id The id of the connection for which enabled clients are to be retrieved
     * @param GetConnectionEnabledClientsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetConnectionEnabledClientsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _get(string $id, GetConnectionEnabledClientsRequestParameters $request = new GetConnectionEnabledClientsRequestParameters(), ?array $options = null): ?GetConnectionEnabledClientsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}/clients",
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
                return GetConnectionEnabledClientsResponseContent::fromJson($json);
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
