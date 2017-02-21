<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/22/15
 * Time: 3:06 PM
 */

namespace Auth0\SDK\API\Helpers;

use Auth0\SDK\API\Header\Header;

class ApiClient {

    const API_VERSION  = "4.0.12";

    /**
     * @var bool
     */
    protected static $infoHeadersDataEnabled = true;

    /**
     * @var InformationHeaders
     */
    protected static $infoHeadersData;

    /**
     * @param InformationHeaders $infoHeadersData
     * @return null
     */
    public static function setInfoHeadersData(InformationHeaders $infoHeadersData) {
        if (!self::$infoHeadersDataEnabled) return null;

        self::$infoHeadersData = $infoHeadersData;
    }

    /**
     * @return InformationHeaders|null
     */
    public static function getInfoHeadersData() {
        if (!self::$infoHeadersDataEnabled) return null;

        if (self::$infoHeadersData === null) {
            self::$infoHeadersData = new InformationHeaders;

            self::$infoHeadersData->setPackage('auth0-php', self::API_VERSION);
            self::$infoHeadersData->setEnvironment('PHP', phpversion());
        }
        return self::$infoHeadersData;
    }

    public static function disableInfoHeaders(){
        self::$infoHeadersDataEnabled = false;
    }

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
    protected $headers;

    /**
     * @var array
     */
    protected $guzzleOptions;

    /**
     * ApiClient constructor.
     * @param array $config
     */
    public function __construct($config) {
        $this->basePath = $config['basePath'];
        $this->domain = $config['domain'];
        $this->headers = isset($config['headers']) ? $config['headers'] : [];
        $this->guzzleOptions = isset($config['guzzleOptions']) ? $config['guzzleOptions'] : [];

        if (self::$infoHeadersDataEnabled) {
            $this->headers[] = new Header('Auth0-Client', self::getInfoHeadersData()->build());
        }
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return RequestBuilder
     */
    public function __call($name, $arguments) {
        $builder = new RequestBuilder(array(
            'domain' => $this->domain,
            'basePath' => $this->basePath,
            'method' => $name,
            'guzzleOptions' => $this->guzzleOptions
        ));

        return $builder->withHeaders($this->headers);
    }

}
