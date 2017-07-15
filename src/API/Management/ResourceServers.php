<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

final class ResourceServers extends GenericResource
{
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        $response = $this->httpClient->get(sprintf('/resource-servers/%s', $id));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->httpClient->post('/resource-servers', [], json_encode($data));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete(sprintf('/resource-servers/%s', $id));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $id
     * @param array  $data
     *
     * @return mixed
     */
    public function update($id, $data)
    {
        $response = $this->httpClient->patch(sprintf('/resource-servers/%s', $id), [], json_encode($data));

        return ResponseMediator::getContent($response);
    }
}
