<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Rules extends GenericResource 
{
    /**
     * @param null|string $enabled
     * @param null|string|array $fields
     * @param null|string|array $include_fields
     * @return mixed
     */
    public function getAll($enabled = null, $fields = null, $include_fields = null) 
    {
        $request = $this->apiClient->get()
            ->rules();

        if ($enabled !== null) 
        {
            $request->withParam('enabled', $enabled);
        }

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
            ->rules($id);

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

        $info = $request->call();

        return $info;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function delete($id) 
    {
       return $this->apiClient->delete()
            ->rules($id)
            ->call();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data) 
    {
        return $this->apiClient->post()
            ->rules()
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
            ->rules($id)
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }
}