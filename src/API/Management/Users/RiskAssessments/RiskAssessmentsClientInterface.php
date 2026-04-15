<?php

namespace Auth0\SDK\API\Management\Users\RiskAssessments;

use Auth0\SDK\API\Management\Users\RiskAssessments\Requests\ClearAssessorsRequestContent;

interface RiskAssessmentsClientInterface
{
    /**
     * Clear risk assessment assessors for a specific user
     *
     * @param string $id ID of the user to clear assessors for.
     * @param ClearAssessorsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function clear(string $id, ClearAssessorsRequestContent $request, ?array $options = null): void;
}
