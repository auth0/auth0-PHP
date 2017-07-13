<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class Rules extends GenericResource
{
    /**
     * @param null|string       $enabled
     * @param null|string|array $fields
     * @param null|string|array $includeFields
     *
     * @return mixed
     */
    public function getAll($enabled = null, $fields = null, $includeFields = null)
    {
        $queryParams = [];
        if ($enabled !== null) {
            $queryParams['enabled'] = $enabled;
        }

        if ($fields !== null) {
            if (is_array($fields)) {
                $fields = implode(',', $fields);
            }
            $queryParams['fields'] = $fields;
        }

        if ($includeFields !== null) {
            $queryParams['include_fields'] = $includeFields;
        }

        $query = '';
        if (!empty($queryParams)) {
            $query = '?'.http_build_query($queryParams);
        }
        $response = $this->httpClient->get('/rules'.$query);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string            $id
     * @param null|string|array $fields
     * @param null|string|array $includeFields
     *
     * @return mixed
     */
    public function get($id, $fields = null, $includeFields = null)
    {
        $queryParams = [];
        if ($fields !== null) {
            if (is_array($fields)) {
                $fields = implode(',', $fields);
            }
            $queryParams['fields'] = $fields;
        }

        if ($includeFields !== null) {
            $queryParams['include_fields'] = $includeFields;
        }

        $query = '';
        if (!empty($queryParams)) {
            $query = '?'.http_build_query($queryParams);
        }
        $response = $this->httpClient->get('/rules/'.$id.$query);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete(sprintf('/rules/%s', $id));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->httpClient->post('/rules', [], json_encode($data));

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
        $response = $this->httpClient->patch('/rules/'.$id, [], json_encode($data));

        return ResponseMediator::getContent($response);
    }
}
