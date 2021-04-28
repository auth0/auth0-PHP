<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Stats.
 * Handles requests to the Stats endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Stats
 *
 * @package Auth0\SDK\API\Management
 */
class Stats extends GenericResource
{
    /**
     * Get active user count statistics.
     * Required scope: `read:stats`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Stats/get_active_users
     */
    public function getActiveUsersCount(
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('stats', 'active-users')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get daily statistics from a period of time.
     * Required scope: `read:stats`
     *
     * @param string              $from    Beginning from this timestamp.
     * @param string              $to      Ending from this timestamp.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Stats/get_daily
     */
    public function getDailyStats(
        string $from,
        string $to,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('stats', 'daily')
            ->withParam('from', $from)
            ->withParam('to', $to)
            ->withOptions($options)
            ->call();
    }
}
