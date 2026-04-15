<?php

namespace Auth0\SDK\API\Management\EventStreams;

use Auth0\SDK\API\Management\EventStreams\Deliveries\DeliveriesClient;
use Auth0\SDK\API\Management\EventStreams\Redeliveries\RedeliveriesClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\EventStreams\Requests\ListEventStreamsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\EventStreamWebhookResponseContent;
use Auth0\SDK\API\Management\Types\EventStreamEventBridgeResponseContent;
use Auth0\SDK\API\Management\Types\EventStreamActionResponseContent;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListEventStreamsResponseContent;
use Auth0\SDK\API\Management\Types\CreateEventStreamWebHookRequestContent;
use Auth0\SDK\API\Management\Types\CreateEventStreamEventBridgeRequestContent;
use Auth0\SDK\API\Management\Types\CreateEventStreamActionRequestContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Auth0\SDK\API\Management\Core\Json\JsonSerializer;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\EventStreams\Requests\UpdateEventStreamRequestContent;
use Auth0\SDK\API\Management\EventStreams\Requests\CreateEventStreamTestEventRequestContent;
use Auth0\SDK\API\Management\Types\CreateEventStreamTestEventResponseContent;
use Auth0\SDK\API\Management\EventStreams\Deliveries\DeliveriesClientInterface;
use Auth0\SDK\API\Management\EventStreams\Redeliveries\RedeliveriesClientInterface;

class EventStreamsClient implements EventStreamsClientInterface
{
    /**
     * @var DeliveriesClient $deliveries
     */
    public DeliveriesClient $deliveries;

    /**
     * @var RedeliveriesClient $redeliveries
     */
    public RedeliveriesClient $redeliveries;

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
        $this->deliveries = new DeliveriesClient($this->client, $this->options);
        $this->redeliveries = new RedeliveriesClient($this->client, $this->options);
    }

    /**
     * @param ListEventStreamsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<(
     *    EventStreamWebhookResponseContent
     *   |EventStreamEventBridgeResponseContent
     *   |EventStreamActionResponseContent
     * )>
     */
    public function list(ListEventStreamsRequestParameters $request = new ListEventStreamsRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListEventStreamsRequestParameters $request) => $this->_list($request, $options),
            setCursor: function (ListEventStreamsRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListEventStreamsResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListEventStreamsResponseContent $response) => $response?->getEventStreams() ?? [],
        );
    }

    /**
     * @param (
     *    CreateEventStreamWebHookRequestContent
     *   |CreateEventStreamEventBridgeRequestContent
     *   |CreateEventStreamActionRequestContent
     * ) $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    EventStreamWebhookResponseContent
     *   |EventStreamEventBridgeResponseContent
     *   |EventStreamActionResponseContent
     * )|null
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateEventStreamWebHookRequestContent|CreateEventStreamEventBridgeRequestContent|CreateEventStreamActionRequestContent $request, ?array $options = null): EventStreamWebhookResponseContent|EventStreamEventBridgeResponseContent|EventStreamActionResponseContent|null
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "event-streams",
                    method: HttpMethod::POST,
                    body: JsonSerializer::serializeUnion($request, new Union(CreateEventStreamWebHookRequestContent::class, CreateEventStreamEventBridgeRequestContent::class, CreateEventStreamActionRequestContent::class)),
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return JsonDecoder::decodeUnion($json, new Union(EventStreamWebhookResponseContent::class, EventStreamEventBridgeResponseContent::class, EventStreamActionResponseContent::class)); // @phpstan-ignore-line
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
     * @param string $id Unique identifier for the event stream.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    EventStreamWebhookResponseContent
     *   |EventStreamEventBridgeResponseContent
     *   |EventStreamActionResponseContent
     * )|null
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): EventStreamWebhookResponseContent|EventStreamEventBridgeResponseContent|EventStreamActionResponseContent|null
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "event-streams/{$id}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return JsonDecoder::decodeUnion($json, new Union(EventStreamWebhookResponseContent::class, EventStreamEventBridgeResponseContent::class, EventStreamActionResponseContent::class)); // @phpstan-ignore-line
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
     * @param string $id Unique identifier for the event stream.
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
                    path: "event-streams/{$id}",
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
     * @param string $id Unique identifier for the event stream.
     * @param UpdateEventStreamRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    EventStreamWebhookResponseContent
     *   |EventStreamEventBridgeResponseContent
     *   |EventStreamActionResponseContent
     * )|null
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateEventStreamRequestContent $request = new UpdateEventStreamRequestContent(), ?array $options = null): EventStreamWebhookResponseContent|EventStreamEventBridgeResponseContent|EventStreamActionResponseContent|null
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "event-streams/{$id}",
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
                return JsonDecoder::decodeUnion($json, new Union(EventStreamWebhookResponseContent::class, EventStreamEventBridgeResponseContent::class, EventStreamActionResponseContent::class)); // @phpstan-ignore-line
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
     * @param string $id Unique identifier for the event stream.
     * @param CreateEventStreamTestEventRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateEventStreamTestEventResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function test(string $id, CreateEventStreamTestEventRequestContent $request, ?array $options = null): ?CreateEventStreamTestEventResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "event-streams/{$id}/test",
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
                return CreateEventStreamTestEventResponseContent::fromJson($json);
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
     * @return DeliveriesClientInterface
     */
    public function getDeliveries(): DeliveriesClientInterface
    {
        return $this->deliveries;
    }

    /**
     * @return RedeliveriesClientInterface
     */
    public function getRedeliveries(): RedeliveriesClientInterface
    {
        return $this->redeliveries;
    }

    /**
     * @param ListEventStreamsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListEventStreamsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListEventStreamsRequestParameters $request = new ListEventStreamsRequestParameters(), ?array $options = null): ?ListEventStreamsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "event-streams",
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
                return ListEventStreamsResponseContent::fromJson($json);
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
