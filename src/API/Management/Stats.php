<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\StatsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Stats.
 * Handles requests to the Stats endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Stats
 */
final class Stats extends ManagementEndpoint implements StatsInterface
{
    public function getActiveUsers(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('stats', 'active-users')->
            withOptions($options)->
            call();
    }

    public function getDaily(
        ?string $from = null,
        ?string $to = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$from, $to] = Toolkit::filter([$from, $to])->string()->trim();

        $client = $this->getHttpClient()->
            method('get')->
            addPath('stats', 'daily');

        if (null !== $from) {
            Toolkit::assert([
                [$from, \Auth0\SDK\Exception\ArgumentException::missing('from')],
            ])->isString();

            $client->withParam('from', $from);
        }

        if (null !== $to) {
            Toolkit::assert([
                [$to, \Auth0\SDK\Exception\ArgumentException::missing('to')],
            ])->isString();

            $client->withParam('to', $to);
        }

        return $client->
            withOptions($options)->
            call();
    }
}
