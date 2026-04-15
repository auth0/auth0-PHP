<?php

namespace Auth0\SDK\API\Management\Organizations\Members;

use Auth0\SDK\API\Management\Organizations\Members\Roles\RolesClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Organizations\Members\Requests\ListOrganizationMembersRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationMember;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListOrganizationMembersPaginatedResponseContent;
use Auth0\SDK\API\Management\Organizations\Members\Requests\CreateOrganizationMemberRequestContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Organizations\Members\Requests\DeleteOrganizationMembersRequestContent;
use Auth0\SDK\API\Management\Organizations\Members\Roles\RolesClientInterface;
use JsonException;

class MembersClient implements MembersClientInterface
{
    /**
     * @var RolesClient $roles
     */
    public RolesClient $roles;

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
        $this->roles = new RolesClient($this->client, $this->options);
    }

    /**
     * List organization members.
     * This endpoint is subject to eventual consistency. New users may not be immediately included in the response and deleted users may not be immediately removed from it.
     *
     * <ul>
     *   <li>
     *     Use the <code>fields</code> parameter to optionally define the specific member details retrieved. If <code>fields</code> is left blank, all fields (except roles) are returned.
     *   </li>
     *   <li>
     *     Member roles are not sent by default. Use <code>fields=roles</code> to retrieve the roles assigned to each listed member. To use this parameter, you must include the <code>read:organization_member_roles</code> scope in the token.
     *   </li>
     * </ul>
     *
     * This endpoint supports two types of pagination:
     *
     * - Offset pagination
     * - Checkpoint pagination
     *
     * Checkpoint pagination must be used if you need to retrieve more than 1000 organization members.
     *
     * <h2>Checkpoint Pagination</h2>
     *
     * To search by checkpoint, use the following parameters: - from: Optional id from which to start selection. - take: The total amount of entries to retrieve when using the from parameter. Defaults to 50. Note: The first time you call this endpoint using Checkpoint Pagination, you should omit the <code>from</code> parameter. If there are more results, a <code>next</code> value will be included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, this indicates there are no more pages remaining.
     *
     * @param string $id Organization identifier.
     * @param ListOrganizationMembersRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationMember>
     */
    public function list(string $id, ListOrganizationMembersRequestParameters $request = new ListOrganizationMembersRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListOrganizationMembersRequestParameters $request) => $this->_list($id, $request, $options),
            setCursor: function (ListOrganizationMembersRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListOrganizationMembersPaginatedResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListOrganizationMembersPaginatedResponseContent $response) => $response?->getMembers() ?? [],
        );
    }

    /**
     * Set one or more existing users as members of a specific <a href="https://auth0.com/docs/manage-users/organizations">Organization</a>.
     *
     * To add a user to an Organization through this action, the user must already exist in your tenant. If a user does not yet exist, you can <a href="https://auth0.com/docs/manage-users/organizations/configure-organizations/invite-members">invite them to create an account</a>, manually create them through the Auth0 Dashboard, or use the Management API.
     *
     * @param string $id Organization identifier.
     * @param CreateOrganizationMemberRequestContent $request
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
    public function create(string $id, CreateOrganizationMemberRequestContent $request, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/members",
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
     * @param string $id Organization identifier.
     * @param DeleteOrganizationMembersRequestContent $request
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
    public function delete(string $id, DeleteOrganizationMembersRequestContent $request, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/members",
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
     * @return RolesClientInterface
     */
    public function getRoles(): RolesClientInterface
    {
        return $this->roles;
    }

    /**
     * List organization members.
     * This endpoint is subject to eventual consistency. New users may not be immediately included in the response and deleted users may not be immediately removed from it.
     *
     * <ul>
     *   <li>
     *     Use the <code>fields</code> parameter to optionally define the specific member details retrieved. If <code>fields</code> is left blank, all fields (except roles) are returned.
     *   </li>
     *   <li>
     *     Member roles are not sent by default. Use <code>fields=roles</code> to retrieve the roles assigned to each listed member. To use this parameter, you must include the <code>read:organization_member_roles</code> scope in the token.
     *   </li>
     * </ul>
     *
     * This endpoint supports two types of pagination:
     *
     * - Offset pagination
     * - Checkpoint pagination
     *
     * Checkpoint pagination must be used if you need to retrieve more than 1000 organization members.
     *
     * <h2>Checkpoint Pagination</h2>
     *
     * To search by checkpoint, use the following parameters: - from: Optional id from which to start selection. - take: The total amount of entries to retrieve when using the from parameter. Defaults to 50. Note: The first time you call this endpoint using Checkpoint Pagination, you should omit the <code>from</code> parameter. If there are more results, a <code>next</code> value will be included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, this indicates there are no more pages remaining.
     *
     * @param string $id Organization identifier.
     * @param ListOrganizationMembersRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListOrganizationMembersPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(string $id, ListOrganizationMembersRequestParameters $request = new ListOrganizationMembersRequestParameters(), ?array $options = null): ?ListOrganizationMembersPaginatedResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
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
                    path: "organizations/{$id}/members",
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
                return ListOrganizationMembersPaginatedResponseContent::fromJson($json);
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
