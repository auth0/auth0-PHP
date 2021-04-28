<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class UserBlocks.
 * Handles requests to the User Blocks endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/User_Blocks
 *
 * @package Auth0\SDK\API\Management
 */
class UserBlocks extends GenericResource
{
    /**
     * Retrieve a list of blocked IP addresses for the login identifiers (email, username, phone number, etc) associated with the specified user.
     * Required scope: `read:users`
     *
     * @param string              $id      User ID to query for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
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
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        $this->validateString($id, 'id');

        return $this->apiClient->method('delete')
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
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function getByIdentifier(
        string $identifier,
        ?RequestOptions $options = null
    ): ?array {
        $this->validateString($identifier, 'identifier');

        return $this->apiClient->method('get')
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
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function deleteByIdentifier(
        string $identifier,
        ?RequestOptions $options = null
    ): ?array {
        $this->validateString($identifier, 'identifier');

        return $this->apiClient->method('delete')
            ->addPath('user-blocks')
            ->withParam('identifier', $identifier)
            ->withOptions($options)
            ->call();
    }
}
