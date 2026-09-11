<?php

namespace Auth0\SDK\API\Management\Guardian;

use Auth0\SDK\API\Management\Types\GetGuardianSettingsResponseContent;
use Auth0\SDK\API\Management\Guardian\Requests\SetGuardianSettingsRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianSettingsResponseContent;
use Auth0\SDK\API\Management\Guardian\Enrollments\EnrollmentsClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\FactorsClientInterface;
use Auth0\SDK\API\Management\Guardian\Policies\PoliciesClientInterface;

interface GuardianClientInterface
{
    /**
     * TODO: Link this endpoint to relevant documentation when available.
     *
     * Example:
     * ```php
     * $client->guardian->get();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianSettingsResponseContent
     */
    public function get(?array $options = null): ?GetGuardianSettingsResponseContent;

    /**
     * Update a tenant's guardian settings such as Remember Me
     *
     * Example:
     * ```php
     * $client->guardian->set(
     *     new SetGuardianSettingsRequestContent([
     *         'displayRememberMeCheckbox' => true,
     *         'rememberMeDefaultValue' => true,
     *         'mfaSessionInactivityTimeout' => 1,
     *         'mfaSessionOverallTimeout' => 1,
     *     ]),
     * );
     * ```
     *
     * @param SetGuardianSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianSettingsResponseContent
     */
    public function set(SetGuardianSettingsRequestContent $request, ?array $options = null): ?SetGuardianSettingsResponseContent;

    /**
     * @return EnrollmentsClientInterface
     */
    public function getEnrollments(): EnrollmentsClientInterface;

    /**
     * @return FactorsClientInterface
     */
    public function getFactors(): FactorsClientInterface;

    /**
     * @return PoliciesClientInterface
     */
    public function getPolicies(): PoliciesClientInterface;
}
