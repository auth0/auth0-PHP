<?php

namespace Auth0\SDK\API\Management\Organizations;

use Auth0\SDK\API\Management\Organizations\ClientGrants\ClientGrantsClient;
use Auth0\SDK\API\Management\Organizations\Connections\ConnectionsClient;
use Auth0\SDK\API\Management\Organizations\DiscoveryDomains\DiscoveryDomainsClient;
use Auth0\SDK\API\Management\Organizations\EnabledConnections\EnabledConnectionsClient;
use Auth0\SDK\API\Management\Organizations\Invitations\InvitationsClient;
use Auth0\SDK\API\Management\Organizations\Members\MembersClient;
use Auth0\SDK\API\Management\Organizations\Groups\GroupsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Organizations\Requests\ListOrganizationsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Organization;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListOrganizationsPaginatedResponseContent;
use Auth0\SDK\API\Management\Organizations\Requests\CreateOrganizationRequestContent;
use Auth0\SDK\API\Management\Types\CreateOrganizationResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\GetOrganizationByNameResponseContent;
use Auth0\SDK\API\Management\Types\GetOrganizationResponseContent;
use Auth0\SDK\API\Management\Organizations\Requests\UpdateOrganizationRequestContent;
use Auth0\SDK\API\Management\Types\UpdateOrganizationResponseContent;
use Auth0\SDK\API\Management\Organizations\ClientGrants\ClientGrantsClientInterface;
use Auth0\SDK\API\Management\Organizations\Connections\ConnectionsClientInterface;
use Auth0\SDK\API\Management\Organizations\DiscoveryDomains\DiscoveryDomainsClientInterface;
use Auth0\SDK\API\Management\Organizations\EnabledConnections\EnabledConnectionsClientInterface;
use Auth0\SDK\API\Management\Organizations\Invitations\InvitationsClientInterface;
use Auth0\SDK\API\Management\Organizations\Members\MembersClientInterface;
use Auth0\SDK\API\Management\Organizations\Groups\GroupsClientInterface;

class OrganizationsClient implements OrganizationsClientInterface
{
    /**
     * @var ClientGrantsClient $clientGrants
     */
    public ClientGrantsClient $clientGrants;

    /**
     * @var ConnectionsClient $connections
     */
    public ConnectionsClient $connections;

    /**
     * @var DiscoveryDomainsClient $discoveryDomains
     */
    public DiscoveryDomainsClient $discoveryDomains;

    /**
     * @var EnabledConnectionsClient $enabledConnections
     */
    public EnabledConnectionsClient $enabledConnections;

    /**
     * @var InvitationsClient $invitations
     */
    public InvitationsClient $invitations;

    /**
     * @var MembersClient $members
     */
    public MembersClient $members;

    /**
     * @var GroupsClient $groups
     */
    public GroupsClient $groups;

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
        $this->clientGrants = new ClientGrantsClient($this->client, $this->options);
        $this->connections = new ConnectionsClient($this->client, $this->options);
        $this->discoveryDomains = new DiscoveryDomainsClient($this->client, $this->options);
        $this->enabledConnections = new EnabledConnectionsClient($this->client, $this->options);
        $this->invitations = new InvitationsClient($this->client, $this->options);
        $this->members = new MembersClient($this->client, $this->options);
        $this->groups = new GroupsClient($this->client, $this->options);
    }

    /**
     * Retrieve detailed list of all Organizations available in your tenant. For more information, see Auth0 Organizations.
     *
     * This endpoint supports two types of pagination:
     *
     * - Offset pagination
     * - Checkpoint pagination
     *
     * Checkpoint pagination must be used if you need to retrieve more than 1000 organizations.
     *
     * **Checkpoint Pagination**
     *
     * To search by checkpoint, use the following parameters:
     *
     * - `from`: Optional id from which to start selection.
     * - `take`: The total number of entries to retrieve when using the `from` parameter. Defaults to 50.
     *
     * **Note**: The first time you call this endpoint using checkpoint pagination, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no pages are remaining.
     *
     * @param ListOrganizationsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Organization>
     */
    public function list(ListOrganizationsRequestParameters $request = new ListOrganizationsRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListOrganizationsRequestParameters $request) => $this->_list($request, $options),
            setCursor: function (ListOrganizationsRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListOrganizationsPaginatedResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListOrganizationsPaginatedResponseContent $response) => $response?->getOrganizations() ?? [],
        );
    }

    /**
     * Create a new Organization within your tenant.  To learn more about Organization settings, behavior, and configuration options, review [Create Your First Organization](https://auth0.com/docs/manage-users/organizations/create-first-organization).
     *
     * @param CreateOrganizationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateOrganizationResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateOrganizationRequestContent $request, ?array $options = null): ?CreateOrganizationResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations",
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
                return CreateOrganizationResponseContent::fromJson($json);
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
     * Retrieve details about a single Organization specified by name.
     *
     * @param string $name name of the organization to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationByNameResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function getByName(string $name, ?array $options = null): ?GetOrganizationByNameResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/name/{$name}",
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
                return GetOrganizationByNameResponseContent::fromJson($json);
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
     * Retrieve details about a single Organization specified by ID.
     *
     * @param string $id ID of the organization to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?GetOrganizationResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}",
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
                return GetOrganizationResponseContent::fromJson($json);
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
     * Remove an Organization from your tenant.  This action cannot be undone.
     *
     * **Note**: Members are automatically disassociated from an Organization when it is deleted. However, this action does **not** delete these users from your tenant.
     *
     * @param string $id Organization identifier.
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
                    path: "organizations/{$id}",
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
     * Update the details of a specific [Organization](https://auth0.com/docs/manage-users/organizations/configure-organizations/create-organizations), such as name and display name, branding options, and metadata.
     *
     * @param string $id ID of the organization to update.
     * @param UpdateOrganizationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateOrganizationResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateOrganizationRequestContent $request = new UpdateOrganizationRequestContent(), ?array $options = null): ?UpdateOrganizationResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}",
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
                return UpdateOrganizationResponseContent::fromJson($json);
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
     * @return ClientGrantsClientInterface
     */
    public function getClientGrants(): ClientGrantsClientInterface
    {
        return $this->clientGrants;
    }

    /**
     * @return ConnectionsClientInterface
     */
    public function getConnections(): ConnectionsClientInterface
    {
        return $this->connections;
    }

    /**
     * @return DiscoveryDomainsClientInterface
     */
    public function getDiscoveryDomains(): DiscoveryDomainsClientInterface
    {
        return $this->discoveryDomains;
    }

    /**
     * @return EnabledConnectionsClientInterface
     */
    public function getEnabledConnections(): EnabledConnectionsClientInterface
    {
        return $this->enabledConnections;
    }

    /**
     * @return InvitationsClientInterface
     */
    public function getInvitations(): InvitationsClientInterface
    {
        return $this->invitations;
    }

    /**
     * @return MembersClientInterface
     */
    public function getMembers(): MembersClientInterface
    {
        return $this->members;
    }

    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface
    {
        return $this->groups;
    }

    /**
     * Retrieve detailed list of all Organizations available in your tenant. For more information, see Auth0 Organizations.
     *
     * This endpoint supports two types of pagination:
     *
     * - Offset pagination
     * - Checkpoint pagination
     *
     * Checkpoint pagination must be used if you need to retrieve more than 1000 organizations.
     *
     * **Checkpoint Pagination**
     *
     * To search by checkpoint, use the following parameters:
     *
     * - `from`: Optional id from which to start selection.
     * - `take`: The total number of entries to retrieve when using the `from` parameter. Defaults to 50.
     *
     * **Note**: The first time you call this endpoint using checkpoint pagination, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no pages are remaining.
     *
     * @param ListOrganizationsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListOrganizationsPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListOrganizationsRequestParameters $request = new ListOrganizationsRequestParameters(), ?array $options = null): ?ListOrganizationsPaginatedResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        if ($request->getSort() != null) {
            $query['sort'] = $request->getSort();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations",
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
                return ListOrganizationsPaginatedResponseContent::fromJson($json);
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
