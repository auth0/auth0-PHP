<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Header;

class ForwardedFor extends Header
{
    /**
     * ForwardedFor constructor.
     *
     * @param string $ipAddress IP address to identify as forwarding.
     */
    public function __construct(
        string $ipAddress
    ) {
        parent::__construct('Auth0-Forwarded-For', $ipAddress);
    }
}
