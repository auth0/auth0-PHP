<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class Tenants extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Tenants/get_settings
     *
     * @param mixed $fields
     * @param mixed $includeFields
     *
     * @return mixed
     */
    public function get($fields = null, $includeFields = null)
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
        $response = $this->httpClient->get('/tenants/settings'.$query);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Tenants/patch_settings
     *
     * @param array $data
     *
     * @return mixed
     */
    public function update($data)
    {
        $response = $this->httpClient->patch('/tenants/settings', [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
