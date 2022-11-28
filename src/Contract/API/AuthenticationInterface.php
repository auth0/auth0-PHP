<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API;

use Auth0\SDK\Utility\HttpClient;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface AuthenticationInterface.
 */
interface AuthenticationInterface
{
    /**
     * Return the HttpClient instance being used for authentication  API requests.
     */
    public function getHttpClient(): HttpClient;

    /**
     * Build and return a SAMLP link.
     *
     * @param  string|null  $clientId  Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     * @param  string|null  $connection  Optional. The connection to use. If no connection is specified, the Auth0 Login Page will be shown.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a $clientId is not configured
     *
     * @see https://auth0.com/docs/connections/enterprise/samlp
     */
    public function getSamlpLink(
        ?string $clientId = null,
        ?string $connection = null,
    ): string;

    /**
     * Build and return a SAMLP metadata link.
     *
     * @param  string|null  $clientId  Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a $clientId is not configured
     *
     * @see https://auth0.com/docs/connections/enterprise/samlp
     */
    public function getSamlpMetadataLink(
        ?string $clientId = null,
    ): string;

    /**
     * Build and return a WS-Federation link.
     *
     * @param  string|null  $clientId  Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     * @param  array<int|string|null>|null  $params  Optional. Additional parameters to include with the request. See @see for details.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a $clientId is not configured
     *
     * @see https://auth0.com/docs/protocols/ws-fed
     */
    public function getWsfedLink(
        ?string $clientId = null,
        ?array $params = null,
    ): string;

    /**
     * Build and return a WS-Federation metadata link.
     *
     * @see https://auth0.com/docs/protocols/ws-fed
     */
    public function getWsfedMetadataLink(): string;

    /**
     * Build the login URL.
     *
     * @param  string  $state  A CSRF mitigating value, also useful for restoring the previous state of your app. See https://auth0.com/docs/protocols/state-parameters
     * @param  string|null  $redirectUri  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param  array<int|string|null>|null  $params  Optional. Additional parameters to include with the request. See @see for details.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `state` is passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a $redirectUri is not configured
     *
     * @see https://auth0.com/docs/api/authentication#authorize-application
     */
    public function getLoginLink(
        string $state,
        ?string $redirectUri = null,
        ?array $params = null,
    ): string;

    /**
     * Builds and returns a logout URL to terminate an SSO session.
     *
     * @param  string|null  $returnTo  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param  array<int|string|null>|null  $params  Optional. Additional parameters to include with the request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a $returnUri is not configured
     *
     * @see https://auth0.com/docs/api/authentication#logout
     */
    public function getLogoutLink(
        ?string $returnTo = null,
        ?array $params = null,
    ): string;

    /**
     * Start passwordless login process.
     *
     * @param  array<mixed>|null  $body  Optional. Additional content to include in the body of the API request. See @see for details.
     * @param  array<int|string>|null  $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function passwordlessStart(
        ?array $body = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Start passwordless login process for email.
     *
     * @param  string  $email  email address to use
     * @param  string  $type  use null or "link" to send a link, use "code" to send a verification code
     * @param  array<string,string|null>|null  $params  Optional. Append or override the link parameters (like scope, redirect_uri, protocol, response_type) when you send a link using email.
     * @param  array<int|string>|null  $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `email` or `type` are passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function emailPasswordlessStart(
        string $email,
        string $type,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Start passwordless login process for SMS.
     *
     * @param  string  $phoneNumber  phone number to use
     * @param  array<int|string>|null  $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `phoneNumber` is passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function smsPasswordlessStart(
        string $phoneNumber,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Make an authenticated request to the /userinfo endpoint.
     *
     * @param  string  $accessToken  bearer token to use for the request
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `accessToken` is passed
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#user-profile
     */
    public function userInfo(
        string $accessToken,
    ): ResponseInterface;

    /**
     * Makes a call to the `oauth/token` endpoint.
     *
     * @param  string  $grantType  Denotes the type of flow being used. See @see for details.
     * @param  array<int|string|null>|null  $params  Optional. Additional content to include in the body of the API request. See @see for details.
     * @param  array<int|string>|null  $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `grantType` is passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#get-token
     */
    public function oauthToken(
        string $grantType,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Makes a call to the `oauth/token` endpoint with `authorization_code` grant type.
     *
     * @param  string  $code  authorization code received during login
     * @param  string|null  $redirectUri  Optional. Redirect URI sent with authorize request. Defaults to the SDK's configured redirectUri.
     * @param  string|null  $codeVerifier  Optional. The clear-text version of the code_challenge from the /authorize call
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `code` is passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a redirect uri is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#authorization-code-flow45
     * @see https://auth0.com/docs/api/authentication#authorization-code-flow-with-pkce46
     */
    public function codeExchange(
        string $code,
        ?string $redirectUri = null,
        ?string $codeVerifier = null,
    ): ResponseInterface;

    /**
     * Makes a call to the `oauth/token` endpoint with `password-realm` grant type.
     *
     * @param  string  $username  username of the resource owner
     * @param  string  $password  password of the resource owner
     * @param  string  $realm  database realm the user belongs to
     * @param  array<int|string|null>|null  $params  Optional. Additional content to include in the body of the API request. See @see for details.
     * @param  array<int|string>|null  $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `username`, `password`, or `realm` are passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#resource-owner-password
     * @see https://auth0.com/docs/authorization/flows/resource-owner-password-flow
     */
    public function login(
        string $username,
        string $password,
        string $realm,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Makes a call to the `oauth/token` endpoint with `password` grant type.
     *
     * @param  string  $username  username of the resource owner
     * @param  string  $password  password of the resource owner
     * @param  array<int|string|null>|null  $params  Optional. Additional content to include in the body of the API request. See @see for details.
     * @param  array<int|string>|null  $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `username` or `password` are passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#resource-owner-password
     * @see https://auth0.com/docs/authorization/flows/resource-owner-password-flow
     */
    public function loginWithDefaultDirectory(
        string $username,
        string $password,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Makes a call to the `oauth/token` endpoint with `client_credentials` grant type.
     *
     * @param  array<int|string|null>|null  $params  Optional. Additional content to include in the body of the API request. See @see for details.
     * @param  array<int|string>|null  $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#client-credentials-flow
     * @see https://auth0.com/docs/authorization/flows/client-credentials-flow
     */
    public function clientCredentials(
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Use a refresh token grant to get new tokens.
     *
     * @param  string  $refreshToken  refresh token to use
     * @param  array<int|string|null>|null  $params  Optional. Additional parameters to include with the request.
     * @param  array<int|string>  $headers  Optional. Additional headers to send with the request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `refreshToken` is passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#refresh-token
     */
    public function refreshToken(
        string $refreshToken,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Create a new user using active authentication.
     * This endpoint only works for database connections.
     *
     * @param  string  $email  email for the user signing up
     * @param  string  $password  new password for the user signing up
     * @param  string  $connection  database connection to create the user in
     * @param  array<mixed>|null  $body  Optional. Additional content to include in the body of the API request. See @see for details.
     * @param  array<int|string>|null  $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `email`, `password`, or `connection` are passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#signup
     */
    public function dbConnectionsSignup(
        string $email,
        string $password,
        string $connection,
        ?array $body = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Send a change password email.
     * This endpoint only works for database connections.
     *
     * @param  string  $email  email for the user changing their password
     * @param  string  $connection  the name of the database connection this user is in
     * @param  array<mixed>|null  $body  Optional. Additional content to include in the body of the API request. See @see for details.
     * @param  array<int|string>|null  $headers  Optional. Additional headers to send with the API request.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `email` or `connection` are passed
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#change-password
     */
    public function dbConnectionsChangePassword(
        string $email,
        string $connection,
        ?array $body = null,
        ?array $headers = null,
    ): ResponseInterface;
}
