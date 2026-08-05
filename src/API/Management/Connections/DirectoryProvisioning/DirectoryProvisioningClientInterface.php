<?php

namespace Auth0\SDK\API\Management\Connections\DirectoryProvisioning;

use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests\ListDirectoryProvisioningsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\DirectoryProvisioning;
use Auth0\SDK\API\Management\Types\GetDirectoryProvisioningResponseContent;
use Auth0\SDK\API\Management\Types\CreateDirectoryProvisioningRequestContent;
use Auth0\SDK\API\Management\Types\CreateDirectoryProvisioningResponseContent;
use Auth0\SDK\API\Management\Types\UpdateDirectoryProvisioningRequestContent;
use Auth0\SDK\API\Management\Types\UpdateDirectoryProvisioningResponseContent;
use Auth0\SDK\API\Management\Types\GetDirectoryProvisioningDefaultMappingResponseContent;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests\ListSynchronizedGroupsRequestParameters;
use Auth0\SDK\API\Management\Types\SynchronizedGroupPayload;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests\AddSynchronizedGroupsRequestContent;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests\ReplaceSynchronizedGroupsRequestContent;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests\DeleteSynchronizedGroupsRequestContent;
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Synchronizations\SynchronizationsClientInterface;

interface DirectoryProvisioningClientInterface
{
    /**
     * Retrieve a list of directory provisioning configurations of a tenant.
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->list(
     *     new ListDirectoryProvisioningsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListDirectoryProvisioningsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<DirectoryProvisioning>
     */
    public function list(ListDirectoryProvisioningsRequestParameters $request = new ListDirectoryProvisioningsRequestParameters(), ?array $options = null): Pager;

    /**
     * Retrieve the directory provisioning configuration of a connection.
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id The id of the connection to retrieve its directory provisioning configuration
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetDirectoryProvisioningResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetDirectoryProvisioningResponseContent;

    /**
     * Create a directory provisioning configuration for a connection.
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->create(
     *     'id',
     *     new CreateDirectoryProvisioningRequestContent([]),
     * );
     * ```
     *
     * @param string $id The id of the connection to create its directory provisioning configuration
     * @param ?CreateDirectoryProvisioningRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateDirectoryProvisioningResponseContent
     */
    public function create(string $id, ?CreateDirectoryProvisioningRequestContent $request = null, ?array $options = null): ?CreateDirectoryProvisioningResponseContent;

    /**
     * Delete the directory provisioning configuration of a connection.
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id The id of the connection to delete its directory provisioning configuration
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
     * Update the directory provisioning configuration of a connection.
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->update(
     *     'id',
     *     new UpdateDirectoryProvisioningRequestContent([]),
     * );
     * ```
     *
     * @param string $id The id of the connection to create its directory provisioning configuration
     * @param ?UpdateDirectoryProvisioningRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateDirectoryProvisioningResponseContent
     */
    public function update(string $id, ?UpdateDirectoryProvisioningRequestContent $request = null, ?array $options = null): ?UpdateDirectoryProvisioningResponseContent;

    /**
     * Retrieve the directory provisioning default attribute mapping of a connection.
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->getDefaultMapping(
     *     'id',
     * );
     * ```
     *
     * @param string $id The id of the connection to retrieve its directory provisioning configuration
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetDirectoryProvisioningDefaultMappingResponseContent
     */
    public function getDefaultMapping(string $id, ?array $options = null): ?GetDirectoryProvisioningDefaultMappingResponseContent;

    /**
     * Retrieve the configured synchronized groups for a connection directory provisioning configuration.
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->listSynchronizedGroups(
     *     'id',
     *     new ListSynchronizedGroupsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *         'q' => 'q',
     *     ]),
     * );
     * ```
     *
     * @param string $id The id of the connection to list synchronized groups for.
     * @param ListSynchronizedGroupsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<SynchronizedGroupPayload>
     */
    public function listSynchronizedGroups(string $id, ListSynchronizedGroupsRequestParameters $request = new ListSynchronizedGroupsRequestParameters(), ?array $options = null): Pager;

    /**
     * Add synchronized group selections to a directory provisioning configuration.
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->addSynchronizedGroupSelections(
     *     'id',
     *     new AddSynchronizedGroupsRequestContent([
     *         'groups' => [
     *             new SynchronizedGroupPayload([
     *                 'id' => 'id',
     *             ]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id The id of the connection to add synchronized groups to
     * @param AddSynchronizedGroupsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function addSynchronizedGroupSelections(string $id, AddSynchronizedGroupsRequestContent $request, ?array $options = null): void;

    /**
     * Create or replace the selected groups for a connection directory provisioning configuration.
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->set(
     *     'id',
     *     new ReplaceSynchronizedGroupsRequestContent([
     *         'groups' => [
     *             new SynchronizedGroupPayload([
     *                 'id' => 'id',
     *             ]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id The id of the connection to create or replace synchronized groups for
     * @param ReplaceSynchronizedGroupsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function set(string $id, ReplaceSynchronizedGroupsRequestContent $request, ?array $options = null): void;

    /**
     * Delete synchronized group selections for a directory provisioning configuration
     *
     * Example:
     * ```php
     * $client->connections->directoryProvisioning->deleteSynchronizedGroupSelections(
     *     'id',
     *     new DeleteSynchronizedGroupsRequestContent([
     *         'groups' => [
     *             new SynchronizedGroupSelectionId([
     *                 'id' => 'id',
     *             ]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id The id of the connection to delete synchronized group selections for
     * @param DeleteSynchronizedGroupsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function deleteSynchronizedGroupSelections(string $id, DeleteSynchronizedGroupsRequestContent $request, ?array $options = null): void;

    /**
     * @return SynchronizationsClientInterface
     */
    public function getSynchronizations(): SynchronizationsClientInterface;
}
