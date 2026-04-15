<?php

namespace Auth0\SDK\API\Management\Clients\Credentials;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Types\ClientCredential;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Auth0\SDK\API\Management\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Clients\Credentials\Requests\PostClientCredentialRequestContent;
use Auth0\SDK\API\Management\Types\PostClientCredentialResponseContent;
use Auth0\SDK\API\Management\Types\GetClientCredentialResponseContent;
use Auth0\SDK\API\Management\Clients\Credentials\Requests\PatchClientCredentialRequestContent;
use Auth0\SDK\API\Management\Types\PatchClientCredentialResponseContent;

class CredentialsClient implements CredentialsClientInterface
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
     * Get the details of a client credential.
     *
     * <b>Important</b>: To enable credentials to be used for a client authentication method, set the <code>client_authentication_methods</code> property on the client. To enable credentials to be used for JWT-Secured Authorization requests set the <code>signed_request_object</code> property on the client.
     *
     * @param string $clientId ID of the client.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<ClientCredential>
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function list(string $clientId, ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "clients/{$clientId}/credentials",
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
                return JsonDecoder::decodeArray($json, [ClientCredential::class]); // @phpstan-ignore-line
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
     * Create a client credential associated to your application. Credentials can be used to configure Private Key JWT and mTLS authentication methods, as well as for JWT-secured Authorization requests.
     *
     * <h5>Public Key</h5>Public Key credentials can be used to set up Private Key JWT client authentication and JWT-secured Authorization requests.
     *
     * Sample: <pre><code>{
     *   "credential_type": "public_key",
     *   "name": "string",
     *   "pem": "string",
     *   "alg": "RS256",
     *   "parse_expiry_from_cert": false,
     *   "expires_at": "2022-12-31T23:59:59Z"
     * }</code></pre>
     * <h5>Certificate (CA-signed & self-signed)</h5>Certificate credentials can be used to set up mTLS client authentication. CA-signed certificates can be configured either with a signed certificate or with just the certificate Subject DN.
     *
     * CA-signed Certificate Sample (pem): <pre><code>{
     *   "credential_type": "x509_cert",
     *   "name": "string",
     *   "pem": "string"
     * }</code></pre>CA-signed Certificate Sample (subject_dn): <pre><code>{
     *   "credential_type": "cert_subject_dn",
     *   "name": "string",
     *   "subject_dn": "string"
     * }</code></pre>Self-signed Certificate Sample: <pre><code>{
     *   "credential_type": "cert_subject_dn",
     *   "name": "string",
     *   "pem": "string"
     * }</code></pre>
     *
     * The credential will be created but not yet enabled for use until you set the corresponding properties in the client:
     * <ul>
     *   <li>To enable the credential for Private Key JWT or mTLS authentication methods, set the <code>client_authentication_methods</code> property on the client. For more information, read <a href="https://auth0.com/docs/get-started/applications/configure-private-key-jwt">Configure Private Key JWT Authentication</a> and <a href="https://auth0.com/docs/get-started/applications/configure-mtls">Configure mTLS Authentication</a></li>
     *   <li>To enable the credential for JWT-secured Authorization requests, set the <code>signed_request_object</code>property on the client. For more information, read <a href="https://auth0.com/docs/get-started/applications/configure-jar">Configure JWT-secured Authorization Requests (JAR)</a></li>
     * </ul>
     *
     * @param string $clientId ID of the client.
     * @param PostClientCredentialRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PostClientCredentialResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(string $clientId, PostClientCredentialRequestContent $request, ?array $options = null): ?PostClientCredentialResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "clients/{$clientId}/credentials",
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
                return PostClientCredentialResponseContent::fromJson($json);
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
     * Get the details of a client credential.
     *
     * <b>Important</b>: To enable credentials to be used for a client authentication method, set the <code>client_authentication_methods</code> property on the client. To enable credentials to be used for JWT-Secured Authorization requests set the <code>signed_request_object</code> property on the client.
     *
     * @param string $clientId ID of the client.
     * @param string $credentialId ID of the credential.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetClientCredentialResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $clientId, string $credentialId, ?array $options = null): ?GetClientCredentialResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "clients/{$clientId}/credentials/{$credentialId}",
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
                return GetClientCredentialResponseContent::fromJson($json);
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
     * Delete a client credential you previously created. May be enabled or disabled. For more information, read <a href="https://www.auth0.com/docs/get-started/authentication-and-authorization-flow/client-credentials-flow">Client Credential Flow</a>.
     *
     * @param string $clientId ID of the client.
     * @param string $credentialId ID of the credential to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function delete(string $clientId, string $credentialId, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "clients/{$clientId}/credentials/{$credentialId}",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
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
     * Change a client credential you previously created. May be enabled or disabled. For more information, read <a href="https://www.auth0.com/docs/get-started/authentication-and-authorization-flow/client-credentials-flow">Client Credential Flow</a>.
     *
     * @param string $clientId ID of the client.
     * @param string $credentialId ID of the credential.
     * @param PatchClientCredentialRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PatchClientCredentialResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $clientId, string $credentialId, PatchClientCredentialRequestContent $request = new PatchClientCredentialRequestContent(), ?array $options = null): ?PatchClientCredentialResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "clients/{$clientId}/credentials/{$credentialId}",
                    method: HttpMethod::PATCH,
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
                return PatchClientCredentialResponseContent::fromJson($json);
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
