<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Rules extends GenericResource 
{
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

    public function delete($id) 
    {
       return $this->apiClient->delete()
            ->rules($id)
            ->call();
    }

    public function create($data) 
    {
        return $this->apiClient->post()
            ->rules()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }

    public function update($id, $data) 
    {
        return $this->apiClient->patch()
            ->rules($id)
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }
}