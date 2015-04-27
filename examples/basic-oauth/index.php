<?php

require_once 'vendor/autoload.php';
require_once 'helpers.php';
require_once 'dotenv-loader.php';

$auth0Oauth = new \Auth0\SDK\Auth0Oauth(array(
  'domain'        => getenv('AUTH0_DOMAIN'),
  'client_id'     => getenv('AUTH0_CLIENT_ID'),
  'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
  'redirect_uri'  => getenv('AUTH0_CALLBACK_URL')
));

$userInfo = $auth0Oauth->getUserInfo();

if (isset($_REQUEST['logout'])) {
    $auth0Oauth->logout();
    session_destroy();
    die('LOGGED OUT');
}

if ($userInfo) dd($userInfo);


require 'login.php';
