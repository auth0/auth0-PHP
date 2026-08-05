<?php

namespace Auth0\SDK\API\Management\Connections\ScimConfiguration\Tokens;

use Auth0\SDK\API\Management\Types\ScimTokenItem;
use Auth0\SDK\API\Management\Connections\ScimConfiguration\Tokens\Requests\CreateScimTokenRequestContent;
use Auth0\SDK\API\Management\Types\CreateScimTokenResponseContent;

interface TokensClientInterface
{
    /**
     * Retrieves all scim tokens by its connection `id`.
     *
     * Example:
     * ```php
     * $client->connections->scimConfiguration->tokens->get(
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
     * @return ?array<ScimTokenItem>
     */
    public function get(string $id, ?array $options = null): ?array;

    /**
     * Create a scim token for a scim client.
     *
     * Example:
     * ```php
     * $client->connections->scimConfiguration->tokens->create(
     *     'id',
     *     new CreateScimTokenRequestContent([]),
     * );
     * ```
     *
     * @param string $id The id of the connection to create its SCIM token
     * @param CreateScimTokenRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateScimTokenResponseContent
     */
    public function create(string $id, CreateScimTokenRequestContent $request = new CreateScimTokenRequestContent(), ?array $options = null): ?CreateScimTokenResponseContent;

    /**
     * Deletes a scim token by its connection `id` and `tokenId`.
     *
     * Example:
     * ```php
     * $client->connections->scimConfiguration->tokens->delete(
     *     'id',
     *     'tokenId',
     * );
     * ```
     *
     * @param string $id The connection id that owns the SCIM token to delete
     * @param string $tokenId The id of the scim token to delete
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $tokenId, ?array $options = null): void;
}
