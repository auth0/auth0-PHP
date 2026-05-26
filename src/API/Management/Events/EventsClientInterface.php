<?php

namespace Auth0\SDK\API\Management\Events;

use Auth0\SDK\API\Management\Events\Requests\SubscribeEventsRequestParameters;
use Auth0\SDK\API\Management\Core\Client\SseStream;
use Auth0\SDK\API\Management\Types\EventStreamSubscribeEventsResponseContent;

interface EventsClientInterface
{
    /**
     * Subscribe to events via Server-Sent Events (SSE)
     *
     * @param SubscribeEventsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return SseStream<EventStreamSubscribeEventsResponseContent>
     */
    public function subscribe(SubscribeEventsRequestParameters $request = new SubscribeEventsRequestParameters(), ?array $options = null): SseStream;
}
