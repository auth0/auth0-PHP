<?php

namespace Auth0\SDK\API\Management\EventStreams\Redeliveries;

use Auth0\SDK\API\Management\EventStreams\Redeliveries\Requests\CreateEventStreamRedeliveryRequestContent;
use Auth0\SDK\API\Management\Types\CreateEventStreamRedeliveryResponseContent;

interface RedeliveriesClientInterface
{
    /**
     * @param string $id Unique identifier for the event stream.
     * @param CreateEventStreamRedeliveryRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateEventStreamRedeliveryResponseContent
     */
    public function create(string $id, CreateEventStreamRedeliveryRequestContent $request = new CreateEventStreamRedeliveryRequestContent(), ?array $options = null): ?CreateEventStreamRedeliveryResponseContent;

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
     */
    public function createById(string $id, string $eventId, ?array $options = null): void;
}
