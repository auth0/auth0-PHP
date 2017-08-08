<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;
use Auth0\SDK\Exception\ApiException;

final class Users extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_users_by_id
     *
     * @param string $userId
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function get($userId)
    {
        $response = $this->httpClient->get(sprintf('/users/%s', $userId));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Users/patch_users_by_id
     *
     * @param string $userId
     * @param array $data
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function update($userId, array $data)
    {
        $response = $this->httpClient->patch(sprintf('/users/%s', $userId), [], json_encode($data));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_users
     *
     * @param array $data
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function create(array $data)
    {
        $response = $this->httpClient->post('/users', [], json_encode($data));

        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_users
     *
     * @param array $params
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function getAll(array $params = [])
    {
        return $this->search($params);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_users
     *
     * @param array $params
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function search(array $params = [])
    {
        $response = $this->httpClient->get('/users?'.http_build_query($params));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_users_by_id
     *
     * @param string $userId
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function delete($userId)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s', $userId));

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_identities
     *
     * @param string $userId
     * @param array  $identities
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function linkAccount($userId, array $identities)
    {
        $response = $this->httpClient->post(sprintf('/users/%s/identities', $userId), [], json_encode($identities));

        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_provider_by_user_id
     *
     * @param string $userId
     * @param string $provider
     * @param string $identityId
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function unlinkAccount($userId, $provider, $identityId)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s/identities/%s/%s', $userId, $provider, $identityId));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_multifactor_by_provider
     *
     * @param string $userId
     * @param string $multifactorProvider
     *
     * @throws ApiException On invalid responses
     *
     * @return array
     */
    public function deleteMultifactorProvider($userId, $multifactorProvider)
    {
        $response = $this->httpClient->delete(sprintf('/users/%s/multifactor/%s', $userId, $multifactorProvider));

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
