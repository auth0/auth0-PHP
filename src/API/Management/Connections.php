<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

final class Connections extends GenericResource
{
    /**
     * @param null|string       $strategy
     * @param null|string|array $fields
     * @param null|string|array $include_fields
     *
     * @return mixed
     */
    public function getAll($strategy = null, $fields = null, $include_fields = null)
    {
        $queryParams = [];
        if ($strategy !== null) {
            $queryParams['strategy'] = $strategy;
        }

        if ($fields !== null) {
            if (is_array($fields)) {
                $fields = implode(',', $fields);
            }
            $queryParams['fields'] = $fields;
        }

        if ($include_fields !== null) {
            $queryParams['include_fields'] = $include_fields;
        }

        $query = '';
        if (!empty($queryParams)) {
            $query = '?'.http_build_query($queryParams);
        }
        $response = $this->httpClient->get('/connections'.$query);

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

        $query = '';
        if (!empty($queryParams)) {
            $query = '?'.http_build_query($queryParams);
        }
        $response = $this->httpClient->get('/connections/'.$id.$query);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete('/connections/'.$id);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $id
     * @param string $email
     *
     * @return mixed
     */
    public function deleteUser($id, $email)
    {
        $response = $this->httpClient->delete(sprintf('/connections/%s?', $id, http_build_query(['email' => $email])));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->httpClient->post('/connections', [], json_encode($data));

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
        $response = $this->httpClient->patch('/connections/'.$id, [], json_encode($data));

        return ResponseMediator::getContent($response);
    }
}
