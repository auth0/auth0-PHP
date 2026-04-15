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
use Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Synchronizations\SynchronizationsClientInterface;

interface DirectoryProvisioningClientInterface
{
    /**
     * Retrieve a list of directory provisioning configurations of a tenant.
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
     * @return SynchronizationsClientInterface
     */
    public function getSynchronizations(): SynchronizationsClientInterface;
}
