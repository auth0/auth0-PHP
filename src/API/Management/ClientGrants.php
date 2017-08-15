<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class ClientGrants extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     *
     * @param string|null $audience
     *
     * @return array|string
     */
    public function get($audience = null)
    {
        $query = '';
        if ($audience !== null) {
            $query = '?'.http_build_query(['audience' => $audience]);
        }

        $response = $this->httpClient->get('/client-grants'.$query);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/post_client_grants
     *
     * @param string $clientId
     * @param string $audience
     * @param string $scope
     *
     * @return mixed
     */
    public function create($clientId, $audience, $scope)
    {
        $response = $this->httpClient->post('/client-grants', [], json_encode([
            'client_id' => $clientId,
            'audience'  => $audience,
            'scope'     => $scope,
        ]));

        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/delete_client_grants_by_id
     *
     * @param string $id
     *
     * @return array|string
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete('/client-grants/'.$id);

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/patch_client_grants_by_id
     *
     * @param string $id
     * @param string $scope
     *
     * @return array|string
     */
    public function update($id, $scope)
    {
        $response = $this->httpClient->patch('/client-grants/'.$id, [], json_encode([
            'scope' => $scope,
        ]));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
