<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface LogsInterface.
 */
interface LogsInterface
{
    /**
     * Retrieves log entries that match the specified search criteria (or list all entries if no criteria is used).
     * Required scope: `read:logs`.
     *
     * @param  array<int|string|null>|null  $parameters  Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Logs/get_logs
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve an individual log event.
     * Required scope: `read:logs`.
     *
     * @param  string  $id  log entry ID to get
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Logs/get_logs_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
