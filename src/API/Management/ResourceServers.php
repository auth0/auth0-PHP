<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ResourceServers.
 * Handles requests to the Resource Servers endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers
 */
final class ResourceServers extends ManagementEndpoint
{
    /**
     * Create a new Resource Server.
     * Required scope: `create:resource_servers`
     *
     * @param string              $identifier API identifier to use.
     * @param array               $body       Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/post_resource_servers
     */
    public function create(
        string $identifier,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($identifier, 'identifier');
        $this->validateArray($body, 'body');

        $payload = [
            'identifier' => $identifier,
        ] + $body;

        return $this->getHttpClient()->method('post')
            ->addPath('resource-servers')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get all Resource Servers, by page if desired.
     * Required scope: `read:resource_servers`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/get_resource_servers
     */
    public function getAll(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()->method('get')
            ->addPath('resource-servers')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a single Resource Server by ID or API identifier.
     * Required scope: `read:resource_servers`
     *
     * @param string              $id      Resource Server ID or identifier to get.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/get_resource_servers_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->getHttpClient()->method('get')
            ->addPath('resource-servers', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a Resource Server by ID.
     * Required scope: `update:resource_servers`
     *
     * @param string              $id      Resource Server ID or identifier to update.
     * @param array               $body    Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/patch_resource_servers_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateArray($body, 'body');

        return $this->getHttpClient()->method('patch')
            ->addPath('resource-servers', $id)
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a Resource Server by ID.
     * Required scope: `delete:resource_servers`
     *
     * @param string              $id      Resource Server ID or identifier to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/delete_resource_servers_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->getHttpClient()->method('delete')
            ->addPath('resource-servers', $id)
            ->withOptions($options)
            ->call();
    }
}
