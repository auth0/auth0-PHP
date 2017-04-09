<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class UserBlocks extends GenericResource
{
    /**
     * @param string $user_id
     *
     * @return mixed
     */
    public function get($user_id)
    {
        $response = $this->httpClient->get('/user-blocks/'.$user_id);

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
     * @param string $user_id
     *
     * @return mixed
     */
    public function unblock($user_id)
    {
        $response = $this->httpClient->delete('/user-blocks/'.$user_id);

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
