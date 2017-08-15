<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class Clients extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Clients/get_clients
     *
     * @param null|string|array $fields
     * @param null|string|array $includeFields
     *
     * @return mixed
     */
    public function getAll($fields = null, $includeFields = null)
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
        $response = $this->httpClient->get('/clients'.$query);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Clients/get_clients_by_id
     *
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
        $response = $this->httpClient->get('/clients/'.$id.$query);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Clients/delete_clients_by_id
     *
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete('/clients/'.$id);

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Clients/post_clients
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->httpClient->post('/clients', [], json_encode($data));

        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Clients/patch_clients_by_id
     *
     * @param string $id
     * @param array  $data
     *
     * @return mixed
     */
    public function update($id, $data)
    {
        $response = $this->httpClient->patch('/clients/'.$id, [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
