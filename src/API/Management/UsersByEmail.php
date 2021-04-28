<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class UsersByEmail.
 * Handles requests to the Users by Email endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Users_By_Email
 *
 * @package Auth0\SDK\API\Management
 */
class UsersByEmail extends GenericResource
{
    /**
     * Search Users by Email.
     * Required scope: `read:users`
     *
     * @param string              $email   Email address to search for (case-sensitive).
     * @param array               $query   Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function get(
        string $email,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('users-by-email')
            ->withParam('email', $email)
            ->withParams($query)
            ->withOptions($options)
            ->call();
    }
}
