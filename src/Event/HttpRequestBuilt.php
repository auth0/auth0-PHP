<?php

declare(strict_types=1);

namespace Auth0\SDK\Event;

use Auth0\SDK\Contract\Auth0Event;
use Psr\Http\Message\RequestInterface;

final class HttpRequestBuilt implements Auth0Event
{
    private RequestInterface $httpRequest;

    public function __construct(
        RequestInterface $httpRequest
    ) {
        $this->httpRequest = $httpRequest;
    }

    public function get(): RequestInterface
    {
        return $this->httpRequest;
    }

    public function set(
        RequestInterface $httpRequest
    ): self {
        $this->httpRequest = $httpRequest;
        return $this;
    }
}
