<?php

namespace Auth0\SDK\API\Management\Users;

use Auth0\SDK\API\Management\Users\Requests\ListUsersRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserResponseSchema;
use Auth0\SDK\API\Management\Users\Requests\CreateUserRequestContent;
use Auth0\SDK\API\Management\Types\CreateUserResponseContent;
use Auth0\SDK\API\Management\Users\Requests\ListUsersByEmailRequestParameters;
use Auth0\SDK\API\Management\Users\Requests\GetUserRequestParameters;
use Auth0\SDK\API\Management\Types\GetUserResponseContent;
use Auth0\SDK\API\Management\Users\Requests\UpdateUserRequestContent;
use Auth0\SDK\API\Management\Types\UpdateUserResponseContent;
use Auth0\SDK\API\Management\Types\RegenerateUsersRecoveryCodeResponseContent;
use Auth0\SDK\API\Management\Users\Requests\RevokeUserAccessRequestContent;
use Auth0\SDK\API\Management\Users\AuthenticationMethods\AuthenticationMethodsClientInterface;
use Auth0\SDK\API\Management\Users\Authenticators\AuthenticatorsClientInterface;
use Auth0\SDK\API\Management\Users\ConnectedAccounts\ConnectedAccountsClientInterface;
use Auth0\SDK\API\Management\Users\EffectivePermissions\EffectivePermissionsClientInterface;
use Auth0\SDK\API\Management\Users\EffectiveRoles\EffectiveRolesClientInterface;
use Auth0\SDK\API\Management\Users\Enrollments\EnrollmentsClientInterface;
use Auth0\SDK\API\Management\Users\FederatedConnectionsTokensets\FederatedConnectionsTokensetsClientInterface;
use Auth0\SDK\API\Management\Users\Groups\GroupsClientInterface;
use Auth0\SDK\API\Management\Users\Identities\IdentitiesClientInterface;
use Auth0\SDK\API\Management\Users\Logs\LogsClientInterface;
use Auth0\SDK\API\Management\Users\Multifactor\MultifactorClientInterface;
use Auth0\SDK\API\Management\Users\Organizations\OrganizationsClientInterface;
use Auth0\SDK\API\Management\Users\Permissions\PermissionsClientInterface;
use Auth0\SDK\API\Management\Users\RiskAssessments\RiskAssessmentsClientInterface;
use Auth0\SDK\API\Management\Users\Roles\RolesClientInterface;
use Auth0\SDK\API\Management\Users\RefreshToken\RefreshTokenClientInterface;
use Auth0\SDK\API\Management\Users\Sessions\SessionsClientInterface;

interface UsersClientInterface
{
    /**
     * Retrieve details of users. It is possible to:
     *
     * - Specify a search criteria for users
     * - Sort the users to be returned
     * - Select the fields to be returned
     * - Specify the number of users to retrieve per page and the page index
     *
     *
     *
     * The `q` query parameter can be used to get users that match the specified criteria [using query string syntax.](https://auth0.com/docs/users/search/v3/query-syntax)
     *
     * [Learn more about searching for users.](https://auth0.com/docs/users/search/v3)
     *
     * Read about [best practices](https://auth0.com/docs/users/search/best-practices) when working with the API endpoints for retrieving users.
     *
     *
     *
     * Auth0 limits the number of users you can return. If you exceed this threshold, please redefine your search, use the [export job](https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports), or the [User Import / Export](https://auth0.com/docs/extensions/user-import-export) extension.
     *
     * @param ListUsersRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserResponseSchema>
     */
    public function list(ListUsersRequestParameters $request = new ListUsersRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new user for a given [database](https://auth0.com/docs/connections/database) or [passwordless](https://auth0.com/docs/connections/passwordless) connection.
     *
     * Note: `connection` is required but other parameters such as `email` and `password` are dependent upon the type of connection.
     *
     * @param CreateUserRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateUserResponseContent
     */
    public function create(CreateUserRequestContent $request, ?array $options = null): ?CreateUserResponseContent;

    /**
     * Find users by email. If Auth0 is the identity provider (idP), the email address associated with a user is saved in lower case, regardless of how you initially provided it.
     *
     * For example, if you register a user as JohnSmith@example.com, Auth0 saves the user's email as johnsmith@example.com.
     *
     * Therefore, when using this endpoint, make sure that you are searching for users via email addresses using the correct case.
     *
     * @param ListUsersByEmailRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<UserResponseSchema>
     */
    public function listUsersByEmail(ListUsersByEmailRequestParameters $request, ?array $options = null): ?array;

    /**
     * Retrieve user details. A list of fields to include or exclude may also be specified. For more information, see [Retrieve Users with the Get Users Endpoint](https://auth0.com/docs/manage-users/user-search/retrieve-users-with-get-users-endpoint).
     *
     * @param string $id ID of the user to retrieve.
     * @param GetUserRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetUserResponseContent
     */
    public function get(string $id, GetUserRequestParameters $request = new GetUserRequestParameters(), ?array $options = null): ?GetUserResponseContent;

    /**
     * Delete a user by user ID. This action cannot be undone. For Auth0 Dashboard instructions, see [Delete Users](https://auth0.com/docs/manage-users/user-accounts/delete-users).
     *
     * @param string $id ID of the user to delete.
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
     * Update a user.
     *
     * These are the attributes that can be updated at the root level:
     *
     * - app_metadata
     * - blocked
     * - email
     * - email_verified
     * - family_name
     * - given_name
     * - name
     * - nickname
     * - password
     * - phone_number
     * - phone_verified
     * - picture
     * - username
     * - user_metadata
     * - verify_email
     *
     * Some considerations:
     *
     * - The properties of the new object will replace the old ones.
     * - The metadata fields are an exception to this rule (`user_metadata` and `app_metadata`). These properties are merged instead of being replaced but be careful, the merge only occurs on the first level.
     * - If you are updating `email`, `email_verified`, `phone_number`, `phone_verified`, `username` or `password` of a secondary identity, you need to specify the `connection` property too.
     * - If you are updating `email` or `phone_number` you can specify, optionally, the `client_id` property.
     * - Updating `email_verified` is not supported for enterprise and passwordless sms connections.
     * - Updating the `blocked` to `false` does not affect the user's blocked state from an excessive amount of incorrectly provided credentials. Use the "Unblock a user" endpoint from the "User Blocks" API to change the user's state.
     * - Supported attributes can be unset by supplying `null` as the value.
     *
     * **Updating a field (non-metadata property)**
     *
     * To mark the email address of a user as verified, the body to send should be:
     *
     * ```json
     * { "email_verified": true }
     * ```
     *
     * **Updating a user metadata root property**
     *
     * Let's assume that our test user has the following `user_metadata`:
     *
     * ```json
     * { "user_metadata" : { "profileCode": 1479 } }
     * ```
     *
     * To add the field `addresses` the body to send should be:
     *
     * ```json
     * { "user_metadata" : { "addresses": {"work_address": "100 Industrial Way"} }}
     * ```
     *
     * The modified object ends up with the following `user_metadata` property:
     *
     * ```json
     * {
     *   "user_metadata": {
     *     "profileCode": 1479,
     *     "addresses": { "work_address": "100 Industrial Way" }
     *   }
     * }
     * ```
     *
     * **Updating an inner user metadata property**
     *
     * If there's existing user metadata to which we want to add  `"home_address": "742 Evergreen Terrace"` (using the `addresses` property) we should send the whole `addresses` object. Since this is a first-level object, the object will be merged in, but its own properties will not be. The body to send should be:
     *
     * ```json
     * {
     *   "user_metadata": {
     *     "addresses": {
     *       "work_address": "100 Industrial Way",
     *       "home_address": "742 Evergreen Terrace"
     *     }
     *   }
     * }
     * ```
     *
     * The modified object ends up with the following `user_metadata` property:
     *
     * ```json
     * {
     *   "user_metadata": {
     *     "profileCode": 1479,
     *     "addresses": {
     *       "work_address": "100 Industrial Way",
     *       "home_address": "742 Evergreen Terrace"
     *     }
     *   }
     * }
     * ```
     *
     * @param string $id ID of the user to update.
     * @param UpdateUserRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateUserResponseContent
     */
    public function update(string $id, UpdateUserRequestContent $request = new UpdateUserRequestContent(), ?array $options = null): ?UpdateUserResponseContent;

    /**
     * Remove an existing multi-factor authentication (MFA) [recovery code](https://auth0.com/docs/secure/multi-factor-authentication/reset-user-mfa) and generate a new one. If a user cannot access the original device or account used for MFA enrollment, they can use a recovery code to authenticate.
     *
     * @param string $id ID of the user to regenerate a multi-factor authentication recovery code for.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RegenerateUsersRecoveryCodeResponseContent
     */
    public function regenerateRecoveryCode(string $id, ?array $options = null): ?RegenerateUsersRecoveryCodeResponseContent;

    /**
     * Revokes selected resources related to a user (sessions, refresh tokens, ...).
     *
     * @param string $id ID of the user.
     * @param RevokeUserAccessRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function revokeAccess(string $id, RevokeUserAccessRequestContent $request = new RevokeUserAccessRequestContent(), ?array $options = null): void;

    /**
     * @return AuthenticationMethodsClientInterface
     */
    public function getAuthenticationMethods(): AuthenticationMethodsClientInterface;

    /**
     * @return AuthenticatorsClientInterface
     */
    public function getAuthenticators(): AuthenticatorsClientInterface;

    /**
     * @return ConnectedAccountsClientInterface
     */
    public function getConnectedAccounts(): ConnectedAccountsClientInterface;

    /**
     * @return EffectivePermissionsClientInterface
     */
    public function getEffectivePermissions(): EffectivePermissionsClientInterface;

    /**
     * @return EffectiveRolesClientInterface
     */
    public function getEffectiveRoles(): EffectiveRolesClientInterface;

    /**
     * @return EnrollmentsClientInterface
     */
    public function getEnrollments(): EnrollmentsClientInterface;

    /**
     * @return FederatedConnectionsTokensetsClientInterface
     */
    public function getFederatedConnectionsTokensets(): FederatedConnectionsTokensetsClientInterface;

    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface;

    /**
     * @return IdentitiesClientInterface
     */
    public function getIdentities(): IdentitiesClientInterface;

    /**
     * @return LogsClientInterface
     */
    public function getLogs(): LogsClientInterface;

    /**
     * @return MultifactorClientInterface
     */
    public function getMultifactor(): MultifactorClientInterface;

    /**
     * @return OrganizationsClientInterface
     */
    public function getOrganizations(): OrganizationsClientInterface;

    /**
     * @return PermissionsClientInterface
     */
    public function getPermissions(): PermissionsClientInterface;

    /**
     * @return RiskAssessmentsClientInterface
     */
    public function getRiskAssessments(): RiskAssessmentsClientInterface;

    /**
     * @return RolesClientInterface
     */
    public function getRoles(): RolesClientInterface;

    /**
     * @return RefreshTokenClientInterface
     */
    public function getRefreshToken(): RefreshTokenClientInterface;

    /**
     * @return SessionsClientInterface
     */
    public function getSessions(): SessionsClientInterface;
}
