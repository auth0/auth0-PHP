<?php

namespace Auth0\SDK\API\Management\Sessions;

use Auth0\SDK\API\Management\Types\GetSessionResponseContent;
use Auth0\SDK\API\Management\Sessions\Requests\UpdateSessionRequestContent;
use Auth0\SDK\API\Management\Types\UpdateSessionResponseContent;

interface SessionsClientInterface
{
    /**
     * Retrieve session information.
     *
     * Example:
     * ```php
     * $client->sessions->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of session to retrieve
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetSessionResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetSessionResponseContent;

    /**
     * Delete a session by ID.
     *
     * Example:
     * ```php
     * $client->sessions->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the session to delete.
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
     * Update session information.
     *
     * Example:
     * ```php
     * $client->sessions->update(
     *     'id',
     *     new UpdateSessionRequestContent([]),
     * );
     * ```
     *
     * @param string $id ID of the session to update.
     * @param UpdateSessionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateSessionResponseContent
     */
    public function update(string $id, UpdateSessionRequestContent $request = new UpdateSessionRequestContent(), ?array $options = null): ?UpdateSessionResponseContent;

    /**
     * Revokes a session by ID and all associated refresh tokens.
     *
     * Example:
     * ```php
     * $client->sessions->revoke(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the session to revoke.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function revoke(string $id, ?array $options = null): void;
}
