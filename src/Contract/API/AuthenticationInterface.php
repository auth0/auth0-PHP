<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API;

use Auth0\SDK\API\Authentication\PushedAuthorizationRequest;
use Auth0\SDK\Exception\{ArgumentException, ConfigurationException, NetworkException, TokenException};
use Psr\Http\Message\ResponseInterface;

interface AuthenticationInterface extends ClientInterface
{
    /**
     * Add client authentication to a request.
     *
     * @param array<mixed> $content Request being sent to the endpoint.
     *
     * @throws TokenException         If client assertion signing key or algorithm is invalid.
     * @throws ConfigurationException If client ID or secret are invalid.
     *
     * @return array<mixed> Request, with client authentication added.
     */
    public function addClientAuthentication(array $content): array;

    /**
     * Makes a call to the `oauth/token` endpoint with `client_credentials` grant type.
     *
     * @param null|array<null|int|string> $params  Optional. Additional content to include in the body of the API request. See @see for details.
     * @param null|array<int|string>      $headers Optional. Additional headers to send with the API request.
     *
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a Client Secret is not configured
     * @throws NetworkException       when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#client-credentials-flow
     * @see https://auth0.com/docs/authorization/flows/client-credentials-flow
     */
    public function clientCredentials(
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Makes a call to the `oauth/token` endpoint with `authorization_code` grant type.
     *
     * @param string      $code         authorization code received during login
     * @param null|string $redirectUri  Optional. Redirect URI sent with authorize request. Defaults to the SDK's configured redirectUri.
     * @param null|string $codeVerifier Optional. The clear-text version of the code_challenge from the /authorize call
     *
     * @throws ArgumentException      when an invalid `code` is passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a Client Secret is not configured
     * @throws ConfigurationException when a redirect uri is not configured
     * @throws NetworkException       when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#authorization-code-flow
     * @see https://auth0.com/docs/api/authentication#authorization-code-flow-with-pkce
     */
    public function codeExchange(
        string $code,
        ?string $redirectUri = null,
        ?string $codeVerifier = null,
    ): ResponseInterface;

    /**
     * Send a change password email.
     * This endpoint only works for database connections.
     *
     * @param string                 $email      email for the user changing their password
     * @param string                 $connection the name of the database connection this user is in
     * @param null|array<mixed>      $body       Optional. Additional content to include in the body of the API request. See @see for details.
     * @param null|array<int|string> $headers    Optional. Additional headers to send with the API request.
     *
     * @throws ArgumentException      when an invalid `email` or `connection` are passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws NetworkException       when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#change-password
     */
    public function dbConnectionsChangePassword(
        string $email,
        string $connection,
        ?array $body = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Create a new user using active authentication.
     * This endpoint only works for database connections.
     *
     * @param string                 $email      email for the user signing up
     * @param string                 $password   new password for the user signing up
     * @param string                 $connection database connection to create the user in
     * @param null|array<mixed>      $body       Optional. Additional content to include in the body of the API request. See @see for details.
     * @param null|array<int|string> $headers    Optional. Additional headers to send with the API request.
     *
     * @throws ArgumentException      when an invalid `email`, `password`, or `connection` are passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws NetworkException       when the API request fails due to a network error
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
     * Start passwordless login process for email.
     *
     * @param string                         $email   email address to use
     * @param string                         $type    use null or "link" to send a link, use "code" to send a verification code
     * @param null|array<string,null|string> $params  Optional. Append or override the link parameters (like scope, redirect_uri, protocol, response_type) when you send a link using email.
     * @param null|array<int|string>         $headers Optional. Additional headers to send with the API request.
     *
     * @throws ArgumentException      when an invalid `email` or `type` are passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a Client Secret is not configured
     * @throws NetworkException       when the API request fails due to a network error
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
     * Build the login URL.
     *
     * @param string                      $state       A CSRF mitigating value, also useful for restoring the previous state of your app. See https://auth0.com/docs/protocols/state-parameters
     * @param null|string                 $redirectUri Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param null|array<null|int|string> $params      Optional. Additional parameters to include with the request. See @see for details.
     *
     * @throws ArgumentException      when an invalid `state` is passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a $redirectUri is not configured
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
     * @param null|string                 $returnTo Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param null|array<null|int|string> $params   Optional. Additional parameters to include with the request.
     *
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a $returnUri is not configured
     *
     * @see https://auth0.com/docs/api/authentication#logout
     */
    public function getLogoutLink(
        ?string $returnTo = null,
        ?array $params = null,
    ): string;

    /**
     * Build and return a SAMLP link.
     *
     * @param null|string $clientId   Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     * @param null|string $connection Optional. The connection to use. If no connection is specified, the Auth0 Login Page will be shown.
     *
     * @throws ConfigurationException when a $clientId is not configured
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
     * @param null|string $clientId Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     *
     * @throws ConfigurationException when a $clientId is not configured
     *
     * @see https://auth0.com/docs/connections/enterprise/samlp
     */
    public function getSamlpMetadataLink(
        ?string $clientId = null,
    ): string;

    /**
     * Build and return a WS-Federation link.
     *
     * @param null|string                 $clientId Optional. Client ID to use. Defaults to the SDK's configured Client ID.
     * @param null|array<null|int|string> $params   Optional. Additional parameters to include with the request. See @see for details.
     *
     * @throws ConfigurationException when a $clientId is not configured
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
     * Makes a call to the `oauth/token` endpoint with `password-realm` grant type.
     *
     * @param string                      $username username of the resource owner
     * @param string                      $password password of the resource owner
     * @param string                      $realm    database realm the user belongs to
     * @param null|array<null|int|string> $params   Optional. Additional content to include in the body of the API request. See @see for details.
     * @param null|array<int|string>      $headers  Optional. Additional headers to send with the API request.
     *
     * @throws ArgumentException      when an invalid `username`, `password`, or `realm` are passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a Client Secret is not configured
     * @throws NetworkException       when the API request fails due to a network error
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
     * @param string                      $username username of the resource owner
     * @param string                      $password password of the resource owner
     * @param null|array<null|int|string> $params   Optional. Additional content to include in the body of the API request. See @see for details.
     * @param null|array<int|string>      $headers  Optional. Additional headers to send with the API request.
     *
     * @throws ArgumentException      when an invalid `username` or `password` are passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a Client Secret is not configured
     * @throws NetworkException       when the API request fails due to a network error
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
     * Makes a call to the `oauth/token` endpoint.
     *
     * @param string                      $grantType Denotes the type of flow being used. See @see for details.
     * @param null|array<null|int|string> $params    Optional. Additional content to include in the body of the API request. See @see for details.
     * @param null|array<int|string>      $headers   Optional. Additional headers to send with the API request.
     *
     * @throws ArgumentException      when an invalid `grantType` is passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a Client Secret is not configured
     * @throws NetworkException       when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#get-token
     */
    public function oauthToken(
        string $grantType,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Start passwordless login process.
     *
     * @param null|array<mixed>      $body    Optional. Additional content to include in the body of the API request. See @see for details.
     * @param null|array<int|string> $headers Optional. Additional headers to send with the API request.
     *
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a Client Secret is not configured
     * @throws NetworkException       when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#get-code-or-link
     */
    public function passwordlessStart(
        ?array $body = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Returns an instance of the Pushed Authorization Request endpoint class.
     */
    public function pushedAuthorizationRequest(): PushedAuthorizationRequest;

    /**
     * Use a refresh token grant to get new tokens.
     *
     * @param string                      $refreshToken refresh token to use
     * @param null|array<null|int|string> $params       Optional. Additional parameters to include with the request.
     * @param null|int[]|string[]         $headers      Optional. Additional headers to send with the request.
     *
     * @throws ArgumentException      when an invalid `refreshToken` is passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a Client Secret is not configured
     * @throws NetworkException       when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#refresh-token
     */
    public function refreshToken(
        string $refreshToken,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface;

    /**
     * Start passwordless login process for SMS.
     *
     * @param string                 $phoneNumber phone number to use
     * @param null|array<int|string> $headers     Optional. Additional headers to send with the API request.
     *
     * @throws ArgumentException      when an invalid `phoneNumber` is passed
     * @throws ConfigurationException when a Client ID is not configured
     * @throws ConfigurationException when a Client Secret is not configured
     * @throws NetworkException       when the API request fails due to a network error
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
     * @param string $accessToken bearer token to use for the request
     *
     * @throws ArgumentException when an invalid `accessToken` is passed
     * @throws NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/authentication#user-profile
     */
    public function userInfo(
        string $accessToken,
    ): ResponseInterface;
}
