<?php

namespace Auth0\SDK\API\Management\Keys\CustomSigning;

use Auth0\SDK\API\Management\Types\GetCustomSigningKeysResponseContent;
use Auth0\SDK\API\Management\Keys\CustomSigning\Requests\SetCustomSigningKeysRequestContent;
use Auth0\SDK\API\Management\Types\SetCustomSigningKeysResponseContent;

interface CustomSigningClientInterface
{
    /**
     * Get entire jwks representation of custom signing keys.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetCustomSigningKeysResponseContent
     */
    public function get(?array $options = null): ?GetCustomSigningKeysResponseContent;

    /**
     * Create or replace entire jwks representation of custom signing keys.
     *
     * @param SetCustomSigningKeysRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetCustomSigningKeysResponseContent
     */
    public function set(SetCustomSigningKeysRequestContent $request, ?array $options = null): ?SetCustomSigningKeysResponseContent;

    /**
     * Delete entire jwks representation of custom signing keys.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(?array $options = null): void;
}
