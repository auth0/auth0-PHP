<?php
namespace Auth0\SDK\API\Header;

class ContentType extends Header {

    public function __construct ($contentType) {
        parent::__construct("Content-Type", $contentType);
    }

}