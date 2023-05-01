<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Authentication;

use Auth0\SDK\Exception\Authentication\ParResponseException;
use Auth0\SDK\Exception\NetworkException;
use Psr\Http\Message\ResponseInterface;

interface PushedAuthorizationRequestInterface
{
    /**
     * Produces a redirection URL for authentication using Pushed Authorization Request.
     *
     * @param null|array<string,null|int|string> $parameters Request parameters to send to the API endpoint.
     * @param null|array<string,int|string>      $headers    Headers to send with the API request.
     *
     * @throws NetworkException     If the network request is unable to be completed.
     * @throws ParResponseException If an unexpected response is returned from a request.
     */
    public function create(
        ?array $parameters = null,
        ?array $headers = null,
    ): string;

    /**
     * Establish a Pushed Authorization Request.
     *
     * @param null|array<string,null|int|string> $parameters Request parameters to send to the API endpoint.
     * @param null|array<string,int|string>      $headers    Headers to send with the API request.
     *
     * @throws NetworkException     If the network request is unable to be completed.
     * @throws ParResponseException If an unexpected response is returned from a request.
     */
    public function post(
        ?array $parameters = null,
        ?array $headers = null,
    ): ResponseInterface;
}
