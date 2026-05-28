<?php

namespace Auth0\SDK\API\Management\Organizations\Groups\Roles;

use Auth0\SDK\API\Management\Organizations\Groups\Roles\Requests\ListOrganizationGroupRolesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Role;
use Auth0\SDK\API\Management\Organizations\Groups\Roles\Requests\CreateOrganizationGroupRolesRequestContent;
use Auth0\SDK\API\Management\Organizations\Groups\Roles\Requests\DeleteOrganizationGroupRolesRequestContent;

interface RolesClientInterface
{
    /**
     * Lists the roles assigned to the specified group in the context of an organization.
     *
     * @param string $organizationId ID of the organization
     * @param string $groupId ID of the group
     * @param ListOrganizationGroupRolesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Role>
     */
    public function list(string $organizationId, string $groupId, ListOrganizationGroupRolesRequestParameters $request = new ListOrganizationGroupRolesRequestParameters(), ?array $options = null): Pager;

    /**
     * Assign one or more roles to a specified group in the context of an organization.
     *
     * @param string $organizationId ID of the organization
     * @param string $groupId ID of the group
     * @param CreateOrganizationGroupRolesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function create(string $organizationId, string $groupId, CreateOrganizationGroupRolesRequestContent $request, ?array $options = null): void;

    /**
     * Unassign one or more roles from a specified group in the context of an organization.
     *
     * @param string $organizationId ID of the organization
     * @param string $groupId ID of the group
     * @param DeleteOrganizationGroupRolesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $organizationId, string $groupId, DeleteOrganizationGroupRolesRequestContent $request, ?array $options = null): void;
}
