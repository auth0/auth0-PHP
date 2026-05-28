<?php

namespace Auth0\SDK\API\Management\Organizations;

use Auth0\SDK\API\Management\Organizations\Requests\ListOrganizationsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Organization;
use Auth0\SDK\API\Management\Organizations\Requests\CreateOrganizationRequestContent;
use Auth0\SDK\API\Management\Types\CreateOrganizationResponseContent;
use Auth0\SDK\API\Management\Types\GetOrganizationByNameResponseContent;
use Auth0\SDK\API\Management\Types\GetOrganizationResponseContent;
use Auth0\SDK\API\Management\Organizations\Requests\UpdateOrganizationRequestContent;
use Auth0\SDK\API\Management\Types\UpdateOrganizationResponseContent;
use Auth0\SDK\API\Management\Organizations\ClientGrants\ClientGrantsClientInterface;
use Auth0\SDK\API\Management\Organizations\Connections\ConnectionsClientInterface;
use Auth0\SDK\API\Management\Organizations\DiscoveryDomains\DiscoveryDomainsClientInterface;
use Auth0\SDK\API\Management\Organizations\EnabledConnections\EnabledConnectionsClientInterface;
use Auth0\SDK\API\Management\Organizations\Invitations\InvitationsClientInterface;
use Auth0\SDK\API\Management\Organizations\Members\MembersClientInterface;
use Auth0\SDK\API\Management\Organizations\Groups\GroupsClientInterface;

interface OrganizationsClientInterface
{
    /**
     * Retrieve detailed list of all Organizations available in your tenant. For more information, see Auth0 Organizations.
     *
     * This endpoint supports two types of pagination:
     *
     * - Offset pagination
     * - Checkpoint pagination
     *
     * Checkpoint pagination must be used if you need to retrieve more than 1000 organizations.
     *
     * **Checkpoint Pagination**
     *
     * To search by checkpoint, use the following parameters:
     *
     * - `from`: Optional id from which to start selection.
     * - `take`: The total number of entries to retrieve when using the `from` parameter. Defaults to 50.
     *
     * **Note**: The first time you call this endpoint using checkpoint pagination, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no pages are remaining.
     *
     * @param ListOrganizationsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Organization>
     */
    public function list(ListOrganizationsRequestParameters $request = new ListOrganizationsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new Organization within your tenant.  To learn more about Organization settings, behavior, and configuration options, review [Create Your First Organization](https://auth0.com/docs/manage-users/organizations/create-first-organization).
     *
     * @param CreateOrganizationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateOrganizationResponseContent
     */
    public function create(CreateOrganizationRequestContent $request, ?array $options = null): ?CreateOrganizationResponseContent;

    /**
     * Retrieve details about a single Organization specified by name.
     *
     * @param string $name name of the organization to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationByNameResponseContent
     */
    public function getByName(string $name, ?array $options = null): ?GetOrganizationByNameResponseContent;

    /**
     * Retrieve details about a single Organization specified by ID.
     *
     * @param string $id ID of the organization to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetOrganizationResponseContent;

    /**
     * Remove an Organization from your tenant.  This action cannot be undone.
     *
     * **Note**: Members are automatically disassociated from an Organization when it is deleted. However, this action does **not** delete these users from your tenant.
     *
     * @param string $id Organization identifier.
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
     * Update the details of a specific [Organization](https://auth0.com/docs/manage-users/organizations/configure-organizations/create-organizations), such as name and display name, branding options, and metadata.
     *
     * @param string $id ID of the organization to update.
     * @param UpdateOrganizationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateOrganizationResponseContent
     */
    public function update(string $id, UpdateOrganizationRequestContent $request = new UpdateOrganizationRequestContent(), ?array $options = null): ?UpdateOrganizationResponseContent;

    /**
     * @return ClientGrantsClientInterface
     */
    public function getClientGrants(): ClientGrantsClientInterface;

    /**
     * @return ConnectionsClientInterface
     */
    public function getConnections(): ConnectionsClientInterface;

    /**
     * @return DiscoveryDomainsClientInterface
     */
    public function getDiscoveryDomains(): DiscoveryDomainsClientInterface;

    /**
     * @return EnabledConnectionsClientInterface
     */
    public function getEnabledConnections(): EnabledConnectionsClientInterface;

    /**
     * @return InvitationsClientInterface
     */
    public function getInvitations(): InvitationsClientInterface;

    /**
     * @return MembersClientInterface
     */
    public function getMembers(): MembersClientInterface;

    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface;
}
