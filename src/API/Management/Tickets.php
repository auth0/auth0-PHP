<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Tickets.
 * Handles requests to the Tickets endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Tickets
 */
final class Tickets extends ManagementEndpoint
{
    /**
     * Create an email verification ticket.
     * Required scope: `create:user_tickets`
     *
     * @param string              $userId  ID of the user for whom the ticket should be created.
     * @param array<mixed>|null   $body    Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `userId` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Tickets/post_email_verification
     */
    public function createEmailVerification(
        string $userId,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$userId] = Toolkit::filter([$userId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('tickets', 'email-verification')
            ->withBody(
                (object) Toolkit::merge([
                    'user_id' => $userId,
                ], $body)
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a password change ticket.
     * Required scope: `create:user_tickets`
     *
     * @param array<mixed>        $body    Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `body` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Tickets/post_password_change
     */
    public function createPasswordChange(
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('tickets', 'password-change')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }
}
