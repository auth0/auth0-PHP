<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Clients.
 * Handles requests to the Clients endpoint of the v2 Management API.
 *
 * https://auth0.com/docs/api/management/v2#!/Clients
 *
 * @package Auth0\SDK\API\Management
 */
class Clients extends GenericResource
{
    /**
     * Get all Clients.
     * Required scopes:
     * - `read:clients` for any call to this endpoint.
     * - `read:client_keys` to retrieve "client_secret" and "encryption_key" attributes.
     *
     * @param array               $query   Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/get_clients
     */
    public function getAll(
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('clients')
            ->withParams($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a Client.
     * Required scopes:
     * - `read:clients` for any call to this endpoint.
     * - `read:client_keys` to retrieve "client_secret" and "encryption_key" attributes.
     *
     * @param string              $clientId Client (by ID) to query.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/get_clients_by_id
     */
    public function get(
        string $clientId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('clients', $clientId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a Client.
     * Required scope: `delete:clients"
     *
     * @param string              $clientId Client (by ID) to delete.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/delete_clients_by_id
     */
    public function delete(
        string $clientId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('clients', $clientId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a new Client.
     * Required scope: `create:clients`
     *
     * @param string              $name    Name of the new client.
     * @param array               $query   Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/post_clients
     */
    public function create(
        string $name,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'name' => $name
        ] + $query;

        return $this->apiClient->method('post')
            ->addPath('clients')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a Client.
     * Required scopes:
     * - `update:clients` for any call to this endpoint.
     * - `update:client_keys` to update "client_secret" and "encryption_key" attributes.
     *
     * @param string              $clientId Client ID to update.
     * @param array               $query    Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/patch_clients_by_id
     */
    public function update(
        string $clientId,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('patch')
            ->addPath('clients', $clientId)
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }
}
