<?php

namespace Auth0\SDK\API\Management\Experimentation\Experiments;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\ListExperimentsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ExperimentListItem;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListExperimentsResponseContent;
use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\CreateExperimentRequestContent;
use Auth0\SDK\API\Management\Types\CreateExperimentResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\GetExperimentResponseContent;
use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\UpdateExperimentRequestParameters;
use Auth0\SDK\API\Management\Types\UpdateExperimentResponseContent;
use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\AdvanceRampRequestContent;
use Auth0\SDK\API\Management\Types\AdvanceRampResponseContent;
use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\UpdateExperimentStatusRequestContent;
use Auth0\SDK\API\Management\Types\UpdateExperimentStatusResponseContent;
use Auth0\SDK\API\Management\Types\ValidateExperimentResponseContent;

class ExperimentsClient implements ExperimentsClientInterface
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
     * Retrieve a paginated list of experiments for the tenant, with optional filters.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->list(
     *     new ListExperimentsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *         'status' => ExperimentStatusEnum::Draft->value,
     *         'authenticationFlow' => 'authentication_flow',
     *         'featureFlagId' => 'feature_flag_id',
     *     ]),
     * );
     * ```
     *
     * @param ListExperimentsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ExperimentListItem>
     */
    public function list(ListExperimentsRequestParameters $request = new ListExperimentsRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListExperimentsRequestParameters $request) => $this->_list($request, $options),
            setCursor: function (ListExperimentsRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListExperimentsResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListExperimentsResponseContent $response) => $response?->getExperiments() ?? [],
        );
    }

    /**
     * Create a new experiment for A/B testing.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->create(
     *     new CreateExperimentRequestContent([
     *         'name' => 'name',
     *         'featureFlagId' => 'feature_flag_id',
     *         'authenticationFlow' => AuthenticationFlowEnum::Authentication->value,
     *     ]),
     * );
     * ```
     *
     * @param CreateExperimentRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateExperimentResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateExperimentRequestContent $request, ?array $options = null): ?CreateExperimentResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/experiments",
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
                return CreateExperimentResponseContent::fromJson($json);
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
     * Retrieve a single experiment with its allocations by ID.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the experiment to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetExperimentResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?GetExperimentResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/experiments/" . RawClient::encodePathParam($id),
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
                return GetExperimentResponseContent::fromJson($json);
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
     * Permanently delete an experiment and its allocations by ID. Active experiments cannot be deleted; pause or complete first. Idempotent: returns 204 even if the experiment does not exist.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the experiment to delete.
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
                    path: "experimentation/experiments/" . RawClient::encodePathParam($id),
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
     * Partially update an experiment by ID. Only provided fields are updated. Providing allocations replaces the entire allocations set.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->update(
     *     'id',
     *     new UpdateExperimentRequestParameters([]),
     * );
     * ```
     *
     * @param string $id The ID of the experiment to update.
     * @param UpdateExperimentRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateExperimentResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateExperimentRequestParameters $request = new UpdateExperimentRequestParameters(), ?array $options = null): ?UpdateExperimentResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/experiments/" . RawClient::encodePathParam($id),
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
                return UpdateExperimentResponseContent::fromJson($json);
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
     * Increments the current ramp index to the requested target level. Up-only: the target must be the immediate next level in the schedule. Idempotent: calling with the current level returns success without writing anything.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->advanceRamp(
     *     'id',
     *     new AdvanceRampRequestContent([
     *         'targetLevel' => 1,
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the experiment to advance.
     * @param AdvanceRampRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AdvanceRampResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function advanceRamp(string $id, AdvanceRampRequestContent $request, ?array $options = null): ?AdvanceRampResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/experiments/" . RawClient::encodePathParam($id) . "/advance-ramp",
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
                return AdvanceRampResponseContent::fromJson($json);
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
     * Transitions an experiment through its lifecycle: draft → active, active → paused, paused → active, active/paused → completed. Activation runs full readiness validation.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->updateStatus(
     *     'id',
     *     new UpdateExperimentStatusRequestContent([
     *         'status' => ExperimentTransitionStatusEnum::Active->value,
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the experiment to transition.
     * @param UpdateExperimentStatusRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateExperimentStatusResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function updateStatus(string $id, UpdateExperimentStatusRequestContent $request, ?array $options = null): ?UpdateExperimentStatusResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/experiments/" . RawClient::encodePathParam($id) . "/status",
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
                return UpdateExperimentStatusResponseContent::fromJson($json);
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
     * Checks whether an experiment is ready to be activated. Returns is_valid boolean and an errors array describing any blockers. Read-only; no state is modified.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->validate(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the experiment to validate.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ValidateExperimentResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function validate(string $id, ?array $options = null): ?ValidateExperimentResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/experiments/" . RawClient::encodePathParam($id) . "/validate",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ValidateExperimentResponseContent::fromJson($json);
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
     * Retrieve a paginated list of experiments for the tenant, with optional filters.
     *
     * @param ListExperimentsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListExperimentsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListExperimentsRequestParameters $request = new ListExperimentsRequestParameters(), ?array $options = null): ?ListExperimentsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        if ($request->getStatus() != null) {
            $query['status'] = $request->getStatus();
        }
        if ($request->getAuthenticationFlow() != null) {
            $query['authentication_flow'] = $request->getAuthenticationFlow();
        }
        if ($request->getFeatureFlagId() != null) {
            $query['feature_flag_id'] = $request->getFeatureFlagId();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "experimentation/experiments",
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
                return ListExperimentsResponseContent::fromJson($json);
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
