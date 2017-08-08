<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class Stats extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Stats/get_active_users
     *
     * @return array|string
     */
    public function getActiveUsersCount()
    {
        $response = $this->httpClient->get('/stats/active-users');

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Stats/get_daily
     *
     * @param string $from
     * @param string $to
     *
     * @return array|string
     */
    public function getDailyStats($from, $to)
    {
        $response = $this->httpClient->get('/stats/daily?'.http_build_query([
          'from' => $from,
          'to'   => $to,
        ]));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
