<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface UsersByEmailInterface.
 */
interface UsersByEmailInterface
{
    /**
     * Search Users by Email.
     * Required scope: `read:users`.
     *
     * @param  string  $email  email address to search for (case-sensitive)
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `email` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users_By_Email/get_users_by_email
     */
    public function get(
        string $email,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
