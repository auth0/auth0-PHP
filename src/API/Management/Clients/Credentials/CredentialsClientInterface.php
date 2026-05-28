<?php

namespace Auth0\SDK\API\Management\Clients\Credentials;

use Auth0\SDK\API\Management\Types\ClientCredential;
use Auth0\SDK\API\Management\Clients\Credentials\Requests\PostClientCredentialRequestContent;
use Auth0\SDK\API\Management\Types\PostClientCredentialResponseContent;
use Auth0\SDK\API\Management\Types\GetClientCredentialResponseContent;
use Auth0\SDK\API\Management\Clients\Credentials\Requests\PatchClientCredentialRequestContent;
use Auth0\SDK\API\Management\Types\PatchClientCredentialResponseContent;

interface CredentialsClientInterface
{
    /**
     * Get the details of a client credential.
     *
     * **Important**: To enable credentials to be used for a client authentication method, set the `client_authentication_methods` property on the client. To enable credentials to be used for JWT-Secured Authorization requests set the `signed_request_object` property on the client.
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
     */
    public function list(string $clientId, ?array $options = null): ?array;

    /**
     * Create a client credential associated to your application. Credentials can be used to configure Private Key JWT and mTLS authentication methods, as well as for JWT-secured Authorization requests.
     *
     * **Public Key**
     *
     * Public Key credentials can be used to set up Private Key JWT client authentication and JWT-secured Authorization requests.
     *
     * Sample:
     *
     * ```json
     * {
     *   "credential_type": "public_key",
     *   "name": "string",
     *   "pem": "string",
     *   "alg": "RS256",
     *   "parse_expiry_from_cert": false,
     *   "expires_at": "2022-12-31T23:59:59Z"
     * }
     * ```
     *
     * **Certificate (CA-signed & self-signed)**
     *
     * Certificate credentials can be used to set up mTLS client authentication. CA-signed certificates can be configured either with a signed certificate or with just the certificate Subject DN.
     *
     * CA-signed Certificate Sample (pem):
     *
     * ```json
     * {
     *   "credential_type": "x509_cert",
     *   "name": "string",
     *   "pem": "string"
     * }
     * ```
     *
     * CA-signed Certificate Sample (subject_dn):
     *
     * ```json
     * {
     *   "credential_type": "cert_subject_dn",
     *   "name": "string",
     *   "subject_dn": "string"
     * }
     * ```
     *
     * Self-signed Certificate Sample:
     *
     * ```json
     * {
     *   "credential_type": "cert_subject_dn",
     *   "name": "string",
     *   "pem": "string"
     * }
     * ```
     *
     * The credential will be created but not yet enabled for use until you set the corresponding properties in the client:
     *
     * - To enable the credential for Private Key JWT or mTLS authentication methods, set the `client_authentication_methods` property on the client. For more information, read [Configure Private Key JWT Authentication](https://auth0.com/docs/get-started/applications/configure-private-key-jwt) and [Configure mTLS Authentication](https://auth0.com/docs/get-started/applications/configure-mtls)
     * - To enable the credential for JWT-secured Authorization requests, set the `signed_request_object`property on the client. For more information, read [Configure JWT-secured Authorization Requests (JAR)](https://auth0.com/docs/get-started/applications/configure-jar)
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
     */
    public function create(string $clientId, PostClientCredentialRequestContent $request, ?array $options = null): ?PostClientCredentialResponseContent;

    /**
     * Get the details of a client credential.
     *
     * **Important**: To enable credentials to be used for a client authentication method, set the `client_authentication_methods` property on the client. To enable credentials to be used for JWT-Secured Authorization requests set the `signed_request_object` property on the client.
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
     */
    public function get(string $clientId, string $credentialId, ?array $options = null): ?GetClientCredentialResponseContent;

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
     */
    public function delete(string $clientId, string $credentialId, ?array $options = null): void;

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
     */
    public function update(string $clientId, string $credentialId, PatchClientCredentialRequestContent $request = new PatchClientCredentialRequestContent(), ?array $options = null): ?PatchClientCredentialResponseContent;
}
