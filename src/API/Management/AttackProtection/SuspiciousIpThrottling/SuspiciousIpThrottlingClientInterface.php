<?php

namespace Auth0\SDK\API\Management\AttackProtection\SuspiciousIpThrottling;

use Auth0\SDK\API\Management\Types\GetSuspiciousIpThrottlingSettingsResponseContent;
use Auth0\SDK\API\Management\AttackProtection\SuspiciousIpThrottling\Requests\UpdateSuspiciousIpThrottlingSettingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateSuspiciousIpThrottlingSettingsResponseContent;

interface SuspiciousIpThrottlingClientInterface
{
    /**
     * Retrieve details of the Suspicious IP Throttling configuration of your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetSuspiciousIpThrottlingSettingsResponseContent
     */
    public function get(?array $options = null): ?GetSuspiciousIpThrottlingSettingsResponseContent;

    /**
     * Update the details of the Suspicious IP Throttling configuration of your tenant.
     *
     * @param UpdateSuspiciousIpThrottlingSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateSuspiciousIpThrottlingSettingsResponseContent
     */
    public function update(UpdateSuspiciousIpThrottlingSettingsRequestContent $request = new UpdateSuspiciousIpThrottlingSettingsRequestContent(), ?array $options = null): ?UpdateSuspiciousIpThrottlingSettingsResponseContent;
}
