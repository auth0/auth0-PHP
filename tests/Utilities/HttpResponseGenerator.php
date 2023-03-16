<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\Utility\InterfaceDiscovery;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpResponseGenerator.
 */
class HttpResponseGenerator
{
    public static function create(
        string $body = '',
        int $statusCode = 200,
        array $headers = []
    ): ResponseInterface {
        $factory = InterfaceDiscovery::getResponseFactory();
        $response = $factory->createResponse($statusCode);

        foreach($headers as $header => $value) {
            $response = $response->withHeader($header, $value);
        }

        $response->getBody()->write($body);

        return $response;
    }
}
