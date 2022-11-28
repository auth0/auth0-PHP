<?php

declare(strict_types=1);

namespace Auth0\SDK\Configuration;

use Auth0\SDK\Contract\ConfigurableContract;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Mixins\ConfigurableMixin;
use Auth0\SDK\Store\CookieStore;
use Auth0\SDK\Token;
use Auth0\SDK\Utility\EventDispatcher;
use Http\Discovery\Exception\NotFoundException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Cache\CacheItemPoolInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Configuration container for use with Auth0\SDK.
 */
final class SdkConfiguration implements ConfigurableContract
{
    use ConfigurableMixin;

    public const STRATEGY_REGULAR = 'webapp';

    public const STRATEGY_API = 'api';

    public const STRATEGY_MANAGEMENT_API = 'management';

    public const STRATEGY_NONE = 'none';

    public const STRATEGIES_USING_SESSIONS = [self::STRATEGY_REGULAR];

    /**
     * An instance of the EventDispatcher utility.
     */
    private ?EventDispatcher $eventDispatcher = null;

    /**
     * SdkConfiguration Constructor.
     *
     * @param  array<mixed>|null  $configuration  An key-value array matching this constructor's arguments. Overrides any other passed arguments with the same key name.
     * @param  string  $strategy  Defaults to 'webapp'. Should be assigned either 'api', 'management', or 'webapp' to specify the type of application the SDK is being applied to. Determines what configuration options will be required at initialization.
     * @param  string|null  $domain  auth0 domain for your tenant, found in your Auth0 Application settings
     * @param  string|null  $customDomain  if you have configured Auth0 to use a custom domain, configure it here
     * @param  string|null  $clientId  client ID, found in the Auth0 Application settings
     * @param  string|null  $redirectUri  authentication callback URI, as defined in your Auth0 Application settings
     * @param  string|null  $clientSecret  client Secret, found in the Auth0 Application settings
     * @param  array<string>|null  $audience  One or more API identifiers, found in your Auth0 API settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'aud' claim to validate an ID Token successfully.
     * @param  array<string>|null  $organization  One or more Organization IDs, found in your Auth0 Organization settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'org_id' claim to validate an ID Token successfully.
     * @param  bool  $usePkce  Defaults to true. Use PKCE (Proof Key of Code Exchange) with Authorization Code Flow requests. See https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce
     * @param  array<string>|null  $scope  One or more scopes to request for Tokens. See https://auth0.com/docs/scopes
     * @param  string  $responseMode  Defaults to 'query.' Where to extract request parameters from, either 'query' for GET or 'form_post' for POST requests.
     * @param  string  $responseType  Defaults to 'code.' Use 'code' for server-side flows and 'token' for application side flow.
     * @param  string  $tokenAlgorithm  Defaults to 'RS256'. Algorithm to use for Token verification. Expects either 'RS256' or 'HS256'.
     * @param  string|null  $tokenJwksUri  URI to the JWKS when verifying RS256 tokens
     * @param  int|null  $tokenMaxAge  the maximum window of time (in seconds) since the 'auth_time' to accept during Token validation
     * @param  int  $tokenLeeway  Defaults to 60. Leeway (in seconds) to allow during time calculations with Token validation.
     * @param  CacheItemPoolInterface|null  $tokenCache  a PSR-6 compatible cache adapter for storing JSON Web Key Sets (JWKS)
     * @param  int  $tokenCacheTtl  how long (in seconds) to keep a JWKS cached
     * @param  ClientInterface|null  $httpClient  a PSR-18 compatible HTTP client to use for API requests
     * @param  int  $httpMaxRetries  when a rate-limit (429 status code) response is returned from the Auth0 API, automatically retry the request up to this many times
     * @param  RequestFactoryInterface|null  $httpRequestFactory  a PSR-17 compatible request factory to generate HTTP requests
     * @param  ResponseFactoryInterface|null  $httpResponseFactory  a PSR-17 compatible response factory to generate HTTP responses
     * @param  StreamFactoryInterface|null  $httpStreamFactory  a PSR-17 compatible stream factory to create request body streams
     * @param  bool  $httpTelemetry  Defaults to true. If true, API requests will include telemetry about the SDK and PHP runtime version to help us improve our services.
     * @param  StoreInterface|null  $sessionStorage  Defaults to use cookies. A StoreInterface-compatible class for storing Token state.
     * @param  string  $sessionStorageId  Defaults to 'auth0_session'. The namespace to prefix session items under.
     * @param  string|null  $cookieSecret  the secret used to derive an encryption key for the user identity in a session cookie and to sign the transient cookies used by the login callback
     * @param  string|null  $cookieDomain  Defaults to value of HTTP_HOST server environment information. Cookie domain, for example 'www.example.com', for use with PHP sessions and SDK cookies. To make cookies visible on all subdomains then the domain must be prefixed with a dot like '.example.com'.
     * @param  int  $cookieExpires  Defaults to 0. How long, in seconds, before cookies expire. If set to 0 the cookie will expire at the end of the session (when the browser closes).
     * @param  string  $cookiePath  Defaults to '/'. Specifies path on the domain where the cookies will work. Use a single slash ('/') for all paths on the domain.
     * @param  string|null  $cookieSameSite  Defaults to 'lax'. Specifies whether cookies should be restricted to first-party or same-site context.
     * @param  bool  $cookieSecure  Defaults to false. Specifies whether cookies should ONLY be sent over secure connections.
     * @param  bool  $persistUser  Defaults to true. If true, the user data will persist in session storage.
     * @param  bool  $persistIdToken  Defaults to true. If true, the Id Token will persist in session storage.
     * @param  bool  $persistAccessToken  Defaults to true. If true, the Access Token will persist in session storage.
     * @param  bool  $persistRefreshToken  Defaults to true. If true, the Refresh Token will persist in session storage.
     * @param  StoreInterface|null  $transientStorage  Defaults to use cookies. A StoreInterface-compatible class for storing ephemeral state data, such as nonces.
     * @param  string  $transientStorageId  Defaults to 'auth0_transient'. The namespace to prefix transient items under.
     * @param  bool  $queryUserInfo  Defaults to false. If true, query the /userinfo endpoint during an authorization code exchange.
     * @param  string|null  $managementToken  An Access Token to use for Management API calls. If there isn't one specified, the SDK will attempt to get one for you using your $clientSecret.
     * @param  CacheItemPoolInterface|null  $managementTokenCache  a PSR-6 compatible cache adapter for storing generated management access tokens
     * @param  ListenerProviderInterface|null  $eventListenerProvider  a PSR-14 compatible event listener provider, for interfacing with events triggered by the SDK
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a valid `$strategy` is not specified
     */
    public function __construct(
        private ?array $configuration = null,
        private string $strategy = self::STRATEGY_REGULAR,
        private ?string $domain = null,
        private ?string $customDomain = null,
        private ?string $clientId = null,
        private ?string $redirectUri = null,
        private ?string $clientSecret = null,
        private ?array $audience = null,
        private ?array $organization = null,
        private bool $usePkce = true,
        private ?array $scope = ['openid', 'profile', 'email'],
        private string $responseMode = 'query',
        private string $responseType = 'code',
        private string $tokenAlgorithm = Token::ALGO_RS256,
        private ?string $tokenJwksUri = null,
        private ?int $tokenMaxAge = null,
        private int $tokenLeeway = 60,
        private ?CacheItemPoolInterface $tokenCache = null,
        private int $tokenCacheTtl = 60,
        private ?ClientInterface $httpClient = null,
        private int $httpMaxRetries = 3,
        private ?RequestFactoryInterface $httpRequestFactory = null,
        private ?ResponseFactoryInterface $httpResponseFactory = null,
        private ?StreamFactoryInterface $httpStreamFactory = null,
        private bool $httpTelemetry = true,
        private ?StoreInterface $sessionStorage = null,
        private string $sessionStorageId = 'auth0_session',
        private ?string $cookieSecret = null,
        private ?string $cookieDomain = null,
        private int $cookieExpires = 0,
        private string $cookiePath = '/',
        private bool $cookieSecure = false,
        private ?string $cookieSameSite = null,
        private bool $persistUser = true,
        private bool $persistIdToken = true,
        private bool $persistAccessToken = true,
        private bool $persistRefreshToken = true,
        private ?StoreInterface $transientStorage = null,
        private string $transientStorageId = 'auth0_transient',
        private bool $queryUserInfo = false,
        private ?string $managementToken = null,
        private ?CacheItemPoolInterface $managementTokenCache = null,
        private ?ListenerProviderInterface $eventListenerProvider = null,
    ) {
        if (null !== $configuration && [] !== $configuration) {
            $this->applyConfiguration($configuration);
        }

        $this->validateProperties();
        $this->setupStateCookies();
        $this->setupStateFactories();

        if ($this->usingStatefulness()) {
            $this->setupStateStorage();
        }

        $this->validateState();
    }

    /**
     * @param  array<string>|null  $audience  an allowlist array of API identifiers/audiences
     */
    public function setAudience(?array $audience = null): self
    {
        if (null !== $audience && [] === $audience) {
            $audience = null;
        }

        $this->audience = $this->filterArray($audience);

        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getAudience(?\Throwable $exceptionIfNull = null): ?array
    {
        $this->exceptionIfNull($this->audience, $exceptionIfNull);

        return $this->audience;
    }

    public function hasAudience(): bool
    {
        return null !== $this->audience;
    }

    /**
     * @param  array<string>|string  $audiences  a string or array of strings to add to the API identifiers/audiences allowlist
     * @return array<string>|null the updated allowlist
     */
    public function pushAudience(array|string $audiences): ?array
    {
        if (\is_string($audiences)) {
            $audiences = trim($audiences);

            if ('' === $audiences) {
                return $this->audience;
            }

            $audiences = [$audiences];
        }

        if ([] === $audiences) {
            return $this->audience;
        }

        $this->setAudience(array_merge($this->audience ?? [], $audiences));

        return $this->audience;
    }

    public function setCookieDomain(?string $cookieDomain = null): self
    {
        if (null !== $cookieDomain && '' === trim($cookieDomain)) {
            $cookieDomain = null;
        }

        $this->cookieDomain = $cookieDomain;

        return $this;
    }

    public function getCookieDomain(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->cookieDomain, $exceptionIfNull);

        return $this->cookieDomain;
    }

    public function hasCookieDomain(): bool
    {
        return null !== $this->cookieDomain;
    }

    public function setCookieExpires(int $cookieExpires = 0): self
    {
        if ($cookieExpires < 0) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('cookieExpires');
        }

        $this->cookieExpires = $cookieExpires;

        return $this;
    }

    public function getCookieExpires(): int
    {
        return $this->cookieExpires;
    }

    public function hasCookieExpires(): bool
    {
        return true;
    }

    public function setCookiePath(string $cookiePath = '/'): self
    {
        if ('' === trim($cookiePath)) {
            $cookiePath = '/';
        }

        $this->cookiePath = $cookiePath;

        return $this;
    }

    public function getCookiePath(): string
    {
        return $this->cookiePath;
    }

    public function hasCookiePath(): bool
    {
        return true;
    }

    public function setCookieSameSite(?string $cookieSameSite = null): self
    {
        if (null !== $cookieSameSite && '' === trim($cookieSameSite)) {
            $cookieSameSite = null;
        }

        $this->cookieSameSite = $cookieSameSite;

        return $this;
    }

    public function getCookieSameSite(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->cookieSameSite, $exceptionIfNull);

        return $this->cookieSameSite;
    }

    public function hasCookieSameSite(): bool
    {
        return null !== $this->cookieSameSite;
    }

    public function setCookieSecret(?string $cookieSecret = null): self
    {
        if (null !== $cookieSecret && '' === trim($cookieSecret)) {
            $cookieSecret = null;
        }

        $this->cookieSecret = $cookieSecret;

        return $this;
    }

    public function getCookieSecret(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->cookieSecret, $exceptionIfNull);

        return $this->cookieSecret;
    }

    public function hasCookieSecret(): bool
    {
        return null !== $this->cookieSecret;
    }

    public function setCookieSecure(bool $cookieSecure = false): self
    {
        $this->cookieSecure = $cookieSecure;

        return $this;
    }

    public function getCookieSecure(): bool
    {
        return $this->cookieSecure;
    }

    public function hasCookieSecure(): bool
    {
        return true;
    }

    public function setClientId(?string $clientId = null): self
    {
        if (null !== $clientId && '' === trim($clientId)) {
            $clientId = null;
        }

        $this->clientId = $clientId;

        return $this;
    }

    public function getClientId(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->clientId, $exceptionIfNull);

        return $this->clientId;
    }

    public function hasClientId(): bool
    {
        return null !== $this->clientId;
    }

    public function setClientSecret(?string $clientSecret = null): self
    {
        if (null !== $clientSecret && '' === trim($clientSecret)) {
            $clientSecret = null;
        }

        $this->clientSecret = $clientSecret;

        return $this;
    }

    public function getClientSecret(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->clientSecret, $exceptionIfNull);

        return $this->clientSecret;
    }

    public function hasClientSecret(): bool
    {
        return null !== $this->clientSecret;
    }

    public function setDomain(?string $domain = null): self
    {
        if (\is_string($domain)) {
            $domain = $this->filterDomain($domain);

            if (null === $domain) {
                throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('domain');
            }
        }

        $this->domain = $domain;

        return $this;
    }

    public function getDomain(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->domain, $exceptionIfNull);

        return $this->domain;
    }

    public function hasDomain(): bool
    {
        return null !== $this->domain;
    }

    public function setCustomDomain(?string $customDomain = null): self
    {
        if (\is_string($customDomain)) {
            $customDomain = $this->filterDomain($customDomain);

            if (null === $customDomain) {
                throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('customDomain');
            }
        }

        $this->customDomain = $customDomain;

        return $this;
    }

    public function getCustomDomain(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->customDomain, $exceptionIfNull);

        return $this->customDomain;
    }

    public function hasCustomDomain(): bool
    {
        return null !== $this->customDomain;
    }

    public function setEventListenerProvider(?ListenerProviderInterface $eventListenerProvider = null): self
    {
        $this->eventListenerProvider = $eventListenerProvider;

        return $this;
    }

    public function getEventListenerProvider(?\Throwable $exceptionIfNull = null): ?ListenerProviderInterface
    {
        $this->exceptionIfNull($this->eventListenerProvider, $exceptionIfNull);

        return $this->eventListenerProvider;
    }

    public function hasEventListenerProvider(): bool
    {
        return null !== $this->eventListenerProvider;
    }

    public function setHttpClient(?ClientInterface $httpClient = null): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function getHttpClient(?\Throwable $exceptionIfNull = null): ?ClientInterface
    {
        $this->exceptionIfNull($this->httpClient, $exceptionIfNull);

        return $this->httpClient;
    }

    public function hasHttpClient(): bool
    {
        return null !== $this->httpClient;
    }

    public function setHttpMaxRetries(int $httpMaxRetries = 3): self
    {
        if ($httpMaxRetries < 0) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('httpMaxRetries');
        }

        $this->httpMaxRetries = $httpMaxRetries;

        return $this;
    }

    public function getHttpMaxRetries(): int
    {
        return $this->httpMaxRetries;
    }

    public function hasHttpMaxRetries(): bool
    {
        return true;
    }

    public function setHttpRequestFactory(?RequestFactoryInterface $httpRequestFactory = null): self
    {
        $this->httpRequestFactory = $httpRequestFactory;

        return $this;
    }

    public function getHttpRequestFactory(?\Throwable $exceptionIfNull = null): ?RequestFactoryInterface
    {
        $this->exceptionIfNull($this->httpRequestFactory, $exceptionIfNull);

        return $this->httpRequestFactory;
    }

    public function hasHttpRequestFactory(): bool
    {
        return null !== $this->httpRequestFactory;
    }

    public function setHttpResponseFactory(?ResponseFactoryInterface $httpResponseFactory = null): self
    {
        $this->httpResponseFactory = $httpResponseFactory;

        return $this;
    }

    public function getHttpResponseFactory(?\Throwable $exceptionIfNull = null): ?ResponseFactoryInterface
    {
        $this->exceptionIfNull($this->httpResponseFactory, $exceptionIfNull);

        return $this->httpResponseFactory;
    }

    public function hasHttpResponseFactory(): bool
    {
        return null !== $this->httpResponseFactory;
    }

    public function setHttpStreamFactory(?StreamFactoryInterface $httpStreamFactory = null): self
    {
        $this->httpStreamFactory = $httpStreamFactory;

        return $this;
    }

    public function getHttpStreamFactory(?\Throwable $exceptionIfNull = null): ?StreamFactoryInterface
    {
        $this->exceptionIfNull($this->httpStreamFactory, $exceptionIfNull);

        return $this->httpStreamFactory;
    }

    public function hasHttpStreamFactory(): bool
    {
        return null !== $this->httpStreamFactory;
    }

    public function setHttpTelemetry(bool $httpTelemetry = true): self
    {
        $this->httpTelemetry = $httpTelemetry;

        return $this;
    }

    public function getHttpTelemetry(): bool
    {
        return $this->httpTelemetry;
    }

    public function hasHttpTelemetry(): bool
    {
        return true;
    }

    public function setManagementToken(?string $managementToken = null): self
    {
        if (null !== $managementToken && '' === trim($managementToken)) {
            $managementToken = null;
        }

        $this->managementToken = $managementToken;

        return $this;
    }

    public function getManagementToken(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->managementToken, $exceptionIfNull);

        return $this->managementToken;
    }

    public function hasManagementToken(): bool
    {
        return null !== $this->managementToken;
    }

    public function setManagementTokenCache(?CacheItemPoolInterface $managementTokenCache = null): self
    {
        $this->managementTokenCache = $managementTokenCache;

        return $this;
    }

    public function getManagementTokenCache(?\Throwable $exceptionIfNull = null): ?CacheItemPoolInterface
    {
        $this->exceptionIfNull($this->managementTokenCache, $exceptionIfNull);

        return $this->managementTokenCache;
    }

    public function hasManagementTokenCache(): bool
    {
        return null !== $this->managementTokenCache;
    }

    /**
     * @param  array<string>|null  $organization  an allowlist of Organization IDs
     */
    public function setOrganization(?array $organization = null): self
    {
        if (null !== $organization && [] === $organization) {
            $organization = null;
        }

        $this->organization = $this->filterArray($organization);

        return $this;
    }

    /**
     * @return array<string>|null the allowlist of Organization IDs
     */
    public function getOrganization(?\Throwable $exceptionIfNull = null): ?array
    {
        $this->exceptionIfNull($this->organization, $exceptionIfNull);

        return $this->organization;
    }

    public function hasOrganization(): bool
    {
        return null !== $this->organization;
    }

    /**
     * @param  array<string>|string  $organizations  a string or array of strings representing Organization IDs to add to the allowlist
     * @return array<string>|null
     */
    public function pushOrganization(array|string $organizations): ?array
    {
        if (\is_string($organizations)) {
            $organizations = trim($organizations);

            if ('' === $organizations) {
                return $this->organization;
            }

            $organizations = [$organizations];
        }

        if ([] === $organizations) {
            return $this->organization;
        }

        $this->setOrganization(array_merge($this->organization ?? [], $organizations));

        return $this->organization;
    }

    public function setPersistAccessToken(bool $persistAccessToken = true): self
    {
        $this->persistAccessToken = $persistAccessToken;

        return $this;
    }

    public function getPersistAccessToken(): bool
    {
        return $this->persistAccessToken;
    }

    public function hasPersistAccessToken(): bool
    {
        return true;
    }

    public function setPersistIdToken(bool $persistIdToken = true): self
    {
        $this->persistIdToken = $persistIdToken;

        return $this;
    }

    public function getPersistIdToken(): bool
    {
        return $this->persistIdToken;
    }

    public function hasPersistIdToken(): bool
    {
        return true;
    }

    public function setPersistRefreshToken(bool $persistRefreshToken = true): self
    {
        $this->persistRefreshToken = $persistRefreshToken;

        return $this;
    }

    public function getPersistRefreshToken(): bool
    {
        return $this->persistRefreshToken;
    }

    public function hasPersistRefreshToken(): bool
    {
        return true;
    }

    public function setPersistUser(bool $persistUser = true): self
    {
        $this->persistUser = $persistUser;

        return $this;
    }

    public function getPersistUser(): bool
    {
        return $this->persistUser;
    }

    public function hasPersistUser(): bool
    {
        return true;
    }

    public function setQueryUserInfo(bool $queryUserInfo = false): self
    {
        $this->queryUserInfo = $queryUserInfo;

        return $this;
    }

    public function getQueryUserInfo(): bool
    {
        return $this->queryUserInfo;
    }

    public function hasQueryUserInfo(): bool
    {
        return true;
    }

    public function setRedirectUri(?string $redirectUri = null): self
    {
        if (null !== $redirectUri && '' === trim($redirectUri)) {
            $redirectUri = null;
        }

        $this->redirectUri = $redirectUri;

        return $this;
    }

    public function getRedirectUri(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->redirectUri, $exceptionIfNull);

        return $this->redirectUri;
    }

    public function hasRedirectUri(): bool
    {
        return null !== $this->redirectUri;
    }

    public function setResponseMode(string $responseMode = 'query'): self
    {
        if ('' === trim($responseMode)) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('responseMode');
        }

        $this->responseMode = $responseMode;

        return $this;
    }

    public function getResponseMode(): string
    {
        return $this->responseMode;
    }

    public function hasResponseMode(): bool
    {
        return true;
    }

    public function setResponseType(string $responseType = 'code'): self
    {
        if ('' === trim($responseType)) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('responseMode');
        }

        $this->responseType = $responseType;

        return $this;
    }

    public function getResponseType(): string
    {
        return $this->responseType;
    }

    public function hasResponseType(): bool
    {
        return true;
    }

    /**
     * @param  array<string>  $scope  an array of scopes to request during authentication steps
     */
    public function setScope(?array $scope = ['openid', 'profile', 'email']): self
    {
        if (null === $scope || [] === $scope) {
            $scope = ['openid', 'profile', 'email'];
        }

        $this->scope = $this->filterArray($scope) ?? [];

        return $this;
    }

    /**
     * @return array<string> the array of scopes that will be requested during authentication steps
     */
    public function getScope(): array
    {
        return $this->scope ?? ['openid', 'profile', 'email'];
    }

    public function hasScope(): bool
    {
        return true;
    }

    /**
     * @param  array<string>|string  $scopes  one or more scopes to add to the list requested during authentication steps
     * @return array<string>|null
     */
    public function pushScope(array|string $scopes): ?array
    {
        if (\is_string($scopes)) {
            $scopes = trim($scopes);

            if ('' === $scopes) {
                return $this->scope;
            }

            $scopes = [$scopes];
        }

        if ([] === $scopes) {
            return $this->scope;
        }

        $this->setScope(array_merge($this->getScope(), $scopes));

        return $this->scope;
    }

    public function setSessionStorage(?StoreInterface $sessionStorage = null): self
    {
        $this->sessionStorage = $sessionStorage;

        return $this;
    }

    public function getSessionStorage(?\Throwable $exceptionIfNull = null): ?StoreInterface
    {
        $this->exceptionIfNull($this->sessionStorage, $exceptionIfNull);

        return $this->sessionStorage;
    }

    public function hasSessionStorage(): bool
    {
        return null !== $this->sessionStorage;
    }

    public function setSessionStorageId(string $sessionStorageId = 'auth0_session'): self
    {
        if ('' === trim($sessionStorageId)) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('sessionStorageId');
        }

        $this->sessionStorageId = $sessionStorageId;

        return $this;
    }

    public function getSessionStorageId(): string
    {
        return $this->sessionStorageId;
    }

    public function hasSessionStorageId(): bool
    {
        return true;
    }

    public function setStrategy(string $strategy = self::STRATEGY_REGULAR): self
    {
        if (! \in_array($strategy, [self::STRATEGY_REGULAR, self::STRATEGY_API, self::STRATEGY_MANAGEMENT_API, self::STRATEGY_NONE], true)) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('strategy');
        }

        $this->strategy = $strategy;

        return $this;
    }

    public function getStrategy(): string
    {
        return $this->strategy;
    }

    public function hasStrategy(): bool
    {
        return true;
    }

    public function setTokenAlgorithm(string $tokenAlgorithm = Token::ALGO_RS256): self
    {
        if (! \in_array($tokenAlgorithm, [Token::ALGO_RS256, Token::ALGO_HS256], true)) {
            throw \Auth0\SDK\Exception\ConfigurationException::invalidAlgorithm();
        }

        $this->tokenAlgorithm = $tokenAlgorithm;

        return $this;
    }

    public function getTokenAlgorithm(): string
    {
        return $this->tokenAlgorithm;
    }

    public function hasTokenAlgorithm(): bool
    {
        return true;
    }

    public function setTokenCache(?CacheItemPoolInterface $tokenCache = null): self
    {
        $this->tokenCache = $tokenCache;

        return $this;
    }

    public function getTokenCache(?\Throwable $exceptionIfNull = null): ?CacheItemPoolInterface
    {
        $this->exceptionIfNull($this->tokenCache, $exceptionIfNull);

        return $this->tokenCache;
    }

    public function hasTokenCache(): bool
    {
        return null !== $this->tokenCache;
    }

    public function setTokenCacheTtl(int $tokenCacheTtl = 60): self
    {
        if ($tokenCacheTtl < 0) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('tokenCacheTtl');
        }

        $this->tokenCacheTtl = $tokenCacheTtl;

        return $this;
    }

    public function getTokenCacheTtl(): int
    {
        return $this->tokenCacheTtl;
    }

    public function hasTokenCacheTtl(): bool
    {
        return true;
    }

    public function setTokenJwksUri(?string $tokenJwksUri = null): self
    {
        if (null !== $tokenJwksUri && '' === trim($tokenJwksUri)) {
            $tokenJwksUri = null;
        }

        $this->tokenJwksUri = $tokenJwksUri;

        return $this;
    }

    public function getTokenJwksUri(?\Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->tokenJwksUri, $exceptionIfNull);

        return $this->tokenJwksUri;
    }

    public function hasTokenJwksUri(): bool
    {
        return null !== $this->tokenJwksUri;
    }

    public function setTokenLeeway(int $tokenLeeway = 60): self
    {
        if ($tokenLeeway < 0) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('tokenLeeway');
        }

        $this->tokenLeeway = $tokenLeeway;

        return $this;
    }

    public function getTokenLeeway(?\Throwable $exceptionIfNull = null): ?int
    {
        $this->exceptionIfNull($this->tokenLeeway, $exceptionIfNull);

        return $this->tokenLeeway;
    }

    public function hasTokenLeeway(): bool
    {
        return true;
    }

    public function setTokenMaxAge(?int $tokenMaxAge = null): self
    {
        if (null !== $tokenMaxAge && $tokenMaxAge < 0) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('tokenMaxAge');
        }

        $this->tokenMaxAge = $tokenMaxAge;

        return $this;
    }

    public function getTokenMaxAge(?\Throwable $exceptionIfNull = null): ?int
    {
        $this->exceptionIfNull($this->tokenMaxAge, $exceptionIfNull);

        return $this->tokenMaxAge;
    }

    public function hasTokenMaxAge(): bool
    {
        return null !== $this->tokenMaxAge;
    }

    public function setTransientStorage(?StoreInterface $transientStorage = null): self
    {
        $this->transientStorage = $transientStorage;

        return $this;
    }

    public function getTransientStorage(?\Throwable $exceptionIfNull = null): ?StoreInterface
    {
        $this->exceptionIfNull($this->transientStorage, $exceptionIfNull);

        return $this->transientStorage;
    }

    public function hasTransientStorage(): bool
    {
        return null !== $this->transientStorage;
    }

    public function setTransientStorageId(string $transientStorageId = 'auth0_transient'): self
    {
        if ('' === trim($transientStorageId)) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('transientStorageId');
        }

        $this->transientStorageId = $transientStorageId;

        return $this;
    }

    public function getTransientStorageId(): string
    {
        return $this->transientStorageId;
    }

    public function hasTransientStorageId(): bool
    {
        return true;
    }

    public function setUsePkce(bool $usePkce): self
    {
        $this->usePkce = $usePkce;

        return $this;
    }

    public function getUsePkce(): bool
    {
        return $this->usePkce;
    }

    public function hasUsePkce(): bool
    {
        return true;
    }

    /**
     * Return the configured custom or tenant domain, formatted with protocol.
     *
     * @param  bool  $forceTenantDomain  force the return of the tenant domain even if a custom domain is configured
     */
    public function formatDomain(
        bool $forceTenantDomain = false,
    ): string {
        if ($this->hasCustomDomain() && ! $forceTenantDomain) {
            return 'https://' . ($this->getCustomDomain() ?? '');
        }

        return 'https://' . ($this->getDomain() ?? '');
    }

    /**
     * Return the configured domain with protocol.
     */
    public function formatCustomDomain(): ?string
    {
        if ($this->hasCustomDomain()) {
            return 'https://' . ($this->getCustomDomain() ?? '');
        }

        return null;
    }

    /**
     * Return the configured scopes as a space-delimited string.
     */
    public function formatScope(): ?string
    {
        if ($this->hasScope()) {
            $scope = $this->getScope();

            if ([] !== $scope) {
                return implode(' ', $scope);
            }
        }

        return null;
    }

    /**
     * Get the first configured organization.
     */
    public function defaultOrganization(): ?string
    {
        // Return the default organization.
        if ($this->hasOrganization()) {
            $organization = $this->getOrganization();

            if (null !== $organization && [] !== $organization) {
                $organizations = array_values($organization);

                return array_shift($organizations);
            }
        }

        return null;
    }

    /**
     * Get the first configured audience.
     */
    public function defaultAudience(): string
    {
        // Return the default audience.
        if ($this->hasAudience()) {
            $audience = $this->getAudience();

            if (null !== $audience && [] !== $audience) {
                $audiences = array_values($audience);

                return array_shift($audiences);
            }
        }

        return '';
    }

    /**
     * Get an instance of the EventDispatcher.
     */
    public function eventDispatcher(): EventDispatcher
    {
        if (null === $this->eventDispatcher) {
            $this->eventDispatcher = new EventDispatcher($this);
        }

        return $this->eventDispatcher;
    }

    /**
     * Returns true when the configured `strategy` is 'stateful', meaning it requires an available and configured session.
     */
    public function usingStatefulness(): bool
    {
        return \in_array($this->getStrategy(), self::STRATEGIES_USING_SESSIONS, true);
    }

    /**
     * Setup SDK cookie state.
     */
    private function setupStateCookies(): void
    {
        if (! $this->hasCookieDomain()) {
            $domain = $_SERVER['HTTP_HOST'] ?? $this->getRedirectUri();

            if (null !== $domain) {
                $parsed = parse_url($domain, PHP_URL_HOST);

                if (\is_string($parsed)) {
                    $domain = $parsed;
                }

                if ($domain) {
                    $this->setCookieDomain($domain);
                }
            }
        }
    }

    /**
     * Setup SDK factories.
     *
     * @throws NotFoundException when a PSR-18 or PSR-17 are not configured, and cannot be discovered
     *
     * @codeCoverageIgnore
     */
    private function setupStateFactories(): void
    {
        // If a PSR-18 compatible client wasn't provided, try to discover one.
        if (! $this->getHttpClient() instanceof ClientInterface) {
            try {
                $this->setHttpClient(Psr18ClientDiscovery::find());
            } catch (\Throwable $th) {
                throw \Auth0\SDK\Exception\ConfigurationException::missingPsr18Library();
            }
        }

        // If a PSR-17 compatible request factory wasn't provided, try to discover one.
        if (! $this->getHttpRequestFactory() instanceof RequestFactoryInterface) {
            try {
                $this->setHttpRequestFactory(Psr17FactoryDiscovery::findRequestFactory());
            } catch (NotFoundException $exception) {
                throw \Auth0\SDK\Exception\ConfigurationException::missingPsr17Library();
            }
        }

        // If a PSR-17 compatible response factory wasn't provided, try to discover one.
        if (! $this->getHttpResponseFactory() instanceof ResponseFactoryInterface) {
            try {
                $this->setHttpResponseFactory(Psr17FactoryDiscovery::findResponseFactory());
            } catch (NotFoundException $exception) {
                throw \Auth0\SDK\Exception\ConfigurationException::missingPsr17Library();
            }
        }

        // If a PSR-17 compatible stream factory wasn't provided, try to discover one.
        if (! $this->getHttpStreamFactory() instanceof StreamFactoryInterface) {
            try {
                $this->setHttpStreamFactory(Psr17FactoryDiscovery::findStreamFactory());
            } catch (NotFoundException $exception) {
                throw \Auth0\SDK\Exception\ConfigurationException::missingPsr17Library();
            }
        }
    }

    /**
     * Setup SDK storage state.
     */
    private function setupStateStorage(): void
    {
        if (! $this->getSessionStorage() instanceof StoreInterface) {
            $this->setSessionStorage(new CookieStore($this, $this->getSessionStorageId()));
        }

        if (! $this->getTransientStorage() instanceof StoreInterface) {
            $this->setTransientStorage(new CookieStore($this, $this->getTransientStorageId()));
        }
    }

    /**
     * Setup SDK validators based on strategy type.
     */
    private function validateState(
        ?string $strategy = null,
    ): void {
        $strategy ??= $this->getStrategy();

        if (self::STRATEGY_REGULAR === $strategy) {
            $this->validateStateWebApp();
        }

        if (self::STRATEGY_API === $strategy) {
            $this->validateStateApi();
        }

        if (self::STRATEGY_MANAGEMENT_API === $strategy) {
            $this->validateStateManagement();
        }
    }

    /**
     * Run validations for an API-only usage configuration.
     */
    private function validateStateApi(): void
    {
        if (! $this->hasDomain()) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresDomain();
        }

        if (! $this->hasAudience()) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresAudience();
        }
    }

    /**
     * Run validations for a Management-only usage configuration.
     */
    private function validateStateManagement(): void
    {
        if (! $this->hasDomain()) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresDomain();
        }

        if (! $this->hasManagementToken()) {
            if (! $this->hasClientId()) {
                throw \Auth0\SDK\Exception\ConfigurationException::requiresClientId();
            }

            if (! $this->hasClientSecret()) {
                throw \Auth0\SDK\Exception\ConfigurationException::requiresClientSecret();
            }
        }
    }

    /**
     * Run validations for a general webapp usage configuration.
     */
    private function validateStateWebApp(): void
    {
        if (! $this->hasDomain()) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresDomain();
        }

        if (! $this->hasClientId()) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresClientId();
        }

        if ('HS256' === $this->getTokenAlgorithm() && ! $this->hasClientSecret()) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresClientSecret();
        }

        if (! $this->hasCookieSecret()) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresCookieSecret();
        }
    }

    /**
     * @return array<callable>
     *
     * @psalm-suppress MissingClosureParamType
     */
    private function getPropertyValidators(): array
    {
        return [
            'strategy'              => static fn ($value) => \is_string($value),
            'domain'                => static fn ($value) => \is_string($value) || null === $value,
            'customDomain'          => static fn ($value) => \is_string($value) || null === $value,
            'clientId'              => static fn ($value) => \is_string($value) || null === $value,
            'redirectUri'           => static fn ($value) => \is_string($value) || null === $value,
            'clientSecret'          => static fn ($value) => \is_string($value) || null === $value,
            'audience'              => static fn ($value) => \is_array($value) || null === $value,
            'organization'          => static fn ($value) => \is_array($value) || null === $value,
            'usePkce'               => static fn ($value) => \is_bool($value),
            'scope'                 => static fn ($value) => \is_array($value) || null === $value,
            'responseMode'          => static fn ($value) => \is_string($value),
            'responseType'          => static fn ($value) => \is_string($value),
            'tokenAlgorithm'        => static fn ($value) => \is_string($value),
            'tokenJwksUri'          => static fn ($value) => \is_string($value) || null === $value,
            'tokenMaxAge'           => static fn ($value) => \is_int($value) || null === $value,
            'tokenLeeway'           => static fn ($value) => \is_int($value),
            'tokenCache'            => static fn ($value) => $value instanceof CacheItemPoolInterface || null === $value,
            'tokenCacheTtl'         => static fn ($value) => \is_int($value),
            'httpClient'            => static fn ($value) => $value instanceof ClientInterface || null === $value,
            'httpMaxRetries'        => static fn ($value) => \is_int($value),
            'httpRequestFactory'    => static fn ($value) => $value instanceof RequestFactoryInterface || null === $value,
            'httpResponseFactory'   => static fn ($value) => $value instanceof ResponseFactoryInterface || null === $value,
            'httpStreamFactory'     => static fn ($value) => $value instanceof StreamFactoryInterface || null === $value,
            'httpTelemetry'         => static fn ($value) => \is_bool($value),
            'sessionStorage'        => static fn ($value) => $value instanceof StoreInterface || null === $value,
            'sessionStorageId'      => static fn ($value) => \is_string($value),
            'cookieSecret'          => static fn ($value) => \is_string($value) || null === $value,
            'cookieDomain'          => static fn ($value) => \is_string($value) || null === $value,
            'cookieExpires'         => static fn ($value) => \is_int($value),
            'cookiePath'            => static fn ($value) => \is_string($value),
            'cookieSecure'          => static fn ($value) => \is_bool($value),
            'cookieSameSite'        => static fn ($value) => \is_string($value) || null === $value,
            'persistUser'           => static fn ($value) => \is_bool($value),
            'persistIdToken'        => static fn ($value) => \is_bool($value),
            'persistAccessToken'    => static fn ($value) => \is_bool($value),
            'persistRefreshToken'   => static fn ($value) => \is_bool($value),
            'transientStorage'      => static fn ($value) => $value instanceof StoreInterface || null === $value,
            'transientStorageId'    => static fn ($value) => \is_string($value),
            'queryUserInfo'         => static fn ($value) => \is_bool($value),
            'managementToken'       => static fn ($value) => \is_string($value) || null === $value,
            'managementTokenCache'  => static fn ($value) => $value instanceof CacheItemPoolInterface || null === $value,
            'eventListenerProvider' => static fn ($value) => $value instanceof ListenerProviderInterface || null === $value,
        ];
    }

    /**
     * @return array<mixed>
     */
    private function getPropertyDefaults(): array
    {
        return [
            'strategy'              => self::STRATEGY_REGULAR,
            'domain'                => null,
            'customDomain'          => null,
            'clientId'              => null,
            'redirectUri'           => null,
            'clientSecret'          => null,
            'audience'              => null,
            'organization'          => null,
            'usePkce'               => true,
            'scope'                 => ['openid', 'profile', 'email'],
            'responseMode'          => 'query',
            'responseType'          => 'code',
            'tokenAlgorithm'        => Token::ALGO_RS256,
            'tokenJwksUri'          => null,
            'tokenMaxAge'           => null,
            'tokenLeeway'           => 60,
            'tokenCache'            => null,
            'tokenCacheTtl'         => 60,
            'httpClient'            => null,
            'httpMaxRetries'        => 3,
            'httpRequestFactory'    => null,
            'httpResponseFactory'   => null,
            'httpStreamFactory'     => null,
            'httpTelemetry'         => true,
            'sessionStorage'        => null,
            'sessionStorageId'      => 'auth0_session',
            'cookieSecret'          => null,
            'cookieDomain'          => null,
            'cookieExpires'         => 0,
            'cookiePath'            => '/',
            'cookieSecure'          => false,
            'cookieSameSite'        => null,
            'persistUser'           => true,
            'persistIdToken'        => true,
            'persistAccessToken'    => true,
            'persistRefreshToken'   => true,
            'transientStorage'      => null,
            'transientStorageId'    => 'auth0_transient',
            'queryUserInfo'         => false,
            'managementToken'       => null,
            'managementTokenCache'  => null,
            'eventListenerProvider' => null,
        ];
    }
}
