<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
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
     * @param string                 $identifier API identifier to use.
     * @param array<mixed> $body     Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null    $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `identifier` or `body` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/post_resource_servers
     */
    public function create(
        string $identifier,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$identifier] = Toolkit::filter([$identifier])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$identifier, \Auth0\SDK\Exception\ArgumentException::missing('identifier')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('resource-servers')
            ->withBody(
                (object) Toolkit::merge([
                    'identifier' => $identifier,
                ], $body)
            )
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
        return $this->getHttpClient()
            ->method('get')
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
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/get_resource_servers_by_id
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
            ->addPath('resource-servers', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a Resource Server by ID.
     * Required scope: `update:resource_servers`
     *
     * @param string              $id      Resource Server ID or identifier to update.
     * @param array<mixed>        $body    Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` or `body` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/patch_resource_servers_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
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
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Resource_Servers/delete_resource_servers_by_id
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
            ->addPath('resource-servers', $id)
            ->withOptions($options)
            ->call();
    }
}
