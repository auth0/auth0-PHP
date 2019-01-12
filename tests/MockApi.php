<?php
namespace Auth0\Tests;

use Auth0\SDK\API\Management\Blacklists;
use Auth0\SDK\API\Management\Clients;
use Auth0\SDK\API\Management\ClientGrants;
use Auth0\SDK\API\Management\Connections;
use Auth0\SDK\API\Management\DeviceCredentials;
use Auth0\SDK\API\Management\Emails;
use Auth0\SDK\API\Management\EmailTemplates;
use Auth0\SDK\API\Management\Jobs;
use Auth0\SDK\API\Management\Logs;
use Auth0\SDK\API\Management\ResourceServers;
use Auth0\SDK\API\Management\Rules;
use Auth0\SDK\API\Management\Stats;
use Auth0\SDK\API\Management\Tenants;
use Auth0\SDK\API\Management\Tickets;
use Auth0\SDK\API\Management\UserBlocks;
use Auth0\SDK\API\Management\Users;
use Auth0\SDK\API\Management\UsersByEmail;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;

use Auth0\SDK\API\Management;

class MockApi {

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
     * @param string $endpoint Endpoint property name to call.
     * @param array $responses Responses to be loaded, an array of Response objects.
     */
    public function __construct( $endpoint, array $responses )
    {
        $mock    = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $handler->push( Middleware::history($this->requestHistory) );
        $guzzleOptions['handler'] = $handler;

        $this->client = new Management(self::API_TOKEN, self::API_DOMAIN, $guzzleOptions, 'object');
        $this->endpoint = $endpoint;
    }

    /**
     * @return Blacklists | Clients | ClientGrants | Connections | DeviceCredentials | Emails | EmailTemplates
     * @return Jobs | Logs | Rules | ResourceServers | Stats | Tenants | Tickets | UserBlocks | Users | UsersByEmail
     */
    public function call()
    {
        return $this->client->{$this->endpoint};
    }

    /**
     * Get a Guzzle history record from an array populated by Middleware::history().
     *
     * @param integer $index History index to get.
     *
     * @return Request
     */
    public function getHistory($index = 0)
    {
        return $this->requestHistory[$index]['request'];
    }
}
