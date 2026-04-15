<?php

namespace Auth0\SDK\API\Management\Tickets;

use Auth0\SDK\API\Management\Tickets\Requests\VerifyEmailTicketRequestContent;
use Auth0\SDK\API\Management\Types\VerifyEmailTicketResponseContent;
use Auth0\SDK\API\Management\Tickets\Requests\ChangePasswordTicketRequestContent;
use Auth0\SDK\API\Management\Types\ChangePasswordTicketResponseContent;

interface TicketsClientInterface
{
    /**
     * Create an email verification ticket for a given user. An email verification ticket is a generated URL that the user can consume to verify their email address.
     *
     * @param VerifyEmailTicketRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?VerifyEmailTicketResponseContent
     */
    public function verifyEmail(VerifyEmailTicketRequestContent $request, ?array $options = null): ?VerifyEmailTicketResponseContent;

    /**
     * Create a password change ticket for a given user. A password change ticket is a generated URL that the user can consume to start a reset password flow.
     *
     * Note: This endpoint does not verify the given user’s identity. If you call this endpoint within your application, you must design your application to verify the user’s identity.
     *
     * @param ChangePasswordTicketRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ChangePasswordTicketResponseContent
     */
    public function changePassword(ChangePasswordTicketRequestContent $request = new ChangePasswordTicketRequestContent(), ?array $options = null): ?ChangePasswordTicketResponseContent;
}
