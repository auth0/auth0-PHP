<?php

namespace Auth0\SDK\API\Management;

use Http\Client\Common\HttpMethodsClient;

abstract class GenericResource
{
    /**
     * @var HttpMethodsClient
     */
    protected $httpClient;

    /**
     * @param HttpMethodsClient $apiClient
     */
    public function __construct(HttpMethodsClient $apiClient)
    {
        $this->httpClient = $apiClient;
    }
}
