<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\CoreException;

/**
 * Class Roles.
 * Handles requests to the Roles endpoint of the v2 Management API.
 *
 * @package Auth0\SDK\API\Management
 */
class Roles extends GenericResource
{
    /**
     * Get all Roles
     * Required scope: "read:roles"
     *
     * @param array $params Additional parameters to send with the request.
     *
     * @return mixed
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_roles
     */
    public function getAll(array $params = [])
    {
        return $this->apiClient->method('get')
            ->withDictParams($this->normalizePagination( $params ))
            ->addPath('roles')
            ->call();
    }

    /**
     * Create a new Role.
     * Required scope: "create:roles"
     *
     * @param string $name Role name.
     * @param array  $data Additional fields to add, like description.
     *
     * @return mixed
     *
     * @throws CoreException Thrown if the identifier parameter or data field is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/post_roles
     */
    public function create($name, array $data = [])
    {
        $data['name'] = (string) $name;

        if (empty($data['name'])) {
            throw new CoreException('Missing required name parameter.');
        }

        return $this->apiClient->method('post')
            ->addPath('roles')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Get a single Role by ID.
     * Required scope: "read:roles"
     *
     * @param string $role_id Role ID to get.
     *
     * @return mixed
     *
     * @throws CoreException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_roles_by_id
     */
    public function get($role_id)
    {
        if (empty($role_id) || ! is_string($role_id)) {
            throw new CoreException('Invalid or missing role_id parameter.');
        }

        return $this->apiClient->method('get')
            ->addPath('roles', $role_id)
            ->call();
    }

    /**
     * Delete a single Role by ID.
     * Required scope: "delete:roles"
     *
     * @param string $role_id Role ID to delete.
     *
     * @return mixed
     *
     * @throws CoreException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/delete_roles_by_id
     */
    public function delete($role_id)
    {
        if (empty($role_id) || ! is_string($role_id)) {
            throw new CoreException('Invalid or missing role_id parameter.');
        }

        return $this->apiClient->method('delete')
            ->addPath('roles', $role_id)
            ->call();
    }

    /**
     * Update a Role by ID.
     * Required scope: "update:roles"
     *
     * @param string $role_id Role to ID update.
     * @param array  $data    Data to update.
     *
     * @return mixed
     *
     * @throws CoreException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/patch_roles_by_id
     */
    public function update($role_id, array $data)
    {
        if (empty($role_id) || ! is_string($role_id)) {
            throw new CoreException('Invalid or missing role_id parameter.');
        }

        return $this->apiClient->method('patch')
            ->addPath('roles', $role_id)
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Get the permissions associated to a role.
     * Required scope: "read:roles"
     *
     * @param string $role_id Role to ID to get permissions.
     * @param array  $params  Additional parameters to send with the request.
     *
     * @return mixed
     *
     * @throws CoreException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_role_permission
     */
    public function getPermissions($role_id, array $params = [])
    {
        if (empty($role_id) || ! is_string($role_id)) {
            throw new CoreException('Invalid or missing role_id parameter.');
        }

        $params = $this->normalizePagination( $params );

        if (isset( $params['include_totals'] )) {
            $params['include_totals'] = boolval( $params['include_totals'] );
        }

        return $this->apiClient->method('get')
            ->addPath('roles', $role_id)
            ->addPathVariable('permissions')
            ->withDictParams($params)
            ->call();
    }

    /**
     * Associate permissions with a role.
     * Required scope: "update:roles"
     *
     * @param string $role_id     Role to ID to get permissions.
     * @param array  $permissions Permissions to add, array of permission arrays.
     *
     * @return mixed
     *
     * @throws CoreException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/post_role_permission_assignment
     */
    public function addPermissions($role_id, array $permissions)
    {
        if (empty($role_id) || ! is_string($role_id)) {
            throw new CoreException('Invalid or missing role_id parameter.');
        }

        if ($this->containsInvalidPermissions( $permissions )) {
            throw new CoreException(
                'All permissions must include both permission_name and resource_server_identifier keys.'
            );
        }

        $data = [ 'permissions' => $permissions ];

        return $this->apiClient->method('post')
            ->addPath('roles', $role_id)
            ->addPathVariable('permissions')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Delete permissions from a role.
     * Required scope: "update:roles"
     *
     * @param string $role_id     Role to ID to get permissions.
     * @param array  $permissions Permissions to delete, array of permission arrays.
     *
     * @return mixed
     *
     * @throws CoreException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/delete_role_permission_assignment
     */
    public function removePermissions($role_id, array $permissions)
    {
        if (empty($role_id) || ! is_string($role_id)) {
            throw new CoreException('Invalid or missing role_id parameter.');
        }

        if ($this->containsInvalidPermissions( $permissions )) {
            throw new CoreException(
                'All permissions must include both permission_name and resource_server_identifier keys.'
            );
        }

        $data = [ 'permissions' => $permissions ];

        return $this->apiClient->method('delete')
            ->addPath('roles', $role_id)
            ->addPathVariable('permissions')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Get users assigned to a specific role.
     * Required scopes:
     *      - "read:roles"
     *      - "read:users"
     *
     * @param string $role_id Role ID assigned to users.
     * @param array  $params  Additional parameters.
     *
     * @return mixed
     *
     * @throws CoreException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_role_user
     */
    public function getUsers($role_id, array $params = [])
    {
        if (empty($role_id) || ! is_string($role_id)) {
            throw new CoreException('Invalid or missing role_id parameter.');
        }

        $params = $this->normalizePagination( $params );

        if (isset( $params['include_totals'] )) {
            $params['include_totals'] = boolval( $params['include_totals'] );
        }

        return $this->apiClient->method('get')
            ->addPath('roles', $role_id)
            ->addPathVariable('users')
            ->withDictParams($params)
            ->call();
    }

    /**
     * Add one or more users to a role.
     * Required scopes: "update:roles"
     *
     * @param string $role_id Role ID to add users.
     * @param array  $users   Array of user IDs to add to the role.
     *
     * @return mixed
     *
     * @throws CoreException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/post_role_users
     */
    public function addUsers($role_id, array $users)
    {
        if (empty($role_id) || ! is_string($role_id)) {
            throw new CoreException('Invalid or missing role_id parameter.');
        }

        if (empty($users)) {
            throw new CoreException('Empty users parameter.');
        }

        $data = [ 'users' => array_unique( $users ) ];

        return $this->apiClient->method('post')
            ->addPath('roles', $role_id)
            ->addPathVariable('users')
            ->withBody(json_encode($data))
            ->call();
    }
}
