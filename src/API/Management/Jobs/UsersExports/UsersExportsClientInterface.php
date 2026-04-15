<?php

namespace Auth0\SDK\API\Management\Jobs\UsersExports;

use Auth0\SDK\API\Management\Jobs\UsersExports\Requests\CreateExportUsersRequestContent;
use Auth0\SDK\API\Management\Types\CreateExportUsersResponseContent;

interface UsersExportsClientInterface
{
    /**
     * Export all users to a file via a long-running job.
     *
     * @param CreateExportUsersRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateExportUsersResponseContent
     */
    public function create(CreateExportUsersRequestContent $request = new CreateExportUsersRequestContent(), ?array $options = null): ?CreateExportUsersResponseContent;
}
