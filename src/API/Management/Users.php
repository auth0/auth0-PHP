<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class Users extends GenericResource
{
    /**
     * @param string $userId
     *
     * @return array
     */
    public function get($userId)
    {
        $response = $this->httpClient->get(sprintf('/users/%s', $userId));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $userId
     * @param array $data
     *
     * @return array
     */
    public function update($userId, array $data)
    {
        $response = $this->httpClient->patch(sprintf('/users/%s', $userId), [], json_encode($data));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data)
    {
        $response = $this->httpClient->post('/users', [], json_encode($data));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function getAll(array $params = [])
    {
        return $this->search($params);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function search(array $params = [])
    {
        $response = $this->httpClient->get('/users?'.http_build_query($params));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $userId
     *
     * @return array
     */
    public function delete($userId)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s', $userId));

        return ResponseMediator::getContent($response);
    }

    /**
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_identities
     *
     * @param string $userId
     * @param array  $postIdentitiesBody
     *
     * @return array
     */
    public function linkAccount($userId, array $postIdentitiesBody)
    {
        $response = $this->httpClient->post(sprintf('/users/%s/identities', $userId), [], json_encode($postIdentitiesBody));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $userId
     * @param string $provider
     * @param string $identityId
     *
     * @return array
     */
    public function unlinkAccount($userId, $provider, $identityId)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s/identities/%s/%s', $userId, $provider, $identityId));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $userId
     * @param string $deviceId
     *
     * @return array
     */
    public function unlinkDevice($userId, $deviceId)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s/devices/%s', $userId, $deviceId));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $userId
     * @param string $multifactorProvider
     *
     * @return array
     */
    public function deleteMultifactorProvider($userId, $multifactorProvider)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s/multifactor/%s', $userId, $multifactorProvider));

        return ResponseMediator::getContent($response);
    }
}
