<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Configuration\SdkConfiguration;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpClient
 */
final class HttpClient
{
    /**
     * Instance of most recent HttpRequest
     */
    private ?HttpRequest $lastRequest = null;

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
     *
     * @var array<int|string>
     */
    private array $headers = [];

    /**
     * Mocked responses to pass to HttpRequest instances for testing.
     *
     * @var array<object>
     */
    private array $mockedResponses = [];

    /**
     * HttpClient constructor.
     *
     * @param SdkConfiguration  $configuration   Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string            $basePath        Optional. The base URI path from which additional pathing and parameters should be appended.
     * @param array<int|string> $headers         Optional. Additional headers to send with the HTTP request.
     */
    public function __construct(
        SdkConfiguration &$configuration,
        string $basePath = '/',
        array $headers = []
    ) {
        $this->configuration = & $configuration;

        $this->basePath = $basePath;
        $this->headers = $headers;
    }

    /**
     * Create a new HttpRequest instance.
     *
     * @param string $method HTTP method to use (GET, POST, PATCH, etc).
     */
    public function method(
        string $method
    ): HttpRequest {
        $method = mb_strtolower($method);
        $builder = new HttpRequest($this->configuration, $method, $this->basePath, $this->headers, null, $this->mockedResponses);

        if (in_array($method, ['post', 'put', 'patch', 'delete'], true)) {
            $builder->withHeader('Content-Type', 'application/json');
        }

        $builder->withHeaders($this->headers);

        return $this->lastRequest = $builder;
    }

    /**
     * Inject a series of Psr\Http\Message\ResponseInterface objects into created HttpRequest clients.
     */
    public function mockResponse(
        ResponseInterface $response,
        ?callable $callback = null,
        ?\Exception $exception = null
    ): self {
        $this->mockedResponses[] = (object) [
            'response' => $response,
            'callback' => $callback,
            'exception' => $exception,
        ];

        return $this;
    }

    /**
     * Inject a series of Psr\Http\Message\ResponseInterface objects into created HttpRequest clients.
     *
     * @param array<ResponseInterface|array> $responses An array of ResponseInterface objects, or an array of arrays containing ResponseInterfaces with callbacks.
     */
    public function mockResponses(
        array $responses
    ): self {
        foreach ($responses as $response) {
            if ($response instanceof ResponseInterface) {
                $response = [ 'response' => $response ];
            }

            if (! isset($response['response'])) {
                continue;
            }

            if ($response['response'] instanceof ResponseInterface) {
                $this->mockResponse($response['response'], $response['callback'] ?? null);
            }
        }

        return $this;
    }

    /**
     * Return a HttpRequest representation of the last built request.
     */
    public function getLastRequest(): ?HttpRequest
    {
        return $this->lastRequest;
    }
}
