<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface UsersByEmailInterface
 */
interface UsersByEmailInterface
{
    /**
     * Search Users by Email.
     * Required scope: `read:users`
     *
     * @param string              $email   Email address to search for (case-sensitive).
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `email` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users_By_Email/get_users_by_email
     */
    public function get(
        string $email,
        ?RequestOptions $options = null
    ): ResponseInterface;
}
