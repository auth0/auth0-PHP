<?php

namespace Auth0\SDK\API\Management\DeviceCredentials;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\DeviceCredentials\Requests\ListDeviceCredentialsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\DeviceCredential;
use Auth0\SDK\API\Management\Core\Pagination\OffsetPager;
use Auth0\SDK\API\Management\Types\ListDeviceCredentialsOffsetPaginatedResponseContent;
use Auth0\SDK\API\Management\DeviceCredentials\Requests\CreatePublicKeyDeviceCredentialRequestContent;
use Auth0\SDK\API\Management\Types\CreatePublicKeyDeviceCredentialResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class DeviceCredentialsClient implements DeviceCredentialsClientInterface
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
     * Retrieve device credential information (`public_key`, `refresh_token`, or `rotating_refresh_token`) associated with a specific user.
     *
     * @param ListDeviceCredentialsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<DeviceCredential>
     */
    public function list(ListDeviceCredentialsRequestParameters $request = new ListDeviceCredentialsRequestParameters(), ?array $options = null): Pager
    {
        return new OffsetPager(
            request: $request,
            getNextPage: fn (ListDeviceCredentialsRequestParameters $request) => $this->_list($request, $options),
            /* @phpstan-ignore-next-line */
            getOffset: fn (ListDeviceCredentialsRequestParameters $request) => $request?->getPage() ?? 0,
            setOffset: function (ListDeviceCredentialsRequestParameters $request, int $offset) {
                $request->setPage($offset);
            },
            /* @phpstan-ignore-next-line */
            getStep: fn (ListDeviceCredentialsRequestParameters $request) => $request?->getPerPage() ?? 0,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListDeviceCredentialsOffsetPaginatedResponseContent $response) => $response?->getDeviceCredentials() ?? [],
            /* @phpstan-ignore-next-line */
            hasNextPage: null,
        );
    }

    /**
     * Create a device credential public key to manage refresh token rotation for a given `user_id`. Device Credentials APIs are designed for ad-hoc administrative use only and paging is by default enabled for GET requests.
     *
     * When refresh token rotation is enabled, the endpoint becomes consistent. For more information, read [Signing Keys](https://auth0.com/docs/get-started/tenant-settings/signing-keys).
     *
     * @param CreatePublicKeyDeviceCredentialRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreatePublicKeyDeviceCredentialResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function createPublicKey(CreatePublicKeyDeviceCredentialRequestContent $request, ?array $options = null): ?CreatePublicKeyDeviceCredentialResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "device-credentials",
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
                return CreatePublicKeyDeviceCredentialResponseContent::fromJson($json);
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
     * Permanently delete a device credential (such as a refresh token or public key) with the given ID.
     *
     * @param string $id ID of the credential to delete.
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
                    path: "device-credentials/{$id}",
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
     * Retrieve device credential information (`public_key`, `refresh_token`, or `rotating_refresh_token`) associated with a specific user.
     *
     * @param ListDeviceCredentialsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListDeviceCredentialsOffsetPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListDeviceCredentialsRequestParameters $request = new ListDeviceCredentialsRequestParameters(), ?array $options = null): ?ListDeviceCredentialsOffsetPaginatedResponseContent
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
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        if ($request->getUserId() != null) {
            $query['user_id'] = $request->getUserId();
        }
        if ($request->getClientId() != null) {
            $query['client_id'] = $request->getClientId();
        }
        if ($request->getType() != null) {
            $query['type'] = $request->getType();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "device-credentials",
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
                return ListDeviceCredentialsOffsetPaginatedResponseContent::fromJson($json);
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
