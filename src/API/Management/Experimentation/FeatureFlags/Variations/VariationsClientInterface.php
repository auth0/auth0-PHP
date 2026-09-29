<?php

namespace Auth0\SDK\API\Management\Experimentation\FeatureFlags\Variations;

use Auth0\SDK\API\Management\Types\ListVariationsResponseContent;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Variations\Requests\CreateVariationRequestContent;
use Auth0\SDK\API\Management\Types\CreateVariationResponseContent;
use Auth0\SDK\API\Management\Types\GetVariationResponseContent;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Variations\Requests\UpdateVariationRequestContent;
use Auth0\SDK\API\Management\Types\UpdateVariationResponseContent;

interface VariationsClientInterface
{
    /**
     * Retrieve all variations defined for a specific feature flag.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->variations->list(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the parent feature flag.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListVariationsResponseContent
     */
    public function list(string $id, ?array $options = null): ?ListVariationsResponseContent;

    /**
     * Create a new variation with parameter overrides for a specific feature flag.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->variations->create(
     *     'id',
     *     new CreateVariationRequestContent([
     *         'name' => 'name',
     *         'overrides' => [
     *             'key' => "value",
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the parent feature flag.
     * @param CreateVariationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateVariationResponseContent
     */
    public function create(string $id, CreateVariationRequestContent $request, ?array $options = null): ?CreateVariationResponseContent;

    /**
     * Retrieve a single variation by its ID.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->variations->get(
     *     'id',
     *     'vid',
     * );
     * ```
     *
     * @param string $id The ID of the parent feature flag.
     * @param string $vid The ID of the variation to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetVariationResponseContent
     */
    public function get(string $id, string $vid, ?array $options = null): ?GetVariationResponseContent;

    /**
     * Delete a variation by ID. Returns 204 if the variation does not exist. Returns 404 if the parent feature flag does not exist.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->variations->delete(
     *     'id',
     *     'vid',
     * );
     * ```
     *
     * @param string $id The ID of the parent feature flag.
     * @param string $vid The ID of the variation to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $vid, ?array $options = null): void;

    /**
     * Partially update a variation by ID. Only provided fields are updated.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->variations->update(
     *     'id',
     *     'vid',
     *     new UpdateVariationRequestContent([]),
     * );
     * ```
     *
     * @param string $id The ID of the parent feature flag.
     * @param string $vid The ID of the variation to update.
     * @param UpdateVariationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateVariationResponseContent
     */
    public function update(string $id, string $vid, UpdateVariationRequestContent $request = new UpdateVariationRequestContent(), ?array $options = null): ?UpdateVariationResponseContent;
}
