<?php

declare(strict_types=1);

/**
 * This example demonstrates how to use the Auth0 SDK for PHP to support Backchannel Logout.
 *
 * You should invoke this app using routed URLs like http://app.dev:3000 or http://app.dev:3000/login.
 * Using the PHP built-in web server, you can start this app with the following command: php -S 127.0.0.1:3000 index.php
 *
 * Important considerations:
 *
 * 1. For Backchannel Logout to work, your web server MUST be accessible from the internet.
 *    Auth0 will communicate with your app/server directly to send logout tokens.
 *    You can use a tool like ngrok (https://ngrok.com/) to expose your local server to the internet.
 *
 * 2. You must configure your Auth0 tenant to use Backchannel Logout.
 *    The logout URI should point to this app's /backchannel route, i.e. http://app.dev:3000/backchannel.
 *    See https://auth0.com/docs/authenticate/login/logout/back-channel-logout/configure-back-channel-logout for details.
 */

use Auth0\SDK\Contract\Auth0Interface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Cache\Adapter\Filesystem\FilesystemCachePool;

// Review the common.php file for SDK setup and configuration details.
require __DIR__ . '/../common.php';

// A persistent cache of some kind is required to store logout tokens between requests.
// This example uses the FilesystemCachePool as a flatfile-based storage medium, but you can use any PSR-6 compatible cache.
// In a production application, we'd strongly recommend a high performance, low latency solution such as Redis for this purpose.
$filesystemAdapter = new Local(__DIR__ . '/cache/');
$filesystem = new Filesystem($filesystemAdapter);
$pool = new FilesystemCachePool($filesystem);

// Update the SDK configuration (created in ../common.php) to use the logout token cache.
$sdk->configuration()->setBackchannelLogoutCache($pool);

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

    case 'backchannel':
        backchannel($sdk);
        break;

    default:
        home($sdk);
        break;
}

// Index/homepage route. Just shows the user's profile if logged in, or a login link if not.
function home(Auth0Interface $sdk): void {
    // Check if a user is authenticated. Upon request, isAuthenticated() or getCredentials() will invalidate a session that has received a backchannel logout.
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
        exit;
    }

    echo '<p>You are not logged in.</p>';
    echo('<a href="/login">Login</a>');
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

// Backchannel route. Accepts logout tokens from Auth0.
function backchannel(Auth0Interface $sdk): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_SERVER['CONTENT_TYPE'] !== 'application/x-www-form-urlencoded') {
        exit;
    }

    $request = file_get_contents('php://input');

    if ($request === false) {
        exit;
    }

    $request = urldecode($request);

    if (strpos($request, 'logout_token') === false) {
        exit;
    }

    parse_str($request, $payload);

    $logoutToken = trim($payload['logout_token'] ?? '');

    if ($logoutToken === '') {
        exit;
    }

    $sdk->handleBackchannelLogout($logoutToken);
    exit;
}
