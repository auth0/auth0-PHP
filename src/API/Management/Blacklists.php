<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

final class Blacklists extends GenericResource
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Blacklists/get_tokens
     * @param string $aud
     *
     * @return array
     */
    public function getAll($aud)
    {
        $response = $this->httpClient->get('/blacklists/tokens?'.http_build_query(['aud' => $aud]));

        return ResponseMediator::getContent($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Blacklists/post_tokens
     *
     * @param string $aud
     * @param string $jti
     *
     * @return array
     */
    public function blacklist($aud, $jti)
    {
        $response = $this->httpClient->post('/blacklists/tokens', [], json_encode([
            'aud' => $aud,
            'jti' => $jti,
        ]));

        return ResponseMediator::getContent($response);
    }
}
