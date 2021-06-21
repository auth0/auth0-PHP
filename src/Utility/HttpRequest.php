<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\Request\FilteredRequest;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class HttpRequest
 */
final class HttpRequest
{
    /**
     * Shared configuration data.
     */
    private SdkConfiguration $configuration;

    /**
     * Base API path for the request.
     */
    private string $basePath = '/';

    /**
     * Path to request.
     *
     * @var array<string>
     */
    private array $path = [];

    /**
     * HTTP method to use for the request.
     */
    private string $method = '';

    /**
     * Headers to include for the request.
     *
     * @var array<string,mixed>
     */
    private array $headers = [];

    /**
     * Domain to use for request.
     */
    private ?string $domain = null;

    /**
     * URL parameters for the request.
     *
     * @var array<string,int|string|null>
     */
    private array $params = [];

    /**
     * Form parameters to send with the request.
     *
     * @var array<string,mixed>
     */
    private array $formParams = [];

    /**
     * Files to send with a multipart request.
     *
     * @var array<string,mixed>
     */
    private array $files = [];

    /**
     * Request body.
     */
    private string $body = '';

    /**
     * Stored instance of last send request.
     */
    private ?RequestInterface $lastRequest = null;

    /**
     * Stored instance of last received response.
     */
    private ?ResponseInterface $lastResponse = null;

    /**
     * Mocked response.
     *
     * @var array<object>
     */
    private ?array $mockedResponses = null;

    /**
     * HttpRequest constructor.
     *
     * @param SdkConfiguration   $configuration   Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string             $method          Required. Type of HTTP request method to use, e.g. 'GET' or 'POST'.
     * @param string             $basePath        Optional. The base URI path from which additional pathing and parameters should be appended.
     * @param array<int|string>  $headers         Optional. Additional headers to send with the HTTP request.
     * @param string|null        $domain          Optional. The domain portion of the URI in which to send this request.
     * @param array<object>|null $mockedResponses Optional. Only intended for unit testing purposes.
     */
    public function __construct(
        SdkConfiguration &$configuration,
        string $method,
        string $basePath = '/',
        array $headers = [],
        ?string $domain = null,
        ?array &$mockedResponses = null
    ) {
        $this->configuration = & $configuration;
        $this->method = mb_strtolower($method);
        $this->basePath = $basePath;
        $this->headers = $headers;
        $this->domain = $domain;
        $this->mockedResponses = & $mockedResponses;
    }

    /**
     * Return a RequestInterface representation of the last sent request.
     */
    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    /**
     * Return a ResponseInterface representation of the last received response.
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    /**
     * Add paths to the request URL.
     *
     * @param string ...$params String paths to append to the request.
     */
    public function addPath(
        string ...$params
    ): self {
        $this->path = array_merge($this->path, $params);
        return $this;
    }

    /**
     * Get the path and URL parameters of this request.
     */
    public function getUrl(): string
    {
        return trim(implode('/', $this->path), '/') . $this->getParams();
    }

    /**
     * Build the query string from current request parameters.
     */
    public function getParams(): string
    {
        $params = [];

        foreach ($this->params as $param => $value) {
            if (! is_null($value) && $value !== '') {
                $params[$param] = $value;
            }
        }

        return count($params) === 0 ? '' : '?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * Add a file to be sent with the request.
     *
     * @param string $field     Field name in the multipart request.
     * @param string $file_path Path to the file to send.
     */
    public function addFile(
        string $field,
        string $file_path
    ): self {
        $this->files[$field] = $file_path;
        return $this;
    }

    /**
     * Add a form value to be sent with the request.
     *
     * @param string          $key Form parameter key.
     * @param bool|int|string $value Form parameter value.
     */
    public function withFormParam(
        string $key,
        $value
    ): self {
        $this->formParams[$key] = $this->prepareBoolParam($value);
        return $this;
    }

    /**
     * Add one or more form values to be sent with the request.
     *
     * @param array<bool|int|string>|null $params Form parameters to use with the request.
     */
    public function withFormParams(
        ?array $params = null
    ): self {
        if ($params !== null) {
            foreach ($params as $key => $value) {
                $this->withFormParam((string) $key, $value);
            }
        }

        return $this;
    }

    /**
     * Build the URL and make the request. Returns a ResponseInterface.
     *
     * @throws \Auth0\SDK\Exception\NetworkException When there is an HTTP client error during the request, such as the host being unreachable.
     */
    public function call(): ResponseInterface
    {
        $domain = $this->configuration->buildDomainUri();
        $uri = $domain . $this->basePath . $this->getUrl();
        $httpRequestFactory = $this->configuration->getHttpRequestFactory();
        $httpClient = $this->configuration->getHttpClient();
        $httpRequest = $httpRequestFactory->createRequest($this->method, $uri);
        $headers = $this->headers;
        $mockedResponse = null;

        // Write a body, if available (e.g. a JSON object body, etc.)
        if (mb_strlen($this->body) !== 0) {
            $httpRequest->getBody()->write($this->body);
        }

        if (count($this->files) !== 0) {
            // If we're sending a file, build a multipart message.
            $multipart = $this->buildMultiPart();
            /**
             * Set the request body to the built multipart message.
             *
             * @psalm-suppress MixedMethodCall,MixedArgument
             *
             * @phpstan-ignore-next-line
             */
            $httpRequest->getBody()->write($multipart['stream']->__toString());
            // Set the content-type header to multipart/form-data.
            $headers['Content-Type'] = 'multipart/form-data; boundary="' . (string) $multipart['boundary'] . '"';
        } else {
            if (count($this->formParams) !== 0) {
                // If we're sending form parameters, build the query and ensure it's encoded properly.
                $httpRequest->getBody()->write(http_build_query($this->formParams, '', '&', PHP_QUERY_RFC1738));
                // Set the content-type header to application/x-www-form-urlencoded.
                $headers['Content-Type'] = 'application/x-www-form-urlencoded';
            }
        }

        // Add headers to request payload.
        foreach ($headers as $headerName => $headerValue) {
            $httpRequest = $httpRequest->withHeader($headerName, (string) $headerValue);
        }

        // Add telemetry headers, if they're enabled.
        if ($this->configuration->getHttpTelemetry()) {
            $httpRequest = $httpRequest->withHeader('Auth0-Client', HttpTelemetry::build());
        }

        // IF we are mocking responses, add the mocked response to the client response stack.
        if ($this->mockedResponses !== null && count($this->mockedResponses) !== 0 && method_exists($httpClient, 'addResponse')) {
            $mockedResponse = array_shift($this->mockedResponses);
            $httpClient->addResponse($mockedResponse->response); // @phpstan-ignore-line
        }

        // Store the request so it can be potentially reviewed later for error troubleshooting, etc.
        $this->lastRequest = $httpRequest;

        try {
            if ($mockedResponse && $mockedResponse->exception instanceof \Exception) { // @phpstan-ignore-line
                throw $mockedResponse->exception; // @phpstan-ignore-line
            }

            // Use the http client to issue the request and collect the response.
            $response = $httpClient->sendRequest($httpRequest);

            // Used for unit testing: if we're mocking responses and have a callback assigned, invoke that callback with our request and response.
            if ($mockedResponse && $mockedResponse->callback && is_callable($mockedResponse->callback)) { // @phpstan-ignore-line
                call_user_func($mockedResponse->callback, $httpRequest, $response); // @phpstan-ignore-line
            }

            $this->lastResponse = $response;

            // Return the response.
            return $response;
        } catch (ClientExceptionInterface $exception) {
            throw \Auth0\SDK\Exception\NetworkException::requestFailed($exception->getMessage(), $exception);
        }
    }

    /**
     * Set multiple headers for the request.
     *
     * @param array<string,int|string> $headers Array of headers to set.
     */
    public function withHeaders(
        array $headers
    ): self {
        foreach ($headers as $headerName => $headerValue) {
            $this->withHeader($headerName, (string) $headerValue);
        }

        return $this;
    }

    /**
     * Add a header to the request.
     *
     * @param string $name  Key name for header to add to request.
     * @param string $value Value for header to add to request.
     */
    public function withHeader(
        string $name,
        string $value
    ): self {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Set the body of the request.
     *
     * @param mixed $body       Body content to send.
     * @param bool  $jsonEncode Optional. Defaults to true. Encode the $body as JSON prior to sending request.
     */
    public function withBody(
        $body,
        bool $jsonEncode = true
    ): self {
        if (is_object($body)) {
            $body = json_encode($body, JSON_FORCE_OBJECT | JSON_THROW_ON_ERROR);
        } elseif (is_array($body) || is_string($body) && $jsonEncode === true) {
            $body = json_encode($body, JSON_THROW_ON_ERROR);
        }

        $this->body = (string) $body;
        return $this;
    }

    /**
     * Add a URL parameter to the request.
     *
     * @param string          $key   URL parameter key.
     * @param bool|int|string $value URL parameter value.
     */
    public function withParam(
        string $key,
        $value
    ): self {
        $this->params[$key] = $this->prepareBoolParam($value);
        return $this;
    }

    /**
     * Add URL parameters using $key => $value array.
     *
     * @param array<int|string|null>|null $parameters URL parameters to add.
     */
    public function withParams(
        ?array $parameters
    ): self {
        if ($parameters !== null) {
            foreach ($parameters as $key => $value) {
                if ($value !== null) {
                    $this->withParam((string) $key, $value);
                }
            }
        }

        return $this;
    }

    /**
     * Add field response filtering parameters using $key => $value array.
     *
     * @param FilteredRequest|null $fields Request fields be included or excluded from the API response using a FilteredRequest object.
     */
    public function withFields(
        ?FilteredRequest $fields
    ): self {
        if ($fields !== null) {
            $this->params += $fields->build();
        }

        return $this;
    }

    /**
     * Add pagination parameters using $key => $value array.
     *
     * @param PaginatedRequest|null $paginated Request paged results using a PaginatedRequest object.
     */
    public function withPagination(
        ?PaginatedRequest $paginated
    ): self {
        if ($paginated !== null) {
            $this->params += $paginated->build();
        }

        return $this;
    }

    /**
     * Add request parameters using RequestOptions object, representing common scenarios like pagination and field filtering.
     *
     * @param RequestOptions|null $options Request options to include.
     */
    public function withOptions(
        ?RequestOptions $options
    ): self {
        if ($options !== null) {
            $this->params += $options->build();
        }

        return $this;
    }

    /**
     * Build a multi-part request.
     *
     * @return array<string,mixed>
     */
    private function buildMultiPart(): array
    {
        $builder = new MultipartStreamBuilder($this->configuration->getHttpStreamFactory());

        foreach ($this->files as $field => $file) {
            $resource = fopen((string) $file, 'r');

            if ($resource !== false) {
                $builder->addResource($field, $resource);
            }
        }

        foreach ($this->formParams as $param => $value) {
            if (is_string($value) || is_resource($value) || $value instanceof StreamInterface) {
                $builder->addResource($param, $value);
            }
        }

        return [
            'stream' => $builder->build(),
            'boundary' => $builder->getBoundary(),
        ];
    }

    /**
     * Translate a boolean value to a string for use in a URL or form parameter.
     *
     * @param mixed $value Parameter value to check.
     *
     * @return mixed|string
     */
    private function prepareBoolParam(
        $value
    ) {
        if (is_bool($value)) {
            return $value === true ? 'true' : 'false';
        }

        return $value;
    }
}
