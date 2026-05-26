<?php

namespace Auth0\SDK\API\Management\Logs;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Logs\Requests\ListLogsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Log;
use Auth0\SDK\API\Management\Core\Pagination\OffsetPager;
use Auth0\SDK\API\Management\Types\ListLogOffsetPaginatedResponseContent;
use Auth0\SDK\API\Management\Types\GetLogResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class LogsClient implements LogsClientInterface
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
    public function list(ListLogsRequestParameters $request = new ListLogsRequestParameters(), ?array $options = null): Pager
    {
        return new OffsetPager(
            request: $request,
            getNextPage: fn (ListLogsRequestParameters $request) => $this->_list($request, $options),
            /* @phpstan-ignore-next-line */
            getOffset: fn (ListLogsRequestParameters $request) => $request?->getPage() ?? 0,
            setOffset: function (ListLogsRequestParameters $request, int $offset) {
                $request->setPage($offset);
            },
            /* @phpstan-ignore-next-line */
            getStep: fn (ListLogsRequestParameters $request) => $request?->getPerPage() ?? 0,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListLogOffsetPaginatedResponseContent $response) => $response?->getLogs() ?? [],
            /* @phpstan-ignore-next-line */
            hasNextPage: null,
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?GetLogResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "logs/{$id}",
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
                return GetLogResponseContent::fromJson($json);
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
     * @return ?ListLogOffsetPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListLogsRequestParameters $request = new ListLogsRequestParameters(), ?array $options = null): ?ListLogOffsetPaginatedResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getPage() != null) {
            $query['page'] = $request->getPage();
        }
        if ($request->getPerPage() != null) {
            $query['per_page'] = $request->getPerPage();
        }
        if ($request->getSort() != null) {
            $query['sort'] = $request->getSort();
        }
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        if ($request->getIncludeTotals() != null) {
            $query['include_totals'] = $request->getIncludeTotals();
        }
        if ($request->getSearch() != null) {
            $query['search'] = $request->getSearch();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "logs",
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
                return ListLogOffsetPaginatedResponseContent::fromJson($json);
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
