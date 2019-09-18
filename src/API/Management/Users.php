<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\SDK\Exception\InvalidPermissionsArrayException;

/**
 * Class Users.
 * Handles requests to the Users endpoint of the v2 Management API.
 *
 * @package Auth0\SDK\API\Management
 */
class Users extends GenericResource
{
    /**
     * Get a single User by ID.
     * Required scopes:
     *      - "read:users" - For any call to this endpoint.
     *      - "read:user_idp_tokens" - To retrieve the "access_token" field for logged-in identities.
     *
     * @param string $user_id User ID to get.
     *
     * @return mixed
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     */
    public function get($user_id)
    {
        return $this->apiClient->method('get')
            ->addPath('users', $user_id)
            ->call();
    }

    /**
     * Update a User.
     * Required scopes:
     *      - "update:users" - For any call to this endpoint.
     *      - "update:users_app_metadata" - For any update that includes "user_metadata" or "app_metadata" fields.
     *
     * @param string $user_id User ID to update.
     * @param array  $data    User data to update:
     *          - Only certain fields can be updated; see the @link below for allowed fields.
     *          - "user_metadata" and "app_metadata" fields are merged, not replaced.
     *
     * @return mixed|string
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/patch_users_by_id
     */
    public function update($user_id, array $data)
    {
        return $this->apiClient->method('patch')
            ->addPath('users', $user_id)
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Create a new User.
     * Required scope: "create:users"
     *
     * @param array $data User create data:
     *      - "connection" name field is required and limited to sms, email, & DB connections.
     *      - "phone_number" field is required by sms connections.
     *      - "email" field is required by email and DB connections.
     *      - "password" field is required by DB connections.
     *      - Depending on the connection used, may also require a "username" field.
     *
     * @return mixed|string
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_users
     */
    public function create(array $data)
    {
        if (empty($data['connection'])) {
            throw new \Exception('Missing required "connection" field.');
        }

        // A phone number is required for sms connections.
        if ('sms' === $data['connection'] && empty($data['phone_number'])) {
            throw new \Exception('Missing required "phone_number" field for sms connection.');
        }

        // An email is required for email and DB connections.
        if ('sms' !== $data['connection'] && empty($data['email'])) {
            throw new \Exception('Missing required "email" field.');
        }

        // A password is required for DB connections.
        if (! in_array( $data['connection'], [ 'email', 'sms' ] ) && empty($data['password'])) {
            throw new \Exception('Missing required "password" field for "'.$data['connection'].'" connection.');
        }

        return $this->apiClient->method('post')
            ->addPath('users')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Search all Users.
     * Required scopes:
     *      - "read:users" - For any call to this endpoint.
     *      - "read:user_idp_tokens" - To retrieve the "access_token" field for logged-in identities.
     *
     * @param array             $params         Search parameters to send:
     *      - "fields", "include_fields", "page", and "per_page" keys here will override the explicit parameters.
     *      - Queries using "search_engine" set to "v2" should be migrated to v3; see search v3 @link below.
     * @param null|string|array $fields         Fields to include or exclude from the result.
     *      - Including only the fields required can speed up API calls significantly.
     *      - Arrays will be converted to comma-separated strings.
     * @param null|boolean      $include_fields True to include $fields, false to exclude $fields.
     * @param null|integer      $page           Page number to get, zero-based.
     * @param null|integer      $per_page       Number of results to get, null to return the default number.
     *
     * @return mixed
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/users/search/v3
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_users
     */
    public function getAll(array $params = [], $fields = null, $include_fields = null, $page = null, $per_page = null)
    {
        // Fields to include/exclude.
        if (! isset($params['fields']) && null !== $fields) {
            $params['fields'] = $fields;
        }

        if (isset($params['fields'])) {
            if (is_array($params['fields'])) {
                $params['fields'] = implode(',', $params['fields']);
            }

            if (! isset($params['include_fields']) && null !== $include_fields) {
                $params['include_fields'] = (bool) $include_fields;
            }
        }

        $params = $this->normalizePagination( $params, $page, $per_page );

        return $this->apiClient->method('get')
            ->addPath('users')
            ->withDictParams($params)
            ->call();
    }

    /**
     * Delete a User by ID.
     * Required scope: "delete:users"
     *
     * @param string $user_id User ID to delete.
     *
     * @return mixed|string
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_users_by_id
     */
    public function delete($user_id)
    {
        return $this->apiClient->method('delete')
            ->addPath('users', $user_id)
            ->call();
    }

    /**
     * Link one user identity to another.
     * Required scope: "update:users"
     *
     * @param string $user_id User ID of the primary account.
     * @param array  $data    An array with the following fields:
     *          - "provider" - Secondary account provider.
     *          - "user_id" - Secondary account user ID.
     *          - "connection_id" - Secondary account Connection ID (optional).
     *
     * @return array Array of the primary account identities after the merge.
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_identities
     */
    public function linkAccount($user_id, array $data)
    {
        return $this->apiClient->method('post')
            ->addPath('users', $user_id)
            ->addPath('identities')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Unlink an identity from the target user.
     * Required scope: "update:users"
     *
     * @param string $user_id     User ID to unlink.
     * @param string $provider    Identity provider of the secondary linked account.
     * @param string $identity_id The unique identifier of the secondary linked account.
     *
     * @return mixed|string
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_user_identity_by_user_id
     */
    public function unlinkAccount($user_id, $provider, $identity_id)
    {
        return $this->apiClient->method('delete')
            ->addPath('users', $user_id)
            ->addPath('identities', $provider)
            ->addPath($identity_id)
            ->call();
    }

    /**
     * Delete the multifactor provider settings for a particular user.
     * This will force user to re-configure the multifactor provider.
     * Required scope: "update:users"
     *
     * @param string $user_id      User ID with the multifactor provider to delete.
     * @param string $mfa_provider Multifactor provider to delete.
     *
     * @return mixed|string
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_multifactor_by_provider
     */
    public function deleteMultifactorProvider($user_id, $mfa_provider)
    {
        return $this->apiClient->method('delete')
            ->addPath('users', $user_id)
            ->addPath('multifactor', $mfa_provider)
            ->call();
    }

    /**
     * Get all roles assigned to a specific user.
     * Required scopes:
     *      - "read:users"
     *      - "read:roles"
     *
     * @param string $user_id User ID to get roles for.
     * @param array  $params  Additional listing params like page, per_page, and include_totals.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_user_roles
     */
    public function getRoles($user_id, array $params = [])
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');

        $params = $this->normalizePagination( $params );
        $params = $this->normalizeIncludeTotals( $params );

        return $this->apiClient->method('get')
            ->addPath('users', $user_id)
            ->addPath('roles')
            ->withDictParams($params)
            ->call();
    }

    /**
     * Remove one or more roles from a specific user.
     * Required scope: "update:users"
     *
     * @param string $user_id User ID to remove roles from.
     * @param array  $roles   Array of permissions to remove.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws EmptyOrInvalidParameterException Thrown if the roles parameter is empty.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_user_roles
     */
    public function removeRoles($user_id, array $roles)
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');

        if (empty($roles)) {
            throw new EmptyOrInvalidParameterException('roles');
        }

        $data = [ 'roles' => $roles ];

        return $this->apiClient->method('delete')
            ->addPath('users', $user_id)
            ->addPath('roles')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Add one or more roles to a specific user.
     * Required scopes:
     *      - "update:users"
     *      - "read:roles"
     *
     * @param string $user_id User ID to add roles to.
     * @param array  $roles   Array of roles to add.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws EmptyOrInvalidParameterException Thrown if the roles parameter is empty.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_user_roles
     */
    public function addRoles($user_id, array $roles)
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');

        if (empty($roles)) {
            throw new EmptyOrInvalidParameterException('roles');
        }

        $data = [ 'roles' => $roles ];

        return $this->apiClient->method('post')
            ->addPath('users', $user_id)
            ->addPath('roles')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Get all Guardian enrollments for a specific user.
     * Required scope: "read:users"
     *
     * @param string $user_id User ID to get enrollments for.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_enrollments
     */
    public function getEnrollments($user_id)
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');

        return $this->apiClient->method('get')
            ->addPath('users', $user_id)
            ->addPath('enrollments')
            ->call();
    }

    /**
     * Get all permissions for a specific user.
     * Required scope: "read:users"
     *
     * @param string $user_id User ID to get permissions for.
     * @param array  $params  Additional listing params like page, per_page, and include_totals.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_permissions
     */
    public function getPermissions($user_id, array $params = [])
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');

        $params = $this->normalizePagination( $params );
        $params = $this->normalizeIncludeTotals( $params );

        return $this->apiClient->method('get')
            ->addPath('users', $user_id)
            ->addPath('permissions')
            ->withDictParams($params)
            ->call();
    }

    /**
     * Remove one or more permissions from a specific user.
     * Required scope: "update:users"
     *
     * @param string $user_id     User ID to remove permissions from.
     * @param array  $permissions Array of permissions to remove.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws InvalidPermissionsArrayException Thrown if the permissions parameter is malformed.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/delete_permissions
     */
    public function removePermissions($user_id, array $permissions)
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');
        $this->checkInvalidPermissions( $permissions );

        $data = [ 'permissions' => $permissions ];

        return $this->apiClient->method('delete')
            ->addPath('users', $user_id)
            ->addPath('permissions')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Add one or more permissions to a specific user.
     * Required scope: "update:users"
     *
     * @param string $user_id     User ID to add permissions to.
     * @param array  $permissions Array of permissions to add.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws InvalidPermissionsArrayException Thrown if the permissions parameter is malformed.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_permissions
     */
    public function addPermissions($user_id, array $permissions)
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');
        $this->checkInvalidPermissions( $permissions );

        $data = [ 'permissions' => $permissions ];

        return $this->apiClient->method('post')
            ->addPath('users', $user_id)
            ->addPath('permissions')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Get log entries for a specific user.
     * Required scope: "read:logs"
     *
     * @param string $user_id User ID to get logs entries for.
     * @param array  $params  Additional listing params like page, per_page, sort, and include_totals.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_logs_by_user
     */
    public function getLogs($user_id, array $params = [])
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');

        $params = $this->normalizePagination( $params );
        $params = $this->normalizeIncludeTotals( $params );

        return $this->apiClient->method('get')
            ->addPath('users', $user_id)
            ->addPath('logs')
            ->withDictParams($params)
            ->call();
    }

    /**
     * Removes the current Guardian recovery code and generates and returns a new one.
     * Required scope: "update:users"
     *
     * @param string $user_id User ID to remove and generate recovery codes for.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_recovery_code_regeneration
     */
    public function generateRecoveryCode($user_id)
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');

        return $this->apiClient->method('post')
            ->addPath('users', $user_id)
            ->addPath('recovery-code-regeneration')
            ->call();
    }

    /**
     * Invalidates all remembered browsers for all authentication factors for a specific user.
     * Required scope: "update:users"
     *
     * @param string $user_id User ID to invalidate browsers for.
     *
     * @throws EmptyOrInvalidParameterException Thrown if the user_id parameter is empty or is not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_invalidate_remember_browser
     */
    public function invalidateBrowsers($user_id)
    {
        $this->checkEmptyOrInvalidString($user_id, 'user_id');

        return $this->apiClient->method('post')
            ->addPath('users', $user_id)
            ->addPath('multifactor/actions/invalidate-remember-browser')
            ->call();
    }

    /*
     * Deprecated
     */

    // phpcs:disable

    /**
     * Wrapper for self::getAll().
     *
     * @deprecated 5.4.0, use $this->getAll instead.
     *
     * @param array $params Search parameters to send.
     *
     * @return mixed|string
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @codeCoverageIgnores - Deprecated
     */
    public function search(array $params = [])
    {
        return $this->getAll($params);
    }

    /**
     * Unlink device.
     *
     * @deprecated 5.4.0, endpoint does not exist.
     *
     * @param string $user_id   User ID.
     * @param string $device_id Device ID.
     *
     * @return void
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @codeCoverageIgnores - Deprecated
     */
    public function unlinkDevice($user_id, $device_id)
    {
        throw new \Exception('Endpoint /api/v2/users/{user_id}/devices/{device_id} does not exist.');
    }

    // phpcs:enable
}
