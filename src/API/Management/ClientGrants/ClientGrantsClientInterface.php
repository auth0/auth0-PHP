<?php

namespace Auth0\SDK\API\Management\ClientGrants;

use Auth0\SDK\API\Management\ClientGrants\Requests\ListClientGrantsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ClientGrantResponseContent;
use Auth0\SDK\API\Management\ClientGrants\Requests\CreateClientGrantRequestContent;
use Auth0\SDK\API\Management\Types\CreateClientGrantResponseContent;
use Auth0\SDK\API\Management\Types\GetClientGrantResponseContent;
use Auth0\SDK\API\Management\ClientGrants\Requests\UpdateClientGrantRequestContent;
use Auth0\SDK\API\Management\Types\UpdateClientGrantResponseContent;
use Auth0\SDK\API\Management\ClientGrants\Organizations\OrganizationsClientInterface;

interface ClientGrantsClientInterface
{
    /**
     * Retrieve a list of [client grants](https://auth0.com/docs/get-started/applications/application-access-to-apis-client-grants), including the scopes associated with the application/API pair.
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
     * Retrieve a single [client grant](https://auth0.com/docs/get-started/applications/application-access-to-apis-client-grants), including the
     * scopes associated with the application/API pair.
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
