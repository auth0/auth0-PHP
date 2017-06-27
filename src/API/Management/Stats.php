<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class Stats extends GenericResource
{
    /**
     * @return array|string
     */
    public function getActiveUsersCount()
    {
        $response = $this->httpClient->get('/stats/active-users');

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $from
     * @param string $to
     *
     * @return array|string
     */
    public function getDailyStats($from, $to)
    {
        $response = $this->httpClient->get('/stats/daily?'.http_build_query([
          'from' => $from,
          'to' => $to,
        ]));

        return ResponseMediator::getContent($response);
    }
}
