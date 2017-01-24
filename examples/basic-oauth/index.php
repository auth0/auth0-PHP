<?php

require_once 'vendor/autoload.php';
require_once 'helpers.php';
require_once 'dotenv-loader.php';

use Auth0\SDK\Auth0;

$domain        = getenv('AUTH0_DOMAIN');
$client_id     = getenv('AUTH0_CLIENT_ID');
$client_secret = getenv('AUTH0_CLIENT_SECRET');
$redirect_uri  = getenv('AUTH0_CALLBACK_URL');

$auth0 = new Auth0([
  'domain' => $domain,
  'client_id' => $client_id,
  'client_secret' => $client_secret,
  'redirect_uri' => $redirect_uri,
  'persist_id_token' => true,
  'persist_refresh_token' => true,
]);

$userInfo = $auth0->getUser();

if (isset($_REQUEST['logout'])) {
    $auth0->logout();
    session_destroy();
    header("Location: /");
}

if (isset($_REQUEST['update-metadata'])) require 'update-metadata.php';

if (isset($_REQUEST['create-user'])) {
    require 'create_user.php';
    exit;
}


if ($userInfo) require 'logeduser.php';

$auth0->login();