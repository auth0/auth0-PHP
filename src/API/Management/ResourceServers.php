<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class ResourceServers extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/get_resource_servers_by_id
     *
     * @param string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        $response = $this->httpClient->get(sprintf('/resource-servers/%s', $id));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/post_resource_servers
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->httpClient->post('/resource-servers', [], json_encode($data));

        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/delete_resource_servers_by_id
     *
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete(sprintf('/resource-servers/%s', $id));

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/patch_resource_servers_by_id
     *
     * @param string $id
     * @param array  $data
     *
     * @return mixed
     */
    public function update($id, $data)
    {
        $response = $this->httpClient->patch(sprintf('/resource-servers/%s', $id), [], json_encode($data));

        // TODO Is this really correct?
        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
