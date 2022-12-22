[← Back to SDK Documentation](../README.md)

# Getting Started

This guide will guide you through creating an example PHP application that uses Auth0's PHP SDK to authenticate users.

## Pre-requisites

[Composer](https://getcomposer.org/) must be installed before continuing. If you don't have it, [follow this installation guide](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos).

This example will use a skeleton template to setup the example application's file structure. If you already have a project, you can skip this step.

```bash
composer require auth0/auth0-php:demo-skeleton auth0-php-demo
```

Now `cd` into the new `auth0-php-demo` directory.

This example application will include dotenv and routing libraries to simplify it's structure:

```bash
composer require vlucas/phpdotenv nikic/fast-route
```

## Requirements

The SDK requires [PSR-17](https://packagist.org/providers/psr/http-factory-implementation) (HTTP factory) and [PSR-18](https://packagist.org/providers/psr/http-client-implementation) (HTTP client) libraries to be available in a host project. These handle the network messaging for the SDK. Any compatible libraries will work, but our example application will use these:

```bash
composer require nyholm/psr7 kriswallsmith/buzz
```

## Install the SDK

You may now install the Auth0-PHP SDK:

```bash
composer require auth0/auth0-php
```

## Configure Auth0

If you don't already have an Auth0 account, [sign up](https://auth0.com/signup) for a free one before continuing.

Open the [Auth0 Dashboard's Applications section](https://manage.auth0.com/#/applications), choose "Create Application," then select "Regular Web Application," and finally, "Create."

You should then see your new application's configuration. Select the "Settings" tab.

Note the following values, as you'll need them to configure the SDK:

- Domain
- Client ID
- Client Secret

You'll need to update the following application settings:

- Application Properties:
  - Set the "Token Endpoint Authentication Method" to `POST`.
- Application URIs:
  - Allowed Callback URLs — set to the URL of your application where Auth0 will redirect to during authentication, e.g., `http://localhost:3000/callback`.
  - Allowed Logout URLs — set to the URL of your application where Auth0 will redirect to after the user logs out, e.g., `http://localhost:3000/login`.

> **Warning:** Ensure you use `localhost` in the callback and logout URLs, and only access the example application from that hostname. You'll get an error when Auth0 redirects back to the application if the hostname changes, due to cookie restrictions.

## Configure the application

Open the `.env` file. This file will hold the example application's configuration. Fill in the blanks with the values you noted earlier.

You'll also need to generate a cookie secret for your application's sessions.

```ini
# Fill in the following values from the Auth0 application details
AUTH0_DOMAIN=...
AUTH0_CLIENT_ID=...
AUTH0_CLIENT_SECRET=...

# A sufficiently long, random string used to encrypt user sessions
# e.g. use `openssl rand -hex 32` to generate a 32-character random string
AUTH0_COOKIE_SECRET=...
```

## Instantiate the SDK

Open the `auth0.php` file. You'll use this file to configure and instantiate the SDK.

```php
<?php

use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

// Setup the configuration for the Auth0 PHP SDK
$configuration = new SdkConfiguration(
    domain: getenv('AUTH0_DOMAIN'),
    clientId: getenv('AUTH0_CLIENT_ID'),
    clientSecret: getenv('AUTH0_CLIENT_SECRET'),
    cookieSecret: getenv('AUTH0_COOKIE_SECRET'),
);

// Instantiate the Auth0 PHP SDK
$auth0 = new Auth0($configuration);
```

Later, the bootstrap file will import this file and scope the `$auth0` variable, so that it's available within all our application route files.

## Create a login route

Open the `app/login.php` file. You'll use this file to create a login route to start a session and redirect the user to Auth0's Universal Login Page.

```php
<?php

// Redirect to Auth0's Universal Login Page
header('Location: ' . $auth0->login());
```

## Create a callback route

Open the `app/callback.php` file. You'll use this file to create a callback route that will handle the response from Auth0 and log the user in.

```php
<?php

// Handle the returning user and log them in
$auth0->exchange()

// Redirect to the index route
header('Location: /');
```

## Create a logout route

Open the `app/logout.php` file. You'll use this file to create a logout route that will log the user out of our application.

```php
<?php

// End the user's local session and return the Auth0 logout URL
$logout = $auth0->logout();

// Redirect to Auth0's logout endpoint to complete the logout
header('Location: ' . $logout);
```

## Create the index route

Open the `app/index.php` file. You'll use this file to create a profile route displaying the user's profile information.

```php
<?php

// Returns an array of user information, or null if not authenticated
$session = $auth0->getCredentials();

// When not authenticated, offer a login link
if (null === $session) {
    echo '<p><a href="/login">Login</a></p>';
    exit;
})

// When authenticated, echo the user's profile information
echo '<p><pre>' . print_r($session->getUser(), true) . '</pre></p>';

// Offer a logout link
echo '<p><a href="/logout">Logout</a></p>';
```

## Configure the application bootstrap

Open the `bootstrap.php` file. This file will define the example application's routes, handle incoming requests, import dependencies, and ensure the SDK is available to all the application's PHP files.

Note that this file is not required for the SDK to work. It's simply a convenience to make the example application easier to manage.

```php
<?php

// Import the Composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Load the .env environment file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configure and instantiate the SDK
require __DIR__ . '/auth0.php';

// Setup the routes for the application
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'index');
    $r->addRoute('GET', '/login', 'login');
    $r->addRoute('GET', '/callback', 'callback');
    $r->addRoute('GET', '/logout', 'logout');
});

// Fetch method and URI of the incoming request
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Match the incoming request against the routes
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        // Include the route's matching PHP file
        require __DIR__ . '/app/' . $handler . '.php';
        break;
}
```

## Run the application

You can now run the application and try it out. Start the PHP development server:

```bash
php -S localhost:3000 -t public/bootstrap.php
```

The example application will now be accessible to you at `http://localhost:3000`.
