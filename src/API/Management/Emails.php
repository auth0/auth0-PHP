<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\EmailsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Emails.
 * Handles requests to the Emails endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Emails
 */
final class Emails extends ManagementEndpoint implements EmailsInterface
{
    public function createProvider(
        string $name,
        array $credentials,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$name] = Toolkit::filter([$name])->string()->trim();
        [$credentials, $body] = Toolkit::filter([$credentials, $body])->array()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
        ])->isString();

        Toolkit::assert([
            [$credentials, \Auth0\SDK\Exception\ArgumentException::missing('credentials')],
        ])->isArray();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('emails', 'provider')->
            withBody(
                (object) Toolkit::merge([
                    'name'        => $name,
                    'credentials' => (object) $credentials,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function getProvider(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('emails', 'provider')->
            withOptions($options)->
            call();
    }

    public function updateProvider(
        string $name,
        array $credentials,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$name] = Toolkit::filter([$name])->string()->trim();
        [$credentials, $body] = Toolkit::filter([$credentials, $body])->array()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
        ])->isString();

        Toolkit::assert([
            [$credentials, \Auth0\SDK\Exception\ArgumentException::missing('credentials')],
        ])->isArray();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('patch')->
            addPath('emails', 'provider')->
            withBody(
                (object) Toolkit::merge([
                    'name'        => $name,
                    'credentials' => (object) $credentials,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function deleteProvider(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('delete')->
            addPath('emails', 'provider')->
            withOptions($options)->
            call();
    }
}
