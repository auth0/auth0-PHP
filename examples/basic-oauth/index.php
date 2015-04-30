<?php

require_once 'vendor/autoload.php';
require_once 'helpers.php';
require_once 'dotenv-loader.php';

$auth0Oauth = new \Auth0\SDK\Auth0(array(
  'domain'        => getenv('AUTH0_DOMAIN'),
  'client_id'     => getenv('AUTH0_CLIENT_ID'),
  'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
  'redirect_uri'  => getenv('AUTH0_CALLBACK_URL'),
  'persist_id_token' => true,
));

$userInfo = $auth0Oauth->getUserInfo();

if (isset($_REQUEST['logout'])) {
    $auth0Oauth->logout();
    session_destroy();
    header("Location: /");
}

if (isset($_REQUEST['update-metadata'])) require 'update-metadata.php';

if ($userInfo) require 'logeduser.php';


require 'login.php';
