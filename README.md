# Auth0 PHP SDK

[![Build Status](https://img.shields.io/circleci/project/github/auth0/auth0-PHP/master.svg)](https://circleci.com/gh/auth0/auth0-PHP)
[![Code Coverage](https://codecov.io/gh/auth0/auth0-PHP/branch/master/graph/badge.svg)](https://codecov.io/gh/auth0/auth0-PHP)
[![License](https://img.shields.io/packagist/l/auth0/auth0-php)](https://packagist.org/packages/auth0/auth0-PHP)
[![FOSSA Status](https://app.fossa.com/api/projects/custom%2B4989%2Fgit%40github.com%3Aauth0%2Fauth0-PHP.git.svg?type=shield)](https://app.fossa.com/projects/custom%2B4989%2Fgit%40github.com%3Aauth0%2Fauth0-PHP.git?ref=badge_shield)

The Auth0 PHP SDK is a straightforward and rigorously tested library for accessing Auth0's Authentication and Management API endpoints using modern PHP releases. Auth0 enables you to integrate authentication and authorization for your applications rapidly so that you can focus on your core business. [Learn more.](https://auth0.com/why-auth0)

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
  - [Getting Started](#getting-started)
  - [SDK Initialization](#sdk-initialization)
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

- PHP 7.4 or 8.0+
- [Composer](https://getcomposer.org/)

⚠️ PHP 7.3 is supported on the SDK 7.0 branch through December 2021.

🗓 This library follows the [PHP release support schedule](https://www.php.net/supported-versions.php). We do not support PHP releases after they reach end-of-life. Composer handles these deprecations safely, so this is not considered a breaking change and can occur in major releases. Please ensure you are always running the latest PHP runtime to keep receiving our latest library updates.

## Installation

The supported method of SDK installation is through [Composer](https://getcomposer.org/):

```bash
$ composer require auth0/auth0-php
```

You can find guidance on installing Composer [here](https://getcomposer.org/doc/00-intro.md).

## Usage

### Getting Started

To get started, you'll need to create a [free Auth0 account](https://auth0.com/signup) and register an [Application](https://auth0.com/docs/applications).

### SDK Initialization

Begin by instantiating the SDK and passing the appropriate configuration options:

```PHP
<?php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

$configuration = new SdkConfiguration(
    // The values below are found in the Auth0 dashboard, under application settings:
    domain: '{{YOUR_TENANT}}.auth0.com',
    clientId: '{{YOUR_APPLICATION_CLIENT_ID}}',
    clientSecret: '{{YOUR_APPLICATION_CLIENT_SECRET}}',

    // This is your application URL that will be used to process the login.
    // Save this URL in the "Allowed Callback URLs" field on the Auth0 dashboard, under application settings.
    redirectUri: 'https://{{YOUR_APPLICATION_CALLBACK_URL}}',
);

$auth0 = new Auth0($configuration);
```

> ⚠️ **Note:** _You should **never** hard-code tokens or other sensitive configuration data in a real-world application. Consider using environment variables to store and pass these values to your application._

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
    $auth0->login();
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
    $auth0->logout();
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
    // 🔎 Logging in after adding the 'offline_access' scope is necessary for this to work to retrieve Refresh Tokens.
    $auth0->login();
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
        $auth0->login();
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
    /*
        🧩 Include other required configuration options, such as outlined in the 'SDK Initialization' step above here.
    */

    // The process for retrieving an Access Token for Management API endpoints is described here:
    // https://auth0.com/docs/libraries/auth0-php/using-the-management-api-with-auth0-php
    managementToken: '{{YOUR_ACCESS_TOKEN}}'
);

$auth0 = new Auth0($configuration);
```

> ⚠️ **Note:** _You should **never** hard-code tokens or other sensitive configuration data in a real-world application. Consider using environment variables to store and pass these values to your application._

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

[Organizations](https://auth0.com/docs/organizations) is a set of features that provide better support for developers who build and maintain SaaS and Business-to-Business (B2B) applications.

Using Organizations, you can:

- Represent teams, business customers, partner companies, or any logical grouping of users that should have different ways of accessing your application as organizations.
- Manage their membership in a variety of ways, including user invitation.
- Configure branded, federated login flows for each Organization.
- Implement role-based access control, such that users can have different roles when authenticating in the context of various organizations.
- Build administration capabilities into your products, using the Organizations API, so that those businesses can manage their organizations.

Note that Organizations is currently only available to customers on our Enterprise and Startup subscription plans.

#### Initializing the SDK with Organizations

Configure the SDK with your Organization ID:

```PHP
<?php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;

$configuration = new SdkConfiguration(
    /*
        🧩 Include other required configuration options, such as outlined in the 'SDK Initialization' step above here.
    */

    // Found in your Auth0 dashboard, under your organization settings.
    // Note that this must be configured as an array.
    organization: [ '{{YOUR_ORGANIZATION_ID}}' ]
);

$auth0 = new Auth0($configuration);
```

> ⚠️ **Note:** _You should **never** hard-code tokens or other sensitive configuration data in a real-world application. Consider using environment variables to store and pass these values to your application._

#### Logging in with an Organization

With the SDK initialized using your Organization, you can use the `Auth0::login()` method as you normally would. Methods throughout the SDK will use the Organization Id you configured in their API calls.

```PHP
<?php

// 🧩 Include the configuration code from the 'Initializing the SDK with Organizations' step above here.

$session = $auth0->getCredentials();

// Is this end-user already signed in?
if ($session === null) {
  // They are not. Redirect the end user to the login page.
  $auth0->login();
  exit;
}
```

#### Accepting user invitations

Auth0 Organizations allow users to be invited using emailed links, which will direct a user back to your application. The user will be sent to your application URL based on your configured `Application Login URI,` which you can change from your application's settings inside the Auth0 dashboard.

When the user arrives at your application using an invite link, three query parameters are available: `invitation,` `organization,` and `organization_name.` These will always be delivered using a GET request.

A helper function is provided to handle extracting these query parameters and automatically redirecting to the Universal Login page:

```PHP
<?php

// 🧩 Include the configuration code from the 'Initializing the SDK with Organizations' step above here.

$auth0->handleInvitation();
```

Suppose you prefer to have more control over this process. In that case, extract the relevant query parameters using `getInvitationParameters(),` and then initiate the Universal Login redirect yourself:

```PHP
<?php

// 🧩 Include the configuration code from the 'Initializing the SDK with Organizations' step above here.

// Returns an object containing the invitation query parameters, or null if they aren't present
if ($invite = $auth0->getInvitationParameters()) {
  // Does the invite organization match your intended organization?
  if ($invite->organization !== '{{YOUR_ORGANIZATION_ID}}') {
    throw new Exception("This invitation isn't intended for this service. Please have your administrator check the service configuration and request a new invitation.");
  }

  // Redirect to Universal Login using the emailed invitation
  $auth0->login([
    'invitation' => $invite->invitation,
    'organization' => $invite->organization,
  ]);
}
```

After successful authentication via the Universal Login Page, the user will arrive back at your application using your configured `redirect_uri,` their token will be validated, and they will have an authenticated session. Use `Auth0::getCredentials()` to retrieve details about the authenticated user.

#### Validation guidance for supporting multiple organizations

In the examples above, our application is operating with a single, configured Organization. By initializing the SDK with the `organization` argument, we tell the internal token verifier to validate an `org_id` claim's presence and match what was provided.

In some cases, your application may need to support validating tokens' `org_id` claims for several different organizations. When initializing the SDK, the `organization` argument accepts an array of organizations; during token validation, if ANY of those organization ids match, the token is accepted. When creating links or issuing API calls, the first Organization Id in that array will be used. You can alter this at any time by updating your `SdkConfiguration` or passing custom parameters to those methods.

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
  - [Basic authentication example](https://auth0.com/docs/quickstart/webapp/php/) ([GitHub repo](https://github.com/auth0-samples/auth0-php-web-app/tree/master/00-Starter-Seed))
  - [Authenticated backend API example](https://auth0.com/docs/quickstart/backend/php/) ([GitHub repo](https://github.com/auth0-samples/auth0-php-api-samples/tree/master/01-Authenticate))

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

[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fauth0%2Fauth0-PHP.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Fauth0%2Fauth0-PHP?ref=badge_large)
