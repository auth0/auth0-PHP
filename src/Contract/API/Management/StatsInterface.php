<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface StatsInterface.
 */
interface StatsInterface
{
    /**
     * Get active user count statistics.
     * Required scope: `read:stats`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Stats/get_active_users
     */
    public function getActiveUsers(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get daily statistics from a period of time.
     * Required scope: `read:stats`.
     *
     * @param  string|null  $from  Optional. Beginning from this date; YYYYMMDD format.
     * @param  string|null  $to  Optional. Ending from this date; YYYYMMDD format.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Stats/get_daily
     */
    public function getDaily(
        ?string $from = null,
        ?string $to = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
