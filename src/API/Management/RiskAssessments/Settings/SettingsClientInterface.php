<?php

namespace Auth0\SDK\API\Management\RiskAssessments\Settings;

use Auth0\SDK\API\Management\Types\GetRiskAssessmentsSettingsResponseContent;
use Auth0\SDK\API\Management\RiskAssessments\Settings\Requests\UpdateRiskAssessmentsSettingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateRiskAssessmentsSettingsResponseContent;
use Auth0\SDK\API\Management\RiskAssessments\Settings\NewDevice\NewDeviceClientInterface;

interface SettingsClientInterface
{
    /**
     * Gets the tenant settings for risk assessments
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetRiskAssessmentsSettingsResponseContent
     */
    public function get(?array $options = null): ?GetRiskAssessmentsSettingsResponseContent;

    /**
     * Updates the tenant settings for risk assessments
     *
     * @param UpdateRiskAssessmentsSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateRiskAssessmentsSettingsResponseContent
     */
    public function update(UpdateRiskAssessmentsSettingsRequestContent $request, ?array $options = null): ?UpdateRiskAssessmentsSettingsResponseContent;

    /**
     * @return NewDeviceClientInterface
     */
    public function getNewDevice(): NewDeviceClientInterface;
}
