<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/22/15
 * Time: 3:11 PM
 */

namespace Auth0\SDK\API;
use Auth0\SDK\API\Header\Header;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RequestBuilder {

    protected $path = array();
    protected $method = array();
    protected $headers = array();
    protected $params = array();
    protected $body;

    public function __construct( $config ) {

        $this->method = $config['method'];
        $this->domain = $config['domain'];
        if (array_key_exists('path', $config)) $this->path = $config['path'];

    }

    public function __call($name, $arguments) {

        $this->path[] = $name;

        if (count($arguments) > 0) {
            $this->path[] = $arguments[0];
        }

        return $this;
    }

    public function getUrl() {
        return $this->domain . '/' . trim(implode('/',$this->path), '/') . $this->getParams();
    }

    public function getParams() {
        if (empty($this->params)) return '';

        $params = array_map(function($key, $value){
            return "$key=$value";
        }, array_keys($this->params), $this->params);

        return '?' . implode('&',$params);
    }

    public function call() {

        $client = new Client();
        $method = $this->method;

        try {

            $response = $client->$method($this->getUrl(), [
                'headers' => $this->headers,
                'body' => $this->body
            ]);

            return $response->json(['object' => false]);

        } catch (RequestException $e) {
            throw $e;
        }

    }

    public function withHeader($header, $value = null) {

        if ($header instanceof Header) {
            $this->headers[$header->getHeader()] = $header->getValue();
        }
        else {
            $this->headers[$header] = $value;
        }
        return $this;
    }

    public function withBody($body) {
        $this->body = $body;
        return $this;
    }

    public function withParam($key, $value) {

        $value = ($value === true ? 'true' : $value);
        $value = ($value === false ? 'false' : $value);

        $this->params[$key] = $value;
        return $this;
    }

    public function withParams($params) {
        foreach($params as $param) {
            $this->withParam($param['key'], $param['value']);
        }
        return $this;
    }

}