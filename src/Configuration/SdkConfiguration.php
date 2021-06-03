<?php

declare(strict_types=1);

namespace Auth0\SDK\Configuration;

use Auth0\SDK\Contract\ConfigurableContract;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Mixins\ConfigurableMixin;
use Auth0\SDK\Store\CookieStore;
use Auth0\SDK\Store\SessionStore;
use Http\Discovery\Exception\NotFoundException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\SimpleCache\CacheInterface;
use ReflectionException;

/**
 * Configuration container for use with Auth0\SDK
 *
 * @method SdkConfiguration setAudience(?array $audience = null)
 * @method SdkConfiguration setClientId(?string $clientId = null)
 * @method SdkConfiguration setClientSecret(?string $clientSecret = null)
 * @method SdkConfiguration setDomain(?string $domain = null)
 * @method SdkConfiguration setHttpClient(?ClientInterface $httpClient = null)
 * @method SdkConfiguration setHttpRequestFactory(?RequestFactoryInterface $httpRequestFactory = null)
 * @method SdkConfiguration setHttpResponseFactory(?ResponseFactoryInterface $httpResponseFactory = null)
 * @method SdkConfiguration setHttpStreamFactory(?StreamFactoryInterface $httpStreamFactory = null)
 * @method SdkConfiguration setHttpTelemetry(bool $httpTelemetry = true)
 * @method SdkConfiguration setManagementToken(?string $managementToken = null)
 * @method SdkConfiguration setOrganization(?array $organization = null)
 * @method SdkConfiguration setQueryUserInfo(bool $queryUserInfo = false)
 * @method SdkConfiguration setRedirectUri(?string $redirectUri = null)
 * @method SdkConfiguration setResponseMode(string $responseMode = 'query')
 * @method SdkConfiguration setResponseType(string $responseType = 'code')
 * @method SdkConfiguration setSessionStorage(?StoreInterface $sessionStorage = null)
 * @method SdkConfiguration setScope(?array $scope = null)
 * @method SdkConfiguration setTokenAlgorithm(string $tokenAlgorithm = 'RS256')
 * @method SdkConfiguration setTokenCache(?CacheInterface $cache = null)
 * @method SdkConfiguration setTokenCacheTtl(int $tokenCacheTtl = 60)
 * @method SdkConfiguration setTokenJwksUri(?string $tokenJwksUri = null)
 * @method SdkConfiguration setTokenLeeway(int $tokenLeeway = 60)
 * @method SdkConfiguration setTokenMaxAge(?int $tokenMaxAge = null)
 * @method SdkConfiguration setPersistAccessToken(bool $persistAccessToken = true)
 * @method SdkConfiguration setPersistIdToken(bool $persistIdToken = true)
 * @method SdkConfiguration setPersistRefreshToken(bool $persistRefreshToken = true)
 * @method SdkConfiguration setPersistUser(bool $persistUser = true)
 * @method SdkConfiguration setTransientStorage(?StoreInterface $transientStorage = null)
 * @method SdkConfiguration setUsePkce(bool $usePkce)
 *
 * @method array<string>|null getAudience()
 * @method string getClientId()
 * @method string|null getClientSecret()
 * @method string getDomain()
 * @method ClientInterface|null getHttpClient()
 * @method RequestFactoryInterface|null getHttpRequestFactory()
 * @method ResponseFactoryInterface|null getHttpResponseFactory()
 * @method StreamFactoryInterface|null getHttpStreamFactory()
 * @method bool getHttpTelemetry()
 * @method string|null getManagementToken()
 * @method array<string>|null getOrganization()
 * @method bool getQueryUserInfo()
 * @method string getRedirectUri()
 * @method string getResponseMode()
 * @method string getResponseType()
 * @method StoreInterface|null getSessionStorage()
 * @method array<string> getScope()
 * @method string getTokenAlgorithm()
 * @method CacheInterface|null getTokenCache()
 * @method int getTokenCacheTtl()
 * @method string|null getTokenJwksUri()
 * @method int|null getTokenLeeway()
 * @method int|null getTokenMaxAge()
 * @method bool getPersistAccessToken()
 * @method bool getPersistIdToken()
 * @method bool getPersistRefreshToken()
 * @method bool getPersistUser()
 * @method StoreInterface|null getTransientStorage()
 * @method bool getUsePkce()
 *
 * @method bool hasAudience()
 * @method bool hasClientId()
 * @method bool hasClientSecret()
 * @method bool hasDomain()
 * @method bool hasHttpClient()
 * @method bool hasHttpRequestFactory()
 * @method bool hasHttpResponseFactory()
 * @method bool hasHttpStreamFactory()
 * @method bool hasHttpTelemetry()
 * @method bool hasManagementToken()
 * @method bool hasOrganization()
 * @method bool hasQueryUserInfo()
 * @method bool hasRedirectUri()
 * @method bool hasResponseMode()
 * @method bool hasResponseType()
 * @method bool hasSessionStorage()
 * @method bool hasScope()
 * @method bool hasTokenAlgorithm()
 * @method bool hasTokenCache()
 * @method bool hasTokenCacheTtl()
 * @method bool hasTokenLeeway()
 * @method bool hasTokenMaxAge()
 * @method bool hasPersistAccessToken()
 * @method bool hasPersistIdToken()
 * @method bool hasPersistRefreshToken()
 * @method bool hasPersistUser()
 * @method bool hasTransientStorage()
 * @method bool hasUsePkce()
 */
final class SdkConfiguration implements ConfigurableContract
{
    use ConfigurableMixin;

    /**
     * SdkConfiguration Constructor
     *
     * @param array<mixed>|null      $configuration        Optional. An array of parameter keys (matching this constructor's arguments) and values. Overrides any passed arguments with the same key name.
     * @param string|null                   $domain               Required, if not specified in $configuration. Auth0 domain for your tenant.
     * @param string|null                   $clientId             Required, if not specified in $configuration. Client ID, found in the Auth0 Application settings.
     * @param string|null                   $redirectUri          Required, if not specified in $configuration. Authentication callback uri, as defined in your Auth0 Application settings.
     * @param string|null                   $clientSecret         Optional. Client Secret, found in the Auth0 Application settings.
     * @param array<string>|null            $audience             Optional. One or more API identifiers, found in your Auth0 API settings. The first supplied identifier will be used when generating links. If provided, at least one of these values must match the 'aud' claim to successfully validate an ID Token.
     * @param array<string>|null            $organization         Optional. One or more Organization IDs, found in your Auth0 Organization settings. The first supplied identifier will be used when generating links. If provided, at least one of these values must match the 'org_id' claim to successfully validate an ID Token.
     * @param bool                          $usePkce              Optional. Use PKCE (Proof Key of Code Exchange) with Authorization Code Flow requests. Defaults to true. See https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce
     * @param array<string>                 $scope                Optional. One or more scopes to request for Tokens. See https://auth0.com/docs/scopes
     * @param string                        $responseMode         Optional. Defaults to 'query'. Where to extract request parameters from, either 'query' for GET or 'form_post' for POST requests.
     * @param string                        $responseType         Optional. Defaults to 'code'. Use 'code' for server side flows and 'token' for application side flows
     * @param string                        $tokenAlgorithm       Optional. Defaults to 'RS256'. Algorithm to use for Token verification. Expects either 'RS256' or 'HS256'.
     * @param string|null                   $tokenJwksUri         Optional. URI to the JWKS when verifying RS256 tokens.
     * @param int|null                      $tokenMaxAge          Optional. Maximum window of time (in seconds) since the 'auth_time' to accept during Token validation.
     * @param int                           $tokenLeeway          Optional. Defaults to 60. Leeway (in seconds) to allow during time calculations with Token validation.
     * @param CacheInterface|null           $tokenCache           Optional. A PSR-16 compatible cache adapter for storing JSON Web Key Sets (JWKS).
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

    /**
     * Return the configured domain with protocol.
     */
    public function buildDomainUri(): ?string
    {
        return 'https://' . $this->getDomain();
    }

    /**
     * Return the configured scopes as a space-delimited string.
     */
    public function buildScopeString(): ?string
    {
        if ($this->hasScope()) {
            return implode(' ', $this->getScope());
        }

        return '';
    }

    /**
     * Get the first configured organization.
     */
    public function buildDefaultOrganization(): ?string
    {
        // Return the default organization.
        if ($this->hasOrganization()) {
            return $this->getOrganization()[0] ?? '';
        }

        return '';
    }

    /**
     * Get the first configured audience.
     */
    public function buildDefaultAudience(): ?string
    {
        // Return the default audience.
        if ($this->hasAudience()) {
            return $this->getAudience()[0] ?? '';
        }

        return '';
    }

    /**
     * Setup SDK defaults based on the configured state.
     *
     * @throws NotFoundException When a PSR-18 or PSR-17 are not configured, and cannot be discovered.
     */
    private function setupConfiguration(): void
    {
        if (! $this->getSessionStorage() instanceof StoreInterface) {
            $this->setSessionStorage(new SessionStore());
        }

        if (! $this->getTransientStorage() instanceof StoreInterface) {
            $this->setTransientStorage(new CookieStore([
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

        return $propertyValue;
    }

    /**
     * Fires when a validation event fails to pass, such as a bad parameter type being used.
     *
     * @param string      $parameter The name of the parameter that failed validation.
     * @param string|null $reason    A description of why the validation failed.
     *
     * @throws ConfigurationException When invoked.
     */
    private function onValidationException(
        string $parameter,
        ?string $reason = null
    ): void {
        throw \Auth0\SDK\Exception\ConfigurationException::validationFailed($parameter);
    }

    /**
     * Export the current state of the configuration as a serialized string.
     */
    private function export(): string
    {
        // Serialize the configuration state and return it as a string of stored values.
        return serialize((object) [
            'state' => $this->configuredState,
            'validations' => $this->configuredValidations,
            'immutable' => $this->configurationImmutable,
        ]);
    }

    /**
     * Import a serialized configuration state and return a new SdkConfiguration.
     *
     * @param string $serialized The serialized configuration state.
     *
     * @throws ReflectionException When the class does not exist.
     */
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
        $instance->configurationImmutable = $deserialized->immutable;

        // Run configuration setup to wire validation lambdas, default storage, etc.
        $instance->setupConfiguration();

        // Return the instance.
        return $instance;
    }
}
