<?php

namespace Auth0\SDK\API\Management\Connections\Keys;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Types\ConnectionKey;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Auth0\SDK\API\Management\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\PostConnectionKeysRequestContent;
use Auth0\SDK\API\Management\Types\PostConnectionsKeysResponseContentItem;
use Auth0\SDK\API\Management\Types\RotateConnectionKeysRequestContent;
use Auth0\SDK\API\Management\Types\RotateConnectionsKeysResponseContent;

class KeysClient implements KeysClientInterface
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/" . RawClient::encodePathParam($id) . "/keys",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return JsonDecoder::decodeArray($json, [ConnectionKey::class]); // @phpstan-ignore-line
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(string $id, ?PostConnectionKeysRequestContent $request = null, ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/" . RawClient::encodePathParam($id) . "/keys",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return JsonDecoder::decodeArray($json, [PostConnectionsKeysResponseContentItem::class]); // @phpstan-ignore-line
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function rotate(string $id, ?RotateConnectionKeysRequestContent $request = null, ?array $options = null): ?RotateConnectionsKeysResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/" . RawClient::encodePathParam($id) . "/keys/rotate",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return RotateConnectionsKeysResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
