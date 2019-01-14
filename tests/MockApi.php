<?php
namespace Auth0\Tests;

use Auth0\SDK\API\Management;
use Auth0\SDK\API\Management\Blacklists as BL;
use Auth0\SDK\API\Management\Clients as Cl;
use Auth0\SDK\API\Management\ClientGrants as CG;
use Auth0\SDK\API\Management\Connections as Co;
use Auth0\SDK\API\Management\DeviceCredentials as DC;
use Auth0\SDK\API\Management\Emails as Em;
use Auth0\SDK\API\Management\EmailTemplates as ET;
use Auth0\SDK\API\Management\Jobs as J;
use Auth0\SDK\API\Management\Logs as L;
use Auth0\SDK\API\Management\ResourceServers as RS;
use Auth0\SDK\API\Management\Rules as R;
use Auth0\SDK\API\Management\Stats as S;
use Auth0\SDK\API\Management\Tenants as Te;
use Auth0\SDK\API\Management\Tickets as Ti;
use Auth0\SDK\API\Management\UserBlocks as UB;
use Auth0\SDK\API\Management\Users as U;
use Auth0\SDK\API\Management\UsersByEmail as UE;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;

/**
 * Class MockApi
 *
 * @package Auth0\Tests
 */
class MockApi
{

    /**
     * Domain to use for the mock API.
     */
    const API_DOMAIN = 'api.test.local';

    /**
     * Base API URL for the mock API.
     */
    const API_BASE_URL = 'https://api.test.local/api/v2/';

    /**
     * Dummy API token to use on mock requests.
     */
    const API_TOKEN = '__api_token__';

    /**
     * Guzzle request history container for mock API.
     *
     * @var array
     */
    protected $requestHistory = [];

    /**
     * Management API object.
     *
     * @var Management
     */
    protected $client;

    /**
     * Management API endpoint name.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * MockApi constructor.
     *
     * @param string $endpoint  Endpoint property name to call.
     * @param array  $responses Responses to be loaded, an array of Response objects.
     */
    public function __construct($endpoint, array $responses = [])
    {
        $guzzleOptions = [];
        if (count( $responses )) {
            $mock    = new MockHandler($responses);
            $handler = HandlerStack::create($mock);
            $handler->push( Middleware::history($this->requestHistory) );
            $guzzleOptions['handler'] = $handler;
        }

        $this->client   = new Management(self::API_TOKEN, self::API_DOMAIN, $guzzleOptions, 'object');
        $this->endpoint = $endpoint;
    }

    /**
     * Return the endpoint being used.
     *
     * @return BL | Cl | CG | Co | DC | Em | ET | J | L | R | RS | S | Te | Ti | UB | U | UE
     */
    public function call()
    {
        return $this->client->{$this->endpoint};
    }

    /**
     * Get the URL from a mocked request.
     *
     * @param integer $index           History index to get.
     * @param integer $parse_component Component for parse_url, null to return complete URL.
     *
     * @return string
     */
    public function getHistoryUrl($index = 0, $parse_component = null)
    {
        $request     = $this->getHistory( $index );
        $request_url = $request->getUri()->__toString();
        return is_null( $parse_component ) ? $request_url : parse_url( $request_url, $parse_component );
    }

    /**
     * Get the URL query from a mocked request.
     *
     * @param integer $index History index to get.
     *
     * @return string
     */
    public function getHistoryQuery($index = 0)
    {
        return $this->getHistoryUrl( $index, PHP_URL_QUERY );
    }

    /**
     * Get the HTTP method from a mocked request.
     *
     * @param integer $index History index to get.
     *
     * @return string
     */
    public function getHistoryMethod($index = 0)
    {
        return $this->getHistory($index)->getMethod();
    }

    /**
     * Get the body from a mocked request.
     *
     * @param integer $index History index to get.
     *
     * @return \stdClass|array
     */
    public function getHistoryBody($index = 0)
    {
        $body = $this->getHistory($index)->getBody();
        return json_decode( $body, true );
    }

    /**
     * Get a Guzzle history record from an array populated by Middleware::history().
     *
     * @param integer $index History index to get.
     *
     * @return Request
     */
    protected function getHistory($index = 0)
    {
        return $this->requestHistory[$index]['request'];
    }
}
