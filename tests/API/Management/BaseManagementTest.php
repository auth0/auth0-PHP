<?php

namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
abstract class BaseManagementTest extends ApiTests
{
    /**
     * @param HttpClient $httpClient
     *
     * @return Management
     */
    protected function getManagementApi(HttpClient $httpClient)
    {
        return new Management(
            'token', 'domain.com', new HttpMethodsClient($httpClient, MessageFactoryDiscovery::find())
        );
    }
}
