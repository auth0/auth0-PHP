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

    
    const API_VERSION  = "1.0.1";
    protected static $meta = array();

    public static function addHeaderInfoMeta($info) {
        self::$meta[] = $info;
    }

    protected $domain;
    protected $basePath;
    protected $headers;

    public function __construct($config) {
        $this->basePath = $config['basePath'];
        $this->domain = $config['domain'];
        $this->headers = isset($config['headers']) ? $config['headers'] : array();

        $this->addInformationHeaders();
    }

    protected function addInformationHeaders() {

        $meta = '';

        if (!empty(self::$meta)) {
            $meta = '(' . implode(',', self::$meta) . ')';
        }

        $this->headers[] = new Header('User-Agent', 'PHP/' . phpversion() . $meta);
        $this->headers[] = new Header('Auth0-Client', 'PHP/' . self::API_VERSION);

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
