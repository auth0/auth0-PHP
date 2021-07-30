# Auth0 PHP SDK

[![Build Status](https://img.shields.io/circleci/project/github/auth0/auth0-PHP/main.svg)](https://circleci.com/gh/auth0/auth0-PHP)
[![Code Coverage](https://codecov.io/gh/auth0/auth0-PHP/branch/master/graph/badge.svg)](https://codecov.io/gh/auth0/auth0-PHP)
[![Latest Stable Version](https://img.shields.io/packagist/v/auth0/auth0-PHP?label=stable)](https://packagist.org/packages/auth0/auth0-PHP)
[![Supported PHP Versions](https://img.shields.io/packagist/php-v/auth0/auth0-php)](https://packagist.org/packages/auth0/auth0-PHP)
[![License](https://img.shields.io/packagist/l/auth0/auth0-php)](https://packagist.org/packages/auth0/auth0-PHP)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fauth0%2Fauth0-PHP.svg?type=shield)](https://app.fossa.com/reports/4ef17265-c913-439b-8573-70bfc40d974d)

The Auth0 PHP SDK is a straightforward and rigorously-tested library for accessing Auth0's Authentication and Management API endpoints using modern PHP releases. Auth0 enables you to quickly integrate authentication and authorization into your applications so that you can focus on your core business. [Learn more.](https://auth0.com/why-auth0)

- [Auth0 PHP SDK](#auth0-php-sdk)
  - [Requirements](#requirements)
  - [Usage](#usage)
    - [Getting Started](#getting-started)
    - [Installation](#installation)
    - [SDK Initialization](#sdk-initialization)
    - [Configuration Options](#configuration-options)
    - [Getting an active session](#getting-an-active-session)
    - [Logging in](#logging-in)
    - [Logging out](#logging-out)
    - [Renewing tokens](#renewing-tokens)
    - [Decoding an Id Token](#decoding-an-id-token)
    - [Using the Authentication API](#using-the-authentication-api)
    - [Using the Management API](#using-the-management-api)
    - [Using Organizations](#using-organizations)
      - [Initializing the SDK with Organizations](#initializing-the-sdk-with-organizations)
      - [Logging in with an Organization](#logging-in-with-an-organization)
      - [Accepting user invitations](#accepting-user-invitations)
      - [Validation guidance for supporting multiple organizations](#validation-guidance-for-supporting-multiple-organizations)
  - [Documentation](#documentation)
  - [Contributing](#contributing)
  - [Support + Feedback](#support--feedback)
  - [Vulnerability Reporting](#vulnerability-reporting)
  - [What is Auth0?](#what-is-auth0)
  - [License](#license)

## Requirements

- PHP [7.4](https://www.php.net/ChangeLog-7.php) or [8.0](https://www.php.net/ChangeLog-8.php)
- [Composer](https://getcomposer.org/)
- A [PSR-17](https://www.php-fig.org/psr/psr-17/) HTTP factory library. (↗ [Find libraries](https://packagist.org/search/?query=PSR-17&type=library&tags=psr%2017))
- A [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP client library. (↗ [Find libraries](https://packagist.org/search/?query=PSR-18&type=library&tags=psr%2018))
- A [PSR-6](https://www.php-fig.org/psr/psr-6/) caching library is strongly recommended for performance reasons. (↗ [Find libraries](https://packagist.org/search/?query=PSR-6&type=library&tags=psr%206))

> ⚠️ PHP 7.3 is supported on the SDK 7.0 branch through December 2021. This README.md is relevant for the SDK 8.0 branch. Please review the README.md within the 7.0 branch for guidance on that version.

> ⚠️ This library follows the [PHP release support schedule](https://www.php.net/supported-versions.php). We do not support PHP releases after they reach end-of-life. As Composer handles these deprecations safely, this is not considered a breaking change and we may drop version support with minor library releases. Please ensure you are always running the latest PHP version to keep your application up to date with PHP's security fixes, and continue to receive our latest library updates.

## Usage

### Getting Started

To get started, you'll need to create a [free Auth0 account](https://auth0.com/signup) and register an [Application](https://auth0.com/docs/applications).

### Installation

The supported method of SDK installation is through [Composer](https://getcomposer.org/). From your terminal shell, `cd` into your project directory and issue the following command:

```bash
$ composer require auth0/auth0-php:8.0.0-BETA1
```

You can find guidance on installing Composer [here](https://getcomposer.org/doc/00-intro.md).

> ⚠️ Your application must include the Composer autoloader, [as explained here](https://getcomposer.org/doc/01-basic-usage.md#autoloading), for the SDK to be usable within your application.

If you receive a warning regarding 'minimum-stability', you may need to update your `composer.json` file to include the following options, and then retry the `require` command above:

```
"minimum-stability": "beta",
"prefer-stable": true
```

Next, you will want ensure your application has [PSR-17](https://www.php-fig.org/psr/psr-17/) and [PSR-18](https://www.php-fig.org/psr/psr-18/) compatible libraries installed. These are used for network requests. As an example, let's say you wish to use [Buzz](https://github.com/kriswallsmith/Buzz) and [Nylom's PSR-7 implementation](https://github.com/Nyholm/psr7), which include PSR-18 and PSR-17 factories, respectively:

```bash
$ composer require kriswallsmith/buzz nyholm/psr7
```

The libraries specified above are simply examples. Any libraries that support the PSR-18 and PSR-17 standards will work.

↗ [Guzzle 7 natively supports PSR-18.](https://docs.php-http.org/en/latest/clients/guzzle7-adapter.html)<br />
↗ [Guzzle 6 is compatible with an adaptor library.](https://github.com/php-http/guzzle6-adapter)<br />
↗ [Symfony's HttpClient component natively supports PSR-18.](https://symfony.com/doc/current/http_client.html#psr-18-and-psr-17)<br />
↗ [Learn about other compatible libraries from PHP-HTTP.](https://docs.php-http.org/en/latest/clients.html)<br />
↗ [Search packagist for other PSR-17 HTTP factory libraries.](https://packagist.org/search/?query=PSR-17&type=library&tags=psr%2017)<br />
↗ [Search packagist for other PSR-18 HTTP client libraries.](https://packagist.org/search/?query=PSR-18&type=library&tags=psr%2018)

### SDK Initialization

Begin by instantiating the SDK and passing the appropriate configuration options. Depending on your use case, you may need to configure more options during instantiation.

```PHP
<?php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

$configuration = new SdkConfiguration(
    // The values below are found in the Auth0 dashboard, under application settings:
    domain: '{{YOUR_TENANT}}.auth0.com',
    clientId: '{{YOUR_APPLICATION_CLIENT_ID}}'
);

$auth0 = new Auth0($configuration);
```

> ⚠️ You should **never** hard-code tokens or other sensitive configuration data in a real-world application. Consider using environment variables to store and pass these values to your application.

During configuration, you should pass instances of the PSR-18 and PSR-17 libraries your application is using:

```PHP
<?php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;
use Buzz\Client\MultiCurl;
use Nyholm\Psr7\Factory\Psr17Factory;

// PSR-17 HTTP Factory (creates http requests and responses)
$Psr17Library = new Psr17Factory();

 // PSR-18 HTTP Client (delivers http requests created by the PSR-17 factory above)
$Psr18Library = new MultiCurl($Psr17Library);

// Configure the Sdk using these libraries
$configuration = new SdkConfiguration(
    // 🧩 Other configuration options, such as those demonstrated above, here.

    // An instance of your PSR-18 HTTP Client library:
    httpClient: $Psr18Library,

    // Instances of your PSR-17 HTTP Client library:
    httpRequestFactory: $Psr17Library,
    httpResponseFactory: $Psr17Library,
    httpStreamFactory: $Psr17Library,
);

$auth0 = new Auth0($configuration);
```

As mentioned in the [installation step](#installation), these are just examples: any PSR-18 or PSR-17 compatible libraries you choose to use in your application will be compatible here.

### Configuration Options

When configuring the SDK, you can either instantiate `SdkConfiguration` and pass options as named arguments in PHP 8 (strongly recommended) or as an array. The [SDK Initialization step above](#sdk-initialization) uses named arguments. Another method of configuring the SDK is passing an array of key-values matching the argument names and values of the matching allowed types. For example:

```PHP
<?php
use Auth0\SDK\Auth0;
use Auth0\SDK\Utility\HttpResponse;

$auth0 = new Auth0([
    'domain' => '{{YOUR_TENANT}}.auth0.com',
    'clientId' => '{{YOUR_APPLICATION_CLIENT_ID}}',
    'clientSecret' => '{{YOUR_APPLICATION_CLIENT_SECRET}}',
]);
```

> ⚠️ You should **never** hard-code tokens or other sensitive configuration data in a real-world application. Consider using environment variables to store and pass these values to your application.

This method is discouraged because you lose out on type hinting, but is useful in PHP 7.4 where named arguments are not supported.

The following options are available for your configuration:

| Option Name             | Allowed Types                      | Required | Default                          | Description                                                                                                                                                                                                                                                        |
| ----------------------- | ---------------------------------- | -------- | -------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `domain`                | `string`,`null`                    | ✅       |                                  | Auth0 domain for your tenant.                                                                                                                                                                                                                                      |
| `clientId`              | `string`,`null`                    | ✅       |                                  | Client ID, found in the Auth0 Application settings.                                                                                                                                                                                                                |
| `redirectUri`           | `string`,`null`                    |          | `null`                           | Authentication callback URI, as defined in your Auth0 Application settings.                                                                                                                                                                                        |
| `clientSecret`          | `string`,`null`                    |          | `null`                           | Client Secret, found in the Auth0 Application settings.                                                                                                                                                                                                            |
| `audience`              | `array<string>`,`null`             |          | `null`                           | One or more API identifiers, found in your Auth0 API settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'aud' claim to validate an ID Token successfully.                                         |
| `organization`          | `array<string>`,`null`             |          | `null`                           | One or more Organization IDs, found in your Auth0 Organization settings. The SDK uses the first value for building links. If provided, at least one of these values must match the 'org_id' claim to validate an ID Token successfully.                            |
| `usePkce`               | `bool`                             |          | `true`                           | Use PKCE (Proof Key of Code Exchange) with Authorization Code Flow requests.                                                                                                                                                                                       |
| `scope`                 | `array<string>`                    |          | `['openid', 'profile', 'email']` | One or more scopes to request for Tokens. [Learn more.](https://auth0.com/docs/scopes)                                                                                                                                                                             |
| `responseMode`          | `string`                           |          | `query`                          | Where to extract request parameters from, either 'query' for GET or 'form_post' for POST requests.                                                                                                                                                                 |
| `responseType`          | `string`                           |          | `code`                           | Use 'code' for server-side flows and 'token' for application side flow.                                                                                                                                                                                            |
| `tokenAlgorithm`        | `string`                           |          | `RS256`                          | Algorithm to use for Token verification. Expects either 'RS256' or 'HS256'.                                                                                                                                                                                        |
| `tokenJwksUri`          | `string`,`null`                    |          | `null`                           | URI to the JWKS when verifying RS256 tokens.                                                                                                                                                                                                                       |
| `tokenMaxAge`           | `int`,`null`                       |          | `null`                           | The maximum window of time (in seconds) since the 'auth_time' to accept during Token validation.                                                                                                                                                                   |
| `tokenLeeway`           | `int`,`null`                       |          | `60`                             | Leeway (in seconds) to allow during time calculations with Token validation.                                                                                                                                                                                       |
| `tokenCache`            | `CacheItemPoolInterface`,`null`    |          | `null`                           | A PSR-6 compatible cache adapter for storing JSON Web Key Sets (JWKS).                                                                                                                                                                                             |
| `tokenCacheTtl`         | `int`                              |          | `60`                             | How long (in seconds) to keep a JWKS cached.                                                                                                                                                                                                                       |
| `httpClient`            | `ClientInterface`,`null`           |          | `null`                           | A PSR-18 compatible HTTP client to use for API requests.                                                                                                                                                                                                           |
| `httpRequestFactory`    | `RequestFactoryInterface`,`null`   |          | `null`                           | A PSR-17 compatible request factory to generate HTTP requests.                                                                                                                                                                                                     |
| `httpResponseFactory`   | `ResponseFactoryInterface`,`null`  |          | `null`                           | A PSR-17 compatible response factory to generate HTTP responses.                                                                                                                                                                                                   |
| `httpStreamFactory`     | `StreamFactoryInterface`,`null`    |          | `null`                           | A PSR-17 compatible stream factory to create request body streams.                                                                                                                                                                                                 |
| `httpTelemetry`         | `bool`                             |          | `true`                           | If true, API requests will include telemetry about the SDK and PHP runtime version to help us improve our services.                                                                                                                                                |
| `sessionStorage`        | `StoreInterface`,`null`            |          | `null`                           | A StoreInterface-compatible class for storing Token state. `null` will cause the SDK to use PHP native sessions.                                                                                                                                                   |
| `cookieSecret`          | `string`,`null`                    |          | `null`                           | The secret used to derive an encryption key for the user identity in a session cookie and to sign the transient cookies used by the login callback.                                                                                                                |
| `cookieDomain`          | `string`,`null`                    |          | `null`                           | Defaults to value of HTTP_HOST server environment information. Cookie domain, for example 'www.example.com', for use with PHP sessions and SDK cookies. To make cookies visible on all subdomains then the domain must be prefixed with a dot like '.example.com'. |
| `cookieExpires`         | `int`                              |          | `0`                              | How long, in seconds, before cookies expire. If set to 0 the cookie will expire at the end of the session (when the browser closes).                                                                                                                               |
| `cookiePath`            | `string`                           |          | `/`                              | Specifies path on the domain where the cookies will work. Use a single slash ('/') for all paths on the domain.                                                                                                                                                    |
| `cookieSecure`          | `bool`                             |          | `false`                          | Specifies whether cookies should ONLY be sent over secure connections.                                                                                                                                                                                             |
| `persistUser`           | `bool`                             |          | `true`                           | If true, the user data will persist in session storage.                                                                                                                                                                                                            |
| `persistIdToken`        | `bool`                             |          | `true`                           | If true, the Id Token will persist in session storage.                                                                                                                                                                                                             |
| `persistAccessToken`    | `bool`                             |          | `true`                           | If true, the Access Token will persist in session storage.                                                                                                                                                                                                         |
| `persistRefreshToken`   | `bool`                             |          | `true`                           | If true, the Refresh Token will persist in session storage.                                                                                                                                                                                                        |
| `transientStorage`      | `StoreInterface`,`null`            |          | `null`                           | A StoreInterface-compatible class for storing ephemeral state data, such as a nonce.                                                                                                                                                                               |
| `queryUserInfo`         | `bool`                             |          | `false`                          | If true, always query the /userinfo endpoint during an authorization code exchange.                                                                                                                                                                                |
| `managementToken`       | `string`,`null`                    |          | `null`                           | An Access Token to use for Management API calls. If there isn't one specified, the SDK will attempt to get one for you using your configured `clientSecret`.                                                                                                       |
| `managementTokenCache`  | `CacheItemPoolInterface`,`null`    |          | `null`                           | A PSR-6 compatible cache adapter for storing management access tokens..                                                                                                                                                                                            |
| `eventListenerProvider` | `ListenerProviderInterface`,`null` |          | `null`                           | A PSR-14 compatible event listener for hooking into SDK events..                                                                                                                                                                                                   |

↗ [Learn more about PSR-6 caches.](https://www.php-fig.org/psr/psr-6/)<br />
↗ [Learn more about PSR-14 Event Dispatchers.](https://www.php-fig.org/psr/psr-14/)<br />
↗ [Learn more about PSR-17 HTTP Factories,](https://www.php-fig.org/psr/psr-17/) which are used to create [PSR-7 HTTP messages.](https://www.php-fig.org/psr/psr-7/)<br />
↗ [Learn more about the PSR-18 HTTP Client standard.](https://www.php-fig.org/psr/psr-18/)<br />
↗ [Find PSR-6 cache libraries on Packagist.](https://packagist.org/search/?query=PSR-6&type=library&tags=psr%206)<br />
↗ [Find PSR-17 HTTP factory libraries on Packagist.](https://packagist.org/search/?query=PSR-17&type=library&tags=psr%2017)<br />
↗ [Find PSR-18 HTTP client libraries on Packagist.](https://packagist.org/search/?query=PSR-18&type=library&tags=psr%2018)

### Getting an active session

```PHP
<?php

// 🧩 Include the configuration code from the 'SDK Initialization' step above here.

// Auth0::getCredentials() returns either null if no session is active, or an object.
$session = $auth0->getCredentials();

if ($session !== null) {
    // The Id Token for the user as a string.
    $idToken = $session->idToken;

    // The Access Token for the user, as a string.
    $accessToken = $session->accessToken;

    // A Unix timestamp representing when the Access Token is expected to expire, as an int.
    $accessTokenExpiration = $session->accessTokenExpiration;

    // A bool; if time() is greater than the value of $accessTokenExpiration, this will be true.
    $accessTokenExpired = $session->accessTokenExpired;

    // A Refresh Token, if available, as a string.
    $refreshToken = $session->refreshToken;

    // Data about the user as an array.
    $user = $session->user;
}
```

### Logging in

```PHP
<?php

// 🧩 Include the configuration code from the 'SDK Initialization' step above here.

$session = $auth0->getCredentials();

// Is this end-user already signed in?
if ($session === null) {
    // They are not. Redirect the end user to the login page.
    header('Location: ', $auth0->login());
    exit;
}
```

### Logging out

When signing out an end-user from your application, it's important to use Auth0's /logout endpoint to sign them out properly:

```PHP
<?php

// 🧩 Include the configuration code from the 'SDK Initialization' step above here.

$session = $auth0->getCredentials();

if ($session) {
    // Clear the end-user's session, and redirect them to the Auth0 /logout endpoint.
    header('Location: ', $auth0->logout());
    exit;
}
```

### Renewing tokens

Your application must request the `offline_access` scope to retrieve the Refresh Token necessary for this.

```PHP
<?php

/*
    🧩 Include the configuration code from the 'SDK Initialization' step above here.
    ⚠️ Add the 'offline_access' scope during configuration to retrieve Refresh Tokens.
*/

$session = $auth0->getCredentials();

// Is this end-user already signed in?
if ($session === null) {
    // They are not. Redirect the end user to the login page.
    header('Location: ', $auth0->login());
    exit;
}

// Is this end-user already signed in? If so, is their session expired?
if ($session->accessTokenExpired) {
    try {
        // Token has expired, attempt to renew it.
        $auth0->renew();
    } catch (StateException $e) {
        // There was an error trying to renew the token. Clear the session.
        $auth0->clear();

        // Prompt to login again.
        header('Location: ', $auth0->login());
        exit;
    }
}
```

### Decoding an Id Token

In instances where you need to manually decode an Id Token, such as a custom API service you've built, you can use the `Auth0::decode()` method:

```PHP
<?php

// 🧩 Include the configuration code from the 'SDK Initialization' step above here.

try {
    $token = $auth0->decode('{{YOUR_ID_TOKEN}}');
} catch (\Auth0\SDK\Exception\InvalidTokenException $exception) {
    die("Unable to decode Id Token; " . $exception->getMessage());
}
```

### Using the Authentication API

More advanced applications can access the SDK's full suite of authentication API functions using the `Auth0\SDK\API\Authentication` class:

```PHP
<?php

// 🧩 Include the configuration code from the 'SDK Initialization' step above here.

// Get a configured instance of the Auth0\SDK\API\Authentication class:
$authentication = $auth0->authentication();

// Start a passwordless login:
$auth0->emailPasswordlessStart(/* ...configuration */);
```

Alternatively, the SDK supports a fluent interface for more concise calls:

```PHP
<?php

// 🧩 Include the configuration code from the 'SDK Initialization' step above here.

// Start a passwordless login:
$authentication = $auth0->authentication()->emailPasswordlessStart(/* ...configuration */);
```

### Using the Management API

This SDK offers an interface for Auth0's Management API, which, to access, requires an Access Token that is explicitly issued for your tenant's Management API by specifying the corresponding Audience.

```PHP
<?php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

$configuration = new SdkConfiguration(
    // 🧩 Include other required configuration options, such as outlined in the 'SDK Initialization' step above here.

    // The process for retrieving an Access Token for Management API endpoints is described here:
    // https://auth0.com/docs/libraries/auth0-php/using-the-management-api-with-auth0-php
    managementToken: '{{YOUR_ACCESS_TOKEN}}'
);

$auth0 = new Auth0($configuration);
```

> ⚠️ You should **never** hard-code tokens or other sensitive configuration data in a real-world application. Consider using environment variables to store and pass these values to your application.

Once configured, use the `Auth0::management()` method to get a configured instance of the `Auth0\SDK\API\Management` class:

```PHP
<?php

// 🧩 Include the configuration code from the above example here.

// Get a configured instance of the Auth0\SDK\API\Management class:
$management = $auth0->management();

// Request users from the /users Management API endpoint
$response = $management->users()->getAll();

// Was the API request successful?
if (HttpResponse::wasSuccessful($response)) {
    // It was, decode the JSON into a PHP array:
    $response = HttpResponse::decodeContent($response);
    print_r($response);
}
```

Alternatively, the SDK supports a fluent interface for more concise calls:

```PHP
<?php

// 🧩 Include the configuration code from the above example here.

// Request users from the /users Management API endpoint
$management = $auth0->management()->users()->getAll();

// Was the API request successful?
if (HttpResponse::wasSuccessful($response)) {
    // It was, decode the JSON into a PHP array:
    $response = HttpResponse::decodeContent($response);
    print_r($response);
}
```

### Using Organizations

[Organizations](https://auth0.com/docs/organizations) is a set of features that provide better support for developers who build and maintain SaaS and Business-to-Business (B2B) applications. Organizations are currently only available to customers on our Enterprise and Startup subscription plans.

#### Initializing the SDK with Organizations

Configure the SDK with your Organization ID:

```PHP
<?php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

$configuration = new SdkConfiguration(
    // 🧩 Include other required configuration options, such as outlined in the 'SDK Initialization' step above here.

    // Found in your Auth0 dashboard, under your organization settings.
    // Note that this must be configured as an array.
    organization: [ '{{YOUR_ORGANIZATION_ID}}' ]
);

$auth0 = new Auth0($configuration);
```

> ⚠️ You should **never** hard-code tokens or other sensitive configuration data in a real-world application. Consider using environment variables to store and pass these values to your application.

#### Logging in with an Organization

With the SDK initialized using your Organization Id, you can use the `Auth0::login()` method as you normally would. Methods throughout the SDK will use the Organization Id you configured in their API calls.

```PHP
<?php

// 🧩 Include the configuration code from the 'Initializing the SDK with Organizations' step above here.

$session = $auth0->getCredentials();

// Is this end-user already signed in?
if ($session === null) {
  // They are not. Redirect the end user to the login page.
  header('Location: ', $auth0->login());
  exit;
}
```

#### Accepting user invitations

Auth0 Organizations allow users to be invited using emailed links, which will direct a user back to your application. The user will be sent to your application URL based on your configured `Application Login URI`, which you can change from your application's settings inside the Auth0 dashboard.

When the user arrives at your application using an invite link, three query parameters are available: `invitation`, `organization`, and `organization_name.` These will always be delivered using a GET request.

A helper function is provided to handle extracting these query parameters and automatically redirecting to the Universal Login page:

```PHP
<?php

// 🧩 Include the configuration code from the 'Initializing the SDK with Organizations' step above here.

$auth0->handleInvitation();
```

Suppose you prefer to have more control over this process. In that case, extract the relevant query parameters using `getInvitationParameters()`, and then initiate the Universal Login redirect yourself:

```PHP
<?php

// 🧩 Include the configuration code from the 'Initializing the SDK with Organizations' step above here.

// Returns an object containing the invitation query parameters, or null if they aren't present
if ($invite = $auth0->getInvitationParameters()) {
  // Does the invite organization match one of your configured organizations?
  if (in_array($invite->organization, $configuration->getOrganization()) === false) {
    // It does not. Throw an error; for example:
    throw new Exception("This invitation isn't intended for this service. Please have your administrator check the service configuration and request a new invitation.");
  }

  // Redirect to Universal Login using the emailed invitation code and Organization Id
  header('Location: ', $auth0->login(null, [
    'invitation' => $invite->invitation,
    'organization' => $invite->organization,
  ]));
}
```

After successful authentication via the Universal Login Page, the user will arrive back at your application using your configured `redirect_uri`, their token will be validated, and they will have an authenticated session. Use `Auth0::getCredentials()` to retrieve details about the authenticated user.

#### Validation guidance for supporting multiple organizations

In the examples above, our application is operating with a single, configured Organization. By initializing the SDK with the `organization` argument, we tell the internal token verifier to validate an `org_id` claim's presence and match what was provided.

In some cases, your application may need to support validating tokens' `org_id` claims for several different organizations. When initializing the SDK, the `organization` argument accepts an array of organizations; during token validation, if ANY of those Organization Ids match, the token passes validation. When generating links or issuing API calls, the first Organization Id in that configuration array will be used. You can alter this value at any time by updating your instance of the `SdkConfiguration` or passing custom parameters to methods that use Organization Ids.

> ⚠️ If you have a more complex application with custom token validation code, you must validate the `org_id` claim on tokens to ensure the value received is expected and known by your application. If the claim is not valid, your application should reject the token. See [https://auth0.com/docs/organizations/using-tokens](https://auth0.com/docs/organizations/using-tokens) for more information.

## Documentation

- [Documentation](https://auth0.com/docs/libraries/auth0-php)
  - [Installation](https://auth0.com/docs/libraries/auth0-php#installation)
  - [Getting Started](https://auth0.com/docs/libraries/auth0-php#getting-started)
  - [Basic Usage](https://auth0.com/docs/libraries/auth0-php/auth0-php-basic-use)
  - [Authentication API](https://auth0.com/docs/libraries/auth0-php/using-the-authentication-api-with-auth0-php)
  - [Management API](https://auth0.com/docs/libraries/auth0-php/using-the-management-api-with-auth0-php)
  - [Troubleshooting](https://auth0.com/docs/libraries/auth0-php/troubleshoot-auth0-php-library)
- Quickstarts
  - [Web Application Authentication](https://auth0.com/docs/quickstart/webapp/php-beta/) ([GitHub repo](https://github.com/auth0-samples/auth0-php-web-app/tree/8.x))
  - [Backend API Authorization](https://auth0.com/docs/quickstart/backend/php-beta/) ([GitHub repo](https://github.com/auth0-samples/auth0-php-api-samples/tree/8.x))

## Contributing

We appreciate your feedback and contributions to the project! Before you get started, please review the following:

- [Auth0's general contribution guidelines](https://github.com/auth0/open-source-template/blob/master/GENERAL-CONTRIBUTING.md)
- [Auth0's code of conduct guidelines](https://github.com/auth0/open-source-template/blob/master/CODE-OF-CONDUCT.md)
- [The Auth0 PHP SDK contribution guide](CONTRIBUTING.md)

## Support + Feedback

- The [Auth0 Community](https://community.auth0.com/) is a valuable resource for asking questions and finding answers, staffed by the Auth0 team and a community of enthusiastic developers
- For code-level support (such as feature requests and bug reports), we encourage you to [open issues](https://github.com/auth0/auth0-PHP/issues) here on our repo
- For customers on [paid plans](https://auth0.com/pricing/), our [support center](https://support.auth0.com/) is available for opening tickets with our knowledgeable support specialists

Further details about our support solutions are [available on our website.](https://auth0.com/docs/support)

## Vulnerability Reporting

Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

## What is Auth0?

Auth0 helps you to:

- Add authentication with [multiple authentication sources](https://docs.auth0.com/identityproviders), either social like Google, Facebook, Microsoft, LinkedIn, GitHub, Twitter, Box, Salesforce (amongst others), or enterprise identity systems like Windows Azure AD, Google Apps, Active Directory, ADFS or any SAML Identity Provider.
- Add authentication through more traditional **[username/password databases](https://docs.auth0.com/mysql-connection-tutorial)**.
- Add support for [passwordless](https://auth0.com/passwordless) and [multi-factor authentication](https://auth0.com/docs/mfa).
- Add support for [linking different user accounts](https://docs.auth0.com/link-accounts) with the same user.
- Analytics of how, when, and where users are logging in.
- Pull data from other sources and add it to the user profile through [JavaScript rules](https://docs.auth0.com/rules).

[Why Auth0?](https://auth0.com/why-auth0)

## License

The Auth0 PHP SDK is open source software licensed under [the MIT license](https://opensource.org/licenses/MIT). See the [LICENSE](LICENSE.txt) file for more info.

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fauth0%2Fauth0-PHP.svg?type=large)](https://app.fossa.com/reports/4ef17265-c913-439b-8573-70bfc40d974d)
