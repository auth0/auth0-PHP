<?php

namespace Auth0\SDK\API\Management\Connections\Users;

use Auth0\SDK\API\Management\Connections\Users\Requests\DeleteConnectionUsersByEmailQueryParameters;

interface UsersClientInterface
{
    /**
     * Deletes a specified connection user by its email (you cannot delete all users from specific connection). Currently, only Database Connections are supported.
     *
     * @param string $id The id of the connection (currently only database connections are supported)
     * @param DeleteConnectionUsersByEmailQueryParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function deleteByEmail(string $id, DeleteConnectionUsersByEmailQueryParameters $request, ?array $options = null): void;
}
