<?php

namespace Auth0\SDK\API\Management\ClientProfiles;

use Auth0\SDK\API\Management\ClientProfiles\Requests\ListClientProfilesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ClientProfile;
use Auth0\SDK\API\Management\ClientProfiles\Requests\CreateClientProfileRequestContent;
use Auth0\SDK\API\Management\ClientProfiles\Requests\UpdateClientProfileRequestContent;

interface ClientProfilesClientInterface
{
    /**
     * Retrieve a paginated list of client profiles for the tenant. Uses checkpoint pagination: pass the <code>next</code> cursor from a previous response as the <code>from</code> query parameter to retrieve the following page.
     *
     * Example:
     * ```php
     * $client->clientProfiles->list(
     *     new ListClientProfilesRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListClientProfilesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ClientProfile>
     */
    public function list(ListClientProfilesRequestParameters $request = new ListClientProfilesRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a client profile. At most one profile is allowed per tenant in this release; attempting to create a second returns <code>409 Conflict</code>. The profile governs Dynamic CIMD clients matched by its <code>apply_policy</code> at runtime.
     *
     * Example:
     * ```php
     * $client->clientProfiles->create(
     *     new CreateClientProfileRequestContent([
     *         'name' => 'name',
     *         'clientConfiguration' => new ClientProfileClientConfiguration([]),
     *         'applyPolicy' => new ClientProfileApplyPolicy([
     *             'externalMetadataType' => ClientProfileApplyPolicyExternalMetadataTypeEnum::Cimd->value,
     *             'externalMetadataCreatedBy' => ClientProfileApplyPolicyExternalMetadataCreatedByEnum::Client->value,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param CreateClientProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ClientProfile
     */
    public function create(CreateClientProfileRequestContent $request, ?array $options = null): ?ClientProfile;

    /**
     * Retrieve a single client profile by its identifier. Returns <code>404</code> if no profile with the given ID exists for the tenant.
     *
     * Example:
     * ```php
     * $client->clientProfiles->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the client profile.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ClientProfile
     */
    public function get(string $id, ?array $options = null): ?ClientProfile;

    /**
     * Delete a client profile. Idempotent: returns <code>204 No Content</code> whether or not a profile with the given ID existed. Deleting the profile removes fleet governance for matched clients immediately.
     *
     * Example:
     * ```php
     * $client->clientProfiles->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the client profile.
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
     * Update a client profile. Supports partial updates at the top level (JSON Merge Patch); omitted top-level fields remain unchanged. Nested objects such as <code>client_configuration</code> must be supplied in full.
     *
     * Example:
     * ```php
     * $client->clientProfiles->update(
     *     'id',
     *     new UpdateClientProfileRequestContent([]),
     * );
     * ```
     *
     * @param string $id ID of the client profile.
     * @param UpdateClientProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ClientProfile
     */
    public function update(string $id, UpdateClientProfileRequestContent $request = new UpdateClientProfileRequestContent(), ?array $options = null): ?ClientProfile;
}
