[← Back to SDK Documentation](../README.md)

# Getting Started

This guide will guide you through creating a simple PHP application that uses Auth0's PHP SDK to authenticate users. You could also adapt these instructions toward integrating an existing PHP application.

## Pre-requisites

[Composer](https://getcomposer.org/) must be installed before continuing. If you don't have it, [follow this installation guide](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos).

You will need a project directory set up to work on the demo application. This guide assumes your project is already set up with the necessary boilerplate and helper dependencies. Follow one of the following processes to get set up:

<details>
<summary><b>Setup using a template (recommended)</b></summary>

A skeleton application template is available that includes the necessary boilerplate and helper dependencies to get started.

```bash
composer create-project auth0/auth0-php:demo-skeleton auth0-php-demo
```

</details>

<details>
<summary><b>Setup manually</b></summary>

1. Create a directory called `auth0-php-demo` and open a shell in that directory.
2. Run `composer init` and follow the prompts to create a `composer.json` file.
3. Import a dotenv and routing library into the project to simplify the demo application:

   ```bash
   composer require vlucas/phpdotenv nikic/fast-route
   ```

4. Import a PSR-17 and PSR-18 library. Any implementations will work, but this guide will use these:

   ```bash
   composer require nyholm/psr7 kriswallsmith/buzz
   ```

5. Create the following file structure:

   ```
   .env
   auth0.php
   public/bootstrap.php
   routes/index.php
   routes/login.php
   routes/callback.php
   routes/logout.php
   ```

6. Paste the following into `bootstrap.php`:

   ```php
   <?php

   // Import the Composer autoloader
   require __DIR__ . '/vendor/autoload.php';

   // Load the .env environment file
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();

   // Configure and instantiate the SDK
   require __DIR__ . '/../auth0.php';

   if (getenv('HTTP_HOST') !== 'localhost') {
        die('Please invoke this application from `localhost`.');
   }

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
           require __DIR__ . '/routes/' . $handler . '.php';
           break;
   }
   ```

7. Run the following command and make note of the returned string:

   ```bash
   openssl rand -hex 32
   ```

8. Paste the following into `.env`:

   ```
   AUTH0_DOMAIN=
   AUTH0_CLIENT_ID=
   AUTH0_CLIENT_SECRET=
   AUTH0_COOKIE_SECRET=
   ```

   Set `AUTH0_COOKIE_SECRET` to the string returned from the previous step.

</details>

> **Note:** Throughout this guide we will refer to the `auth0-php-demo` directory as the "project root".

## Requirements

Environment:

- Have [a supported version of PHP](../../README.md#requirements) installed.
- Have the [mbstring extension](https://www.php.net/manual/en/book.mbstring.php) installed.

Project:

- Have a [PSR-17](https://packagist.org/providers/psr/http-factory-implementation) (HTTP factory) and [PSR-18](https://packagist.org/providers/psr/http-client-implementation) (HTTP client) library installed.

## Install the SDK

From your project root, use Composer to install the Auth0 SDK:

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

## Configure the environment

Open the `.env` file, which will hold the demo application's configuration. Fill in each line with your Auth0 application details, which were noted in the previous step.

```ini
AUTH0_DOMAIN=
AUTH0_CLIENT_ID=
AUTH0_CLIENT_SECRET=…
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

Our bootstrap imports this file and ensures the `$auth0` variable is available to the rest of the application.

## Logging in

Open the `routes/login.php` file. This route will start an app session and redirect the user to Auth0's Universal Login Page for authentication.

```php
<?php

// Redirect to Auth0's Universal Login Page
header('Location: ' . $auth0->login());
```

### Handling the callback

Open the `routes/callback.php` file. After authenticating with Auth0, users will be returned to the demo application at this route. The SDK handles the response and completes the authentication flow for the demo application.

```php
<?php

// Complete the authentication flow
$auth0->exchange()

// Redirect to the index route
header('Location: /');
```

## Logging out

Open the `routes/logout.php` file. This will clear the app session, and redirect to [Auth0's logout endpoint](https://auth0.com/docs/authenticate/login/logout). After, users are returned to the demo application.

```php
<?php

// Redirect to Auth0's logout endpoint to complete de-authentication
header('Location: ' . $auth0->logout());
```

## Accessing session information

Open the `routes/index.php` file. This will display profile information for authenticated users, or offer a login link for those who are not.

```php
<?php

// Returns an object containing session information, or null when not authenticated
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

## Run the demo application

Start the PHP local development server:

```bash
php -S localhost:3000 -t public/bootstrap.php
```

Point your browser to `http://localhost:3000` to try the demo application.
