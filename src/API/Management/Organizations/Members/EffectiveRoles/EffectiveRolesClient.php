<?php

namespace Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles;

use Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\Sources\SourcesClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\Requests\ListOrganizationMemberEffectiveRolesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationMemberEffectiveRole;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListOrganizationMemberEffectiveRolesResponseContent;
use Auth0\SDK\API\Management\Organizations\Members\EffectiveRoles\Sources\SourcesClientInterface;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class EffectiveRolesClient implements EffectiveRolesClientInterface
{
    /**
     * @var SourcesClient $sources
     */
    public SourcesClient $sources;

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
        $this->sources = new SourcesClient($this->client, $this->options);
    }

    /**
     * Lists the roles assigned to an organization member directly or through group membership.
     *
     * @param string $id Organization identifier.
     * @param string $userId ID of the user to list effective roles for.
     * @param ListOrganizationMemberEffectiveRolesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationMemberEffectiveRole>
     */
    public function list(string $id, string $userId, ListOrganizationMemberEffectiveRolesRequestParameters $request = new ListOrganizationMemberEffectiveRolesRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListOrganizationMemberEffectiveRolesRequestParameters $request) => $this->_list($id, $userId, $request, $options),
            setCursor: function (ListOrganizationMemberEffectiveRolesRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListOrganizationMemberEffectiveRolesResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListOrganizationMemberEffectiveRolesResponseContent $response) => $response?->getRoles() ?? [],
        );
    }

    /**
     * @return SourcesClientInterface
     */
    public function getSources(): SourcesClientInterface
    {
        return $this->sources;
    }

    /**
     * Lists the roles assigned to an organization member directly or through group membership.
     *
     * @param string $id Organization identifier.
     * @param string $userId ID of the user to list effective roles for.
     * @param ListOrganizationMemberEffectiveRolesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListOrganizationMemberEffectiveRolesResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(string $id, string $userId, ListOrganizationMemberEffectiveRolesRequestParameters $request = new ListOrganizationMemberEffectiveRolesRequestParameters(), ?array $options = null): ?ListOrganizationMemberEffectiveRolesResponseContent
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
                    path: "organizations/{$id}/members/{$userId}/effective-roles",
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
                return ListOrganizationMemberEffectiveRolesResponseContent::fromJson($json);
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
