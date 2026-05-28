<?php

namespace Auth0\SDK\API\Management\Users\EffectivePermissions;

use Auth0\SDK\API\Management\Users\EffectivePermissions\Sources\SourcesClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Users\EffectivePermissions\Requests\ListUserEffectivePermissionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserEffectivePermissionResponseContent;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListUserEffectivePermissionsResponseContent;
use Auth0\SDK\API\Management\Users\EffectivePermissions\Sources\SourcesClientInterface;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class EffectivePermissionsClient implements EffectivePermissionsClientInterface
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
     * Returns the list of effective permissions for a user, taking into account permissions granted directly to the user, as well as those inherited through roles and group memberships.
     *
     * @param string $id ID of the user to retrieve the permissions for.
     * @param ListUserEffectivePermissionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserEffectivePermissionResponseContent>
     */
    public function list(string $id, ListUserEffectivePermissionsRequestParameters $request, ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListUserEffectivePermissionsRequestParameters $request) => $this->_list($id, $request, $options),
            setCursor: function (ListUserEffectivePermissionsRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListUserEffectivePermissionsResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListUserEffectivePermissionsResponseContent $response) => $response?->getPermissions() ?? [],
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
     * Returns the list of effective permissions for a user, taking into account permissions granted directly to the user, as well as those inherited through roles and group memberships.
     *
     * @param string $id ID of the user to retrieve the permissions for.
     * @param ListUserEffectivePermissionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListUserEffectivePermissionsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(string $id, ListUserEffectivePermissionsRequestParameters $request, ?array $options = null): ?ListUserEffectivePermissionsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['resource_server_identifier'] = $request->getResourceServerIdentifier();
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
                    path: "users/{$id}/effective-permissions",
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
                return ListUserEffectivePermissionsResponseContent::fromJson($json);
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
