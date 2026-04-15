<?php

namespace Auth0\SDK\API\Management\Connections;

use Auth0\SDK\API\Management\Connections\Requests\ListConnectionsQueryParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ConnectionForList;
use Auth0\SDK\API\Management\Connections\Requests\CreateConnectionRequestContent;
use Auth0\SDK\API\Management\Types\CreateConnectionResponseContent;
use Auth0\SDK\API\Management\Connections\Requests\GetConnectionRequestParameters;
use Auth0\SDK\API\Management\Types\GetConnectionResponseContent;
use Auth0\SDK\API\Management\Connections\Requests\UpdateConnectionRequestContent;
use Auth0\SDK\API\Management\Types\UpdateConnectionResponseContent;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\DirectoryProvisioningClientInterface;
use Auth0\SDK\API\Management\Connections\ScimConfiguration\ScimConfigurationClientInterface;
use Auth0\SDK\API\Management\Connections\Clients\ClientsClientInterface;
use Auth0\SDK\API\Management\Connections\Keys\KeysClientInterface;
use Auth0\SDK\API\Management\Connections\Users\UsersClientInterface;

interface ConnectionsClientInterface
{
    /**
     * Retrieves detailed list of all <a href="https://auth0.com/docs/authenticate/identity-providers">connections</a> that match the specified strategy. If no strategy is provided, all connections within your tenant are retrieved. This action can accept a list of fields to include or exclude from the resulting list of connections.
     *
     * This endpoint supports two types of pagination:
     * <ul>
     * <li>Offset pagination</li>
     * <li>Checkpoint pagination</li>
     * </ul>
     *
     * Checkpoint pagination must be used if you need to retrieve more than 1000 connections.
     *
     * <h2>Checkpoint Pagination</h2>
     *
     * To search by checkpoint, use the following parameters:
     * <ul>
     * <li><code>from</code>: Optional id from which to start selection.</li>
     * <li><code>take</code>: The total amount of entries to retrieve when using the from parameter. Defaults to 50.</li>
     * </ul>
     *
     * <b>Note</b>: The first time you call this endpoint using checkpoint pagination, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no pages are remaining.
     *
     * @param ListConnectionsQueryParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ConnectionForList>
     */
    public function list(ListConnectionsQueryParameters $request = new ListConnectionsQueryParameters(), ?array $options = null): Pager;

    /**
     * Creates a new connection according to the JSON object received in <code>body</code>.
     *
     * <b>Note:</b> If a connection with the same name was recently deleted and had a large number of associated users, the deletion may still be processing. Creating a new connection with that name before the deletion completes may fail or produce unexpected results.
     *
     * @param CreateConnectionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateConnectionResponseContent
     */
    public function create(CreateConnectionRequestContent $request, ?array $options = null): ?CreateConnectionResponseContent;

    /**
     * Retrieve details for a specified <a href="https://auth0.com/docs/authenticate/identity-providers">connection</a> along with options that can be used for identity provider configuration.
     *
     * @param string $id The id of the connection to retrieve
     * @param GetConnectionRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetConnectionResponseContent
     */
    public function get(string $id, GetConnectionRequestParameters $request = new GetConnectionRequestParameters(), ?array $options = null): ?GetConnectionResponseContent;

    /**
     * Removes a specific <a href="https://auth0.com/docs/authenticate/identity-providers">connection</a> from your tenant. This action cannot be undone. Once removed, users can no longer use this connection to authenticate.
     *
     * <b>Note:</b> If your connection has a large amount of users associated with it, please be aware that this operation can be long running after the response is returned and may impact concurrent <a href="https://auth0.com/docs/api/management/v2/connections/post-connections">create connection</a> requests, if they use an identical connection name.
     *
     * @param string $id The id of the connection to delete
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
     * Update details for a specific <a href="https://auth0.com/docs/authenticate/identity-providers">connection</a>, including option properties for identity provider configuration.
     *
     * <b>Note</b>: If you use the <code>options</code> parameter, the entire <code>options</code> object is overriden. To avoid partial data or other issues, ensure all parameters are present when using this option.
     *
     * @param string $id The id of the connection to update
     * @param UpdateConnectionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateConnectionResponseContent
     */
    public function update(string $id, UpdateConnectionRequestContent $request = new UpdateConnectionRequestContent(), ?array $options = null): ?UpdateConnectionResponseContent;

    /**
     * Retrieves the status of an ad/ldap connection referenced by its <code>ID</code>. <code>200 OK</code> http status code response is returned  when the connection is online, otherwise a <code>404</code> status code is returned along with an error message
     *
     * @param string $id ID of the connection to check
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function checkStatus(string $id, ?array $options = null): void;

    /**
     * @return DirectoryProvisioningClientInterface
     */
    public function getDirectoryProvisioning(): DirectoryProvisioningClientInterface;

    /**
     * @return ScimConfigurationClientInterface
     */
    public function getScimConfiguration(): ScimConfigurationClientInterface;

    /**
     * @return ClientsClientInterface
     */
    public function getClients(): ClientsClientInterface;

    /**
     * @return KeysClientInterface
     */
    public function getKeys(): KeysClientInterface;

    /**
     * @return UsersClientInterface
     */
    public function getUsers(): UsersClientInterface;
}
