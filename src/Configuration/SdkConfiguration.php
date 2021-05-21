<?php

declare(strict_types=1);

namespace Auth0\SDK\Configuration;

use Auth0\SDK\Contract\ConfigurableContract;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Mixins\ConfigurableMixin;
use Auth0\SDK\Store\CookieStore;
use Auth0\SDK\Store\SessionStore;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * Configuration container for use with Auth0\SDK
 *
 * @method public ConfigurationInterface setAudience(?array $audience = null)
 * @method public ConfigurationInterface setClientId(?string $clientId = null)
 * @method public ConfigurationInterface setClientSecret(?string $clientSecret = null)
 * @method public ConfigurationInterface setDomain(?string $domain = null)
 * @method public ConfigurationInterface setHttpClient(?ClientInterface $httpClient = null)
 * @method public ConfigurationInterface setHttpRequestFactory(?RequestFactoryInterface $httpRequestFactory = null)
 * @method public ConfigurationInterface setHttpResponseFactory(?ResponseFactoryInterface $httpResponseFactory = null)
 * @method public ConfigurationInterface setHttpStreamFactory(?StreamFactoryInterface $httpStreamFactory = null)
 * @method public ConfigurationInterface setHttpTelemetry(bool $httpTelemetry = true)
 * @method public ConfigurationInterface setManagementToken(?string $managementToken = null)
 * @method public ConfigurationInterface setOrganization(?array $organization = null)
 * @method public ConfigurationInterface setQueryUserInfo(bool $queryUserInfo = false)
 * @method public ConfigurationInterface setRedirectUri(?string $redirectUri = null)
 * @method public ConfigurationInterface setResponseMode(string $responseMode = 'query')
 * @method public ConfigurationInterface setResponseType(string $responseType = 'code')
 * @method public ConfigurationInterface setSessionStorage(?StoreInterface $sessionStorage = null)
 * @method public ConfigurationInterface setScope(?array $scope = null)
 * @method public ConfigurationInterface setTokenAlgorithm(string $tokenAlgorithm = 'RS256')
 * @method public ConfigurationInterface setTokenCache(?CacheItemInterface $cache = null)
 * @method public ConfigurationInterface setTokenCacheTtl(int $tokenCacheTtl = 60)
 * @method public ConfigurationInterface setTokenJwksUri(?string $tokenJwksUri = null)
 * @method public ConfigurationInterface setTokenLeeway(int $tokenLeeway = 60)
 * @method public ConfigurationInterface setTokenMaxAge(?int $tokenMaxAge = null)
 * @method public ConfigurationInterface setPersistAccessToken(bool $persistAccessToken = true)
 * @method public ConfigurationInterface setPersistIdToken(bool $persistIdToken = true)
 * @method public ConfigurationInterface setPersistRefreshToken(bool $persistRefreshToken = true)
 * @method public ConfigurationInterface setPersistUser(bool $persistUser = true)
 * @method public ConfigurationInterface setTransientStorage(?StoreInterface $transientStorage = null)
 * @method public ConfigurationInterface setUsePkce(bool $usePkce)
 *
 * @method public array|null getAudience()
 * @method public string|null getClientId()
 * @method public string|null getClientSecret()
 * @method public string|null getDomain()
 * @method public ClientInterface|null getHttpClient()
 * @method public RequestFactoryInterface|null getHttpRequestFactory()
 * @method public ResponseFactoryInterface|null getHttpResponseFactory()
 * @method public StreamFactoryInterface|null getHttpStreamFactory()
 * @method public bool getHttpTelemetry()
 * @method public string|null getManagementToken()
 * @method public array|null getOrganization()
 * @method public bool getQueryUserInfo()
 * @method public string|null getRedirectUri()
 * @method public string getResponseMode()
 * @method public string getResponseType()
 * @method public StoreInterface|null getSessionStorage()
 * @method public array|null getScope()
 * @method public string getTokenAlgorithm()
 * @method public CacheItemInterface|null getTokenCache()
 * @method public int getTokenCacheTtl()
 * @method public string|null getTokenJwksUri()
 * @method public int|null getTokenLeeway()
 * @method public int|null getTokenMaxAge()
 * @method public bool getPersistAccessToken()
 * @method public bool getPersistIdToken()
 * @method public bool getPersistRefreshToken()
 * @method public bool getPersistUser()
 * @method public StoreInterface|null getTransientStorage()
 * @method public bool getUsePkce()
 *
 * @method public bool hasAudience()
 * @method public bool hasClientId()
 * @method public bool hasClientSecret()
 * @method public bool hasDomain()
 * @method public bool hasHttpClient()
 * @method public bool hasHttpRequestFactory()
 * @method public bool hasHttpResponseFactory()
 * @method public bool hasHttpStreamFactory()
 * @method public bool hasHttpTelemetry()
 * @method public bool hasManagementToken()
 * @method public bool hasOrganization()
 * @method public bool hasQueryUserInfo()
 * @method public bool hasRedirectUri()
 * @method public bool hasResponseMode()
 * @method public bool hasResponseType()
 * @method public bool hasSessionStorage()
 * @method public bool hasScope()
 * @method public bool hasTokenAlgorithm()
 * @method public bool hasTokenCache()
 * @method public bool hasTokenCacheTtl()
 * @method public bool hasTokenLeeway()
 * @method public bool hasTokenMaxAge()
 * @method public bool hasPersistAccessToken()
 * @method public bool hasPersistIdToken()
 * @method public bool hasPersistRefreshToken()
 * @method public bool hasPersistUser()
 * @method public bool hasTransientStorage()
 * @method public bool hasUsePkce()
 */
class SdkConfiguration implements ConfigurableContract
{
    use ConfigurableMixin;

    /**
     * SdkConfiguration Constructor
     *
     * @param array|null                    $configuration        Optional. An array of parameter keys (matching this constructor's arguments) and values. Overrides any passed arguments with the same key name.
     * @param string|null                   $domain               Required. Auth0 domain for your tenant.
     * @param string|null                   $clientId             Required. Client ID, found in the Auth0 Application settings.
     * @param string|null                   $redirectUri          Required. Authentication callback uri, as defined in your Auth0 Application settings.
     * @param string|null                   $clientSecret         Optional. Client Secret, found in the Auth0 Application settings.
     * @param array|null                    $audience             Optional. One or more API identifiers, found in your Auth0 API settings. The first supplied identifier will be used when generating links. If provided, at least one of these values must match the 'aud' claim to successfully validate an ID Token.
     * @param array|null                    $organization         Optional. One or more Organization IDs, found in your Auth0 Organization settings. The first supplied identifier will be used when generating links. If provided, at least one of these values must match the 'org_id' claim to successfully validate an ID Token.
     * @param bool                          $usePkce              Optional. Use PKCE (Proof Key of Code Exchange) with Authorization Code Flow requests. Defaults to true. See https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce
     * @param array                         $scope                Optional. One or more scopes to request for Tokens. See https://auth0.com/docs/scopes
     * @param string                        $responseMode         Optional. Defaults to 'query'. Where to extract request parameters from, either 'query' for GET or 'form_post' for POST requests.
     * @param string                        $responseType         Optional. Defaults to 'code'. Use 'code' for server side flows and 'token' for application side flows
     * @param string                        $tokenAlgorithm       Optional. Defaults to 'RS256'. Algorithm to use for Token verification. Expects either 'RS256' or 'HS256'.
     * @param string|null                   $tokenJwksUri         Optional. URI to the JWKS when verifying RS256 tokens.
     * @param string|null                   $tokenMaxAge          Optional. Maximum window of time (in seconds) since the 'auth_time' to accept during Token validation.
     * @param int                           $tokenLeeway          Optional. Defaults to 60. Leeway (in seconds) to allow during time calculations with Token validation.
     * @param CacheItemInterface|null       $tokenCache           Optional. A PSR-16 compatible cache adapter for storing JSON Web Key Sets (JWKS).
     * @param int                           $tokenCacheTtl        Optional. How long (in seconds) to keep a JWKS cached.
     * @param ClientInterface|null          $httpClient           Optional. A PSR-18 compatible HTTP client to use for API requests.
     * @param RequestFactoryInterface|null  $httpRequestFactory   Optional. A PSR-17 compatible request factory to generate HTTP requests.
     * @param ResponseFactoryInterface|null $httpResponseFactory  Optional. A PSR-17 compatible response factory to generate HTTP responses.
     * @param StreamFactoryInterface|null   $httpStreamFactory    Optional. A PSR-17 compatible stream factory to create request body streams.
     * @param bool                          $httpTelemetry        Optional. Defaults to true. Whether API requests should include telemetry about the SDK and PHP runtime version, to help us improve our services.
     * @param StoreInterface|null           $sessionStorage       Optional. Defaults to use PHP native sessions. A StoreInterface-compatible class for storing Token state.
     * @param bool                          $persistUser          Optional. Defaults to true. Whether data about the user should be persisted to session storage.
     * @param bool                          $persistIdToken       Optional. Defaults to true. Whether data about the ID Token should be persisted to session storage.
     * @param bool                          $persistAccessToken   Optional. Defaults to true. Whether data about the Access Token should be persisted to session storage.
     * @param bool                          $persistRefreshToken  Optional. Defaults to true. Whether data about the Refresh Token should be persisted to session storage.
     * @param StoreInterface|null           $transientStorage     Optional. Defaults to use cookies. A StoreInterface-compatible class for storing ephemeral state data, such as a nonce.
     * @param bool                          $queryUserInfo        Optional. Defaults to false. Whether to query the /userinfo endpoint during an authorization code exchange.
     * @param string|null                   $managementToken      Optional. A Management API access token. If not provided, and the Management API is invoked, one will attempt to be generated for you using your provided credentials. This requires a $clientSecret be provided.
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
        ?CacheInterface $tokenCache = null,
        int $tokenCacheTtl = 60,
        ?ClientInterface $httpClient = null,
        ?RequestFactoryInterface $httpRequestFactory = null,
        ?ResponseFactoryInterface $httpResponseFactory = null,
        ?StreamFactoryInterface $httpStreamFactory = null,
        bool $httpTelemetry = true,
        ?StoreInterface $sessionStorage = null,
        bool $persistUser = true,
        bool $persistIdToken = true,
        bool $persistAccessToken = true,
        bool $persistRefreshToken = true,
        ?StoreInterface $transientStorage = null,
        bool $queryUserInfo = false,
        ?string $managementToken = null
    ) {
        $this->setState(func_get_args());

        $this->setValidations([
            'getDomain',
            'getClientId',
            'getRedirectUri',
        ]);

        $this->setupConfiguration();
        $this->validate();
    }

    public function buildDomainUri(): ?string
    {
        return 'https://' . $this->getDomain();
    }

    public function buildScopeString(): ?string
    {
        if ($this->hasScope()) {
            return implode(' ', $this->getScope());
        }

        return '';
    }

    public function buildDefaultOrganization(): ?string
    {
        // Return the default audience.
        if ($this->hasOrganization()) {
            return $this->getOrganization()[0] ?? '';
        }

        return '';
    }

    public function buildDefaultAudience(): ?string
    {
        // Return the default audience.
        if ($this->hasAudience()) {
            return $this->getAudience()[0] ?? '';
        }

        return '';
    }

    private function setupConfiguration(): void
    {
        $this->configureValidationLambdas();

        if (! $this->getSessionStorage() instanceof StoreInterface) {
            $this->setSessionStorage(new SessionStore());
        }

        if (! $this->getTransientStorage() instanceof StoreInterface) {
            $this->setTransientStorage(new CookieStore([
                // Use configuration option or class default.
                'legacy_samesite_none' => $config['legacy_samesite_none_cookie'] ?? null,
                'samesite' => $this->getResponseMode() === 'form_post' ? 'None' : 'Lax',
            ]));
        }

        // If a PSR-18 compatible client wasn't provided, try to discover one.
        if (! $this->getHttpClient() instanceof ClientInterface) {
            $this->setHttpClient(Psr18ClientDiscovery::find());
        }

        // If a PSR-17 compatible request factory wasn't provided, try to discover one.
        if (! $this->getHttpRequestFactory() instanceof RequestFactoryInterface) {
            $this->setHttpRequestFactory(Psr17FactoryDiscovery::findRequestFactory());
        }

        // If a PSR-17 compatible response factory wasn't provided, try to discover one.
        if (! $this->getHttpResponseFactory() instanceof ResponseFactoryInterface) {
            $this->setHttpResponseFactory(Psr17FactoryDiscovery::findResponseFactory());
        }

        // If a PSR-17 compatible stream factory wasn't provided, try to discover one.
        if (! $this->getHttpStreamFactory() instanceof StreamFactoryInterface) {
            $this->setHttpStreamFactory(Psr17FactoryDiscovery::findStreamFactory());
        }
    }

    private function onStateChange(
        string $propertyName,
        $propertyValue
    ) {
        if ($propertyValue === null) {
            return $propertyValue;
        }

        if ($propertyName === 'domain' && $propertyValue) {
            $host = parse_url($propertyValue, PHP_URL_HOST);
            return $host ?? $propertyValue;
        }

        if ($propertyName === 'tokenAlgorithm' && ! in_array($propertyValue, ['HS256', 'RS256'])) {
            throw ConfigurationException::invalidAlgorithm();
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

        return $propertyValue;
    }

    private function onValidationException(
        string $parameter,
        ?string $reason = null
    ): void {
        throw ConfigurationException::validationFailed($parameter);
    }

    private function export(): string
    {
        // Serialize the configuration state and return it as a string of stored values.
        return serialize((object) [
            'state' => $this->configuredState,
            'validations' => $this->configuredValidations,
            'immutable' => $this->configurationImmutable,
        ]);
    }

    private static function import(
        string $serialized
    ): self {
        // Create configuration from stored values.
        $deserialized = unserialize($serialized);

        // Create a ReflectionClass for SdkConfiguration.
        $class = new \ReflectionClass(self::class);

        // Create a new SdkConfiguration without running the __constructor.
        $instance = $class->newInstanceWithoutConstructor();

        // Import the configuration into the new SdkConfiguration instance.
        $instance->configuredState = $deserialized->state;
        $instance->configuredValidations = $deserialized->validations;
        $instance->configuredImmutable = $deserialized->immutable;

        // Run configuration setup to wire validation lambdas, default storage, etc.
        $instance->setupConfiguration();

        // Return the instance.
        return $instance;
    }
}
