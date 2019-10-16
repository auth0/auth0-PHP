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

    /**
     * @return InformationHeaders|null
     */
    public static function getInfoHeadersData() : ?InformationHeaders
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
        $this->returnType    = $config['returnType'] ?? null;
        $this->headers       = $config['headers'] ?? [];
        $this->guzzleOptions = $config['guzzleOptions'] ?? [];

        if (self::$infoHeadersDataEnabled) {
            $this->headers[] = new Telemetry(self::getInfoHeadersData()->build());
        }
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
    public function method(string $method, bool $set_content_type = true) : RequestBuilder
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
