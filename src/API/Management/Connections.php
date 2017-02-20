<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Connections extends GenericResource 
{
    /**
     * @param null|string $strategy
     * @param null|string|array $fields
     * @param null|string|array $include_fields
     * @return mixed
     */
    public function getAll($strategy = null, $fields = null, $include_fields = null) 
    {
        $request = $this->apiClient->get()
                    ->connections();

        if ($strategy !== null) 
        {
            $request->withParam('strategy', $strategy);
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
            ->connections($id);

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
            ->connections($id)
            ->call();
    }

    /**
     * @param string $id
     * @param string $email
     * @return mixed
     */
    public function deleteUser($id, $email) 
    {
        return $this->apiClient->delete()
            ->connections($id)
            ->users()
            ->withParam('email', $email)
            ->call();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data) 
    {
        return $this->apiClient->post()
            ->connections()
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
            ->connections($id)
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }
}