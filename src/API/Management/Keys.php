<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\KeysInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Handles requests to the Keys endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2/keys
 */
final class Keys extends ManagementEndpoint implements KeysInterface
{
    public function deleteEncryptionKey(
        string $kId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$kId] = Toolkit::filter([$kId])->string()->trim();

        Toolkit::assert([
            [$kId, \Auth0\SDK\Exception\ArgumentException::missing('kId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')->addPath(['keys', 'encryption', $kId])
            ->withOptions($options)
            ->call();
    }

    public function getEncryptionKey(
        string $kId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$kId] = Toolkit::filter([$kId])->string()->trim();

        Toolkit::assert([
            [$kId, \Auth0\SDK\Exception\ArgumentException::missing('kId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath(['keys', 'encryption', $kId])
            ->withOptions($options)
            ->call();
    }

    public function getEncryptionKeys(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        /** @var array<null|int|string> $parameters */

        return $this->getHttpClient()
            ->method('get')
            ->addPath(['keys', 'encryption'])
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    public function postEncryption(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath(['keys', 'encryption'])
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    public function postEncryptionKey(
        string $kId,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$kId] = Toolkit::filter([$kId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$kId, \Auth0\SDK\Exception\ArgumentException::missing('kId')],
        ])->isString();
        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath(['keys', 'encryption', $kId])
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    public function postEncryptionRekey(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('post')
            ->addPath(['keys', 'encryption', 'rekey'])
            ->withOptions($options)
            ->call();
    }

    public function postEncryptionWrappingKey(
        string $kId,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$kId] = Toolkit::filter([$kId])->string()->trim();

        Toolkit::assert([
            [$kId, \Auth0\SDK\Exception\ArgumentException::missing('kId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath(['keys', 'encryption', $kId, 'wrapping-key'])
            ->withOptions($options)
            ->call();
    }
}
