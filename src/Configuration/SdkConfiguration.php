<?php

declare(strict_types=1);

namespace Auth0\SDK\Configuration;

use Auth0\SDK\Contract\ConfigurableContract;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Mixins\ConfigurableMixin;
use Auth0\SDK\Store\CookieStore;
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
 * Configuration container for use with Auth0\SDK
 *
 * @method SdkConfiguration setAudience(?array $audience = null)
 * @method SdkConfiguration setCookieDomain(?string $cookieDomain = null)
 * @method SdkConfiguration setCookieExpires(int $cookieExpires = 0)
 * @method SdkConfiguration setCookiePath(string $cookiePath = '/')
 * @method SdkConfiguration setCookieSecret(?string $cookieSecret)
 * @method SdkConfiguration setCookieSecure(bool $cookieSecure = false)
 * @method SdkConfiguration setClientId(?string $clientId = null)
 * @method SdkConfiguration setClientSecret(?string $clientSecret = null)
 * @method SdkConfiguration setDomain(?string $domain = null)
 * @method SdkConfiguration setCustomDomain(?string $customDomain = null)
 * @method SdkConfiguration setEventListenerProvider(?ListenerProviderInterface $eventListenerProvider = null)
 * @method SdkConfiguration setHttpClient(?ClientInterface $httpClient = null)
 * @method SdkConfiguration setHttpMaxRetries(int $httpMaxRetires = 3)
 * @method SdkConfiguration setHttpRequestFactory(?RequestFactoryInterface $httpRequestFactory = null)
 * @method SdkConfiguration setHttpResponseFactory(?ResponseFactoryInterface $httpResponseFactory = null)
 * @method SdkConfiguration setHttpStreamFactory(?StreamFactoryInterface $httpStreamFactory = null)
 * @method SdkConfiguration setHttpTelemetry(bool $httpTelemetry = true)
 * @method SdkConfiguration setManagementToken(?string $managementToken = null)
 * @method SdkConfiguration setManagementTokenCache(?CacheItemPoolInterface $cache = null)
 * @method SdkConfiguration setOrganization(?array $organization = null)
 * @method SdkConfiguration setPersistAccessToken(bool $persistAccessToken = true)
 * @method SdkConfiguration setPersistIdToken(bool $persistIdToken = true)
 * @method SdkConfiguration setPersistRefreshToken(bool $persistRefreshToken = true)
 * @method SdkConfiguration setPersistUser(bool $persistUser = true)
 * @method SdkConfiguration setQueryUserInfo(bool $queryUserInfo = false)
 * @method SdkConfiguration setRedirectUri(?string $redirectUri = null)
 * @method SdkConfiguration setResponseMode(string $responseMode = 'query')
 * @method SdkConfiguration setResponseType(string $responseType = 'code')
 * @method SdkConfiguration setScope(?array $scope = null)
 * @method SdkConfiguration setSessionStorage(?StoreInterface $sessionStorage = null)
 * @method SdkConfiguration setSessionStorageId(string $sessionStorageId = 'auth0_session')
 * @method SdkConfiguration setStrategy(string $strategy = 'webapp')
 * @method SdkConfiguration setTokenAlgorithm(string $tokenAlgorithm = 'RS256')
 * @method SdkConfiguration setTokenCache(?CacheItemPoolInterface $cache = null)
 * @method SdkConfiguration setTokenCacheTtl(int $tokenCacheTtl = 60)
 * @method SdkConfiguration setTokenJwksUri(?string $tokenJwksUri = null)
 * @method SdkConfiguration setTokenLeeway(int $tokenLeeway = 60)
 * @method SdkConfiguration setTokenMaxAge(?int $tokenMaxAge = null)
 * @method SdkConfiguration setTransientStorage(?StoreInterface $transientStorage = null)
 * @method SdkConfiguration setTransientStorageId(string $transientStorageId = 'auth0_transient')
 * @method SdkConfiguration setUsePkce(bool $usePkce)
 *
 * @method array<string>|null getAudience(?\Throwable $exceptionIfNull = null)
 * @method string|null getCookieDomain(?\Throwable $exceptionIfNull = null)
 * @method int getCookieExpires()
 * @method string getCookiePath()
 * @method string|null getCookieSecret(?\Throwable $exceptionIfNull = null)
 * @method bool getCookieSecure()
 * @method string|null getClientId(?\Throwable $exceptionIfNull = null)
 * @method string|null getClientSecret(?\Throwable $exceptionIfNull = null)
 * @method string|string getDomain(?\Throwable $exceptionIfNull = null)
 * @method string|string getCustomDomain(?\Throwable $exceptionIfNull = null)
 * @method ListenerProviderInterface|null getEventListenerProvider(?\Throwable $exceptionIfNull = null)
 * @method ClientInterface|null getHttpClient(?\Throwable $exceptionIfNull = null)
 * @method int getHttpMaxRetries()
 * @method RequestFactoryInterface|null getHttpRequestFactory(?\Throwable $exceptionIfNull = null)
 * @method ResponseFactoryInterface|null getHttpResponseFactory(?\Throwable $exceptionIfNull = null)
 * @method StreamFactoryInterface|null getHttpStreamFactory(?\Throwable $exceptionIfNull = null)
 * @method bool getHttpTelemetry()
 * @method string|null getManagementToken(?\Throwable $exceptionIfNull = null)
 * @method CacheItemPoolInterface|null getManagementTokenCache(?\Throwable $exceptionIfNull = null)
 * @method array<string>|null getOrganization(?\Throwable $exceptionIfNull = null)
 * @method bool getPersistAccessToken()
 * @method bool getPersistIdToken()
 * @method bool getPersistRefreshToken()
 * @method bool getPersistUser()
 * @method bool getQueryUserInfo()
 * @method string|null getRedirectUri(?\Throwable $exceptionIfNull = null)
 * @method string getResponseMode()
 * @method string getResponseType()
 * @method array<string> getScope()
 * @method StoreInterface|null getSessionStorage(?\Throwable $exceptionIfNull = null)
 * @method string getSessionStorageId()
 * @method string getStrategy()
 * @method string getTokenAlgorithm()
 * @method CacheItemPoolInterface|null getTokenCache(?\Throwable $exceptionIfNull = null)
 * @method int getTokenCacheTtl()
 * @method string|null getTokenJwksUri(?\Throwable $exceptionIfNull = null)
 * @method int|null getTokenLeeway(?\Throwable $exceptionIfNull = null)
 * @method int|null getTokenMaxAge(?\Throwable $exceptionIfNull = null)
 * @method StoreInterface|null getTransientStorage(?\Throwable $exceptionIfNull = null)
 * @method string getTransientStorageId()
 * @method bool getUsePkce()
 *
 * @method bool hasAudience()
 * @method bool hasCookieDomain()
 * @method bool hasCookieExpires()
 * @method bool hasCookiePath()
 * @method bool hasCookieSecret()
 * @method bool hasCookieSecure()
 * @method bool hasClientId()
 * @method bool hasClientSecret()
 * @method bool hasDomain()
 * @method bool hasCustomDomain()
 * @method bool hasEventListenerProvider()
 * @method bool hasHttpClient()
 * @method bool hasHttpMaxRetries()
 * @method bool hasHttpRequestFactory()
 * @method bool hasHttpResponseFactory()
 * @method bool hasHttpStreamFactory()
 * @method bool hasHttpTelemetry()
 * @method bool hasManagementToken()
 * @method bool hasManagementTokenCache()
 * @method bool hasOrganization()
 * @method bool hasPersistAccessToken()
 * @method bool hasPersistIdToken()
 * @method bool hasPersistRefreshToken()
 * @method bool hasPersistUser()
 * @method bool hasQueryUserInfo()
 * @method bool hasRedirectUri()
 * @method bool hasResponseMode()
 * @method bool hasResponseType()
 * @method bool hasScope()
 * @method bool hasSessionStorage()
 * @method bool hasSessionStorageId()
 * @method bool hasStrategy()
 * @method bool hasTokenAlgorithm()
 * @method bool hasTokenCache()
 * @method bool hasTokenCacheTtl()
 * @method bool hasTokenLeeway()
 * @method bool hasTokenMaxAge()
 * @method bool hasTransientStorage()
 * @method bool hasTransientStorageId()
 * @method bool hasUsePkce()
 *
 * @method bool pushScope($scope)
 * @method bool pushAudience($audience)
 * @method bool pushOrganization($organization)
 */
final class SdkConfiguration implements ConfigurableContract
{
    use ConfigurableMixin;

    /**
     * An instance of the EventDispatcher utility.
     */
    private ?EventDispatcher $eventDispatcher = null;

    /**
     * SdkConfiguration Constructor
     *
     * @param array<mixed>|null              $configuration         An key-value array matching this constructor's arguments. Overrides any other passed arguments with the same key name.
     * @param string|null                    $strategy              Defaults to 'webapp'. Should be assigned either 'api', 'management', or 'webapp' to specify the type of application the SDK is being applied to. Determines what configuration options will be required at initialization.
     * @param string|null                    $domain                Auth0 domain for your tenant, found in your Auth0 Application settings.
     * @param string|null                    $customDomain          If you have configured Auth0 to use a custom domain, configure it here.
     * @param string|null                    $clientId              Client ID, found in the Auth0 Application settings.
     * @param string|null                    $redirectUri           Authentication callback URI, as defined in your Auth0 Application settings.
     * @param string|null                    $clientSecret          Client Secret, found in the Auth0 Application settings.
     * @param array<string>|null             $audience              One or more API identifiers, found in your Auth0 API settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'aud' claim to validate an ID Token successfully.
     * @param array<string>|null             $organization          One or more Organization IDs, found in your Auth0 Organization settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'org_id' claim to validate an ID Token successfully.
     * @param bool                           $usePkce               Defaults to true. Use PKCE (Proof Key of Code Exchange) with Authorization Code Flow requests. See https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce
     * @param array<string>                  $scope                 One or more scopes to request for Tokens. See https://auth0.com/docs/scopes
     * @param string                         $responseMode          Defaults to 'query.' Where to extract request parameters from, either 'query' for GET or 'form_post' for POST requests.
     * @param string                         $responseType          Defaults to 'code.' Use 'code' for server-side flows and 'token' for application side flow.
     * @param string                         $tokenAlgorithm        Defaults to 'RS256'. Algorithm to use for Token verification. Expects either 'RS256' or 'HS256'.
     * @param string|null                    $tokenJwksUri          URI to the JWKS when verifying RS256 tokens.
     * @param int|null                       $tokenMaxAge           The maximum window of time (in seconds) since the 'auth_time' to accept during Token validation.
     * @param int                            $tokenLeeway           Defaults to 60. Leeway (in seconds) to allow during time calculations with Token validation.
     * @param CacheItemPoolInterface|null    $tokenCache            A PSR-6 compatible cache adapter for storing JSON Web Key Sets (JWKS).
     * @param int                            $tokenCacheTtl         How long (in seconds) to keep a JWKS cached.
     * @param ClientInterface|null           $httpClient            A PSR-18 compatible HTTP client to use for API requests.
     * @param int                            $httpMaxRetries        When a rate-limit (429 status code) response is returned from the Auth0 API, automatically retry the request up to this many times.
     * @param RequestFactoryInterface|null   $httpRequestFactory    A PSR-17 compatible request factory to generate HTTP requests.
     * @param ResponseFactoryInterface|null  $httpResponseFactory   A PSR-17 compatible response factory to generate HTTP responses.
     * @param StreamFactoryInterface|null    $httpStreamFactory     A PSR-17 compatible stream factory to create request body streams.
     * @param bool                           $httpTelemetry         Defaults to true. If true, API requests will include telemetry about the SDK and PHP runtime version to help us improve our services.
     * @param StoreInterface|null            $sessionStorage        Defaults to use cookies. A StoreInterface-compatible class for storing Token state.
     * @param string                         $sessionStorageId      Defaults to 'auth0_session'. The namespace to prefix session items under.
     * @param string|null                    $cookieSecret          The secret used to derive an encryption key for the user identity in a session cookie and to sign the transient cookies used by the login callback.
     * @param string|null                    $cookieDomain          Defaults to value of HTTP_HOST server environment information. Cookie domain, for example 'www.example.com', for use with PHP sessions and SDK cookies. To make cookies visible on all subdomains then the domain must be prefixed with a dot like '.example.com'.
     * @param int                            $cookieExpires         Defaults to 0. How long, in seconds, before cookies expire. If set to 0 the cookie will expire at the end of the session (when the browser closes).
     * @param string                         $cookiePath            Defaults to '/'. Specifies path on the domain where the cookies will work. Use a single slash ('/') for all paths on the domain.
     * @param bool                           $cookieSecure          Defaults to false. Specifies whether cookies should ONLY be sent over secure connections.
     * @param bool                           $persistUser           Defaults to true. If true, the user data will persist in session storage.
     * @param bool                           $persistIdToken        Defaults to true. If true, the Id Token will persist in session storage.
     * @param bool                           $persistAccessToken    Defaults to true. If true, the Access Token will persist in session storage.
     * @param bool                           $persistRefreshToken   Defaults to true. If true, the Refresh Token will persist in session storage.
     * @param StoreInterface|null            $transientStorage      Defaults to use cookies. A StoreInterface-compatible class for storing ephemeral state data, such as nonces.
     * @param string                         $transientStorageId    Defaults to 'auth0_transient'. The namespace to prefix transient items under.
     * @param bool                           $queryUserInfo         Defaults to false. If true, query the /userinfo endpoint during an authorization code exchange.
     * @param string|null                    $managementToken       An Access Token to use for Management API calls. If there isn't one specified, the SDK will attempt to get one for you using your $clientSecret.
     * @param CacheItemPoolInterface|null    $managementTokenCache  A PSR-6 compatible cache adapter for storing generated management access tokens.
     * @param ListenerProviderInterface|null $eventListenerProvider A PSR-14 compatible event listener provider, for interfacing with events triggered by the SDK.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException When a valid `$strategy` is not specified.
     */
    public function __construct(
        ?array $configuration = null,
        ?string $strategy = 'webapp',
        ?string $domain = null,
        ?string $customDomain = null,
        ?string $clientId = null,
        ?string $redirectUri = null,
        ?string $clientSecret = null,
        ?array $audience = null,
        ?array $organization = null,
        bool $usePkce = true,
        array $scope = ['openid', 'profile', 'email'],
        string $responseMode = 'query',
        string $responseType = 'code',
        string $tokenAlgorithm = 'RS256',
        ?string $tokenJwksUri = null,
        ?int $tokenMaxAge = null,
        int $tokenLeeway = 60,
        ?CacheItemPoolInterface $tokenCache = null,
        int $tokenCacheTtl = 60,
        ?ClientInterface $httpClient = null,
        int $httpMaxRetries = 3,
        ?RequestFactoryInterface $httpRequestFactory = null,
        ?ResponseFactoryInterface $httpResponseFactory = null,
        ?StreamFactoryInterface $httpStreamFactory = null,
        bool $httpTelemetry = true,
        ?StoreInterface $sessionStorage = null,
        string $sessionStorageId = 'auth0_session',
        ?string $cookieSecret = null,
        ?string $cookieDomain = null,
        int $cookieExpires = 0,
        string $cookiePath = '/',
        bool $cookieSecure = false,
        bool $persistUser = true,
        bool $persistIdToken = true,
        bool $persistAccessToken = true,
        bool $persistRefreshToken = true,
        ?StoreInterface $transientStorage = null,
        string $transientStorageId = 'auth0_transient',
        bool $queryUserInfo = false,
        ?string $managementToken = null,
        ?CacheItemPoolInterface $managementTokenCache = null,
        ?ListenerProviderInterface $eventListenerProvider = null
    ) {
        $this->setState(func_get_args());

        $this->setupStateCookies();
        $this->setupStateFactories();
        $this->setupStateStorage();

        $this->validateState();
    }

    /**
     * Return the configured custom or tenant domain, formatted with protocol.
     *
     * @param bool $forceTenantDomain Force the return of the tenant domain even if a custom domain is configured.
     */
    public function formatDomain(
        bool $forceTenantDomain = false
    ): string {
        if ($this->hasCustomDomain() && ! $forceTenantDomain) {
            return 'https://' . $this->getCustomDomain();
        }

        return 'https://' . $this->getDomain();
    }

    /**
     * Return the configured domain with protocol.
     */
    public function formatCustomDomain(): ?string
    {
        if ($this->hasCustomDomain()) {
            return 'https://' . $this->getCustomDomain();
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

            if (count($scope) !== 0) {
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

            if ($organization !== null && count($organization) !== 0) {
                return $organization[0];
            }
        }

        return null;
    }

    /**
     * Get the first configured audience.
     */
    public function defaultAudience(): ?string
    {
        // Return the default audience.
        if ($this->hasAudience()) {
            $audience = $this->getAudience();

            if ($audience !== null && count($audience) !== 0) {
                return $audience[0] ?? '';
            }
        }

        return null;
    }

    /**
     * Get an instance of the EventDispatcher.
     */
    public function eventDispatcher(): EventDispatcher
    {
        if ($this->eventDispatcher === null) {
            $this->eventDispatcher = new EventDispatcher($this);
        }

        return $this->eventDispatcher;
    }

    /**
     * Setup SDK cookie state.
     */
    private function setupStateCookies(): void
    {
        if (! $this->hasCookieDomain()) {
            $domain = $_SERVER['HTTP_HOST'] ?? $this->getRedirectUri();

            if ($domain !== null) {
                $parsed = parse_url($domain, PHP_URL_HOST);

                if (is_string($parsed)) {
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
     * @throws NotFoundException When a PSR-18 or PSR-17 are not configured, and cannot be discovered.
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
     * Fires when the configuration state changes, to ensure changes are formatted correctly.
     *
     * @param string $propertyName The property being mutated.
     * @param mixed  $propertyValue The new value of the property.
     *
     * @return mixed
     *
     * @throws ConfigurationException When a validation check for the mutation fails to pass, such as a incompatible type being used.
     */
    private function onStateChange(
        string $propertyName,
        $propertyValue
    ) {
        if ($propertyValue === null) {
            return $propertyValue;
        }

        if ($propertyName === 'strategy') {
            if (is_string($propertyValue) && mb_strlen($propertyValue) !== 0) {
                $propertyValue = mb_strtolower($propertyValue);

                if (in_array($propertyValue, ['api', 'management', 'webapp', 'none'], true)) {
                    return $propertyValue;
                }
            }

            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed($propertyName);
        }

        if ($propertyName === 'domain') {
            if (is_string($propertyValue) && mb_strlen($propertyValue) !== 0) {
                $host = parse_url($propertyValue, PHP_URL_HOST);
                return $host ?? $propertyValue;
            }

            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed($propertyName);
        }

        if ($propertyName === 'tokenAlgorithm' && ! in_array($propertyValue, ['HS256', 'RS256'], true)) {
            throw \Auth0\SDK\Exception\ConfigurationException::invalidAlgorithm();
        }

        if (in_array($propertyName, ['organization', 'audience'], true)) {
            if (is_array($propertyValue) && count($propertyValue) !== 0) {
                return $propertyValue;
            }

            return null;
        }

        return $propertyValue;
    }

    /**
     * Setup SDK validators based on strategy type.
     */
    private function validateState(
        ?string $strategy = null
    ): void {
        $strategy = $strategy ?? $this->getStrategy();

        if ($strategy === 'api') {
            $this->validateStateApi();
        }

        if ($strategy === 'management') {
            $this->validateStateManagement();
        }

        if ($strategy === 'webapp') {
            $this->validateStateWebApp();
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

        if ($this->getTokenAlgorithm() === 'HS256' && ! $this->hasClientSecret()) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresClientSecret();
        }
    }
}
