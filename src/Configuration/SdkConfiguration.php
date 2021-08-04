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
 * @method SdkConfiguration setTokenAlgorithm(string $tokenAlgorithm = 'RS256')
 * @method SdkConfiguration setTokenCache(?CacheItemPoolInterface $cache = null)
 * @method SdkConfiguration setTokenCacheTtl(int $tokenCacheTtl = 60)
 * @method SdkConfiguration setTokenJwksUri(?string $tokenJwksUri = null)
 * @method SdkConfiguration setTokenLeeway(int $tokenLeeway = 60)
 * @method SdkConfiguration setTokenMaxAge(?int $tokenMaxAge = null)
 * @method SdkConfiguration setTransientStorage(?StoreInterface $transientStorage = null)
 * @method SdkConfiguration setUsePkce(bool $usePkce)
 *
 * @method array<string>|null getAudience()
 * @method string|null getCookieDomain()
 * @method int getCookieExpires()
 * @method string getCookiePath()
 * @method string|null getCookieSecret()
 * @method bool getCookieSecure()
 * @method string getClientId()
 * @method string|null getClientSecret()
 * @method string getDomain()
 * @method ListenerProviderInterface|null getEventListenerProvider()
 * @method ClientInterface|null getHttpClient()
 * @method int getHttpMaxRetries()
 * @method RequestFactoryInterface|null getHttpRequestFactory()
 * @method ResponseFactoryInterface|null getHttpResponseFactory()
 * @method StreamFactoryInterface|null getHttpStreamFactory()
 * @method bool getHttpTelemetry()
 * @method string|null getManagementToken()
 * @method CacheItemPoolInterface|null getManagementTokenCache()
 * @method array<string>|null getOrganization()
 * @method bool getPersistAccessToken()
 * @method bool getPersistIdToken()
 * @method bool getPersistRefreshToken()
 * @method bool getPersistUser()
 * @method bool getQueryUserInfo()
 * @method string|null getRedirectUri()
 * @method string getResponseMode()
 * @method string getResponseType()
 * @method array<string> getScope()
 * @method StoreInterface|null getSessionStorage()
 * @method string getTokenAlgorithm()
 * @method CacheItemPoolInterface|null getTokenCache()
 * @method int getTokenCacheTtl()
 * @method string|null getTokenJwksUri()
 * @method int|null getTokenLeeway()
 * @method int|null getTokenMaxAge()
 * @method StoreInterface|null getTransientStorage()
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
 * @method bool hasTokenAlgorithm()
 * @method bool hasTokenCache()
 * @method bool hasTokenCacheTtl()
 * @method bool hasTokenLeeway()
 * @method bool hasTokenMaxAge()
 * @method bool hasTransientStorage()
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
     * @param array<mixed>|null              $configuration         Optional. An key-value array matching this constructor's arguments. Overrides any passed arguments with the same key name.
     * @param string|null                    $domain                Required. Auth0 domain for your tenant.
     * @param string|null                    $clientId              Required. Client ID, found in the Auth0 Application settings.
     * @param string|null                    $redirectUri           Optional. Authentication callback URI, as defined in your Auth0 Application settings.
     * @param string|null                    $clientSecret          Optional. Client Secret, found in the Auth0 Application settings.
     * @param array<string>|null             $audience              Optional. One or more API identifiers, found in your Auth0 API settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'aud' claim to validate an ID Token successfully.
     * @param array<string>|null             $organization          Optional. One or more Organization IDs, found in your Auth0 Organization settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'org_id' claim to validate an ID Token successfully.
     * @param bool                           $usePkce               Optional. Defaults to true. Use PKCE (Proof Key of Code Exchange) with Authorization Code Flow requests. See https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce
     * @param array<string>                  $scope                 Optional. One or more scopes to request for Tokens. See https://auth0.com/docs/scopes
     * @param string                         $responseMode          Optional. Defaults to 'query.' Where to extract request parameters from, either 'query' for GET or 'form_post' for POST requests.
     * @param string                         $responseType          Optional. Defaults to 'code.' Use 'code' for server-side flows and 'token' for application side flow.
     * @param string                         $tokenAlgorithm        Optional. Defaults to 'RS256'. Algorithm to use for Token verification. Expects either 'RS256' or 'HS256'.
     * @param string|null                    $tokenJwksUri          Optional. URI to the JWKS when verifying RS256 tokens.
     * @param int|null                       $tokenMaxAge           Optional. The maximum window of time (in seconds) since the 'auth_time' to accept during Token validation.
     * @param int                            $tokenLeeway           Optional. Defaults to 60. Leeway (in seconds) to allow during time calculations with Token validation.
     * @param CacheItemPoolInterface|null    $tokenCache            Optional. A PSR-6 compatible cache adapter for storing JSON Web Key Sets (JWKS).
     * @param int                            $tokenCacheTtl         Optional. How long (in seconds) to keep a JWKS cached.
     * @param ClientInterface|null           $httpClient            Optional. A PSR-18 compatible HTTP client to use for API requests.
     * @param int                            $httpMaxRetries        Optional. When a rate-limit (429 status code) response is returned from the Auth0 API, automatically retry the request up to this many times.
     * @param RequestFactoryInterface|null   $httpRequestFactory    Optional. A PSR-17 compatible request factory to generate HTTP requests.
     * @param ResponseFactoryInterface|null  $httpResponseFactory   Optional. A PSR-17 compatible response factory to generate HTTP responses.
     * @param StreamFactoryInterface|null    $httpStreamFactory     Optional. A PSR-17 compatible stream factory to create request body streams.
     * @param bool                           $httpTelemetry         Optional. Defaults to true. If true, API requests will include telemetry about the SDK and PHP runtime version to help us improve our services.
     * @param StoreInterface|null            $sessionStorage        Optional. Defaults to use cookies. A StoreInterface-compatible class for storing Token state.
     * @param string|null                    $cookieSecret          Optional. The secret used to derive an encryption key for the user identity in a session cookie and to sign the transient cookies used by the login callback.
     * @param string|null                    $cookieDomain          Optional. Defaults to value of HTTP_HOST server environment information. Cookie domain, for example 'www.example.com', for use with PHP sessions and SDK cookies. To make cookies visible on all subdomains then the domain must be prefixed with a dot like '.example.com'.
     * @param int                            $cookieExpires         Optional. Defaults to 0. How long, in seconds, before cookies expire. If set to 0 the cookie will expire at the end of the session (when the browser closes).
     * @param string                         $cookiePath            Optional. Defaults to '/'. Specifies path on the domain where the cookies will work. Use a single slash ('/') for all paths on the domain.
     * @param bool                           $cookieSecure          Optional. Defaults to false. Specifies whether cookies should ONLY be sent over secure connections.
     * @param bool                           $persistUser           Optional. Defaults to true. If true, the user data will persist in session storage.
     * @param bool                           $persistIdToken        Optional. Defaults to true. If true, the Id Token will persist in session storage.
     * @param bool                           $persistAccessToken    Optional. Defaults to true. If true, the Access Token will persist in session storage.
     * @param bool                           $persistRefreshToken   Optional. Defaults to true. If true, the Refresh Token will persist in session storage.
     * @param StoreInterface|null            $transientStorage      Optional. Defaults to use cookies. A StoreInterface-compatible class for storing ephemeral state data, such as nonces.
     * @param bool                           $queryUserInfo         Optional. Defaults to false. If true, query the /userinfo endpoint during an authorization code exchange.
     * @param string|null                    $managementToken       Optional. An Access Token to use for Management API calls. If there isn't one specified, the SDK will attempt to get one for you using your $clientSecret.
     * @param CacheItemPoolInterface|null    $managementTokenCache  Optional. A PSR-6 compatible cache adapter for storing generated management access tokens.
     * @param ListenerProviderInterface|null $eventListenerProvider Optional. A PSR-14 compatible event listener provider, for interfacing with events triggered by the SDK.
     */
    public function __construct(
        ?array $configuration = null,
        ?string $domain = null,
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
        bool $queryUserInfo = false,
        ?string $managementToken = null,
        ?CacheItemPoolInterface $managementTokenCache = null,
        ?ListenerProviderInterface $eventListenerProvider = null
    ) {
        $this->setState(func_get_args());

        $this->setValidations([
            'getDomain',
            'getClientId',
        ]);

        $this->setupConfiguration();
        $this->validate();
    }

    /**
     * Return the configured domain with protocol.
     */
    public function buildDomainUri(): string
    {
        return 'https://' . $this->getDomain();
    }

    /**
     * Return the configured scopes as a space-delimited string.
     */
    public function buildScopeString(): ?string
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
    public function buildDefaultOrganization(): ?string
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
    public function buildDefaultAudience(): ?string
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
    public function getEventDispatcher(): EventDispatcher
    {
        if ($this->eventDispatcher === null) {
            $this->eventDispatcher = new EventDispatcher($this);
        }

        return $this->eventDispatcher;
    }

    /**
     * Setup SDK defaults based on the configured state.
     *
     * @throws NotFoundException When a PSR-18 or PSR-17 are not configured, and cannot be discovered.
     */
    private function setupConfiguration(): void
    {
        if (! $this->getSessionStorage() instanceof StoreInterface) {
            $this->setSessionStorage(new CookieStore($this));
        }

        if (! $this->getTransientStorage() instanceof StoreInterface) {
            $this->setTransientStorage(new CookieStore($this));
        }

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

        if ($propertyName === 'tokenMaxAge' || $propertyName === 'tokenLeeway') {
            if (is_int($propertyValue)) {
                // Value was passed as an int, perfect.
                return $propertyValue;
            }

            if (is_numeric($propertyValue)) {
                // Value was passed as a string, but it is numeric so cast to int.
                return (int) $propertyValue;
            }

            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed($propertyName);
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
     * Fires when a validation event fails to pass, such as a bad parameter type being used.
     *
     * @param string      $parameter The name of the parameter that failed validation.
     *
     * @throws ConfigurationException When invoked.
     */
    private function onValidationException(
        string $parameter
    ): void {
        throw \Auth0\SDK\Exception\ConfigurationException::validationFailed($parameter);
    }
}
