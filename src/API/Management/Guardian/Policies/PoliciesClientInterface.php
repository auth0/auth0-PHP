<?php

namespace Auth0\SDK\API\Management\Guardian\Policies;

use Auth0\SDK\API\Management\Types\MfaPolicyEnum;

interface PoliciesClientInterface
{
    /**
     * Retrieve the <a href="https://auth0.com/docs/secure/multi-factor-authentication/enable-mfa">multi-factor authentication (MFA) policies</a> configured for your tenant.
     *
     * The following policies are supported:
     * <ul>
     * <li><code>all-applications</code> policy prompts with MFA for all logins.</li>
     * <li><code>confidence-score</code> policy prompts with MFA only for low confidence logins.</li>
     * </ul>
     *
     * <b>Note</b>: The <code>confidence-score</code> policy is part of the <a href="https://auth0.com/docs/secure/multi-factor-authentication/adaptive-mfa">Adaptive MFA feature</a>. Adaptive MFA requires an add-on for the Enterprise plan; review <a href="https://auth0.com/pricing">Auth0 Pricing</a> for more details.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<value-of<MfaPolicyEnum>>
     */
    public function list(?array $options = null): ?array;

    /**
     * Set <a href="https://auth0.com/docs/secure/multi-factor-authentication/enable-mfa">multi-factor authentication (MFA) policies</a> for your tenant.
     *
     * The following policies are supported:
     * <ul>
     * <li><code>all-applications</code> policy prompts with MFA for all logins.</li>
     * <li><code>confidence-score</code> policy prompts with MFA only for low confidence logins.</li>
     * </ul>
     *
     * <b>Note</b>: The <code>confidence-score</code> policy is part of the <a href="https://auth0.com/docs/secure/multi-factor-authentication/adaptive-mfa">Adaptive MFA feature</a>. Adaptive MFA requires an add-on for the Enterprise plan; review <a href="https://auth0.com/pricing">Auth0 Pricing</a> for more details.
     *
     * @param array<value-of<MfaPolicyEnum>> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<value-of<MfaPolicyEnum>>
     */
    public function set(array $request, ?array $options = null): ?array;
}
