![auth0-php](https://cdn.auth0.com/website/sdks/banners/auth0-php-banner.png)

PHP SDK for [Auth0](https://auth0.com) Authentication and Management APIs.

[![Package](https://img.shields.io/packagist/dt/auth0/auth0-php)](https://packagist.org/packages/auth0/auth0-php)[![Build Status](https://github.com/auth0/auth0-PHP/actions/workflows/tests.yml/badge.svg)](https://github.com/auth0/auth0-PHP/actions/workflows/tests.yml)[![Coverage](https://img.shields.io/codecov/c/github/auth0/auth0-PHP/main)](https://codecov.io/gh/auth0/auth0-PHP)[![License](https://img.shields.io/github/license/auth0/auth0-PHP)](https://doge.mit-license.org/)[![fern shield](https://img.shields.io/badge/%F0%9F%8C%BF-Built%20with%20Fern-brightgreen)](https://buildwithfern.com)

:books: [Documentation](#documentation) - :rocket: [Getting Started](#getting-started) - :computer: [API Reference](#api-reference) - :speech_balloon: [Feedback](#feedback)

## Documentation

We also have tailored SDKs for [Laravel](https://github.com/auth0/laravel-auth0), [Symfony](https://github.com/auth0/symfony), and [WordPress](https://github.com/auth0/wordpress). If you are using one of these frameworks, use the tailored SDK for the best integration experience.

- Quickstarts
  - [Application using Sessions (Stateful)](https://auth0.com/docs/quickstart/webapp/php) — Demonstrates a traditional web application that uses sessions and supports logging in, logging out, and querying user profiles. [The completed source code is also available.](https://github.com/auth0-samples/auth0-php-web-app)
  - [API using Access Tokens (Stateless)](https://auth0.com/docs/quickstart/backend/php) — Demonstrates a backend API that authorizes endpoints using access tokens provided by a frontend client and returns JSON. [The completed source code is also available.](https://github.com/auth0-samples/auth0-php-api-samples)
- [PHP Examples](./EXAMPLES.md) — Code samples for common scenarios.
- [Documentation Hub](https://www.auth0.com/docs) — Learn more about integrating Auth0 with your application.

## Getting Started

### Requirements

- PHP 8.2+
- [Composer](https://getcomposer.org/)
- PHP Extensions:
  - [mbstring](https://www.php.net/manual/en/book.mbstring.php)
- Dependencies:
  - [PSR-18 HTTP Client implementation](./FAQ.md#what-is-psr-18)
  - [PSR-17 HTTP Factory implementation](./FAQ.md#what-is-psr-17)
  - [PSR-7 HTTP Messages implementation](./FAQ.md#what-is-psr-7)

> Please review our [support policy](#support-policy) for details on our PHP version support.

### Installation

Ensure you have [the necessary dependencies](#requirements) installed, then add the SDK to your application using [Composer](https://getcomposer.org/):

```
composer require auth0/auth0-php:9.0.0-beta.0
```

> **Note:** This is a pre-release version. To install it, you must specify the exact version as shown above. Running `composer require auth0/auth0-php` without a version constraint will install the latest stable v8 release.

### Configure Auth0

Create a **Regular Web Application** in the [Auth0 Dashboard](https://manage.auth0.com/#/applications). Verify that the "Token Endpoint Authentication Method" is set to `POST`.

Next, configure the callback and logout URLs for your application under the "Application URIs" section of the "Settings" page:

- **Allowed Callback URLs**: The URL of your application where Auth0 will redirect to during authentication, e.g., `http://localhost:3000/callback`.
- **Allowed Logout URLs**: The URL of your application where Auth0 will redirect to after user logout, e.g., `http://localhost:3000/login`.

Note the **Domain**, **Client ID**, and **Client Secret**. These values will be used later.

### Add login to your application

Create a `SdkConfiguration` instance configured with your Auth0 domain and Auth0 application client ID and secret. Generate a sufficiently long, random string for your `cookieSecret` using `openssl rand -hex 32`. Create a new `Auth0` instance and pass your configuration to it.

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

$configuration = new SdkConfiguration(
    domain: 'Your Auth0 domain',
    clientId: 'Your Auth0 application client ID',
    clientSecret: 'Your Auth0 application client secret',
    cookieSecret: 'Your generated string',
);

$auth0 = new Auth0($configuration);
```

Use the `getCredentials()` method to check if a user is authenticated.

```php
// getCredentials() returns null if the user is not authenticated.
$session = $auth0->getCredentials();

if (null === $session || $session->accessTokenExpired) {
    // Redirect to Auth0 to authenticate the user.
    header('Location: ' . $auth0->login());
    exit;
}
```

Complete the authentication flow and obtain the tokens by calling `exchange()`:

```php
if (null !== $auth0->getExchangeParameters()) {
    $auth0->exchange();
}
```

Finally, you can use `getCredentials()?->user` to retrieve information about our authenticated user:

```php
print_r($auth0->getCredentials()?->user);
```

**That's it! You have successfully authenticated your first user with Auth0!** From here, you may want to try following along with [one of our quickstarts](#documentation) or browse through [our examples](./EXAMPLES.md) for additional insight and guidance.

If you have questions, the [Auth0 Community](https://community.auth0.com/) is a fantastic resource to ask questions and get help.

## Authentication API

The Authentication API handles user authentication flows. Initialize it with your Auth0 configuration:

```php
use Auth0\SDK\API\Authentication;
use Auth0\SDK\Configuration\SdkConfiguration;

$config = new SdkConfiguration(
    domain: 'your-tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
    redirectUri: 'http://localhost:3000/callback',
);

$auth = new Authentication($config);
```

### Common Operations

```php
// Get authorization URL for login
$loginUrl = $auth->getLoginLink(state: 'random-state-string');

// Exchange authorization code for tokens
$response = $auth->codeExchange(code: $_GET['code']);

// Get user profile with access token
$userInfo = $auth->userInfo(accessToken: $accessToken);

// Refresh an access token
$response = $auth->refreshToken(refreshToken: $refreshToken);

// Client credentials (M2M) authentication
$response = $auth->clientCredentials();

// Get logout URL
$logoutUrl = $auth->getLogoutLink(returnTo: 'http://localhost:3000');
```

### Database Connection Operations

```php
// Sign up a new user
$response = $auth->dbConnectionsSignup(
    email: 'user@example.com',
    password: 'SecurePassword123!',
    connection: 'Username-Password-Authentication',
);

// Request password change email
$response = $auth->dbConnectionsChangePassword(
    email: 'user@example.com',
    connection: 'Username-Password-Authentication',
);
```

## Management API Client

The `ManagementClient` wrapper provides a convenient way to interact with the Auth0 Management API with automatic token management. It wraps the generated `Management` client and handles authentication transparently — you get the same sub-client access (`->users`, `->roles`, etc.) without managing tokens yourself.

### Static Token

Use a pre-existing access token:

```php
use Auth0\SDK\API\Management\Wrapper\ManagementClient;
use Auth0\SDK\API\Management\Wrapper\ManagementClientOptions;

$client = new ManagementClient(new ManagementClientOptions(
    domain: 'your-tenant.auth0.com',
    token: 'YOUR_MGMT_TOKEN',
));

$users = $client->users->list();
```

### Client Credentials (M2M)

Provide client ID and secret to have the wrapper automatically fetch and refresh tokens via the OAuth 2.0 client credentials grant:

```php
$client = new ManagementClient(new ManagementClientOptions(
    domain: 'your-tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
));

// Tokens are fetched automatically on first API call and cached in memory.
// Expired tokens are re-fetched transparently.
$user = $client->users->get('auth0|123');
```

The audience defaults to `https://{domain}/api/v2/` but can be overridden:

```php
$client = new ManagementClient(new ManagementClientOptions(
    domain: 'your-tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
    audience: 'https://custom-audience.example.com/',
));
```

### Token Caching (PSR-6)

By default, tokens are cached in-memory and are lost when the PHP process ends. To persist tokens across requests (avoiding a client credentials grant on every request), pass any [PSR-6](https://www.php-fig.org/psr/psr-6/) cache implementation:

```php
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$cache = new FilesystemAdapter(namespace: 'auth0', defaultLifetime: 0, directory: '/tmp/auth0-cache');

$client = new ManagementClient(new ManagementClientOptions(
    domain: 'your-tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
    tokenCache: $cache,
));

// First request fetches a token and stores it in the cache.
// Subsequent requests (even in different PHP processes) reuse the cached token.
$user = $client->users->get('auth0|123');
```

Any PSR-6 `CacheItemPoolInterface` implementation works — for example `FilesystemAdapter`, `RedisAdapter`, `ApcuAdapter`, or `Memcached` from `symfony/cache`. The token TTL is set automatically based on the `expires_in` value from Auth0.

### Custom Token Provider

For full control over token acquisition, pass a callable that returns a token string:

```php
$client = new ManagementClient(new ManagementClientOptions(
    domain: 'your-tenant.auth0.com',
    tokenProvider: function (): string {
        // Fetch token from your own source (vault, database, etc.)
        return getTokenFromVault();
    },
));
```

### Additional Options

`ManagementClientOptions` accepts several optional parameters:

| Option | Type | Description |
|--------|------|-------------|
| `httpClient` | `ClientInterface` | Custom [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP client (e.g. Guzzle, Symfony HttpClient) |
| `timeout` | `float` | Request timeout in seconds |
| `maxRetries` | `int` | Maximum number of request retries |
| `additionalHeaders` | `array<string, string>` | Extra headers to include in requests |
| `tokenCache` | `CacheItemPoolInterface` | PSR-6 cache pool for persisting management tokens |

## Exception Handling

When the API returns a non-success status code (4xx or 5xx response), an exception will be thrown.

```php
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;

try {
    $response = $client->actions->create(...);
} catch (Auth0ApiException $e) {
    echo 'API Exception occurred: ' . $e->getMessage() . "\n";
    echo 'Status Code: ' . $e->getCode() . "\n";
    echo 'Response Body: ' . $e->getBody() . "\n";
    // Optionally, rethrow the exception or handle accordingly.
}
```

## Pagination

List endpoints return a `Pager<T>` which lets you loop over all items and the SDK will automatically make multiple HTTP requests for you.

```php
$items = $client->actions->list();

foreach ($items as $item) {
    var_dump($item);
}
```

You can also iterate page-by-page:

```php
foreach ($items->getPages() as $page) {
    foreach ($page->getItems() as $pageItem) {
        var_dump($pageItem);
    }
}
```

## Sending Explicit Nulls

When updating resources with PATCH endpoints, the SDK distinguishes between **omitting a field** (don't change it) and **sending `null`** (clear it). By default, `null` properties are omitted from the request body. To explicitly send a `null` value, use the setter method instead of passing it through the constructor:

```php
use Auth0\SDK\API\Management\Users\Requests\UpdateUserRequestContent;

// Constructor only: null properties are OMITTED from the request.
// This sends {"name": "Jane"} — email is not touched.
$request = new UpdateUserRequestContent([
    'name' => 'Jane',
    'nickname' => null,  // Omitted — nickname is not changed
]);

// Setter: null properties are INCLUDED in the request.
// This sends {"name": "Jane", "nickname": null} — nickname is cleared.
$request = new UpdateUserRequestContent(['name' => 'Jane']);
$request->setNickname(null);
```

Setters mark the property as explicitly set, so the serializer includes it even when the value is `null`. This works for any property on any request object, and setters can be chained:

```php
$request = (new UpdateUserRequestContent())
    ->setName('Jane')
    ->setNickname(null)    // Will send null — clears nickname
    ->setUserMetadata(null); // Will send null — clears user_metadata
```

## Advanced

### Custom Client

This SDK works with any [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP client. By default, the SDK auto-discovers an installed client using [HTTPlug Discovery](https://docs.php-http.org/en/latest/discovery.html). You can pass your own client that implements `Psr\Http\Client\ClientInterface`:

```php
use Auth0\SDK\API\Management\Management;

// Using Guzzle
$customClient = new \GuzzleHttp\Client(['timeout' => 5.0]);

$client = new Management(token: '<token>', options: [
    'client' => $customClient,
]);

// Using Symfony HttpClient
$customClient = new \Symfony\Component\HttpClient\Psr18Client(
    \Symfony\Component\HttpClient\HttpClient::create(['timeout' => 5.0])
);

$client = new Management(token: '<token>', options: [
    'client' => $customClient,
]);
```

The same `httpClient` option is available on `ManagementClientOptions` for the wrapper:

```php
use Auth0\SDK\API\Management\Wrapper\ManagementClient;
use Auth0\SDK\API\Management\Wrapper\ManagementClientOptions;

$client = new ManagementClient(new ManagementClientOptions(
    domain: 'your-tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
    httpClient: $customClient,
));
```

### Retries

The SDK is instrumented with automatic retries with exponential backoff. A request will be retried as long
as the request is deemed retryable and the number of retry attempts has not grown larger than the configured
retry limit (default: 2).

A request is deemed retryable when any of the following HTTP status codes is returned:

- [408](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/408) (Timeout)
- [429](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/429) (Too Many Requests)
- [5XX](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/500) (Internal Server Errors)

Use the `maxRetries` request option to configure this behavior.

```php
$response = $client->actions->create(
    ...,
    options: [
        'maxRetries' => 0 // Override maxRetries at the request level
    ]
);
```

### Timeouts

The SDK defaults to a 30 second timeout. Use the `timeout` option to configure this behavior.

```php
$response = $client->actions->create(
    ...,
    options: [
        'timeout' => 3.0 // Override timeout to 3 seconds
    ]
);
```

## Input from Untrusted Sources

If your application accepts input from untrusted sources (such as query parameters from HTTP requests) please ensure you are following best practices for data validation and sanitization. It is your application's responsibility to ensure any data provided to the SDK is valid and safe. For more information, see the [OWASP Data Validation Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Input_Validation_Cheat_Sheet.html).

## API Reference

- [API Reference](./reference.md)

## Support Policy

Our support lifecycle mirrors the [PHP release support schedule](https://www.php.net/supported-versions.php).

| SDK Version | PHP Version | Support Ends |
| ----------- | ----------- | ------------ |
| 9           | 8.4         | Dec 2028     |
|             | 8.3         | Dec 2027     |
|             | 8.2         | Dec 2026     |

We drop support for PHP versions when they reach end-of-life and cease receiving security fixes from the PHP Foundation. Please ensure your environment remains up to date so you can continue receiving updates for PHP and this SDK.

## Feedback

### Contributing

We appreciate feedback and contribution to this repo! Before you get started, please see the following:

- [Contribution Guide](./CONTRIBUTING.md)
- [Auth0's General Contribution Guidelines](https://github.com/auth0/open-source-template/blob/master/GENERAL-CONTRIBUTING.md)
- [Auth0's Code of Conduct Guidelines](https://github.com/auth0/open-source-template/blob/master/CODE-OF-CONDUCT.md)

> **Note:** The Management API client in this SDK is generated programmatically using [Fern](https://buildwithfern.com). Contributions to the Management API layer should be directed to the generation configuration rather than the generated source files. The Authentication API and all other SDK components are hand-written and accept direct contributions.

### Raise an issue

To provide feedback or report a bug, [please raise an issue on our issue tracker](https://github.com/auth0/auth0-PHP/issues).

### Vulnerability Reporting

Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

---

<p align="center">
  <picture>
    <source media="(prefers-color-scheme: light)" srcset="https://cdn.auth0.com/website/sdks/logos/auth0_light_mode.png" width="150">
    <source media="(prefers-color-scheme: dark)" srcset="https://cdn.auth0.com/website/sdks/logos/auth0_dark_mode.png" width="150">
    <img alt="Auth0 Logo" src="https://cdn.auth0.com/website/sdks/logos/auth0_light_mode.png" width="150">
  </picture>
</p>

<p align="center">Auth0 is an easy-to-implement, adaptable authentication and authorization platform.<br />To learn more, check out <a href="https://auth0.com/why-auth0">"Why Auth0?"</a></p>

<p align="center">This project is licensed under the MIT license. See the <a href="./LICENSE.md">LICENSE file</a> for more info.</p>