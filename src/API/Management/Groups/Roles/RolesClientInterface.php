<?php

namespace Auth0\SDK\API\Management\Groups\Roles;

use Auth0\SDK\API\Management\Groups\Roles\Requests\ListGroupRolesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Role;
use Auth0\SDK\API\Management\Groups\Roles\Requests\CreateGroupRolesRequestParameters;
use Auth0\SDK\API\Management\Groups\Roles\Requests\DeleteGroupRolesRequestContent;

interface RolesClientInterface
{
    /**
     * Lists the <a href="https://auth0.com/docs/manage-users/access-control/rbac">roles</a> assigned to a group.
     *
     * @param string $id Unique identifier for the group (service-generated).
     * @param ListGroupRolesRequestParameters $request
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
    public function list(string $id, ListGroupRolesRequestParameters $request = new ListGroupRolesRequestParameters(), ?array $options = null): Pager;

    /**
     * Assign one or more <a href="https://auth0.com/docs/manage-users/access-control/rbac">roles</a> to a specified group.
     *
     * @param string $id Unique identifier for the group (service-generated).
     * @param CreateGroupRolesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function create(string $id, CreateGroupRolesRequestParameters $request, ?array $options = null): void;

    /**
     * Unassign one or more <a href="https://auth0.com/docs/manage-users/access-control/rbac">roles</a> from a specified group.
     *
     * @param string $id Unique identifier for the group (service-generated).
     * @param DeleteGroupRolesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, DeleteGroupRolesRequestContent $request, ?array $options = null): void;
}
