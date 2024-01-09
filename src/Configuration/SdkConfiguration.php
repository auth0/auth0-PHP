<?php

declare(strict_types=1);

namespace Auth0\SDK\Configuration;

use Auth0\SDK\Contract\{ConfigurableContract, StoreInterface};
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Mixins\ConfigurableMixin;
use Auth0\SDK\Store\CookieStore;
use Auth0\SDK\Token;
use Auth0\SDK\Token\ClientAssertionGenerator;
use Auth0\SDK\Utility\{Assert, EventDispatcher};
use OpenSSLAsymmetricKey;
use Psr\Cache\CacheItemPoolInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\{RequestFactoryInterface, ResponseFactoryInterface, StreamFactoryInterface};
use PsrDiscovery\Discover;
use Throwable;

use function in_array;
use function is_array;
use function is_bool;
use function is_int;
use function is_string;

final class SdkConfiguration implements ConfigurableContract
{
    use ConfigurableMixin;

    /**
     * @var string[]
     */
    public const STRATEGIES_USING_SESSIONS = [self::STRATEGY_REGULAR];

    /**
     * @var string
     */
    public const STRATEGY_API = 'api';

    /**
     * @var string
     */
    public const STRATEGY_MANAGEMENT_API = 'management';

    /**
     * @var string
     */
    public const STRATEGY_NONE = 'none';

    /**
     * @var string
     */
    public const STRATEGY_REGULAR = 'webapp';

    /**
     * An instance of the EventDispatcher utility.
     */
    private ?EventDispatcher $eventDispatcher = null;

    /**
     * SdkConfiguration Constructor.
     *
     * @param null|array<mixed>                $configuration                   An key-value array matching this constructor's arguments. Overrides any other passed arguments with the same key name.
     * @param string                           $strategy                        Defaults to 'webapp'. Should be assigned either 'api', 'management', or 'webapp' to specify the type of application the SDK is being applied to. Determines what configuration options will be required at initialization.
     * @param null|string                      $domain                          Auth0 domain for your tenant, found in your Auth0 Application settings
     * @param null|string                      $customDomain                    If you have configured Auth0 to use a custom domain, configure it here
     * @param null|string                      $clientId                        Client ID, found in the Auth0 Application settings
     * @param null|string                      $redirectUri                     Authentication callback URI, as defined in your Auth0 Application settings
     * @param null|string                      $clientSecret                    Client Secret, found in the Auth0 Application settings
     * @param null|array<string>               $audience                        One or more API identifiers, found in your Auth0 API settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'aud' claim to validate an ID Token successfully.
     * @param null|array<string>               $organization                    Allowlist containing one or more organization IDs/names. Reference your Auth0 organization settings for these values. By default, the SDK will use the first value provided when generating authorization links.
     * @param bool                             $usePkce                         Defaults to true. Use PKCE (Proof Key of Code Exchange) with Authorization Code Flow requests. See https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce
     * @param null|array<string>               $scope                           One or more scopes to request for Tokens. See https://auth0.com/docs/scopes
     * @param string                           $responseMode                    Defaults to 'query.' Where to extract request parameters from, either 'query' for GET or 'form_post' for POST requests.
     * @param string                           $responseType                    Defaults to 'code.' Use 'code' for server-side flows and 'token' for application side flow.
     * @param string                           $tokenAlgorithm                  Defaults to 'RS256'. Algorithm to use for Token verification. Expects either 'RS256' or 'HS256'.
     * @param null|string                      $tokenJwksUri                    URI to the JWKS when verifying RS256 tokens
     * @param null|int                         $tokenMaxAge                     The maximum window of time (in seconds) since the 'auth_time' to accept during Token validation
     * @param int                              $tokenLeeway                     Defaults to 60. Leeway (in seconds) to allow during time calculations with Token validation.
     * @param null|CacheItemPoolInterface      $tokenCache                      A PSR-6 compatible cache adapter for storing JSON Web Key Sets (JWKS)
     * @param int                              $tokenCacheTtl                   How long (in seconds) to keep a JWKS cached
     * @param null|ClientInterface             $httpClient                      A PSR-18 compatible HTTP client to use for API requests
     * @param int                              $httpMaxRetries                  When a rate-limit (429 status code) response is returned from the Auth0 API, automatically retry the request up to this many times
     * @param null|RequestFactoryInterface     $httpRequestFactory              A PSR-17 compatible request factory to generate HTTP requests
     * @param null|ResponseFactoryInterface    $httpResponseFactory             A PSR-17 compatible response factory to generate HTTP responses
     * @param null|StreamFactoryInterface      $httpStreamFactory               A PSR-17 compatible stream factory to create request body streams
     * @param bool                             $httpTelemetry                   Defaults to true. If true, API requests will include telemetry about the SDK and PHP runtime version to help us improve our services.
     * @param null|StoreInterface              $sessionStorage                  Defaults to use cookies. A StoreInterface-compatible class for storing Token state.
     * @param string                           $sessionStorageId                Defaults to 'auth0_session'. The namespace to prefix session items under.
     * @param null|string                      $cookieSecret                    The secret used to derive an encryption key for the user identity in a session cookie and to sign the transient cookies used by the login callback
     * @param null|string                      $cookieDomain                    Defaults to value of HTTP_HOST server environment information. Cookie domain, for example 'www.example.com', for use with PHP sessions and SDK cookies. To make cookies visible on all subdomains then the domain must be prefixed with a dot like '.example.com'.
     * @param int                              $cookieExpires                   Defaults to 0. How long, in seconds, before cookies expire. If set to 0 the cookie will expire at the end of the session (when the browser closes).
     * @param string                           $cookiePath                      Defaults to '/'. Specifies path on the domain where the cookies will work. Use a single slash ('/') for all paths on the domain.
     * @param null|string                      $cookieSameSite                  Defaults to 'lax'. Specifies whether cookies should be restricted to first-party or same-site context.
     * @param bool                             $cookieSecure                    Defaults to false. Specifies whether cookies should ONLY be sent over secure connections.
     * @param bool                             $persistUser                     Defaults to true. If true, the user data will persist in session storage.
     * @param bool                             $persistIdToken                  Defaults to true. If true, the Id Token will persist in session storage.
     * @param bool                             $persistAccessToken              Defaults to true. If true, the Access Token will persist in session storage.
     * @param bool                             $persistRefreshToken             Defaults to true. If true, the Refresh Token will persist in session storage.
     * @param null|StoreInterface              $transientStorage                Defaults to use cookies. A StoreInterface-compatible class for storing ephemeral state data, such as nonces.
     * @param string                           $transientStorageId              Defaults to 'auth0_transient'. The namespace to prefix transient items under.
     * @param bool                             $queryUserInfo                   Defaults to false. If true, query the /userinfo endpoint during an authorization code exchange.
     * @param null|string                      $managementToken                 An Access Token to use for Management API calls. If there isn't one specified, the SDK will attempt to get one for you using your $clientSecret.
     * @param null|CacheItemPoolInterface      $managementTokenCache            A PSR-6 compatible cache adapter for storing generated management access tokens
     * @param null|ListenerProviderInterface   $eventListenerProvider           A PSR-14 compatible event listener provider, for interfacing with events triggered by the SDK
     * @param null|OpenSSLAsymmetricKey|string $clientAssertionSigningKey       An OpenSSLAsymmetricKey (or string representing equivalent, such as a PEM) to use for signing the client assertion. If not specified, the SDK will attempt to use the $clientSecret.
     * @param string                           $clientAssertionSigningAlgorithm Defaults to RS256. Algorithm to use for signing the client assertion.
     * @param bool                             $pushedAuthorizationRequest      Defaults to false. If true, the SDK will attempt to use the Pushed Authorization Requests for authentication. See https://www.rfc-editor.org/rfc/rfc9126.html#.
     * @param null|CacheItemPoolInterface      $backchannelLogoutCache          A PSR-6 compatible cache adapter for storing backchannel logout tokens.
     * @param int                              $backchannelLogoutExpires        Defaults to 2592000 (30 days). How long, in seconds, before a backchannel logout request expires from the cache. This should be greater than your $cookieExpires value, particularly if you are using rolling sessions.
     *
     * @throws ConfigurationException when a valid `$strategy` is not specified
     */
    public function __construct(
        ?array $configuration = null,
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
        private OpenSSLAsymmetricKey | string | null $clientAssertionSigningKey = null,
        private string $clientAssertionSigningAlgorithm = Token::ALGO_RS256,
        private bool $pushedAuthorizationRequest = false,
        private ?CacheItemPoolInterface $backchannelLogoutCache = null,
        private int $backchannelLogoutExpires = 2592000,
    ) {
        if (null !== $configuration && [] !== $configuration) {
            $this->applyConfiguration($configuration);
        }

        $this->validateProperties();
        $this->setupStateFactories();

        if ($this->usingStatefulness()) {
            $this->setupStateStorage();
        }

        $this->validateState();
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
     * Get an instance of the EventDispatcher.
     */
    public function eventDispatcher(): EventDispatcher
    {
        if (! $this->eventDispatcher instanceof EventDispatcher) {
            $this->eventDispatcher = new EventDispatcher($this);
        }

        return $this->eventDispatcher;
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
     * Return the configured custom or tenant domain, formatted with protocol.
     *
     * @param bool $forceTenantDomain force the return of the tenant domain even if a custom domain is configured
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
     * Return the configured scopes as a space-delimited string.
     */
    public function formatScope(): ?string
    {
        return implode(' ', $this->getScope());
    }

    /**
     * @param ?Throwable $exceptionIfNull
     *
     * @return null|array<string>
     */
    public function getAudience(?Throwable $exceptionIfNull = null): ?array
    {
        $this->exceptionIfNull($this->audience, $exceptionIfNull);

        return $this->audience;
    }

    public function getBackchannelLogoutCache(?Throwable $exceptionIfNull = null): ?CacheItemPoolInterface
    {
        $this->exceptionIfNull($this->backchannelLogoutCache, $exceptionIfNull);

        return $this->backchannelLogoutCache;
    }

    public function getBackchannelLogoutExpires(): int
    {
        return $this->backchannelLogoutExpires;
    }

    public function getClientAssertionSigningAlgorithm(): string
    {
        return $this->clientAssertionSigningAlgorithm;
    }

    public function getClientAssertionSigningKey(): OpenSSLAsymmetricKey | string | null
    {
        return $this->clientAssertionSigningKey;
    }

    public function getClientId(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->clientId, $exceptionIfNull);

        return $this->clientId;
    }

    public function getClientSecret(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->clientSecret, $exceptionIfNull);

        return $this->clientSecret;
    }

    public function getCookieDomain(): ?string
    {
        if (null !== $this->cookieDomain) {
            return $this->cookieDomain;
        }

        $domain = (isset($_SERVER['HTTP_HOST']) && '' !== trim($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : null;
        $domain ??= $this->getRedirectUri();
        $domain ??= (isset($_SERVER['SERVER_NAME']) && '' !== trim($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : null;
        $domain = trim($domain ?? '');

        if (mb_strlen($domain) > 0) {
            $parsed = parse_url($domain, PHP_URL_HOST);

            if (is_string($parsed)) {
                $domain = $parsed;
            }

            if ('' !== trim($domain)) {
                return $domain;
            }
        }

        return null;
    }

    public function getCookieExpires(): int
    {
        return $this->cookieExpires;
    }

    public function getCookiePath(): string
    {
        return $this->cookiePath;
    }

    public function getCookieSameSite(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->cookieSameSite, $exceptionIfNull);

        return $this->cookieSameSite;
    }

    public function getCookieSecret(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->cookieSecret, $exceptionIfNull);

        return $this->cookieSecret;
    }

    public function getCookieSecure(): bool
    {
        return $this->cookieSecure;
    }

    public function getCustomDomain(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->customDomain, $exceptionIfNull);

        return $this->customDomain;
    }

    public function getDomain(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->domain, $exceptionIfNull);

        return $this->domain;
    }

    public function getEventListenerProvider(?Throwable $exceptionIfNull = null): ?ListenerProviderInterface
    {
        $this->exceptionIfNull($this->eventListenerProvider, $exceptionIfNull);

        return $this->eventListenerProvider;
    }

    public function getHttpClient(?Throwable $exceptionIfNull = null): ?ClientInterface
    {
        $this->exceptionIfNull($this->httpClient, $exceptionIfNull);

        return $this->httpClient;
    }

    public function getHttpMaxRetries(): int
    {
        return $this->httpMaxRetries;
    }

    public function getHttpRequestFactory(?Throwable $exceptionIfNull = null): ?RequestFactoryInterface
    {
        $this->exceptionIfNull($this->httpRequestFactory, $exceptionIfNull);

        return $this->httpRequestFactory;
    }

    public function getHttpResponseFactory(?Throwable $exceptionIfNull = null): ?ResponseFactoryInterface
    {
        $this->exceptionIfNull($this->httpResponseFactory, $exceptionIfNull);

        return $this->httpResponseFactory;
    }

    public function getHttpStreamFactory(?Throwable $exceptionIfNull = null): ?StreamFactoryInterface
    {
        $this->exceptionIfNull($this->httpStreamFactory, $exceptionIfNull);

        return $this->httpStreamFactory;
    }

    public function getHttpTelemetry(): bool
    {
        return $this->httpTelemetry;
    }

    public function getManagementToken(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->managementToken, $exceptionIfNull);

        return $this->managementToken;
    }

    public function getManagementTokenCache(?Throwable $exceptionIfNull = null): ?CacheItemPoolInterface
    {
        $this->exceptionIfNull($this->managementTokenCache, $exceptionIfNull);

        return $this->managementTokenCache;
    }

    /**
     * @param ?Throwable $exceptionIfNull
     *
     * @return null|array<string> The configured allowlist of organization IDs/names.
     */
    public function getOrganization(?Throwable $exceptionIfNull = null): ?array
    {
        $this->exceptionIfNull($this->organization, $exceptionIfNull);

        return $this->organization;
    }

    public function getPersistAccessToken(): bool
    {
        return $this->persistAccessToken;
    }

    public function getPersistIdToken(): bool
    {
        return $this->persistIdToken;
    }

    public function getPersistRefreshToken(): bool
    {
        return $this->persistRefreshToken;
    }

    public function getPersistUser(): bool
    {
        return $this->persistUser;
    }

    public function getPushedAuthorizationRequest(): bool
    {
        return $this->pushedAuthorizationRequest;
    }

    public function getQueryUserInfo(): bool
    {
        return $this->queryUserInfo;
    }

    public function getRedirectUri(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->redirectUri, $exceptionIfNull);

        return $this->redirectUri;
    }

    public function getResponseMode(): string
    {
        return $this->responseMode;
    }

    public function getResponseType(): string
    {
        return $this->responseType;
    }

    /**
     * @return array<string> the array of scopes that will be requested during authentication steps
     */
    public function getScope(): array
    {
        return $this->scope ?? ['openid', 'profile', 'email'];
    }

    public function getSessionStorage(?Throwable $exceptionIfNull = null): ?StoreInterface
    {
        $this->exceptionIfNull($this->sessionStorage, $exceptionIfNull);

        return $this->sessionStorage;
    }

    public function getSessionStorageId(): string
    {
        return $this->sessionStorageId;
    }

    public function getStrategy(): string
    {
        return $this->strategy;
    }

    public function getTokenAlgorithm(): string
    {
        return $this->tokenAlgorithm;
    }

    public function getTokenCache(?Throwable $exceptionIfNull = null): ?CacheItemPoolInterface
    {
        $this->exceptionIfNull($this->tokenCache, $exceptionIfNull);

        return $this->tokenCache;
    }

    public function getTokenCacheTtl(): int
    {
        return $this->tokenCacheTtl;
    }

    public function getTokenJwksUri(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->tokenJwksUri, $exceptionIfNull);

        return $this->tokenJwksUri;
    }

    public function getTokenLeeway(?Throwable $exceptionIfNull = null): ?int
    {
        $this->exceptionIfNull($this->tokenLeeway, $exceptionIfNull);

        return $this->tokenLeeway;
    }

    public function getTokenMaxAge(?Throwable $exceptionIfNull = null): ?int
    {
        $this->exceptionIfNull($this->tokenMaxAge, $exceptionIfNull);

        return $this->tokenMaxAge;
    }

    public function getTransientStorage(?Throwable $exceptionIfNull = null): ?StoreInterface
    {
        $this->exceptionIfNull($this->transientStorage, $exceptionIfNull);

        return $this->transientStorage;
    }

    public function getTransientStorageId(): string
    {
        return $this->transientStorageId;
    }

    public function getUsePkce(): bool
    {
        return $this->usePkce;
    }

    public function hasAudience(): bool
    {
        return null !== $this->audience;
    }

    public function hasBackchannelLogoutCache(): bool
    {
        return $this->backchannelLogoutCache instanceof CacheItemPoolInterface;
    }

    public function hasClientAssertionSigningAlgorithm(): bool
    {
        return true;
    }

    public function hasClientAssertionSigningKey(): bool
    {
        return null !== $this->getClientAssertionSigningKey();
    }

    public function hasClientId(): bool
    {
        return null !== $this->clientId;
    }

    public function hasClientSecret(): bool
    {
        return null !== $this->clientSecret;
    }

    public function hasCookieDomain(): bool
    {
        return null !== $this->getCookieDomain();
    }

    public function hasCookieExpires(): bool
    {
        return true;
    }

    public function hasCookiePath(): bool
    {
        return true;
    }

    public function hasCookieSameSite(): bool
    {
        return null !== $this->cookieSameSite;
    }

    public function hasCookieSecret(): bool
    {
        return null !== $this->cookieSecret;
    }

    public function hasCookieSecure(): bool
    {
        return true;
    }

    public function hasCustomDomain(): bool
    {
        return null !== $this->customDomain;
    }

    public function hasDomain(): bool
    {
        return null !== $this->domain;
    }

    public function hasEventListenerProvider(): bool
    {
        return $this->eventListenerProvider instanceof ListenerProviderInterface;
    }

    public function hasHttpClient(): bool
    {
        return $this->httpClient instanceof ClientInterface;
    }

    public function hasHttpMaxRetries(): bool
    {
        return true;
    }

    public function hasHttpRequestFactory(): bool
    {
        return $this->httpRequestFactory instanceof RequestFactoryInterface;
    }

    public function hasHttpResponseFactory(): bool
    {
        return $this->httpResponseFactory instanceof ResponseFactoryInterface;
    }

    public function hasHttpStreamFactory(): bool
    {
        return $this->httpStreamFactory instanceof StreamFactoryInterface;
    }

    public function hasHttpTelemetry(): bool
    {
        return true;
    }

    public function hasManagementToken(): bool
    {
        return null !== $this->managementToken;
    }

    public function hasManagementTokenCache(): bool
    {
        return $this->managementTokenCache instanceof CacheItemPoolInterface;
    }

    public function hasOrganization(): bool
    {
        return null !== $this->organization;
    }

    public function hasPersistAccessToken(): bool
    {
        return true;
    }

    public function hasPersistIdToken(): bool
    {
        return true;
    }

    public function hasPersistRefreshToken(): bool
    {
        return true;
    }

    public function hasPersistUser(): bool
    {
        return true;
    }

    public function hasQueryUserInfo(): bool
    {
        return true;
    }

    public function hasRedirectUri(): bool
    {
        return null !== $this->redirectUri;
    }

    public function hasResponseMode(): bool
    {
        return true;
    }

    public function hasResponseType(): bool
    {
        return true;
    }

    public function hasScope(): bool
    {
        return true;
    }

    public function hasSessionStorage(): bool
    {
        return $this->sessionStorage instanceof StoreInterface;
    }

    public function hasSessionStorageId(): bool
    {
        return true;
    }

    public function hasStrategy(): bool
    {
        return true;
    }

    public function hasTokenAlgorithm(): bool
    {
        return true;
    }

    public function hasTokenCache(): bool
    {
        return $this->tokenCache instanceof CacheItemPoolInterface;
    }

    public function hasTokenCacheTtl(): bool
    {
        return true;
    }

    public function hasTokenJwksUri(): bool
    {
        return null !== $this->tokenJwksUri;
    }

    public function hasTokenLeeway(): bool
    {
        return true;
    }

    public function hasTokenMaxAge(): bool
    {
        return null !== $this->tokenMaxAge;
    }

    public function hasTransientStorage(): bool
    {
        return $this->transientStorage instanceof StoreInterface;
    }

    public function hasTransientStorageId(): bool
    {
        return true;
    }

    public function hasUsePkce(): bool
    {
        return true;
    }

    /**
     * @param array<string>|string $audiences a string or array of strings to add to the API identifiers/audiences allowlist
     *
     * @return null|array<string> the updated allowlist
     */
    public function pushAudience(array | string $audiences): ?array
    {
        if (is_string($audiences)) {
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

    /**
     * @param array<string>|string $organizations A string or array of strings representing organization IDs/names to add to the organization allowlist.
     *
     * @return null|array<string>
     */
    public function pushOrganization(array | string $organizations): ?array
    {
        if (is_string($organizations)) {
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

    /**
     * @param array<string>|string $scopes one or more scopes to add to the list requested during authentication steps
     *
     * @return null|array<string>
     */
    public function pushScope(array | string $scopes): ?array
    {
        if (is_string($scopes)) {
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

    /**
     * @param null|array<string> $audience an allowlist array of API identifiers/audiences
     */
    public function setAudience(?array $audience = null): self
    {
        $this->audience = $this->filterArray($audience);

        return $this;
    }

    public function setBackchannelLogoutCache(?CacheItemPoolInterface $backchannelLogoutCache = null): self
    {
        $this->backchannelLogoutCache = $backchannelLogoutCache;

        return $this;
    }

    public function setBackchannelLogoutExpires(int $backchannelLogoutExpires = 2592000): self
    {
        if ($backchannelLogoutExpires <= 0) {
            throw ConfigurationException::validationFailed('backchannelLogoutExpires');
        }

        $this->backchannelLogoutExpires = $backchannelLogoutExpires;

        return $this;
    }

    public function setClientAssertionSigningAlgorithm(string $clientAssertionSigningAlgorithm = Token::ALGO_RS256): self
    {
        if (! in_array($clientAssertionSigningAlgorithm, ClientAssertionGenerator::CONST_SUPPORTED_ALGORITHMS, true)) {
            throw ConfigurationException::incompatibleClientAssertionSigningAlgorithm($clientAssertionSigningAlgorithm);
        }

        $this->clientAssertionSigningAlgorithm = $clientAssertionSigningAlgorithm;

        return $this;
    }

    public function setClientAssertionSigningKey(OpenSSLAsymmetricKey | string | null $clientAssertionSigningKey): self
    {
        $this->clientAssertionSigningKey = $clientAssertionSigningKey;

        return $this;
    }

    public function setClientId(?string $clientId = null): self
    {
        $clientId = trim($clientId ?? '');

        if ('' === $clientId) {
            $clientId = null;
        }

        $this->clientId = $clientId;

        return $this;
    }

    public function setClientSecret(?string $clientSecret = null): self
    {
        $clientSecret = trim($clientSecret ?? '');

        if ('' === $clientSecret) {
            $clientSecret = null;
        }

        $this->clientSecret = $clientSecret;

        return $this;
    }

    public function setCookieDomain(?string $cookieDomain = null): self
    {
        $cookieDomain = trim($cookieDomain ?? '');

        if ('' === trim($cookieDomain)) {
            $cookieDomain = null;
        }

        $this->cookieDomain = $cookieDomain;

        return $this;
    }

    public function setCookieExpires(int $cookieExpires = 0): self
    {
        if ($cookieExpires < 0) {
            throw ConfigurationException::validationFailed('cookieExpires');
        }

        $this->cookieExpires = $cookieExpires;

        return $this;
    }

    public function setCookiePath(string $cookiePath = '/'): self
    {
        $cookiePath = trim($cookiePath);

        // Cookie path cannot be empty.
        if ('' === $cookiePath) {
            $cookiePath = '/';
        }

        // Cookie path must open with a slash.
        if ('/' !== mb_substr($cookiePath, 0, 1)) {
            $cookiePath = '/' . $cookiePath;
        }

        $this->cookiePath = $cookiePath;

        return $this;
    }

    public function setCookieSameSite(?string $cookieSameSite = null): self
    {
        $cookieSameSite = trim($cookieSameSite ?? '');

        if ('' === $cookieSameSite) {
            $cookieSameSite = null;
        }

        $this->cookieSameSite = $cookieSameSite;

        return $this;
    }

    public function setCookieSecret(?string $cookieSecret = null): self
    {
        if (null !== $cookieSecret && '' === trim($cookieSecret)) {
            $cookieSecret = null;
        }

        $this->cookieSecret = $cookieSecret;

        return $this;
    }

    public function setCookieSecure(bool $cookieSecure = false): self
    {
        $this->cookieSecure = $cookieSecure;

        return $this;
    }

    public function setCustomDomain(?string $customDomain = null): self
    {
        $customDomain = trim($customDomain ?? '');

        if ('' !== $customDomain) {
            $customDomain = $this->filterDomain($customDomain);

            if (null === $customDomain) {
                throw ConfigurationException::validationFailed('customDomain');
            }
        }

        if ('' === $customDomain) {
            $customDomain = null;
        }

        $this->customDomain = $customDomain;

        return $this;
    }

    public function setDomain(?string $domain = null): self
    {
        if (is_string($domain)) {
            $domain = $this->filterDomain($domain);

            if (null === $domain) {
                throw ConfigurationException::validationFailed('domain');
            }
        }

        $this->domain = $domain;

        return $this;
    }

    public function setEventListenerProvider(?ListenerProviderInterface $eventListenerProvider = null): self
    {
        $this->eventListenerProvider = $eventListenerProvider;

        return $this;
    }

    public function setHttpClient(?ClientInterface $httpClient = null): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function setHttpMaxRetries(int $httpMaxRetries = 3): self
    {
        if ($httpMaxRetries < 0) {
            throw ConfigurationException::validationFailed('httpMaxRetries');
        }

        $this->httpMaxRetries = $httpMaxRetries;

        return $this;
    }

    public function setHttpRequestFactory(?RequestFactoryInterface $httpRequestFactory = null): self
    {
        $this->httpRequestFactory = $httpRequestFactory;

        return $this;
    }

    public function setHttpResponseFactory(?ResponseFactoryInterface $httpResponseFactory = null): self
    {
        $this->httpResponseFactory = $httpResponseFactory;

        return $this;
    }

    public function setHttpStreamFactory(?StreamFactoryInterface $httpStreamFactory = null): self
    {
        $this->httpStreamFactory = $httpStreamFactory;

        return $this;
    }

    public function setHttpTelemetry(bool $httpTelemetry = true): self
    {
        $this->httpTelemetry = $httpTelemetry;

        return $this;
    }

    public function setManagementToken(?string $managementToken = null): self
    {
        $managementToken = trim($managementToken ?? '');

        if ('' === $managementToken) {
            $managementToken = null;
        }

        $this->managementToken = $managementToken;

        return $this;
    }

    public function setManagementTokenCache(?CacheItemPoolInterface $managementTokenCache = null): self
    {
        $this->managementTokenCache = $managementTokenCache;

        return $this;
    }

    /**
     * @param null|array<string> $organization An allowlist of organizations IDs/names.
     */
    public function setOrganization(?array $organization = null): self
    {
        $this->organization = $this->filterArray($organization);

        return $this;
    }

    public function setPersistAccessToken(bool $persistAccessToken = true): self
    {
        $this->persistAccessToken = $persistAccessToken;

        return $this;
    }

    public function setPersistIdToken(bool $persistIdToken = true): self
    {
        $this->persistIdToken = $persistIdToken;

        return $this;
    }

    public function setPersistRefreshToken(bool $persistRefreshToken = true): self
    {
        $this->persistRefreshToken = $persistRefreshToken;

        return $this;
    }

    public function setPersistUser(bool $persistUser = true): self
    {
        $this->persistUser = $persistUser;

        return $this;
    }

    public function setPushedAuthorizationRequest(bool $pushedAuthorizationRequest): void
    {
        $this->pushedAuthorizationRequest = $pushedAuthorizationRequest;
    }

    public function setQueryUserInfo(bool $queryUserInfo = false): self
    {
        $this->queryUserInfo = $queryUserInfo;

        return $this;
    }

    public function setRedirectUri(?string $redirectUri = null): self
    {
        $redirectUri = trim($redirectUri ?? '');

        if ('' === $redirectUri) {
            $redirectUri = null;
        }

        $this->redirectUri = $redirectUri;

        return $this;
    }

    public function setResponseMode(string $responseMode = 'query'): self
    {
        $responseMode = trim($responseMode);

        if ('' === $responseMode) {
            throw ConfigurationException::validationFailed('responseMode');
        }

        $this->responseMode = $responseMode;

        return $this;
    }

    public function setResponseType(string $responseType = 'code'): self
    {
        $responseType = trim($responseType);

        if ('' === $responseType) {
            throw ConfigurationException::validationFailed('responseType');
        }

        $this->responseType = $responseType;

        return $this;
    }

    /**
     * @param null|string[] $scope an array of scopes to request during authentication steps
     */
    public function setScope(?array $scope = ['openid', 'profile', 'email']): self
    {
        $scope = $this->filterArray($scope) ?? [];

        if ([] === $scope) {
            $scope = ['openid', 'profile', 'email'];
        }

        $this->scope = $scope;

        return $this;
    }

    public function setSessionStorage(?StoreInterface $sessionStorage = null): self
    {
        $this->sessionStorage = $sessionStorage;

        return $this;
    }

    public function setSessionStorageId(string $sessionStorageId = 'auth0_session'): self
    {
        $sessionStorageId = trim($sessionStorageId);

        if ('' === $sessionStorageId) {
            throw ConfigurationException::validationFailed('sessionStorageId');
        }

        $this->sessionStorageId = $sessionStorageId;

        return $this;
    }

    public function setStrategy(string $strategy = self::STRATEGY_REGULAR): self
    {
        if (! in_array($strategy, [self::STRATEGY_REGULAR, self::STRATEGY_API, self::STRATEGY_MANAGEMENT_API, self::STRATEGY_NONE], true)) {
            throw ConfigurationException::validationFailed('strategy');
        }

        $this->strategy = $strategy;

        return $this;
    }

    public function setTokenAlgorithm(string $tokenAlgorithm = Token::ALGO_RS256): self
    {
        if (! in_array($tokenAlgorithm, [Token::ALGO_RS256, Token::ALGO_HS256], true)) {
            throw ConfigurationException::invalidAlgorithm();
        }

        $this->tokenAlgorithm = $tokenAlgorithm;

        return $this;
    }

    public function setTokenCache(?CacheItemPoolInterface $tokenCache = null): self
    {
        $this->tokenCache = $tokenCache;

        return $this;
    }

    public function setTokenCacheTtl(int $tokenCacheTtl = 60): self
    {
        if ($tokenCacheTtl < 0) {
            throw ConfigurationException::validationFailed('tokenCacheTtl');
        }

        $this->tokenCacheTtl = $tokenCacheTtl;

        return $this;
    }

    public function setTokenJwksUri(?string $tokenJwksUri = null): self
    {
        $tokenJwksUri = trim($tokenJwksUri ?? '');

        if ('' === $tokenJwksUri) {
            $tokenJwksUri = null;
        }

        $this->tokenJwksUri = $tokenJwksUri;

        return $this;
    }

    public function setTokenLeeway(int $tokenLeeway = 60): self
    {
        if ($tokenLeeway < 0) {
            throw ConfigurationException::validationFailed('tokenLeeway');
        }

        $this->tokenLeeway = $tokenLeeway;

        return $this;
    }

    public function setTokenMaxAge(?int $tokenMaxAge = null): self
    {
        if (null !== $tokenMaxAge && $tokenMaxAge < 0) {
            throw ConfigurationException::validationFailed('tokenMaxAge');
        }

        $this->tokenMaxAge = $tokenMaxAge;

        return $this;
    }

    public function setTransientStorage(?StoreInterface $transientStorage = null): self
    {
        $this->transientStorage = $transientStorage;

        return $this;
    }

    public function setTransientStorageId(string $transientStorageId = 'auth0_transient'): self
    {
        $transientStorageId = trim($transientStorageId);

        if ('' === $transientStorageId) {
            throw ConfigurationException::validationFailed('transientStorageId');
        }

        $this->transientStorageId = $transientStorageId;

        return $this;
    }

    public function setUsePkce(bool $usePkce): self
    {
        $this->usePkce = $usePkce;

        return $this;
    }

    /**
     * Returns true when the configured `strategy` is 'stateful', meaning it requires an available and configured session.
     */
    public function usingStatefulness(): bool
    {
        return in_array($this->getStrategy(), self::STRATEGIES_USING_SESSIONS, true);
    }

    /**
     * @return array{strategy: string, domain: null, customDomain: null, clientId: null, redirectUri: null, clientSecret: null, audience: null, organization: null, usePkce: true, scope: string[], responseMode: string, responseType: string, tokenAlgorithm: string, tokenJwksUri: null, tokenMaxAge: null, tokenLeeway: int, tokenCache: null, tokenCacheTtl: int, httpClient: null, httpMaxRetries: int, httpRequestFactory: null, httpResponseFactory: null, httpStreamFactory: null, httpTelemetry: true, sessionStorage: null, sessionStorageId: string, cookieSecret: null, cookieDomain: null, cookieExpires: int, cookiePath: string, cookieSecure: false, cookieSameSite: null, persistUser: true, persistIdToken: true, persistAccessToken: true, persistRefreshToken: true, transientStorage: null, transientStorageId: string, queryUserInfo: false, managementToken: null, managementTokenCache: null, eventListenerProvider: null, clientAssertionSigningKey: null, clientAssertionSigningAlgorithm: string, pushedAuthorizationRequest: bool, backchannelLogoutCache: null}
     */
    private function getPropertyDefaults(): array
    {
        return [
            'strategy' => self::STRATEGY_REGULAR,
            'domain' => null,
            'customDomain' => null,
            'clientId' => null,
            'redirectUri' => null,
            'clientSecret' => null,
            'audience' => null,
            'organization' => null,
            'usePkce' => true,
            'scope' => ['openid', 'profile', 'email'],
            'responseMode' => 'query',
            'responseType' => 'code',
            'tokenAlgorithm' => Token::ALGO_RS256,
            'tokenJwksUri' => null,
            'tokenMaxAge' => null,
            'tokenLeeway' => 60,
            'tokenCache' => null,
            'tokenCacheTtl' => 60,
            'httpClient' => null,
            'httpMaxRetries' => 3,
            'httpRequestFactory' => null,
            'httpResponseFactory' => null,
            'httpStreamFactory' => null,
            'httpTelemetry' => true,
            'sessionStorage' => null,
            'sessionStorageId' => 'auth0_session',
            'cookieSecret' => null,
            'cookieDomain' => null,
            'cookieExpires' => 0,
            'cookiePath' => '/',
            'cookieSecure' => false,
            'cookieSameSite' => null,
            'persistUser' => true,
            'persistIdToken' => true,
            'persistAccessToken' => true,
            'persistRefreshToken' => true,
            'transientStorage' => null,
            'transientStorageId' => 'auth0_transient',
            'queryUserInfo' => false,
            'managementToken' => null,
            'managementTokenCache' => null,
            'eventListenerProvider' => null,
            'clientAssertionSigningKey' => null,
            'clientAssertionSigningAlgorithm' => Token::ALGO_RS256,
            'pushedAuthorizationRequest' => false,
            'backchannelLogoutCache' => null,
        ];
    }

    /**
     * @return array<callable>
     *
     * @psalm-suppress MissingClosureParamType
     */
    private function getPropertyValidators(): array
    {
        return [
            'strategy' => static fn ($value): bool => is_string($value),
            'domain' => static fn ($value): bool => is_string($value) || null === $value,
            'customDomain' => static fn ($value): bool => is_string($value) || null === $value,
            'clientId' => static fn ($value): bool => is_string($value) || null === $value,
            'redirectUri' => static fn ($value): bool => is_string($value) || null === $value,
            'clientSecret' => static fn ($value): bool => is_string($value) || null === $value,
            'audience' => static fn ($value): bool => is_array($value) || null === $value,
            'organization' => static fn ($value): bool => is_array($value) || null === $value,
            'usePkce' => static fn ($value): bool => is_bool($value),
            'scope' => static fn ($value): bool => is_array($value) || null === $value,
            'responseMode' => static fn ($value): bool => is_string($value),
            'responseType' => static fn ($value): bool => is_string($value),
            'tokenAlgorithm' => static fn ($value): bool => is_string($value),
            'tokenJwksUri' => static fn ($value): bool => is_string($value) || null === $value,
            'tokenMaxAge' => static fn ($value): bool => is_int($value) || null === $value,
            'tokenLeeway' => static fn ($value): bool => is_int($value),
            'tokenCache' => static fn ($value): bool => $value instanceof CacheItemPoolInterface || null === $value,
            'tokenCacheTtl' => static fn ($value): bool => is_int($value),
            'httpClient' => static fn ($value): bool => $value instanceof ClientInterface || null === $value,
            'httpMaxRetries' => static fn ($value): bool => is_int($value),
            'httpRequestFactory' => static fn ($value): bool => $value instanceof RequestFactoryInterface || null === $value,
            'httpResponseFactory' => static fn ($value): bool => $value instanceof ResponseFactoryInterface || null === $value,
            'httpStreamFactory' => static fn ($value): bool => $value instanceof StreamFactoryInterface || null === $value,
            'httpTelemetry' => static fn ($value): bool => is_bool($value),
            'sessionStorage' => static fn ($value): bool => $value instanceof StoreInterface || null === $value,
            'sessionStorageId' => static fn ($value): bool => is_string($value),
            'cookieSecret' => static fn ($value): bool => is_string($value) || null === $value,
            'cookieDomain' => static fn ($value): bool => is_string($value) || null === $value,
            'cookieExpires' => static fn ($value): bool => is_int($value),
            'cookiePath' => static fn ($value): bool => is_string($value),
            'cookieSecure' => static fn ($value): bool => is_bool($value),
            'cookieSameSite' => static fn ($value): bool => is_string($value) || null === $value,
            'persistUser' => static fn ($value): bool => is_bool($value),
            'persistIdToken' => static fn ($value): bool => is_bool($value),
            'persistAccessToken' => static fn ($value): bool => is_bool($value),
            'persistRefreshToken' => static fn ($value): bool => is_bool($value),
            'transientStorage' => static fn ($value): bool => $value instanceof StoreInterface || null === $value,
            'transientStorageId' => static fn ($value): bool => is_string($value),
            'queryUserInfo' => static fn ($value): bool => is_bool($value),
            'managementToken' => static fn ($value): bool => is_string($value) || null === $value,
            'managementTokenCache' => static fn ($value): bool => $value instanceof CacheItemPoolInterface || null === $value,
            'eventListenerProvider' => static fn ($value): bool => $value instanceof ListenerProviderInterface || null === $value,
            'clientAssertionSigningKey' => static fn ($value): bool => $value instanceof OpenSSLAsymmetricKey || is_string($value) || null === $value,
            'clientAssertionSigningAlgorithm' => static fn ($value): bool => is_string($value),
            'pushedAuthorizationRequest' => static fn ($value): bool => is_bool($value),
            'backchannelLogoutCache' => static fn ($value): bool => $value instanceof CacheItemPoolInterface || null === $value,
        ];
    }

    /**
     * Setup SDK factories.
     *
     * @codeCoverageIgnore
     */
    private function setupStateFactories(): void
    {
        $responseFactory = $this->getHttpResponseFactory() ?? Discover::httpResponseFactory();
        $requestFactory = $this->getHttpRequestFactory() ?? Discover::httpRequestFactory();
        $streamFactory = $this->getHttpStreamFactory() ?? Discover::httpStreamFactory();
        $httpClient = $this->getHttpClient() ?? Discover::httpClient();

        Assert::isInstanceOf($requestFactory, RequestFactoryInterface::class, 'Could not find a PSR-17 compatible request factory. Please install one, or provide one using the `setHttpRequestFactory()` method.');
        Assert::isInstanceOf($responseFactory, ResponseFactoryInterface::class, 'Could not find a PSR-17 compatible response factory. Please install one, or provide one using the `setHttpResponseFactory()` method.');
        Assert::isInstanceOf($streamFactory, StreamFactoryInterface::class, 'Could not find a PSR-17 compatible stream factory. Please install one, or provide one using the `setHttpStreamFactory()` method.');
        Assert::isInstanceOf($httpClient, ClientInterface::class, 'Could not find a PSR-18 compatible HTTP client. Please install one, or provide one using the `setHttpClient()` method.');

        if (! $this->hasHttpClient()) {
            $this->setHttpClient($httpClient);
        }
        if (! $this->hasHttpRequestFactory()) {
            $this->setHttpRequestFactory($requestFactory);
        }
        if (! $this->hasHttpResponseFactory()) {
            $this->setHttpResponseFactory($responseFactory);
        }
        if (! $this->hasHttpStreamFactory()) {
            $this->setHttpStreamFactory($streamFactory);
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
     *
     * @param ?string $strategy
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
            throw ConfigurationException::requiresDomain();
        }

        if (! $this->hasAudience()) {
            throw ConfigurationException::requiresAudience();
        }
    }

    /**
     * Run validations for a Management-only usage configuration.
     */
    private function validateStateManagement(): void
    {
        if (! $this->hasDomain()) {
            throw ConfigurationException::requiresDomain();
        }

        if (! $this->hasManagementToken()) {
            if (! $this->hasClientId()) {
                throw ConfigurationException::requiresClientId();
            }

            if (! $this->hasClientSecret() && ! $this->hasClientAssertionSigningKey()) {
                throw ConfigurationException::requiresClientSecret();
            }
        }
    }

    /**
     * Run validations for a general webapp usage configuration.
     */
    private function validateStateWebApp(): void
    {
        if (! $this->hasDomain()) {
            throw ConfigurationException::requiresDomain();
        }

        if (! $this->hasClientId()) {
            throw ConfigurationException::requiresClientId();
        }

        if ('HS256' === $this->getTokenAlgorithm() && ! $this->hasClientSecret()) {
            throw ConfigurationException::requiresClientSecret();
        }

        if (! $this->hasCookieSecret()) {
            throw ConfigurationException::requiresCookieSecret();
        }
    }
}
