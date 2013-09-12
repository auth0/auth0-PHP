<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once '../src/Auth0.php';

use Auth0SDK\Auth0;

$options = array(
    'domain' => 'XXXX.auth0.com',
    'debug'  => true
);

$auth0 = new Auth0($options);

$client_id = 'XXXXXXXX';
$client_secret = 'XXXXXXXX';

$token = $auth0->login($client_id, $client_secret);

if ($token) {
    print("Login successful.\nYour access token is: $token \n");
} else {
    print("Login failure.\n");
}