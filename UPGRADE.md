# Migration Guide

## Upgrading from v7.x → v8.0

Our version 8 release includes many significant improvements:

- Adoption of [modern PHP language features](https://stitcher.io/blog/new-in-php-74) including typed properties, null coalescing assignment operators, and array spreading.
- Support for custom [PSR-18](https://www.php-fig.org/psr/psr-18/) and [PSR-17](https://www.php-fig.org/psr/psr-17/) factories for customizing network requests. [PSR-7](https://www.php-fig.org/psr/psr-7/) responses are also now returned throughout the SDK.
- The codebase has been streamlined, offering a cleaner API and improved performance.
- [Fluent interface](https://en.wikipedia.org/wiki/Fluent_interface#PHP) throughout the SDK, offering simplified usage.
- Optional auto-pagination of Management API endpoints that support pagination.
- [PKCE](https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce) is now enabled by default.
- Improved JWT processing and fewer dependencies.

As is to be expected with a major release, there are breaking changes in this update. Please ensure you read this guide thoroughly and prepare your app before upgrading to SDK v8.

### New minimum PHP version: 7.4 (8.0 preferred)

- SDK v8.0 requires PHP 7.4 or higher. PHP 8.0 is supported, and its use with this library is preferred and strongly encouraged.
- 7.4 will be the final release in PHP's 7.x branch. This SDK will only support PHP 8.0+ after 7.4 leaves [supported status](https://www.php.net/supported-versions.php) in November 2022.
- We strongly encourage developers to make use of PHP 8.0's new [named arguments language feature](https://stitcher.io/blog/php-8-named-arguments). Once 7.4 support ends, we will no longer consider method argument order changes to be a breaking change.

### Configuring Auth0 SDK 8.0

Most classes throughout the SDK accept a new specialized configuration interface called SdkConfiguration:

```php
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

Developers can opt to pass an array to the base Auth0 SDK class, and a SdkConfiguration will be built:

```php
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

After initializing the Auth0 SDK with your configuration, you can keep a reference to the SdkConfiguration within your app so you can makes changes later. The SDK automatically recognize changes to your SdkConfiguration and use them.

```php
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

Some options names have been updated since v7 for clarity. It would be best if you referenced the SdkConfiguration constructor comments for an up-to-date list, as new additions may be added with later releases. At the time of this guide being written, however, these arguments are available:

```
string|null                   $domain               Required. Auth0 domain for your tenant.
string|null                   $clientId             Required. Client ID, found in the Auth0 Application settings.
string|null                   $redirectUri          Required. Authentication callback URI, as defined in your Auth0 Application settings.
string|null                   $clientSecret         Optional. Client Secret, found in the Auth0 Application settings.
array<string>|null            $audience             Optional. One or more API identifiers, found in your Auth0 API settings. The first supplied identifier will be used when generating links. If provided, at least one of these values must match the 'aud' claim to validate an ID Token successfully.
array<string>|null            $organization         Optional. One or more Organization IDs, found in your Auth0 Organization settings. The first supplied identifier will be used when generating links. If provided, at least one of these values must match the 'org_id' claim to validate an ID Token successfully.
bool                          $usePkce              Optional. Defaults to true. Use PKCE (Proof Key of Code Exchange) with Authorization Code Flow requests.
array<string>                 $scope                Optional. One or more scopes to request for Tokens.
string                        $responseMode         Optional. Defaults to 'query.' Where to extract request parameters from, either 'query' for GET or 'form_post' for POST requests.
string                        $responseType         Optional. Defaults to 'code.' Use 'code' for server-side flows and 'token' for application side flow
string                        $tokenAlgorithm       Optional. Defaults to 'RS256'. Algorithm to use for Token verification. Expects either 'RS256' or 'HS256'.
string|null                   $tokenJwksUri         Optional. URI to the JWKS when verifying RS256 tokens.
int|null                      $tokenMaxAge          Optional. The maximum window of time (in seconds) since the 'auth_time' to accept during Token validation.
int                           $tokenLeeway          Optional. Defaults to 60. Leeway (in seconds) to allow during time calculations with Token validation.
CacheInterface|null           $tokenCache           Optional. A PSR-16 compatible cache adapter for storing JSON Web Key Sets (JWKS).
int                           $tokenCacheTtl        Optional. How long (in seconds) to keep a JWKS cached.
ClientInterface|null          $httpClient           Optional. A PSR-18 compatible HTTP client to use for API requests.
RequestFactoryInterface|null  $httpRequestFactory   Optional. A PSR-17 compatible request factory to generate HTTP requests.
ResponseFactoryInterface|null $httpResponseFactory  Optional. A PSR-17 compatible response factory to generate HTTP responses.
StreamFactoryInterface|null   $httpStreamFactory    Optional. A PSR-17 compatible stream factory to create request body streams.
bool                          $httpTelemetry        Optional. Defaults to true. Whether API requests should include telemetry about the SDK and PHP runtime version, to help us improve our services.
StoreInterface|null           $sessionStorage       Optional. Defaults to use PHP native sessions. A StoreInterface-compatible class for storing Token state.
bool                          $persistUser          Optional. Defaults to true. Whether data about the user should be persisted to session storage.
bool                          $persistIdToken       Optional. Defaults to true. Whether data about the ID Token should be persisted to session storage.
bool                          $persistAccessToken   Optional. Defaults to true. Whether data about the Access Token should be persisted to session storage.
bool                          $persistRefreshToken  Optional. Defaults to true. Whether data about the Refresh Token should be persisted to session storage.
StoreInterface|null           $transientStorage     Optional. Defaults to use cookies. A StoreInterface-compatible class for storing ephemeral state data, such as a nonce.
bool                          $queryUserInfo        Optional. Defaults to false. Whether to query the /userinfo endpoint during an authorization code exchange.
string|null                   $managementToken      Optional. A Management API Access Token. If not provided and the Management API is invoked, one will attempt to be generated for you using your provided credentials. This requires a $clientSecret to be provided.
```

### Authentication and Management Factories

SDK v8 offers a cleaner approach of accessing the Authentication and Management API classes without having to reconfigure them independently: configure the base Auth0 SDK class, and use the factory methods to configure these classes for you:

```php
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

### PSR-18 and PSR-17 factories

Previous versions of the SDK had a hard dependency on Guzzle for issuing network requests. SDK v8 uses a more modern approach of accepting developer-supplied PSR-18 and PSR-17 factory interfaces for making these requests. We strongly encourage you to pass the factories of your choice during SDK configuration. Still, if none are provided, the SDK will make a best-effort attempt at auto-discovering any available options already present in your application.

As an example, let's say your application is already incorporating [Buzz](https://github.com/kriswallsmith/Buzz) and [Nylom's PSR-7 implementation](https://github.com/Nyholm/psr7), which includes PSR-18 and PSR-17 factories, respectively. Pass these to the SDK to use them for Auth0 network requests as well:

```php
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

The libraries specified above are simply examples: any PSR-18 and PSR-17 compliant libraries can be used, including Guzzle.

### Using PSR-7 responses

Most functions that issue network requests now return PSR-7 response objects, which allow you a greater deal of control over handling the response, such as troubleshooting errors and analyzing headers. We've included a utility class for simplifying working with these responses in general use cases:

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Utility\HttpResponse;

$auth0 = new Auth0(/* ...configuration */);

$response = $auth0->management()->users()->getAll();

if (HttpResponse::wasSuccessful($response)) { // Checks that the status code was 200
    $users = HttpResponse::decodeContent($response); // Parses the response body as JSON and returns the resulting object
    print_r($users);

    $headers = HttpResponse::getHeaders($response); // Get an array containing all the headers attached to the response.
    print_r($headers);
}
```

Alternatively, you can achieve the same results with the native PSR-7 standard API without using the HttpResponse helper:

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Utility\HttpResponse;

$auth0 = new Auth0(/* ...configuration */);

$response = $auth0->management()->users()->getAll();

if ($response->getStatusCode() === 200) {
    print_r(json_decode($response->getBody()->__toString(), true, 512, JSON_THROW_ON_ERROR));
    print_r($response->getHeaders());
}
```

### New field filtering and pagination interface

A new argument has been added to most network endpoints, accepting a new RequestOptions type. RequestOptions allows you to specify field-filtered and paginated requests easily:

```php
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

### Auto-pagination support available

You can use the new HttpResponsePaginator utility with endpoints that support pagination to return a PHP-native iterator type, which will automatically request new pages of results as you loop through it.

```php
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

### Auth0::getState() now silently returns session data

In 7.x, `Auth0::getState` was a method for pulling the 'state' parameter from the query string or form submission body. This functionality has been replaced by the generic `Auth0::getRequestParameter()` method in SDK 8.0.

In 8.x, `Auth0::getState` is a convenience function that returns the available Id Token, Access Token, Access Token expiration timestamp, and Refresh Token (if one is available) when they are available from storage. It also offers accessTokenExpired, which you can more easily compare to decide if you need to renew or prompt to login back in.

This essentially saves you the need for calling getIdToken(), getUser(), getAccessToken(), getRefreshToken() and getAccessTokenExpiration() separately. Also, unlike these functions, getState() will not throw an error if any of these are available, it will simply return a null value. Example usage:

```php
use Auth0\SDK\Auth0;

$sdk = new Auth0(/* ... configuration */);

// If we've just returned from the callback, remove the ?code parameter from the query by redirecting to index route.
if ($sdk->getRequestParameter('code')) {
  header("Location: /");
  exit;
}

// Use the new helper to silently get state.
$state = $sdk->getState();

// If there's no session, begin authentication flow. Alternatively you could render the app in guest mode, or offer a login interstitial, etc.
if (! $state) {
   $sdk->login();
}

// We have a session available.
if ($state) {
  // If the access token has expired, try to renew it.
  if ($state->accessTokenExpired) {
    try {
      $sdk->renew();
    } catch (\Auth0\SDK\Exception\StateException $exception) {
      // Couldn't renew the token, we might not have one based on our requested scopes. Let's fallback to starting a fresh authentication flow.
      $sdk->login();
    }
  }

  // Everything is good. Let's echo info about the user as an example.
  print_r($state->user);
}
```

---

## Upgrading from v5.x → v7.x

The v7 major release adds some new features, removes several deprecated methods and classes, and changes how some applications need to be configured. Please read through this guide to make sure your application is up to date before upgrading to v7.

Only potentially breaking changes are covered in this guide. For a list of all changes for this major, see [the 7.0.0 milestone on GitHub](https://github.com/auth0/auth0-PHP/issues?q=is%3Aclosed+milestone%3A7.0.0).

### New minimum PHP version: 7.1

The v7 release requires PHP 7.1 or later to enable a number of helpful features like type hinting and null coalescing.

### Auth0 class configuration changes

A number of breaking changes were made to the `Auth0` class configuration passed in at initialization.

The main breaking change is only for applications that accept HS256 ID tokens. If your application is set to accept ID tokens signed using the HS256 algorithm, we recommend changing that to `RS256` in the Auth0 Application > Settings tab > Advanced settings > OAuth tab > JsonWebToken Signature Algorithm field before upgrading and leaving the `id_token_alg` configuration key unset. If your application cannot be changed for some reason, set the `id_token_alg` configuration key to `HS256`, like so:

```php
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
