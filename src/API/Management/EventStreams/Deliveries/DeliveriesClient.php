<?php

namespace Auth0\SDK\API\Management\EventStreams\Deliveries;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\EventStreams\Deliveries\Requests\ListEventStreamDeliveriesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\EventStreamDelivery;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListEventStreamDeliveriesResponseContent;
use Auth0\SDK\API\Management\Types\GetEventStreamDeliveryHistoryResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class DeliveriesClient implements DeliveriesClientInterface
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
     * Example:
     * ```php
     * $client->eventStreams->deliveries->list(
     *     'id',
     *     new ListEventStreamDeliveriesRequestParameters([
     *         'statuses' => 'statuses',
     *         'eventTypes' => 'event_types',
     *         'dateFrom' => 'date_from',
     *         'dateTo' => 'date_to',
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param string $id Unique identifier for the event stream.
     * @param ListEventStreamDeliveriesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<EventStreamDelivery>
     */
    public function list(string $id, ListEventStreamDeliveriesRequestParameters $request = new ListEventStreamDeliveriesRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListEventStreamDeliveriesRequestParameters $request) => $this->_list($id, $request, $options),
            setCursor: function (ListEventStreamDeliveriesRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListEventStreamDeliveriesResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListEventStreamDeliveriesResponseContent $response) => $response?->getDeliveries() ?? [],
        );
    }

    /**
     * Example:
     * ```php
     * $client->eventStreams->deliveries->getHistory(
     *     'id',
     *     'event_id',
     * );
     * ```
     *
     * @param string $id Unique identifier for the event stream.
     * @param string $eventId Unique identifier for the event
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetEventStreamDeliveryHistoryResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function getHistory(string $id, string $eventId, ?array $options = null): ?GetEventStreamDeliveryHistoryResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "event-streams/" . RawClient::encodePathParam($id) . "/deliveries/" . RawClient::encodePathParam($eventId),
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
                return GetEventStreamDeliveryHistoryResponseContent::fromJson($json);
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
     * @param ListEventStreamDeliveriesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListEventStreamDeliveriesResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(string $id, ListEventStreamDeliveriesRequestParameters $request = new ListEventStreamDeliveriesRequestParameters(), ?array $options = null): ?ListEventStreamDeliveriesResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getStatuses() != null) {
            $query['statuses'] = $request->getStatuses();
        }
        if ($request->getEventTypes() != null) {
            $query['event_types'] = $request->getEventTypes();
        }
        if ($request->getDateFrom() != null) {
            $query['date_from'] = $request->getDateFrom();
        }
        if ($request->getDateTo() != null) {
            $query['date_to'] = $request->getDateTo();
        }
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
                    path: "event-streams/" . RawClient::encodePathParam($id) . "/deliveries",
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
                return ListEventStreamDeliveriesResponseContent::fromJson($json);
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
