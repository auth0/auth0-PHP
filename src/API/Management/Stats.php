<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Stats.
 * Handles requests to the Stats endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Stats
 */
class Stats extends GenericResource
{
    /**
     * Get active user count statistics.
     * Required scope: `read:stats`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Stats/get_active_users
     */
    public function getActiveUsers(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('get')
            ->addPath('stats', 'active-users')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get daily statistics from a period of time.
     * Required scope: `read:stats`
     *
     * @param string|null         $from    Optional. Beginning from this date; YYYYMMDD format.
     * @param string|null         $to      Optional. Ending from this date; YYYYMMDD format.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Stats/get_daily
     */
    public function getDaily(
        ?string $from = null,
        ?string $to = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $client = $this->apiClient->method('get')
            ->addPath('stats', 'daily');

        if ($from !== null) {
            $this->validateString($from, 'from');
            $client->withParam('from', $from);
        }

        if ($to !== null) {
            $this->validateString($to, 'to');
            $client->withParam('to', $to);
        }

        return $client->withOptions($options)
            ->call();
    }
}
