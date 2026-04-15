<?php

namespace Auth0\SDK\API\Management\Actions\Executions;

use Auth0\SDK\API\Management\Types\GetActionExecutionResponseContent;

interface ExecutionsClientInterface
{
    /**
     * Retrieve information about a specific execution of a trigger. Relevant execution IDs will be included in tenant logs generated as part of that authentication flow. Executions will only be stored for 10 days after their creation.
     *
     * @param string $id The ID of the execution to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetActionExecutionResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetActionExecutionResponseContent;
}
