<?php

namespace Auth0\SDK\API\Management\Experimentation\FeatureFlags;

use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Variations\VariationsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests\ListFeatureFlagsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\FeatureFlag;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListFeatureFlagsResponseContent;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests\CreateFeatureFlagRequestContent;
use Auth0\SDK\API\Management\Types\CreateFeatureFlagResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\GetFeatureFlagResponseContent;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests\UpdateFeatureFlagRequestContent;
use Auth0\SDK\API\Management\Types\UpdateFeatureFlagResponseContent;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests\UpdateFeatureFlagStatusRequestContent;
use Auth0\SDK\API\Management\Types\UpdateFeatureFlagStatusResponseContent;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\Variations\VariationsClientInterface;

class FeatureFlagsClient implements FeatureFlagsClientInterface
{
    /**
     * @var VariationsClient $variations
     */
    public VariationsClient $variations;

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
        $this->variations = new VariationsClient($this->client, $this->options);
    }

    /**
     * Retrieve a paginated list of feature flags for the tenant.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->list(
     *     new ListFeatureFlagsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *         'type' => FeatureFlagTypeEnum::Auth0->value,
     *         'status' => FeatureFlagStatusEnum::Draft->value,
     *     ]),
     * );
     * ```
     *
     * @param ListFeatureFlagsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<FeatureFlag>
     */
    public function list(ListFeatureFlagsRequestParameters $request = new ListFeatureFlagsRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListFeatureFlagsRequestParameters $request) => $this->_list($request, $options),
            setCursor: function (ListFeatureFlagsRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListFeatureFlagsResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListFeatureFlagsResponseContent $response) => $response?->getFeatureFlags() ?? [],
        );
    }

    /**
     * Create a new feature flag with parameters for use in experiments.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->create(
     *     new CreateFeatureFlagRequestContent([
     *         'name' => 'name',
     *         'parameters' => [],
     *     ]),
     * );
     * ```
     *
     * @param CreateFeatureFlagRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateFeatureFlagResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateFeatureFlagRequestContent $request, ?array $options = null): ?CreateFeatureFlagResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/feature-flags",
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
                return CreateFeatureFlagResponseContent::fromJson($json);
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
     * Retrieve a single feature flag by its ID.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the feature flag to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetFeatureFlagResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?GetFeatureFlagResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/feature-flags/" . RawClient::encodePathParam($id),
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
                return GetFeatureFlagResponseContent::fromJson($json);
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
     * Delete a feature flag by ID. Idempotent: returns 204 even if flag does not exist.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the feature flag to delete.
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
                    path: "experimentation/feature-flags/" . RawClient::encodePathParam($id),
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
     * Partially update a feature flag by ID. Only provided fields are updated.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->update(
     *     'id',
     *     new UpdateFeatureFlagRequestContent([]),
     * );
     * ```
     *
     * @param string $id The ID of the feature flag to update.
     * @param UpdateFeatureFlagRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateFeatureFlagResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateFeatureFlagRequestContent $request = new UpdateFeatureFlagRequestContent(), ?array $options = null): ?UpdateFeatureFlagResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/feature-flags/" . RawClient::encodePathParam($id),
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
                return UpdateFeatureFlagResponseContent::fromJson($json);
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
     * Transitions a feature flag through its lifecycle states: draft → active, draft → archived, active → archived.
     *
     * Example:
     * ```php
     * $client->experimentation->featureFlags->updateStatus(
     *     'id',
     *     new UpdateFeatureFlagStatusRequestContent([
     *         'status' => FeatureFlagStatusEnum::Draft->value,
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the feature flag to transition.
     * @param UpdateFeatureFlagStatusRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateFeatureFlagStatusResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function updateStatus(string $id, UpdateFeatureFlagStatusRequestContent $request, ?array $options = null): ?UpdateFeatureFlagStatusResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/feature-flags/" . RawClient::encodePathParam($id) . "/status",
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
                return UpdateFeatureFlagStatusResponseContent::fromJson($json);
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
     * @return VariationsClientInterface
     */
    public function getVariations(): VariationsClientInterface
    {
        return $this->variations;
    }

    /**
     * Retrieve a paginated list of feature flags for the tenant.
     *
     * @param ListFeatureFlagsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListFeatureFlagsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListFeatureFlagsRequestParameters $request = new ListFeatureFlagsRequestParameters(), ?array $options = null): ?ListFeatureFlagsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        if ($request->getType() != null) {
            $query['type'] = $request->getType();
        }
        if ($request->getStatus() != null) {
            $query['status'] = $request->getStatus();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/feature-flags",
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
                return ListFeatureFlagsResponseContent::fromJson($json);
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
