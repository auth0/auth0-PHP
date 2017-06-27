<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class ClientGrants extends GenericResource
{
    /**
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

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $client_id
     * @param string $audience
     * @param string $scope
     *
     * @return mixed
     */
    public function create($client_id, $audience, $scope)
    {
        $response = $this->httpClient->post('/client-grants', [], json_encode([
            'client_id' => $client_id,
            'audience' => $audience,
            'scope' => $scope,
        ]));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $id
     *
     * @return array|string
     */
    public function delete($id)
    {
        $response = $this->httpClient->delete('/client-grants/'.$id);

        return ResponseMediator::getContent($response);
    }

    /**
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

        return ResponseMediator::getContent($response);
    }
}
