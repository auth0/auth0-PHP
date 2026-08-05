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
     * Example:
     * ```php
     * $client->eventStreams->list(
     *     new ListEventStreamsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
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
     * Example:
     * ```php
     * $client->eventStreams->create(
     *     new CreateEventStreamWebHookRequestContent([
     *         'destination' => new EventStreamWebhookDestination([
     *             'type' => EventStreamWebhookDestinationTypeEnum::Webhook->value,
     *             'configuration' => new EventStreamWebhookConfiguration([
     *                 'webhookEndpoint' => 'webhook_endpoint',
     *                 'webhookAuthorization' => new EventStreamWebhookBasicAuth([
     *                     'method' => EventStreamWebhookBasicAuthMethodEnum::Basic->value,
     *                     'username' => 'username',
     *                 ]),
     *             ]),
     *         ]),
     *     ]),
     * );
     * ```
     *
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
     * Example:
     * ```php
     * $client->eventStreams->get(
     *     'id',
     * );
     * ```
     *
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
     * Example:
     * ```php
     * $client->eventStreams->delete(
     *     'id',
     * );
     * ```
     *
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
     * Example:
     * ```php
     * $client->eventStreams->update(
     *     'id',
     *     new UpdateEventStreamRequestContent([]),
     * );
     * ```
     *
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
     * Example:
     * ```php
     * $client->eventStreams->test(
     *     'id',
     *     new CreateEventStreamTestEventRequestContent([
     *         'eventType' => EventStreamTestEventTypeEnum::ConnectionCreated->value,
     *     ]),
     * );
     * ```
     *
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
