<?php

namespace Auth0\SDK\API\Management\Experimentation\Experiments;

use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\AdvanceRampRequestContent;
use Auth0\SDK\API\Management\Types\AdvanceRampResponseContent;

interface ExperimentsClientInterface
{
    /**
     * Increments the current ramp index to the requested target level. Up-only: the target must be the immediate next level in the schedule. Idempotent: calling with the current level returns success without writing anything.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->advanceRamp(
     *     'id',
     *     new AdvanceRampRequestContent([
     *         'targetLevel' => 1,
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the experiment to advance.
     * @param AdvanceRampRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AdvanceRampResponseContent
     */
    public function advanceRamp(string $id, AdvanceRampRequestContent $request, ?array $options = null): ?AdvanceRampResponseContent;
}
