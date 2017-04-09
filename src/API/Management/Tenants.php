<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class Tenants extends GenericResource
{
    /**
     * @param mixed $fields
     * @param mixed $include_fields
     *
     * @return mixed
     */
    public function get($fields = null, $include_fields = null)
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
            $query = '?'.http_build_url($queryParams);
        }
        $response = $this->httpClient->get('/tenants/settings'.$query);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function update($data)
    {
        $response = $this->httpClient->patch('/tenants/settings', [], json_encode($data));

        return ResponseMediator::getContent($response);
    }
}
