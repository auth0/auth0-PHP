<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

final class Logs extends GenericResource
{
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        $response = $this->httpClient->get(sprintf('/logs/%s', $id));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function search($params = [])
    {
        $response = $this->httpClient->get('/logs?', http_build_query($params));

        return ResponseMediator::getContent($response);
    }
}
