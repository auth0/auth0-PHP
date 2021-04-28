<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Connections.
 * Handles requests to the Connections endpoint of the v2 Management API.
 *
 * https://auth0.com/docs/api/management/v2#!/Connections
 *
 * @package Auth0\SDK\API\Management
 */
class Connections extends GenericResource
{
    /**
     * Get connection(s).
     * Required scope: `read:connections`
     *
     * @param array               $query   Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Connections/get_connections
     */
    public function getAll(
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('connections')
            ->withParams($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a single Connection.
     * Required scope: `read:connections`
     *
     * @param string              $connectionId Connection (by ID) to query.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Connections/get_connections_by_id
     */
    public function get(
        string $connectionId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('connections', $connectionId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a Connection.
     * Required scope: `delete:connections`
     *
     * @param string              $connectionId Connection (by ID) to delete.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Connections/delete_connections_by_id
     */
    public function delete(
        string $connectionId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('connections', $connectionId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a specific User for a Connection.
     * Required scope: `delete:users`
     *
     * @param string              $connectionId Auth0 database Connection ID (user_id with strategy of "auth0").
     * @param string              $email        Email of the user to delete.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Connections/delete_users_by_email
     */
    public function deleteUser(
        string $connectionId,
        string $email,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('connections', $connectionId, 'users')
            ->withParam('email', $email)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a new Connection.
     * Required scope: `create:connections`
     *
     * @param string              $name     The name of the bew connection.
     * @param string              $strategy The identity provider identifier for the bew connection.
     * @param array               $query    Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Connections/post_connections
     */
    public function create(
        string $name,
        string $strategy,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'name'     => $name,
            'strategy' => $strategy
        ] + $query;

        return $this->apiClient->method('post')
            ->addPath('connections')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a Connection.
     * Required scope: `update:connections`
     *
     * @param string              $connectionId Connection ID to update.
     * @param array               $query        Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Connections/patch_connections_by_id
     */
    public function update(
        string $connectionId,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('patch')
            ->addPath('connections', $connectionId)
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }
}
