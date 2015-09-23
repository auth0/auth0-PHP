<?php

require_once 'vendor/autoload.php';
require_once 'helpers.php';
require_once 'dotenv-loader.php';

$auth0_config = array(
  'domain'        => getenv('AUTH0_DOMAIN'),
  'client_id'     => getenv('AUTH0_CLIENT_ID'),
  'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
  'redirect_uri'  => getenv('AUTH0_CALLBACK_URL'),
  'persist_id_token' => true,
);

if (isset($_REQUEST['link'])) {
  $auth0_config['persist_user'] = false;
  $auth0_config['persist_id_token'] = false;
  $auth0_config['store'] = false;
}

$auth0Oauth = new \Auth0\SDK\Auth0($auth0_config);

$userInfo = $auth0Oauth->getUser();

if (isset($_REQUEST['logout'])) {
    $auth0Oauth->logout();
    session_destroy();
    header("Location: /");
}

if ($userInfo) {
  header("Location: /linkuser.php");
  exit;
}


require 'login.php';
