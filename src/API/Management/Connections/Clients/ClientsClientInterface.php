<?php

namespace Auth0\SDK\API\Management\Connections\Clients;

use Auth0\SDK\API\Management\Connections\Clients\Requests\GetConnectionEnabledClientsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ConnectionEnabledClient;
use Auth0\SDK\API\Management\Types\UpdateEnabledClientConnectionsRequestContentItem;

interface ClientsClientInterface
{
    /**
     * Retrieve all clients that have the specified [connection](https://auth0.com/docs/authenticate/identity-providers) enabled.
     *
     * **Note**: The first time you call this endpoint, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no further results are remaining.
     *
     * @param string $id The id of the connection for which enabled clients are to be retrieved
     * @param GetConnectionEnabledClientsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ConnectionEnabledClient>
     */
    public function get(string $id, GetConnectionEnabledClientsRequestParameters $request = new GetConnectionEnabledClientsRequestParameters(), ?array $options = null): Pager;

    /**
     * @param string $id The id of the connection to modify
     * @param array<UpdateEnabledClientConnectionsRequestContentItem> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function update(string $id, array $request, ?array $options = null): void;
}
