<?php

namespace Auth0\SDK\API\Management\Users\Sessions;

use Auth0\SDK\API\Management\Users\Sessions\Requests\ListUserSessionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\SessionResponseContent;

interface SessionsClientInterface
{
    /**
     * Retrieve details for a user's sessions.
     *
     * @param string $userId ID of the user to get sessions for
     * @param ListUserSessionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<SessionResponseContent>
     */
    public function list(string $userId, ListUserSessionsRequestParameters $request = new ListUserSessionsRequestParameters(), ?array $options = null): Pager;

    /**
     * Delete all sessions for a user.
     *
     * @param string $userId ID of the user to get sessions for
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
