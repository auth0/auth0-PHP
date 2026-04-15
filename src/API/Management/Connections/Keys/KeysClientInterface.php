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
     * Gets the connection keys for the Okta or OIDC connection strategy.
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
     * Provision initial connection keys for Okta or OIDC connection strategies. This endpoint allows you to create keys before configuring the connection to use Private Key JWT authentication, enabling zero-downtime transitions.
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
     * Rotates the connection keys for the Okta or OIDC connection strategies.
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
