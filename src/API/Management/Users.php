<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Users extends GenericResource {

    public function get($user_id) {

        return $this->apiClient->get()
            ->users($user_id)
            ->call();
    }

    public function update($user_id, $data) {
        return $this->apiClient->patch()
            ->users($user_id)
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }

    public function create($data) {

        return $this->apiClient->post()
            ->users()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }

    public function getAll($params = array()) {
        return $this->search($params);
    }

    public function search($params = array()) {

        $client = $this->apiClient->get()
            ->users();

        foreach ($params as $param => $value) {
            $client->withParam($param, $value);
        }

        return $client->call();
    }

    public function delete($user_id) {

        return $this->apiClient->delete()
            ->users($user_id)
            ->call();
    }

    public function linkAccount($user_id, $post_identities_body) {

        return $this->apiClient->post()
            ->users($user_id)
            ->identities()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($post_identities_body))
            ->call();
    }

    public function unlinkAccount($user_id, $provider, $identity_id) {

        return $this->apiClient->delete()
            ->users($user_id)
            ->identities($provider)
            ->addPathVariable($identity_id)
            ->call();
    }

    public function unlinkDevice($user_id, $device_id) {
        return $this->apiClient->delete()
            ->users($user_id)
            ->devices($device_id)
            ->call();
    }

    public function deleteMultifactorProvider($user_id, $multifactor_provider) {
        return $this->apiClient->delete()
            ->users($user_id)
            ->multifactor($multifactor_provider)
            ->call();
    }
}