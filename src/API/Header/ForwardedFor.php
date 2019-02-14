<?php
namespace Auth0\SDK\API\Header;

class ForwardedFor extends Header
{

    /**
     * ForwardedFor constructor.
     *
     * @param string $ipAddress
     */
    public function __construct($ipAddress)
    {
        parent::__construct('Auth0-Forwarded-For', $ipAddress);
    }
}
