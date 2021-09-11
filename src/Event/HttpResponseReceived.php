<?php

declare(strict_types=1);

namespace Auth0\SDK\Event;

use Auth0\SDK\Contract\Auth0Event;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class HttpResponseReceived implements Auth0Event
{
    private ResponseInterface $httpResponse;
    private RequestInterface $httpRequest;

    public function __construct(
        ResponseInterface $httpResponse,
        RequestInterface $httpRequest
    ) {
        $this->httpResponse = $httpResponse;
        $this->httpRequest = $httpRequest;
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
        ResponseInterface $httpResponse
    ): self {
        $this->httpResponse = $httpResponse;
        return $this;
    }
}
