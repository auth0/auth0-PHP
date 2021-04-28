<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Tickets.
 * Handles requests to the Tickets endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Tickets
 *
 * @package Auth0\SDK\API\Management
 */
class Tickets extends GenericResource
{
    /**
     * Create an email verification ticket.
     * Required scope: `create:user_tickets`
     *
     * @param string              $userId  ID of the user for whom the ticket should be created.
     * @param array               $query   Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @link https://auth0.com/docs/api/management/v2#!/Tickets/post_email_verification
     */
    public function createEmailVerificationTicket(
        string $userId,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'user_id' => $userId
        ] + $query;

        return $this->apiClient->method('post')
            ->addPath('tickets', 'email-verification')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a password change ticket.
     * Required scope: `create:user_tickets`
     *
     * @param array               $query   Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     */
    public function createPasswordChangeTicket(
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('post')
            ->addPath('tickets', 'password-change')
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }
}
