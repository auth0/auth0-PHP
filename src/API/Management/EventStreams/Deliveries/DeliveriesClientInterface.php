<?php

namespace Auth0\SDK\API\Management\EventStreams\Deliveries;

use Auth0\SDK\API\Management\EventStreams\Deliveries\Requests\ListEventStreamDeliveriesRequestParameters;
use Auth0\SDK\API\Management\Types\EventStreamDelivery;
use Auth0\SDK\API\Management\Types\GetEventStreamDeliveryHistoryResponseContent;

interface DeliveriesClientInterface
{
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
     * @return ?array<EventStreamDelivery>
     */
    public function list(string $id, ListEventStreamDeliveriesRequestParameters $request = new ListEventStreamDeliveriesRequestParameters(), ?array $options = null): ?array;

    /**
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
