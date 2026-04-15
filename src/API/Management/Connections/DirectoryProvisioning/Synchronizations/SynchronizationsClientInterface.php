<?php

namespace Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Synchronizations;

use Auth0\SDK\API\Management\Types\CreateDirectorySynchronizationResponseContent;

interface SynchronizationsClientInterface
{
    /**
     * Request an on-demand synchronization of the directory.
     *
     * @param string $id The id of the connection to trigger synchronization for
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateDirectorySynchronizationResponseContent
     */
    public function create(string $id, ?array $options = null): ?CreateDirectorySynchronizationResponseContent;
}
