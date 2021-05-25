<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Clients.
 * Handles requests to the Clients endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Clients
 */
final class Clients extends ManagementEndpoint
{
    /**
     * Create a new Client.
     * Required scope: `create:clients`
     *
     * @param string              $name    Name of the new client.
     * @param array               $body    Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/post_clients
     */
    public function create(
        string $name,
        array $body = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($name, 'name');

        $payload = [
            'name' => $name,
        ] + $body;

        return $this->apiClient->method('post')
            ->addPath('clients')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get all Clients.
     * Required scopes:
     * - `read:clients` for any call to this endpoint.
     * - `read:client_keys` to retrieve "client_secret" and "encryption_key" attributes.
     *
     * @param array               $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/get_clients
     */
    public function getAll(
        array $parameters = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('get')
            ->addPath('clients')
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a Client.
     * Required scopes:
     * - `read:clients` for any call to this endpoint.
     * - `read:client_keys` to retrieve "client_secret" and "encryption_key" attributes.
     *
     * @param string              $id      Client (by it's ID) to query.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/get_clients_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
            ->addPath('clients', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a Client.
     * Required scopes:
     * - `update:clients` for any call to this endpoint.
     * - `update:client_keys` to update "client_secret" and "encryption_key" attributes.
     *
     * @param string              $id      Client (by it's ID) to update.
     * @param array               $body    Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/patch_clients_by_id
     */
    public function update(
        string $id,
        array $body = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('patch')
            ->addPath('clients', $id)
            ->withBody($body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a Client.
     * Required scope: `delete:clients"
     *
     * @param string              $id      Client (by it's ID) to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/delete_clients_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('delete')
            ->addPath('clients', $id)
            ->withOptions($options)
            ->call();
    }
}
