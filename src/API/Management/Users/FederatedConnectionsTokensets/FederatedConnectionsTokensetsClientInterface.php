<?php

namespace Auth0\SDK\API\Management\Users\FederatedConnectionsTokensets;

use Auth0\SDK\API\Management\Types\FederatedConnectionTokenSet;

interface FederatedConnectionsTokensetsClientInterface
{
    /**
     * List active federated connections tokensets for a provided user
     *
     * @param string $id User identifier
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<FederatedConnectionTokenSet>
     */
    public function list(string $id, ?array $options = null): ?array;

    /**
     * @param string $id Id of the user that owns the tokenset
     * @param string $tokensetId The tokenset id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $tokensetId, ?array $options = null): void;
}
