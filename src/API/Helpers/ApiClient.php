<?php
namespace Auth0\SDK\API\Helpers;

use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\API\Header\Telemetry;

/**
 * Class ApiClient
 *
 * @package Auth0\SDK\API\Helpers
 */
class ApiClient
{

    const API_VERSION = '7.5.0';

    /**
     * Flag to turn telemetry headers off.
     * Adjusted with self::disableInfoHeaders().
     *
     * @var boolean
     */
    protected static $infoHeadersDataEnabled = true;

    /**
     * Current telemetry headers.
     *
     * @var InformationHeaders
     */
    protected static $infoHeadersData;

    /**
     * Set new telemetry headers to be used for API requests.
     * Used by dependents to report their package.
     *
     * @param InformationHeaders $infoHeadersData Object representing telemetry to send.
     *
     * @return null|void
     */
    public static function setInfoHeadersData(InformationHeaders $infoHeadersData)
    {
        if (! self::$infoHeadersDataEnabled) {
            return null;
        }

        self::$infoHeadersData = $infoHeadersData;
    }

    /**
     * Get the currently set telemtery data.
     *
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

    /**
     * Turn off telemetry headers.
     *
     * @return void
     */
    public static function disableInfoHeaders() : void
    {
        self::$infoHeadersDataEnabled = false;
    }

    /**
     * API domain.
     *
     * @var string
     */
    protected $domain;

    /**
     * Base API path.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Headers to set for all calls.
     *
     * @var array|mixed
     */
    protected $headers;

    /**
     * Options to pass to the Guzzle HTTP library.
     *
     * @var array
     */
    protected $guzzleOptions;

    /**
     * Data type to return from the call.
     * Can be "body" (default), "headers", or "object".
     *
     * @var string|null
     *
     * @see \Auth0\SDK\API\Helpers\RequestBuilder::call()
     */
    protected $returnType;

    /**
     * ApiClient constructor.
     *
     * @param array $config Configuration for this client.
     */
    public function __construct(array $config)
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
     *
     * @param string  $method           HTTP method to use (GET, POST, PATCH, etc).
     * @param boolean $set_content_type Automatically set a content-type header.
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
