<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\SDK\Exception\InvalidPermissionsArrayException;
use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Users.
 * Handles requests to the Users endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Users
 *
 * @package Auth0\SDK\API\Management
 */
class Users extends GenericResource
{
    /**
     * Search all Users.
     * Required scopes:
     * - `read:users` for any call to this endpoint.
     * - `read:user_idp_tokens` to retrieve the "access_token" field for logged-in identities.
     *
     * @param array               $query  Optional. Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $fields Optional. Request fields be included or excluded from the API response using a FilteredRequest object.
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/users/search/v3
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_users
     */
    public function getAll(
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('users')
            ->withParams($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a User.
     * Required scopes:
     * - `read:users` for any call to this endpoint.
     * - `read:user_idp_tokens` to retrieve the "access_token" field for logged-in identities.
     *
     * @param string              $user    User (by their ID) to query.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function get(
        string $user,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('users', $user)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a User.
     * Required scopes:
     * - `update:users` for any call to this endpoint.
     * - `update:users_app_metadata` for any update that includes "user_metadata" or "app_metadata" fields.
     *
     * @param string              $id      User (by their ID) to update.
     * @param array               $query   User data to update. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/patch_users_by_id
     */
    public function update(
        string $id,
        array $query,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('patch')
            ->addPath('users', $id)
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a new user for a given database or passwordless connection.
     * Required scope: `create:users`
     *
     * @param string              $connection Connection (by ID) to use for the new User.
     * @param array               $query      Configuration for the new User. Some parameters are dependent upon the type of connection. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_users
     */
    public function create(
        string $connection,
        array $query,
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'connection' => $connection
        ] + $query;

        return $this->apiClient->method('post')
            ->addPath('users')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a User by ID.
     * Required scope: `delete:users`
     *
     * @param string              $userId  User ID to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_users_by_id
     */
    public function delete(
        string $userId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('users', $userId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Link one user identity to another.
     * Required scope: `update:users`
     *
     * @param string              $userId  User ID of the primary account.
     * @param array               $query   Additional parameters to send with the API request.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_identities
     */
    public function linkAccount(
        string $userId,
        array $query,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('post')
            ->addPath('users', $userId, 'identities')
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Unlink an identity from the target user.
     * Required scope: `update:users`
     *
     * @param string              $userId     User ID to unlink.
     * @param string              $provider   Identity provider of the secondary linked account.
     * @param string              $identityId The unique identifier of the secondary linked account.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_user_identity_by_user_id
     */
    public function unlinkAccount(
        string $userId,
        string $provider,
        string $identityId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('users', $userId, 'identities', $provider, $identityId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete the multifactor provider settings for a particular user.
     * This will force user to re-configure the multifactor provider.
     * Required scope: `update:users`
     *
     * @param string              $userId   User ID with the multifactor provider to delete.
     * @param string              $provider Multifactor provider to delete.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_multifactor_by_provider
     */
    public function deleteMultifactorProvider(
        string $userId,
        string $provider,
        ?RequestOptions $options = null
    ) {
        return $this->apiClient->method('delete')
            ->addPath('users', $userId, 'multifactor', $provider)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get all roles assigned to a specific user.
     * Required scopes:
     * - `read:users`
     * - `read:roles`
     *
     * @param string              $userId  User ID to get roles for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_user_roles
     */
    public function getRoles(
        string $userId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('users', $userId, 'roles')
            ->withOptions($options)
            ->call();
    }

    /**
     * Remove one or more roles from a specific user.
     * Required scope: `update:users`
     *
     * @param string              $userId  User ID to remove roles from.
     * @param array               $roles   Array of permissions to remove.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_user_roles
     */
    public function removeRoles(
        string $userId,
        array $roles,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('users', $userId, 'roles')
            ->withBody(
                [
                    'roles' => $roles
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Add one or more roles to a specific user.
     * Required scopes:
     * - `update:users`
     * - `read:roles`
     *
     * @param string              $userId  User ID to add roles to.
     * @param array               $roles   Array of roles to add.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_user_roles
     */
    public function addRoles(
        string $userId,
        array $roles,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('post')
            ->addPath('users', $userId, 'roles')
            ->withBody(
                [
                    'roles' => $roles
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Get all Guardian enrollments for a specific user.
     * Required scope: `read:users`
     *
     * @param string              $userId  User ID to get enrollments for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_enrollments
     */
    public function getEnrollments(
        string $userId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('users', $userId, 'enrollments')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get all permissions for a specific user.
     * Required scope: `read:users`
     *
     * @param string              $userId  User ID to get permissions for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_permissions
     */
    public function getPermissions(
        string $userId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('users', $userId, 'permissions')
            ->withOptions($options)
            ->call();
    }

    /**
     * Remove one or more permissions from a specific user.
     * Required scope: `update:users`
     *
     * @param string              $userId      User ID to remove permissions from.
     * @param array               $permissions Array of permissions to remove.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws InvalidPermissionsArrayException Thrown if the permissions parameter is malformed.
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_permissions
     */
    public function removePermissions(
        string $userId,
        array $permissions,
        ?RequestOptions $options = null
    ): ?array {
        $this->checkEmptyOrInvalidString($userId, 'user_id');
        $this->checkInvalidPermissions($permissions);

        return $this->apiClient->method('delete')
            ->addPath('users', $userId, 'permissions')
            ->withBody(
                [
                    'permissions' => $permissions
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Add one or more permissions to a specific user.
     * Required scope: `update:users`
     *
     * @param string              $userId      User ID to add permissions to.
     * @param array               $permissions Array of permissions to add.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws InvalidPermissionsArrayException Thrown if the permissions parameter is malformed.
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_permissions
     */
    public function addPermissions(
        string $userId,
        array $permissions,
        ?RequestOptions $options = null
    ): ?array {
        $this->checkEmptyOrInvalidString($userId, 'user_id');
        $this->checkInvalidPermissions($permissions);

        return $this->apiClient->method('post')
            ->addPath('users', $userId, 'permissions')
            ->withBody(
                [
                    'permissions' => $permissions
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Get log entries for a specific user.
     * Required scope: `read:logs`
     *
     * @param string              $userId  User ID to get logs entries for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_logs_by_user
     */
    public function getLogs(
        string $userId,
        ?RequestOptions $options = null
    ): ?array {
        $this->checkEmptyOrInvalidString($userId, 'user_id');

        return $this->apiClient->method('get')
            ->addPath('users', $userId, 'logs')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get organizations a specific user belongs to.
     * Required scope: `read:organizations`
     *
     * @param string              $userId  User ID to get organization entries for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return mixed
     */
    public function getOrganizations(
        string $userId,
        ?RequestOptions $options = null
    ): ?array {
        $this->checkEmptyOrInvalidString($userId, 'user_id');

        return $this->apiClient->method('get')
            ->addPath('users', $userId, 'organizations')
            ->withOptions($options)
            ->call();
    }

    /**
     * Removes the current Guardian recovery code and generates and returns a new one.
     * Required scope: `update:users`
     *
     * @param string              $userId  User ID to remove and generate recovery codes for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_recovery_code_regeneration
     */
    public function generateRecoveryCode(
        string $userId,
        ?RequestOptions $options = null
    ): ?array {
        $this->checkEmptyOrInvalidString($userId, 'user_id');

        return $this->apiClient->method('post')
            ->addPath('users', $userId, 'recovery-code-regeneration')
            ->withOptions($options)
            ->call();
    }

    /**
     * Invalidates all remembered browsers for all authentication factors for a specific user.
     * Required scope: `update:users`
     *
     * @param string              $userId  User ID to invalidate browsers for.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_invalidate_remember_browser
     */
    public function invalidateBrowsers(
        string $userId,
        ?RequestOptions $options = null
    ): ?array {
        $this->checkEmptyOrInvalidString($userId, 'user_id');

        return $this->apiClient->method('post')
            ->addPath('users', $userId, 'multifactor', 'actions', 'invalidate-remember-browser')
            ->withOptions($options)
            ->call();
    }
}
