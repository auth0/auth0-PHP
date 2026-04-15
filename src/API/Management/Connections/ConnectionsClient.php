<?php

namespace Auth0\SDK\API\Management\Connections;

use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\DirectoryProvisioningClient;
use Auth0\SDK\API\Management\Connections\ScimConfiguration\ScimConfigurationClient;
use Auth0\SDK\API\Management\Connections\Clients\ClientsClient;
use Auth0\SDK\API\Management\Connections\Keys\KeysClient;
use Auth0\SDK\API\Management\Connections\Users\UsersClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Connections\Requests\ListConnectionsQueryParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ConnectionForList;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListConnectionsCheckpointPaginatedResponseContent;
use Auth0\SDK\API\Management\Connections\Requests\CreateConnectionRequestContent;
use Auth0\SDK\API\Management\Types\CreateConnectionResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Connections\Requests\GetConnectionRequestParameters;
use Auth0\SDK\API\Management\Types\GetConnectionResponseContent;
use Auth0\SDK\API\Management\Connections\Requests\UpdateConnectionRequestContent;
use Auth0\SDK\API\Management\Types\UpdateConnectionResponseContent;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\DirectoryProvisioningClientInterface;
use Auth0\SDK\API\Management\Connections\ScimConfiguration\ScimConfigurationClientInterface;
use Auth0\SDK\API\Management\Connections\Clients\ClientsClientInterface;
use Auth0\SDK\API\Management\Connections\Keys\KeysClientInterface;
use Auth0\SDK\API\Management\Connections\Users\UsersClientInterface;

class ConnectionsClient implements ConnectionsClientInterface
{
    /**
     * @var DirectoryProvisioningClient $directoryProvisioning
     */
    public DirectoryProvisioningClient $directoryProvisioning;

    /**
     * @var ScimConfigurationClient $scimConfiguration
     */
    public ScimConfigurationClient $scimConfiguration;

    /**
     * @var ClientsClient $clients
     */
    public ClientsClient $clients;

    /**
     * @var KeysClient $keys
     */
    public KeysClient $keys;

    /**
     * @var UsersClient $users
     */
    public UsersClient $users;

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
        $this->directoryProvisioning = new DirectoryProvisioningClient($this->client, $this->options);
        $this->scimConfiguration = new ScimConfigurationClient($this->client, $this->options);
        $this->clients = new ClientsClient($this->client, $this->options);
        $this->keys = new KeysClient($this->client, $this->options);
        $this->users = new UsersClient($this->client, $this->options);
    }

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
    public function list(ListConnectionsQueryParameters $request = new ListConnectionsQueryParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListConnectionsQueryParameters $request) => $this->_list($request, $options),
            setCursor: function (ListConnectionsQueryParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListConnectionsCheckpointPaginatedResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListConnectionsCheckpointPaginatedResponseContent $response) => $response?->getConnections() ?? [],
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateConnectionRequestContent $request, ?array $options = null): ?CreateConnectionResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections",
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
                return CreateConnectionResponseContent::fromJson($json);
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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, GetConnectionRequestParameters $request = new GetConnectionRequestParameters(), ?array $options = null): ?GetConnectionResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetConnectionResponseContent::fromJson($json);
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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function delete(string $id, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}",
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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateConnectionRequestContent $request = new UpdateConnectionRequestContent(), ?array $options = null): ?UpdateConnectionResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}",
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
                return UpdateConnectionResponseContent::fromJson($json);
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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function checkStatus(string $id, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}/status",
                    method: HttpMethod::GET,
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
     * @return DirectoryProvisioningClientInterface
     */
    public function getDirectoryProvisioning(): DirectoryProvisioningClientInterface
    {
        return $this->directoryProvisioning;
    }

    /**
     * @return ScimConfigurationClientInterface
     */
    public function getScimConfiguration(): ScimConfigurationClientInterface
    {
        return $this->scimConfiguration;
    }

    /**
     * @return ClientsClientInterface
     */
    public function getClients(): ClientsClientInterface
    {
        return $this->clients;
    }

    /**
     * @return KeysClientInterface
     */
    public function getKeys(): KeysClientInterface
    {
        return $this->keys;
    }

    /**
     * @return UsersClientInterface
     */
    public function getUsers(): UsersClientInterface
    {
        return $this->users;
    }

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
     * @return ?ListConnectionsCheckpointPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListConnectionsQueryParameters $request = new ListConnectionsQueryParameters(), ?array $options = null): ?ListConnectionsCheckpointPaginatedResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        if ($request->getStrategy() != null) {
            $query['strategy'] = $request->getStrategy();
        }
        if ($request->getName() != null) {
            $query['name'] = $request->getName();
        }
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListConnectionsCheckpointPaginatedResponseContent::fromJson($json);
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
