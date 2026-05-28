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
     * For more information, read [Applications in Auth0](https://www.auth0.com/docs/get-started/applications) and [Single Sign-On](https://www.auth0.com/docs/authenticate/single-sign-on).
     *
     * - The following can be retrieved with any scope:
     *     `client_id`, `app_type`, `name`, and `description`.
     * - The following properties can only be retrieved with the `read:clients` or
     *     `read:client_keys` scope:
     *     `callbacks`, `oidc_logout`, `allowed_origins`,
     *     `web_origins`, `tenant`, `global`, `config_route`,
     *     `callback_url_template`, `jwt_configuration`,
     *     `jwt_configuration.lifetime_in_seconds`, `jwt_configuration.secret_encoded`,
     *     `jwt_configuration.scopes`, `jwt_configuration.alg`, `api_type`,
     *     `logo_uri`, `allowed_clients`, `owners`, `custom_login_page`,
     *     `custom_login_page_off`, `sso`, `addons`, `form_template`,
     *     `custom_login_page_codeview`, `resource_servers`, `client_metadata`,
     *     `mobile`, `mobile.android`, `mobile.ios`, `allowed_logout_urls`,
     *     `token_endpoint_auth_method`, `is_first_party`, `oidc_conformant`,
     *     `is_token_endpoint_ip_header_trusted`, `initiate_login_uri`, `grant_types`,
     *     `refresh_token`, `refresh_token.rotation_type`, `refresh_token.expiration_type`,
     *     `refresh_token.leeway`, `refresh_token.token_lifetime`, `refresh_token.policies`, `organization_usage`,
     *     `organization_require_behavior`.
     * - The following properties can only be retrieved with the
     *     `read:client_keys` or `read:client_credentials` scope:
     *     `encryption_key`, `encryption_key.pub`, `encryption_key.cert`,
     *     `client_secret`, `client_authentication_methods` and `signing_key`.
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
     * Create a new client (application or SSO integration). For more information, read [Create Applications](https://www.auth0.com/docs/get-started/auth0-overview/create-applications)
     * [API Endpoints for Single Sign-On](https://www.auth0.com/docs/authenticate/single-sign-on/api-endpoints-for-single-sign-on).
     *
     * Notes:
     * - We recommend leaving the `client_secret` parameter unspecified to allow the generation of a safe secret.
     * - The `client_authentication_methods` and `token_endpoint_auth_method` properties are mutually exclusive. Use
     * `client_authentication_methods` to configure the client with Private Key JWT authentication method. Otherwise, use `token_endpoint_auth_method`
     * to configure the client with client secret (basic or post) or with no authentication method (none).
     * - When using `client_authentication_methods` to configure the client with Private Key JWT authentication method, specify fully defined credentials.
     * These credentials will be automatically enabled for Private Key JWT authentication on the client.
     * - To configure `client_authentication_methods`, the `create:client_credentials` scope is required.
     * - To configure `client_authentication_methods`, the property `jwt_configuration.alg` must be set to RS256.
     *
     * SSO Integrations created via this endpoint will accept login requests and share user profile information.
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
     * Idempotent registration for Client ID Metadata Document (CIMD) clients.
     * Uses external_client_id as the unique identifier for upsert operations.
     *
     * <strong>Create:</strong> Returns 201 when a new client is created (requires <code>create:clients</code> scope).
     * <strong>Update:</strong> Returns 200 when an existing client is updated (requires <code>update:clients</code> scope).
     *
     * This endpoint automatically:
     * <ul>
     *   <li>Fetches and validates the metadata document</li>
     *   <li>Maps CIMD fields to Auth0 client configuration</li>
     *   <li>Creates/rotates credentials from the JWKS</li>
     *   <li>Enforces CIMD security policies (HTTPS-only, no shared secrets)</li>
     * </ul>
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
     * For more information, read [Applications in Auth0](https://www.auth0.com/docs/get-started/applications) and [Single Sign-On](https://www.auth0.com/docs/authenticate/single-sign-on).
     *
     * - The following properties can be retrieved with any of the scopes:
     *     `client_id`, `app_type`, `name`, and `description`.
     * - The following properties can only be retrieved with the `read:clients` or
     *     `read:client_keys` scopes:
     *     `callbacks`, `oidc_logout`, `allowed_origins`,
     *     `web_origins`, `tenant`, `global`, `config_route`,
     *     `callback_url_template`, `jwt_configuration`,
     *     `jwt_configuration.lifetime_in_seconds`, `jwt_configuration.secret_encoded`,
     *     `jwt_configuration.scopes`, `jwt_configuration.alg`, `api_type`,
     *     `logo_uri`, `allowed_clients`, `owners`, `custom_login_page`,
     *     `custom_login_page_off`, `sso`, `addons`, `form_template`,
     *     `custom_login_page_codeview`, `resource_servers`, `client_metadata`,
     *     `mobile`, `mobile.android`, `mobile.ios`, `allowed_logout_urls`,
     *     `token_endpoint_auth_method`, `is_first_party`, `oidc_conformant`,
     *     `is_token_endpoint_ip_header_trusted`, `initiate_login_uri`, `grant_types`,
     *     `refresh_token`, `refresh_token.rotation_type`, `refresh_token.expiration_type`,
     *     `refresh_token.leeway`, `refresh_token.token_lifetime`, `refresh_token.policies`, `organization_usage`,
     *     `organization_require_behavior`.
     * - The following properties can only be retrieved with the `read:client_keys` or `read:client_credentials` scopes:
     *     `encryption_key`, `encryption_key.pub`, `encryption_key.cert`,
     *     `client_secret`, `client_authentication_methods` and `signing_key`.
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
     * Updates a client's settings. For more information, read [Applications in Auth0](https://www.auth0.com/docs/get-started/applications) and [Single Sign-On](https://www.auth0.com/docs/authenticate/single-sign-on).
     *
     * Notes:
     * - The `client_secret` and `signing_key` attributes can only be updated with the `update:client_keys` scope.
     * - The `client_authentication_methods` and `token_endpoint_auth_method` properties are mutually exclusive. Use `client_authentication_methods` to configure the client with Private Key JWT authentication method. Otherwise, use `token_endpoint_auth_method` to configure the client with client secret (basic or post) or with no authentication method (none).
     * - When using `client_authentication_methods` to configure the client with Private Key JWT authentication method, only specify the credential IDs that were generated when creating the credentials on the client.
     * - To configure `client_authentication_methods`, the `update:client_credentials` scope is required.
     * - To configure `client_authentication_methods`, the property `jwt_configuration.alg` must be set to RS256.
     * - To change a client's `is_first_party` property to `false`, the `organization_usage` and `organization_require_behavior` properties must be unset.
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
     * For more information, read [Rotate Client Secrets](https://www.auth0.com/docs/get-started/applications/rotate-client-secret).
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
