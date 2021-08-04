<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Mockery;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpResponseGenerator.
 */
class HttpResponseGenerator
{
    public static function create(
        string $body = '',
        int $statusCode = 200
    ): ResponseInterface {
        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->andReturn($statusCode);
        $response->shouldReceive('getHeaders')->andReturn([]);
        $response->shouldReceive('getBody')->andReturn($body);

        return $response;
    }
}
