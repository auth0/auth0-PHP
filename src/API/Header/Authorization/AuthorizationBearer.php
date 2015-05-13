<?php
namespace Auth0\SDK\API\Header\Authorization;

use Auth0\SDK\API\Header\Header;

class AuthorizationBearer extends Header {

    public function __construct ($token) {
        parent::__construct("Authorization", "Bearer $token");
    }

}