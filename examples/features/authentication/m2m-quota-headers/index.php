<?php
declare(strict_types=1);
header('Content-Type: text/plain; charset=utf-8');

/**
 * This example demonstrates how to use the Auth0 SDK for PHP to get M2M Quota Headers.
 *
 * You should invoke this app using routed URLs like http://localhost:3000 or http://localhost:3000/login.
 * Using the PHP built-in web server, you can start this app with the following command: php -S 127.0.0.1:3000 index.php
 */

use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpResponse;
use Dotenv\Dotenv;

// 1. Bootstrap: load Composer autoloader and environment
require __DIR__ . '/vendor/autoload.php';
$env = Dotenv::createImmutable(__DIR__);
$env->load();

// 2. Configure the SDK
$config = new SdkConfiguration([
    'domain'       => $_ENV['DOMAIN']       ?? '',
    'clientId'     => $_ENV['CLIENT_ID']    ?? '',
    'clientSecret' => $_ENV['CLIENT_SECRET']?? '',
    'cookieSecret' => $_ENV['COOKIE_SECRET']?? ''
]);
$auth0 = new Auth0($config);

// 3. Perform a Client Credentials (M2M) request
echo "Performing client-credentials flow...\n";
$response = $auth0->authentication()->clientCredentials([
    'audience' => $_ENV['API_IDENTIFIER'] ?? '',
]);

$status = $response->getStatusCode();
echo "HTTP status code: {$status}\n\n";

// 4. Decode the JSON body
$body = HttpResponse::decodeContent($response);

// ------------------------
// Successful 2xx response
// ------------------------
if ($status >= 200 && $status < 300 && isset($body['access_token'])) {
    echo "Access token received:\n";
    echo substr($body['access_token'], 0, 20) . "... (truncated)\n\n";

    // Parse and display quota/quota headers
    echo "Quota headers (parsed):\n";
    $quotaData = HttpResponse::parseQuotaHeaders($response);
    print_r($quotaData);

    exit(0);
}

// -----------------------------------
// Handle 429 Too Many Requests error
// -----------------------------------
if ($status === 429) {
    echo "Error: Too Many Requests (429)\n";

    // Your new structured quota headers
    echo "Quota headers (parsed):\n";
    $quotaData = HttpResponse::parseQuotaHeaders($response);
    print_r($quotaData);

    exit(1);
}

// -------------------------------
// Any other non-2xx / non-429
// -------------------------------
echo "Unexpected response ({$status}):\n";
print_r($body);
exit(1);
