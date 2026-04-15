<?php

namespace Auth0\SDK\API\Management\AttackProtection\BreachedPasswordDetection;

use Auth0\SDK\API\Management\Types\GetBreachedPasswordDetectionSettingsResponseContent;
use Auth0\SDK\API\Management\AttackProtection\BreachedPasswordDetection\Requests\UpdateBreachedPasswordDetectionSettingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateBreachedPasswordDetectionSettingsResponseContent;

interface BreachedPasswordDetectionClientInterface
{
    /**
     * Retrieve details of the Breached Password Detection configuration of your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetBreachedPasswordDetectionSettingsResponseContent
     */
    public function get(?array $options = null): ?GetBreachedPasswordDetectionSettingsResponseContent;

    /**
     * Update details of the Breached Password Detection configuration of your tenant.
     *
     * @param UpdateBreachedPasswordDetectionSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateBreachedPasswordDetectionSettingsResponseContent
     */
    public function update(UpdateBreachedPasswordDetectionSettingsRequestContent $request = new UpdateBreachedPasswordDetectionSettingsRequestContent(), ?array $options = null): ?UpdateBreachedPasswordDetectionSettingsResponseContent;
}
