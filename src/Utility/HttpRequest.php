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

/**
 * Class HttpRequest
 */
final class HttpRequest
{
    /**
     * Stored instance of last send request.
     */
    public ?RequestInterface $lastRequest = null;

    /**
     * Shared configuration data.
     */
    protected SdkConfiguration $configuration;

    /**
     * Base API path for the request.
     */
    protected string $basePath = '/';

    /**
     * Path to request.
     */
    protected array $path = [];

    /**
     * HTTP method to use for the request.
     */
    protected string $method = '';

    /**
     * Headers to include for the request.
     */
    protected array $headers = [];

    /**
     * Domain to use for request.
     */
    protected ?string $domain = null;

    /**
     * URL parameters for the request.
     */
    protected array $params = [];

    /**
     * Form parameters to send with the request.
     */
    protected array $formParams = [];

    /**
     * Files to send with a multipart request.
     */
    protected array $files = [];

    /**
     * Request body.
     */
    protected string $body = '';

    /**
     * Mocked response.
     */
    protected ?object $mockedResponse = null;

    /**
     * HttpRequest constructor.
     *
     * @param array $config Configuration array passed to \Auth0\SDK\API\Management constructor.
     */
    public function __construct(
        SdkConfiguration $configuration,
        string $method,
        string $basePath = '/',
        array $headers = [],
        ?object $mockedResponse = null,
        ?string $domain = null
    ) {
        $this->configuration = $configuration;
        $this->method = $method;
        $this->basePath = $basePath;
        $this->headers = $headers;
        $this->domain = $domain;
        $this->mockedResponse = $mockedResponse;
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

        return ! count($params) ? '' : '?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
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
     * @param string|bool|int $value Form parameter value.
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
     * @param string          $key Form parameter key.
     * @param string|bool|int $value Form parameter value.
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
        $domain = $this->domain ?? $this->configuration->buildDomainUri();
        $uri = $domain . $this->basePath . $this->getUrl();
        $httpRequestFactory = $this->configuration->getHttpRequestFactory();
        $httpClient = $this->configuration->getHttpClient();
        $httpRequest = $httpRequestFactory->createRequest($this->method, $uri);
        $headers = $this->headers;

        // Write a body, if available (e.g. a JSON object body, etc.)
        if ($this->body) {
            $httpRequest->getBody()->write($this->body);
        }

        if ($this->files) {
            // If we're sending a file, build a multipart message.
            $multipart = $this->buildMultiPart();
            // Set the request body to the built multipart message.
            $httpRequest->getBody()->write($multipart['stream']->__toString());
            // Set the content-type header to multipart/form-data.
            $headers['Content-Type'] = 'multipart/form-data; boundary="' . $multipart['boundary'] . '"';
        } else {
            if ($this->formParams) {
                // If we're sending form parameters, build the query and ensure it's encoded properly.
                $httpRequest->getBody()->write(http_build_query($this->formParams), '', '&', PHP_QUERY_RFC1738);
                // Set the content-type header to application/x-www-form-urlencoded.
                $headers['Content-Type'] = 'application/x-www-form-urlencoded';
            }
        }

        // Add headers.
        foreach ($headers as $headerName => $headerValue) {
            $httpRequest = $httpRequest->withHeader($headerName, $headerValue);
        }

        // Add telemetry headers, if they're enabled.
        if ($this->configuration->getHttpTelemetry()) {
            $httpRequest = $httpRequest->withHeader('Auth0-Client', HttpTelemetry::build());
        }

        // IF we are mocking responses, add the mocked response to the client response stack.
        if ($this->mockedResponse && method_exists($httpClient, 'addResponse')) {
            $httpClient->addResponse($this->mockedResponse->response);
        }

        // Store the request so it can be potentially reviewed later for error troubleshooting, etc.
        $this->lastRequest = $httpRequest;

        try {
            // Use the http client to issue the request and collect the response.
            $response = $httpClient->sendRequest($httpRequest);

            // Used for unit testing: if we're mocking responses and have a callback assigned, invoke that callback with our request and response.
            if ($this->mockedResponse && $this->mockedResponse->callback && is_callable($this->mockedResponse->callback)) {
                call_user_func($this->mockedResponse->callback, $httpRequest, $response);
            }

            // Return the response.
            return $response;
        } catch (ClientExceptionInterface $exception) {
            throw \Auth0\SDK\Exception\NetworkException::requestFailed($exception->getMessage());
        }
    }

    /**
     * Set multiple headers for the request.
     *
     * @param array $headers Array of headers to set.
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
     * @param Header $header Header to add.
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
     * @param string|array|object $body       Body to send.
     * @param string              $jsonEncode True if the $body be encoded as JSON before sending.
     */
    public function withBody(
        $body,
        bool $jsonEncode = true
    ): self {
        if (is_object($body)) {
            $body = json_encode($body, JSON_FORCE_OBJECT);
        } elseif (is_array($body) || is_string($body) && $jsonEncode === true) {
            $body = json_encode($body);
        }

        $this->body = $body;
        return $this;
    }

    /**
     * Add a URL parameter to the request.
     *
     * @param string          $key   URL parameter key.
     * @param string|bool|int $value URL parameter value.
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
     * @param array|null $parameters URL parameters to add.
     */
    public function withParams(
        ?array $parameters
    ): self {
        if ($parameters !== null) {
            foreach ($parameters as $key => $value) {
                $this->withParam((string) $key, $value);
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
     * Set the return type for this request.
     *
     * @param string $type Request type of "headers" or "body" or "object".
     */
    public function setReturnType(
        ?string $type
    ): self {
        if ($type === null || ! in_array($type, $this->returnTypes)) {
            $type = 'body';
        }

        $this->returnType = $type;
        return $this;
    }

    /**
     * Build a multi-part request.
     *
     * @return array
     */
    private function buildMultiPart(): array
    {
        $builder = new MultipartStreamBuilder($this->configuration->getHttpStreamFactory());

        foreach ($this->files as $field => $file) {
            $builder
                ->addResource($field, fopen($file, 'r'));
        }

        foreach ($this->formParams as $param => $value) {
            $builder
                ->addResource($param, $value);
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
