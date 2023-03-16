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

// If the user is not authenticated, set up the login flow
if (null === $session || $session->accessTokenExpired === true) {
    // Check if the user is completing the authentication flow
    if ($auth0->getExchangeParameters()) {
        // Complete the exchange and setup the session
        try {
            $auth0->exchange();
        } catch (StateException) {
        }

        // The user is now authenticated. Redirect to the logged in page.
        $template->render(__DIR__ . '/../templates/logging-in.latte');

        exit;
    }

    $auth0->clear();

    $state = hash('sha256', bin2hex(random_bytes(32)));
    $nonce = hash('sha256', bin2hex(random_bytes(32)));
    $verifier = PKCE::generateCodeVerifier();
    $challenge = PKCE::generateCodeChallenge($verifier);

    // Store the state, nonce and PKCE verifier in a flash session
    $store = $configuration->getTransientStorage();
    $store->set('state', $state);
    $store->set('nonce', $nonce);
    $store->set('code_verifier', $verifier);

    // Render the login page using Lock
    $template->render(__DIR__ . '/../templates/logged-out.latte', [
        'domain' => $configuration->getDomain(),
        'clientId' => $configuration->getClientId(),
        'redirectUrl' => $configuration->getRedirectUri(),
        'state' => $state,
        'nonce' => $nonce,
        'challenge' => $challenge,
    ]);

    exit;
}

// Render the logged in page for an authenticated user
$template->render(__DIR__ . '/../templates/logged-in.latte', [
    'session' => $session,
]);
