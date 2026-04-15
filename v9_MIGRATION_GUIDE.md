# V9 Migration Guide

A guide to migrating the Auth0 PHP SDK from `auth0-PHP` (v8.x) to `auth0-php-sdk` (v9.x).

- [Overview](#overview)
  - [Authentication API](#authentication-api)
  - [Management API](#management-api)
- [ManagementClient Wrapper](#managementclient-wrapper)
  - [Client Credentials with Automatic Token Management](#client-credentials-with-automatic-token-management)
  - [Token Caching (PSR-6)](#token-caching-psr-6)
  - [Other Authentication Modes](#other-authentication-modes)
- [Breaking Changes](#breaking-changes)
  - [PHP Version](#php-version)
  - [Namespace Changes](#namespace-changes)
  - [Client Initialization](#client-initialization)
  - [Renamed Endpoints](#renamed-endpoints)
  - [Method Name Changes](#method-name-changes)
  - [Request and Response Types](#request-and-response-types)
  - [Pagination](#pagination)
  - [Error Handling](#error-handling)
  - [Sending Explicit Nulls](#sending-explicit-nulls)
- [Migration Steps](#migration-steps)
- [Examples](#examples)
  - [User Management](#user-management)
  - [Client Management](#client-management)
  - [Connection Management](#connection-management)
  - [Role Management](#role-management)

## Overview

### Authentication API

This major version change does not affect the Authentication API. Any code written for the Authentication API in the v8.x version should work in the v9.x version with minimal changes.

### Management API

V9 introduces significant improvements to the Management API SDK by migrating to [Fern](https://github.com/fern-api/fern) as our code generation tool. This provides:

- **Generated from OpenAPI**: v9 is generated from Auth0's OpenAPI specifications, ensuring consistency and accuracy
- **Improved Type Safety**: Strongly typed request/response structures with proper validation
- **Better Organization**: Sub-resources are organized into dedicated sub-clients
- **Enhanced Pagination**: Automatic pagination through `Pager` objects
- **Consistent Naming**: Methods follow a consistent pattern (`list`, `create`, `get`, `update`, `delete`)

## ManagementClient Wrapper

In v8, the `SdkConfiguration` class handled client credentials automatically — you passed `clientId` and `clientSecret`, and the SDK fetched management tokens for you behind the scenes. The generated v9 `Management` client does not do this; it requires a static token string.

The `ManagementClient` wrapper restores the v8 experience with automatic token management, while giving you access to all the same v9 sub-clients (`->users`, `->roles`, etc.).

### Client Credentials with Automatic Token Management

<table>
<tr>
<th>v8 (SdkConfiguration)</th>
<th>v9 (ManagementClient)</th>
</tr>
<tr>
<td>

```php
use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;

$config = new SdkConfiguration(
    domain: 'tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
);

$management = new Management($config);
$users = $management->users()->getAll();
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Wrapper\ManagementClient;
use Auth0\SDK\API\Management\Wrapper\ManagementClientOptions;

$client = new ManagementClient(new ManagementClientOptions(
    domain: 'tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
));

$users = $client->users->list();
```

</td>
</tr>
</table>

The `ManagementClient` automatically fetches a token via the client credentials grant on the first API call, caches it in memory, and re-fetches it when it expires.

### Token Caching (PSR-6)

In v8, `SdkConfiguration` accepted a PSR-6 `CacheItemPoolInterface` to persist management tokens across requests. The v9 `ManagementClient` supports this via the `tokenCache` option:

<table>
<tr>
<th>v8 (SdkConfiguration cache)</th>
<th>v9 (ManagementClient tokenCache)</th>
</tr>
<tr>
<td>

```php
use Auth0\SDK\Configuration\SdkConfiguration;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$cache = new FilesystemAdapter();

$config = new SdkConfiguration(
    domain: 'tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
    tokenCache: $cache,
);

$management = new Management($config);
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Wrapper\ManagementClient;
use Auth0\SDK\API\Management\Wrapper\ManagementClientOptions;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$cache = new FilesystemAdapter();

$client = new ManagementClient(new ManagementClientOptions(
    domain: 'tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
    tokenCache: $cache,
));
```

</td>
</tr>
</table>

Any PSR-6 `CacheItemPoolInterface` implementation works. The token TTL is set automatically based on the `expires_in` value from Auth0. Without a `tokenCache`, tokens are cached in-memory only and a new client credentials grant is performed on each PHP request.

### Other Authentication Modes

The `ManagementClient` also supports static tokens and custom token provider callables, so it can replace the generated `Management` client in all scenarios:

```php
// Static token
$client = new ManagementClient(new ManagementClientOptions(
    domain: 'tenant.auth0.com',
    token: 'YOUR_MGMT_TOKEN',
));

// Custom token provider
$client = new ManagementClient(new ManagementClientOptions(
    domain: 'tenant.auth0.com',
    tokenProvider: fn (): string => getTokenFromVault(),
));
```

## Breaking Changes

### PHP Version

The minimum PHP version has been raised from 8.1 to 8.2, and an upper bound has been added.

| | v8 | v9 |
|---|---|---|
| **PHP** | `^8.1` | `>=8.2 <8.5` |

Ensure your environment is running PHP 8.2 or later before upgrading.

### Namespace Changes

The Management API client namespace has changed.

<table>
<tr>
<th>v8 (auth0-PHP)</th>
<th>v9 (auth0-php-sdk)</th>
</tr>
<tr>
<td>

```php
use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Management;
use Auth0\SDK\API\Management\Users\Requests\CreateUserRequestContent;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
```

</td>
</tr>
</table>

### Client Initialization

The way you initialize the Management client has changed significantly.

<table>
<tr>
<th>v8 Initialization</th>
<th>v9 Initialization</th>
</tr>
<tr>
<td>

```php
use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;

$config = new SdkConfiguration(
    domain: 'your-tenant.auth0.com',
    clientId: 'YOUR_CLIENT_ID',
    clientSecret: 'YOUR_CLIENT_SECRET',
    managementToken: 'YOUR_MGMT_TOKEN',
);

$management = new Management($config);

// Access via factory methods
$users = $management->users();
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Management;

$management = new Management(
    token: 'YOUR_MGMT_TOKEN',
);

// Access via public properties
$users = $management->users;
```

</td>
</tr>
</table>

### Renamed Endpoints

Some top-level endpoint accessors have been renamed or merged in v9:

| v8 | v9 | Notes |
|---|---|---|
| `$management->grants()` | `$management->userGrants` | Renamed |
| `$management->usersByEmail()` | `$management->users->listUsersByEmail()` | Merged into Users |

Search your codebase for `->grants()` and `->usersByEmail()` and update accordingly.

### `getAll()` Renamed to `list()`

Every `getAll()` method across all endpoints has been renamed to `list()`. This is a global rename — it applies to users, clients, connections, roles, organizations, and every other resource:

```php
// v8
$management->users()->getAll([...]);
$management->clients()->getAll([...]);
$management->roles()->getAll([...]);

// v9
$management->users->list(...);
$management->clients->list(...);
$management->roles->list(...);
```

Search your codebase for `->getAll(` to find all call sites that need updating.

### Method Name Changes

Beyond the `getAll()` → `list()` rename, sub-resource operations have moved from methods on the parent client to dedicated sub-clients. The pattern is `->resource->subResource->method()`:

| v8 Method | v9 Method |
|-----------|-----------|
| `users()->getRoles($id)` | `users->roles->list($id)` |
| `users()->addRoles($id, $roles)` | `users->roles->assign($id, $request)` |
| `users()->removeRoles($id, $roles)` | `users->roles->delete($id, $request)` |
| `users()->getPermissions($id)` | `users->permissions->list($id)` |
| `users()->addPermissions($id, $perms)` | `users->permissions->create($id, $request)` |
| `users()->removePermissions($id, $perms)` | `users->permissions->delete($id, $request)` |
| `users()->getLogs($id)` | `users->logs->list($id)` |
| `users()->getOrganizations($id)` | `users->organizations->list($id)` |
| `users()->getEnrollments($id)` | `users->enrollments->get($id)` |
| `users()->getSessions($id)` | `users->sessions->list($id)` |
| `users()->deleteSessions($id)` | `users->sessions->delete($id)` |
| `users()->getAuthenticationMethods($id)` | `users->authenticationMethods->list($id)` |
| `users()->linkAccount($id, $body)` | `users->identities->link($id, $request)` |
| `users()->unlinkAccount($id, ...)` | `users->identities->delete($id, ...)` |
| `clients()->getCredentials($id)` | `clients->credentials->list($id)` |
| `roles()->getPermissions($id)` | `roles->permissions->list($id)` |
| `roles()->getUsers($id)` | `roles->users->list($id)` |
| `organizations()->getMembers($id)` | `organizations->members->list($id)` |

### Request and Response Types

V9 fundamentally changes how you interact with API responses. In v8, Management API methods returned raw PSR-7 `ResponseInterface` objects, requiring you to manually decode JSON and check for success:

```php
// v8: Two-step process — get response, then decode it
$response = $management->users()->get($userId);

if (! HttpResponse::wasSuccessful($response)) {
    // Handle error manually
}

$user = HttpResponse::decodeContent($response);  // Returns associative array
echo $user['email'];                              // Array access
```

In v9, **the SDK handles all of this for you**. Methods return fully typed PHP objects — the JSON is already deserialized, and errors throw exceptions instead of returning error responses. There is no `ResponseInterface` to decode:

```php
// v9: Single step — the return value IS your data
$user = $management->users->get($userId);  // Returns CreateUserResponseContent
echo $user->getEmail();                    // Typed getter methods
```

**If you are migrating from v8, you should:**

1. **Remove all `HttpResponse::decodeContent()` calls** on Management API responses — the return value is already your data, not a raw HTTP response. Passing a typed response object to `decodeContent()` will fail because it is not a `ResponseInterface`.
2. **Remove all `HttpResponse::wasSuccessful()` checks** — v9 throws `Auth0ApiException` on error responses (4xx/5xx) instead of returning them. If the method returns without throwing, the request succeeded.
3. **Replace array access with getter methods** — responses are objects, not associative arrays. Use `$user->getEmail()` instead of `$user['email']`.

> **Note:** The `HttpResponse` utility class still exists in `Auth0\SDK\Utility\HttpResponse` and is used internally by the SDK (e.g., for Authentication API flows). However, Management API methods no longer return `ResponseInterface`, so you should not use `HttpResponse` to process their return values.

Request bodies have also changed from arrays to typed objects, and array keys have changed from **snake_case** to **camelCase** (e.g., `user_metadata` → `userMetadata`, `per_page` → `perPage`). See the [Examples](#examples) section for complete before/after comparisons.

> **Important: Array constructors, not named parameters.** All request objects (`*RequestParameters` and `*RequestContent` classes) accept a single **associative array** in their constructor — not PHP named parameters. This is a common source of confusion:
>
> ```php
> // WRONG — PHP named parameters do not work
> new ListUsersRequestParameters(perPage: 5);
>
> // CORRECT — pass an associative array
> new ListUsersRequestParameters(['perPage' => 5]);
> ```
>
> The same applies to all request and type objects throughout the SDK:
>
> ```php
> // WRONG
> new CreateUserRequestContent(connection: 'auth0', email: 'user@example.com');
>
> // CORRECT
> new CreateUserRequestContent(['connection' => 'auth0', 'email' => 'user@example.com']);
> ```
>
> Alternatively, you can use the fluent setter methods:
>
> ```php
> $request = (new ListUsersRequestParameters())
>     ->setPerPage(5)
>     ->setSort('created_at:1');
> ```

### Pagination

V8 required manual pagination handling. V9 provides automatic pagination through `Pager` objects.

<table>
<tr>
<th>v8 Manual Pagination</th>
<th>v9 Automatic Pagination</th>
</tr>
<tr>
<td>

```php
// Manual pagination
$page = 0;
$allUsers = [];

do {
    $response = $management->users()->getAll([
        'page' => $page,
        'per_page' => 50,
        'include_totals' => true,
    ]);

    $data = HttpResponse::decodeContent($response);
    $allUsers = array_merge($allUsers, $data['users']);
    $page++;
} while (count($allUsers) < $data['total']);

// Or using HttpResponsePaginator
$paginator = $management->getResponsePaginator();
foreach ($paginator->users()->getAll() as $user) {
    echo $user['email'];
}
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Users\Requests\ListUsersRequestParameters;

// Automatic pagination - just iterate
$users = $management->users->list(
    new ListUsersRequestParameters(['perPage' => 50])
);
foreach ($users as $user) {
    echo $user->getEmail();
}

// Or iterate page-by-page
foreach ($users->getPages() as $page) {
    foreach ($page->getItems() as $user) {
        echo $user->getEmail();
    }
}
```

</td>
</tr>
</table>

### Error Handling

V9 introduces a unified error handling pattern with `Auth0Exception` and `Auth0ApiException`.

<table>
<tr>
<th>v8 Error Handling</th>
<th>v9 Error Handling</th>
</tr>
<tr>
<td>

```php
use Auth0\SDK\Exception\NetworkException;
use Auth0\SDK\Exception\ArgumentException;

try {
    $response = $management->users()->get($userId);

    if (!HttpResponse::wasSuccessful($response)) {
        $error = HttpResponse::decodeContent($response);
        throw new \Exception($error['message']);
    }
} catch (NetworkException $e) {
    echo "Network error: " . $e->getMessage();
} catch (ArgumentException $e) {
    echo "Invalid argument: " . $e->getMessage();
}
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;

try {
    $user = $management->users->get($userId);
} catch (Auth0ApiException $e) {
    // API returned an error response
    echo "Status: " . $e->getCode();
    echo "Message: " . $e->getMessage();
    echo "Body: " . $e->getBody();
} catch (Auth0Exception $e) {
    // SDK/network error
    echo "Error: " . $e->getMessage();
}
```

</td>
</tr>
</table>

### Sending Explicit Nulls

V9 introduces a distinction between **omitting a field** and **explicitly sending `null`**, which is important for PATCH/update operations. In v8, you controlled this by including or excluding array keys. In v9, the constructor and setters behave differently:

- **Constructor** — `null` properties are **omitted** from the serialized JSON (the field is not sent, so the API does not change it).
- **Setter methods** — `null` properties are **included** in the JSON as `null` (the API receives the field and clears it).

This is a new concept with no direct v8 equivalent, since v8 used plain arrays where you simply omitted a key to leave a field unchanged.

<table>
<tr>
<th>v8 (Array keys)</th>
<th>v9 (Constructor vs Setters)</th>
</tr>
<tr>
<td>

```php
// Only send fields you want to change.
// Omitted keys are not sent.
$management->users()->update($userId, [
    'name' => 'Jane',
    // 'nickname' not included — not changed
]);

// Explicitly send null to clear a field.
$management->users()->update($userId, [
    'name' => 'Jane',
    'nickname' => null,  // Sent as null — cleared
]);
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Users\Requests\UpdateUserRequestContent;

// Constructor: null values are omitted.
// Sends {"name": "Jane"} — nickname not changed.
$management->users->update($userId,
    new UpdateUserRequestContent([
        'name' => 'Jane',
        'nickname' => null,  // Omitted — not sent
    ])
);

// Setter: null values are included.
// Sends {"name": "Jane", "nickname": null} — nickname cleared.
$request = new UpdateUserRequestContent(['name' => 'Jane']);
$request->setNickname(null);
$management->users->update($userId, $request);
```

</td>
</tr>
</table>

Setters can be chained and used alongside constructor values:

```php
$request = (new UpdateUserRequestContent(['name' => 'Jane']))
    ->setNickname(null)      // Explicitly send null — clears nickname
    ->setUserMetadata(null); // Explicitly send null — clears user_metadata
```

> **Rule of thumb:** Use the constructor for fields you want to set to a value. Use setters when you need to explicitly send `null` to clear a field.

## Migration Steps

### Step 1: Update PHP and Dependencies

V9 requires PHP 8.2+. Verify your PHP version, then update your `composer.json`:

```bash
php -v  # Must be >= 8.2

composer remove auth0/auth0-php
composer require auth0/auth0-php-sdk
```

V9 continues to work with any [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP client, just like v8. If you already have a PSR-18 client installed (e.g. Guzzle, Symfony HttpClient), it will be auto-discovered.

### Step 2: Update Imports

Replace namespace imports:

```php
// Old
use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// New
use Auth0\SDK\API\Management\Management;
use Auth0\SDK\API\Management\Users\Requests\CreateUserRequestContent;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
```

### Step 3: Update Client Initialization

```php
// Old
$config = new SdkConfiguration([
    'domain' => 'your-tenant.auth0.com',
    'managementToken' => 'YOUR_TOKEN',
]);
$management = new Management($config);

// New
$management = new Management(token: 'YOUR_TOKEN');
```

### Step 4: Update API Calls

Replace factory method calls with property access and update method names:

```php
// Old
$management->users()->getAll(['per_page' => 10]);
$management->users()->getRoles($userId);

// New
$management->users->list(new ListUsersRequestParameters(['perPage' => 10]));
$management->users->roles->list($userId);
```

### Step 5: Update Request Bodies

Replace arrays with typed request objects:

```php
// Old
$management->users()->create('connection', ['email' => 'test@example.com']);

// New
$management->users->create(new CreateUserRequestContent([
    'connection' => 'connection',
    'email' => 'test@example.com',
]));
```

### Step 6: Update Response Handling

Remove `HttpResponse::decodeContent()` and `HttpResponse::wasSuccessful()` calls on Management API responses — v9 returns typed objects directly and throws `Auth0ApiException` on errors. See [Request and Response Types](#request-and-response-types) for details.

Search your codebase for these patterns:

- `HttpResponse::decodeContent(` — remove; the return value is already your data
- `HttpResponse::wasSuccessful(` — replace with try/catch using `Auth0ApiException`
- `$response['...']` on Management API results — replace with getter methods (e.g., `$user->getEmail()`)

## Examples

### User Management

<table>
<tr>
<th>v8</th>
<th>v9</th>
</tr>
<tr>
<td>

```php
$config = new SdkConfiguration([
    'domain' => 'tenant.auth0.com',
    'managementToken' => $token,
]);
$mgmt = new Management($config);

// Create
$response = $mgmt->users()->create(
    'Username-Password-Authentication',
    [
        'email' => 'user@example.com',
        'password' => 'Pass123!',
    ]
);
$user = HttpResponse::decodeContent($response);

// List
$response = $mgmt->users()->getAll([
    'per_page' => 10
]);
$users = HttpResponse::decodeContent($response);

// Get
$response = $mgmt->users()->get($userId);
$user = HttpResponse::decodeContent($response);

// Update
$mgmt->users()->update($userId, [
    'name' => 'Updated Name'
]);

// Delete
$mgmt->users()->delete($userId);
```

</td>
<td>

```php
$mgmt = new Management(token: $token);

// Create
$user = $mgmt->users->create(
    new CreateUserRequestContent([
        'connection' => 'Username-Password-Authentication',
        'email' => 'user@example.com',
        'password' => 'Pass123!',
    ])
);

// List
$users = $mgmt->users->list(
    new ListUsersRequestParameters(['perPage' => 10])
);
foreach ($users as $user) {
    echo $user->getEmail();
}

// Get
$user = $mgmt->users->get($userId);

// Update
$mgmt->users->update($userId,
    new UpdateUserRequestContent(['name' => 'Updated Name'])
);

// Delete
$mgmt->users->delete($userId);
```

</td>
</tr>
</table>

### Client Management

<table>
<tr>
<th>v8</th>
<th>v9</th>
</tr>
<tr>
<td>

```php
// Create client
$response = $mgmt->clients()->create('My App', [
    'app_type' => 'regular_web',
    'callbacks' => ['http://localhost/callback'],
]);
$client = HttpResponse::decodeContent($response);

// List clients
$response = $mgmt->clients()->getAll();
$clients = HttpResponse::decodeContent($response);

// Get credentials
$response = $mgmt->clients()->getCredentials($clientId);
$creds = HttpResponse::decodeContent($response);
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Clients\Requests\CreateClientRequestContent;
use Auth0\SDK\API\Management\Types\ClientAppTypeEnum;

// Create client
$client = $mgmt->clients->create(
    new CreateClientRequestContent([
        'name' => 'My App',
        'appType' => ClientAppTypeEnum::RegularWeb->value,
        'callbacks' => ['http://localhost/callback'],
    ])
);

// List clients
$clients = $mgmt->clients->list();
foreach ($clients as $client) {
    echo $client->getName();
}

// Get credentials
$creds = $mgmt->clients->credentials->list($clientId);
```

</td>
</tr>
</table>

### Connection Management

<table>
<tr>
<th>v8</th>
<th>v9</th>
</tr>
<tr>
<td>

```php
// Create connection
$response = $mgmt->connections()->create(
    'my-db',
    'auth0',
    ['enabled_clients' => [$clientId]]
);

// List connections
$response = $mgmt->connections()->getAll([
    'strategy' => 'auth0'
]);
$connections = HttpResponse::decodeContent($response);

// Delete user from connection
$mgmt->connections()->deleteUser($connId, $email);
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Connections\Requests\CreateConnectionRequestContent;
use Auth0\SDK\API\Management\Connections\Requests\ListConnectionsQueryParameters;
use Auth0\SDK\API\Management\Connections\Users\Requests\DeleteConnectionUsersByEmailQueryParameters;

// Create connection
$conn = $mgmt->connections->create(
    new CreateConnectionRequestContent([
        'name' => 'my-db',
        'strategy' => 'auth0',
        'enabledClients' => [$clientId],
    ])
);

// List connections
$connections = $mgmt->connections->list(
    new ListConnectionsQueryParameters([
        'strategy' => ['auth0']
    ])
);
foreach ($connections as $conn) {
    echo $conn->getName();
}

// Delete user from connection
$mgmt->connections->users->deleteByEmail($connId,
    new DeleteConnectionUsersByEmailQueryParameters([
        'email' => $email
    ])
);
```

</td>
</tr>
</table>

### Role Management

<table>
<tr>
<th>v8</th>
<th>v9</th>
</tr>
<tr>
<td>

```php
// Create role
$response = $mgmt->roles()->create('admin', [
    'description' => 'Administrator'
]);

// List roles
$response = $mgmt->roles()->getAll();
$roles = HttpResponse::decodeContent($response);

// Get role permissions
$response = $mgmt->roles()->getPermissions($roleId);
$perms = HttpResponse::decodeContent($response);

// Add permissions to role
$mgmt->roles()->addPermissions($roleId, [
    [
        'resource_server_identifier' => 'api',
        'permission_name' => 'read:users'
    ]
]);

// Get users with role
$response = $mgmt->roles()->getUsers($roleId);
$users = HttpResponse::decodeContent($response);
```

</td>
<td>

```php
use Auth0\SDK\API\Management\Roles\Requests\CreateRoleRequestContent;
use Auth0\SDK\API\Management\Roles\Permissions\Requests\AddRolePermissionsRequestContent;
use Auth0\SDK\API\Management\Types\PermissionRequestPayload;

// Create role
$role = $mgmt->roles->create(
    new CreateRoleRequestContent([
        'name' => 'admin',
        'description' => 'Administrator',
    ])
);

// List roles
$roles = $mgmt->roles->list();
foreach ($roles as $role) {
    echo $role->getName();
}

// Get role permissions
$perms = $mgmt->roles->permissions->list($roleId);

// Add permissions to role
$mgmt->roles->permissions->add($roleId,
    new AddRolePermissionsRequestContent([
        'permissions' => [
            new PermissionRequestPayload([
                'resourceServerIdentifier' => 'api',
                'permissionName' => 'read:users',
            ])
        ]
    ])
);

// Get users with role
$users = $mgmt->roles->users->list($roleId);
```

</td>
</tr>
</table>
