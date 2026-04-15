<?php

namespace Auth0\SDK\API\Management\RiskAssessments\Settings\NewDevice;

use Auth0\SDK\API\Management\Types\GetRiskAssessmentsSettingsNewDeviceResponseContent;
use Auth0\SDK\API\Management\RiskAssessments\Settings\NewDevice\Requests\UpdateRiskAssessmentsSettingsNewDeviceRequestContent;
use Auth0\SDK\API\Management\Types\UpdateRiskAssessmentsSettingsNewDeviceResponseContent;

interface NewDeviceClientInterface
{
    /**
     * Gets the risk assessment settings for the new device assessor
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetRiskAssessmentsSettingsNewDeviceResponseContent
     */
    public function get(?array $options = null): ?GetRiskAssessmentsSettingsNewDeviceResponseContent;

    /**
     * Updates the risk assessment settings for the new device assessor
     *
     * @param UpdateRiskAssessmentsSettingsNewDeviceRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateRiskAssessmentsSettingsNewDeviceResponseContent
     */
    public function update(UpdateRiskAssessmentsSettingsNewDeviceRequestContent $request, ?array $options = null): ?UpdateRiskAssessmentsSettingsNewDeviceResponseContent;
}
