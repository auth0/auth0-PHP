<?php

namespace Auth0\SDK\API\Management\Organizations\DiscoveryDomains;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Organizations\DiscoveryDomains\Requests\ListOrganizationDiscoveryDomainsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationDiscoveryDomain;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListOrganizationDiscoveryDomainsResponseContent;
use Auth0\SDK\API\Management\Organizations\DiscoveryDomains\Requests\CreateOrganizationDiscoveryDomainRequestContent;
use Auth0\SDK\API\Management\Types\CreateOrganizationDiscoveryDomainResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\GetOrganizationDiscoveryDomainByNameResponseContent;
use Auth0\SDK\API\Management\Types\GetOrganizationDiscoveryDomainResponseContent;
use Auth0\SDK\API\Management\Organizations\DiscoveryDomains\Requests\UpdateOrganizationDiscoveryDomainRequestContent;
use Auth0\SDK\API\Management\Types\UpdateOrganizationDiscoveryDomainResponseContent;

class DiscoveryDomainsClient implements DiscoveryDomainsClientInterface
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
     * Retrieve list of all organization discovery domains associated with the specified organization.
     * This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
     *
     * @param string $id ID of the organization.
     * @param ListOrganizationDiscoveryDomainsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationDiscoveryDomain>
     */
    public function list(string $id, ListOrganizationDiscoveryDomainsRequestParameters $request = new ListOrganizationDiscoveryDomainsRequestParameters(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (ListOrganizationDiscoveryDomainsRequestParameters $request) => $this->_list($id, $request, $options),
            setCursor: function (ListOrganizationDiscoveryDomainsRequestParameters $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListOrganizationDiscoveryDomainsResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListOrganizationDiscoveryDomainsResponseContent $response) => $response?->getDomains() ?? [],
        );
    }

    /**
     * Create a new discovery domain for an organization.
     *
     * @param string $id ID of the organization.
     * @param CreateOrganizationDiscoveryDomainRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateOrganizationDiscoveryDomainResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(string $id, CreateOrganizationDiscoveryDomainRequestContent $request, ?array $options = null): ?CreateOrganizationDiscoveryDomainResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/discovery-domains",
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
                return CreateOrganizationDiscoveryDomainResponseContent::fromJson($json);
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
     * Retrieve details about a single organization discovery domain specified by domain name.
     * This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
     *
     * @param string $id ID of the organization.
     * @param string $discoveryDomain Domain name of the discovery domain.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationDiscoveryDomainByNameResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function getByName(string $id, string $discoveryDomain, ?array $options = null): ?GetOrganizationDiscoveryDomainByNameResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/discovery-domains/name/{$discoveryDomain}",
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
                return GetOrganizationDiscoveryDomainByNameResponseContent::fromJson($json);
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
     * Retrieve details about a single organization discovery domain specified by ID.
     * This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
     *
     * @param string $id ID of the organization.
     * @param string $discoveryDomainId ID of the discovery domain.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationDiscoveryDomainResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, string $discoveryDomainId, ?array $options = null): ?GetOrganizationDiscoveryDomainResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/discovery-domains/{$discoveryDomainId}",
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
                return GetOrganizationDiscoveryDomainResponseContent::fromJson($json);
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
     * Remove a discovery domain from an organization. This action cannot be undone.
     *
     * @param string $id ID of the organization.
     * @param string $discoveryDomainId ID of the discovery domain.
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
    public function delete(string $id, string $discoveryDomainId, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/discovery-domains/{$discoveryDomainId}",
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
     * Update the verification status and/or use_for_organization_discovery for an organization discovery domain. The <code>status</code> field must be either <code>pending</code> or <code>verified</code>. The <code>use_for_organization_discovery</code> field can be <code>true</code> or <code>false</code> (default: <code>true</code>).
     *
     * @param string $id ID of the organization.
     * @param string $discoveryDomainId ID of the discovery domain to update.
     * @param UpdateOrganizationDiscoveryDomainRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateOrganizationDiscoveryDomainResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, string $discoveryDomainId, UpdateOrganizationDiscoveryDomainRequestContent $request = new UpdateOrganizationDiscoveryDomainRequestContent(), ?array $options = null): ?UpdateOrganizationDiscoveryDomainResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "organizations/{$id}/discovery-domains/{$discoveryDomainId}",
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
                return UpdateOrganizationDiscoveryDomainResponseContent::fromJson($json);
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
     * Retrieve list of all organization discovery domains associated with the specified organization.
     * This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
     *
     * @param string $id ID of the organization.
     * @param ListOrganizationDiscoveryDomainsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListOrganizationDiscoveryDomainsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(string $id, ListOrganizationDiscoveryDomainsRequestParameters $request = new ListOrganizationDiscoveryDomainsRequestParameters(), ?array $options = null): ?ListOrganizationDiscoveryDomainsResponseContent
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
                    path: "organizations/{$id}/discovery-domains",
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
                return ListOrganizationDiscoveryDomainsResponseContent::fromJson($json);
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
