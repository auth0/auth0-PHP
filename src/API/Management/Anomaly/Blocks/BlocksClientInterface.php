<?php

namespace Auth0\SDK\API\Management\Anomaly\Blocks;

interface BlocksClientInterface
{
    /**
     * Check if the given IP address is blocked via the <a href="https://auth0.com/docs/configure/attack-protection/suspicious-ip-throttling">Suspicious IP Throttling</a> due to multiple suspicious attempts.
     *
     * @param string $id IP address to check.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function checkIp(string $id, ?array $options = null): void;

    /**
     * Remove a block imposed by <a href="https://auth0.com/docs/configure/attack-protection/suspicious-ip-throttling">Suspicious IP Throttling</a> for the given IP address.
     *
     * @param string $id IP address to unblock.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function unblockIp(string $id, ?array $options = null): void;
}
