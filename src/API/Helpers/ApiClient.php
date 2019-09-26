<?php
namespace Auth0\SDK\API\Helpers;

use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\API\Header\Telemetry;

class ApiClient
{

    const API_VERSION = '5.6.0';

    protected static $infoHeadersDataEnabled = true;

    protected static $infoHeadersData;

    public static function setInfoHeadersData(InformationHeaders $infoHeadersData)
    {
        if (! self::$infoHeadersDataEnabled) {
            return null;
        }

        self::$infoHeadersData = $infoHeadersData;
    }

    public static function getInfoHeadersData()
    {
        if (! self::$infoHeadersDataEnabled) {
            return null;
        }

        if (self::$infoHeadersData === null) {
            self::$infoHeadersData = new InformationHeaders;
            self::$infoHeadersData->setCorePackage();
        }

        return self::$infoHeadersData;
    }

    public static function disableInfoHeaders()
    {
        self::$infoHeadersDataEnabled = false;
    }

    protected $domain;

    protected $basePath;

    protected $headers;

    protected $guzzleOptions;

    protected $returnType;

    public function __construct($config)
    {
        $this->basePath      = $config['basePath'];
        $this->domain        = $config['domain'];
        $this->returnType    = isset( $config['returnType'] ) ? $config['returnType'] : null;
        $this->headers       = isset($config['headers']) ? $config['headers'] : [];
        $this->guzzleOptions = isset($config['guzzleOptions']) ? $config['guzzleOptions'] : [];

        if (self::$infoHeadersDataEnabled) {
            $this->headers[] = new Telemetry(self::getInfoHeadersData()->build());
        }
    }

    /**
     * Magic method to map HTTP verbs to request types.
     *
     * @deprecated 5.6.0, use $this->method().
     *
     * @param string $name      - Method name used to call the magic method.
     * @param array  $arguments - Arguments used in the magic method call.
     *
     * @return RequestBuilder
     */
    public function __call($name, $arguments)
    {
        $builder = new RequestBuilder([
            'domain' => $this->domain,
            'basePath' => $this->basePath,
            'method' => $name,
            'guzzleOptions' => $this->guzzleOptions,
            'returnType' => $this->returnType,
        ]);

        return $builder->withHeaders($this->headers);
    }

    /**
     * Create a new RequestBuilder.
     * Similar to the above but does not use a magic method.
     *
     * @param string  $method           - HTTP method to use (GET, POST, PATCH, etc).
     * @param boolean $set_content_type - Automatically set a content-type header.
     *
     * @return RequestBuilder
     */
    public function method($method, $set_content_type = true)
    {
        $method  = strtolower($method);
        $builder = new RequestBuilder([
            'domain' => $this->domain,
            'basePath' => $this->basePath,
            'method' => $method,
            'guzzleOptions' => $this->guzzleOptions,
            'returnType' => $this->returnType,
        ]);
        $builder->withHeaders($this->headers);

        if ($set_content_type && in_array($method, [ 'patch', 'post', 'put', 'delete' ])) {
            $builder->withHeader(new ContentType('application/json'));
        }

        return $builder;
    }
}
