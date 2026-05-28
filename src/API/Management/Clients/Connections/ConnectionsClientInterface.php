<?php

namespace Auth0\SDK\API\Management\Clients\Connections;

use Auth0\SDK\API\Management\Clients\Connections\Requests\ConnectionsGetRequest;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ConnectionForList;

interface ConnectionsClientInterface
{
    /**
     * Retrieve all connections that are enabled for the specified [Application](https://www.auth0.com/docs/get-started/applications), using checkpoint pagination. A list of fields to include or exclude for each connection may also be specified.
     *
     * - This endpoint requires the `read:connections` scope and any one of `read:clients` or `read:client_summary`.
     * - **Note**: The first time you call this endpoint, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no further results are remaining.
     *
     * @param string $id ID of the client for which to retrieve enabled connections.
     * @param ConnectionsGetRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ConnectionForList>
     */
    public function get(string $id, ConnectionsGetRequest $request = new ConnectionsGetRequest(), ?array $options = null): Pager;
}
