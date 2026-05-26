<?php

namespace Auth0\SDK\API\Management\Logs;

use Auth0\SDK\API\Management\Logs\Requests\ListLogsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Log;
use Auth0\SDK\API\Management\Types\GetLogResponseContent;

interface LogsClientInterface
{
    /**
     * Retrieve log entries that match the specified search criteria (or all log entries if no criteria specified).
     *
     * Set custom search criteria using the `q` parameter, or search from a specific log ID (_"search from checkpoint"_).
     *
     * For more information on all possible event types, their respective acronyms, and descriptions, see [Log Event Type Codes](https://auth0.com/docs/logs/log-event-type-codes).
     *
     * **To set custom search criteria, use the following parameters:**
     *
     * - **q:** Search Criteria using [Query String Syntax](https://auth0.com/docs/logs/log-search-query-syntax)
     * - **page:** Page index of the results to return. First page is 0.
     * - **per_page:** Number of results per page.
     * - **sort:** Field to use for sorting appended with `:1` for ascending and `:-1` for descending. e.g. `date:-1`
     * - **fields:** Comma-separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields.
     * - **include_fields:** Whether specified fields are to be included (true) or excluded (false).
     * - **include_totals:** Return results inside an object that contains the total result count (true) or as a direct array of results (false, default). **Deprecated:** this field is deprecated and should be removed from use. See [Search Engine V3 Breaking Changes](https://auth0.com/docs/product-lifecycle/deprecations-and-migrations/migrate-to-tenant-log-search-v3#pagination)
     *
     * For more information on the list of fields that can be used in `fields` and `sort`, see [Searchable Fields](https://auth0.com/docs/logs/log-search-query-syntax#searchable-fields).
     *
     * Auth0 [limits the number of logs](https://auth0.com/docs/logs/retrieve-log-events-using-mgmt-api#limitations) you can return by search criteria to 100 logs per request. Furthermore, you may paginate only through 1,000 search results. If you exceed this threshold, please redefine your search or use the [get logs by checkpoint method](https://auth0.com/docs/logs/retrieve-log-events-using-mgmt-api#retrieve-logs-by-checkpoint).
     *
     * **To search from a checkpoint log ID, use the following parameters:**
     *
     * - **from:** Log Event ID from which to start retrieving logs. You can limit the number of logs returned using the `take` parameter. If you use `from` at the same time as `q`, `from` takes precedence and `q` is ignored.
     * - **take:** Number of entries to retrieve when using the `from` parameter.
     *
     * **Important:** When fetching logs from a checkpoint log ID, any parameter other than `from` and `take` will be ignored, and date ordering is not guaranteed.
     *
     * @param ListLogsRequestParameters $request
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
    public function list(ListLogsRequestParameters $request = new ListLogsRequestParameters(), ?array $options = null): Pager;

    /**
     * Retrieve an individual log event.
     *
     * @param string $id log_id of the log to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetLogResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetLogResponseContent;
}
