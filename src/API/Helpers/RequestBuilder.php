<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/22/15
 * Time: 3:11 PM
 */

namespace Auth0\SDK\API\Helpers;
use \Auth0\SDK\API\Header\Header;
use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\RequestException;

class RequestBuilder {

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var array
     */
    protected $path = [];

    /**
     * @var array
     */
    protected $method = [];

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var array
     */
    protected $form_params = [];

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var array
     */
    protected $guzzleOptions = [];

    /**
     * @var string
     */
    protected $body;

    /**
     * RequestBuilder constructor.
     * @param array $config
     */
    public function __construct( $config ) {

        $this->method = $config['method'];
        $this->domain = $config['domain'];
        $this->basePath = isset($config['basePath']) ? $config['basePath'] : '';
        $this->guzzleOptions = isset($config['guzzleOptions']) ? $config['guzzleOptions'] : [];
        $this->headers = isset($config['headers']) ? $config['headers'] : array();
        if (array_key_exists('path', $config)) $this->path = $config['path'];

    }

    /**
     * @param string $name
     * @param array $arguments
     * @return RequestBuilder
     */
    public function __call($name, $arguments) {

        $argument = null;

        if (count($arguments) > 0) {
            $argument = $arguments[0];
        }
        
        $this->addPath($name, $argument);

        return $this;
    }

    /**
     * @param string $name
     * @param string|null $argument
     * @return RequestBuilder
     */
    public function addPath($name, $argument = null) {
        $this->path[] = $name;
        if ($argument !== null) {
            $this->path[] = $argument;
        }
        return $this;
    }

    /**
     * @param string $variable
     * @return RequestBuilder
     */
    public function addPathVariable($variable) {
        $this->path[] = $variable;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return trim(implode('/',$this->path), '/') . $this->getParams();
    }

    /**
     * @return string
     */
    public function getParams() {
        if (empty($this->params)) return '';

        $params = array_map(function($key, $value){
            return "$key=$value";
        }, array_keys($this->params), $this->params);

        return '?' . implode('&',$params);
    }

    /**
     * @return RequestBuilder
     */
    public function dump() {
        echo "<pre>";
        echo "METHOD: {$this->method}\n";
        echo "URL: {$this->getUrl()}\n";

        echo "HEADERS:\n\t";
        echo implode("\n\t",array_map(function($k,$v){ return "$k: $v";}, array_keys($this->headers), $this->headers));
        echo "\n";

        echo "BODY: {$this->body}\n";

        echo "</pre>";

        return $this;
    }

    /**
     * @param string $field
     * @param string $file_path
     * @return RequestBuilder
     */
    public function addFile($field, $file_path) {
        $this->files[$field] = $file_path;
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return RequestBuilder
     */
    public function addFormParam($key, $value) {
        $this->form_params[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getGuzzleOptions() {
        return array_merge(
            ["base_uri" => $this->domain . $this->basePath], 
            $this->guzzleOptions
        );
    }

    /**
     * @return mixed|string
     */
    public function call() {

        $client = new Client( $this->getGuzzleOptions() );

        try {
            
            $data = [
                'headers' => $this->headers,
                'body' => $this->body,
            ];

            if (!empty($this->files)) {
               $data['multipart'] = $this->buildMultiPart();
            } else if (!empty($this->form_params)) {
                $data['form_params'] = $this->form_params;
            }

            $response = $client->request($this->method, $this->getUrl(), $data);
            $body = (string) $response->getBody();

            if (strpos($response->getHeaderLine('content-type'), 'json') !== false) {
                return json_decode($body, true);
            }

            return  $body;

        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @param $headers
     * @return RequestBuilder
     */
    public function withHeaders($headers) {

        foreach ($headers as $header) {
            $this->withHeader($header);
        }

        return $this;
    }

    /**
     * @param Header|string $header
     * @param null|string $value
     * @return $this
     */
    public function withHeader($header, $value = null) {

        if ($header instanceof Header) {
            $this->headers[$header->getHeader()] = $header->getValue();
        }
        else {
            $this->headers[$header] = $value;
        }
        return $this;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function withBody($body) {
        $this->body = $body;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function withParam($key, $value) {

        $value = ($value === true ? 'true' : $value);
        $value = ($value === false ? 'false' : $value);

        $this->params[$key] = $value;
        return $this;
    }

    /**
     * @param array $params
     * @return RequestBuilder
     */
    public function withParams($params) {
        foreach($params as $param) {
            $this->withParam($param['key'], $param['value']);
        }
        return $this;
    }

    /**
     * @return array
     */
    private function buildMultiPart() {
        $multipart = array();

        foreach($this->files as $field => $file) {
            $multipart[] = [
                'name' => $field,
                'contents' => fopen($file, 'r')
            ];
        }
        foreach($this->form_params as $param => $value) {
            $multipart[] = [
                'name' => $param,
                'contents' => $value
            ];
        }
        return $multipart;
    }

}
