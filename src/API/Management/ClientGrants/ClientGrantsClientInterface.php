<?php

namespace Auth0\SDK\API\Management\ClientGrants;

use Auth0\SDK\API\Management\ClientGrants\Requests\ListClientGrantsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ClientGrantResponseContent;
use Auth0\SDK\API\Management\ClientGrants\Requests\CreateClientGrantRequestContent;
use Auth0\SDK\API\Management\Types\CreateClientGrantResponseContent;
use Auth0\SDK\API\Management\ClientGrants\Requests\SearchClientGrantsRequestParameters;
use Auth0\SDK\API\Management\Types\GetClientGrantResponseContent;
use Auth0\SDK\API\Management\ClientGrants\Requests\UpdateClientGrantRequestContent;
use Auth0\SDK\API\Management\Types\UpdateClientGrantResponseContent;
use Auth0\SDK\API\Management\ClientGrants\Organizations\OrganizationsClientInterface;

interface ClientGrantsClientInterface
{
    /**
     * Retrieve a list of [client grants](https://auth0.com/docs/get-started/applications/application-access-to-apis-client-grants), including the scopes associated with the application/API pair.
     *
     * Example:
     * ```php
     * $client->clientGrants->list(
     *     new ListClientGrantsRequestParameters([
     *         'includeTotals' => true,
     *         'from' => 'from',
     *         'take' => 1,
     *         'audience' => 'audience',
     *         'clientId' => 'client_id',
     *         'allowAnyOrganization' => true,
     *         'subjectType' => ClientGrantSubjectTypeEnum::Client->value,
     *         'defaultFor' => ClientGrantDefaultForEnum::ThirdPartyClients->value,
     *     ]),
     * );
     * ```
     *
     * @param ListClientGrantsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ClientGrantResponseContent>
     */
    public function list(ListClientGrantsRequestParameters $request = new ListClientGrantsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a client grant for a machine-to-machine login flow. To learn more, read [Client Credential Flow](https://www.auth0.com/docs/get-started/authentication-and-authorization-flow/client-credentials-flow).
     *
     * Example:
     * ```php
     * $client->clientGrants->create(
     *     new CreateClientGrantRequestContent([
     *         'audience' => 'audience',
     *     ]),
     * );
     * ```
     *
     * @param CreateClientGrantRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateClientGrantResponseContent
     */
    public function create(CreateClientGrantRequestContent $request, ?array $options = null): ?CreateClientGrantResponseContent;

    /**
     * Search client grants using SCIM or Lucene filter syntax with low-latency, eventually consistent results. Use the parser parameter to specify "scim" or "lucene" syntax (default: "lucene"). This endpoint provides an alternative to the standard GET /client-grants endpoint with better performance for complex queries.
     * Results may not reflect recent updates immediately.
     *
     * Example:
     * ```php
     * $client->clientGrants->search(
     *     new SearchClientGrantsRequestParameters([
     *         'q' => 'q',
     *         'parser' => SearchParserEnum::Scim->value,
     *         'fields' => 'fields',
     *         'includeFields' => true,
     *         'take' => 1,
     *         'from' => 'from',
     *         'sort' => ClientGrantSortFieldEnum::Audience->value,
     *     ]),
     * );
     * ```
     *
     * @param SearchClientGrantsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ClientGrantResponseContent>
     */
    public function search(SearchClientGrantsRequestParameters $request = new SearchClientGrantsRequestParameters(), ?array $options = null): Pager;

    /**
     * Retrieve a single [client grant](https://auth0.com/docs/get-started/applications/application-access-to-apis-client-grants), including the
     * scopes associated with the application/API pair.
     *
     * Example:
     * ```php
     * $client->clientGrants->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the client grant to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetClientGrantResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetClientGrantResponseContent;

    /**
     * Delete the [Client Credential Flow](https://www.auth0.com/docs/get-started/authentication-and-authorization-flow/client-credentials-flow) from your machine-to-machine application.
     *
     * Example:
     * ```php
     * $client->clientGrants->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the client grant to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;

    /**
     * Update a client grant.
     *
     * Example:
     * ```php
     * $client->clientGrants->update(
     *     'id',
     *     new UpdateClientGrantRequestContent([]),
     * );
     * ```
     *
     * @param string $id ID of the client grant to update.
     * @param UpdateClientGrantRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateClientGrantResponseContent
     */
    public function update(string $id, UpdateClientGrantRequestContent $request = new UpdateClientGrantRequestContent(), ?array $options = null): ?UpdateClientGrantResponseContent;

    /**
     * @return OrganizationsClientInterface
     */
    public function getOrganizations(): OrganizationsClientInterface;
}
