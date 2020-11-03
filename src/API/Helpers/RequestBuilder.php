<?php
declare(strict_types=1);

namespace Auth0\SDK\API\Helpers;

use \Auth0\SDK\API\Header\Header;
use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\RequestException;

/**
 * Class RequestBuilder
 *
 * @package Auth0\SDK\API\Helpers
 */
class RequestBuilder
{

    /**
     * Domain for the request.
     *
     * @var string
     */
    protected $domain;

    /**
     * Base API path for the request.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Path to request.
     *
     * @var array
     */
    protected $path = [];

    /**
     * HTTP method to use for the request.
     *
     * @var string
     */
    protected $method;

    /**
     * Headers to include for the request.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * URL parameters for the request.
     *
     * @var array
     */
    protected $params = [];

    /**
     * Form parameters to send with the request.
     *
     * @var array
     */
    protected $form_params = [];

    /**
     * Files to send with a multipart request.
     *
     * @var array
     */
    protected $files = [];

    /**
     * Guzzle HTTP Client options.
     *
     * @var array
     *
     * @see http://docs.guzzlephp.org/en/stable/request-options.html
     */
    protected $guzzleOptions = [];

    /**
     * Request body.
     *
     * @var string
     */
    protected $body;

    /**
     * Valid return types for the call() method.
     *
     * @var array
     */
    protected $returnTypes = [ 'body', 'headers', 'object' ];

    /**
     * Default return type.
     *
     * @var string
     */
    protected $returnType;

    /**
     * RequestBuilder constructor.
     *
     * @param array $config Configuration array passed to \Auth0\SDK\API\Management constructor.
     */
    public function __construct(array $config)
    {
        $this->method        = $config['method'];
        $this->domain        = $config['domain'] ?? '';
        $this->basePath      = $config['basePath'] ?? '';
        $this->guzzleOptions = $config['guzzleOptions'] ?? [];
        $this->headers       = $config['headers'] ?? [];

        if (array_key_exists('path', $config)) {
            $this->path = $config['path'];
        }

        $this->setReturnType( $config['returnType'] ?? null );
    }

    /**
     * Add paths to the request URL.
     *
     * @param string[] ...$params String paths to append to the request.
     *
     * @return RequestBuilder
     */
    public function addPath(string ...$params) : RequestBuilder
    {
        $this->path = array_merge( $this->path, $params );
        return $this;
    }

    /**
     * Get the path and URL parameters of this request.
     *
     * @return string
     */
    public function getUrl() : string
    {
        return trim(implode('/', $this->path), '/').$this->getParams();
    }

    /**
     * Build the query string from current request parameters.
     *
     * @return string
     */
    public function getParams() : string
    {
        $paramsClean = [];
        foreach ($this->params as $param => $value) {
            if (! is_null( $value ) && '' !== $value) {
                $paramsClean[] = sprintf( '%s=%s', $param, $value );
            }
        }

        return empty($paramsClean) ? '' : '?'.implode('&', $paramsClean);
    }

    /**
     * Add a file to be sent with the request.
     *
     * @param string $field     Field name in the multipart request.
     * @param string $file_path Path to the file to send.
     *
     * @return RequestBuilder
     */
    public function addFile(string $field, string $file_path) : RequestBuilder
    {
        $this->files[$field] = $file_path;
        return $this;
    }

    /**
     * Add a form value to be sent with the request.
     *
     * @param string $key   Form parameter key.
     * @param string $value Form parameter value.
     *
     * @return RequestBuilder
     */
    public function addFormParam(string $key, $value) : RequestBuilder
    {
        $this->form_params[$key] = $this->prepareBoolParam( $value );
        return $this;
    }

    /**
     * Get the request's options and set the base URI.
     *
     * @return array
     */
    public function getGuzzleOptions() : array
    {
        return array_merge(
            ['base_uri' => $this->domain.$this->basePath],
            $this->guzzleOptions
        );
    }

    /**
     * Build the URL and make the request.
     *
     * @return mixed
     *
     * @throws RequestException Thrown when there is an HTTP error during the request.
     */
    public function call()
    {
        $data = [
            'headers' => $this->headers,
            'body' => $this->body,
        ];

        if (! empty($this->files)) {
            $data['multipart'] = $this->buildMultiPart();
        } else if (! empty($this->form_params)) {
            $data['form_params'] = $this->form_params;
        }

        $client = new Client($this->getGuzzleOptions());

        try {
            $response = $client->request($this->method, $this->getUrl(), $data);
        } catch (RequestException $e) {
            throw $e;
        }

        switch ($this->returnType) {
            case 'headers':
            return $response->getHeaders();

            case 'object':
            return $response;

            case 'body':
            default:
                $body = (string) $response->getBody();
                if (strpos($response->getHeaderLine('content-type'), 'json') !== false) {
                    return json_decode($body, true);
                }
            return $body;
        }
    }

    /**
     * Set multiple headers for the request.
     *
     * @param array $headers Array of headers to set.
     *
     * @return RequestBuilder
     */
    public function withHeaders(array $headers) : RequestBuilder
    {
        foreach ($headers as $header) {
            $this->withHeader($header);
        }

        return $this;
    }

    /**
     * Add a header to the request.
     *
     * @param Header $header Header to add.
     *
     * @return RequestBuilder
     */
    public function withHeader(Header $header) : RequestBuilder
    {
        $this->headers[$header->getHeader()] = $header->getValue();
        return $this;
    }

    /**
     * Set the body of the request.
     *
     * @param string $body Body to send.
     *
     * @return RequestBuilder
     */
    public function withBody(string $body) : RequestBuilder
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Add a URL parameter to the request.
     *
     * @param string                 $key   URL parameter key.
     * @param string|boolean|integer $value URL parameter value.
     *
     * @return RequestBuilder
     */
    public function withParam(string $key, $value) : RequestBuilder
    {
        $this->params[$key] = $this->prepareBoolParam( $value );
        return $this;
    }

    /**
     * Add URL parameters using $key => $value array.
     *
     * @param array $params URL parameters to add.
     *
     * @return RequestBuilder
     */
    public function withDictParams(array $params) : RequestBuilder
    {
        foreach ($params as $key => $value) {
            $this->withParam($key, $value);
        }

        return $this;
    }

    /**
     * Set the return type for this request.
     *
     * @param string $type Request type of "headers" or "body" or "object".
     *
     * @return RequestBuilder
     */
    public function setReturnType(?string $type) : RequestBuilder
    {
        if (empty( $type ) || ! in_array($type, $this->returnTypes)) {
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
    private function buildMultiPart() : array
    {
        $multipart = [];

        foreach ($this->files as $field => $file) {
            $multipart[] = [
                'name' => $field,
                'contents' => fopen($file, 'r')
            ];
        }

        foreach ($this->form_params as $param => $value) {
            $multipart[] = [
                'name' => $param,
                'contents' => $value
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
    private function prepareBoolParam($value)
    {
        if (is_bool( $value )) {
            return true === $value ? 'true' : 'false';
        }

        return $value;
    }
}
