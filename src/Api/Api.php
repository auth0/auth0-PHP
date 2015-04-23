<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/22/15
 * Time: 3:06 PM
 */

namespace Auth0\SDK\API;


class Api {

    protected $domain;
    protected $basePath;

    public function __construct($config) {
        $this->basePath = $config['basePath'];
        $this->domain = $config['domain'];
    }

    public function __call($name, $arguments) {
        return new RequestBuilder([
            'domain' => $this->domain,
            'method' => $name,
            'path' => array( $this->basePath )
        ]);
    }

}