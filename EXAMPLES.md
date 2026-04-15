# Auth0 PHP SDK Examples

- [Strategy configurations](#strategy-configurations)
- [Logging out](#logging-out)
- [Using refresh tokens](#using-refresh-tokens)
- [Authentication API](#authentication-api)
- [Management API](#management-api)
- [Manually decoding tokens](#manually-decoding-tokens)
- [Organizations](#organizations)
- [Using PSR-17 and PSR-18 factories](#using-psr-17-and-psr-18-factories)
- [Cookies session storage](#cookies-session-storage)
- [PHP session storage](#php-session-storage)

## Strategy configurations

You should define the type of application you're integrating with the SDK using the `strategy` parameter.

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

$configuration = new SdkConfiguration(
    strategy: SdkConfiguration::STRATEGY_API,
);

$auth0 = new Auth0($configuration);
```

Available choices are:

- `SdkConfiguration::STRATEGY_REGULAR` (Default) — for stateful applications. Requires `domain`, `clientId` and `cookieSecret` also be configured.
- `SdkConfiguration::STRATEGY_API` — for stateless applications. Requires `domain` and `audience` also be configured.
- `SdkConfiguration::STRATEGY_MANAGEMENT_API` — for stateless applications that only interact with the Management API. Requires either `managementToken` or `clientId` and `clientSecret` to also be configured.

## Logging out

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

$configuration = new SdkConfiguration(
    domain: '...',
    clientId: '...',
    clientSecret: '..',
    cookieSecret: '...',
);

$auth0 = new Auth0($configuration);

if ($auth0->getCredentials()) {
    header('Location: ' . $auth0->logout());
    exit;
}
```

## Using refresh tokens

```PHP
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

$configuration = new SdkConfiguration(
    domain: '...',
    clientId: '...',
    clientSecret: '..',
    cookieSecret: '...',
);

// The `offline_access` scope is required to retrieve a refresh token.
$configuration->pushScope('offline_access');

$auth0 = new Auth0($configuration);

$session = $auth0->getCredentials();

if (null !== $session && $session->accessTokenExpired) {
    $auth0->renew();
}
```

## Authentication API

Use `Auth0->authentication()` to access more advanced Authentication API calls. For example:

```PHP
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

$configuration = new SdkConfiguration(
    domain: '...',
    clientId: '...',
    clientSecret: '..',
    cookieSecret: '...',
);

$auth0 = new Auth0($configuration);
$api = $auth0->authentication();

$api->emailPasswordlessStart(
  email: 'someone@somewhere.com',
);
```

## Management API

Use the `ManagementClient` wrapper for automatic token management when interacting with the Management API.

### Setup

```php
use Auth0\SDK\API\Management\Wrapper\ManagementClient;
use Auth0\SDK\API\Management\Wrapper\ManagementClientOptions;

$client = new ManagementClient(new ManagementClientOptions(
    domain: 'your-tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
));
```

### Listing users

```php
use Auth0\SDK\API\Management\Users\Requests\ListUsersRequestParameters;

$pager = $client->users->list(new ListUsersRequestParameters([
    'page' => 0,
    'perPage' => 10,
    'includeTotals' => true,
]));

foreach ($pager as $user) {
    echo $user->getEmail() . "\n";
}
```

### Getting a user

```php
$user = $client->users->get('auth0|123');

echo $user->getEmail();
echo $user->getName();
```

### Creating a user

```php
use Auth0\SDK\API\Management\Users\Requests\CreateUserRequestContent;

$user = $client->users->create(new CreateUserRequestContent([
    'email' => 'user@example.com',
    'password' => 'SecurePassword123!',
    'connection' => 'Username-Password-Authentication',
    'name' => 'John Doe',
]));

echo $user->getUserId();
```

### Updating a user

```php
use Auth0\SDK\API\Management\Users\Requests\UpdateUserRequestContent;

$updated = $client->users->update(
    id: 'auth0|123',
    content: new UpdateUserRequestContent([
        'nickname' => 'Johnny',
    ]),
);
```

### Deleting a user

```php
$client->users->delete('auth0|123');
```

### Pagination

All list endpoints return a `Pager` that handles pagination automatically:

```php
$pager = $client->users->list();

// Iterate through all items across all pages
foreach ($pager as $user) {
    echo $user->getEmail() . "\n";
}

// Or iterate page-by-page
foreach ($pager->getPages() as $page) {
    foreach ($page->getItems() as $user) {
        echo $user->getEmail() . "\n";
    }
}
```

### Error handling

```php
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;

try {
    $user = $client->users->get('invalid-id');
} catch (Auth0ApiException $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
    echo 'Status: ' . $e->getCode() . "\n";
    echo 'Body: ' . $e->getBody() . "\n";
}
```

For the complete endpoint reference, see [reference.md](./reference.md).

## Manually decoding tokens

```PHP
use Auth0\SDK\Auth0;
use Auth0\SDK\Token;
use Auth0\SDK\Configuration\SdkConfiguration;

$configuration = new SdkConfiguration(
    domain: '...',
    clientId: '...',
    clientSecret: '..',
    cookieSecret: '...',
);

$auth0 = new Auth0($configuration);

$token = $auth0->decode(
  token: '...',
  tokenType: Token::TYPE_ACCESS_TOKEN,
);

print_r($token);
```

## Organizations

Configure one or more [Organization](https://auth0.com/docs/organizations) IDs. Authentication will use the first configured Orgaization ID by default.

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

$configuration = new SdkConfiguration(
    organization: ['org_1', 'org_2', 'org_...'],
);

$auth0 = new Auth0($configuration);
$session = $auth0->getCredentials();

if (null === $session || $session->accessTokenExpired) {
    // Begin the authentication flow using `org_1`:
    header('Location: ' . $auth0->login());
    exit;
}
```

You can process incoming organization invites from visitors by using the `Auth0->handleInvitation()` method.

For more advanced cases, you can use the `Auth0->getInvitationParameters()` methods to retrieve invitation data from the request.

## Using PSR-17 and PSR-18 factories

Install PSR-17 and PSR-18 compatible libraries:

```
composer require kriswallsmith/buzz nyholm/psr7
```

Pass instances of those to the SDK during initialization:

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Buzz\Client\MultiCurl;
use Nyholm\Psr7\Factory\Psr17Factory;

$Psr17Library = new Psr17Factory();
$Psr18Library = new MultiCurl($Psr17Library);

$configuration = new SdkConfiguration(
    httpClient: $Psr18Library,
    httpRequestFactory: $Psr17Library,
    httpResponseFactory: $Psr17Library,
    httpStreamFactory: $Psr17Library,
);

$auth0 = new Auth0($configuration);
```

## Cookies session storage

Session data can be stored on authenticated user's devices:

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\CookieStore;

$configuration = new SdkConfiguration(
    strategy: SdkConfiguration::STRATEGY_REGULAR,
);

$cookies = new CookieStore($this, 'example_storage');

$configuration->setSessionStorage($cookies);

$auth0 = new Auth0($configuration);
```

The following options must also be configured to use a `CookieStore`:

- [`strategy`](#strategy-configuration) must be `SdkConfiguration::STRATEGY_REGULAR`.
- `cookieSecret` — an encryption key for the session cookie.
- `cookieDomain` — when sharing session cookies across multiple subdomains, use your FQDN with a dot in front, e.g. `.yourdomain.com`.
- `cookieExpires` — the expiration time (in seconds) for the session cookie.
- `cookiePath` — path to use for the session cookie.
- `cookieSecure` — whether cookies should only be sent over secure connections.

## PHP session storage

Session data can be stored in a combination of server side and user's devices:

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\SessionStore;

$configuration = new SdkConfiguration(
    strategy: SdkConfiguration::STRATEGY_REGULAR,
);

$cookies = new SessionStore($this, 'example_storage');

$configuration->setSessionStorage($cookies);

$auth0 = new Auth0($configuration);
```

As state data is stored on the server-side in this configuration, it's important to configure any load balanced PHP environments to use a shared storage method like `memcache`.