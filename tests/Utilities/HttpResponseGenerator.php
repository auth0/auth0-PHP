<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use PsrDiscovery\Discover;
use Psr\Http\Message\ResponseInterface;

class HttpResponseGenerator
{
    public static function create(
        string $body = '',
        int $statusCode = 200,
        array $headers = []
    ): ResponseInterface {
        $factory = Discover::httpResponseFactory();
        $response = $factory->createResponse($statusCode);

        foreach($headers as $header => $value) {
            $response = $response->withHeader($header, $value);
        }

        $response->getBody()->write($body);

        return $response;
    }
}
