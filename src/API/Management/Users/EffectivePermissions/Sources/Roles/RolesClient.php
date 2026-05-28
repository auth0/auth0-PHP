<?php

namespace Auth0\SDK\API\Management\Users\EffectivePermissions\Sources\Roles;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Users\EffectivePermissions\Sources\Roles\Requests\ListUserEffectivePermissionRoleSourceRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserEffectivePermissionRoleSourceResponseContent;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListUserEffectivePermissionRoleSourcesResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

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
     * Lists the roles which grant the user a given permission, including roles assigned directly to the user and those inherited through group memberships.
     *
     * @param string $id ID of the user to retrieve the permissions for.
     * @param ListUserEffectivePermissionRoleSourceRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserEffectivePermissionRoleSourceResponseContent>
     */
    public function list(string $id, ListUserEffectivePermissionRoleSourceRequestParameters $request, ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListUserEffectivePermissionRoleSourceRequestParameters $request) => $this->_list($id, $request, $options),
            setCursor: function (ListUserEffectivePermissionRoleSourceRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListUserEffectivePermissionRoleSourcesResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListUserEffectivePermissionRoleSourcesResponseContent $response) => $response?->getRoles() ?? [],
        );
    }

    /**
     * Lists the roles which grant the user a given permission, including roles assigned directly to the user and those inherited through group memberships.
     *
     * @param string $id ID of the user to retrieve the permissions for.
     * @param ListUserEffectivePermissionRoleSourceRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListUserEffectivePermissionRoleSourcesResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(string $id, ListUserEffectivePermissionRoleSourceRequestParameters $request, ?array $options = null): ?ListUserEffectivePermissionRoleSourcesResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['resource_server_identifier'] = $request->getResourceServerIdentifier();
        $query['permission_name'] = $request->getPermissionName();
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
                    path: "users/{$id}/effective-permissions/sources/effective-roles",
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
                return ListUserEffectivePermissionRoleSourcesResponseContent::fromJson($json);
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
