<?php

namespace Auth0\SDK\API\Management\AttackProtection\BotDetection;

use Auth0\SDK\API\Management\Types\GetBotDetectionSettingsResponseContent;
use Auth0\SDK\API\Management\AttackProtection\BotDetection\Requests\UpdateBotDetectionSettingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateBotDetectionSettingsResponseContent;

interface BotDetectionClientInterface
{
    /**
     * Get the Bot Detection configuration of your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetBotDetectionSettingsResponseContent
     */
    public function get(?array $options = null): ?GetBotDetectionSettingsResponseContent;

    /**
     * Update the Bot Detection configuration of your tenant.
     *
     * @param UpdateBotDetectionSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateBotDetectionSettingsResponseContent
     */
    public function update(UpdateBotDetectionSettingsRequestContent $request = new UpdateBotDetectionSettingsRequestContent(), ?array $options = null): ?UpdateBotDetectionSettingsResponseContent;
}
