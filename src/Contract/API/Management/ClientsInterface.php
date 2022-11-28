<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ClientsInterface.
 */
interface ClientsInterface
{
    /**
     * Create a new Client.
     * Required scope: `create:clients`.
     *
     * @param  string  $name  name of the new client
     * @param  array<mixed>|null  $body  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `name` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Clients/post_clients
     */
    public function create(
        string $name,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get all Clients.
     * Required scopes:
     * - `read:clients` for any call to this endpoint.
     * - `read:client_keys` to retrieve "client_secret" and "encryption_key" attributes.
     *
     * @param  array<int|string|null>|null  $parameters  Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Clients/get_clients
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get a Client.
     * Required scopes:
     * - `read:clients` for any call to this endpoint.
     * - `read:client_keys` to retrieve "client_secret" and "encryption_key" attributes.
     *
     * @param  string  $id  client (by it's ID) to query
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Clients/get_clients_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update a Client.
     * Required scopes:
     * - `update:clients` for any call to this endpoint.
     * - `update:client_keys` to update "client_secret" and "encryption_key" attributes.
     *
     * @param  string  $id  client (by it's ID) to update
     * @param  array<mixed>|null  $body  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Clients/patch_clients_by_id
     */
    public function update(
        string $id,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete a Client.
     * Required scope: `delete:clients".
     *
     * @param  string  $id  client (by it's ID) to delete
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Clients/delete_clients_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
