<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class UsersByEmail.
 * Handles requests to the Users by Email endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Users_By_Email
 */
class UsersByEmail extends GenericResource
{
    /**
     * Search Users by Email.
     * Required scope: `read:users`
     *
     * @param string              $email   Email address to search for (case-sensitive).
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     */
    public function get(
        string $email,
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('get')
            ->addPath('users-by-email')
            ->withParam('email', $email)
            ->withOptions($options)
            ->call();
    }
}
