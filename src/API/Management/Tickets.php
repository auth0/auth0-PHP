<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\TicketsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Tickets.
 * Handles requests to the Tickets endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Tickets
 */
final class Tickets extends ManagementEndpoint implements TicketsInterface
{
    public function createEmailVerification(
        string $userId,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$userId] = Toolkit::filter([$userId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
        ])->isString();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('tickets', 'email-verification')->
            withBody(
                (object) Toolkit::merge([
                    'user_id' => $userId,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function createPasswordChange(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('post')->
            addPath('tickets', 'password-change')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }
}
