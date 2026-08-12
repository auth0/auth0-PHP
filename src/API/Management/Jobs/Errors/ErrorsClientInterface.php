<?php

namespace Auth0\SDK\API\Management\Jobs\Errors;

use Auth0\SDK\API\Management\Types\GetJobErrorResponseContent;
use Auth0\SDK\API\Management\Types\GetJobGenericErrorResponseContent;

interface ErrorsClientInterface
{
    /**
     * Retrieve error details of a failed job.
     *
     * Example:
     * ```php
     * $client->jobs->errors->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the job.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    array<GetJobErrorResponseContent>
     *   |GetJobGenericErrorResponseContent
     * )|null
     */
    public function get(string $id, ?array $options = null): array|GetJobGenericErrorResponseContent|null;
}
