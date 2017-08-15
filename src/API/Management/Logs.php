<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class Logs extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Logs/get_logs_by_id
     *
     * @param string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        $response = $this->httpClient->get(sprintf('/logs/%s', $id));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Logs/get_logs
     *
     * @param array $params
     *
     * @return mixed
     */
    public function search($params = [])
    {
        $response = $this->httpClient->get('/logs?', http_build_query($params));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
