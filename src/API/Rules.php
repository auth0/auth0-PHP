<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Rules {

    protected $apiClient;

    public function __construct(ApiClient $apiClient) {
        $this->apiClient = $apiClient;
    }

    public function getAll($enabled = null, $fields = null, $include_fields = null) {

        $request = $this->apiClient->get()
            ->rules();

        if ($enabled !== null) {
            $request->withParam('enabled', $enabled);
        }
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
            ->rules($id);

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
            ->rules($id)
            ->call();
    }

    public function create($data) {

        $info = $this->apiClient->post()
            ->rules()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();

        return $info;
    }

    public function update($id, $data) {

        $info = $this->apiClient->patch()
            ->rules($id)
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();

        return $info;
    }
}