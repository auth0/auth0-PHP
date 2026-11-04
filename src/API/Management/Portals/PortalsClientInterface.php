<?php

namespace Auth0\SDK\API\Management\Portals;

use Auth0\SDK\API\Management\Types\ListPortalsResponseContent;
use Auth0\SDK\API\Management\Portals\Requests\CreatePortalRequestContent;
use Auth0\SDK\API\Management\Types\Portal;
use Auth0\SDK\API\Management\Portals\Requests\UpdatePortalRequestContent;

interface PortalsClientInterface
{
    /**
     * Example:
     * ```php
     * $client->portals->list();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListPortalsResponseContent
     */
    public function list(?array $options = null): ?ListPortalsResponseContent;

    /**
     * Example:
     * ```php
     * $client->portals->create(
     *     new CreatePortalRequestContent([
     *         'slug' => 'slug',
     *         'name' => 'name',
     *         'client' => new PortalClientSecretPostRequest([
     *             'tokenEndpointAuthMethod' => PortalClientSecretPostRequestTokenEndpointAuthMethod::ClientSecretPost->value,
     *             'clientId' => 'client_id',
     *             'clientSecret' => 'client_secret',
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param CreatePortalRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?Portal
     */
    public function create(CreatePortalRequestContent $request, ?array $options = null): ?Portal;

    /**
     * Example:
     * ```php
     * $client->portals->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?Portal
     */
    public function get(string $id, ?array $options = null): ?Portal;

    /**
     * Example:
     * ```php
     * $client->portals->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;

    /**
     * Example:
     * ```php
     * $client->portals->update(
     *     'id',
     *     new UpdatePortalRequestContent([]),
     * );
     * ```
     *
     * @param string $id
     * @param UpdatePortalRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?Portal
     */
    public function update(string $id, UpdatePortalRequestContent $request = new UpdatePortalRequestContent(), ?array $options = null): ?Portal;
}
