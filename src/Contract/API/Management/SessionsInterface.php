<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

interface SessionsInterface
{
    /**
     * Delete a Session by ID.
     * Required scope: `delete:sessions`.
     *
     * @param string              $id      ID of the session to delete.
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Sessions/delete_session
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve Session information
     * Required scopes:
     * - `read:sessions` for any call to this endpoint.
     *
     * @param string              $id      ID of session to retrieve
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Sessions/get_session
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
