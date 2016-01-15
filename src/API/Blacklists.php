<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Blacklists {

    protected $apiClient;

    public function __construct(ApiClient $apiClient) {
        $this->apiClient = $apiClient;
    }

    public function getAll($aud) {

        return $this->apiClient->get()
            ->blacklists()
            ->token()
            ->withParam('aud', $aud)
            ->call();
    }

    public function blacklist($aud, $jti) {

        $response = $this->apiClient->post()
            ->blacklists()
            ->token()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode([
              'aud' => $aud, 
              'jti' => $jti
            ]))
            ->call();

        return $response;
    }
}