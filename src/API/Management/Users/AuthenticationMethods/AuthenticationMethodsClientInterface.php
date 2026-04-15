<?php

namespace Auth0\SDK\API\Management\Users\AuthenticationMethods;

use Auth0\SDK\API\Management\Users\AuthenticationMethods\Requests\ListUserAuthenticationMethodsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserAuthenticationMethod;
use Auth0\SDK\API\Management\Users\AuthenticationMethods\Requests\CreateUserAuthenticationMethodRequestContent;
use Auth0\SDK\API\Management\Types\CreateUserAuthenticationMethodResponseContent;
use Auth0\SDK\API\Management\Types\SetUserAuthenticationMethods;
use Auth0\SDK\API\Management\Types\SetUserAuthenticationMethodResponseContent;
use Auth0\SDK\API\Management\Types\GetUserAuthenticationMethodResponseContent;
use Auth0\SDK\API\Management\Users\AuthenticationMethods\Requests\UpdateUserAuthenticationMethodRequestContent;
use Auth0\SDK\API\Management\Types\UpdateUserAuthenticationMethodResponseContent;

interface AuthenticationMethodsClientInterface
{
    /**
     * Retrieve detailed list of authentication methods associated with a specified user.
     *
     * @param string $id The ID of the user in question.
     * @param ListUserAuthenticationMethodsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserAuthenticationMethod>
     */
    public function list(string $id, ListUserAuthenticationMethodsRequestParameters $request = new ListUserAuthenticationMethodsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create an authentication method. Authentication methods created via this endpoint will be auto confirmed and should already have verification completed.
     *
     * @param string $id The ID of the user to whom the new authentication method will be assigned.
     * @param CreateUserAuthenticationMethodRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateUserAuthenticationMethodResponseContent
     */
    public function create(string $id, CreateUserAuthenticationMethodRequestContent $request, ?array $options = null): ?CreateUserAuthenticationMethodResponseContent;

    /**
     * Replace the specified user <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors"> authentication methods</a> with supplied values.
     *
     *     <b>Note</b>: Authentication methods supplied through this action do not iterate on existing methods. Instead, any methods passed will overwrite the user&#8217s existing settings.
     *
     * @param string $id The ID of the user in question.
     * @param array<SetUserAuthenticationMethods> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<SetUserAuthenticationMethodResponseContent>
     */
    public function set(string $id, array $request, ?array $options = null): ?array;

    /**
     * Remove all authentication methods (i.e., enrolled MFA factors) from the specified user account. This action cannot be undone.
     *
     * @param string $id The ID of the user in question.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function deleteAll(string $id, ?array $options = null): void;

    /**
     * @param string $id The ID of the user in question.
     * @param string $authenticationMethodId The ID of the authentication methods in question.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetUserAuthenticationMethodResponseContent
     */
    public function get(string $id, string $authenticationMethodId, ?array $options = null): ?GetUserAuthenticationMethodResponseContent;

    /**
     * Remove the authentication method with the given ID from the specified user. For more information, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/manage-mfa-auth0-apis/manage-authentication-methods-with-management-api">Manage Authentication Methods with Management API</a>.
     *
     * @param string $id The ID of the user in question.
     * @param string $authenticationMethodId The ID of the authentication method to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $authenticationMethodId, ?array $options = null): void;

    /**
     * Modify the authentication method with the given ID from the specified user. For more information, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/manage-mfa-auth0-apis/manage-authentication-methods-with-management-api">Manage Authentication Methods with Management API</a>.
     *
     * @param string $id The ID of the user in question.
     * @param string $authenticationMethodId The ID of the authentication method to update.
     * @param UpdateUserAuthenticationMethodRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateUserAuthenticationMethodResponseContent
     */
    public function update(string $id, string $authenticationMethodId, UpdateUserAuthenticationMethodRequestContent $request = new UpdateUserAuthenticationMethodRequestContent(), ?array $options = null): ?UpdateUserAuthenticationMethodResponseContent;
}
