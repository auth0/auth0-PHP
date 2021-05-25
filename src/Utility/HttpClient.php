<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\Configuration\SdkConfiguration;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiClient
 */
class HttpClient
{
    /**
     * Instance of most recent HttpRequest
     */
    public ?HttpRequest $lastRequest = null;

    /**
     * Shared configuration data.
     */
    private SdkConfiguration $configuration;

    /**
     * Base API path.
     */
    private string $basePath;

    /**
     * Headers to set for all calls.
     */
    private array $headers;

    /**
     * Mocked responses to pass to HttpRequest instances for testing.
     */
    private array $mockedResponses = [];

    /**
     * ApiClient constructor.
     *
     * @param array $config Configuration for this client.
     */
    public function __construct(
        SdkConfiguration $configuration,
        string $basePath = '/',
        array $headers = []
    ) {
        $this->configuration = $configuration;

        $this->basePath = $basePath;
        $this->headers = $headers;
    }

    /**
     * Create a new HttpRequest instance.
     *
     * @param string $method           HTTP method to use (GET, POST, PATCH, etc).
     * @param bool   $set_content_type Automatically set a content-type header.
     */
    public function method(
        string $method,
        bool $setContentType = true
    ): HttpRequest {
        $method = strtolower($method);
        $nextMockedResponse = null;

        if (count($this->mockedResponses)) {
            $nextMockedResponse = array_shift($this->mockedResponses);
        }

        $builder = new HttpRequest($this->configuration, $method, $this->basePath, $this->headers, $nextMockedResponse);
        $builder->withHeaders($this->headers);

        if ($setContentType && in_array($method, ['patch', 'post', 'put', 'delete'])) {
            $builder->withHeader(new ContentType('application/json'));
        }

        return $this->lastRequest = $builder;
    }

    /**
     * Inject a series of Psr\Http\Message\ResponseInterface objects into created HttpRequest clients.
     */
    public function mockResponse(
        ResponseInterface $response,
        ?callable $callback = null
    ): self {
        $this->mockedResponses[] = (object) [
            'response' => $response,
            'callback' => $callback,
        ];

        return $this;
    }
}
