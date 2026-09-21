<?php

namespace Auth0\SDK\API\Management\Users\Organizations;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Users\Organizations\Requests\ListUserOrganizationsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Organization;
use Auth0\SDK\API\Management\Core\Pagination\OffsetPager;
use Auth0\SDK\API\Management\Types\ListUserOrganizationsOffsetPaginatedResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class OrganizationsClient implements OrganizationsClientInterface
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
     * Retrieve list of the specified user's current Organization memberships. User must be specified by user ID. For more information, review [Auth0 Organizations](https://auth0.com/docs/manage-users/organizations).
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
     * Example:
     * ```php
     * $client->users->organizations->list(
     *     'id',
     *     new ListUserOrganizationsRequestParameters([
     *         'page' => 1,
     *         'perPage' => 1,
     *         'includeTotals' => true,
     *     ]),
     * );
     * ```
     *
     * @param string $id ID of the user to retrieve the organizations for.
     * @param ListUserOrganizationsRequestParameters $request
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
    public function list(string $id, ListUserOrganizationsRequestParameters $request = new ListUserOrganizationsRequestParameters(), ?array $options = null): Pager
    {
        return new OffsetPager(
            request: $request,
            getNextPage: fn (ListUserOrganizationsRequestParameters $request) => $this->_list($id, $request, $options),
            /* @phpstan-ignore-next-line */
            getOffset: fn (ListUserOrganizationsRequestParameters $request) => $request?->getPage() ?? 0,
            setOffset: function (ListUserOrganizationsRequestParameters $request, int $offset) {
                $request->setPage($offset);
            },
            getStep: null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListUserOrganizationsOffsetPaginatedResponseContent $response) => $response?->getOrganizations() ?? [],
            /* @phpstan-ignore-next-line */
            hasNextPage: null,
        );
    }

    /**
     * Retrieve list of the specified user's current Organization memberships. User must be specified by user ID. For more information, review [Auth0 Organizations](https://auth0.com/docs/manage-users/organizations).
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
     * @param string $id ID of the user to retrieve the organizations for.
     * @param ListUserOrganizationsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListUserOrganizationsOffsetPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(string $id, ListUserOrganizationsRequestParameters $request = new ListUserOrganizationsRequestParameters(), ?array $options = null): ?ListUserOrganizationsOffsetPaginatedResponseContent
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
                    path: "users/" . RawClient::encodePathParam($id) . "/organizations",
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
                return ListUserOrganizationsOffsetPaginatedResponseContent::fromJson($json);
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
