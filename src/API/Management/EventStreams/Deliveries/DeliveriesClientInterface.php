<?php

namespace Auth0\SDK\API\Management\EventStreams\Deliveries;

use Auth0\SDK\API\Management\EventStreams\Deliveries\Requests\ListEventStreamDeliveriesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\EventStreamDelivery;
use Auth0\SDK\API\Management\Types\GetEventStreamDeliveryHistoryResponseContent;

interface DeliveriesClientInterface
{
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
    public function list(string $id, ListEventStreamDeliveriesRequestParameters $request = new ListEventStreamDeliveriesRequestParameters(), ?array $options = null): Pager;

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
     */
    public function getHistory(string $id, string $eventId, ?array $options = null): ?GetEventStreamDeliveryHistoryResponseContent;
}
