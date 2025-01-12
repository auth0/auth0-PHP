<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\RefreshTokensInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Handles requests to the Refresh Tokens endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Refresh_Tokens
 */
final class RefreshTokens extends ManagementEndpoint implements RefreshTokensInterface
{
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')->addPath(['refresh-tokens', $id])
            ->withOptions($options)
            ->call();
    }

    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')->addPath(['refresh-tokens', $id])
            ->withOptions($options)
            ->call();
    }
}
