<?php

namespace Auth0\SDK\API\Management\EventStreams;

use Auth0\SDK\API\Management\EventStreams\Requests\ListEventStreamsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\EventStreamWebhookResponseContent;
use Auth0\SDK\API\Management\Types\EventStreamEventBridgeResponseContent;
use Auth0\SDK\API\Management\Types\EventStreamActionResponseContent;
use Auth0\SDK\API\Management\Types\CreateEventStreamWebHookRequestContent;
use Auth0\SDK\API\Management\Types\CreateEventStreamEventBridgeRequestContent;
use Auth0\SDK\API\Management\Types\CreateEventStreamActionRequestContent;
use Auth0\SDK\API\Management\EventStreams\Requests\UpdateEventStreamRequestContent;
use Auth0\SDK\API\Management\EventStreams\Requests\CreateEventStreamTestEventRequestContent;
use Auth0\SDK\API\Management\Types\CreateEventStreamTestEventResponseContent;
use Auth0\SDK\API\Management\EventStreams\Deliveries\DeliveriesClientInterface;
use Auth0\SDK\API\Management\EventStreams\Redeliveries\RedeliveriesClientInterface;

interface EventStreamsClientInterface
{
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
    public function list(ListEventStreamsRequestParameters $request = new ListEventStreamsRequestParameters(), ?array $options = null): Pager;

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
     */
    public function create(CreateEventStreamWebHookRequestContent|CreateEventStreamEventBridgeRequestContent|CreateEventStreamActionRequestContent $request, ?array $options = null): EventStreamWebhookResponseContent|EventStreamEventBridgeResponseContent|EventStreamActionResponseContent|null;

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
     */
    public function get(string $id, ?array $options = null): EventStreamWebhookResponseContent|EventStreamEventBridgeResponseContent|EventStreamActionResponseContent|null;

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
     */
    public function delete(string $id, ?array $options = null): void;

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
     */
    public function update(string $id, UpdateEventStreamRequestContent $request = new UpdateEventStreamRequestContent(), ?array $options = null): EventStreamWebhookResponseContent|EventStreamEventBridgeResponseContent|EventStreamActionResponseContent|null;

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
     */
    public function test(string $id, CreateEventStreamTestEventRequestContent $request, ?array $options = null): ?CreateEventStreamTestEventResponseContent;

    /**
     * @return DeliveriesClientInterface
     */
    public function getDeliveries(): DeliveriesClientInterface;

    /**
     * @return RedeliveriesClientInterface
     */
    public function getRedeliveries(): RedeliveriesClientInterface;
}
