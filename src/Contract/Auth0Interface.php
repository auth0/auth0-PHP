<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\API\{AuthenticationInterface, ManagementInterface};

interface Auth0Interface
{
    /**
     * Create, configure, and return an instance of the Authentication class.
     */
    public function authentication(): AuthenticationInterface;

    /**
     * Delete any persistent data and clear out all stored properties.
     *
     * @param bool $transient when true, data in transient storage is also cleared
     */
    public function clear(
        bool $transient = true,
    ): self;

    /**
     * Retrieve the SdkConfiguration instance.
     */
    public function configuration(): SdkConfiguration;

    /**
     * Verifies and decodes an ID token using the properties in this class.
     *
     * @param string             $token             ID token to verify and decode
     * @param null|string[]      $tokenAudience     Optional. An array of allowed values for the 'aud' claim. Successful if ANY match.
     * @param null|array<string> $tokenOrganization Optional. An array of allowed values for the 'org_id' claim. Successful if ANY match.
     * @param null|string        $tokenNonce        Optional. The value expected for the 'nonce' claim.
     * @param null|int           $tokenMaxAge       Optional. Maximum window of time in seconds since the 'auth_time' to accept the token.
     * @param null|int           $tokenLeeway       Optional. Leeway in seconds to allow during time calculations. Defaults to 60.
     * @param null|int           $tokenNow          Optional. Unix timestamp representing the current point in time to use for time calculations.
     * @param ?int               $tokenType
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
     * @param null|string $redirectUri Optional. Redirect URI sent with authorize request. Defaults to the SDK's configured redirectUri.
     * @param null|string $code        Optional. The value of the `code` parameter. One will be extracted from $_GET if not specified.
     * @param null|string $state       Optional. The value of the `state` parameter. One will be extracted from $_GET if not specified.
     *
     * @throws \Auth0\SDK\Exception\StateException   if the code value is missing from the request parameters
     * @throws \Auth0\SDK\Exception\StateException   if the state value is missing from the request parameters, or otherwise invalid
     * @throws \Auth0\SDK\Exception\StateException   if access token is missing from the response
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
     * Get access token from an active session.
     */
    public function getAccessToken(): ?string;

    /**
     * Get token expiration from an active session.
     */
    public function getAccessTokenExpiration(): ?int;

    /**
     * Get token scopes from an active session.
     *
     * @return array<string>
     */
    public function getAccessTokenScope(): ?array;

    /**
     * Get the OIDC backchannel logout key generated during exchange(). This is used for session matching with getCredentials() calls, for comparison against cached requests from handleBackchannelLogout().
     */
    public function getBackchannel(): ?string;

    /**
     * Get an available bearer token from a variety of input sources.
     *
     * @param null|array<string>        $get      Optional. An array of viable parameter names to search against $_GET as a token candidate.
     * @param null|array<string>        $post     Optional. An array of viable parameter names to search against $_POST as a token candidate.
     * @param null|array<string>        $server   Optional. An array of viable parameter names to search against $_SERVER as a token candidate.
     * @param null|array<string,string> $haystack Optional. A key-value array in which to search for `$needles` as token candidates.
     * @param null|array<string>        $needles  Optional. An array of viable keys to search against `$haystack` as token candidates.
     */
    public function getBearerToken(
        ?array $get = null,
        ?array $post = null,
        ?array $server = null,
        ?array $haystack = null,
        ?array $needles = null,
    ): ?TokenInterface;

    /**
     * Return an object representing the current session credentials (including id token, access token, access token expiration, refresh token and user data) without triggering an authorization flow. Returns null when session data is not available.
     */
    public function getCredentials(): ?object;

    /**
     * Get the code exchange details from the GET request.
     */
    public function getExchangeParameters(): ?object;

    /**
     * Get ID token from an active session.
     */
    public function getIdToken(): ?string;

    /**
     * Get the invitation details from the GET request.
     *
     * @return null|array{invitation: string, organization: string, organizationName: string}
     */
    public function getInvitationParameters(): ?array;

    /**
     * Get refresh token from an active session.
     */
    public function getRefreshToken(): ?string;

    /**
     * Get the specified parameter from POST or GET, depending on configured response mode.
     *
     * @param string $parameterName name of the parameter to pull from the request
     * @param int    $filter        Defaults to \FILTER_SANITIZE_FULL_SPECIAL_CHARS. The type of PHP filter_var() filter to apply.
     * @param int[]  $filterOptions Optional. Any additional `filter_var()` sanitization filters to pass. See: https://www.php.net/manual/en/filter.filters.sanitize.php
     */
    public function getRequestParameter(
        string $parameterName,
        int $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        array $filterOptions = [],
    ): ?string;

    /**
     * Get userinfo from an active session.
     *
     * @return null|array<mixed>
     */
    public function getUser(): ?array;

    /**
     * Store a OIDC Backchannel Logout request in the cache. Matching sessions will be invalidated on future requests when getCredentials() is called.
     *
     * @param string $logoutToken An encoded logout token to validate and process.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when used without statefulness being configured
     * @throws \Auth0\SDK\Exception\InvalidTokenException  when token validation fails. See the exception message for further details.
     */
    public function handleBackchannelLogout(
        string $logoutToken,
    ): TokenInterface;

    /**
     * If invitation parameters are present in the request, handle extraction and return a URL for redirection to Universal Login to accept. Returns null if no invitation parameters were found.
     *
     * @param null|string                 $redirectUrl Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param null|array<null|int|string> $params      additional parameters to include with the request
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
     * Returns true if a session is present. Your application must check if the session's access token has expired.
     */
    public function isAuthenticated(): bool;

    /**
     * Return the url to the login page.
     *
     * @param null|string                 $redirectUrl Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param null|array<null|int|string> $params      additional parameters to include with the request
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
     * Delete any persistent data and clear out all stored properties, and return the URI to Auth0 /logout endpoint for redirection.
     *
     * @param null|string                 $returnUri Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param null|array<null|int|string> $params    Optional. Additional parameters to include with the request.
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
     * Create, configure, and return an instance of the Management class.
     */
    public function management(): ManagementInterface;

    /**
     * Updates the SDK's internal state by clearing it's credentials cache, and retrieving the current credentials from the configured session medium. Use this when you directly make changes to the configured session medium to ensure the SDK reflects those changes.
     */
    public function refreshState(): self;

    /**
     * Renews the access token and ID token using an existing refresh token.
     * Scope "offline_access" must be declared in order to obtain refresh token for later token renewal.
     *
     * @param null|array<null|int|string> $params Optional. Additional parameters to include with the request.
     *
     * @throws \Auth0\SDK\Exception\StateException         if the Auth0 object does not have access token and refresh token, or the API did not renew tokens properly
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client ID is not configured
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Client Secret is not configured
     * @throws \Auth0\SDK\Exception\NetworkException       when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/tokens/refresh-token/current
     */
    public function renew(
        ?array $params = null,
    ): self;

    /**
     * Sets and persists the access token.
     *
     * @param string $accessToken access token returned from the code exchange
     */
    public function setAccessToken(
        string $accessToken,
    ): self;

    /**
     * Sets and persists the access token expiration unix timestamp.
     *
     * @param int $accessTokenExpiration unix timestamp representing the expiration time on the access token
     */
    public function setAccessTokenExpiration(
        int $accessTokenExpiration,
    ): self;

    /**
     * Sets and persists the access token scope.
     *
     * @param array<string> $accessTokenScope an array of scopes for the access token
     */
    public function setAccessTokenScope(
        array $accessTokenScope,
    ): self;

    /**
     * Sets and persists an identifier used for OIDC backchannel logout requests.
     *
     * @param string $backchannel an OIDC backchannel logout identifier composed of the sub, iss and sid claims from the source ID Token.
     */
    public function setBackchannel(
        string $backchannel,
    ): self;

    /**
     * Set the configuration for the SDK instance.
     *
     * @param array<mixed>|SdkConfiguration $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     */
    public function setConfiguration(
        SdkConfiguration | array $configuration,
    ): self;

    /**
     * Updates the active session's stored Id Token.
     *
     * @param string $idToken id token returned from the code exchange
     */
    public function setIdToken(
        string $idToken,
    ): self;

    /**
     * Sets and persists the refresh token.
     *
     * @param string $refreshToken refresh token returned from the code exchange
     */
    public function setRefreshToken(
        string $refreshToken,
    ): self;

    /**
     * Set the user property to a userinfo array and, if configured, persist.
     *
     * @param array<array<mixed>|int|string> $user user data to store
     */
    public function setUser(
        array $user,
    ): self;

    /**
     * Return the url to the signup page when using the New Universal Login Experience.
     *
     * @param null|string                 $redirectUrl Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.
     * @param null|array<null|int|string> $params      additional parameters to include with the request
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
}
