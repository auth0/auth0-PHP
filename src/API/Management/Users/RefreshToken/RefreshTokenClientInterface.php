<?php

namespace Auth0\SDK\API\Management\Users\RefreshToken;

use Auth0\SDK\API\Management\Users\RefreshToken\Requests\ListRefreshTokensRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\RefreshTokenResponseContent;

interface RefreshTokenClientInterface
{
    /**
     * Retrieve details for a user's refresh tokens.
     *
     * @param string $userId ID of the user to get refresh tokens for
     * @param ListRefreshTokensRequestParameters $request
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
    public function list(string $userId, ListRefreshTokensRequestParameters $request = new ListRefreshTokensRequestParameters(), ?array $options = null): Pager;

    /**
     * Delete all refresh tokens for a user.
     *
     * @param string $userId ID of the user to get remove refresh tokens for
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $userId, ?array $options = null): void;
}
