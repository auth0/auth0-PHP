<?php

namespace Auth0\SDK\API\Management\Connections\Keys;

use Auth0\SDK\API\Management\Types\ConnectionKey;
use Auth0\SDK\API\Management\Types\PostConnectionKeysRequestContent;
use Auth0\SDK\API\Management\Types\PostConnectionsKeysResponseContentItem;
use Auth0\SDK\API\Management\Types\RotateConnectionKeysRequestContent;
use Auth0\SDK\API\Management\Types\RotateConnectionsKeysResponseContent;

interface KeysClientInterface
{
    /**
     * Gets the connection keys for the Okta, OIDC, or SAML (samlp) connection strategy. The response includes both signing keys and encryption keys, told apart by `key_use`. Encryption keys apply only to OIDC and Okta connections.
     *
     * Example:
     * ```php
     * $client->connections->keys->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the connection
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<ConnectionKey>
     */
    public function get(string $id, ?array $options = null): ?array;

    /**
     * Provision initial connection keys for Okta, OIDC, or SAML (samlp) connection strategies. This endpoint allows you to create keys before configuring the connection to use Private Key JWT authentication or encrypted ID tokens, enabling zero-downtime transitions.
     *
     * Set `key_use` to `signing` (default) to provision signing keys, optionally choosing `signing_alg`, or to `encryption` to provision encryption keys, optionally choosing `encryption_alg`. `signing_alg` and `encryption_alg` each apply only to their own key use. Encryption keys and encrypted ID tokens apply only to OIDC and Okta connections. The response lists all of the connection's keys.
     *
     * Example:
     * ```php
     * $client->connections->keys->create(
     *     'id',
     *     new PostConnectionKeysRequestContent([]),
     * );
     * ```
     *
     * @param string $id ID of the connection
     * @param ?PostConnectionKeysRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<PostConnectionsKeysResponseContentItem>
     */
    public function create(string $id, ?PostConnectionKeysRequestContent $request = null, ?array $options = null): ?array;

    /**
     * Rotates the connection keys for the Okta, OIDC, or SAML (samlp) connection strategies.
     *
     * Set `key_use` to `signing` (default) to rotate the signing key, optionally choosing `signing_alg`, or to `encryption` to rotate the encryption key, optionally choosing `encryption_alg`. Rotating signing keys requires the connection to be configured to use JWT Client Authentication. Rotating encryption keys requires the connection to be configured to use encrypted ID tokens (`id_token_encrypted_response_alg` set), which applies only to OIDC and Okta connections. When `encryption_alg` is omitted, the new encryption key uses `id_token_encrypted_response_alg`.
     *
     * Example:
     * ```php
     * $client->connections->keys->rotate(
     *     'id',
     *     new RotateConnectionKeysRequestContent([]),
     * );
     * ```
     *
     * @param string $id ID of the connection
     * @param ?RotateConnectionKeysRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RotateConnectionsKeysResponseContent
     */
    public function rotate(string $id, ?RotateConnectionKeysRequestContent $request = null, ?array $options = null): ?RotateConnectionsKeysResponseContent;
}
