<?php

declare(strict_types=1);

/**
 * This example demonstrates how to use the Auth0 SDK for PHP to perform a Pushed Authorization Request (PAR).
 *
 * You should invoke this app using routed URLs like http://localhost:3000 or http://localhost:3000/login.
 * Using the PHP built-in web server, you can start this app with the following command: php -S 127.0.0.1:3000 index.php
 */

use Auth0\SDK\Contract\Auth0Interface;

// Review the common.php file for SDK setup and configuration details.
require __DIR__ . '/../common.php';

// Update the SDK configuration (created in ../common.php) to use Pushed Authorization Requests.
$sdk->configuration()->setPushedAuthorizationRequest(true);

// To avoid confusion between 127.0.0.1 and localhost (which are not interchangeable as far as cookies are concerned) we'll only allow this example to run on localhost.
// Comment out this call if you want to run this example on a different domain.
requireLocalhost();

// Setup routing.
switch (getRoute()[0] ?? '') {
    case 'login':
        login($sdk);
        break;

    case 'logout':
        logout($sdk);
        break;

    case 'callback':
        callback($sdk);
        break;

    default:
        home($sdk);
        break;
}

// Index/homepage route. Just shows the user's profile if logged in, or a login link if not.
function home(Auth0Interface $sdk): void {
    // Check if the user is authenticated.
    if ($sdk->isAuthenticated()) {
        // Check if the user's access token has expired.
        if (true === $sdk->getCredentials()?->accessTokenExpired) {
            try {
                $sdk->renew(); // Attempt to renew the session using an available refresh token.
            } catch (Throwable $exception) {
                $sdk->clear(); // If the session cannot be renewed, clear it.
            }

            header("Refresh: 0");
            echo("<meta http-equiv='refresh' content='0'>");
            exit;
        }

        echo '<p><pre>' . print_r($sdk->getUser(), true) . '</pre></p>';
        echo('<a href="/logout">Logout</a>');
    } else {
        echo '<p>You are not logged in.</p>';
        echo('<a href="/login">Login</a>');
    }
}

// Login route. Redirects to Auth0 for login.
function login(Auth0Interface $sdk): void {
    $callback = getBaseUrl() . '/callback';
    $url = $sdk->login(redirectUrl: $callback);

    header('Location: ' . $url);
    exit;
}

// Logout route. Redirects to Auth0 for logout. Returns to the homepage after logout.
function logout(Auth0Interface $sdk): void {
    header('Location: ' . $sdk->logout(returnUri: getBaseUrl()));
    exit;
}

// Callback route. Handles the user's return trip from Auth0 after login.
function callback(Auth0Interface $sdk): void {
    if ($sdk->getExchangeParameters()) {
        $sdk->exchange(redirectUri: getBaseUrl());
    }

    header('Location: /');
    exit;
}
