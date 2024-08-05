<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Event\{HttpRequestBuilt, HttpResponseReceived};
use Auth0\SDK\Utility\Request\{FilteredRequest, PaginatedRequest, RequestOptions};
use Exception;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\{RequestInterface, ResponseInterface, StreamInterface};

use function defined;
use function is_array;
use function is_bool;
use function is_callable;
use function is_object;
use function is_resource;
use function is_string;

final class HttpRequest
{
    /**
     * @var int
     */
    public const MAX_REQUEST_RETRIES = 10;

    /**
     * @var int
     */
    public const MAX_REQUEST_RETRY_DELAY = 1000;

    /**
     * @var int
     */
    public const MAX_REQUEST_RETRY_JITTER = 100;

    /**
     * @var int
     */
    public const MIN_REQUEST_RETRY_DELAY = 100;

    /**
     * Request body.
     */
    private string $body = '';

    /**
     * The number of requests this instance has made.
     */
    private int $count = 0;

    /**
     * Files to send with a multipart request.
     *
     * @var array<string,mixed>
     */
    private array $files = [];

    /**
     * Form parameters to send with the request.
     *
     * @var array<string,mixed>
     */
    private array $formParams = [];

    /**
     * Stored instance of last send request.
     */
    private ?RequestInterface $lastRequest = null;

    /**
     * Stored instance of last received response.
     */
    private ?ResponseInterface $lastResponse = null;

    /**
     * URL parameters for the request.
     *
     * @var array<string,null|int|string>
     */
    private array $params = [];

    /**
     * Path to request.
     *
     * @var array<string>
     */
    private array $path = [];

    /**
     * The milliseconds slept between each request retry.
     *
     * @var array<int>
     */
    private array $waits = [0];

    /**
     * HttpRequest constructor.
     *
     * @param SdkConfiguration   $configuration   Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param int                $context         Required. The context the client is being created under, either HttpClient::CONTEXT_GENERIC_CLIENT, HttpClient::CONTEXT_AUTHENTICATION_CLIENT or HttpClient::CONTEXT_MANAGEMENT_CLIENT.
     * @param string             $method          Required. Type of HTTP request method to use, e.g. 'GET' or 'POST'.
     * @param string             $basePath        Optional. The base URI path from which additional pathing and parameters should be appended.
     * @param array<int|string>  $headers         Optional. Additional headers to send with the HTTP request.
     * @param null|string        $domain          Optional. The domain portion of the URI in which to send this request.
     * @param null|array<object> $mockedResponses Optional. Only intended for unit testing purposes.
     */
    public function __construct(
        private SdkConfiguration $configuration,
        private int $context,
        private string $method,
        private string $basePath = '/',
        private array $headers = [],
        private ?string $domain = null,
        private ?array &$mockedResponses = null,
    ) {
    }

    /**
     * Add a file to be sent with the request.
     *
     * @param string      $field     field name in the multipart request
     * @param null|string $file_path path to the file to send
     */
    public function addFile(
        string $field,
        ?string $file_path,
    ): self {
        if (null !== $file_path) {
            $this->files[$field] = $file_path;
        }

        return $this;
    }

    /**
     * Add paths to the request URL.
     *
     * @param array<int,null|string> $params String paths to append to the request.
     */
    public function addPath(
        array $params = [],
    ): self {
        /** @var array<string> $params */
        [$params] = Toolkit::filter([$params])->array()->trim();

        if ([] !== $params) {
            $this->path = array_merge($this->path, $params);
        }

        return $this;
    }

    /**
     * Build the URL and make the request. Returns a ResponseInterface.
     *
     * @throws \Auth0\SDK\Exception\NetworkException when there is an HTTP client error during the request, such as the host being unreachable
     */
    public function call(): ResponseInterface
    {
        $domain = $this->domain ?? $this->configuration->formatDomain();
        $uri = $domain . $this->basePath . $this->getUrl();
        $httpRequestFactory = $this->configuration->getHttpRequestFactory();
        $httpClient = $this->configuration->getHttpClient();
        $configuredRetries = $this->configuration->getHttpMaxRetries();
        $headers = $this->headers;
        $mockedResponse = null;

        $httpRequest = $httpRequestFactory->createRequest(mb_strtoupper($this->method), $uri);

        // Write a body, if available (e.g. a JSON object body, etc.)
        if (0 !== mb_strlen($this->body)) {
            $httpRequest->getBody()->write($this->body);
        }

        if ([] !== $this->files) {
            // If we're sending a file, build a multipart message.
            $multipart = $this->buildMultiPart();
            // Set the request body to the built multipart message.
            $httpRequest->getBody()->write($multipart['stream']->__toString());
            // Set the content-type header to multipart/form-data.
            $headers['Content-Type'] = 'multipart/form-data; boundary="' . $multipart['boundary'] . '"';
        } elseif ([] !== $this->formParams) {
            // If we're sending form parameters, build the query and ensure it's encoded properly.
            $httpRequest->getBody()->write(http_build_query($this->formParams, '', '&', PHP_QUERY_RFC1738));
            // Set the content-type header to application/x-www-form-urlencoded.
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
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
        if (null !== $this->mockedResponses && [] !== $this->mockedResponses && method_exists($httpClient, 'addResponse')) {
            $mockedResponse = array_shift($this->mockedResponses);

            if (property_exists($mockedResponse, 'response')) {
                $httpClient->addResponse($this->method, $uri, $mockedResponse->response);
            }
        }

        // Dispatch event to listeners of Auth0\SDK\EventHttpRequestBuilt.
        $this->configuration->eventDispatcher()->dispatch(new HttpRequestBuilt($httpRequest));

        // Store the request so it can be potentially reviewed later for error troubleshooting, testing, etc.
        $this->lastRequest = $httpRequest;

        try {
            ++$this->count;

            if ($mockedResponse && property_exists($mockedResponse, 'exception') && $mockedResponse->exception instanceof Exception) { // @phpstan-ignore-line
                throw $mockedResponse->exception;
            }

            // Use the http client to issue the request and collect the response.
            $httpResponse = $httpClient->sendRequest($httpRequest);

            // Used for unit testing: if we're mocking responses and have a callback assigned, invoke that callback with our request and response.
            // @codeCoverageIgnoreStart
            if ($mockedResponse && property_exists($mockedResponse, 'callback') && is_callable($mockedResponse->callback)) { // @phpstan-ignore-line
                ($mockedResponse->callback)($httpRequest, $httpResponse);
            }
            // @codeCoverageIgnoreEnd

            // Dispatch event to listeners of Auth0\SDK\HttpResponseReceived.
            $this->configuration->eventDispatcher()->dispatch(new HttpResponseReceived($httpResponse, $httpRequest));

            // Store the last response so it can be potentially reviewed later for error troubleshooting, testing, etc.
            $this->lastResponse = $httpResponse;

            // If the API responds with a 429, try reissuing the request up to 3 times before returning the last response.
            if (429 === $httpResponse->getStatusCode() && $configuredRetries > 0 && HttpClient::CONTEXT_MANAGEMENT_CLIENT === $this->context) {
                $attempt = $this->getRequestCount();
                $maxRetries = min(self::MAX_REQUEST_RETRIES, $configuredRetries);

                if ($attempt < $maxRetries) {
                    /**
                     * Use an exponential back-off with the formula:
                     * max(MIN_REQUEST_RETRY_DELAY, min(MAX_REQUEST_RETRY_DELAY, (100ms * (2 ** attempt - 1)) + random_between(0, MAX_REQUEST_RETRY_JITTER))).
                     *
                     * Each retry attempt:
                     * ✔ Increases base delay by (100ms * (2 ** attempt - 1))
                     * ✔ Introduces jitter to the base delay; increases delay between 1ms to MAX_REQUEST_RETRY_JITTER (100ms)
                     * ✔ Is never less than MIN_REQUEST_RETRY_DELAY (100ms)
                     * ✔ Is never more than MAX_REQUEST_RETRY_DELAY (1s)
                     */
                    $wait = 100 * 2 ** ($attempt - 1); // Exponential delay with each subsequent request attempt.
                    $wait = mt_rand($wait + 1, $wait + self::MAX_REQUEST_RETRY_JITTER); // Add jitter to the delay window.
                    $wait = min(self::MAX_REQUEST_RETRY_DELAY, $wait); // Ensure delay is less than MAX_REQUEST_RETRY_DELAY.
                    $wait = max(self::MIN_REQUEST_RETRY_DELAY, $wait); // Ensure delay is more than MIN_REQUEST_RETRY_DELAY.

                    // Briefly wait before attempting again.
                    $this->sleep($wait);

                    // Make subsequent attempt.
                    $httpResponse = $this->call();
                }
            }

            // Return the response.
            return $httpResponse;
        } catch (ClientExceptionInterface $clientException) {
            throw \Auth0\SDK\Exception\NetworkException::requestFailed($clientException->getMessage(), $clientException);
        }
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
     * Build the query string from current request parameters.
     */
    public function getParams(): string
    {
        $params = [];

        foreach ($this->params as $param => $value) {
            if (null !== $value && '' !== $value) {
                $params[$param] = $value;
            }
        }

        return [] === $params ? '' : '?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * Return the number of requests made from this instance.
     */
    public function getRequestCount(): int
    {
        return $this->count;
    }

    /**
     * The milliseconds slept between request retries.
     *
     * @return array<int>
     */
    public function getRequestDelays(): array
    {
        return $this->waits;
    }

    /**
     * Get the path and URL parameters of this request.
     */
    public function getUrl(): string
    {
        return trim(implode('/', $this->path), '/') . $this->getParams();
    }

    /**
     * Set the body of the request.
     *
     * @param mixed $body       body content to send
     * @param bool  $jsonEncode Optional. Defaults to true. Encode the $body as JSON prior to sending request.
     */
    public function withBody(
        $body,
        bool $jsonEncode = true,
    ): self {
        if (is_array($body) || is_object($body) || is_string($body) && $jsonEncode) {
            $body = json_encode($body, JSON_THROW_ON_ERROR);
        }

        /** @var int|string $body */
        $this->body = (string) $body;

        return $this;
    }

    /**
     * Add field response filtering parameters using $key => $value array.
     *
     * @param null|FilteredRequest $fields request fields be included or excluded from the API response using a FilteredRequest object
     */
    public function withFields(
        ?FilteredRequest $fields,
    ): self {
        if ($fields instanceof FilteredRequest) {
            $this->params += $fields->build();
        }

        return $this;
    }

    /**
     * Add a form value to be sent with the request.
     *
     * @param string               $key   form parameter key
     * @param null|bool|int|string $value form parameter value
     */
    public function withFormParam(
        string $key,
        $value,
    ): self {
        if (null !== $value) {
            $this->formParams[$key] = $this->prepareBoolParam($value);
        }

        return $this;
    }

    /**
     * Add one or more form values to be sent with the request.
     *
     * @param null|array<bool|int|string> $params form parameters to use with the request
     */
    public function withFormParams(
        ?array $params = null,
    ): self {
        if (null !== $params) {
            foreach ($params as $key => $value) {
                $this->withFormParam((string) $key, $value);
            }
        }

        return $this;
    }

    /**
     * Add a header to the request.
     *
     * @param string $name  key name for header to add to request
     * @param string $value value for header to add to request
     */
    public function withHeader(
        string $name,
        string $value,
    ): self {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Set multiple headers for the request.
     *
     * @param array<string,int|string> $headers array of headers to set
     */
    public function withHeaders(
        array $headers,
    ): self {
        foreach ($headers as $headerName => $headerValue) {
            $this->withHeader($headerName, (string) $headerValue);
        }

        return $this;
    }

    /**
     * Add request parameters using RequestOptions object, representing common scenarios like pagination and field filtering.
     *
     * @param null|RequestOptions $options request options to include
     */
    public function withOptions(
        ?RequestOptions $options,
    ): self {
        if ($options instanceof RequestOptions) {
            $this->params += $options->build();
        }

        return $this;
    }

    /**
     * Add pagination parameters using $key => $value array.
     *
     * @param null|PaginatedRequest $paginated request paged results using a PaginatedRequest object
     */
    public function withPagination(
        ?PaginatedRequest $paginated,
    ): self {
        if ($paginated instanceof PaginatedRequest) {
            $this->params += $paginated->build();
        }

        return $this;
    }

    /**
     * Add a URL parameter to the request.
     *
     * @param string               $key   URL parameter key
     * @param null|bool|int|string $value URL parameter value
     */
    public function withParam(
        string $key,
        $value,
    ): self {
        if (null === $value) {
            return $this;
        }

        /** @var null|int|string $value */
        $value = $this->prepareBoolParam($value);
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * Add URL parameters using $key => $value array.
     *
     * @param null|array<null|int|string> $parameters URL parameters to add
     */
    public function withParams(
        ?array $parameters,
    ): self {
        if (null !== $parameters) {
            foreach ($parameters as $key => $value) {
                if (null !== $value) {
                    $this->withParam((string) $key, $value);
                }
            }
        }

        return $this;
    }

    /**
     * Build a multi-part request.
     *
     * @return array{stream: \Psr\Http\Message\StreamInterface, boundary: string}
     */
    private function buildMultiPart(): array
    {
        $builder = new MultipartStreamBuilder($this->configuration->getHttpStreamFactory());

        foreach ($this->files as $field => $file) {
            /** @var int|string $file */
            $resource = fopen((string) $file, 'rb');

            if (false !== $resource) {
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
     * @param mixed $value parameter value to check
     *
     * @return mixed|string
     */
    private function prepareBoolParam(
        $value,
    ) {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return $value;
    }

    /**
     * Issue a usleep() for $milliseconds, and log the delay.
     *
     * @param int $milliseconds how long, in milliseconds, to trigger a usleep() for
     *
     * @codeCoverageIgnore
     */
    private function sleep(
        int $milliseconds,
    ): self {
        if ($milliseconds > 0) {
            $this->waits[] = $milliseconds;

            // Don't actually trigger a sleep if we're running tests.
            if (! defined('AUTH0_TESTS_DIR')) {
                // usleep() uses microseconds, so * 1000 for the correct conversion.
                usleep($milliseconds * 1000);
            }
        }

        return $this;
    }
}
