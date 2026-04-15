<?php

namespace Auth0\SDK\API\Management\Users\Multifactor;

use Auth0\SDK\API\Management\Types\UserMultifactorProviderEnum;

interface MultifactorClientInterface
{
    /**
     * Invalidate all remembered browsers across all <a href="https://auth0.com/docs/multifactor-authentication">authentication factors</a> for a user.
     *
     * @param string $id ID of the user to invalidate all remembered browsers and authentication factors for.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function invalidateRememberBrowser(string $id, ?array $options = null): void;

    /**
     * Remove a <a href="https://auth0.com/docs/multifactor-authentication">multifactor</a> authentication configuration from a user's account. This forces the user to manually reconfigure the multi-factor provider.
     *
     * @param string $id ID of the user to remove a multifactor configuration from.
     * @param value-of<UserMultifactorProviderEnum> $provider The multi-factor provider. Supported values 'duo' or 'google-authenticator'
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function deleteProvider(string $id, string $provider, ?array $options = null): void;
}
