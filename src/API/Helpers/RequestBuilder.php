<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Helpers;

use Auth0\SDK\API\Header\Header;
use Auth0\SDK\Helpers\Requests\FilteredRequest;
use Auth0\SDK\Helpers\Requests\PaginatedRequest;
use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RequestBuilder
 */
class RequestBuilder
{
    /**
     * Domain for the request.
     */
    protected string $domain;

    /**
     * Base API path for the request.
     */
    protected string $basePath;

    /**
     * Path to request.
     */
    protected array $path = [];

    /**
     * HTTP method to use for the request.
     */
    protected string $method;

    /**
     * Headers to include for the request.
     */
    protected array $headers = [];

    /**
     * URL parameters for the request.
     */
    protected array $params = [];

    /**
     * Form parameters to send with the request.
     */
    protected array $form_params = [];

    /**
     * Files to send with a multipart request.
     */
    protected array $files = [];

    /**
     * Guzzle HTTP Client options.
     *
     * @see http://docs.guzzlephp.org/en/stable/request-options.html
     */
    protected array $guzzleOptions = [];

    /**
     * Request body.
     */
    protected string $body = '';

    /**
     * Valid return types for the call() method.
     */
    protected array $returnTypes = [ 'body', 'headers' ];

    /**
     * Default return type.
     */
    protected ?string $returnType = null;

    /**
     * RequestBuilder constructor.
     *
     * @param array $config Configuration array passed to \Auth0\SDK\API\Management constructor.
     */
    public function __construct(
        array $config
    ) {
        $this->method = $config['method'];
        $this->domain = $config['domain'] ?? '';
        $this->basePath = $config['basePath'] ?? '';
        $this->guzzleOptions = $config['guzzleOptions'] ?? [];
        $this->headers = $config['headers'] ?? [];

        if (array_key_exists('path', $config)) {
            $this->path = $config['path'];
        }

        $this->setReturnType($config['returnType'] ?? null);
    }

    /**
     * Add paths to the request URL.
     *
     * @param string ...$params String paths to append to the request.
     */
    public function addPath(
        string ...$params
    ): RequestBuilder {
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
        $paramsClean = [];
        foreach ($this->params as $param => $value) {
            if (! is_null($value) && $value !== '') {
                $paramsClean[] = sprintf('%s=%s', $param, $value);
            }
        }

        return ! count($paramsClean) ? '' : '?' . implode('&', $paramsClean);
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
    ): RequestBuilder {
        $this->files[$field] = $file_path;
        return $this;
    }

    /**
     * Add a form value to be sent with the request.
     *
     * @param string          $key Form parameter key.
     * @param string|bool|int $value Form parameter value.
     */
    public function addFormParam(
        string $key,
        $value
    ): RequestBuilder {
        $this->form_params[$key] = $this->prepareBoolParam($value);
        return $this;
    }

    /**
     * Get the request's options and set the base URI.
     *
     * @return array
     */
    public function getGuzzleOptions(): array
    {
        return array_merge(
            ['base_uri' => $this->domain . $this->basePath],
            $this->guzzleOptions
        );
    }

    /**
     * Build the URL and make the request. Returns a ResponseInterface.
     *
     * @throws RequestException When there is an HTTP error during the request.
     */
    public function fetch(): ResponseInterface
    {
        $data = [
            'headers' => $this->headers,
            'body' => $this->body,
        ];

        if (count($this->files)) {
            $data['multipart'] = $this->buildMultiPart();
        } elseif (count($this->form_params)) {
            $data['form_params'] = $this->form_params;
        }

        $client = new Client($this->getGuzzleOptions());
        return $client->request($this->method, $this->getUrl(), $data);
    }

    /**
     * Build the URL and make the request. Return response as an array, or null on error.
     *
     * @return array|null
     *
     * @throws RequestException When there is an HTTP error during the request.
     */
    public function call(): ?array
    {
        $response = $this->fetch();

        if ($this->returnType === 'headers') {
            return $response->getHeaders();
        }

        $body = $response->getBody()->__toString();

        return json_decode($body, true);
    }

    /**
     * Set multiple headers for the request.
     *
     * @param array $headers Array of headers to set.
     */
    public function withHeaders(
        array $headers
    ): RequestBuilder {
        foreach ($headers as $header) {
            $this->withHeader($header);
        }

        return $this;
    }

    /**
     * Add a header to the request.
     *
     * @param Header $header Header to add.
     */
    public function withHeader(
        Header $header
    ): RequestBuilder {
        $this->headers[$header->getHeader()] = $header->getValue();
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
    ): RequestBuilder {
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
    ): RequestBuilder {
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
    ): RequestBuilder {
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
    ): RequestBuilder {
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
    ): RequestBuilder {
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
    ): RequestBuilder {
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
    ): RequestBuilder {
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
        $multipart = [];

        foreach ($this->files as $field => $file) {
            $multipart[] = [
                'name' => $field,
                'contents' => fopen($file, 'r'),
            ];
        }

        foreach ($this->form_params as $param => $value) {
            $multipart[] = [
                'name' => $param,
                'contents' => $value,
            ];
        }

        return $multipart;
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
