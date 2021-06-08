# Migration Guide for v5 to v7

The v7 major release adds some new features, removes a number of deprecated methods and classes, and changes how some applications need to be configured. Please read through this guide to make sure your application is up to date before upgrading to v7.

Only potentially breaking changes are covered in this guide. For a list of all changes for this major, see [the 7.0.0 milestone on GitHub](https://github.com/auth0/auth0-PHP/issues?q=is%3Aclosed+milestone%3A7.0.0).

## PHP version increase

The v7 release requires PHP 7.1 or later to enable a number of helpful features like type hinting and null coalescing.

## Auth0 class configuration changes

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

The `id_token_aud` and `id_token_iss` configuration keys have been removed and their values will now be ignored.

The `state_handler` configuration key has been removed and the `transient_store` configuration key has been added. See the **State and nonce handling** section below for more information about the changes with state handling.

The ability to pass `false` in the `store` configuration key has been removed. Set `store` to an instance of `EmptyStore` or set all `persist_*` configuration keys to `false` to skip all persistence.

The `cache_handler` configuration key must now be an instance of `Psr\SimpleCache\CacheInterface`. See the **Cache handling** section below for more information.

The default `secret_base64_encoded` value is now `false` and is no longer stored in a property. 

The `client_secret` configuration key is no longer required for class initialization (but will throw an exception in certain methods when required). If `secret_base64_encoded` is set to `true` then then the `clientSecret` property will now contain the decoded secret. If your Application is using an encoded secret, this encoding can be turned off tby rotating the client secret in the Auth0 Application settings.

The `session_cookie_expires` configuration key has been removed. The session cookie expiration should be managed in the application. If you were using this setting before, [see the PHP core function session\_set\_cookie\_params()](https://www.php.net/manual/en/function.session-set-cookie-params.php) to set this value after upgrading.

The `session_base_name` configuration key has been removed. Instead, pass an instance of `StoreInterface` in the `store` configuration key with the modified name.

The `skip_userinfo` configuration key now defaults to `true`. This means that the persisted user identity will now come from the ID token rather than a call to the userinfo endpoint. This can be set to `false` to return to the behavior in v5.

The ENV variables `AUTH0_DOMAIN`, `AUTH0_CLIENT_ID`, and `AUTH0_REDIRECT_URI` will now be used automatically for the `domain`, `client_id`, and `redirect_uri` configuration keys, respectively.

The `debug` configuration key was removed.

## Cache handling

Cache handling has been changed in v7 to conform to the PSR-16 standard (see the discussion [here](https://github.com/auth0/auth0-PHP/issues/282)). Objects passed to the `cache_handler` configuration key in `Auth0` and the first parameter of the `JWKFetcher` class should be instances of `Psr\SimpleCache\CacheInterface`.

## State and nonce handling

The handling for transient authentication data, such as `state` and `nonce`, has been changed. 

In an effort to enforce security standards set forth in the OAuth and OpenID Connect specifications, `state` checking on the callback route and `nonce` checking for all received ID tokens is now mandatory. Applications that require IdP-initiated sign-on should add a login route that uses `Auth0->getLoginUrl()` to redirect through Auth0 with valid state and nonce values. The URL to this route should be saved to the **Application Login URI** field in your Auth0 Application to assist with this scenario.

The handling for these values was changed from PHP session-stored values to cookies using the new `CookieStore` class. This was done so PHP session usage was not required and to assist with applications using a `form_post` reponse mode. This change may require server-level whitelisting of cookie names (`auth0__nonce` and `auth0__state` by default) on some managed hosts. The `transient_store` configuration key in the `Auth0` class can be used to switch back to PHP sessions or provide another method.

The default state key was changed from `auth0__webauth_state` to `auth0__state`.

## Classes and Interfaces removed

The following classes were removed in v7:

- Class `Firebase\JWT\JWT` provided by the `firebase/php-jwt` package was replaced with classes from the `lcobucci/jwt` package
- Class `JWTVerifier` was removed, see the `Auth0->decodeIdToken()` method for how to use the replacement classes
- Class `StateHandler` was removed, see the **State and nonce handling** section above for more information
- Class `SessionStateHandler` was removed, see the **State and nonce handling** section above for more information
- Class `DummyStateHandler` was removed, see the **State and nonce handling** section above for more information
- Interface `CacheHandler` was removed, see the **Cache handling** section above for more information
- Class `FileSystemCacheHandler` was removed, see the **Cache handling** section above for more information
- Class `TokenGenerator` was removed, no replacement provided
- Class `Oauth2Client` was removed, no replacement provided
- Class `Auth0Api` was removed, no replacement provided
- Class `Auth0AuthApi` was removed, no replacement provided
- Class `Auth0JWT` was removed, no replacement provided

## Classes changes

The following class constructors were changed in v7:

- Class `Authentication` now requires a `client_id` parameter
- Class `NoCacheHandler` now implements `Psr\SimpleCache\CacheInterface`
- Class `JWKFetcher` now requires an instance of `Psr\SimpleCache\CacheInterface` as the first construct parameter
- Class constant `SessionStore::COOKIE_EXPIRES` was removed
- Class `SessionStore` no longer accepts a 2nd constructor argument to adjust the session cookie expiration; [see the PHP core function session\_set\_cookie\_params()](https://www.php.net/manual/en/function.session-set-cookie-params.php) to set this value in v7
- Class `Auth0\SDK\API\Header\Authorization\AuthorizationBearer` was changed to `Auth0\SDK\API\Header\AuthorizationBearer`

## Methods changed

The following methods were changed in a breaking way in v7:

- Public method `RequestBuilder->withHeader()` now only accepts a `Header` instance as an argument.
- Public method `Authentication->code_exchange()` now throws an `ApiException` if class-level `client_secret` is empty
- Public method `Authentication->client_credentials()` now throws an `ApiException` if `audience` is empty
- Public method `Authentication->get_authorize_link()` now adds class-level `scope` and `audience` if none are passed in

## Methods removed

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

## Class properties removed

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
