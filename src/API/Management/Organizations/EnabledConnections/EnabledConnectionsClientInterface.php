<?php

namespace Auth0\SDK\API\Management\Organizations\EnabledConnections;

use Auth0\SDK\API\Management\Organizations\EnabledConnections\Requests\ListOrganizationConnectionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationConnection;
use Auth0\SDK\API\Management\Organizations\EnabledConnections\Requests\AddOrganizationConnectionRequestContent;
use Auth0\SDK\API\Management\Types\AddOrganizationConnectionResponseContent;
use Auth0\SDK\API\Management\Types\GetOrganizationConnectionResponseContent;
use Auth0\SDK\API\Management\Organizations\EnabledConnections\Requests\UpdateOrganizationConnectionRequestContent;
use Auth0\SDK\API\Management\Types\UpdateOrganizationConnectionResponseContent;

interface EnabledConnectionsClientInterface
{
    /**
     * Retrieve details about a specific connection currently enabled for an Organization. Information returned includes details such as connection ID, name, strategy, and whether the connection automatically grants membership upon login.
     *
     * @param string $id Organization identifier.
     * @param ListOrganizationConnectionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationConnection>
     */
    public function list(string $id, ListOrganizationConnectionsRequestParameters $request = new ListOrganizationConnectionsRequestParameters(), ?array $options = null): Pager;

    /**
     * Enable a specific connection for a given Organization. To enable a connection, it must already exist within your tenant; connections cannot be created through this action.
     *
     * <a href="https://auth0.com/docs/authenticate/identity-providers">Connections</a> represent the relationship between Auth0 and a source of users. Available types of connections include database, enterprise, and social.
     *
     * @param string $id Organization identifier.
     * @param AddOrganizationConnectionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AddOrganizationConnectionResponseContent
     */
    public function add(string $id, AddOrganizationConnectionRequestContent $request, ?array $options = null): ?AddOrganizationConnectionResponseContent;

    /**
     * Retrieve details about a specific connection currently enabled for an Organization. Information returned includes details such as connection ID, name, strategy, and whether the connection automatically grants membership upon login.
     *
     * @param string $id Organization identifier.
     * @param string $connectionId Connection identifier.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationConnectionResponseContent
     */
    public function get(string $id, string $connectionId, ?array $options = null): ?GetOrganizationConnectionResponseContent;

    /**
     * Disable a specific connection for an Organization. Once disabled, Organization members can no longer use that connection to authenticate.
     *
     * <b>Note</b>: This action does not remove the connection from your tenant.
     *
     * @param string $id Organization identifier.
     * @param string $connectionId Connection identifier.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $connectionId, ?array $options = null): void;

    /**
     * Modify the details of a specific connection currently enabled for an Organization.
     *
     * @param string $id Organization identifier.
     * @param string $connectionId Connection identifier.
     * @param UpdateOrganizationConnectionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateOrganizationConnectionResponseContent
     */
    public function update(string $id, string $connectionId, UpdateOrganizationConnectionRequestContent $request = new UpdateOrganizationConnectionRequestContent(), ?array $options = null): ?UpdateOrganizationConnectionResponseContent;
}
