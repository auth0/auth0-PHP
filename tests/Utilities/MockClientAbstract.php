<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\Contract\API\ClientInterface;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class MockClientAbstract implements MockClientInterface
{
    private array $history = [];

    public static function create(
        ?array $responses = []
    ): static
    {
        return new static($responses);
    }

    abstract function mock(): ClientInterface;

    /**
     * MockClient constructor.
     *
     * @param array|null $responses Array of mock Psr\Http\Message\ResponseInterface objects. If an empty array, an empty successful response will be mocked. If null, nothing will be mocked.
     */
    public function __construct(
        ?array $responses = []
    ) {
        if ($responses !== null && $responses === []) {
            $this->mock()->getConfiguration()->getHttpClient()->setFallbackResponse(HttpResponseGenerator::create('', 200));
            return;
        }

        if ($responses !== null && count($responses)) {
            foreach ($responses as $response) {
                $this->mock()->getConfiguration()->getHttpClient()->addResponseWildcard($response);
            }
        }
    }

    public function getHttpClient(): HttpClient
    {
        return $this->mock()->getHttpClient();
    }

    /**
     * Get the URL from a mocked request.
     *
     * @param int $parse_component Component for parse_url, null to return complete URL.
     */
    public function getRequestUrl(?int $parseComponent = null): ?string
    {
        $url = (string) $this->getRequest()->getUri();

        if ($parseComponent !== null) {
            return parse_url($url, $parseComponent);
        }

        return $url;
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
    protected function getRequest(): RequestInterface
    {
        return $this->getHttpClient()->getLastRequest()->getLastRequest();
    }
}
