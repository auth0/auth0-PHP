<?php

declare(strict_types=1);

namespace Auth0\Tests\unit;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;

/**
 * Class MockApi.
 */
abstract class MockApi
{
    /**
     * Guzzle request history container for mock API.
     */
    protected array $requestHistory = [];

    /**
     * History index to use.
     */
    protected int $historyIndex = 0;

    /**
     * Management API object.
     *
     * @var Authentication|JWKFetcher|Management
     */
    public $client;

    /**
     * MockApi constructor.
     *
     * @param array $responses     Array of GuzzleHttp\Psr7\Response objects.
     * @param array $config        Additional optional configuration needed for mocked class.
     * @param array $guzzleOptions Additional Guzzle HTTP options.
     */
    public function __construct(array $responses = [], array $config = [], array $guzzleOptions = [])
    {
        if (count($responses)) {
            $mock = new MockHandler($responses);
            $handler = HandlerStack::create($mock);
            $handler->push(Middleware::history($this->requestHistory));
            $guzzleOptions['handler'] = $handler;
        }

        $this->setClient($guzzleOptions, $config);
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
     * @return Authentication|JWKFetcher|Management
     */
    public function call()
    {
        ++$this->historyIndex;

        return $this->client;
    }

    /**
     * Get the URL from a mocked request.
     *
     * @param int $parse_component Component for parse_url, null to return complete URL.
     */
    public function getHistoryUrl(?int $parseComponent = null): ?string
    {
        $request = $this->getHistory();
        $requestUrl = $request->getUri()->__toString();

        return is_null($parseComponent) ? $requestUrl : parse_url($requestUrl, $parseComponent);
    }

    /**
     * Get the URL query from a mocked request.
     */
    public function getHistoryQuery(): ?string
    {
        return $this->getHistoryUrl(PHP_URL_QUERY);
    }

    /**
     * Get the HTTP method from a mocked request.
     */
    public function getHistoryMethod(): string
    {
        return $this->getHistory()->getMethod();
    }

    /**
     * Get the body from a mocked request.
     *
     * @return array|\stdClass
     */
    public function getHistoryBody()
    {
        $body = (string) $this->getHistory()->getBody();

        return json_decode($body, true);
    }

    /**
     * Get the form body from a mocked request.
     */
    public function getHistoryBodyAsString(): string
    {
        return $this->getHistory()->getBody()->getContents();
    }

    /**
     * Get the headers from a mocked request.
     *
     * @return array
     */
    public function getHistoryHeaders(): array
    {
        return $this->getHistory()->getHeaders();
    }

    /**
     * Get a Guzzle history record from an array populated by Middleware::history().
     */
    protected function getHistory(): Request
    {
        $requestHistoryIndex = $this->historyIndex - 1;

        return $this->requestHistory[$requestHistoryIndex]['request'];
    }
}
