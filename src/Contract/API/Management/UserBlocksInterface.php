<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface UserBlocksInterface.
 */
interface UserBlocksInterface
{
    /**
     * Retrieve a list of blocked IP addresses for the login identifiers (email, username, phone number, etc) associated with the specified user.
     * Required scope: `read:users`.
     *
     * @param  string  $id  user ID to query for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/User_Blocks/get_user_blocks_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Unblock a user that was blocked due to an excessive amount of incorrectly provided credentials.
     * Required scope: `update:users`.
     *
     * @param  string  $id  the user_id of the user to update
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/User_Blocks/delete_user_blocks_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve a list of blocked IP addresses for a given identifier (e.g., username, phone number or email).
     * Required scope: `read:users`.
     *
     * @param  string  $identifier  should be any of a username, phone number, or email
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `identifier` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/User_Blocks/get_user_blocks
     */
    public function getByIdentifier(
        string $identifier,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Unblock a user blocked due to an excessive amount of incorrectly-provided credentials.
     * Required scope: `update:users`.
     *
     * @param  string  $identifier  should be any of a username, phone number, or email
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `identifier` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/User_Blocks/delete_user_blocks
     */
    public function deleteByIdentifier(
        string $identifier,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
