<?php
namespace Auth0\Tests;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Auth0\SDK\Helpers\JWKFetcher;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;

/**
 * Class MockApi
 *
 * @package Auth0\Tests
 */
abstract class MockApi
{

    /**
     * Guzzle request history container for mock API.
     *
     * @var array
     */
    protected $requestHistory = [];

    /**
     * History index to use.
     *
     * @var integer
     */
    protected $historyIndex = 0;

    /**
     * Management API object.
     *
     * @var Management|Authentication|JWKFetcher
     */
    protected $client;

    /**
     * MockApi constructor.
     *
     * @param array $responses Array of GuzzleHttp\Psr7\Response objects.
     * @param array $config Additional optional configuration needed for mocked class.
     */
    public function __construct(array $responses = [], array $config = [])
    {
        $guzzleOptions = [];
        if (count( $responses )) {
            $mock    = new MockHandler($responses);
            $handler = HandlerStack::create($mock);
            $handler->push( Middleware::history($this->requestHistory) );
            $guzzleOptions['handler'] = $handler;
        }

        $this->setClient( $guzzleOptions, $config );
    }

    /**
     * @param array $guzzleOptions
     * @param array $config
     *
     * @return mixed
     */
    abstract public function setClient(array $guzzleOptions, array $config = []);

    /**
     * Return the endpoint being used.
     *
     * @return Management|Authentication|JWKFetcher
     */
    public function call()
    {
        $this->historyIndex ++;
        return $this->client;
    }

    /**
     * Get the URL from a mocked request.
     *
     * @param integer $parse_component Component for parse_url, null to return complete URL.
     *
     * @return string
     */
    public function getHistoryUrl($parse_component = null)
    {
        $request     = $this->getHistory();
        $request_url = $request->getUri()->__toString();
        return is_null( $parse_component ) ? $request_url : parse_url( $request_url, $parse_component );
    }

    /**
     * Get the URL query from a mocked request.
     *
     * @return string
     */
    public function getHistoryQuery()
    {
        return $this->getHistoryUrl( PHP_URL_QUERY );
    }

    /**
     * Get the HTTP method from a mocked request.
     *
     * @return string
     */
    public function getHistoryMethod()
    {
        return $this->getHistory()->getMethod();
    }

    /**
     * Get the body from a mocked request.
     *
     * @return \stdClass|array
     */
    public function getHistoryBody()
    {
        $body = $this->getHistory()->getBody();
        return json_decode( $body, true );
    }

    /**
     * Get the form body from a mocked request.
     *
     * @return string
     */
    public function getHistoryBodyAsString()
    {
        return $this->getHistory()->getBody()->getContents();
    }

    /**
     * Get the headers from a mocked request.
     *
     * @return array
     */
    public function getHistoryHeaders()
    {
        return $this->getHistory()->getHeaders();
    }

    /**
     * Get a Guzzle history record from an array populated by Middleware::history().
     *
     * @return Request
     */
    protected function getHistory()
    {
        $requestHistoryIndex = $this->historyIndex - 1;
        return $this->requestHistory[$requestHistoryIndex]['request'];
    }
}
