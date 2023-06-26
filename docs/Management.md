# Management API

The Auth0 SDK provides easy-to-use methods to access Auth0's Management API endpoints. Nearly every endpoint of the Management API is available to use with your application. For more information about any of these endpoints, see the [Management API Explorer](https://auth0.com/docs/api/management/v2).

## Management API Permissions

Before making Management API calls you must enable your application to communicate with the Management API. This can be done from the [Auth0 Dashboard's API page](https://manage.auth0.com/#/apis/), choosing `Auth0 Management API`, and selecting the 'Machine to Machine Applications' tab. Authorize your application, and then click the down arrow to choose the scopes you wish to grant.

## Accessing the Management API

The Management API class can be accessed through the `management()` method on the Auth0 SDK. Once you have an instance, you can call any of the [available endpoints](#available-endpoints).

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();
```

## Available endpoints

-   [Actions](#actions)
-   [Attack Protection](#attack-protection)
-   [Blacklists](#blacklists)
-   [ClientGrants](#client-grants)
-   [Clients](#clients)
-   [Connections](#connections)
-   [Device Credentials](#device-credentials)
-   [Emails](#emails)
-   [Email Templates](#email-templates)
-   [Grants](#grants)
-   [Guardian](#guardian)
-   [Jobs](#jobs)
-   [Logs](#logs)
-   [Log Streams](#log-streams)
-   [Organizations](#organizations)
-   [Resource Servers](#resource-servers)
-   [Roles](#roles)
-   [Rules](#rules)
-   [Stats](#stats)
-   [Tenants](#tenants)
-   [Tickets](#tickets)
-   [User Blocks](#user-blocks)
-   [Users](#users)
-   [Users by Email](#users-by-email)

### Actions

The [/api/v2/actions](https://auth0.com/docs/api/management/v2#!/Actions) endpoint class is accessible from the `actions()` method on the Management API class.

| Method   | Endpoint                                                                                                                          | SDK Method                                          |
| -------- | --------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------- |
| `GET`    | […/actions/actions](https://auth0.com/docs/api/management/v2#!/Actions/get_actions)                                               | `getAll()`                                          |
| `POST`   | […/actions/actions](https://auth0.com/docs/api/management/v2#!/Actions/post_action)                                               | `create(body: [])`                                  |
| `GET`    | […/actions/actions/{id}](https://auth0.com/docs/api/management/v2#!/Actions/get_action)                                           | `get(id: '...')`                                    |
| `PATCH`  | […/actions/actions/{id}](https://auth0.com/docs/api/management/v2#!/Actions/patch_action)                                         | `update(id: '...', body: [])`                       |
| `DELETE` | […/actions/actions/{id}](https://auth0.com/docs/api/management/v2#!/Actions/delete_action)                                        | `delete(id: '...')`                                 |
| `POST`   | […/actions/actions/{id}/test](https://auth0.com/docs/api/management/v2#!/Actions/post_test_action)                                | `test(id: '...')`                                   |
| `POST`   | […/actions/actions/{id}/deploy](https://auth0.com/docs/api/management/v2#!/Actions/post_deploy_action)                            | `deploy(id: '...')`                                 |
| `GET`    | […/actions/actions/{actionId}/versions](https://auth0.com/docs/api/management/v2#!/Actions/get_action_versions)                   | `getVersions(actionId: '...')`                      |
| `GET`    | […/actions/actions/{actionId}/versions/{id}](https://auth0.com/docs/api/management/v2#!/Actions/get_action_version)               | `getVersion(id: '...', actionId: '...')`            |
| `POST`   | […/actions/actions/{actionId}/versions/{id}/deploy](https://auth0.com/docs/api/management/v2#!/Actions/post_deploy_draft_version) | `rollbackVersion(id: '...', actionId: '...')`       |
| `GET`    | […/actions/executions/{id}](https://auth0.com/docs/api/management/v2#!/Actions/get_execution)                                     | `getExecution(id: '...')`                           |
| `GET`    | […/actions/triggers](https://auth0.com/docs/api/management/v2#!/Actions/get_triggers)                                             | `getTriggers()`                                     |
| `GET`    | […/actions/triggers/{triggerId}/bindings](https://auth0.com/docs/api/management/v2#!/Actions/get_bindings)                        | `getTriggerBindings(triggerId: '...')`              |
| `PATCH`  | […/actions/triggers/{triggerId}/bindings](https://auth0.com/docs/api/management/v2#!/Actions/patch_bindings)                      | `updateTriggerBindings(triggerId: '...', body: [])` |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Actions class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Actions.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Actions API methods are available from the Management class' actions() method.
$actions = $management->actions();

// Retrieves the first batch of results results.
$results = $actions->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($actions->getResponsePaginator() as $action) {
  // Do something with the action.
}
```

### Attack Protection

The [/api/v2/attack-protection](https://auth0.com/docs/api/management/v2#!/Attack_Protection) endpoint class is accessible from the `attackProtection()` method on the Management API class.

| Method  | Endpoint                                                                                                                                          | SDK Method                                  |
| ------- | ------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------- |
| `GET`   | […/attack-protection/breached-password-detection](https://auth0.com/docs/api/management/v2#!/Attack_Protection/get_breached_password_detection)   | `getBreachedPasswordDetection()`            |
| `PATCH` | […/attack-protection/breached-password-detection](https://auth0.com/docs/api/management/v2#!/Attack_Protection/patch_breached_password_detection) | `updateBreachedPasswordDetection(body: [])` |
| `GET`   | […/attack-protection/brute-force-protection](https://auth0.com/docs/api/management/v2#!/Attack_Protection/get_brute_force_protection)             | `getBruteForceProtection()`                 |
| `PATCH` | […/attack-protection/brute-force-protection](https://auth0.com/docs/api/management/v2#!/Attack_Protection/patch_brute_force_protection)           | `updateBruteForceProtection(body: [])`      |
| `GET`   | […/attack-protection/suspicious-ip-throttling](https://auth0.com/docs/api/management/v2#!/Attack_Protection/get_suspicious_ip_throttling)         | `getSuspiciousIpThrottling()`               |
| `PATCH` | […/attack-protection/suspicious-ip-throttling](https://auth0.com/docs/api/management/v2#!/Attack_Protection/patch_suspicious_ip_throttling)       | `updateSuspiciousIpThrottling(body: [])`    |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\AttackProtection class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/AttackProtection.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Attack Protection API methods are available from the Management class' attackProtection() method.
$attackProtection = $management->attackProtection();

// Get the current configuration.
$response = $attackProtection->getBreachedPasswordDetection();

// Print the response body.
var_dump(HttpResponse::decode($response));

// {
//   "enabled": true,
//   "shields": [
//     "block",
//     "admin_notification"
//   ],
//   "admin_notification_frequency": [
//     "immediately",
//     "weekly"
//   ],
//   "method": "standard",
//   "stage": {
//     "pre-user-registration": {
//       "shields": [
//         "block",
//         "admin_notification"
//       ]
//     }
//   }
// }
```

### Blacklists

The [/api/v2/blacklists](https://auth0.com/docs/api/management/v2#!/Blacklists) endpoint class is accessible from the `blacklists()` method on the Management API class.

| Method | Endpoint                                                                                 | SDK Method           |
| ------ | ---------------------------------------------------------------------------------------- | -------------------- |
| `GET`  | […/blacklists/tokens](https://auth0.com/docs/api/management/v2#!/Blacklists/get_tokens)  | `get()`              |
| `POST` | […/blacklists/tokens](https://auth0.com/docs/api/management/v2#!/Blacklists/post_tokens) | `create(jti: '...')` |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Blacklists class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Blacklists.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Blacklists API methods are available from the Management class' blacklists() method.
$blacklists = $management->blacklists();

// Create a new blacklist entry.
$response = $blacklists->create('some-jti');

// Check the response status code.
if ($response->getStatusCode() === 201) {
  // Token was successfully blacklisted.

  // Retrieve all blacklisted tokens.
  $results = $blacklists->get();

  // You can then iterate (and auto-paginate) through all available results.
  foreach ($blacklists->getResponsePaginator() as $blacklistedToken) {
    // Do something with the blacklisted token.
  }

  // Or, just work with the initial batch from the response.
  var_dump(HttpResponse::decode($results));

  // [
  //   {
  //     "aud": "...",
  //     "jti": "some-jti"
  //   }
  // ]
}
```

### Client Grants

The [/api/v2/client-grants](https://auth0.com/docs/api/management/v2#!/Client_Grants) endpoint class is accessible from the `clientGrants()` method on the Management API class.

| Method   | Endpoint                                                                                                    | SDK Method                                 |
| -------- | ----------------------------------------------------------------------------------------------------------- | ------------------------------------------ |
| `GET`    | […/client-grants](https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants)               | `getAll()`                                 |
| `GET`    | […/client-grants](https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants)               | `getAllByAudience(audience: '...')`        |
| `GET`    | […/client-grants](https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants)               | `getAllByClientId(clientId: '...')`        |
| `POST`   | […/client-grants](https://auth0.com/docs/api/management/v2#!/Client_Grants/post_client_grants)              | `create(clientId: '...', audience: '...')` |
| `PATCH`  | […/client-grants/{id}](https://auth0.com/docs/api/management/v2#!/Client_Grants/patch_client_grants_by_id)  | `update(grantId: '...')`                   |
| `DELETE` | […/client-grants/{id}](https://auth0.com/docs/api/management/v2#!/Client_Grants/delete_client_grants_by_id) | `delete(grantId: '...')`                   |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\ClientGrants class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/ClientGrants.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Client Grants API methods are available from the Management class' clientGrants() method.
$clientGrants = $management->clientGrants();

// Retrieves the first batch of results results.
$results = $clientGrants->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($clientGrants->getResponsePaginator() as $clientGrant) {
  // Do something with the client grant.
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "id": "",
//     "client_id": "",
//     "audience": "",
//     "scope": [
//       ""
//     ]
//   }
// ]
```

### Clients

The [/api/v2/clients](https://auth0.com/docs/api/management/v2#!/Clients) endpoint class is accessible from the `clients()` method on the Management API class.

| Method   | Endpoint                                                                                  | SDK Method            |
| -------- | ----------------------------------------------------------------------------------------- | --------------------- |
| `GET`    | […/clients](https://auth0.com/docs/api/management/v2#!/Clients/get_clients)               | `getAll()`            |
| `POST`   | […/clients](https://auth0.com/docs/api/management/v2#!/Clients/post_clients)              | `create(name: '...')` |
| `GET`    | […/clients/{id}](https://auth0.com/docs/api/management/v2#!/Clients/get_clients_by_id)    | `get(id: '...')`      |
| `PATCH`  | […/clients/{id}](https://auth0.com/docs/api/management/v2#!/Clients/patch_clients_by_id)  | `update(id: '...')`   |
| `DELETE` | […/clients/{id}](https://auth0.com/docs/api/management/v2#!/Clients/delete_clients_by_id) | `delete(id: '...')`   |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Clients class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Clients.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Clients API methods are available from the Management class' clients() method.
$clients = $management->clients();

// Retrieves the first batch of results results.
$results = $clients->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($clients->getResponsePaginator() as $client) {
  // Do something with the client.
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "client_id": "",
//     "tenant": "",
//     "name": "",
//     ...
//   }
// ]
```

### Connections

The [/api/v2/connections](https://auth0.com/docs/api/management/v2#!/Connections) endpoint class is accessible from the `connections()` method on the Management API class.

| Method   | Endpoint                                                                                                 | SDK Method                             |
| -------- | -------------------------------------------------------------------------------------------------------- | -------------------------------------- |
| `GET`    | […/connections](https://auth0.com/docs/api/management/v2#!/Connections/get_connections)                  | `getAll()`                             |
| `POST`   | […/connections](https://auth0.com/docs/api/management/v2#!/Connections/post_connections)                 | `create(name: '...', strategy: '...')` |
| `GET`    | […/connections/{id}](https://auth0.com/docs/api/management/v2#!/Connections/get_connections_by_id)       | `get(id: '...')`                       |
| `PATCH`  | […/connections/{id}](https://auth0.com/docs/api/management/v2#!/Connections/patch_connections_by_id)     | `update(id: '...')`                    |
| `DELETE` | […/connections/{id}](https://auth0.com/docs/api/management/v2#!/Connections/delete_connections_by_id)    | `delete(id: '...')`                    |
| `DELETE` | […/connections/{id}/users](https://auth0.com/docs/api/management/v2#!/Connections/delete_users_by_email) | `deleteUser(id: '...', email: '...')`  |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Connections class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Connections.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Connections API methods are available from the Management class' connections() method.
$connections = $management->connections();

// Retrieves the first batch of results results.
$results = $connections->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($connections->getResponsePaginator() as $connection) {
  // Do something with the connection.
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "name": "",
//     "display_name": "",
//     "options": {},
//     "id": "",
//     "strategy": "",
//     "realms": [
//       ""
//     ],
//     "is_domain_connection": false,
//     "metadata": {}
//   }
// ]
```

### Device Credentials

The [/api/v2/device-credentials](https://auth0.com/docs/api/management/v2#!/Device_Credentials) endpoint class is accessible from the `deviceCredentials()` method on the Management API class.

| Method   | Endpoint                                                                                                                  | SDK Method                                                              |
| -------- | ------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------- |
| `GET`    | […/device-credentials](https://auth0.com/docs/api/management/v2#!/Device_Credentials/get_device_credentials)              | `get(userId: '...')`                                                    |
| `POST`   | […/device-credentials](https://auth0.com/docs/api/management/v2#!/Device_Credentials/post_device_credentials)             | `create(deviceName: '...', type: '...', value: '...', deviceId: '...')` |
| `DELETE` | […/device-credentials/{id}](https://auth0.com/docs/api/management/v2#!/Device_Credentials/delete_device_credential_by_id) | `delete(id: '...')`                                                     |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\DeviceCredentials class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/DeviceCredentials.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Device Credentials API methods are available from the Management class' deviceCredentials() method.
$deviceCredentials = $management->deviceCredentials();

// Retrieves the first batch of results results.
$results = $deviceCredentials->get('user_id');

// You can then iterate (and auto-paginate) through all available results.
foreach ($deviceCredentials->getResponsePaginator() as $deviceCredential) {
  // Do something with the device credential.
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "id": "",
//     "device_name": "",
//     "device_id": "",
//     "type": "",
//     "user_id": "",
//     "client_id": ""
//   }
// ]
```

### Emails

The [/api/v2/emails](https://auth0.com/docs/api/management/v2#!/Emails) endpoint class is accessible from the `emails()` method on the Management API class.

| Method   | Endpoint                                                                               | SDK Method                                     |
| -------- | -------------------------------------------------------------------------------------- | ---------------------------------------------- |
| `GET`    | […/emails/provider](https://auth0.com/docs/api/management/v2#!/Emails/get_provider)    | `getProvider()`                                |
| `POST`   | […/emails/provider](https://auth0.com/docs/api/management/v2#!/Emails/post_provider)   | `createProvider(name: '...', credentials: [])` |
| `PATCH`  | […/emails/provider](https://auth0.com/docs/api/management/v2#!/Emails/patch_provider)  | `updateProvider(name: '...', credentials: [])` |
| `DELETE` | […/emails/provider](https://auth0.com/docs/api/management/v2#!/Emails/delete_provider) | `deleteProvider()`                             |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Emails class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Emails.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Emails API methods are available from the Management class' emails() method.
$endpoint = $management->emails();

// Configure the email provider.
$endpoint->createProvider(
  name: 'smtp',
  credentials: [
    'smtp_host' => '...',
    'smtp_port' => 587,
    'smtp_user' => '...',
    'smtp_pass' => '...',
  ],
  body: [
    'enabled' => true,
    'default_from_address' => 'sender@auth0.com',
  ]
)

// Retrieves the configuration of the email provider.
$provider = $endpoint->getProvider();

// Print the configuration.
var_dump(HttpResponse::decode($provider));

// {
//   "name": "smtp",
//   "enabled": true,
//   "default_from_address": "sender@auth0.com",
//   "credentials": {
//     'smtp_host' => '...',
//     'smtp_port' => 587,
//     'smtp_user' => '...',
//     'smtp_pass' => '...',
//   },
//   "settings": {}
// }
```

### Email Templates

The [/api/v2/email-templates](https://auth0.com/docs/api/management/v2#!/Email_Templates) endpoint class is accessible from the `emailTemplates()` method on the Management API class.

| Method  | Endpoint                                                                                                                             | SDK Method                                                                                        |
| ------- | ------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------- |
| `POST`  | […/email-templates](https://auth0.com/docs/api/management/v2#!/Email_Templates/post_email_templates)                                 | `create(template: '...', body: '...', from: '...', subject: '...', syntax: '...', enabled: true)` |
| `GET`   | […/email-templates/{templateName}](https://auth0.com/docs/api/management/v2#!/Email_Templates/get_email_templates_by_templateName)   | `get(templateName: '...')`                                                                        |
| `PATCH` | […/email-templates/{templateName}](https://auth0.com/docs/api/management/v2#!/Email_Templates/patch_email_templates_by_templateName) | `update(templateName: '...', body: [])`                                                           |
| `PUT`   | […/email-templates/{templateName}](https://auth0.com/docs/api/management/v2#!/Email_Templates/put_email_templates_by_templateName)   | `update(templateName: '...', body: [])`                                                           |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\EmailTemplates class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/EmailTemplates.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Email Templates API methods are available from the Management class' emailTemplates() method.
$templates = $management->emailTemplates();

// Create a new email template.
$templates->create(
  template: 'verify_email',
  body: '...',
  from: 'sender@auth0.com',
  subject: '...',
  syntax: 'liquid',
  enabled: true,
);

// Retrieves the configuration of the email template.
$template = $templates->get(templateName: 'verify_email');

// Print the configuration.
var_dump(HttpResponse::decode($template));

// {
//   "template": "verify_email",
//   "body": "",
//   "from": "sender@auth0.com",
//   "resultUrl": "",
//   "subject": "",
//   "syntax": "liquid",
//   "urlLifetimeInSeconds": 0,
//   "includeEmailInRedirect": false,
//   "enabled": false
// }
```

### Grants

The [/api/v2/grants](https://auth0.com/docs/api/management/v2#!/Grants) endpoint class is accessible from the `grants()` method on the Management API class.

| Method   | Endpoint                                                                               | SDK Method                          |
| -------- | -------------------------------------------------------------------------------------- | ----------------------------------- |
| `GET`    | […/grants](https://auth0.com/docs/api/management/v2#!/Grants/get_grants)               | `getAll()`                          |
| `GET`    | […/grants](https://auth0.com/docs/api/management/v2#!/Grants/get_grants)               | `getAllByAudience(audience: '...')` |
| `GET`    | […/grants](https://auth0.com/docs/api/management/v2#!/Grants/get_grants)               | `getAllByClientId(clientId: '...')` |
| `GET`    | […/grants](https://auth0.com/docs/api/management/v2#!/Grants/get_grants)               | `getAllByUserId(userId: '...')`     |
| `DELETE` | […/grants/{id}](https://auth0.com/docs/api/management/v2#!/Grants/delete_grants_by_id) | `delete(id: '...')`                 |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Grants class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Grants.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Grants API methods are available from the Management class' grants() method.
$grants = $management->grants();

// Retrieves the first batch of grant results.
$results = $grants->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($grants->getResponsePaginator() as $grant) {
  // Do something with the device credential.
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "id": "...",
//     "clientID": "...",
//     "user_id": "...",
//     "audience": "...",
//     "scope": [
//       "..."
//     ],
//   }
// ]
```

### Guardian

The [/api/v2/guardian](https://auth0.com/docs/api/management/v2#!/Guardian) endpoint class is accessible from the `guardian()` method on the Management API class.

| Method   | Endpoint                                                                                                    | SDK Method                    |
| -------- | ----------------------------------------------------------------------------------------------------------- | ----------------------------- |
| `GET`    | […/guardian/enrollments/{id}](https://auth0.com/docs/api/management/v2#!/Guardian/get_enrollments_by_id)    | `getEnrollment(id: '...')`    |
| `DELETE` | […/guardian/enrollments/{id}](https://auth0.com/docs/api/management/v2#!/Guardian/delete_enrollments_by_id) | `deleteEnrollment(id: '...')` |
| `GET`    | […/guardian/factors](https://auth0.com/docs/api/management/v2#!/Guardian/get_factors)                       | `getFactors()`                |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Guardian class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Guardian.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Guardian API methods are available from the Management class' guardian() method.
$guardian = $management->guardian();

// Retrieves the first batch of factor results.
$results = $guardian->getFactors();

// You can then iterate (and auto-paginate) through all available results.
foreach ($guardian->getResponsePaginator() as $factor) {
  // Do something with the device credential.
  dump($factor);

  // {
  //   "enabled": true,
  //   "trial_expired": true,
  //   "name": "..."
  // }
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "enabled": true,
//     "trial_expired": true,
//     "name": "..."
//   }
// ]
```

### Jobs

The [/api/v2/jobs](https://auth0.com/docs/api/management/v2#!/Jobs) endpoint class is accessible from the `jobs()` method on the Management API class.

| Method | Endpoint                                                                                             | SDK Method                                                |
| ------ | ---------------------------------------------------------------------------------------------------- | --------------------------------------------------------- |
| `GET`  | […/jobs/{id}](https://auth0.com/docs/api/management/v2#!/Jobs/get_jobs_by_id)                        | `get(id: '...')`                                          |
| `GET`  | […/jobs/{id}/errors](https://auth0.com/docs/api/management/v2#!/Jobs/get_errors)                     | `getErrors(id: '...')`                                    |
| `POST` | […/jobs/users-exports](https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports)           | `createExportUsersJob(body: [])`                          |
| `POST` | […/jobs/users-imports](https://auth0.com/docs/api/management/v2#!/Jobs/post_users_imports)           | `createImportUsers(filePath: '...', connectionId: '...')` |
| `POST` | […/jobs/verification-email](https://auth0.com/docs/api/management/v2#!/Jobs/post_verification_email) | `createSendVerificationEmail(userId: '...')`              |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Jobs class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Jobs.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Connections API methods are available from the Management class' connections() method.
$connections = $management->connections();

// Jobs API methods are available from the Management class' jobs() method.
$jobs = $management->jobs();

// Create a connection.
$connection = $connections->create([
  'name' => 'Test Connection',
  'strategy' => 'auth0',
]);

if (! HttpResponse::wasSuccessful($job)) {
  throw new \Exception('Connection creation failed.');
}

$connection = HttpResponse::decode($connection);

// Create a new user export job.
$response = $jobs->createExportUsersJob([
  'format' => 'json',
  'fields' => [
    ['name' => 'user_id'],
    ['name' => 'name'],
    ['name' => 'email'],
    ['name' => 'identities[0].connection', "export_as": "provider"],
    ['name' => 'user_metadata.some_field'],
  ],
  'connection_id' => $connection['id'],
]);

if ($response->getStatusCode() === 201) {
  // The job was created successfully. Retrieve it's ID.
  $jobId = HttpResponse::decode($response)['id'];
  $job = null;

  while (true) {
    // Get the job status.
    $job = $jobs->get($jobId);

    if (! HttpResponse::wasSuccessful($job)) {
      $job = null;
      break;
    }

    $job = HttpResponse::decode($job);

    // If the job is complete, break out of the loop.
    if ($job['status'] === 'completed') {
      break;
    }

    // If the job has failed, break out of the loop.
    if ($job['status'] === 'failed') {
      $job = null
      break;
    }

    // Wait 1 second before checking the job status again.
    sleep(1);
  }

  if ($job === null) {
    // The job failed.
    $errors = $jobs->getErrors($jobId);
    var_dump($errors);
  }

  // The job completed successfully. Do something with the job.
  var_dump($job);

  // Delete the connection.
  $connections->delete($connection['id']);
}
```

### Logs

The [/api/v2/logs](https://auth0.com/docs/api/management/v2#!/Logs) endpoint class is accessible from the `logs()` method on the Management API class.

| Method | Endpoint                                                                      | SDK Method       |
| ------ | ----------------------------------------------------------------------------- | ---------------- |
| `GET`  | […/logs](https://auth0.com/docs/api/management/v2#!/Logs/get_logs)            | `getAll()`       |
| `GET`  | […/logs/{id}](https://auth0.com/docs/api/management/v2#!/Logs/get_logs_by_id) | `get(id: '...')` |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Logs class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Logs.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Logs API methods are available from the Management class' logs() method.
$logs = $management->logs();

// Retrieves the first batch of log results.
$results = $logs->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($logs->getResponsePaginator() as $log) {
  // Do something with the log.
  dump($log);

  // {
  //   "date": "...",
  //   "type": "...",
  //   "description": "..."
  // }
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//   "date": "...",
//   "type": "...",
//   "description": "..."
//   }
// ]
```

### Log Streams

The [/api/v2/log-streams](https://auth0.com/docs/api/management/v2#!/Log_Streams) endpoint class is accessible from the `logStreams()` method on the Management API class.

| Method   | Endpoint                                                                                              | SDK Method                         |
| -------- | ----------------------------------------------------------------------------------------------------- | ---------------------------------- |
| `GET`    | […/log-streams](https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams)               | `getAll()`                         |
| `POST`   | […/log-streams](https://auth0.com/docs/api/management/v2#!/Log_Streams/post_log_streams)              | `create(type: '...', sink: '...')` |
| `GET`    | […/log-streams/{id}](https://auth0.com/docs/api/management/v2#!/Log_Streams/get_log_streams_by_id)    | `get(id: '...')`                   |
| `PATCH`  | […/log-streams/{id}](https://auth0.com/docs/api/management/v2#!/Log_Streams/patch_log_streams_by_id)  | `update(id: '...', body: [])`      |
| `DELETE` | […/log-streams/{id}](https://auth0.com/docs/api/management/v2#!/Log_Streams/delete_log_streams_by_id) | `delete(id: '...')`                |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\LogStreams class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/LogStreams.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// Log Streams API methods are available from the Management class' logStreams() method.
$logStreams = $management->logStreams();

// Create a new log stream.
$logStreams->create(
  type: '...',
  sink: [
    'name' => '...',
  ]
);

// Get the first batch of log streams.
$results = $logStreams->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($logStreams->getResponsePaginator() as $logStream) {
  // Do something with the log stream.
  dump($logStream);

  // {
  //   "id": "...",
  //   "name": "...",
  //   "type": "...",
  //   "status": "..."
  // }
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "id": "...",
//     "name": "...",
//     "type": "...",
//     "status": "..."
//   }
// ]
```

### Organizations

The [/api/v2/organizations](https://auth0.com/docs/api/management/v2#!/Organizations) endpoint class is accessible from the `organizations()` method on the Management API class.

| Method   | Endpoint                                                                                                                                                       | SDK Method                                                                     |
| -------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------ |
| `GET`    | […/organizations](https://auth0.com/docs/api/management/v2#!/Organizations/get_organizations)                                                                  | `getAll()`                                                                     |
| `POST`   | […/organizations](https://auth0.com/docs/api/management/v2#!/Organizations/post_organizations)                                                                 | `create(name: '...', displayName: '...')`                                      |
| `GET`    | […/organizations/{id}](https://auth0.com/docs/api/management/v2#!/Organizations/get_organizations_by_id)                                                       | `get(id: '...')`                                                               |
| `PATCH`  | […/organizations/{id}](https://auth0.com/docs/api/management/v2#!/Organizations/patch_organizations_by_id)                                                     | `update(id: '...', name: '...', displayName: '...')`                           |
| `DELETE` | […/organizations/{id}](https://auth0.com/docs/api/management/v2#!/Organizations/delete_organizations_by_id)                                                    | `delete(id: '...')`                                                            |
| `GET`    | […/organizations/name/{name}](https://auth0.com/docs/api/management/v2#!/Organizations/get_name_by_name)                                                       | `getByName(name: '...')`                                                       |
| `GET`    | […/organizations/{id}/members](https://auth0.com/docs/api/management/v2#!/Organizations/get_members)                                                           | `getMembers(id: '...')`                                                        |
| `POST`   | […/organizations/{id}/members](https://auth0.com/docs/api/management/v2#!/Organizations/post_members)                                                          | `addMembers(id: '...', members: [])`                                           |
| `DELETE` | […/organizations/{id}/members](https://auth0.com/docs/api/management/v2#!/Organizations/delete_members)                                                        | `removeMembers(id: '...', members: [])`                                        |
| `GET`    | […/organizations/{id}/invitations](https://auth0.com/docs/api/management/v2#!/Organizations/get_invitations)                                                   | `getInvitations(id: '...')`                                                    |
| `POST`   | […/organizations/{id}/invitations](https://auth0.com/docs/api/management/v2#!/Organizations/post_invitations)                                                  | `createInvitation(id: '...', clientId: '...', inviter: '...', invitee: '...')` |
| `GET`    | […/organizations/{id}/invitations/{invitationId}](https://auth0.com/docs/api/management/v2#!/Organizations/get_invitations_by_invitation_id)                   | `getInvitation(id: '...', invitationId: '...')`                                |
| `DELETE` | […/organizations/{id}/invitations/{invitationId}](https://auth0.com/docs/api/management/v2#!/Organizations/delete_invitations_by_invitation_id)                | `deleteInvitation(id: '...', invitationId: '...')`                             |
| `GET`    | […/organizations/{id}/enabled_connections](https://auth0.com/docs/api/management/v2#!/Organizations/get_enabled_connections)                                   | `getEnabledConnections(id: '...')`                                             |
| `POST`   | […/organizations/{id}/enabled_connections](https://auth0.com/docs/api/management/v2#!/Organizations/post_enabled_connections)                                  | `addEnabledConnection(id: '...', connectionId: '...', body: [])`               |
| `GET`    | […/organizations/{id}/enabled_connections/{connectionId}](https://auth0.com/docs/api/management/v2#!/Organizations/get_enabled_connections_by_connectionId)    | `getEnabledConnection(id: '...', connectionId: '...')`                         |
| `PATCH`  | […/organizations/{id}/enabled_connections/{connectionId}](https://auth0.com/docs/api/management/v2#!/Organizations/patch_enabled_connections_by_connectionId)  | `updateEnabledConnection(id: '...' connectionId: '...', body: [])`             |
| `DELETE` | […/organizations/{id}/enabled_connections/{connectionId}](https://auth0.com/docs/api/management/v2#!/Organizations/delete_enabled_connections_by_connectionId) | `removeEnabledConnection(id: '...', connectionId: '...')`                      |
| `GET`    | […/organizations/{id}/members/{userId}/roles](https://auth0.com/docs/api/management/v2#!/Organizations/get_organization_member_roles)                          | `getMemberRoles(id: '...'. userId: '...')`                                     |
| `POST`   | […/organizations/{id}/members/{userId}/roles](https://auth0.com/docs/api/management/v2#!/Organizations/post_organization_member_roles)                         | `addMemberRoles(id: '...'. userId: '...', roles: [])`                          |
| `DELETE` | […/organizations/{id}/members/{userId}/roles](https://auth0.com/docs/api/management/v2#!/Organizations/delete_organization_member_roles)                       | `removeMemberRoles(id: '...'. userId: '...', roles: [])`                       |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Organizations class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Organizations.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// The Organizations class is accessible from the Management class' organizations() method.
$organizations = $management->organizations();

// Get all organizations.
$results = $organizations->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($logStreams->getResponsePaginator() as $logStream) {
  // Do something with the log stream.
  dump($logStream);

  // {
  //   "id": "",
  //   "name": "...",
  //   "display_name": "...",
  // }
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "id": "",
//     "name": "...",
//     "display_name": "...",
// ]

// Get a single organization.
$results = $organizations->get('org_id');

// Create a new organization.
$results = $organizations->create('name', 'display_name');

// Update an existing organization.
$results = $organizations->update('org_id', 'name', 'display_name');

// Delete an organization.
$results = $organizations->delete('org_id');

// Get all members of an organization.
$results = $organizations->getMembers('org_id');

// Add members to an organization.
$results = $organizations->addMembers('org_id', ['user_id_1', 'user_id_2']);

// Remove members from an organization.
$results = $organizations->removeMembers('org_id', ['user_id_1', 'user_id_2']);

// Get all invitations for an organization.
$results = $organizations->getInvitations('org_id');

// Create a new invitation for an organization.
$results = $organizations->createInvitation('org_id', 'client_id', 'inviter_user_id', 'invitee_email');

// Get a single invitation for an organization.
$results = $organizations->getInvitation('org_id', 'invitation_id');

// Delete an invitation for an organization.
$results = $organizations->deleteInvitation('org_id', 'invitation_id');

// Get all enabled connections for an organization.
$results = $organizations->getEnabledConnections('org_id');

// Add a connection to an organization.
$results = $organizations->addEnabledConnection('org_id', 'connection_id', ['assign_membership_on_login' => true]);

// Get a single enabled connection for an organization.
$results = $organizations->getEnabledConnection('org_id', 'connection_id');

// Update an enabled connection for an organization.
$results = $organizations->updateEnabledConnection('org_id', 'connection_id', ['assign_membership_on_login' => false]);

// Remove a connection from an organization.
$results = $organizations->removeEnabledConnection('org_id', 'connection_id');

// Get all roles for a member of an organization.
$results = $organizations->getMemberRoles('org_id', 'user_id');

// Add roles to a member of an organization.
$results = $organizations->addMemberRoles('org_id', 'user_id', ['role_id_1', 'role_id_2']);

// Remove roles from a member of an organization.
$results = $organizations->removeMemberRoles('org_id', 'user_id', ['role_id_1', 'role_id_2']);
```

### Resource Servers

The [/api/v2/resource-servers](https://auth0.com/docs/api/management/v2#!/Resource_Servers) endpoint class is accessible from the `resourceServers()` method on the Management API class.

| Method   | Endpoint                                                                                                             | PHP Method                            |
| -------- | -------------------------------------------------------------------------------------------------------------------- | ------------------------------------- |
| `GET`    | […/resource-servers](https://auth0.com/docs/api/management/v2#!/Resource_Servers/get_resource_servers)               | `getAll()`                            |
| `POST`   | […/resource-servers](https://auth0.com/docs/api/management/v2#!/Resource_Servers/post_resource_servers)              | `create(identifier: '...', body: [])` |
| `GET`    | […/resource-servers/{id}](https://auth0.com/docs/api/management/v2#!/Resource_Servers/get_resource_servers_by_id)    | `get(id: '...')`                      |
| `PATCH`  | […/resource-servers/{id}](https://auth0.com/docs/api/management/v2#!/Resource_Servers/patch_resource_servers_by_id)  | `update(id: '...', body: '...')`      |
| `DELETE` | […/resource-servers/{id}](https://auth0.com/docs/api/management/v2#!/Resource_Servers/delete_resource_servers_by_id) | `delete(id: '...')`                   |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\ResourceServers class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/ResourceServers.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// The Resource Servers endpoint is accessible from the Management class' resourceServers() method.
$resourceServers = $management->resourceServers();

// Create a new resource server.
$resourceServers->create(
  identifier: 'https://my-resource-server.auth0.com',
  body: [
    'name' => 'My Example API',
    'scopes' => [
      [
        'value' => 'read:messages',
        'description' => 'Read messages',
      ],
      [
        'value' => 'write:messages',
        'description' => 'Write messages',
      ],
    ],
  ]
);

// Get all resource servers.
$results = $resourceServers->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($logStreams->getResponsePaginator() as $logStream) {
  // Do something with the log stream.
  dump($logStream);

  // {
  //   "id": "",
  //   "name": "",
  //   "is_system": false,
  //   "identifier": "",
  //   "scopes": [
  //     "object"
  //   ],
  //   "signing_alg": "",
  //   "signing_secret": "",
  //   "allow_offline_access": false,
  //   "skip_consent_for_verifiable_first_party_clients": false,
  //   "token_lifetime": 0,
  //   "token_lifetime_for_web": 0,
  //   "enforce_policies": false,
  //   "token_dialect": "",
  //   "client": {}
  // }
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "id": "",
//     "name": "",
//     "is_system": false,
//     "identifier": "",
//     "scopes": [
//       "object"
//     ],
//     "signing_alg": "",
//     "signing_secret": "",
//     "allow_offline_access": false,
//     "skip_consent_for_verifiable_first_party_clients": false,
//     "token_lifetime": 0,
//     "token_lifetime_for_web": 0,
//     "enforce_policies": false,
//     "token_dialect": "",
//     "client": {}
//   }
// ]
```

### Roles

The [/api/v2/roles](https://auth0.com/docs/api/management/v2#!/Roles) endpoint class is accessible from the `roles()` method on the Management API class.

| Method   | Endpoint                                                                                                       | PHP Method                                      |
| -------- | -------------------------------------------------------------------------------------------------------------- | ----------------------------------------------- |
| `GET`    | […/roles](https://auth0.com/docs/api/management/v2#!/Roles/get_roles)                                          | `getAll()`                                      |
| `POST`   | […/roles](https://auth0.com/docs/api/management/v2#!/Roles/post_roles)                                         | `create(name: '...', body: [])`                 |
| `GET`    | […/roles/{id}](https://auth0.com/docs/api/management/v2#!/Roles/get_roles_by_id)                               | `get(id: '...')`                                |
| `PATCH`  | […/roles/{id}](https://auth0.com/docs/api/management/v2#!/Roles/patch_roles_by_id)                             | `update(id: '...', body: [])`                   |
| `DELETE` | […/roles/{id}](https://auth0.com/docs/api/management/v2#!/Roles/delete_roles_by_id)                            | `delete(id: '...')`                             |
| `GET`    | […/roles/{id}/users](https://auth0.com/docs/api/management/v2#!/Roles/get_role_user)                           | `getUsers(id: '...')`                           |
| `POST`   | […/roles/{id}/users](https://auth0.com/docs/api/management/v2#!/Roles/post_role_users)                         | `addUsers(id: '...', users: [])`                |
| `GET`    | […/roles/{id}/permissions](https://auth0.com/docs/api/management/v2#!/Roles/get_role_permission)               | `getPermissions(id: '...')`                     |
| `POST`   | […/roles/{id}/permissions](https://auth0.com/docs/api/management/v2#!/Roles/post_role_permission_assignment)   | `addPermissions(id: '...', permissions: [])`    |
| `DELETE` | […/roles/{id}/permissions](https://auth0.com/docs/api/management/v2#!/Roles/delete_role_permission_assignment) | `removePermissions(id: '...', permissions: [])` |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Roles class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Roles.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// The Roles endpoint class is accessible from the Management class' roles() method.
$roles = $management->roles();

// Create a new role.
$roles->create(
  name: 'My Example Role',
  body: [
    'description' => 'This is an example role.',
  ]
);

// Get all roles.
$results = $roles->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($logStreams->getResponsePaginator() as $logStream) {
  // Do something with the log stream.
  dump($logStream);

  // {
  //   "id": "",
  //   "name": "",
  //   "description": "",
  // }
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "id": "",
//     "name": "",
//     "description": "",
//   }
// ]
```

### Rules

The [/api/v2/rules](https://auth0.com/docs/api/management/v2#!/Rules) endpoint class is accessible from the `rules()` method on the Management API class.

| Method   | Endpoint                                                                            | PHP Method                           |
| -------- | ----------------------------------------------------------------------------------- | ------------------------------------ |
| `GET`    | […/rules](https://auth0.com/docs/api/management/v2#!/Rules/get_rules)               | `getAll()`                           |
| `POST`   | […/rules](https://auth0.com/docs/api/management/v2#!/Rules/post_rules)              | `create(name: '...', script: '...')` |
| `GET`    | […/rules/{id}](https://auth0.com/docs/api/management/v2#!/Rules/get_rules_by_id)    | `get(id: '...')`                     |
| `PATCH`  | […/rules/{id}](https://auth0.com/docs/api/management/v2#!/Rules/patch_rules_by_id)  | `update(id: '...', body: [])`        |
| `DELETE` | […/rules/{id}](https://auth0.com/docs/api/management/v2#!/Rules/delete_rules_by_id) | `delete(id: '...')`                  |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Rules class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Rules.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// The Rules endpoint class is accessible from the Management class' rules() method.
$rules = $management->rules();

// Create a new rule.
$rules->create(
  name: 'My Example Rule',
  script: 'function (user, context, callback) { callback(null, user, context); }'
);

// Get all rules.
$results = $rules->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($logStreams->getResponsePaginator() as $logStream) {
  // Do something with the log stream.
  dump($logStream);

  // {
  //   "id": "",
  //   "name": "",
  //   "script": "",
  //   "enabled": true,
  //   "order": 0,
  //   "stage": "login_success",
  // }
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "id": "",
//     "name": "",
//     "script": "",
//     "enabled": true,
//     "order": 0,
//     "stage": "login_success",
//   }
// ]
```

### Stats

The [/api/v2/stats](https://auth0.com/docs/api/management/v2#!/Stats) endpoint class is accessible from the `stats()` method on the Management API class.

| Method | Endpoint                                                                                  | PHP Method                        |
| ------ | ----------------------------------------------------------------------------------------- | --------------------------------- |
| `GET`  | […/stats/active-users](https://auth0.com/docs/api/management/v2#!/Stats/get_active_users) | `getActiveUsers()`                |
| `GET`  | […/stats/daily](https://auth0.com/docs/api/management/v2#!/Stats/get_active_users)        | `getDaily(from: '...', to: '...)` |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Stats class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Stats.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// The Stats endpoint class is accessible from the Management class' stats() method.
$stats = $management->stats();

// Retrieve the number of logins, signups and breached-password detections (subscription required) that occurred each day within a specified date range.
$results = $stats->getDaily();

// You can then iterate (and auto-paginate) through all available results.
foreach ($stats->getResponsePaginator() as $metrics) {
  // Do something with the log stream.
  dump($logStream);

  // {
  //   "date": "...",
  //   "logins": 0,
  //   "signups": 0,
  //   "leaked_passwords": 0,
  //   "updated_at": "...",
  //   "created_at": "..."
  // }
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "date": "...",
//     "logins": 0,
//     "signups": 0,
//     "leaked_passwords": 0,
//     "updated_at": "...",
//     "created_at": "..."
//   }
// ]
```

### Tenants

The [/api/v2/tenants](https://auth0.com/docs/api/management/v2#!/Tenants) endpoint class is accessible from the `tenants()` method on the Management API class.

| Method  | Endpoint                                                                                | PHP Method                 |
| ------- | --------------------------------------------------------------------------------------- | -------------------------- |
| `GET`   | […/tenants/settings](https://auth0.com/docs/api/management/v2#!/Tenants/get_settings)   | `getSettings()`            |
| `PATCH` | […/tenants/settings](https://auth0.com/docs/api/management/v2#!/Tenants/patch_settings) | `updateSettings(body: [])` |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Tenants class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Tenants.php)

```php
use Auth0\SDK\Utility\HttpResponse;

$management = app('auth0')->management();
$tenants = $management->tenants();

// Retrieve the current tenant settings.
$results = $tenants->getSettings();

var_dump(HttpResponse::decode($results));

// {
//   "change_password": {
//     "enabled": false,
//     "html": ""
//   },
//   ...
//   ...
//   ...
// }
```

### Tickets

The [/api/v2/tickets](https://auth0.com/docs/api/management/v2#!/Tickets) endpoint class is accessible from the `tickets()` method on the Management API class.

| Method | Endpoint                                                                                                   | PHP Method                               |
| ------ | ---------------------------------------------------------------------------------------------------------- | ---------------------------------------- |
| `POST` | […/tickets/password-change](https://auth0.com/docs/api/management/v2#!/Tickets/post_password_change)       | `createPasswordChange(body: [])`         |
| `POST` | […/tickets/email-verification](https://auth0.com/docs/api/management/v2#!/Tickets/post_email_verification) | `createEmailVerification(userId: '...')` |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\Tickets class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/Tickets.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// The Tickets endpoint class is accessible from the Management class' tickets() method.
$tickets = $management->tickets();

// Create a password change ticket.
$results = $tickets->createPasswordChange([
  'result_url' => 'https://example.com',
  'user_id' => '...',
  'client_id' => '...',
  'organization_id' => '...',
  'connection_id' => '...',
  'email' => '...',
  'ttl_sec' => 3600,
  'mark_email_as_verified' => true,
  'includeEmailInRedirect' => true,
]);

var_dump(HttpResponse::decode($results));

// {
//   "ticket": "https://login.auth0.com/lo/reset?..."
// }
```

### User Blocks

The [/api/v2/user-blocks](https://auth0.com/docs/api/management/v2#!/User_Blocks) endpoint class is accessible from the `userBlocks()` method on the Management API class.

| Method   | Endpoint                                                                                              | PHP Method                              |
| -------- | ----------------------------------------------------------------------------------------------------- | --------------------------------------- |
| `GET`    | […/user-blocks](https://auth0.com/docs/api/management/v2#!/User_Blocks/get_user_blocks)               | `get(id: '...')`                        |
| `DELETE` | […/user-blocks](https://auth0.com/docs/api/management/v2#!/User_Blocks/delete_user_blocks)            | `delete(id: '...')`                     |
| `GET`    | […/user-blocks/{id}](https://auth0.com/docs/api/management/v2#!/User_Blocks/get_user_blocks_by_id)    | `getByIdentifier(identifier: '...')`    |
| `DELETE` | […/user-blocks/{id}](https://auth0.com/docs/api/management/v2#!/User_Blocks/delete_user_blocks_by_id) | `deleteByIdentifier(identifier: '...')` |

For full usage reference of the available API methods please [review the Auth0\SDK\API\Management\UserBlocks class.](https://github.com/auth0/auth0-PHP/blob/main/src/API/Management/UserBlocks.php)

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// The User Blocks endpoint class is accessible from the Management class' userBlocks() method.
$userBlocks = $management->userBlocks();

// Retrieve a list of all user blocks.
$results = $userBlocks->get('...');

var_dump(HttpResponse::decode($results));

// {
//   "blocked_for": [
//     {
//       "identifier": "...",
//       "ip": "..."
//     }
//   ]
// }
```

### Users

The [/api/v2/users](https://auth0.com/docs/api/management/v2#!/Users) endpoint class is accessible from the `users()` method on the Management API class.

| Method   | Endpoint                                                                                                                                                   | PHP Method                                                       |
| -------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------- |
| `GET`    | […/users](https://auth0.com/docs/api/management/v2#!/Users/get_users)                                                                                      | `getAll()`                                                       |
| `POST`   | […/users](https://auth0.com/docs/api/management/v2#!/Users/post_users)                                                                                     | `create(connection: '...', body: [])`                            |
| `GET`    | […/users/{id}](https://auth0.com/docs/api/management/v2#!/Users/get_users_by_id)                                                                           | `get(id: '...')`                                                 |
| `PATCH`  | […/users/{id}](https://auth0.com/docs/api/management/v2#!/Users/patch_users_by_id)                                                                         | `update(id: '...', body: [])`                                    |
| `DELETE` | […/users/{id}](https://auth0.com/docs/api/management/v2#!/Users/delete_users_by_id)                                                                        | `delete(id: '...')`                                              |
| `GET`    | […/users/{id}/enrollments](https://auth0.com/docs/api/management/v2#!/Users/get_enrollments)                                                               | `getEnrollments(id: '...')`                                      |
| `GET`    | […/users/{user}/authentication-methods](https://auth0.com/docs/api/management/v2#!/Users/get_authentication_methods)                                       | `getAuthenticationMethods(user: '...')`                          |
| `DELETE` | […/users/{user}/authentication-methods](https://auth0.com/docs/api/management/v2#!/Users/delete_authentication_methods)                                    | `deleteAuthenticationMethods(user: '...')`                       |
| `POST`   | […/users/{user}/authentication-methods](https://auth0.com/docs/api/management/v2#!/Users/post_authentication_methods)                                      | `createAuthenticationMethod(user: '...', body: [])`              |
| `GET`    | […/users/{id}/authentication-methods/{method}](https://auth0.com/docs/api/management/v2#!/Users/get_authentication_methods_by_authentication_method_id)    | `getAuthenticationMethod(id: '...', method: '...')`              |
| `PATCH`  | […/users/{id}/authentication-methods/{method}](https://auth0.com/docs/api/management/v2#!/Users/patch_authentication_methods_by_authentication_method_id)  | `updateAuthenticationMethod(id: '...', method: '...', body: [])` |
| `DELETE` | […/users/{id}/authentication-methods/{method}](https://auth0.com/docs/api/management/v2#!/Users/delete_authentication_methods_by_authentication_method_id) | `deleteAuthenticationMethod(id: '...', method: '...')`           |
| `GET`    | […/users/{id}/organizations](https://auth0.com/docs/api/management/v2#!/Users/get_user_organizations)                                                      | `getOrganizations(id: '...')`                                    |
| `GET`    | […/users/{id}/logs](https://auth0.com/docs/api/management/v2#!/Users/get_logs_by_user)                                                                     | `getLogs(id: '...')`                                             |
| `GET`    | […/users/{id}/roles](https://auth0.com/docs/api/management/v2#!/Users/get_user_roles)                                                                      | `getRoles(id: '...')`                                            |
| `POST`   | […/users/{id}/roles](https://auth0.com/docs/api/management/v2#!/Users/post_user_roles)                                                                     | `addRoles(id: '...', roles: [])`                                 |
| `DELETE` | […/users/{id}/roles](https://auth0.com/docs/api/management/v2#!/Users/delete_user_roles)                                                                   | `removeRoles(id: '...', roles: [])`                              |
| `GET`    | […/users/{id}/permissions](https://auth0.com/docs/api/management/v2#!/Users/get_permissions)                                                               | `getPermissions(id: '...')`                                      |
| `POST`   | […/users/{id}/permissions](https://auth0.com/docs/api/management/v2#!/Users/post_permissions)                                                              | `addPermissions(id: '...', permissions: [])`                     |
| `DELETE` | […/users/{id}/permissions](https://auth0.com/docs/api/management/v2#!/Users/delete_permissions)                                                            | `removePermissions(id: '...', permissions: [])`                  |
| `DELETE` | […/users/{id}/multifactor/{provider}](https://auth0.com/docs/api/management/v2#!/Users/delete_multifactor_by_provider)                                     | `deleteMultifactorProvider(id: '...', provider: '...')`          |
| `POST`   | […/users/{id}/identities](https://auth0.com/docs/api/management/v2#!/Users/post_identities)                                                                | `linkAccount(id: '...', body: [])`                               |
| `DELETE` | […/users/{id}/identities/{provider}/{identityId}](https://auth0.com/docs/api/management/v2#!/Users/delete_provider_by_user_id)                             | `unlinkAccount(id: '...', provider: '...', identityId: '...')`   |
| `POST`   | […/users/{id}/recovery-code-regeneration](https://auth0.com/docs/api/management/v2#!/Users/post_recovery_code_regeneration)                                | `createRecoveryCode(id: '...')`                                  |
| `POST`   | […/users/{id}/multifactor/actions/invalidate-remember-browser](https://auth0.com/docs/api/management/v2#!/Users/post_invalidate_remember_browser)          | `invalidateBrowsers(id: '...')`                                  |

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// The Users class is accessible from the Management API's users() method.
$users = $management->users();

// Create a new user.
$users->create(
  connection: 'Username-Password-Authentication',
  body: [
    'email' => '...',
    'password' => '...',
    'email_verified' => true,
  ]
);

// Get a single user.
$result = $users->get('auth0|...');

dump(HttpResponse::decodedBody($result));

// Get all users.
$results = $users->getAll();

// You can then iterate (and auto-paginate) through all available results.
foreach ($users->getResponsePaginator() as $user) {
  dump($user);

// {
//   "user_id": "...",
//   "email": "...",
//   "email_verified": true,
//   ...
// }
}

// Or, just work with the initial batch from the response.
var_dump(HttpResponse::decode($results));

// [
//   {
//     "user_id": "...",
//     "email": "...",
//     "email_verified": true,
//     ...
//   }
// ]
```

# Users by Email

The `Auth0\SDK\API\Management\UsersByEmail` class provides methods to access the [Users by Email endpoint](https://auth0.com/docs/api/management/v2#!/Users_By_Email) of the v2 Management API.

| Method | Endpoint                                                                                         | PHP Method |
| ------ | ------------------------------------------------------------------------------------------------ | ---------- |
| `GET`  | […/users-by-email](https://auth0.com/docs/api/management/v2#!/Users_By_Email/get_users_by_email) | `get()`    |

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

// Set up the SDK configuration object.
$configuration = new SdkConfiguration(
  domain: '...,'
  clientId: '...,'
  clientSecret: '...,'
)

// Instantiate the SDK using the configuration.
$auth0 = new Auth0($configuration);

// The Management API class is accessible from the SDK's management() method.
$management = $auth0->management();

// The UsersByEmail class is accessible from the Management API's usersByEmail() method.
$usersByEmail = $management->usersByEmail();

// Get a single user by email.
$result = $usersByEmail->get('...');

dump(HttpResponse::decodedBody($result));

// {
//   "user_id": "...",
//   "email": "...",
//   "email_verified": true,
//   ...
// }
```
