<?php

namespace Auth0\SDK\API\Management\SupplementalSignals;

use Auth0\SDK\API\Management\Types\GetSupplementalSignalsResponseContent;
use Auth0\SDK\API\Management\SupplementalSignals\Requests\UpdateSupplementalSignalsRequestContent;
use Auth0\SDK\API\Management\Types\PatchSupplementalSignalsResponseContent;

interface SupplementalSignalsClientInterface
{
    /**
     * Get the supplemental signals configuration for a tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetSupplementalSignalsResponseContent
     */
    public function get(?array $options = null): ?GetSupplementalSignalsResponseContent;

    /**
     * Update the supplemental signals configuration for a tenant.
     *
     * @param UpdateSupplementalSignalsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PatchSupplementalSignalsResponseContent
     */
    public function patch(UpdateSupplementalSignalsRequestContent $request, ?array $options = null): ?PatchSupplementalSignalsResponseContent;
}
