<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface TicketsInterface.
 */
interface TicketsInterface
{
    /**
     * Create an email verification ticket.
     * Required scope: `create:user_tickets`.
     *
     * @param  string  $userId  ID of the user for whom the ticket should be created
     * @param  array<mixed>|null  $body  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `userId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Tickets/post_email_verification
     */
    public function createEmailVerification(
        string $userId,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Create a password change ticket.
     * Required scope: `create:user_tickets`.
     *
     * @param  array<mixed>  $body  Body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `body` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Tickets/post_password_change
     */
    public function createPasswordChange(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
