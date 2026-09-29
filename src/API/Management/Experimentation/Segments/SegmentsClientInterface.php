<?php

namespace Auth0\SDK\API\Management\Experimentation\Segments;

use Auth0\SDK\API\Management\Experimentation\Segments\Requests\ListSegmentsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Segment;
use Auth0\SDK\API\Management\Experimentation\Segments\Requests\CreateSegmentRequestContent;
use Auth0\SDK\API\Management\Types\CreateSegmentResponseContent;
use Auth0\SDK\API\Management\Types\GetSegmentResponseContent;
use Auth0\SDK\API\Management\Experimentation\Segments\Requests\UpdateSegmentRequestContent;
use Auth0\SDK\API\Management\Types\UpdateSegmentResponseContent;

interface SegmentsClientInterface
{
    /**
     * Retrieve a paginated list of segments for the tenant.
     *
     * Example:
     * ```php
     * $client->experimentation->segments->list(
     *     new ListSegmentsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *         'type' => SegmentTypeFilterEnum::Auth0->value,
     *     ]),
     * );
     * ```
     *
     * @param ListSegmentsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Segment>
     */
    public function list(ListSegmentsRequestParameters $request = new ListSegmentsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new segment with rule-based membership criteria for use in experiments.
     *
     * Example:
     * ```php
     * $client->experimentation->segments->create(
     *     new CreateSegmentRequestContent([
     *         'name' => 'name',
     *         'rules' => [
     *             new SegmentRule([]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param CreateSegmentRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateSegmentResponseContent
     */
    public function create(CreateSegmentRequestContent $request, ?array $options = null): ?CreateSegmentResponseContent;

    /**
     * Retrieve a single segment by its ID.
     *
     * Example:
     * ```php
     * $client->experimentation->segments->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the segment to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetSegmentResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetSegmentResponseContent;

    /**
     * Delete a segment by ID. Idempotent: returns 204 even if segment does not exist.
     *
     * Example:
     * ```php
     * $client->experimentation->segments->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the segment to delete.
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
     * Partially update a segment by ID. Only provided fields are updated. Sending rules replaces the entire rules array.
     *
     * Example:
     * ```php
     * $client->experimentation->segments->update(
     *     'id',
     *     new UpdateSegmentRequestContent([]),
     * );
     * ```
     *
     * @param string $id The ID of the segment to update.
     * @param UpdateSegmentRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateSegmentResponseContent
     */
    public function update(string $id, UpdateSegmentRequestContent $request = new UpdateSegmentRequestContent(), ?array $options = null): ?UpdateSegmentResponseContent;
}
