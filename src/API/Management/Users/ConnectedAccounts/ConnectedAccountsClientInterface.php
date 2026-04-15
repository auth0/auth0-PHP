<?php

namespace Auth0\SDK\API\Management\Users\ConnectedAccounts;

use Auth0\SDK\API\Management\Users\ConnectedAccounts\Requests\GetUserConnectedAccountsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ConnectedAccount;

interface ConnectedAccountsClientInterface
{
    /**
     * Retrieve all connected accounts associated with the user.
     *
     * @param string $id ID of the user to list connected accounts for.
     * @param GetUserConnectedAccountsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ConnectedAccount>
     */
    public function list(string $id, GetUserConnectedAccountsRequestParameters $request = new GetUserConnectedAccountsRequestParameters(), ?array $options = null): Pager;
}
