<?php

namespace Auth0\SDK\API\Management\UserGrants;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\UserGrants\Requests\ListUserGrantsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserGrant;
use Auth0\SDK\API\Management\Core\Pagination\OffsetPager;
use Auth0\SDK\API\Management\Types\ListUserGrantsOffsetPaginatedResponseContent;
use Auth0\SDK\API\Management\UserGrants\Requests\DeleteUserGrantByUserIdRequestParameters;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Psr\Http\Client\ClientExceptionInterface;
use JsonException;

class UserGrantsClient implements UserGrantsClientInterface
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
     * Retrieve the [grants](https://auth0.com/docs/api-auth/which-oauth-flow-to-use) associated with your account.
     *
     * @param ListUserGrantsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserGrant>
     */
    public function list(ListUserGrantsRequestParameters $request = new ListUserGrantsRequestParameters(), ?array $options = null): Pager
    {
        return new OffsetPager(
            request: $request,
            getNextPage: fn (ListUserGrantsRequestParameters $request) => $this->_list($request, $options),
            /* @phpstan-ignore-next-line */
            getOffset: fn (ListUserGrantsRequestParameters $request) => $request?->getPage() ?? 0,
            setOffset: function (ListUserGrantsRequestParameters $request, int $offset) {
                $request->setPage($offset);
            },
            /* @phpstan-ignore-next-line */
            getStep: fn (ListUserGrantsRequestParameters $request) => $request?->getPerPage() ?? 0,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListUserGrantsOffsetPaginatedResponseContent $response) => $response?->getGrants() ?? [],
            /* @phpstan-ignore-next-line */
            hasNextPage: null,
        );
    }

    /**
     * Delete a grant associated with your account.
     *
     * @param DeleteUserGrantByUserIdRequestParameters $request
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
    public function deleteByUserId(DeleteUserGrantByUserIdRequestParameters $request, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['user_id'] = $request->getUserId();
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "grants",
                    method: HttpMethod::DELETE,
                    query: $query,
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
     * Delete a grant associated with your account.
     *
     * @param string $id ID of the grant to delete.
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
                    path: "grants/{$id}",
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
     * Retrieve the [grants](https://auth0.com/docs/api-auth/which-oauth-flow-to-use) associated with your account.
     *
     * @param ListUserGrantsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListUserGrantsOffsetPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListUserGrantsRequestParameters $request = new ListUserGrantsRequestParameters(), ?array $options = null): ?ListUserGrantsOffsetPaginatedResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getPerPage() != null) {
            $query['per_page'] = $request->getPerPage();
        }
        if ($request->getPage() != null) {
            $query['page'] = $request->getPage();
        }
        if ($request->getIncludeTotals() != null) {
            $query['include_totals'] = $request->getIncludeTotals();
        }
        if ($request->getUserId() != null) {
            $query['user_id'] = $request->getUserId();
        }
        if ($request->getClientId() != null) {
            $query['client_id'] = $request->getClientId();
        }
        if ($request->getAudience() != null) {
            $query['audience'] = $request->getAudience();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "grants",
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
                return ListUserGrantsOffsetPaginatedResponseContent::fromJson($json);
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
