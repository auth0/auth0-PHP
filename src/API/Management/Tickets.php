<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;

/**
 * Class Tickets.
 * Handles requests to the Tickets endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Tickets
 */
class Tickets extends GenericResource
{
    /**
     * Create an email verification ticket.
     * Required scope: `create:user_tickets`
     *
     * @param string              $userId  ID of the user for whom the ticket should be created.
     * @param array               $body    Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @link https://auth0.com/docs/api/management/v2#!/Tickets/post_email_verification
     */
    public function createEmailVerification(
        string $userId,
        array $body = [],
        ?RequestOptions $options = null
    ): ?array {
        $this->validateString($userId, 'userId');

        $payload = [
            'user_id' => $userId,
        ] + $body;

        return $this->apiClient->method('post')
            ->addPath('tickets', 'email-verification')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a password change ticket.
     * Required scope: `create:user_tickets`
     *
     * @param array               $body    Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     */
    public function createPasswordChange(
        array $body,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('post')
            ->addPath('tickets', 'password-change')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }
}
