<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class Users extends GenericResource
{
    public function get($user_id)
    {
        $response = $this->httpClient->get(sprintf('/users/%s', $user_id));

        return ResponseMediator::getContent($response);
    }

    public function update($user_id, $data)
    {
        $response = $this->httpClient->patch(sprintf('/users/%s', $user_id), [], json_encode($data));

        return ResponseMediator::getContent($response);
    }

    public function create($data)
    {
        $response = $this->httpClient->post('/users', [], json_encode($data));

        return ResponseMediator::getContent($response);
    }

    public function getAll($params = array())
    {
        return $this->search($params);
    }

    public function search($params = array())
    {
        $response = $this->httpClient->get('/users?'.http_build_query($params));

        return ResponseMediator::getContent($response);
    }

    public function deleteAll()
    {
        $response = $this->httpClient->delete('/users');

        return ResponseMediator::getContent($response);
    }

    public function delete($user_id)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s', $user_id));

        return ResponseMediator::getContent($response);
    }

    public function linkAccount($user_id, $post_identities_body)
    {
        $response = $this->httpClient->post(sprintf('/users/%s/identities', $user_id), [], json_encode($post_identities_body));

        return ResponseMediator::getContent($response);
    }

    public function unlinkAccount($user_id, $provider, $identity_id)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s/identities/%s/%s', $user_id, $provider, $identity_id));

        return ResponseMediator::getContent($response);
    }

    public function unlinkDevice($user_id, $device_id)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s/devices/%s', $user_id, $device_id));

        return ResponseMediator::getContent($response);
    }

    public function deleteMultifactorProvider($user_id, $multifactor_provider)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s/multifactor/%s', $user_id, $multifactor_provider));

        return ResponseMediator::getContent($response);
    }
}
