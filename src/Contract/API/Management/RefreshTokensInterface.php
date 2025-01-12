<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

interface RefreshTokensInterface
{
    /**
     * Delete a Refresh Token by ID.
     * Required scope: `delete:refresh_tokens`.
     *
     * @param string              $id      ID of the refresh token to delete.
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Refresh_Tokens/delete_refresh_token
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve Refresh Token information
     * Required scopes:
     * - `read:refresh_tokens` for any call to this endpoint.
     *
     * @param string              $id      ID of refresh token to retrieve
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Refresh_Tokens/get_refresh_token
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
