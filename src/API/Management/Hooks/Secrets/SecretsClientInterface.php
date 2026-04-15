<?php

namespace Auth0\SDK\API\Management\Hooks\Secrets;

interface SecretsClientInterface
{
    /**
     * Retrieve a hook's secrets by the ID of the hook.
     *
     * @param string $id ID of the hook to retrieve secrets from.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, string>
     */
    public function get(string $id, ?array $options = null): ?array;

    /**
     * Add one or more secrets to an existing hook. Accepts an object of key-value pairs, where the key is the name of the secret. A hook can have a maximum of 20 secrets.
     *
     * @param string $id The id of the hook to retrieve
     * @param array<string, string> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function create(string $id, array $request, ?array $options = null): void;

    /**
     * Delete one or more existing secrets for a given hook. Accepts an array of secret names to delete.
     *
     * @param string $id ID of the hook whose secrets to delete.
     * @param array<string> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, array $request, ?array $options = null): void;

    /**
     * Update one or more existing secrets for an existing hook. Accepts an object of key-value pairs, where the key is the name of the existing secret.
     *
     * @param string $id ID of the hook whose secrets to update.
     * @param array<string, string> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function update(string $id, array $request, ?array $options = null): void;
}
