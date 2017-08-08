<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;
use Auth0\SDK\Exception\ApiException;

final class Blacklists extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Blacklists/get_tokens
     * @param string $aud
     *
     * @return array
     *
     * @throws ApiException On invalid responses
     */
    public function getAll($aud)
    {
        $response = $this->httpClient->get('/blacklists/tokens?'.http_build_query(['aud' => $aud]));

        if (200 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Blacklists/post_tokens
     *
     * @param string $aud
     * @param string $jti
     *
     * @return array
     *
     * @throws ApiException On invalid responses
     */
    public function blacklist($aud, $jti)
    {
        $response = $this->httpClient->post('/blacklists/tokens', [], json_encode([
            'aud' => $aud,
            'jti' => $jti,
        ]));

        if (204 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
