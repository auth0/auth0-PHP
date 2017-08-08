<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class Rules extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Rules/get_rules
     *
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

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Rules/get_rules_by_id
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
        $response = $this->httpClient->get('/rules/'.$id.$query);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Rules/delete_rules_by_id
     *
     * @param string $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete(sprintf('/rules/%s', $id));

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Rules/post_rules
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->httpClient->post('/rules', [], json_encode($data));

        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Rules/patch_rules_by_id
     *
     * @param string $id
     * @param array  $data
     *
     * @return mixed
     */
    public function update($id, $data)
    {
        $response = $this->httpClient->patch('/rules/'.$id, [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
