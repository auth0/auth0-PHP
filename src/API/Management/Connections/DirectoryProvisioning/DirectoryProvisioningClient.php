<?php

namespace Auth0\SDK\API\Management\Connections\DirectoryProvisioning;

use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Synchronizations\SynchronizationsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests\ListDirectoryProvisioningsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\DirectoryProvisioning;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListDirectoryProvisioningsResponseContent;
use Auth0\SDK\API\Management\Types\GetDirectoryProvisioningResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\CreateDirectoryProvisioningRequestContent;
use Auth0\SDK\API\Management\Types\CreateDirectoryProvisioningResponseContent;
use Auth0\SDK\API\Management\Types\UpdateDirectoryProvisioningRequestContent;
use Auth0\SDK\API\Management\Types\UpdateDirectoryProvisioningResponseContent;
use Auth0\SDK\API\Management\Types\GetDirectoryProvisioningDefaultMappingResponseContent;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests\ListSynchronizedGroupsRequestParameters;
use Auth0\SDK\API\Management\Types\SynchronizedGroupPayload;
use Auth0\SDK\API\Management\Types\ListSynchronizedGroupsResponseContent;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests\ReplaceSynchronizedGroupsRequestContent;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Synchronizations\SynchronizationsClientInterface;

class DirectoryProvisioningClient implements DirectoryProvisioningClientInterface
{
    /**
     * @var SynchronizationsClient $synchronizations
     */
    public SynchronizationsClient $synchronizations;

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
        $this->synchronizations = new SynchronizationsClient($this->client, $this->options);
    }

    /**
     * Retrieve a list of directory provisioning configurations of a tenant.
     *
     * @param ListDirectoryProvisioningsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<DirectoryProvisioning>
     */
    public function list(ListDirectoryProvisioningsRequestParameters $request = new ListDirectoryProvisioningsRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListDirectoryProvisioningsRequestParameters $request) => $this->_list($request, $options),
            setCursor: function (ListDirectoryProvisioningsRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListDirectoryProvisioningsResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListDirectoryProvisioningsResponseContent $response) => $response?->getDirectoryProvisionings() ?? [],
        );
    }

    /**
     * Retrieve the directory provisioning configuration of a connection.
     *
     * @param string $id The id of the connection to retrieve its directory provisioning configuration
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetDirectoryProvisioningResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?GetDirectoryProvisioningResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}/directory-provisioning",
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
                return GetDirectoryProvisioningResponseContent::fromJson($json);
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
     * Create a directory provisioning configuration for a connection.
     *
     * @param string $id The id of the connection to create its directory provisioning configuration
     * @param ?CreateDirectoryProvisioningRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateDirectoryProvisioningResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(string $id, ?CreateDirectoryProvisioningRequestContent $request = null, ?array $options = null): ?CreateDirectoryProvisioningResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}/directory-provisioning",
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
                return CreateDirectoryProvisioningResponseContent::fromJson($json);
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
     * Delete the directory provisioning configuration of a connection.
     *
     * @param string $id The id of the connection to delete its directory provisioning configuration
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
                    path: "connections/{$id}/directory-provisioning",
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
     * Update the directory provisioning configuration of a connection.
     *
     * @param string $id The id of the connection to create its directory provisioning configuration
     * @param ?UpdateDirectoryProvisioningRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateDirectoryProvisioningResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, ?UpdateDirectoryProvisioningRequestContent $request = null, ?array $options = null): ?UpdateDirectoryProvisioningResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}/directory-provisioning",
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
                return UpdateDirectoryProvisioningResponseContent::fromJson($json);
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
     * Retrieve the directory provisioning default attribute mapping of a connection.
     *
     * @param string $id The id of the connection to retrieve its directory provisioning configuration
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetDirectoryProvisioningDefaultMappingResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function getDefaultMapping(string $id, ?array $options = null): ?GetDirectoryProvisioningDefaultMappingResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}/directory-provisioning/default-mapping",
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
                return GetDirectoryProvisioningDefaultMappingResponseContent::fromJson($json);
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
     * Retrieve the configured synchronized groups for a connection directory provisioning configuration.
     *
     * @param string $id The id of the connection to list synchronized groups for.
     * @param ListSynchronizedGroupsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<SynchronizedGroupPayload>
     */
    public function listSynchronizedGroups(string $id, ListSynchronizedGroupsRequestParameters $request = new ListSynchronizedGroupsRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListSynchronizedGroupsRequestParameters $request) => $this->_listSynchronizedGroups($id, $request, $options),
            setCursor: function (ListSynchronizedGroupsRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListSynchronizedGroupsResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListSynchronizedGroupsResponseContent $response) => $response?->getGroups() ?? [],
        );
    }

    /**
     * Create or replace the selected groups for a connection directory provisioning configuration.
     *
     * @param string $id The id of the connection to create or replace synchronized groups for
     * @param ReplaceSynchronizedGroupsRequestContent $request
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
    public function set(string $id, ReplaceSynchronizedGroupsRequestContent $request, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}/directory-provisioning/synchronized-groups",
                    method: HttpMethod::PUT,
                    body: $request,
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
     * @return SynchronizationsClientInterface
     */
    public function getSynchronizations(): SynchronizationsClientInterface
    {
        return $this->synchronizations;
    }

    /**
     * Retrieve a list of directory provisioning configurations of a tenant.
     *
     * @param ListDirectoryProvisioningsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListDirectoryProvisioningsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListDirectoryProvisioningsRequestParameters $request = new ListDirectoryProvisioningsRequestParameters(), ?array $options = null): ?ListDirectoryProvisioningsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections-directory-provisionings",
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
                return ListDirectoryProvisioningsResponseContent::fromJson($json);
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
     * Retrieve the configured synchronized groups for a connection directory provisioning configuration.
     *
     * @param string $id The id of the connection to list synchronized groups for.
     * @param ListSynchronizedGroupsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListSynchronizedGroupsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _listSynchronizedGroups(string $id, ListSynchronizedGroupsRequestParameters $request = new ListSynchronizedGroupsRequestParameters(), ?array $options = null): ?ListSynchronizedGroupsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "connections/{$id}/directory-provisioning/synchronized-groups",
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
                return ListSynchronizedGroupsResponseContent::fromJson($json);
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
