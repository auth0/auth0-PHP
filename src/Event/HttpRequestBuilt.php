<?php

declare(strict_types=1);

namespace Auth0\SDK\Event;

use Auth0\SDK\Contract\Auth0Event;
use Psr\Http\Message\RequestInterface;

final class HttpRequestBuilt implements Auth0Event
{
    public function __construct(
        private RequestInterface $httpRequest,
    ) {
    }

    public function get(): RequestInterface
    {
        return $this->httpRequest;
    }

    public function set(
        RequestInterface $httpRequest,
    ): self {
        $this->httpRequest = $httpRequest;

        return $this;
    }
}
