<?php
namespace Auth0\Tests\API\Authentication;

use Auth0\Tests\MockApi;

use Auth0\SDK\API\Authentication;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

/**
 * Class MockAuthenticationApi
 *
 * @package Auth0\Tests\API\Authentication
 */
class MockAuthenticationApi extends MockApi
{

    /**
     * Authentication API object.
     *
     * @var Authentication
     */
    protected $client;

    /**
     * MockAuthenticationApi constructor.
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

        $this->client = new Authentication(
            'test-domain.auth0.com',
            '__test_client_id__',
            '__test_client_secret__',
            null,
            null,
            $guzzleOptions
        );
    }
}
