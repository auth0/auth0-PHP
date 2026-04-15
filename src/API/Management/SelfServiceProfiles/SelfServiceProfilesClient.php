<?php

namespace Auth0\SDK\API\Management\SelfServiceProfiles;

use Auth0\SDK\API\Management\SelfServiceProfiles\CustomText\CustomTextClient;
use Auth0\SDK\API\Management\SelfServiceProfiles\SsoTicket\SsoTicketClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\SelfServiceProfiles\Requests\ListSelfServiceProfilesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\SelfServiceProfile;
use Auth0\SDK\API\Management\Core\Pagination\OffsetPager;
use Auth0\SDK\API\Management\Types\ListSelfServiceProfilesPaginatedResponseContent;
use Auth0\SDK\API\Management\SelfServiceProfiles\Requests\CreateSelfServiceProfileRequestContent;
use Auth0\SDK\API\Management\Types\CreateSelfServiceProfileResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\GetSelfServiceProfileResponseContent;
use Auth0\SDK\API\Management\SelfServiceProfiles\Requests\UpdateSelfServiceProfileRequestContent;
use Auth0\SDK\API\Management\Types\UpdateSelfServiceProfileResponseContent;
use Auth0\SDK\API\Management\SelfServiceProfiles\CustomText\CustomTextClientInterface;
use Auth0\SDK\API\Management\SelfServiceProfiles\SsoTicket\SsoTicketClientInterface;

class SelfServiceProfilesClient implements SelfServiceProfilesClientInterface
{
    /**
     * @var CustomTextClient $customText
     */
    public CustomTextClient $customText;

    /**
     * @var SsoTicketClient $ssoTicket
     */
    public SsoTicketClient $ssoTicket;

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
        $this->customText = new CustomTextClient($this->client, $this->options);
        $this->ssoTicket = new SsoTicketClient($this->client, $this->options);
    }

    /**
     * Retrieves self-service profiles.
     *
     * @param ListSelfServiceProfilesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<SelfServiceProfile>
     */
    public function list(ListSelfServiceProfilesRequestParameters $request = new ListSelfServiceProfilesRequestParameters(), ?array $options = null): Pager
    {
        return new OffsetPager(
            request: $request,
            getNextPage: fn (ListSelfServiceProfilesRequestParameters $request) => $this->_list($request, $options),
            /* @phpstan-ignore-next-line */
            getOffset: fn (ListSelfServiceProfilesRequestParameters $request) => $request?->getPage() ?? 0,
            setOffset: function (ListSelfServiceProfilesRequestParameters $request, int $offset) {
                $request->setPage($offset);
            },
            /* @phpstan-ignore-next-line */
            getStep: fn (ListSelfServiceProfilesRequestParameters $request) => $request?->getPerPage() ?? 0,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListSelfServiceProfilesPaginatedResponseContent $response) => $response?->getSelfServiceProfiles() ?? [],
            /* @phpstan-ignore-next-line */
            hasNextPage: null,
        );
    }

    /**
     * Creates a self-service profile.
     *
     * @param CreateSelfServiceProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateSelfServiceProfileResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateSelfServiceProfileRequestContent $request, ?array $options = null): ?CreateSelfServiceProfileResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "self-service-profiles",
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
                return CreateSelfServiceProfileResponseContent::fromJson($json);
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
     * Retrieves a self-service profile by Id.
     *
     * @param string $id The id of the self-service profile to retrieve
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetSelfServiceProfileResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?GetSelfServiceProfileResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "self-service-profiles/{$id}",
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
                return GetSelfServiceProfileResponseContent::fromJson($json);
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
     * Deletes a self-service profile by Id.
     *
     * @param string $id The id of the self-service profile to delete
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
                    path: "self-service-profiles/{$id}",
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
     * Updates a self-service profile.
     *
     * @param string $id The id of the self-service profile to update
     * @param UpdateSelfServiceProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateSelfServiceProfileResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateSelfServiceProfileRequestContent $request = new UpdateSelfServiceProfileRequestContent(), ?array $options = null): ?UpdateSelfServiceProfileResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "self-service-profiles/{$id}",
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
                return UpdateSelfServiceProfileResponseContent::fromJson($json);
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
     * @return CustomTextClientInterface
     */
    public function getCustomText(): CustomTextClientInterface
    {
        return $this->customText;
    }

    /**
     * @return SsoTicketClientInterface
     */
    public function getSsoTicket(): SsoTicketClientInterface
    {
        return $this->ssoTicket;
    }

    /**
     * Retrieves self-service profiles.
     *
     * @param ListSelfServiceProfilesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListSelfServiceProfilesPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListSelfServiceProfilesRequestParameters $request = new ListSelfServiceProfilesRequestParameters(), ?array $options = null): ?ListSelfServiceProfilesPaginatedResponseContent
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
                    path: "self-service-profiles",
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
                return ListSelfServiceProfilesPaginatedResponseContent::fromJson($json);
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
