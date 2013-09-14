<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once '../vendor/autoload.php';
require_once 'config.php';

use Auth0SDK\Auth0;

$auth0 = new Auth0(array(
    'domain'        => $auth0_cfg['domain'],
    'client_id'     => $auth0_cfg['client_id'],
    'client_secret' => $auth0_cfg['client_secret'],
    'redirect_uri'  => $auth0_cfg['redirect_uri'],
    'debug'         => true
));

$auth0->setDebugger(function($info) {
    file_put_contents("php://stdout", sprintf("\n[%s] %s:%s [%s]: %s\n",
        date("D M j H:i:s Y"), 
        $_SERVER["REMOTE_ADDR"],
        $_SERVER["REMOTE_PORT"], 
        "---",
        $info
    ));
});

$token = $auth0->getAccessToken();

if ($token) {
    header('Location: /');
} else {
    print('Oops! :(');
}