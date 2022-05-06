<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\Utility\HttpClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class MockApi.
 */
abstract class MockApi
{
    /**
     * History container for mock requests.
     */
    protected array $history = [];

    /**
     * MockApi constructor.
     *
     * @param array|null $responses Array of mock Psr\Http\Message\ResponseInterface objects. If an empty array, an empty successful response will be mocked. If null, nothing will be mocked.
     */
    public function __construct(
        ?array $responses = []
    ) {
        // Create an instance of the intended API.
        $this->setClient();

        if ($responses !== null && ! count($responses)) {
            $responses[] = HttpResponseGenerator::create();
        }

        // Setup the API class' mock httpClient with the response payload.
        if ($responses !== null && count($responses)) {
            foreach ($responses as $response) {
                $this->client->getHttpClient()->mockResponse($response, [$this, 'onFetch']);
            }
        }
    }

    /**
     * Assign the type of API class being used.
     */
    abstract protected function setClient();

    /**
     * Returns an instance of the configured API class.
     */
    abstract public function mock();

    /**
     * Returns the current client.
     */
    public function getClient(): MockApi
    {
        return $this->client;
    }

    /**
     * Returns the current HTTPClient.
     */
    public function getHttpClient(): HttpClient
    {
        return $this->client->getHttpClient();
    }

    /**
     * Callback fired whenever the HttpClient instance of an API class would use sendRequest.
     *
     * @param RequestInterface $request The Request that would have been sent, had it not been mocked.
     * @param ResponseInterface $response The (mocked) Response that was returned.
     */
    public function onFetch(
        RequestInterface $request,
        ResponseInterface $response
    ): void {
        $this->history[] = (object) [
            'request' => $request,
            'response' => $response,
        ];
    }

    /**
     * Get the URL from a mocked request.
     *
     * @param int $parse_component Component for parse_url, null to return complete URL.
     */
    public function getRequestUrl(?int $parseComponent = null): ?string
    {
        $requestUrl = $this->getRequest()->getUri()->__toString();
        return is_null($parseComponent) ? $requestUrl : parse_url($requestUrl, $parseComponent);
    }

    /**
     * Get the URL query from a mocked request.
     */
    public function getRequestQuery(
        ?string $prefix = '&'
    ): string
    {
        $query = $this->getRequestUrl(PHP_URL_QUERY);

        if ($query !== null) {
            if ($prefix !== null) {
                return $prefix . $query;
            }

            return $query;
        }

        return '';
    }

    /**
     * Get the HTTP method from a mocked request.
     */
    public function getRequestMethod(): string
    {
        return mb_strtoupper($this->getRequest()->getMethod());
    }

    /**
     * Get the body from a mocked request.
     *
     * @return array<mixed>\stdClass
     */
    public function getRequestBody()
    {
        return json_decode($this->getRequestBodyAsString(), true);
    }

    /**
     * Get the form body from a mocked request.
     */
    public function getRequestBodyAsString(): string
    {
        return $this->getRequest()->getBody()->__toString();
    }

    /**
     * Get the headers from a mocked request.
     *
     * @return array<int|string>
     */
    public function getRequestHeaders(): array
    {
        return $this->getRequest()->getHeaders();
    }

    /**
     * Get a Guzzle history record from an array populated by Middleware::history().
     */
    protected function getRequest(): object
    {
        return $this->history[array_key_last($this->history)]->request;
    }
}
