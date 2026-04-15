<?php

namespace Auth0\SDK\API\Management\Users\Logs;

use Auth0\SDK\API\Management\Users\Logs\Requests\ListUserLogsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Log;

interface LogsClientInterface
{
    /**
     * Retrieve log events for a specific user.
     *
     * Note: For more information on all possible event types, their respective acronyms and descriptions, see <a href="https://auth0.com/docs/logs/log-event-type-codes">Log Event Type Codes</a>.
     *
     * For more information on the list of fields that can be used in `sort`, see <a href="https://auth0.com/docs/logs/log-search-query-syntax#searchable-fields">Searchable Fields</a>.
     *
     * Auth0 <a href="https://auth0.com/docs/logs/retrieve-log-events-using-mgmt-api#limitations">limits the number of logs</a> you can return by search criteria to 100 logs per request. Furthermore, you may only paginate through up to 1,000 search results. If you exceed this threshold, please redefine your search.
     *
     * @param string $id ID of the user of the logs to retrieve
     * @param ListUserLogsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Log>
     */
    public function list(string $id, ListUserLogsRequestParameters $request = new ListUserLogsRequestParameters(), ?array $options = null): Pager;
}
