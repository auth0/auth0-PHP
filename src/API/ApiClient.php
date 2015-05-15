<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/22/15
 * Time: 3:06 PM
 */

namespace Auth0\SDK\API;

use Auth0\SDK\API\Header\Header;

class ApiClient {
    
    const API_VERSION  = "1.0.3";

    protected static $infoHeadersData;

    protected static function setInfoHeadersData(InformationHeaders $infoHeadersData) {
        self::$infoHeadersData = $infoHeadersData;
    }

    protected static function getInfoHeadersData() {
        if (self::$infoHeadersData === null) {
            self::$infoHeadersData = new InformationHeaders;

            self::$infoHeadersData->setPackage('auth0-php', self::API_VERSION);
            self::$infoHeadersData->setEnvironment('PHP', phpversion());
        }
        return self::$infoHeadersData;
    }

    protected $domain;
    protected $basePath;
    protected $headers;

    public function __construct($config) {
        $this->basePath = $config['basePath'];
        $this->domain = $config['domain'];
        $this->headers = isset($config['headers']) ? $config['headers'] : array();

        $this->headers[] = new Header('Auth0-Client', base64_encode(json_encode(self::getInfoHeadersData()->get())));
    }

    public function __call($name, $arguments) {
        $builder = new RequestBuilder(array(
            'domain' => $this->domain,
            'method' => $name,
            'path' => array( $this->basePath ),
        ));
        
        return $builder->withHeaders($this->headers);
    }

}
