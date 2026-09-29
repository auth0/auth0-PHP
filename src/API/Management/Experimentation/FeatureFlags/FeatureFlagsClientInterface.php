<?php

namespace Auth0\SDK\API\Management\Experimentation\FeatureFlags;

use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests\ListFeatureFlagsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\FeatureFlag;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests\CreateFeatureFlagRequestContent;
use Auth0\SDK\API\Management\Types\CreateFeatureFlagResponseContent;
use Auth0\SDK\API\Management\Types\GetFeatureFlagResponseContent;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests\UpdateFeatureFlagRequestContent;
use Auth0\SDK\API\Management\Types\UpdateFeatureFlagResponseContent;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests\UpdateFeatureFlagStatusRequestContent;
use Auth0\SDK\API\Management\Types\UpdateFeatureFlagStatusResponseContent;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Variations\VariationsClientInterface;

interface FeatureFlagsClientInterface
{
    /**
     * Retrieve a paginated list of feature flags for the tenant.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->list(
     *     new ListFeatureFlagsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *         'type' => FeatureFlagTypeEnum::Auth0->value,
     *         'status' => FeatureFlagStatusEnum::Draft->value,
     *     ]),
     * );
     * ```
     *
     * @param ListFeatureFlagsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<FeatureFlag>
     */
    public function list(ListFeatureFlagsRequestParameters $request = new ListFeatureFlagsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new feature flag with parameters for use in experiments.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->create(
     *     new CreateFeatureFlagRequestContent([
     *         'name' => 'name',
     *         'parameters' => [],
     *     ]),
     * );
     * ```
     *
     * @param CreateFeatureFlagRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateFeatureFlagResponseContent
     */
    public function create(CreateFeatureFlagRequestContent $request, ?array $options = null): ?CreateFeatureFlagResponseContent;

    /**
     * Retrieve a single feature flag by its ID.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the feature flag to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetFeatureFlagResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetFeatureFlagResponseContent;

    /**
     * Delete a feature flag by ID. Idempotent: returns 204 even if flag does not exist.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the feature flag to delete.
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
     * Partially update a feature flag by ID. Only provided fields are updated.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->update(
     *     'id',
     *     new UpdateFeatureFlagRequestContent([]),
     * );
     * ```
     *
     * @param string $id The ID of the feature flag to update.
     * @param UpdateFeatureFlagRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateFeatureFlagResponseContent
     */
    public function update(string $id, UpdateFeatureFlagRequestContent $request = new UpdateFeatureFlagRequestContent(), ?array $options = null): ?UpdateFeatureFlagResponseContent;

    /**
     * Transitions a feature flag through its lifecycle states: draft → active, draft → archived, active → archived.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->updateStatus(
     *     'id',
     *     new UpdateFeatureFlagStatusRequestContent([
     *         'status' => FeatureFlagStatusEnum::Draft->value,
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the feature flag to transition.
     * @param UpdateFeatureFlagStatusRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateFeatureFlagStatusResponseContent
     */
    public function updateStatus(string $id, UpdateFeatureFlagStatusRequestContent $request, ?array $options = null): ?UpdateFeatureFlagStatusResponseContent;

    /**
     * @return VariationsClientInterface
     */
    public function getVariations(): VariationsClientInterface;
}
