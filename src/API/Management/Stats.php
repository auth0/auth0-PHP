<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Stats.
 * Handles requests to the Stats endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Stats
 */
final class Stats extends ManagementEndpoint
{
    /**
     * Get active user count statistics.
     * Required scope: `read:stats`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Stats/get_active_users
     */
    public function getActiveUsers(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
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
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Stats/get_daily
     */
    public function getDaily(
        ?string $from = null,
        ?string $to = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$from, $to] = Toolkit::filter([$from, $to])->string()->trim();

        $client = $this->getHttpClient()
            ->method('get')
            ->addPath('stats', 'daily');

        if ($from !== null) {
            Toolkit::assert([
                [$from, \Auth0\SDK\Exception\ArgumentException::missing('from')],
            ])->isString();

            $client->withParam('from', $from);
        }

        if ($to !== null) {
            Toolkit::assert([
                [$to, \Auth0\SDK\Exception\ArgumentException::missing('to')],
            ])->isString();

            $client->withParam('to', $to);
        }

        return $client
            ->withOptions($options)
            ->call();
    }
}
