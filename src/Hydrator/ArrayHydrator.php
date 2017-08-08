<?php

namespace Auth0\SDK\Hydrator;

use Auth0\SDK\Exception\HydrationException;
use Psr\Http\Message\ResponseInterface;

/**
 * Hydrate an HTTP response to array.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class ArrayHydrator implements Hydrator
{
    /**
     * @param ResponseInterface $response
     * @param string            $class
     *
     * @return array
     */
    public function hydrate(ResponseInterface $response, string $class): array
    {
        $body = $response->getBody()->__toString();
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') !== 0) {
            throw new HydrationException('The ArrayHydrator cannot hydrate response with Content-Type:'.$response->getHeaderLine('Content-Type'));
        }

        $content = json_decode($body, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new HydrationException(sprintf('Error (%d) when trying to json_decode response', json_last_error()));
        }

        return $content;
    }
}
