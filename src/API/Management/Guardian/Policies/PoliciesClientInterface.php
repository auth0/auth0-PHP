<?php

namespace Auth0\SDK\API\Management\Guardian\Policies;

use Auth0\SDK\API\Management\Types\MfaPolicyEnum;

interface PoliciesClientInterface
{
    /**
     * Retrieve the [multi-factor authentication (MFA) policies](https://auth0.com/docs/secure/multi-factor-authentication/enable-mfa) configured for your tenant.
     *
     * The following policies are supported:
     *
     * - `all-applications` policy prompts with MFA for all logins.
     * - `confidence-score` policy prompts with MFA only for low confidence logins.
     *
     * **Note**: The `confidence-score` policy is part of the [Adaptive MFA feature](https://auth0.com/docs/secure/multi-factor-authentication/adaptive-mfa). Adaptive MFA requires an add-on for the Enterprise plan; review [Auth0 Pricing](https://auth0.com/pricing) for more details.
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
     * Set [multi-factor authentication (MFA) policies](https://auth0.com/docs/secure/multi-factor-authentication/enable-mfa) for your tenant.
     *
     * The following policies are supported:
     *
     * - `all-applications` policy prompts with MFA for all logins.
     * - `confidence-score` policy prompts with MFA only for low confidence logins.
     *
     * **Note**: The `confidence-score` policy is part of the [Adaptive MFA feature](https://auth0.com/docs/secure/multi-factor-authentication/adaptive-mfa). Adaptive MFA requires an add-on for the Enterprise plan; review [Auth0 Pricing](https://auth0.com/pricing) for more details.
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
