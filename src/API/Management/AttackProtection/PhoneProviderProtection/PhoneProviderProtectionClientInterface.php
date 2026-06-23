<?php

namespace Auth0\SDK\API\Management\AttackProtection\PhoneProviderProtection;

use Auth0\SDK\API\Management\Types\GetPhoneProviderProtectionResponseContent;
use Auth0\SDK\API\Management\AttackProtection\PhoneProviderProtection\Requests\PatchPhoneProviderProtectionRequestContent;
use Auth0\SDK\API\Management\Types\PatchPhoneProviderProtectionResponseContent;

interface PhoneProviderProtectionClientInterface
{
    /**
     * Get the phone provider protection configuration for a tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetPhoneProviderProtectionResponseContent
     */
    public function get(?array $options = null): ?GetPhoneProviderProtectionResponseContent;

    /**
     * Update the phone provider protection configuration for a tenant.
     *
     * @param PatchPhoneProviderProtectionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PatchPhoneProviderProtectionResponseContent
     */
    public function patch(PatchPhoneProviderProtectionRequestContent $request, ?array $options = null): ?PatchPhoneProviderProtectionResponseContent;
}
