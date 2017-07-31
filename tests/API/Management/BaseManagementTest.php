<?php

namespace auth0\tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;
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
    protected function getManagementApi($httpClient)
    {
        return new Management(
            'token', 'domain.com', new HttpMethodsClient($httpClient, MessageFactoryDiscovery::find())
        );
    }

    /**
     * @return Response
     */
    protected function createResponse($body = null, $httpStatus = 200, $headers = [])
    {
        if (!isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
        }

        return new Response($httpStatus, $headers, $body);
    }
}
