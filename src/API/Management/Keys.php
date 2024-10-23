<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\KeysInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Handles requests to the Keys endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2/keys
 */
final class Keys extends ManagementEndpoint implements KeysInterface
{
    public function postEncryptionRekey(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('post')
            ->addPath(['keys', 'encryption', 'rekey'])
            ->withOptions($options)
            ->call();
    }
}
