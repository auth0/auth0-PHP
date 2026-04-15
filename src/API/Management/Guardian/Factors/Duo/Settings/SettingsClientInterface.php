<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Duo\Settings;

use Auth0\SDK\API\Management\Types\GetGuardianFactorDuoSettingsResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Duo\Settings\Requests\SetGuardianFactorDuoSettingsRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorDuoSettingsResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Duo\Settings\Requests\UpdateGuardianFactorDuoSettingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateGuardianFactorDuoSettingsResponseContent;

interface SettingsClientInterface
{
    /**
     * Retrieves the DUO account and factor configuration.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorDuoSettingsResponseContent
     */
    public function get(?array $options = null): ?GetGuardianFactorDuoSettingsResponseContent;

    /**
     * Set the DUO account configuration and other properties specific to this factor.
     *
     * @param SetGuardianFactorDuoSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorDuoSettingsResponseContent
     */
    public function set(SetGuardianFactorDuoSettingsRequestContent $request = new SetGuardianFactorDuoSettingsRequestContent(), ?array $options = null): ?SetGuardianFactorDuoSettingsResponseContent;

    /**
     * @param UpdateGuardianFactorDuoSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateGuardianFactorDuoSettingsResponseContent
     */
    public function update(UpdateGuardianFactorDuoSettingsRequestContent $request = new UpdateGuardianFactorDuoSettingsRequestContent(), ?array $options = null): ?UpdateGuardianFactorDuoSettingsResponseContent;
}
