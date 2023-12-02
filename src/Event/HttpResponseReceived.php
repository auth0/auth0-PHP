<?php

declare(strict_types=1);

namespace Auth0\SDK\Event;

use Auth0\SDK\Contract\Auth0Event;
use Psr\Http\Message\{RequestInterface, ResponseInterface};

final class HttpResponseReceived implements Auth0Event
{
    public function __construct(
        private ResponseInterface $httpResponse,
        private RequestInterface $httpRequest,
    ) {
    }

    public function get(): ResponseInterface
    {
        return $this->httpResponse;
    }

    public function getRequest(): RequestInterface
    {
        return $this->httpRequest;
    }

    public function set(
        ResponseInterface $httpResponse,
    ): self {
        $this->httpResponse = $httpResponse;

        return $this;
    }
}
