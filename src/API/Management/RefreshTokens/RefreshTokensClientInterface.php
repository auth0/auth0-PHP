<?php

namespace Auth0\SDK\API\Management\RefreshTokens;

use Auth0\SDK\API\Management\RefreshTokens\Requests\GetRefreshTokensRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\RefreshTokenResponseContent;
use Auth0\SDK\API\Management\RefreshTokens\Requests\RevokeRefreshTokensRequestContent;
use Auth0\SDK\API\Management\Types\GetRefreshTokenResponseContent;
use Auth0\SDK\API\Management\RefreshTokens\Requests\UpdateRefreshTokenRequestContent;
use Auth0\SDK\API\Management\Types\UpdateRefreshTokenResponseContent;

interface RefreshTokensClientInterface
{
    /**
     * Retrieve a paginated list of refresh tokens for a specific user, with optional filtering by client ID. Results are sorted by credential_id ascending.
     *
     * @param GetRefreshTokensRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<RefreshTokenResponseContent>
     */
    public function list(GetRefreshTokensRequestParameters $request, ?array $options = null): Pager;

    /**
     * Revoke refresh tokens in bulk by ID list, user, user+client, or client.
     *
     * @param RevokeRefreshTokensRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function revoke(RevokeRefreshTokensRequestContent $request = new RevokeRefreshTokensRequestContent(), ?array $options = null): void;

    /**
     * Retrieve refresh token information.
     *
     * @param string $id ID refresh token to retrieve
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetRefreshTokenResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetRefreshTokenResponseContent;

    /**
     * Delete a refresh token by its ID.
     *
     * @param string $id ID of the refresh token to delete.
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
     * Update a refresh token by its ID.
     *
     * @param string $id ID of the refresh token to update.
     * @param UpdateRefreshTokenRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateRefreshTokenResponseContent
     */
    public function update(string $id, UpdateRefreshTokenRequestContent $request = new UpdateRefreshTokenRequestContent(), ?array $options = null): ?UpdateRefreshTokenResponseContent;
}
