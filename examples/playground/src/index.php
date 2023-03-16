<?php

use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Exception\StateException;
use Auth0\SDK\Utility\PKCE;
use Latte\Engine as Template;

require __DIR__ . '/../vendor/autoload.php';

$env = parse_ini_file('.env', true, INI_SCANNER_TYPED);
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$template = new Template();

// Configure SDK using .env file
$configuration = new SdkConfiguration(
    domain: $env['DOMAIN'] ?? null,
    customDomain: $env['CUSTOM_DOMAIN'] ?? null,
    clientId: $env['CLIENT_ID'] ?? null,
    clientSecret: $env['CLIENT_SECRET'] ?? null,
    cookieSecret: $env['COOKIE_SECRET'] ?? null,
    cookieExpires: 3600, // Session will expire in 1 hour
    audience: $env['API_IDENTIFIER'] !== null && $env['API_IDENTIFIER'] !== '{API_AUDIENCE}' ? [$env['API_IDENTIFIER']] : null,
    redirectUri: $url
);

// Initialize the SDK
$auth0 = new Auth0($configuration);

// Check if the user is authenticated
$session = $auth0->getCredentials();

// Check if the user is completing the authentication flow
if ($auth0->getExchangeParameters()) {
    $auth0->exchange();
    header("Location: /");
    exit;
}

// If the user is not authenticated, set up the login flow
if (null === $session) {
    header("Location: " . $auth0->login());
    exit;
}

if ($session->accessTokenExpired === true) {
    $auth0->renew();
    $session = $auth0->getCredentials();
}

// Render the logged in page for an authenticated user
$template->render(__DIR__ . '/../templates/logged-in.latte', [
    'session' => $session,
]);
