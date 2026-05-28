<?php

namespace Auth0\SDK\API\Management\Roles\Groups;

use Auth0\SDK\API\Management\Roles\Groups\Requests\ListRoleGroupsParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Group;
use Auth0\SDK\API\Management\Roles\Groups\Requests\AssignRoleGroupsRequestContent;
use Auth0\SDK\API\Management\Roles\Groups\Requests\DeleteRoleGroupsRequestContent;

interface GroupsClientInterface
{
    /**
     * Lists the groups to which the specified role is assigned.
     *
     * @param string $id Unique identifier for the role (service-generated).
     * @param ListRoleGroupsParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Group>
     */
    public function get(string $id, ListRoleGroupsParameters $request = new ListRoleGroupsParameters(), ?array $options = null): Pager;

    /**
     * Assign one or more groups to a specified role.
     *
     * @param string $id Unique identifier for the role (service-generated).
     * @param AssignRoleGroupsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function create(string $id, AssignRoleGroupsRequestContent $request, ?array $options = null): void;

    /**
     * Unassign one or more groups from a specified role.
     *
     * @param string $id Unique identifier for the role (service-generated).
     * @param DeleteRoleGroupsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, DeleteRoleGroupsRequestContent $request, ?array $options = null): void;
}
