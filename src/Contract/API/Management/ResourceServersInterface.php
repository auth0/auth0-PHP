<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ResourceServersInterface.
 */
interface ResourceServersInterface
{
    /**
     * Create a new Resource Server.
     * Required scope: `create:resource_servers`.
     *
     * @param  string  $identifier  API identifier to use
     * @param  array<mixed>  $body  Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `identifier` or `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Resource_Servers/post_resource_servers
     */
    public function create(
        string $identifier,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get all Resource Servers, by page if desired.
     * Required scope: `read:resource_servers`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Resource_Servers/get_resource_servers
     */
    public function getAll(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get a single Resource Server by ID or API identifier.
     * Required scope: `read:resource_servers`.
     *
     * @param  string  $id  resource Server ID or identifier to get
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Resource_Servers/get_resource_servers_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update a Resource Server by ID.
     * Required scope: `update:resource_servers`.
     *
     * @param  string  $id  resource Server ID or identifier to update
     * @param  array<mixed>  $body  Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Resource_Servers/patch_resource_servers_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete a Resource Server by ID.
     * Required scope: `delete:resource_servers`.
     *
     * @param  string  $id  resource Server ID or identifier to delete
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Resource_Servers/delete_resource_servers_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
