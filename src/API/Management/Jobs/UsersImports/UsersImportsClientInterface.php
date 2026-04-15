<?php

namespace Auth0\SDK\API\Management\Jobs\UsersImports;

use Auth0\SDK\API\Management\Jobs\UsersImports\Requests\CreateImportUsersRequestContent;
use Auth0\SDK\API\Management\Types\CreateImportUsersResponseContent;

interface UsersImportsClientInterface
{
    /**
     * Import users from a <a href="https://auth0.com/docs/users/references/bulk-import-database-schema-examples">formatted file</a> into a connection via a long-running job. When importing users, with or without upsert, the `email_verified` is set to `false` when the email address is added or updated. Users must verify their email address. To avoid this behavior, set `email_verified` to `true` in the imported data.
     *
     * @param CreateImportUsersRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     * } $options
     * @return ?CreateImportUsersResponseContent
     */
    public function create(CreateImportUsersRequestContent $request, ?array $options = null): ?CreateImportUsersResponseContent;
}
