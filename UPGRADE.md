# Migration Guide

## Upgrading from v7.x → v8.0

Our version 8 release includes many significant improvements:

- Adoption of [modern PHP language features](https://stitcher.io/blog/new-in-php-74) including typed properties, null coalescing assignment operators, and array spreading.
- Support for custom [PSR-18](https://www.php-fig.org/psr/psr-18/) and [PSR-17](https://www.php-fig.org/psr/psr-17/) factories for customizing network requests. [PSR-7](https://www.php-fig.org/psr/psr-7/) responses are also now returned throughout the SDK.
- [PSR-4](https://www.php-fig.org/psr/psr-4/) event hooks are now supported throughout the SDK.
- [Fluent interface](https://en.wikipedia.org/wiki/Fluent_interface#PHP) throughout the SDK, offering simplified usage.
- Optional auto-pagination of Management API endpoints that support pagination.
- [PKCE](https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce) is now enabled by default.
- Improved JWT processing and fewer dependencies.

As is to be expected with a major release, there are breaking changes in this update. Please ensure you read this guide thoroughly and prepare your app before upgrading to SDK v8.

### New minimum PHP version: 7.4 (8.0 preferred)

- SDK v8.0 requires PHP 7.4 or higher. PHP 8.0 is supported, and its use with this library is preferred and strongly encouraged.
- 7.4 will be the final release in PHP's 7.x branch. This SDK will only support PHP 8.0+ after 7.4 leaves [supported status](https://www.php.net/supported-versions.php) in November 2022.
- We strongly encourage you to make use of PHP 8.0's new [named arguments language feature](https://stitcher.io/blog/php-8-named-arguments). Once 7.4 support ends, we will no longer consider method argument order changes to be a breaking change.

### Session Storage Chan ges Require User Reauthentication

The new default session storage medium in 8.0 are encrypted cookies. Upgrading to 8.0 from 7.x will require your application's users to re-authenticate.

### Class and Method Changes

### Potentially Breaking Changes

These classes were updated in SDK 8.0:

- Class `Auth0\SDK\Auth0` updated:

  - `__construct` updated:
    - `configuration` added as a required instance of either an `SdkConfiguration` class, or an array of configuration options. See the [8.0 configuration](#configuring-auth0-sdk-80) and [8.0 configuration options](#updated-configuration-options) guides for usage information.
    - All other arguments have been removed.
  - Public method `authentication()` added. It returns a pre-configured singleton of the `Auth0\SDK\API\Authentication` class.
  - Public method `management()` added. It returns a pre-configured singleton of the `Auth0\SDK\API\Management` class.
  - Public method `login()` updated:
    - Method now accepts an argument, `params`: an array of parameters to pass with the API request.
    - Arguments `state`, `connection`, and `additionalParameters` have been removed. Use the new `params` argument for these uses.
  - Public method `signup()` added as a convenience. This method will pass the ?screen_hint=signup param, supported by the New Universal Login Experience.
  - Public method `getLoginUrl()` moved to `Auth0\SDK\API\Authentication\getLoginLink()`, and:
    - Argument `params` is now a nullable array.
  - Public method `renewTokens()` renamed to `renew()`, and:
    - Argument `options` renamed to `params` and is now a nullable array.
  - Public method `decodeIdToken()` renamed to `decode()`, and:
    - Argument `idToken` renamed to `token.`
    - Argument `verifierOptions` removed.
    - Arguments `tokenAudience` and `tokenOrganization` added as optional, nullable arrays.
    - Argument `tokenNonce` added as an optional string.
    - Arguments `tokenMaxAge`, `tokenLeeway`, and `tokenNow` were added as optional, nullable integers.
    - Now returns an instance of `Auth0\SDK\Token` instead of an array.
  - Public methods `getAuthorizationCode()` and `getState()` were removed; please use `getRequestParameter()` method.
  - Public method `deleteAllPersistentData()` renamed to `clear()`.
  - Public methods `getNonce()` and `urlSafeBase64Decode()` were removed.
  - Public methods `getAccessTokenExpiration()` and `setAccessTokenExpiration()` were added for retrieving for storing an access token expiration timestamp in session storage, respectively.
  - Public method `getCredentials()` added as a convenience. This method returns the Id Token, Access Token, Refresh Token, Access Token expiration timestamp, and user data from an available session without invoking an authorization flow, exchange, or raising an error if a session is not available.

- Class `Auth0\SDK\API\Authentication` updated:

  - `__construct` updated:
    - `configuration` added as a required instance of either an `SdkConfiguration` class, or an array of configuration options. See the [8.0 configuration](#configuring-auth0-sdk-80) and [8.0 configuration options](#updated-configuration-options) guides for usage information.
    - All other arguments have been removed.
  - Public method 'getHttpClient()' added.
  - Public method `get_authorize_link()` renamed to `getAuthorizationLink()`, and:
    - Method now accepts an argument, `params`: an array of parameters to pass with the request. Please see the API endpoint documentation for available options.
  - Public method `get_samlp_link()` renamed to `getSamlpLink()`, and:
    - Argument `client_id` renamed to `clientId`.
  - Public method `get_samlp_metadata_link()` renamed to `getSamlpMetadataLink()`, and:
    - Argument `client_id` renamed to `clientId`.
  - Public method `get_wsfed_link()` renamed to `getWsfedLink()`, and:
    - Argument `client_id` renamed to `clientId`.
  - Public method `get_wsfed_metadata_link()` renamed to `getWsfedMetadataLink()`.
  - Public method `get_logout_link()` renamed to `getLogoutLink()`, and:
    - Argument `returnTo` renamed to `returnUri`.
    - Arguments `client_id` and `federated` were removed.
    - Method now accepts an argument, `params`: an array of parameters to pass with the request. Please see the API endpoint documentation for available options.
  - Public method `passwordlessStart()` added.
  - Public method `email_passwordless_start()` renamed to `emailPasswordlessStart()`, and:
    - Argument `authParams` updated to be nullable and defaults to null.
    - Argument `headers` added to specify additional headers to pass with the request.
    - Argument `forwarded_for` removed. Use the new `headers` argument with an 'AUTH0_FORWARDED_FOR' key-value pair for this behavior.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `sms_passwordless_start()` renamed to `smsPasswordlessStart()`, and:
    - Argument `phone_number` renamed to `phoneNumber`.
    - Argument `headers` added to specify additional headers to pass with the request.
    - Argument `forwarded_for` removed. Use the new `headers` argument with an 'AUTH0_FORWARDED_FOR' key-value pair for this behavior.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `userinfo()` renamed to `userInfo()`, and:
    - Argument `access_token` renamed to `accessToken`.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `oauth_token()` renamed to `oauthToken()`, and:
    - Argument `grantType` added. It requires a string.
    - Arguments `headers` and `params` were added as optional, nullable arrays.
    - Argument `options` removed. Use the new `headers` and `params` arguments for these functions.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `code_exchange()` renamed to `codeExchange()`, and:
    - Argument `redirect_uri` renamed to `returnUri`.
    - Argument `code_verifier` renamed to `codeVerifier`.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `login()` updated:
    - Arguments `username`, `password,` and `realm` added as required strings.
    - Arguments `headers` and `params` were added as optional, nullable arrays.
    - Argument `ip_address` removed. Use the new `headers` argument with an 'AUTH0_FORWARDED_FOR' key-value pair for this behavior.
    - Argument `options` removed. Use the new `headers` and `params` arguments for these functions.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `login_with_default_directory()` renamed to `loginWithDefaultDirectory()`, and:
    - Arguments `username` and `password` added as required strings.
    - Arguments `headers` and `params` were added as optional, nullable arrays.
    - Argument `ip_address` removed. Use the new `headers` argument with an 'AUTH0_FORWARDED_FOR' key-value pair for this behavior.
    - Argument `options` removed. Use the new `headers` and `params` arguments for these functions.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `client_credentials()` renamed to `clientCredentials()`, and:
    - Arguments `headers` and `params` were added as optional, nullable arrays.
    - Argument `options` removed. Use the new `headers` and `params` arguments for these functions.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `refresh_token()` renamed to `refreshToken()`, and:
    - Argument `refresh_token` renamed to `refreshToken`.
    - Arguments `headers` and `params` were added as optional, nullable arrays.
    - Argument `options` removed. Use the new `headers` and `params` arguments for these functions.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `dbconnections_signup()` renamed to `dbConnectionsSignup()`, and:
    - Arguments `body` and `headers` added as optional, nullable arrays.
    - Now returns a PSR-7 ResponseInterface, instead of an array.
  - Public method `dbconnections_change_password()` changed to `dbConnectionsChangePassword()`, and:
    - Arguments `body` and `headers` added as optional, nullable arrays.
    - Argument `password` removed. Use the new `body` argument for this behavior.

- Class `Auth0\SDK\API\Management` updated:

  - `__construct` updated:
    - `configuration` added as a required instance of either an `SdkConfiguration` class, or an array of configuration options. See the [8.0 configuration](#configuring-auth0-sdk-80) and [8.0 configuration options](#updated-configuration-options) guides for usage information.
    - All other arguments have been removed.
  - Public method 'getHttpClient()' added.
  - Public method `getResponsePaginator()` added.

- Class `Auth0\SDK\API\Management\Tenants` updated:

  - Public method `get` renamed to `getSettings`.
  - Public method `update` renamed to `updateSettings`.

- Class `Auth0\SDK\API\Management\GenericResource` renamed to `Auth0\SDK\API\Management\ManagementEndpoint`, and:

  - Constructor updated to require an `HttpClient` instance; previously expected an `ApiClient` instance.
  - Public method `getApiClient()` renamed to `getHttpClient()`.
  - Public method `getLastRequest()` added.
  - Public methods `normalizeRequest()`, `normalizePagination()`, `normalizeIncludeTotals()`, and `normalizeIncludeFields()` were removed, and:
    - Their functionality has been rolled into the new `Auth0\SDK\Utility\Request\RequestOptions`, `Auth0\SDK\Utility\Request\FilteredRequest`, and `Auth0\SDK\Utility\Request\PaginatedRequest` utility classes.
  - Public methods `checkInvalidPermissions()`, `checkEmptyOrInvalidString()`, and `checkEmptyOrInvalidArray()` were removed, and:
    - Their functionality has been rolled into the new `Auth0\SDK\Utility\Validate` utility class.

- Class `Auth0\SDK\Store\StoreInterface` moved to `Auth0\SDK\Contract\StoreInterface`.
- Class `Auth0\SDK\Exception\CoreException` moved to `Auth0\SDK\Contract\SdkException`.
- Class `Auth0\SDK\Helpers\PKCE` moved to `Auth0\SDK\Utility\PKCE`.
- Class `Auth0\SDK\Helpers\TransientStoreHandler` moved to `Auth0\SDK\Utility\TransientStoreHandler`.

### Classes Removed

- All `Auth0\SDK\API\Header` classes:

  - Class `Auth0\SDK\API\Header\AuthorizationBearer`.
  - Class `Auth0\SDK\API\Header\ContentType`.
  - Class `Auth0\SDK\API\Header\ForwardedFor`.
  - Class `Auth0\SDK\API\Header\Header`.
  - Class `Auth0\SDK\API\Header\Telemetry`.

- All `Auth0\SDK\API\Helpers` classes:

  - Class `Auth0\SDK\API\Helpers\ApiClient` superseded by `Auth0\SDK\Utility\HttpClient`.
  - Class `Auth0\SDK\API\Helpers\RequestBuilder` superseded by `Auth0\SDK\Utility\HttpRequest`.
  - Class `Auth0\SDK\API\Helpers\InformationHeaders` superseded by `Auth0\SDK\Utility\HttpTelemetry`.

- All token-related classes have been replaced by the new `Auth0\SDK\Token`, `Auth0\SDK\Token\Parser`, `Auth0\SDK\Token\Validator`, and `Auth0\SDK\Token\Verifier` classes.

  - Class `Auth0\SDK\Helpers\Tokens\AsymmetricVerifier`.
  - Class `Auth0\SDK\Helpers\Tokens\IdTokenVerifier`.
  - Class `Auth0\SDK\Helpers\Tokens\SignatureVerifier`.
  - Class `Auth0\SDK\Helpers\Tokens\SymmetricVerifier`.
  - Class `Auth0\SDK\Helpers\Tokens\TokenVerifier`.
  - Class `Auth0\SDK\Helpers\JWKFetcher`.

- Class `Auth0\SDK\Exception\ApiException` superseded by more specific exception classes.
- Class `Auth0\SDK\Helpers\Cache\NoCacheHandler` no longer relevant.
- Class `Auth0\SDK\Store\EmptyStore` no longer relevant.

### New Additions

These classes and traits were added in SDK 8.0:

- Class `Auth0\SDK\Configuration\SdkConfiguration`.
- Class `Auth0\SDK\Configuration\SdkState`.
- Class `Auth0\SDK\Contract\ConfigurableContract`.
- Class `Auth0\SDK\Exception\ArgumentException`.
- Class `Auth0\SDK\Exception\AuthenticationException`.
- Class `Auth0\SDK\Exception\ConfigurationException`.
- Class `Auth0\SDK\Exception\NetworkException`.
- Class `Auth0\SDK\Exception\PaginatorException`.
- Class `Auth0\SDK\Exception\StateException`.
- Class `Auth0\SDK\Token\Parser`.
- Class `Auth0\SDK\Token\Validator`.
- Class `Auth0\SDK\Token\Verifier`.
- Class `Auth0\SDK\Token`.
- Class `Auth0\SDK\Utility\Request\FilteredRequest`.
- Class `Auth0\SDK\Utility\Request\PaginatedRequest`.
- Class `Auth0\SDK\Utility\Request\RequestOptions`.
- Class `Auth0\SDK\Utility\HttpClient`.
- Class `Auth0\SDK\Utility\HttpRequest`.
- Class `Auth0\SDK\Utility\HttpResponse`.
- Class `Auth0\SDK\Utility\HttpResponsePaginator`.
- Class `Auth0\SDK\Utility\HttpTelemetry`.
- Class `Auth0\SDK\Utility\Shortcut`.
- Class `Auth0\SDK\Utility\Validate`.

- Trait `Auth0\SDK\Mixins\ConfigurableMixin`.

### Configuring Auth0 SDK 8.0

Most class constructors throughout the SDK accept a new `SdkConfiguration` configuration class, which shares your app configuration by reference throughout the SDK's subclasses, allowing you to make changes on the fly from within your app:

```PHP
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

// PHP 8.0 named arguments syntax
$configuration = new SdkConfiguration(
    domain: 'your-tenant.auth0.com',
    clientId: 'application_client_id',
    clientSecret: 'application_client_secret',
    redirectUri: 'https://yourapplication.com/auth/callback',
    tokenAlgorithm: 'RS256'
);

$auth0 = new Auth0($configuration);
```

Alternatively, you can use an array to configure the base `Auth0` class, and a `SdkConfiguration` will instantiate for you. Key names must match the same camelCase format of the constructor arguments for `SdkConfiguration.`

```PHP
use Auth0\SDK\Auth0;

// PHP 7.4-compatible array syntax
$auth0 = new Auth0([
    'domain' => 'your-tenant.auth0.com',
    'clientId' => 'application_client_id',
    'clientSecret' => 'application_client_secret',
    'redirectUri' => 'https://yourapplication.com/auth/callback',
    'tokenAlgorithm' => 'HS256'
]);
```

After initializing the Auth0 SDK with your configuration, you can keep a reference to the `SdkConfiguration` within your app so you can make changes later. The SDK automatically recognizes changes to your `SdkConfiguration` and uses them.

```PHP
$configuration = new SdkConfiguration(
    domain: 'your-tenant.auth0.com',
    clientId: 'application_client_id',
    clientSecret: 'application_client_secret',
    redirectUri: 'https://yourapplication.com/auth/callback',
    tokenAlgorithm: 'RS256'
);

$auth0 = new Auth0($configuration);

// Prints 'your-tenant.auth0.com'
echo $configuration->getDomain();

// Change the configuration
$configuration->setDomain('another-tenant.auth0.com');

// Prints 'another-tenant.auth0.com'
echo $configuration->getDomain();

// Will authenticate the user with 'another-tenant.auth0.com'
$auth->login();
```

### Updated Configuration Options

Some options names have changed for clarity. It would be best to reference the `SdkConfiguration` constructor comments for an up-to-date list, as there may be new additions with later releases. At the time of this guide's writing, these options are available:

```text
$strategy              string|null                    Defaults to 'webapp'. Should be assigned either 'api', 'management', or 'webapp' to specify the type of application the SDK is being applied to. Determines what configuration options will be required at initialization.
$domain                string|null                    Auth0 domain for your tenant, found in your Auth0 Application settings.
$customDomain          string|null                    If you have configured Auth0 to use a custom domain, configure it here.
$clientId              string|null                    Client ID, found in the Auth0 Application settings.
$redirectUri           string|null                    Authentication callback URI, as defined in your Auth0 Application settings.
$clientSecret          string|null                    Client Secret, found in the Auth0 Application settings.
$audience              array<string>|null             One or more API identifiers, found in your Auth0 API settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'aud' claim to validate an ID Token successfully.
$organization          array<string>|null             One or more Organization IDs, found in your Auth0 Organization settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'org_id' claim to validate an ID Token successfully.
$usePkce               bool                           Defaults to true. Use PKCE (Proof Key of Code Exchange) with Authorization Code Flow requests. See https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce
$scope                 array<string>                  One or more scopes to request for Tokens. See https://auth0.com/docs/scopes
$responseMode          string                         Defaults to 'query.' Where to extract request parameters from, either 'query' for GET or 'form_post' for POST requests.
$responseType          string                         Defaults to 'code.' Use 'code' for server-side flows and 'token' for application side flow.
$tokenAlgorithm        string                         Defaults to 'RS256'. Algorithm to use for Token verification. Expects either 'RS256' or 'HS256'.
$tokenJwksUri          string|null                    URI to the JWKS when verifying RS256 tokens.
$tokenMaxAge           int|null                       The maximum window of time (in seconds) since the 'auth_time' to accept during Token validation.
$tokenLeeway           int                            Defaults to 60. Leeway (in seconds) to allow during time calculations with Token validation.
$tokenCache            CacheItemPoolInterface|null    A PSR-6 compatible cache adapter for storing JSON Web Key Sets (JWKS).
$tokenCacheTtl         int                            How long (in seconds) to keep a JWKS cached.
$httpClient            ClientInterface|null           A PSR-18 compatible HTTP client to use for API requests.
$httpMaxRetries        int                            When a rate-limit (429 status code) response is returned from the Auth0 API, automatically retry the request up to this many times.
$httpRequestFactory    RequestFactoryInterface|null   A PSR-17 compatible request factory to generate HTTP requests.
$httpResponseFactory   ResponseFactoryInterface|null  A PSR-17 compatible response factory to generate HTTP responses.
$httpStreamFactory     StreamFactoryInterface|null    A PSR-17 compatible stream factory to create request body streams.
$httpTelemetry         bool                           Defaults to true. If true, API requests will include telemetry about the SDK and PHP runtime version to help us improve our services.
$sessionStorage        StoreInterface|null            Defaults to use cookies. A StoreInterface-compatible class for storing Token state.
$sessionStorageId      string                         Defaults to 'auth0_session'. The namespace to prefix session items under.
$cookieSecret          string|null                    The secret used to derive an encryption key for the user identity in a session cookie and to sign the transient cookies used by the login callback.
$cookieDomain          string|null                    Defaults to value of HTTP_HOST server environment information. Cookie domain, for example 'www.example.com', for use with PHP sessions and SDK cookies. To make cookies visible on all subdomains then the domain must be prefixed with a dot like '.example.com'.
$cookieExpires         int                            Defaults to 0. How long, in seconds, before cookies expire. If set to 0 the cookie will expire at the end of the session (when the browser closes).
$cookiePath            string                         Defaults to '/'. Specifies path on the domain where the cookies will work. Use a single slash ('/') for all paths on the domain.
$cookieSecure          bool                           Defaults to false. Specifies whether cookies should ONLY be sent over secure connections.
$persistUser           bool                           Defaults to true. If true, the user data will persist in session storage.
$persistIdToken        bool                           Defaults to true. If true, the Id Token will persist in session storage.
$persistAccessToken    bool                           Defaults to true. If true, the Access Token will persist in session storage.
$persistRefreshToken   bool                           Defaults to true. If true, the Refresh Token will persist in session storage.
$transientStorage      StoreInterface|null            Defaults to use cookies. A StoreInterface-compatible class for storing ephemeral state data, such as nonces.
$transientStorageId    string                         Defaults to 'auth0_transient'. The namespace to prefix transient items under.
$queryUserInfo         bool                           Defaults to false. If true, query the /userinfo endpoint during an authorization code exchange.
$managementToken       string|null                    An Access Token to use for Management API calls. If there isn't one specified, the SDK will attempt to get one for you using your $clientSecret.
$managementTokenCache  CacheItemPoolInterface|null    A PSR-6 compatible cache adapter for storing generated management access tokens.
$eventListenerProvider ListenerProviderInterface|null A PSR-14 compatible event listener provider, for interfacing with events triggered by the SDK.
```

↗ [Learn more about PSR-6 caches.](https://www.php-fig.org/psr/psr-6/)<br />
↗ [Learn more about PSR-14 Event Dispatchers.](https://www.php-fig.org/psr/psr-14/)<br />
↗ [Learn more about PSR-17 HTTP Factories,](https://www.php-fig.org/psr/psr-17/) which are used to create [PSR-7 HTTP messages.](https://www.php-fig.org/psr/psr-7/)<br />
↗ [Learn more about the PSR-18 HTTP Client standard.](https://www.php-fig.org/psr/psr-18/)<br />
↗ [Find PSR-6 cache libraries on Packagist.](https://packagist.org/search/?query=PSR-6&type=library&tags=psr%206)<br />
↗ [Find PSR-17 HTTP factory libraries on Packagist.](https://packagist.org/search/?query=PSR-17&type=library&tags=psr%2017)<br />
↗ [Find PSR-18 HTTP client libraries on Packagist.](https://packagist.org/search/?query=PSR-18&type=library&tags=psr%2018)

### Using the new Authentication and Management Factories

SDK v8.0 offers a cleaner approach of accessing the Authentication and Management API sub-classes without having to reconfigure them independently: configure the base `Auth0` class, and use the factory methods to configure these API sub-classes for you:

```PHP
use Auth0\SDK\Auth0;

// Configure just once:
$auth0 = new Auth0([
    'domain' => 'your-tenant.auth0.com',
    'clientId' => 'application_client_id',
    'clientSecret' => 'application_client_secret',
    'redirectUri' => 'https://yourapplication.com/auth/callback',
    'tokenAlgorithm' => 'HS256'
]);

// Returns an instance already configured for you.
$authentication = $auth0->authentication();
$management = $auth0->management();

// Or, a fluent example:
$response = $auth0->management()->users()->getAll();
```

### Support for PSR-18 and PSR-17 factories

Previous versions of the Auth0 PHP SDK had a dependency on [Guzzle](http://guzzlephp.org/) for issuing network requests. SDK v8.0 uses a more modern approach of accepting developer-supplied [PSR-18](https://www.php-fig.org/psr/psr-18/) and [PSR-17](https://www.php-fig.org/psr/psr-17/) factory interfaces for making these requests. We strongly encourage you to pass the factories of your choice during SDK configuration. The SDK will make a best-effort attempt at auto-discovering any compatible libraries present in your application when none are specified.

As an example, let's say your application is already incorporating [Buzz](https://github.com/kriswallsmith/Buzz) and [Nylom's PSR-7 implementation](https://github.com/Nyholm/psr7), which include PSR-18 and PSR-17 factories, respectively. Pass these to the SDK to use them:

```PHP
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Buzz\Client\MultiCurl;
use Nyholm\Psr7\Factory\Psr17Factory;

// PSR-17 HTTP Factory (creates http requests and responses)
$httpFactory = new Psr17Factory();

 // PSR-18 HTTP Client (delivers http requests created by the PSR-17 factory above)
$httpClient = new MultiCurl($httpFactory);

$configuration = new SdkConfiguration(
    domain: 'your-tenant.auth0.com',
    clientId: 'application_client_id',
    redirectUri: 'https://yourapplication.com/auth/callback',

    // Specify a PSR-18 HTTP client factory:
    httpClient: $httpClient

    // Specify PSR-17 request/response factories:
    httpRequestFactory: $httpFactory
    httpResponseFactory: $httpFactory
    httpStreamFactory: $httpFactory
);

$auth0 = new Auth0($configuration);
```

The libraries specified above are simply examples. Any libraries that support the PSR-18 and PSR-17 standards will work.

↗ [Guzzle 7 natively supports PSR-18.](https://docs.php-http.org/en/latest/clients/guzzle7-adapter.html)<br />
↗ [Guzzle 6 is compatible with an adaptor library.](https://github.com/php-http/guzzle6-adapter)<br />
↗ [Symfony's HttpClient component natively supports PSR-18.](https://symfony.com/doc/current/http_client.html#psr-18-and-psr-17)<br />
↗ [Learn about other compatible libraries from PHP-HTTP.](https://docs.php-http.org/en/latest/clients.html)<br />
↗ [Search packagist for other PSR-17 HTTP factory libraries.](https://packagist.org/search/?query=PSR-17&type=library&tags=psr%2017)<br />
↗ [Search packagist for other PSR-18 HTTP client libraries.](https://packagist.org/search/?query=PSR-18&type=library&tags=psr%2018)

### Support for PSR-7 responses

Most functions that issue network requests now return [PSR-7](https://www.php-fig.org/psr/psr-7/) message interfaces, which allow you a greater deal of control over handling the response, such as troubleshooting errors and analyzing headers. We've included a utility class for simplifying working with these responses in general use cases:

```PHP
use Auth0\SDK\Auth0;
use Auth0\SDK\Utility\HttpResponse;

$auth0 = new Auth0(/* ...configuration */);

// Get all users via fluent interface
$response = $auth0->management()->users()->getAll();

if (HttpResponse::wasSuccessful($response)) { // Checks that the status code was 200
    $users = HttpResponse::decodeContent($response); // Parses the response body as JSON and returns the resulting object
    print_r($users);

    $headers = HttpResponse::getHeaders($response); // Get an array containing all the headers attached to the response.
    print_r($headers);
}
```

Alternatively, you can achieve the same results with the native PSR-7 standard API without using the `HttpResponse` utility class:

```PHP
use Auth0\SDK\Auth0;
use Auth0\SDK\Utility\HttpResponse;

$auth0 = new Auth0(/* ...configuration */);

// Get all users via fluent interface
$response = $auth0->management()->users()->getAll();

if ($response->getStatusCode() === 200) { // Checks that the status code was 200
    print_r(json_decode($response->getBody()->__toString(), true, 512, JSON_THROW_ON_ERROR)); // Print the parsed JSON response body
    print_r($response->getHeaders()); // Print the array containing all the headers attached to the response.
}
```

### Using the new field filtering and pagination API

A new argument has been added to most network endpoints, accepting a new `RequestOptions` class type. `RequestOptions` allows you to specify field-filtered and paginated requests easily:

```PHP
use Auth0\SDK\Auth0;
use Auth0\SDK\Utility\Request\{RequestOptions, FilteredRequest, PaginatedRequest};

$auth0 = new Auth0(/* ...configuration */);

// Fluent example:
$response = $auth0->management()->users()->getAll(
    request: new RequestOptions(
        fields: new FilteredRequest(
            fields: ['user_id', 'email'],
            includeFields: true
        ),
        pagination: new PaginatedRequest(
            page: 0,
            perPage: 50,
            includeTotals: true
        )
    )
);
```

↗ [Learn more about paginating Auth0 API endpoints here.](https://auth0.com/docs/api#pagination).

### Auto-pagination support available

You can use the new `HttpResponsePaginator` utility class with endpoints that support pagination to return a PHP-native iterator type, which will automatically request new pages of results as you loop through it.

```PHP
use Auth0\SDK\Auth0;
use Auth0\SDK\Utility\Request\{RequestOptions, FilteredRequest, PaginatedRequest};

$auth0 = new Auth0(/* ...configuration */);

// NOTE: Auto-pagination will only work when include_totals is enabled:
$response = $auth0->management()->users()->getAll(
    request: new RequestOptions(
        pagination: new PaginatedRequest(
            page: 0,
            perPage: 50,
            includeTotals: true
        )
    )
);

// Return an HttpResponsePaginator pre-configured with our request above:
$users = $auth0->management()->getResponsePaginator();

// Count will use the total results available as reported from the API rather than what is loaded into memory.
echo 'There are ' . count($users) . ' results available from the API.';

// Our new iterator will make new, paginated network requests as necessary to retrieve more results:
foreach ($users as $user) {
    print_r($user);
}

// You can find out how many network requests were made with this helper method:
echo 'We made ' . $users->countNetworkRequests() . ' paginated network requests.';
```

⚠️ Note that SDK 8.0's `HttpResponsePaginator` does not currently support checkpoint pagination. This will be introduced in a later release.

### Using the new `Auth0::getCredentials()` method to retrieve session credentials

`Auth0::getCredentials` is a new convenience function that returns the available Id Token, Access Token, Access Token expiration timestamp, and Refresh Token (if one is available) when they are available from session storage. It also returns an `accessTokenExpired` bool value that you can more easily compare to decide if you need to renew or prompt to log back in.

```PHP
use Auth0\SDK\Auth0;

$sdk = new Auth0(/* ... configuration */);

// If we've just returned from the callback, remove the ?code parameter from the query by redirecting to index route.
if ($sdk->getRequestParameter('code')) {
    header("Location: /");
    exit;
}

// Use the new helper to silently get state.
$credentials = $sdk->getCredentials();

// If there's no session, begin authentication flow. Alternatively you could render the app in guest mode, or offer a login interstitial, etc.
if (! $credentials) {
   $sdk->login();
}

// We have a session available.
if ($credentials) {
    // If the access token has expired, try to renew it.
    if ($credentials->accessTokenExpired) {
        try {
            $sdk->renew();
        } catch (\Auth0\SDK\Exception\StateException $exception) {
            // Couldn't renew the token, we might not have one based on our requested scopes. Let's fallback to starting a fresh authentication flow.
            $sdk->login();
        }
    }

    // Everything is good. Let's echo info about the user as an example.
    print_r($credentials->user);
}
```

This saves you from needing to call `Auth0::getIdToken()`, `Auth0::getUser()`, `Auth0::getAccessToken()`, `Auth0::getRefreshToken()`, and `Auth0::getAccessTokenExpiration()` separately if you simply want to inspect credentials. `Auth0::getCredentials()` will not throw an error if credentials aren't available, it will simply return a null value.

---

## Upgrading from v5.x → v7.x

The v7 major release adds some new features, removes several deprecated methods and classes, and changes how some applications need to be configured. Please read through this guide to make sure your application is up to date before upgrading to v7.

Only potentially breaking changes are covered in this guide. For a list of all changes for this major, see [the 7.0.0 milestone on GitHub](https://github.com/auth0/auth0-PHP/issues?q=is%3Aclosed+milestone%3A7.0.0).

### New minimum PHP version: 7.1

The v7 release requires PHP 7.1 or later to enable a number of helpful features like type hinting and null coalescing.

### Auth0 class configuration changes

A number of breaking changes were made to the `Auth0` class configuration passed in at initialization.

The main breaking change is only for applications that accept HS256 ID tokens. If your application is set to accept ID tokens signed using the HS256 algorithm, we recommend changing that to `RS256` in the Auth0 Application > Settings tab > Advanced settings > OAuth tab > JsonWebToken Signature Algorithm field before upgrading and leaving the `id_token_alg` configuration key unset. If your application cannot be changed for some reason, set the `id_token_alg` configuration key to `HS256`, like so:

```PHP
$auth0 = new Auth0([
    'domain' => 'your-tenant.auth0.com',
    'client_id' => 'application_client_id',
    'client_secret' => 'application_client_secret',
    'redirect_uri' => 'https://yourapplication.com/auth/callback',
    'id_token_alg' => 'HS256'
]);
```

The `id_token_aud` and `id_token_iss` configuration keys have been removed, and their values will now be ignored.

The `state_handler` configuration key has been removed, and the `transient_store` configuration key has been added. See the **State and nonce handling** section below for more information about the changes with state handling.

The ability to pass `false` in the `store` configuration key has been removed. Set `store` to an instance of `EmptyStore` or set all `persist_*` configuration keys to `false` to skip all persistence.

The `cache_handler` configuration key must now be an instance of `Psr\SimpleCache\CacheInterface.` See the **Cache handling** section below for more information.

The default `secret_base64_encoded` value is now `false` and is no longer stored in a property.

The `client_secret` configuration key is no longer required for class initialization (but will throw an exception in certain methods when required). If `secret_base64_encoded` is set to `true` then then the `clientSecret` property will now contain the decoded secret. If your application is using an encoded secret, this encoding can be turned off by rotating the client secret in the Auth0 Application settings.

The `session_cookie_expires` configuration key has been removed. The session cookie expiration should be managed in the application. If you were using this setting before, [see the PHP core function session_set_cookie_params()](https://www.php.net/manual/en/function.session-set-cookie-params.php) to set this value after upgrading.

The `session_base_name` configuration key has been removed. Instead, pass an instance of `StoreInterface` in the `store` configuration key with the modified name.

The `skip_userinfo` configuration key now defaults to `true.` This means that the persisted user identity will now come from the ID token rather than a call to the userinfo endpoint. This can be set to `false` to return to the behavior in v5.

The ENV variables `AUTH0_DOMAIN`, `AUTH0_CLIENT_ID`, and `AUTH0_REDIRECT_URI` will now be used automatically for the `domain`, `client_id,` and `redirect_uri` configuration keys, respectively.

The `debug` configuration key was removed.

### Cache handling

Cache handling has been changed in v7 to conform to the PSR-16 standard (see the discussion [here](https://github.com/auth0/auth0-PHP/issues/282)). Objects passed to the `cache_handler` configuration key in `Auth0,` and the first parameter of the `JWKFetcher` class should be instances of `Psr\SimpleCache\CacheInterface.`

### State and nonce handling

The handling for transient authentication data, such as `state` and `nonce,` has been changed.

In an effort to enforce security standards set forth in the OAuth and OpenID Connect specifications, `state` checking on the callback route and `nonce` checking for all received ID tokens is now mandatory. Applications that require IdP-initiated sign-on should add a login route that uses `Auth0->getLoginUrl()` to redirect through Auth0 with valid state and nonce values. The URL to this route should be saved to the **Application Login URI** field in your Auth0 Application to assist with this scenario.

The handling for these values was changed from PHP session-stored values to cookies using the new `CookieStore` class. This was done, so PHP session usage was not required and to assist with applications using a `form_post` response mode. This change may require server-level white-listing of cookie names (`auth0__nonce` and `auth0__state` by default) on some managed hosts. The `transient_store` configuration key in the `Auth0` class can be used to switch back to PHP sessions or provide another method.

The default state key was changed from `auth0__webauth_state` to `auth0__state`.

### Classes and Interfaces removed

The following classes were removed in v7:

- Class `Firebase\JWT\JWT` provided by the `firebase/php-jwt` package was replaced with classes from the `lcobucci/jwt` package
- Class `JWTVerifier` was removed, see the `Auth0->decodeIdToken()` method for how to use the replacement classes
- Class `StateHandler` was removed, see the **State and nonce handling** section above for more information
- Class `SessionStateHandler` was removed. See the **State and nonce handling** section above for more information
- Class `DummyStateHandler` was removed. See the **State and nonce handling** section above for more information
- Interface `CacheHandler` was removed. See the **Cache handling** section above for more information
- Class `FileSystemCacheHandler` was removed. See the **Cache handling** section above for more information
- Class `TokenGenerator` was removed, no replacement provided
- Class `Oauth2Client` was removed, no replacement provided
- Class `Auth0Api` was removed, no replacement provided
- Class `Auth0AuthApi` was removed, no replacement provided
- Class `Auth0JWT` was removed, no replacement provided

### Classes changes

The following class constructors were changed in v7:

- Class `Authentication` now requires a `client_id` parameter
- Class `NoCacheHandler` now implements `Psr\SimpleCache\CacheInterface`
- Class `JWKFetcher` now requires an instance of `Psr\SimpleCache\CacheInterface` as the first construct parameter
- Class constant `SessionStore::COOKIE_EXPIRES` was removed
- Class `SessionStore` no longer accepts a 2nd constructor argument to adjust the session cookie expiration; [see the PHP core function session_set_cookie_params()](https://www.php.net/manual/en/function.session-set-cookie-params.php) to set this value in v7
- Class `Auth0\SDK\API\Header\Authorization\AuthorizationBearer` was changed to `Auth0\SDK\API\Header\AuthorizationBearer`

### Methods changed

The following methods were changed in a breaking way in v7:

- Public method `RequestBuilder->withHeader()` now only accepts a `Header` instance as an argument.
- Public method `Authentication->code_exchange()` now throws an `ApiException` if class-level `client_secret` is empty
- Public method `Authentication->client_credentials()` now throws an `ApiException` if `audience` is empty
- Public method `Authentication->get_authorize_link()` now adds class-level `scope` and `audience` if none are passed in

### Methods removed

The following methods were removed in v7:

- Public magic method `ApiClient->__call()` was removed, use `ApiClient->method()` to indicate an HTTP verb to use
- Public magic method `RequestBuilder->__call()` was removed, use `RequestBuilder->addPath()` to add paths
- Public method `RequestBuilder->addPathVariable()` was removed, use `RequestBuilder->addPath()` to add paths
- Public method `RequestBuilder->dump()` was removed, no replacement provided
- Public method `RequestBuilder->withParams()` was removed, use `RequestBuilder->withDictParams()` to add params
- Public method `InformationHeaders->setEnvironment()` was removed, no replacement provided
- Public method `InformationHeaders->setDependency()` was removed, no replacement provided
- Public method `InformationHeaders->setDependencyData()` was removed, no replacement provided
- Public method `ClientGrants->get()` was removed, no replacement provided
- Public method `Users->search()` was removed, use `Users->getAll()` instead
- Public method `Users->unlinkDevice()` was removed, no replacement provided
- Public method `JWKFetcher->requestJwkX5c()` was removed, use `JWKFetcher->getKeys()` instead
- Public method `JWKFetcher->findJwk()` was removed, use `JWKFetcher->getKeys()` instead
- Public method `JWKFetcher->subArrayHasEmptyFirstItem()` was removed, no replacement provided
- Public method `JWKFetcher->fetchKeys()` was removed, use `JWKFetcher->getKeys()` instead
- Public method `Authentication->authorize_with_ro()` was removed, no replacement provided
- Public method `Authentication->authorize_with_accesstoken()` was removed, no replacement provided
- Public method `Authentication->impersonate()` was removed, no replacement provided
- Public method `Authentication->email_code_passwordless_verify()` was removed, no replacement provided
- Public method `Authentication->sms_code_passwordless_verify()` was removed, no replacement provided
- Public method `Auth0->setDebugger()` was removed, no replacement provided
- Protected method `Authentication->setApiClient()` was removed, no replacement provided
- Protected method `Management->setApiClient()` was removed, no replacement provided

### Class properties removed

The following properties were removed in v7:

- Public property `Management->blacklists` was made private, replaced by `Management->blacklists()`
- Public property `Management->clients` was made private, replaced by `Management->clients()`
- Public property `Management->client_grants` was made private, replaced by `Management->clientGrants()`
- Public property `Management->connections` was made private, replaced by `Management-> connections()`
- Public property `Management->deviceCredentials` was made private, replaced by `Management->deviceCredentials()`
- Public property `Management->emails` was made private, replaced by `Management->emails()`
- Public property `Management->emailTemplates` was made private, replaced by `Management->emailTemplates()`
- Public property `Management->grants` was made private, replaced by `Management->grants()`
- Public property `Management->jobs` was made private, replaced by `Management->jobs()`
- Public property `Management->logs` was made private, replaced by `Management->logs()`
- Public property `Management->roles` was made private, replaced by `Management->roles()`
- Public property `Management->rules` was made private, replaced by `Management->rules()`
- Public property `Management->resource_servers` was made private, replaced by `Management->resourceServers()`
- Public property `Management->stats` was made private, replaced by `Management->stats()`
- Public property `Management->tenants` was made private, replaced by `Management->tenants()`
- Public property `Management->tickets` was made private, replaced by `Management->tickets()`
- Public property `Management->userBlocks` was made private, replaced by `Management->userBlocks()`
- Public property `Management->users` was made private, replaced by `Management->users()`
- Public property `Management->usersByEmail` was made private, replaced by `Management->usersByEmail()`
- Public static property `Auth0::$URL_MAP` was removed
- Protected property `Auth0->stateHandler` was removed
- Protected property `Auth0->clientSecretEncoded` was removed
- Protected property `Auth0->debugMode` was removed
- Protected property `Auth0->debugger` was removed
- Protected property `SessionStore->session_cookie_expires` was removed
