<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class UserBlocks.
 * Handles requests to the User Blocks endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/User_Blocks
 */
final class UserBlocks extends ManagementEndpoint
{
    /**
     * Retrieve a list of blocked IP addresses for the login identifiers (email, username, phone number, etc) associated with the specified user.
     * Required scope: `read:users`
     *
     * @param string              $id      User ID to query for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/User_Blocks/get_user_blocks_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('user-blocks', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Unblock a user that was blocked due to an excessive amount of incorrectly provided credentials.
     * Required scope: `update:users`
     *
     * @param string              $id      The user_id of the user to update.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/User_Blocks/delete_user_blocks_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('user-blocks', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve a list of blocked IP addresses for a given identifier (e.g., username, phone number or email).
     * Required scope: `read:users`
     *
     * @param string              $identifier Should be any of a username, phone number, or email.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `identifier` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/User_Blocks/get_user_blocks
     */
    public function getByIdentifier(
        string $identifier,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$identifier] = Toolkit::filter([$identifier])->string()->trim();

        Toolkit::assert([
            [$identifier, \Auth0\SDK\Exception\ArgumentException::missing('identifier')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('user-blocks')
            ->withParam('identifier', $identifier)
            ->withOptions($options)
            ->call();
    }

    /**
     * Unblock a user blocked due to an excessive amount of incorrectly-provided credentials.
     * Required scope: `update:users`
     *
     * @param string              $identifier Should be any of a username, phone number, or email.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `identifier` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/User_Blocks/delete_user_blocks
     */
    public function deleteByIdentifier(
        string $identifier,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$identifier] = Toolkit::filter([$identifier])->string()->trim();

        Toolkit::assert([
            [$identifier, \Auth0\SDK\Exception\ArgumentException::missing('identifier')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('user-blocks')
            ->withParam('identifier', $identifier)
            ->withOptions($options)
            ->call();
    }
}
