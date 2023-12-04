<?php

declare(strict_types=1);

use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\Auth0Interface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Cache\Adapter\Filesystem\FilesystemCachePool;

require __DIR__ . '/vendor/autoload.php';

requireLocalhost();

$sdk = setupSdk();

switch (getRoute()[0] ?? '') {
    case 'login':
        routeLogin($sdk);
        break;

    case 'logout':
        routeLogout($sdk);
        break;

    case 'callback':
        routeCallback($sdk);
        break;

    case 'backchannel':
        routeBackchannel($sdk);
        break;

    default:
        routeDefault($sdk);
        break;
}

function routeDefault(Auth0Interface $sdk): void {
    if ($sdk->isAuthenticated()) {
        echo '<p><pre>' . print_r($sdk->getUser(), true) . '</pre></p>';
        echo('<a href="/logout">Logout</a>');
    } else {
        echo '<p>You are not logged in.</p>';
        echo('<a href="/login">Login</a>');
    }
}

function routeLogin(Auth0Interface $sdk): void {
    $callback = getBaseUrl() . '/callback';
    $url = $sdk->login(redirectUrl: $callback);

    header('Location: ' . $url);
    exit;
}

function routeLogout(Auth0Interface $sdk): void {
    header('Location: ' . $sdk->logout(returnUri: getBaseUrl()));
    exit;
}

function routeCallback(Auth0Interface $sdk): void {
    if ($sdk->getExchangeParameters()) {
        $sdk->exchange(redirectUri: getBaseUrl());
    }

    header('Location: /');
    exit;
}

function routeBackchannel(Auth0Interface $sdk): void {
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

function setupSdk(): Auth0Interface {
    $env = parse_ini_file('.env', true, INI_SCANNER_TYPED);

    $filesystemAdapter = new Local(__DIR__ . '/cache/');
    $filesystem = new Filesystem($filesystemAdapter);
    $pool = new FilesystemCachePool($filesystem);

    $configuration = new SdkConfiguration(
        domain: $env['DOMAIN'] ?? null,
        customDomain: $env['CUSTOM_DOMAIN'] ?? null,
        clientId: $env['CLIENT_ID'] ?? null,
        clientSecret: $env['CLIENT_SECRET'] ?? null,
        cookieSecret: $env['COOKIE_SECRET'] ?? null,
        cookieExpires: 3600, // Session will expire in 1 hour
        audience: $env['API_IDENTIFIER'] !== null && $env['API_IDENTIFIER'] !== '' ? [$env['API_IDENTIFIER']] : null,
        backchannelLogoutCache: $pool,
    );

    return new Auth0($configuration);
}

function requireLocalhost() {
    $currentUrl = getBaseUrl();

    if (parse_url($currentUrl, PHP_URL_HOST) !== 'localhost') {
        $redirectUrl = parse_url($currentUrl, PHP_URL_SCHEME);
        $redirectUrl .= '://localhost';
        $redirectUrl .= parse_url($currentUrl, PHP_URL_PORT) !== null ? ':' . parse_url($currentUrl, PHP_URL_PORT) : '';

        header('Location: ' . $redirectUrl);
        exit;
    }
}

function getBaseUrl(): string {
    $currentUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $currentUrl .= '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    $baseUrl = parse_url($currentUrl, PHP_URL_SCHEME);
    $baseUrl .= '://' . parse_url($currentUrl, PHP_URL_HOST);
    $baseUrl .= parse_url($currentUrl, PHP_URL_PORT) !== null ? ':' . parse_url($currentUrl, PHP_URL_PORT) : '';

    return $baseUrl;
}

function getRoute(): array {
    $currentUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return array_values(array_filter(explode('/', parse_url($currentUrl, PHP_URL_PATH) ?? '')));
}
