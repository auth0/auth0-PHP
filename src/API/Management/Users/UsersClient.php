<?php

namespace Auth0\SDK\API\Management\Users;

use Auth0\SDK\API\Management\Users\AuthenticationMethods\AuthenticationMethodsClient;
use Auth0\SDK\API\Management\Users\Authenticators\AuthenticatorsClient;
use Auth0\SDK\API\Management\Users\ConnectedAccounts\ConnectedAccountsClient;
use Auth0\SDK\API\Management\Users\Enrollments\EnrollmentsClient;
use Auth0\SDK\API\Management\Users\FederatedConnectionsTokensets\FederatedConnectionsTokensetsClient;
use Auth0\SDK\API\Management\Users\Groups\GroupsClient;
use Auth0\SDK\API\Management\Users\Identities\IdentitiesClient;
use Auth0\SDK\API\Management\Users\Logs\LogsClient;
use Auth0\SDK\API\Management\Users\Multifactor\MultifactorClient;
use Auth0\SDK\API\Management\Users\Organizations\OrganizationsClient;
use Auth0\SDK\API\Management\Users\Permissions\PermissionsClient;
use Auth0\SDK\API\Management\Users\RiskAssessments\RiskAssessmentsClient;
use Auth0\SDK\API\Management\Users\Roles\RolesClient;
use Auth0\SDK\API\Management\Users\RefreshToken\RefreshTokenClient;
use Auth0\SDK\API\Management\Users\Sessions\SessionsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Users\Requests\ListUsersRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserResponseSchema;
use Auth0\SDK\API\Management\Core\Pagination\OffsetPager;
use Auth0\SDK\API\Management\Types\ListUsersOffsetPaginatedResponseContent;
use Auth0\SDK\API\Management\Users\Requests\CreateUserRequestContent;
use Auth0\SDK\API\Management\Types\CreateUserResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Users\Requests\ListUsersByEmailRequestParameters;
use Auth0\SDK\API\Management\Core\Json\JsonDecoder;
use Auth0\SDK\API\Management\Users\Requests\GetUserRequestParameters;
use Auth0\SDK\API\Management\Types\GetUserResponseContent;
use Auth0\SDK\API\Management\Users\Requests\UpdateUserRequestContent;
use Auth0\SDK\API\Management\Types\UpdateUserResponseContent;
use Auth0\SDK\API\Management\Types\RegenerateUsersRecoveryCodeResponseContent;
use Auth0\SDK\API\Management\Users\Requests\RevokeUserAccessRequestContent;
use Auth0\SDK\API\Management\Users\AuthenticationMethods\AuthenticationMethodsClientInterface;
use Auth0\SDK\API\Management\Users\Authenticators\AuthenticatorsClientInterface;
use Auth0\SDK\API\Management\Users\ConnectedAccounts\ConnectedAccountsClientInterface;
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

class UsersClient implements UsersClientInterface
{
    /**
     * @var AuthenticationMethodsClient $authenticationMethods
     */
    public AuthenticationMethodsClient $authenticationMethods;

    /**
     * @var AuthenticatorsClient $authenticators
     */
    public AuthenticatorsClient $authenticators;

    /**
     * @var ConnectedAccountsClient $connectedAccounts
     */
    public ConnectedAccountsClient $connectedAccounts;

    /**
     * @var EnrollmentsClient $enrollments
     */
    public EnrollmentsClient $enrollments;

    /**
     * @var FederatedConnectionsTokensetsClient $federatedConnectionsTokensets
     */
    public FederatedConnectionsTokensetsClient $federatedConnectionsTokensets;

    /**
     * @var GroupsClient $groups
     */
    public GroupsClient $groups;

    /**
     * @var IdentitiesClient $identities
     */
    public IdentitiesClient $identities;

    /**
     * @var LogsClient $logs
     */
    public LogsClient $logs;

    /**
     * @var MultifactorClient $multifactor
     */
    public MultifactorClient $multifactor;

    /**
     * @var OrganizationsClient $organizations
     */
    public OrganizationsClient $organizations;

    /**
     * @var PermissionsClient $permissions
     */
    public PermissionsClient $permissions;

    /**
     * @var RiskAssessmentsClient $riskAssessments
     */
    public RiskAssessmentsClient $riskAssessments;

    /**
     * @var RolesClient $roles
     */
    public RolesClient $roles;

    /**
     * @var RefreshTokenClient $refreshToken
     */
    public RefreshTokenClient $refreshToken;

    /**
     * @var SessionsClient $sessions
     */
    public SessionsClient $sessions;

    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
        $this->authenticationMethods = new AuthenticationMethodsClient($this->client, $this->options);
        $this->authenticators = new AuthenticatorsClient($this->client, $this->options);
        $this->connectedAccounts = new ConnectedAccountsClient($this->client, $this->options);
        $this->enrollments = new EnrollmentsClient($this->client, $this->options);
        $this->federatedConnectionsTokensets = new FederatedConnectionsTokensetsClient($this->client, $this->options);
        $this->groups = new GroupsClient($this->client, $this->options);
        $this->identities = new IdentitiesClient($this->client, $this->options);
        $this->logs = new LogsClient($this->client, $this->options);
        $this->multifactor = new MultifactorClient($this->client, $this->options);
        $this->organizations = new OrganizationsClient($this->client, $this->options);
        $this->permissions = new PermissionsClient($this->client, $this->options);
        $this->riskAssessments = new RiskAssessmentsClient($this->client, $this->options);
        $this->roles = new RolesClient($this->client, $this->options);
        $this->refreshToken = new RefreshTokenClient($this->client, $this->options);
        $this->sessions = new SessionsClient($this->client, $this->options);
    }

    /**
     * Retrieve details of users. It is possible to:
     *
     * - Specify a search criteria for users
     * - Sort the users to be returned
     * - Select the fields to be returned
     * - Specify the number of users to retrieve per page and the page index
     *  <!-- only v3 is available -->
     * The <code>q</code> query parameter can be used to get users that match the specified criteria <a href="https://auth0.com/docs/users/search/v3/query-syntax">using query string syntax.</a>
     *
     * <a href="https://auth0.com/docs/users/search/v3">Learn more about searching for users.</a>
     *
     * Read about <a href="https://auth0.com/docs/users/search/best-practices">best practices</a> when working with the API endpoints for retrieving users.
     *
     * Auth0 limits the number of users you can return. If you exceed this threshold, please redefine your search, use the <a href="https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports">export job</a>, or the <a href="https://auth0.com/docs/extensions/user-import-export">User Import / Export</a> extension.
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
    public function list(ListUsersRequestParameters $request = new ListUsersRequestParameters(), ?array $options = null): Pager
    {
        return new OffsetPager(
            request: $request,
            getNextPage: fn (ListUsersRequestParameters $request) => $this->_list($request, $options),
            /* @phpstan-ignore-next-line */
            getOffset: fn (ListUsersRequestParameters $request) => $request?->getPage() ?? 0,
            setOffset: function (ListUsersRequestParameters $request, int $offset) {
                $request->setPage($offset);
            },
            /* @phpstan-ignore-next-line */
            getStep: fn (ListUsersRequestParameters $request) => $request?->getPerPage() ?? 0,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListUsersOffsetPaginatedResponseContent $response) => $response?->getUsers() ?? [],
            /* @phpstan-ignore-next-line */
            hasNextPage: null,
        );
    }

    /**
     * Create a new user for a given <a href="https://auth0.com/docs/connections/database">database</a> or <a href="https://auth0.com/docs/connections/passwordless">passwordless</a> connection.
     *
     * Note: <code>connection</code> is required but other parameters such as <code>email</code> and <code>password</code> are dependent upon the type of connection.
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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateUserRequestContent $request, ?array $options = null): ?CreateUserResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "users",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return CreateUserResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function listUsersByEmail(ListUsersByEmailRequestParameters $request, ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['email'] = $request->getEmail();
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "users-by-email",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return JsonDecoder::decodeArray($json, [UserResponseSchema::class]); // @phpstan-ignore-line
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Retrieve user details. A list of fields to include or exclude may also be specified. For more information, see <a href="https://auth0.com/docs/manage-users/user-search/retrieve-users-with-get-users-endpoint">Retrieve Users with the Get Users Endpoint</a>.
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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, GetUserRequestParameters $request = new GetUserRequestParameters(), ?array $options = null): ?GetUserResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "users/{$id}",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetUserResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Delete a user by user ID. This action cannot be undone. For Auth0 Dashboard instructions, see <a href="https://auth0.com/docs/manage-users/user-accounts/delete-users">Delete Users</a>.
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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function delete(string $id, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "users/{$id}",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Update a user.
     *
     * These are the attributes that can be updated at the root level:
     *
     * <ul>
     *     <li>app_metadata</li>
     *     <li>blocked</li>
     *     <li>email</li>
     *     <li>email_verified</li>
     *     <li>family_name</li>
     *     <li>given_name</li>
     *     <li>name</li>
     *     <li>nickname</li>
     *     <li>password</li>
     *     <li>phone_number</li>
     *     <li>phone_verified</li>
     *     <li>picture</li>
     *     <li>username</li>
     *     <li>user_metadata</li>
     *     <li>verify_email</li>
     * </ul>
     *
     * Some considerations:
     * <ul>
     *     <li>The properties of the new object will replace the old ones.</li>
     *     <li>The metadata fields are an exception to this rule (<code>user_metadata</code> and <code>app_metadata</code>). These properties are merged instead of being replaced but be careful, the merge only occurs on the first level.</li>
     *     <li>If you are updating <code>email</code>, <code>email_verified</code>, <code>phone_number</code>, <code>phone_verified</code>, <code>username</code> or <code>password</code> of a secondary identity, you need to specify the <code>connection</code> property too.</li>
     *     <li>If you are updating <code>email</code> or <code>phone_number</code> you can specify, optionally, the <code>client_id</code> property.</li>
     *     <li>Updating <code>email_verified</code> is not supported for enterprise and passwordless sms connections.</li>
     *     <li>Updating the <code>blocked</code> to <code>false</code> does not affect the user's blocked state from an excessive amount of incorrectly provided credentials. Use the "Unblock a user" endpoint from the "User Blocks" API to change the user's state.</li>
     *     <li>Supported attributes can be unset by supplying <code>null</code> as the value.</li>
     * </ul>
     *
     * <h5>Updating a field (non-metadata property)</h5>
     * To mark the email address of a user as verified, the body to send should be:
     * <pre><code>{ "email_verified": true }</code></pre>
     *
     * <h5>Updating a user metadata root property</h5>Let's assume that our test user has the following <code>user_metadata</code>:
     * <pre><code>{ "user_metadata" : { "profileCode": 1479 } }</code></pre>
     *
     * To add the field <code>addresses</code> the body to send should be:
     * <pre><code>{ "user_metadata" : { "addresses": {"work_address": "100 Industrial Way"} }}</code></pre>
     *
     * The modified object ends up with the following <code>user_metadata</code> property:<pre><code>{
     *   "user_metadata": {
     *     "profileCode": 1479,
     *     "addresses": { "work_address": "100 Industrial Way" }
     *   }
     * }</code></pre>
     *
     * <h5>Updating an inner user metadata property</h5>If there's existing user metadata to which we want to add  <code>"home_address": "742 Evergreen Terrace"</code> (using the <code>addresses</code> property) we should send the whole <code>addresses</code> object. Since this is a first-level object, the object will be merged in, but its own properties will not be. The body to send should be:
     * <pre><code>{
     *   "user_metadata": {
     *     "addresses": {
     *       "work_address": "100 Industrial Way",
     *       "home_address": "742 Evergreen Terrace"
     *     }
     *   }
     * }</code></pre>
     *
     * The modified object ends up with the following <code>user_metadata</code> property:
     * <pre><code>{
     *   "user_metadata": {
     *     "profileCode": 1479,
     *     "addresses": {
     *       "work_address": "100 Industrial Way",
     *       "home_address": "742 Evergreen Terrace"
     *     }
     *   }
     * }</code></pre>
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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateUserRequestContent $request = new UpdateUserRequestContent(), ?array $options = null): ?UpdateUserResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "users/{$id}",
                    method: HttpMethod::PATCH,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return UpdateUserResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Remove an existing multi-factor authentication (MFA) <a href="https://auth0.com/docs/secure/multi-factor-authentication/reset-user-mfa">recovery code</a> and generate a new one. If a user cannot access the original device or account used for MFA enrollment, they can use a recovery code to authenticate.
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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function regenerateRecoveryCode(string $id, ?array $options = null): ?RegenerateUsersRecoveryCodeResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "users/{$id}/recovery-code-regeneration",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return RegenerateUsersRecoveryCodeResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

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
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function revokeAccess(string $id, RevokeUserAccessRequestContent $request = new RevokeUserAccessRequestContent(), ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "users/{$id}/revoke-access",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * @return AuthenticationMethodsClientInterface
     */
    public function getAuthenticationMethods(): AuthenticationMethodsClientInterface
    {
        return $this->authenticationMethods;
    }

    /**
     * @return AuthenticatorsClientInterface
     */
    public function getAuthenticators(): AuthenticatorsClientInterface
    {
        return $this->authenticators;
    }

    /**
     * @return ConnectedAccountsClientInterface
     */
    public function getConnectedAccounts(): ConnectedAccountsClientInterface
    {
        return $this->connectedAccounts;
    }

    /**
     * @return EnrollmentsClientInterface
     */
    public function getEnrollments(): EnrollmentsClientInterface
    {
        return $this->enrollments;
    }

    /**
     * @return FederatedConnectionsTokensetsClientInterface
     */
    public function getFederatedConnectionsTokensets(): FederatedConnectionsTokensetsClientInterface
    {
        return $this->federatedConnectionsTokensets;
    }

    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface
    {
        return $this->groups;
    }

    /**
     * @return IdentitiesClientInterface
     */
    public function getIdentities(): IdentitiesClientInterface
    {
        return $this->identities;
    }

    /**
     * @return LogsClientInterface
     */
    public function getLogs(): LogsClientInterface
    {
        return $this->logs;
    }

    /**
     * @return MultifactorClientInterface
     */
    public function getMultifactor(): MultifactorClientInterface
    {
        return $this->multifactor;
    }

    /**
     * @return OrganizationsClientInterface
     */
    public function getOrganizations(): OrganizationsClientInterface
    {
        return $this->organizations;
    }

    /**
     * @return PermissionsClientInterface
     */
    public function getPermissions(): PermissionsClientInterface
    {
        return $this->permissions;
    }

    /**
     * @return RiskAssessmentsClientInterface
     */
    public function getRiskAssessments(): RiskAssessmentsClientInterface
    {
        return $this->riskAssessments;
    }

    /**
     * @return RolesClientInterface
     */
    public function getRoles(): RolesClientInterface
    {
        return $this->roles;
    }

    /**
     * @return RefreshTokenClientInterface
     */
    public function getRefreshToken(): RefreshTokenClientInterface
    {
        return $this->refreshToken;
    }

    /**
     * @return SessionsClientInterface
     */
    public function getSessions(): SessionsClientInterface
    {
        return $this->sessions;
    }

    /**
     * Retrieve details of users. It is possible to:
     *
     * - Specify a search criteria for users
     * - Sort the users to be returned
     * - Select the fields to be returned
     * - Specify the number of users to retrieve per page and the page index
     *  <!-- only v3 is available -->
     * The <code>q</code> query parameter can be used to get users that match the specified criteria <a href="https://auth0.com/docs/users/search/v3/query-syntax">using query string syntax.</a>
     *
     * <a href="https://auth0.com/docs/users/search/v3">Learn more about searching for users.</a>
     *
     * Read about <a href="https://auth0.com/docs/users/search/best-practices">best practices</a> when working with the API endpoints for retrieving users.
     *
     * Auth0 limits the number of users you can return. If you exceed this threshold, please redefine your search, use the <a href="https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports">export job</a>, or the <a href="https://auth0.com/docs/extensions/user-import-export">User Import / Export</a> extension.
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
     * @return ?ListUsersOffsetPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListUsersRequestParameters $request = new ListUsersRequestParameters(), ?array $options = null): ?ListUsersOffsetPaginatedResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getPage() != null) {
            $query['page'] = $request->getPage();
        }
        if ($request->getPerPage() != null) {
            $query['per_page'] = $request->getPerPage();
        }
        if ($request->getIncludeTotals() != null) {
            $query['include_totals'] = $request->getIncludeTotals();
        }
        if ($request->getSort() != null) {
            $query['sort'] = $request->getSort();
        }
        if ($request->getConnection() != null) {
            $query['connection'] = $request->getConnection();
        }
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        if ($request->getQ() != null) {
            $query['q'] = $request->getQ();
        }
        if ($request->getSearchEngine() != null) {
            $query['search_engine'] = $request->getSearchEngine();
        }
        if ($request->getPrimaryOrder() != null) {
            $query['primary_order'] = $request->getPrimaryOrder();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "users",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListUsersOffsetPaginatedResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
