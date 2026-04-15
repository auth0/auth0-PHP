<?php

namespace Auth0\SDK\API\Management\AttackProtection\BruteForceProtection;

use Auth0\SDK\API\Management\Types\GetBruteForceSettingsResponseContent;
use Auth0\SDK\API\Management\AttackProtection\BruteForceProtection\Requests\UpdateBruteForceSettingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateBruteForceSettingsResponseContent;

interface BruteForceProtectionClientInterface
{
    /**
     * Retrieve details of the Brute-force Protection configuration of your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetBruteForceSettingsResponseContent
     */
    public function get(?array $options = null): ?GetBruteForceSettingsResponseContent;

    /**
     * Update the Brute-force Protection configuration of your tenant.
     *
     * @param UpdateBruteForceSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateBruteForceSettingsResponseContent
     */
    public function update(UpdateBruteForceSettingsRequestContent $request = new UpdateBruteForceSettingsRequestContent(), ?array $options = null): ?UpdateBruteForceSettingsResponseContent;
}
