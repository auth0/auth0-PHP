<?php
namespace Auth0\Tests\API\Management;

use Auth0\Tests\MockApi;

use Auth0\SDK\API\Management;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

/**
 * Class MockManagementApi
 *
 * @package Auth0\Tests\API\Management
 */
class MockManagementApi extends MockApi
{

    /**
     * Management API object.
     *
     * @var Management
     */
    protected $client;

    /**
     * MockManagementApi constructor.
     *
     * @param array $responses Responses to be loaded, an array of GuzzleHttp\Psr7\Response objects.
     */
    public function __construct(array $responses = [])
    {
        $guzzleOptions = [];
        if (count( $responses )) {
            $mock    = new MockHandler($responses);
            $handler = HandlerStack::create($mock);
            $handler->push( Middleware::history($this->requestHistory) );
            $guzzleOptions['handler'] = $handler;
        }

        $this->client = new Management('__api_token__', 'api.test.local', $guzzleOptions, 'object');
    }
}
