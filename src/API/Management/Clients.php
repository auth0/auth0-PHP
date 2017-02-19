<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Clients extends GenericResource 
{
    /**
     * @param null|string|array $fields
     * @param null|string|array $include_fields
     * @return mixed
     */
    public function getAll($fields = null, $include_fields = null) 
    {
        $request = $this->apiClient->get()
            ->clients();

        if ($fields !== null) 
        {
            if (is_array($fields)) 
            {
                $fields = implode(',', $fields);
            }
            $request->withParam('fields', $fields);
        }

        if ($include_fields !== null) 
        {
            $request->withParam('include_fields', $include_fields);
        }

        return $request->call();
    }

    /**
     * @param string $id
     * @param null|string|array $fields
     * @param null|string|array $include_fields
     * @return mixed
     */
    public function get($id, $fields = null, $include_fields = null) 
    {
        $request = $this->apiClient->get()
            ->clients($id);

        if ($fields !== null) 
        {
            if (is_array($fields)) 
            {
                $fields = implode(',', $fields);
            }
            $request->withParam('fields', $fields);
        }
        if ($include_fields !== null) 
        {
            $request->withParam('include_fields', $include_fields);
        }

        return $request->call();
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function delete($id) 
    {
        return $this->apiClient->delete()
            ->clients($id)
            ->call();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data) 
    {
        return $this->apiClient->post()
            ->clients()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data) 
    {
        return $this->apiClient->patch()
            ->clients($id)
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }
}