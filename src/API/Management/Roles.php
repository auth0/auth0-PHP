<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\SDK\Exception\InvalidPermissionsArrayException;

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
     * @throws EmptyOrInvalidParameterException Thrown if the name parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/post_roles
     */
    public function create($name, array $data = [])
    {
        $this->checkEmptyOrInvalidString($name, 'name');

        $data['name'] = $name;

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
     * @throws EmptyOrInvalidParameterException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_roles_by_id
     */
    public function get($role_id)
    {
        $this->checkEmptyOrInvalidString($role_id, 'role_id');

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
     * @throws EmptyOrInvalidParameterException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/delete_roles_by_id
     */
    public function delete($role_id)
    {
        $this->checkEmptyOrInvalidString($role_id, 'role_id');

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
     * @throws EmptyOrInvalidParameterException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/patch_roles_by_id
     */
    public function update($role_id, array $data)
    {
        $this->checkEmptyOrInvalidString($role_id, 'role_id');

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
     * @throws EmptyOrInvalidParameterException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_role_permission
     */
    public function getPermissions($role_id, array $params = [])
    {
        $this->checkEmptyOrInvalidString($role_id, 'role_id');

        $params = $this->normalizePagination( $params );
        $params = $this->normalizeIncludeTotals( $params );

        return $this->apiClient->method('get')
            ->addPath('roles', $role_id)
            ->addPath('permissions')
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
     * @throws EmptyOrInvalidParameterException Thrown if the role_id parameter is empty or is not a string.
     * @throws InvalidPermissionsArrayException Thrown if the permissions parameter is empty or invalid.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/post_role_permission_assignment
     */
    public function addPermissions($role_id, array $permissions)
    {
        $this->checkEmptyOrInvalidString($role_id, 'role_id');
        $this->checkInvalidPermissions( $permissions );

        $data = [ 'permissions' => $permissions ];

        return $this->apiClient->method('post')
            ->addPath('roles', $role_id)
            ->addPath('permissions')
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
     * @throws EmptyOrInvalidParameterException Thrown if the role_id parameter is empty or is not a string.
     * @throws InvalidPermissionsArrayException Thrown if the permissions parameter is empty or invalid.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/delete_role_permission_assignment
     */
    public function removePermissions($role_id, array $permissions)
    {
        $this->checkEmptyOrInvalidString($role_id, 'role_id');
        $this->checkInvalidPermissions( $permissions );

        $data = [ 'permissions' => $permissions ];

        return $this->apiClient->method('delete')
            ->addPath('roles', $role_id)
            ->addPath('permissions')
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
     * @throws EmptyOrInvalidParameterException Thrown if the id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/get_role_user
     */
    public function getUsers($role_id, array $params = [])
    {
        $this->checkEmptyOrInvalidString($role_id, 'role_id');

        $params = $this->normalizePagination( $params );
        $params = $this->normalizeIncludeTotals( $params );

        return $this->apiClient->method('get')
            ->addPath('roles', $role_id)
            ->addPath('users')
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
     * @throws EmptyOrInvalidParameterException Thrown if the role_id parameter is empty or is not a string.
     * @throws CoreException Thrown if the users parameter is empty.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Roles/post_role_users
     */
    public function addUsers($role_id, array $users)
    {
        $this->checkEmptyOrInvalidString($role_id, 'role_id');

        if (empty($users)) {
            throw new EmptyOrInvalidParameterException('users');
        }

        $data = [ 'users' => array_unique( $users ) ];

        return $this->apiClient->method('post')
            ->addPath('roles', $role_id)
            ->addPath('users')
            ->withBody(json_encode($data))
            ->call();
    }
}
