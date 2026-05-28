<?php

namespace Auth0\SDK\API\Management\Organizations\Members\Roles;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Organizations\Members\Roles\Requests\ListOrganizationMemberRolesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Role;
use Auth0\SDK\API\Management\Core\Pagination\OffsetPager;
use Auth0\SDK\API\Management\Types\ListOrganizationMemberRolesOffsetPaginatedResponseContent;
use Auth0\SDK\API\Management\Organizations\Members\Roles\Requests\AssignOrganizationMemberRolesRequestContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Organizations\Members\Roles\Requests\DeleteOrganizationMemberRolesRequestContent;
use JsonException;

class RolesClient implements RolesClientInterface
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
     * Retrieve detailed list of roles assigned to a given user within the context of a specific Organization.
     *
     * Users can be members of multiple Organizations with unique roles assigned for each membership. This action only returns the roles associated with the specified Organization; any roles assigned to the user within other Organizations are not included.
     *
     * @param string $id Organization identifier.
     * @param string $userId ID of the user to associate roles with.
     * @param ListOrganizationMemberRolesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Role>
     */
    public function list(string $id, string $userId, ListOrganizationMemberRolesRequestParameters $request = new ListOrganizationMemberRolesRequestParameters(), ?array $options = null): Pager
    {
        return new OffsetPager(
            request: $request,
            getNextPage: fn (ListOrganizationMemberRolesRequestParameters $request) => $this->_list($id, $userId, $request, $options),
            /* @phpstan-ignore-next-line */
            getOffset: fn (ListOrganizationMemberRolesRequestParameters $request) => $request?->getPage() ?? 0,
            setOffset: function (ListOrganizationMemberRolesRequestParameters $request, int $offset) {
                $request->setPage($offset);
            },
            /* @phpstan-ignore-next-line */
            getStep: fn (ListOrganizationMemberRolesRequestParameters $request) => $request?->getPerPage() ?? 0,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListOrganizationMemberRolesOffsetPaginatedResponseContent $response) => $response?->getRoles() ?? [],
            /* @phpstan-ignore-next-line */
            hasNextPage: null,
        );
    }

    /**
     * Assign one or more [roles](https://auth0.com/docs/manage-users/access-control/rbac) to a user to determine their access for a specific Organization.
     *
     * Users can be members of multiple Organizations with unique roles assigned for each membership. This action assigns roles to a user only for the specified Organization. Roles cannot be assigned to a user across multiple Organizations in the same call.
     *
     * @param string $id Organization identifier.
     * @param string $userId ID of the user to associate roles with.
     * @param AssignOrganizationMemberRolesRequestContent $request
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
    public function assign(string $id, string $userId, AssignOrganizationMemberRolesRequestContent $request, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/members/{$userId}/roles",
                    method: HttpMethod::POST,
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
     * Remove one or more Organization-specific [roles](https://auth0.com/docs/manage-users/access-control/rbac) from a given user.
     *
     * Users can be members of multiple Organizations with unique roles assigned for each membership. This action removes roles from a user in relation to the specified Organization. Roles assigned to the user within a different Organization cannot be managed in the same call.
     *
     * @param string $id Organization identifier.
     * @param string $userId User ID of the organization member to remove roles from.
     * @param DeleteOrganizationMemberRolesRequestContent $request
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
    public function delete(string $id, string $userId, DeleteOrganizationMemberRolesRequestContent $request, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/members/{$userId}/roles",
                    method: HttpMethod::DELETE,
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
     * Retrieve detailed list of roles assigned to a given user within the context of a specific Organization.
     *
     * Users can be members of multiple Organizations with unique roles assigned for each membership. This action only returns the roles associated with the specified Organization; any roles assigned to the user within other Organizations are not included.
     *
     * @param string $id Organization identifier.
     * @param string $userId ID of the user to associate roles with.
     * @param ListOrganizationMemberRolesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListOrganizationMemberRolesOffsetPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(string $id, string $userId, ListOrganizationMemberRolesRequestParameters $request = new ListOrganizationMemberRolesRequestParameters(), ?array $options = null): ?ListOrganizationMemberRolesOffsetPaginatedResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getPage() != null) {
            $query['page'] = $request->getPage();
        }
        if ($request->getPerPage() != null) {
            $query['per_page'] = $request->getPerPage();
        }
        if ($request->getIncludeTotals() != null) {
            $query['include_totals'] = $request->getIncludeTotals();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/members/{$userId}/roles",
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
                return ListOrganizationMemberRolesOffsetPaginatedResponseContent::fromJson($json);
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
