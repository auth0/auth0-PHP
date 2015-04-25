<?php

require_once '../../vendor/autoload.php';
require_once 'config.php';
require_once 'helpers.php';

$auth0Oauth = new \Auth0\SDK\Auth0Oauth(getAuth0Config());

$userInfo = $auth0Oauth->getUserInfo();

if (isset($_REQUEST['logout'])) {
    $auth0Oauth->logout();
    session_destroy();
    die('LOGGED OUT');
}

if ($userInfo) dd($userInfo);

require 'login.php';