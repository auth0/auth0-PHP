<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface UsersInterface.
 */
interface UsersInterface
{
    /**
     * Create a new user for a given database or passwordless connection.
     * Required scope: `create:users`.
     *
     * @param  string  $connection  connection (by ID) to use for the new User
     * @param  array<mixed>  $body  Configuration for the new User. Some parameters are dependent upon the type of connection. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `connection` or `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/post_users
     */
    public function create(
        string $connection,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Search all Users.
     * Required scopes:
     * - `read:users` for any call to this endpoint.
     * - `read:user_idp_tokens` to retrieve the "access_token" field for logged-in identities.
     *
     * @param  array<int|string|null>|null  $parameters  Optional. Query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/users/search/v3
     * @see https://auth0.com/docs/api/management/v2#!/Users/get_users
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get a User.
     * Required scopes:
     * - `read:users` for any call to this endpoint.
     * - `read:user_idp_tokens` to retrieve the "access_token" field for logged-in identities.
     *
     * @param  string  $id  user (by their ID) to query
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/get_users_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update a User.
     * Required scopes:
     * - `update:users` for any call to this endpoint.
     * - `update:users_app_metadata` for any update that includes "user_metadata" or "app_metadata" fields.
     *
     * @param  string  $id  user (by their ID) to update
     * @param  array<mixed>  $body  User data to update. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/patch_users_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete a User by ID.
     * Required scope: `delete:users`.
     *
     * @param  string  $id  user ID to delete
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/delete_users_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Link one user identity to another.
     * Required scope: `update:users`.
     *
     * @param  string  $id  user ID of the primary account
     * @param  array<mixed>  $body  additional body content to send with the API request
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/post_identities
     */
    public function linkAccount(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Unlink an identity from the target user.
     * Required scope: `update:users`.
     *
     * @param  string  $id  user ID of the primary user account
     * @param  string  $provider  Identity provider name of the secondary linked account (e.g. `google-oauth2`).
     * @param  string  $identityId  ID of the secondary linked account
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id`, `provider`, or `identityId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/delete_user_identity_by_user_id
     */
    public function unlinkAccount(
        string $id,
        string $provider,
        string $identityId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Add one or more roles to a specific user.
     * Required scopes:
     * - `update:users`
     * - `read:roles`.
     *
     * @param  string  $id  user ID to add roles to
     * @param  array<string>  $roles  array of roles to add
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `roles` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/post_user_roles
     */
    public function addRoles(
        string $id,
        array $roles,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get all roles assigned to a specific user.
     * Required scopes:
     * - `read:users`
     * - `read:roles`.
     *
     * @param  string  $id  user ID to get roles for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/get_user_roles
     */
    public function getRoles(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Remove one or more roles from a specific user.
     * Required scope: `update:users`.
     *
     * @param  string  $id  user ID to remove roles from
     * @param  array<string>  $roles  array of permissions to remove
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `roles` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/delete_user_roles
     */
    public function removeRoles(
        string $id,
        array $roles,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Add one or more permissions to a specific user.
     * Required scope: `update:users`.
     *
     * @param  string  $id  user ID to add permissions to
     * @param  array{permissions: array<array{permission_name: string, resource_server_identifier: string}>}  $permissions  array of permissions to add
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `permissions` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/post_permissions
     */
    public function addPermissions(
        string $id,
        array $permissions,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get all permissions for a specific user.
     * Required scope: `read:users`.
     *
     * @param  string  $id  user ID to get permissions for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/get_permissions
     */
    public function getPermissions(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Remove one or more permissions from a specific user.
     * Required scope: `update:users`.
     *
     * @param  string  $id  user ID to remove permissions from
     * @param  array{permissions: array<array{permission_name: string, resource_server_identifier: string}>}  $permissions  array of permissions to remove
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `permissions` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/delete_permissions
     */
    public function removePermissions(
        string $id,
        array $permissions,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get log entries for a specific user.
     * Required scope: `read:logs`.
     *
     * @param  string  $id  user ID to get logs entries for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/get_logs_by_user
     */
    public function getLogs(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get organizations a specific user belongs to.
     * Required scope: `read:organizations`.
     *
     * @param  string  $id  user ID to get organization entries for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/get_user_organizations
     */
    public function getOrganizations(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve the first confirmed Guardian enrollment for a user.
     * Required scope: `read:users`.
     *
     * @param  string  $id  user ID to query
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/get_enrollments
     */
    public function getEnrollments(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Remove the current multi-factor authentication recovery code and generate a new one.
     * Required scope: `update:users`.
     *
     * @param  string  $id  user ID of the user to regenerate a multi-factor authentication recovery code for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/post_recovery_code_regeneration
     */
    public function createRecoveryCode(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Invalidate all remembered browsers across all authentication factors for a user.
     * Required scope: `update:users`.
     *
     * @param  string  $id  user ID of the user to invalidate all remembered browsers and authentication factors for
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/post_invalidate_remember_browser
     */
    public function invalidateBrowsers(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete the multifactor provider settings for a particular user.
     * This will force user to re-configure the multifactor provider.
     * Required scope: `update:users`.
     *
     * @param  string  $id  user ID with the multifactor provider to delete
     * @param  string  $provider  multifactor provider to delete
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` or `provider` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/delete_multifactor_by_provider
     */
    public function deleteMultifactorProvider(
        string $id,
        string $provider,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
