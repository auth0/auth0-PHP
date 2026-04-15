<?php

namespace Auth0\SDK\API\Management\Clients;

use Auth0\SDK\API\Management\Clients\Requests\ListClientsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Client;
use Auth0\SDK\API\Management\Clients\Requests\CreateClientRequestContent;
use Auth0\SDK\API\Management\Types\CreateClientResponseContent;
use Auth0\SDK\API\Management\Clients\Requests\PreviewCimdMetadataRequestContent;
use Auth0\SDK\API\Management\Types\PreviewCimdMetadataResponseContent;
use Auth0\SDK\API\Management\Clients\Requests\RegisterCimdClientRequestContent;
use Auth0\SDK\API\Management\Types\RegisterCimdClientResponseContent;
use Auth0\SDK\API\Management\Clients\Requests\GetClientRequestParameters;
use Auth0\SDK\API\Management\Types\GetClientResponseContent;
use Auth0\SDK\API\Management\Clients\Requests\UpdateClientRequestContent;
use Auth0\SDK\API\Management\Types\UpdateClientResponseContent;
use Auth0\SDK\API\Management\Types\RotateClientSecretResponseContent;
use Auth0\SDK\API\Management\Clients\Credentials\CredentialsClientInterface;
use Auth0\SDK\API\Management\Clients\Connections\ConnectionsClientInterface;

interface ClientsClientInterface
{
    /**
     * Retrieve clients (applications and SSO integrations) matching provided filters. A list of fields to include or exclude may also be specified.
     * For more information, read <a href="https://www.auth0.com/docs/get-started/applications"> Applications in Auth0</a> and <a href="https://www.auth0.com/docs/authenticate/single-sign-on"> Single Sign-On</a>.
     *
     * <ul>
     *   <li>
     *     The following can be retrieved with any scope:
     *     <code>client_id</code>, <code>app_type</code>, <code>name</code>, and <code>description</code>.
     *   </li>
     *   <li>
     *     The following properties can only be retrieved with the <code>read:clients</code> or
     *     <code>read:client_keys</code> scope:
     *     <code>callbacks</code>, <code>oidc_logout</code>, <code>allowed_origins</code>,
     *     <code>web_origins</code>, <code>tenant</code>, <code>global</code>, <code>config_route</code>,
     *     <code>callback_url_template</code>, <code>jwt_configuration</code>,
     *     <code>jwt_configuration.lifetime_in_seconds</code>, <code>jwt_configuration.secret_encoded</code>,
     *     <code>jwt_configuration.scopes</code>, <code>jwt_configuration.alg</code>, <code>api_type</code>,
     *     <code>logo_uri</code>, <code>allowed_clients</code>, <code>owners</code>, <code>custom_login_page</code>,
     *     <code>custom_login_page_off</code>, <code>sso</code>, <code>addons</code>, <code>form_template</code>,
     *     <code>custom_login_page_codeview</code>, <code>resource_servers</code>, <code>client_metadata</code>,
     *     <code>mobile</code>, <code>mobile.android</code>, <code>mobile.ios</code>, <code>allowed_logout_urls</code>,
     *     <code>token_endpoint_auth_method</code>, <code>is_first_party</code>, <code>oidc_conformant</code>,
     *     <code>is_token_endpoint_ip_header_trusted</code>, <code>initiate_login_uri</code>, <code>grant_types</code>,
     *     <code>refresh_token</code>, <code>refresh_token.rotation_type</code>, <code>refresh_token.expiration_type</code>,
     *     <code>refresh_token.leeway</code>, <code>refresh_token.token_lifetime</code>, <code>refresh_token.policies</code>, <code>organization_usage</code>,
     *     <code>organization_require_behavior</code>.
     *   </li>
     *   <li>
     *     The following properties can only be retrieved with the
     *     <code>read:client_keys</code> or <code>read:client_credentials</code> scope:
     *     <code>encryption_key</code>, <code>encryption_key.pub</code>, <code>encryption_key.cert</code>,
     *     <code>client_secret</code>, <code>client_authentication_methods</code> and <code>signing_key</code>.
     *   </li>
     * </ul>
     *
     * @param ListClientsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Client>
     */
    public function list(ListClientsRequestParameters $request = new ListClientsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new client (application or SSO integration). For more information, read <a href="https://www.auth0.com/docs/get-started/auth0-overview/create-applications">Create Applications</a>
     * <a href="https://www.auth0.com/docs/authenticate/single-sign-on/api-endpoints-for-single-sign-on>">API Endpoints for Single Sign-On</a>.
     *
     * Notes:
     * - We recommend leaving the `client_secret` parameter unspecified to allow the generation of a safe secret.
     * - The <code>client_authentication_methods</code> and <code>token_endpoint_auth_method</code> properties are mutually exclusive. Use
     * <code>client_authentication_methods</code> to configure the client with Private Key JWT authentication method. Otherwise, use <code>token_endpoint_auth_method</code>
     * to configure the client with client secret (basic or post) or with no authentication method (none).
     * - When using <code>client_authentication_methods</code> to configure the client with Private Key JWT authentication method, specify fully defined credentials.
     * These credentials will be automatically enabled for Private Key JWT authentication on the client.
     * - To configure <code>client_authentication_methods</code>, the <code>create:client_credentials</code> scope is required.
     * - To configure <code>client_authentication_methods</code>, the property <code>jwt_configuration.alg</code> must be set to RS256.
     *
     * <div class="alert alert-warning">SSO Integrations created via this endpoint will accept login requests and share user profile information.</div>
     *
     * @param CreateClientRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateClientResponseContent
     */
    public function create(CreateClientRequestContent $request, ?array $options = null): ?CreateClientResponseContent;

    /**
     *
     *       Fetches and validates a Client ID Metadata Document without creating a client.
     *       Returns the raw metadata and how it would be mapped to Auth0 client fields.
     *       This endpoint is useful for testing metadata URIs before creating CIMD clients.
     *
     *
     * @param PreviewCimdMetadataRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PreviewCimdMetadataResponseContent
     */
    public function previewCimdMetadata(PreviewCimdMetadataRequestContent $request, ?array $options = null): ?PreviewCimdMetadataResponseContent;

    /**
     *
     *       Idempotent registration for Client ID Metadata Document (CIMD) clients.
     *       Uses external_client_id as the unique identifier for upsert operations.
     *       **Create:** Returns 201 when a new client is created (requires \
     *
     * @param RegisterCimdClientRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RegisterCimdClientResponseContent
     */
    public function registerCimdClient(RegisterCimdClientRequestContent $request, ?array $options = null): ?RegisterCimdClientResponseContent;

    /**
     * Retrieve client details by ID. Clients are SSO connections or Applications linked with your Auth0 tenant. A list of fields to include or exclude may also be specified.
     * For more information, read <a href="https://www.auth0.com/docs/get-started/applications"> Applications in Auth0</a> and <a href="https://www.auth0.com/docs/authenticate/single-sign-on"> Single Sign-On</a>.
     * <ul>
     *   <li>
     *     The following properties can be retrieved with any of the scopes:
     *     <code>client_id</code>, <code>app_type</code>, <code>name</code>, and <code>description</code>.
     *   </li>
     *   <li>
     *     The following properties can only be retrieved with the <code>read:clients</code> or
     *     <code>read:client_keys</code> scopes:
     *     <code>callbacks</code>, <code>oidc_logout</code>, <code>allowed_origins</code>,
     *     <code>web_origins</code>, <code>tenant</code>, <code>global</code>, <code>config_route</code>,
     *     <code>callback_url_template</code>, <code>jwt_configuration</code>,
     *     <code>jwt_configuration.lifetime_in_seconds</code>, <code>jwt_configuration.secret_encoded</code>,
     *     <code>jwt_configuration.scopes</code>, <code>jwt_configuration.alg</code>, <code>api_type</code>,
     *     <code>logo_uri</code>, <code>allowed_clients</code>, <code>owners</code>, <code>custom_login_page</code>,
     *     <code>custom_login_page_off</code>, <code>sso</code>, <code>addons</code>, <code>form_template</code>,
     *     <code>custom_login_page_codeview</code>, <code>resource_servers</code>, <code>client_metadata</code>,
     *     <code>mobile</code>, <code>mobile.android</code>, <code>mobile.ios</code>, <code>allowed_logout_urls</code>,
     *     <code>token_endpoint_auth_method</code>, <code>is_first_party</code>, <code>oidc_conformant</code>,
     *     <code>is_token_endpoint_ip_header_trusted</code>, <code>initiate_login_uri</code>, <code>grant_types</code>,
     *     <code>refresh_token</code>, <code>refresh_token.rotation_type</code>, <code>refresh_token.expiration_type</code>,
     *     <code>refresh_token.leeway</code>, <code>refresh_token.token_lifetime</code>, <code>refresh_token.policies</code>, <code>organization_usage</code>,
     *     <code>organization_require_behavior</code>.
     *   </li>
     *   <li>
     *     The following properties can only be retrieved with the <code>read:client_keys</code> or <code>read:client_credentials</code> scopes:
     *     <code>encryption_key</code>, <code>encryption_key.pub</code>, <code>encryption_key.cert</code>,
     *     <code>client_secret</code>, <code>client_authentication_methods</code> and <code>signing_key</code>.
     *   </li>
     * </ul>
     *
     * @param string $id ID of the client to retrieve.
     * @param GetClientRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetClientResponseContent
     */
    public function get(string $id, GetClientRequestParameters $request = new GetClientRequestParameters(), ?array $options = null): ?GetClientResponseContent;

    /**
     * Delete a client and related configuration (rules, connections, etc).
     *
     * @param string $id ID of the client to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;

    /**
     * Updates a client's settings. For more information, read <a href="https://www.auth0.com/docs/get-started/applications"> Applications in Auth0</a> and <a href="https://www.auth0.com/docs/authenticate/single-sign-on"> Single Sign-On</a>.
     *
     * Notes:
     * - The `client_secret` and `signing_key` attributes can only be updated with the `update:client_keys` scope.
     * - The <code>client_authentication_methods</code> and <code>token_endpoint_auth_method</code> properties are mutually exclusive. Use <code>client_authentication_methods</code> to configure the client with Private Key JWT authentication method. Otherwise, use <code>token_endpoint_auth_method</code> to configure the client with client secret (basic or post) or with no authentication method (none).
     * - When using <code>client_authentication_methods</code> to configure the client with Private Key JWT authentication method, only specify the credential IDs that were generated when creating the credentials on the client.
     * - To configure <code>client_authentication_methods</code>, the <code>update:client_credentials</code> scope is required.
     * - To configure <code>client_authentication_methods</code>, the property <code>jwt_configuration.alg</code> must be set to RS256.
     * - To change a client's <code>is_first_party</code> property to <code>false</code>, the <code>organization_usage</code> and <code>organization_require_behavior</code> properties must be unset.
     *
     * @param string $id ID of the client to update.
     * @param UpdateClientRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateClientResponseContent
     */
    public function update(string $id, UpdateClientRequestContent $request = new UpdateClientRequestContent(), ?array $options = null): ?UpdateClientResponseContent;

    /**
     * Rotate a client secret.
     *
     * This endpoint cannot be used with clients configured with Private Key JWT authentication method (client_authentication_methods configured with private_key_jwt). The generated secret is NOT base64 encoded.
     *
     * For more information, read <a href="https://www.auth0.com/docs/get-started/applications/rotate-client-secret">Rotate Client Secrets</a>.
     *
     * @param string $id ID of the client that will rotate secrets.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RotateClientSecretResponseContent
     */
    public function rotateSecret(string $id, ?array $options = null): ?RotateClientSecretResponseContent;

    /**
     * @return CredentialsClientInterface
     */
    public function getCredentials(): CredentialsClientInterface;

    /**
     * @return ConnectionsClientInterface
     */
    public function getConnections(): ConnectionsClientInterface;
}
