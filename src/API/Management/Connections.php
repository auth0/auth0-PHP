<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class Connections extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Connections/get_connections
     *
     * @param null|string       $strategy
     * @param null|string|array $fields
     * @param null|string|array $includeFields
     *
     * @return mixed
     */
    public function getAll($strategy = null, $fields = null, $includeFields = null)
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

        if ($includeFields !== null) {
            $queryParams['include_fields'] = $includeFields;
        }

        $query = '';
        if (!empty($queryParams)) {
            $query = '?'.http_build_query($queryParams);
        }
        $response = $this->httpClient->get('/connections'.$query);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Connections/get_connections_by_id
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
        $response = $this->httpClient->get('/connections/'.$id.$query);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Connections/delete_connections_by_id
     *
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete('/connections/'.$id);

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Connections/delete_users_by_email
     *
     * @param string $id
     * @param string $email
     *
     * @return mixed
     */
    public function deleteUser($id, $email)
    {
        $response = $this->httpClient->delete(sprintf('/connections/%s?', $id, http_build_query(['email' => $email])));

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Connections/post_connections
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->httpClient->post('/connections', [], json_encode($data));

        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @https://auth0.com/docs/api/management/v2#!/Connections/patch_connections_by_id
     *
     * @param string $id
     * @param array  $data
     *
     * @return mixed
     */
    public function update($id, $data)
    {
        $response = $this->httpClient->patch('/connections/'.$id, [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
