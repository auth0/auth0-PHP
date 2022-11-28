<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\API\AuthenticationInterface;
use Auth0\SDK\Contract\API\ManagementInterface;

/**
 * Interface Auth0Interface.
 */
interface Auth0Interface
{
    /**
     * Create, configure, and return an instance of the Authentication class.
     */
    public function authentication(): AuthenticationInterface;

    /**
     * Create, configure, and return an instance of the Management class.
     */
    public function management(): ManagementInterface;

    /**
     * Retrieve the SdkConfiguration instance.
     */
    public function configuration(): SdkConfiguration;

    /**
     * Return the url to the login page.
     *
     * @param  string|null  $redirectUrl  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param  array<int|string|null>|null  $params  additional parameters to include with the request
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when `redirectUri` is not specified, and supplied SdkConfiguration does not have a default redirectUri configured
     *
     * @see https://auth0.com/docs/api/authentication#login
     */
    public function login(
        ?string $redirectUrl = null,
        ?array $params = null,
    ): string;

    /**
     * Return the url to the signup page when using the New Universal Login Experience.
     *
     * @param  string|null  $redirectUrl  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param  array<int|string|null>|null  $params  additional parameters to include with the request
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when `redirectUri` is not specified, and supplied SdkConfiguration does not have a default redirectUri configured
     *
     * @see https://auth0.com/docs/universal-login/new-experience
     * @see https://auth0.com/docs/api/authentication#login
     */
    public function signup(
        ?string $redirectUrl = null,
        ?array $params = null,
    ): string;

    /**
     * If invitation parameters are present in the request, handle extraction and return a URL for redirection to Universal Login to accept. Returns null if no invitation parameters were found.
     *
     * @param  string|null  $redirectUrl  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param  array<int|string|null>|null  $params  additional parameters to include with the request
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when `redirectUri` is not specified, and supplied SdkConfiguration does not have a default redirectUri configured
     *
     * @see https://auth0.com/docs/universal-login/new-experience
     * @see https://auth0.com/docs/api/authentication#login
     */
    public function handleInvitation(
        ?string $redirectUrl = null,
        ?array $params = null,
    ): ?string;

    /**
     * Delete any persistent data and clear out all stored properties, and return the URI to Auth0 /logout endpoint for redirection.
     *
     * @param  string|null  $returnUri  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param  array<int|string|null>|null  $params  Optional. Additional parameters to include with the request.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when `returnUri` is not specified, and supplied SdkConfiguration does not have a default redirectUri configured
     *
     * @see https://auth0.com/docs/api/authentication#logout
     */
    public function logout(
        ?string $returnUri = null,
        ?array $params = null,
    ): string;

    /**
     * Delete any persistent data and clear out all stored properties.
     *
     * @param  bool  $transient  when true, data in transient storage is also cleared
     */
    public function clear(
        bool $transient = true,
    ): self;

    /**
     * Verifies and decodes an ID token using the properties in this class.
     *
     * @param  string  $token  ID token to verify and decode
     * @param  array<string>  $tokenAudience  Optional. An array of allowed values for the 'aud' claim. Successful if ANY match.
     * @param  array<string>|null  $tokenOrganization  Optional. An array of allowed values for the 'org_id' claim. Successful if ANY match.
     * @param  string|null  $tokenNonce  Optional. The value expected for the 'nonce' claim.
     * @param  int|null  $tokenMaxAge  Optional. Maximum window of time in seconds since the 'auth_time' to accept the token.
     * @param  int|null  $tokenLeeway  Optional. Leeway in seconds to allow during time calculations. Defaults to 60.
     * @param  int|null  $tokenNow  Optional. Unix timestamp representing the current point in time to use for time calculations.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When token validation fails. See the exception message for further details.
     */
    public function decode(
        string $token,
        ?array $tokenAudience = null,
        ?array $tokenOrganization = null,
        ?string $tokenNonce = null,
        ?int $tokenMaxAge = null,
        ?int $tokenLeeway = null,
        ?int $tokenNow = null,
        ?int $tokenType = null,
    ): TokenInterface;

    /**
     * Exchange authorization code for access, ID, and refresh tokens.
     *
     * @param  string|null  $redirectUri  Optional. Redirect URI sent with authorize request. Defaults to the SDK's configured redirectUri.
     * @param  string|null  $code  Optional. The value of the `code` parameter. One will be extracted from $_GET if not specified.
     * @param  string|null  $state  Optional. The value of the `state` parameter. One will be extracted from $_GET if not specified.
     *
     * @throws \Auth0\SDK\Exception\StateException if the code value is missing from the request parameters
     * @throws \Auth0\SDK\Exception\StateException if the state value is missing from the request parameters, or otherwise invalid
     * @throws \Auth0\SDK\Exception\StateException if access token is missing from the response
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/authorization/flows/call-your-api-using-the-authorization-code-flow
     */
    public function exchange(
        ?string $redirectUri = null,
        ?string $code = null,
        ?string $state = null,
    ): bool;

    /**
     * Renews the access token and ID token using an existing refresh token.
     * Scope "offline_access" must be declared in order to obtain refresh token for later token renewal.
     *
     * @param  array<int|string|null>|null  $params  Optional. Additional parameters to include with the request.
     *
     * @throws \Auth0\SDK\Exception\StateException if the Auth0 object does not have access token and refresh token, or the API did not renew tokens properly
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/tokens/refresh-token/current
     */
    public function renew(
        ?array $params = null,
    ): self;

    /**
     * Return an object representing the current session credentials (including id token, access token, access token expiration, refresh token and user data) without triggering an authorization flow. Returns null when session data is not available.
     */
    public function getCredentials(): ?object;

    /**
     * Get ID token from an active session.
     */
    public function getIdToken(): ?string;

    /**
     * Get userinfo from an active session.
     *
     * @return array<mixed>|null
     */
    public function getUser(): ?array;

    /**
     * Get access token from an active session.
     */
    public function getAccessToken(): ?string;

    /**
     * Get refresh token from an active session.
     */
    public function getRefreshToken(): ?string;

    /**
     * Get token scopes from an active session.
     *
     * @return array<string>
     */
    public function getAccessTokenScope(): ?array;

    /**
     * Get token expiration from an active session.
     */
    public function getAccessTokenExpiration(): ?int;

    /**
     * Updates the active session's stored Id Token.
     *
     * @param  string  $idToken  id token returned from the code exchange
     */
    public function setIdToken(
        string $idToken,
    ): self;

    /**
     * Set the user property to a userinfo array and, if configured, persist.
     *
     * @param  array<array<mixed>|int|string>  $user  user data to store
     */
    public function setUser(
        array $user,
    ): self;

    /**
     * Sets and persists the access token.
     *
     * @param  string  $accessToken  access token returned from the code exchange
     */
    public function setAccessToken(
        string $accessToken,
    ): self;

    /**
     * Sets and persists the refresh token.
     *
     * @param  string  $refreshToken  refresh token returned from the code exchange
     */
    public function setRefreshToken(
        string $refreshToken,
    ): self;

    /**
     * Sets and persists the access token scope.
     *
     * @param  array<string>  $accessTokenScope  an array of scopes for the access token
     */
    public function setAccessTokenScope(
        array $accessTokenScope,
    ): self;

    /**
     * Sets and persists the access token expiration unix timestamp.
     *
     * @param  int  $accessTokenExpiration  unix timestamp representing the expiration time on the access token
     */
    public function setAccessTokenExpiration(
        int $accessTokenExpiration,
    ): self;

    /**
     * Get an available bearer token from a variety of input sources.
     *
     * @param  array<string>|null  $get  Optional. An array of viable parameter names to search against $_GET as a token candidate.
     * @param  array<string>|null  $post  Optional. An array of viable parameter names to search against $_POST as a token candidate.
     * @param  array<string>|null  $server  Optional. An array of viable parameter names to search against $_SERVER as a token candidate.
     * @param  array<string,string>|null  $haystack  Optional. A key-value array in which to search for `$needles` as token candidates.
     * @param  array<string>|null  $needles  Optional. An array of viable keys to search against `$haystack` as token candidates.
     */
    public function getBearerToken(
        ?array $get = null,
        ?array $post = null,
        ?array $server = null,
        ?array $haystack = null,
        ?array $needles = null,
    ): ?TokenInterface;

    /**
     * Get the specified parameter from POST or GET, depending on configured response mode.
     *
     * @param  string  $parameterName  name of the parameter to pull from the request
     * @param  int  $filter  Defaults to \FILTER_SANITIZE_FULL_SPECIAL_CHARS. The type of PHP filter_var() filter to apply.
     * @param  int[]  $filterOptions  Optional. Any additional `filter_var()` sanitization filters to pass. See: https://www.php.net/manual/en/filter.filters.sanitize.php
     */
    public function getRequestParameter(
        string $parameterName,
        int $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        array $filterOptions = [],
    ): ?string;

    /**
     * Get the code exchange details from the GET request.
     */
    public function getExchangeParameters(): ?object;

    /**
     * Get the invitation details from the GET request.
     *
     * @return array{invitation: string, organization: string, organizationName: string}|null
     */
    public function getInvitationParameters(): ?array;
}
