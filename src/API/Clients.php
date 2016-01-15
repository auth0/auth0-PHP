<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Clients {

    protected $apiClient;

    public function __construct(ApiClient $apiClient) {
        $this->apiClient = $apiClient;
    }

    public function getAll($fields = null, $include_fields = null) {

        $request = $this->apiClient->get()
            ->clients();

        if ($fields !== null) {
            if (is_array($fields)) {
                $fields = implode(',', $fields);
            }
            $request->withParam('fields', $fields);
        }
        if ($include_fields !== null) {
            $request->withParam('include_fields', $include_fields);
        }

        $info = $request->call();

        return $info;
    }

    public function get($id, $fields = null, $include_fields = null) {

        $request = $this->apiClient->get()
            ->clients($id);

        if ($fields !== null) {
            if (is_array($fields)) {
                $fields = implode(',', $fields);
            }
            $request->withParam('fields', $fields);
        }
        if ($include_fields !== null) {
            $request->withParam('include_fields', $include_fields);
        }

        $info = $request->call();

        return $info;
    }

    public function delete($id) {

        $request = $this->apiClient->delete()
            ->clients($id)
            ->call();
    }

    public function create($data) {

        $info = $this->apiClient->post()
            ->clients()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();

        return $info;
    }

    public function update($data) {

        $info = $this->apiClient->patch()
            ->clients()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();

        return $info;
    }
}