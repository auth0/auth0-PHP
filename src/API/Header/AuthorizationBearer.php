<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Header;

class AuthorizationBearer extends Header
{

    /**
     * AuthorizationBearer constructor.
     *
     * @param string $token Bearer Token to use.
     */
    public function __construct(string $token)
    {
        parent::__construct('Authorization', "Bearer $token");
    }
}
