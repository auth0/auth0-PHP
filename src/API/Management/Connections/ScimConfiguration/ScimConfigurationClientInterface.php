<?php

namespace Auth0\SDK\API\Management\Connections\ScimConfiguration;

use Auth0\SDK\API\Management\Connections\ScimConfiguration\Requests\ListScimConfigurationsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ScimConfiguration;
use Auth0\SDK\API\Management\Types\GetScimConfigurationResponseContent;
use Auth0\SDK\API\Management\Types\CreateScimConfigurationRequestContent;
use Auth0\SDK\API\Management\Types\CreateScimConfigurationResponseContent;
use Auth0\SDK\API\Management\Connections\ScimConfiguration\Requests\UpdateScimConfigurationRequestContent;
use Auth0\SDK\API\Management\Types\UpdateScimConfigurationResponseContent;
use Auth0\SDK\API\Management\Types\GetScimConfigurationDefaultMappingResponseContent;
use Auth0\SDK\API\Management\Connections\ScimConfiguration\Tokens\TokensClientInterface;

interface ScimConfigurationClientInterface
{
    /**
     * Retrieve a list of SCIM configurations of a tenant.
     *
     * Example:
     * ```php
     * $client->connections->scimConfiguration->list(
     *     new ListScimConfigurationsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListScimConfigurationsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ScimConfiguration>
     */
    public function list(ListScimConfigurationsRequestParameters $request = new ListScimConfigurationsRequestParameters(), ?array $options = null): Pager;

    /**
     * Retrieves a scim configuration by its `connectionId`.
     *
     * Example:
     * ```php
     * $client->connections->scimConfiguration->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id The id of the connection to retrieve its SCIM configuration
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetScimConfigurationResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetScimConfigurationResponseContent;

    /**
     * Create a scim configuration for a connection.
     *
     * Example:
     * ```php
     * $client->connections->scimConfiguration->create(
     *     'id',
     *     new CreateScimConfigurationRequestContent([]),
     * );
     * ```
     *
     * @param string $id The id of the connection to create its SCIM configuration
     * @param ?CreateScimConfigurationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateScimConfigurationResponseContent
     */
    public function create(string $id, ?CreateScimConfigurationRequestContent $request = null, ?array $options = null): ?CreateScimConfigurationResponseContent;

    /**
     * Deletes a scim configuration by its `connectionId`.
     *
     * Example:
     * ```php
     * $client->connections->scimConfiguration->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id The id of the connection to delete its SCIM configuration
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
     * Update a scim configuration by its `connectionId`.
     *
     * Example:
     * ```php
     * $client->connections->scimConfiguration->update(
     *     'id',
     *     new UpdateScimConfigurationRequestContent([
     *         'userIdAttribute' => 'user_id_attribute',
     *         'mapping' => [
     *             new ScimMappingItem([]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id The id of the connection to update its SCIM configuration
     * @param UpdateScimConfigurationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateScimConfigurationResponseContent
     */
    public function update(string $id, UpdateScimConfigurationRequestContent $request, ?array $options = null): ?UpdateScimConfigurationResponseContent;

    /**
     * Retrieves a scim configuration's default mapping by its `connectionId`.
     *
     * Example:
     * ```php
     * $client->connections->scimConfiguration->getDefaultMapping(
     *     'id',
     * );
     * ```
     *
     * @param string $id The id of the connection to retrieve its default SCIM mapping
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetScimConfigurationDefaultMappingResponseContent
     */
    public function getDefaultMapping(string $id, ?array $options = null): ?GetScimConfigurationDefaultMappingResponseContent;

    /**
     * @return TokensClientInterface
     */
    public function getTokens(): TokensClientInterface;
}
