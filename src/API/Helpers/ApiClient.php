<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Helpers;

use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\API\Header\Telemetry;

/**
 * Class ApiClient
 */
class ApiClient
{
    public const API_VERSION = '7.8.0';

    /**
     * Flag to turn telemetry headers off.
     * Adjusted with self::disableInfoHeaders().
     */
    protected static bool $infoHeadersDataEnabled = true;

    /**
     * Current telemetry headers.
     */
    protected static ?InformationHeaders $infoHeadersData = null;

    /**
     * API domain.
     */
    protected string $domain;

    /**
     * Base API path.
     */
    protected string $basePath;

    /**
     * Headers to set for all calls.
     *
     * @var array|mixed
     */
    protected $headers;

    /**
     * Options to pass to the Guzzle HTTP library.
     */
    protected array $guzzleOptions;

    /**
     * Data type to return from the call.
     * Can be "body" (default), "headers", or "object".
     *
     * @see \Auth0\SDK\API\Helpers\RequestBuilder::call()
     */
    protected ?string $returnType = null;

    /**
     * ApiClient constructor.
     *
     * @param array $config Configuration for this client.
     */
    public function __construct(
        array $config
    ) {
        $this->basePath = $config['basePath'];
        $this->domain = $config['domain'];
        $this->returnType = $config['returnType'] ?? null;
        $this->headers = $config['headers'] ?? [];
        $this->guzzleOptions = $config['guzzleOptions'] ?? [];

        if (self::$infoHeadersDataEnabled) {
            $this->headers[] = new Telemetry(self::getInfoHeadersData()->build());
        }
    }

    /**
     * Set new telemetry headers to be used for API requests.
     * Used by dependents to report their package.
     *
     * @param InformationHeaders $infoHeadersData Object representing telemetry to send.
     */
    public static function setInfoHeadersData(
        InformationHeaders $infoHeadersData
    ): void {
        if (! self::$infoHeadersDataEnabled) {
            return;
        }

        self::$infoHeadersData = $infoHeadersData;
    }

    /**
     * Get the currently set telemetry data.
     */
    public static function getInfoHeadersData(): ?InformationHeaders
    {
        if (! self::$infoHeadersDataEnabled) {
            return null;
        }

        if (self::$infoHeadersData === null) {
            self::$infoHeadersData = new InformationHeaders();
            self::$infoHeadersData->setCorePackage();
        }

        return self::$infoHeadersData;
    }

    /**
     * Turn off telemetry headers.
     */
    public static function disableInfoHeaders(): void
    {
        self::$infoHeadersDataEnabled = false;
    }

    /**
     * Create a new RequestBuilder.
     *
     * @param string $method           HTTP method to use (GET, POST, PATCH, etc).
     * @param bool   $set_content_type Automatically set a content-type header.
     */
    public function method(
        string $method,
        bool $set_content_type = true
    ): RequestBuilder {
        $method = strtolower($method);
        $builder = new RequestBuilder(
            [
                'domain' => $this->domain,
                'basePath' => $this->basePath,
                'method' => $method,
                'guzzleOptions' => $this->guzzleOptions,
                'returnType' => $this->returnType,
            ]
        );
        $builder->withHeaders($this->headers);

        if ($set_content_type && in_array($method, [ 'patch', 'post', 'put', 'delete' ])) {
            $builder->withHeader(new ContentType('application/json'));
        }

        return $builder;
    }
}
