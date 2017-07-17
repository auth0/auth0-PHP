<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

final class UserBlocks extends GenericResource
{
    /**
     * @param string $userId
     *
     * @return mixed
     */
    public function get($userId)
    {
        $response = $this->httpClient->get('/user-blocks/'.$userId);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $identifier
     *
     * @return mixed
     */
    public function getByIdentifier($identifier)
    {
        $response = $this->httpClient->get('/user-blocks?'.http_build_query(['identifier' => $identifier]));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $userId
     *
     * @return mixed
     */
    public function unblock($userId)
    {
        $response = $this->httpClient->delete('/user-blocks/'.$userId);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $identifier
     *
     * @return mixed
     */
    public function unblockByIdentifier($identifier)
    {
        $response = $this->httpClient->delete('/user-blocks?'.http_build_query(['identifier' => $identifier]));

        return ResponseMediator::getContent($response);
    }
}
