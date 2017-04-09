<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class Blacklists extends GenericResource 
{
    /**
     * @param string $aud
     *
     * @return array
     */
    public function getAll($aud) 
    {
        $response = $this->httpClient->get('/blacklist/tokens?'.http_build_query(['aud'=>$aud]));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $aud
     * @param string $jti
     * @return array
     */
    public function blacklist($aud, $jti) 
    {
        $response = $this->httpClient->post('/blacklist/tokens', [], json_encode([
            'aud' => $aud,
            'jti' => $jti
        ]));

        return ResponseMediator::getContent($response);
    }
}