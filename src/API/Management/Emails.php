<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class Emails extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Emails/get_provider
     *
     * @param null|string|array $fields
     * @param null|string|array $includeFields
     *
     * @return mixed
     */
    public function getEmailProvider($fields = null, $includeFields = null)
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
        $response = $this->httpClient->get('/emails/provider'.$query);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Emails/post_provider
     *
     * @param array $data
     *
     * @return mixed
     */
    public function configureEmailProvider($data)
    {
        $response = $this->httpClient->post('/emails/provider', [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Emails/patch_provider
     *
     * @param array $data
     *
     * @return mixed
     */
    public function updateEmailProvider($data)
    {
        $response = $this->httpClient->patch('/emails/provider', [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Emails/delete_provider
     *
     * @return mixed
     */
    public function deleteEmailProvider()
    {
        $response = $this->httpClient->delete('/emails/provider');

        // TODO verify with Auth0 team that this is correct
        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
