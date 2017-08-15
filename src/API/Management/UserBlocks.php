<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class UserBlocks extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/User_Blocks/get_user_blocks_by_id
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function get($userId)
    {
        $response = $this->httpClient->get('/user-blocks/'.$userId);

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/User_Blocks/get_user_blocks
     *
     * @param string $identifier
     *
     * @return mixed
     */
    public function getByIdentifier($identifier)
    {
        $response = $this->httpClient->get('/user-blocks?'.http_build_query(['identifier' => $identifier]));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/User_Blocks/delete_user_blocks_by_id
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function unblock($userId)
    {
        $response = $this->httpClient->delete('/user-blocks/'.$userId);

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/User_Blocks/delete_user_blocks
     *
     * @param string $identifier
     *
     * @return mixed
     */
    public function unblockByIdentifier($identifier)
    {
        $response = $this->httpClient->delete('/user-blocks?'.http_build_query(['identifier' => $identifier]));

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
