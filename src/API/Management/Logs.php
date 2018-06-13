<?php

namespace Auth0\SDK\API\Management;

class Logs extends GenericResource
{
    /**
     * @param string $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->apiClient->get()
        ->logs($id)
        ->call();
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function search($params = array())
    {

        $client = $this->apiClient->get()
        ->logs();

        foreach ($params as $param => $value) {
            $client->withParam($param, $value);
        }

        return $client->call();
    }
}
