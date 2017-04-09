<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class Clients extends GenericResource
{
    /**
     * @param null|string|array $fields
     * @param null|string|array $include_fields
     *
     * @return mixed
     */
    public function getAll($fields = null, $include_fields = null)
    {
        $queryParams = [];
        if ($fields !== null) {
            if (is_array($fields)) {
                $fields = implode(',', $fields);
            }
            $queryParams['fields'] = $fields;
        }

        if ($include_fields !== null) {
            $queryParams['include_fields'] = $include_fields;
        }

        $query='';
        if (!empty($queryParams)) {
            $query = '?'.http_build_url($queryParams);
        }
        $response = $this->httpClient->get('/clients'.$query);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string            $id
     * @param null|string|array $fields
     * @param null|string|array $include_fields
     *
     * @return mixed
     */
    public function get($id, $fields = null, $include_fields = null)
    {
        $queryParams = [];
        if ($fields !== null) {
            if (is_array($fields)) {
                $fields = implode(',', $fields);
            }
            $queryParams['fields'] = $fields;
        }

        if ($include_fields !== null) {
            $queryParams['include_fields'] = $include_fields;
        }

        $query='';
        if (!empty($queryParams)) {
            $query = '?'.http_build_url($queryParams);
        }
        $response = $this->httpClient->get('/clients/'.$id.$query);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete('/clients/'.$id);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->httpClient->post('/clients', [], json_encode($data));

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
        $response = $this->httpClient->patch('/clients/'.$id, [], json_encode($data));

        return ResponseMediator::getContent($response);
    }
}
