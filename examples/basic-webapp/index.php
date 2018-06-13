<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Auth0\SDK\Auth0;
use Dotenv\Dotenv;

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Load env variables
// https://github.com/vlucas/phpdotenv#usage
$dotenv = new Dotenv(__DIR__);
$dotenv->load();

// Create a new Auth0 instance
// https://github.com/auth0/auth0-PHP#oauth2-authentication
$auth0 = new Auth0([
  'domain' => $_ENV[ 'AUTH0_DOMAIN' ],
  'client_id' => $_ENV[ 'AUTH0_CLIENT_ID' ],
  'client_secret' => $_ENV[ 'AUTH0_CLIENT_SECRET' ],
  'redirect_uri' => $_ENV[ 'AUTH0_CALLBACK_URL' ],
  'scope' => 'openid profile email',
  'persist_id_token' => true,
  'persist_refresh_token' => true,
]);

if (isset($_GET['logout'])) {
  // Catch logout requests and process
    $auth0->logout();
    session_destroy();
    header('Location: ' . $_ENV[ 'AUTH0_CALLBACK_URL' ]);
    die();
} elseif (isset($_GET[ 'login' ])) {
  // Redirect to the hosted login page
    $auth0->login();
}

// Get userinfo from session or from code exchange after login
$userinfo = $auth0->getUser();

// Redirect to not show auth parameters (not required)
if (! empty($_GET['code'])) {
    header('Location: ' . $_ENV[ 'AUTH0_CALLBACK_URL' ]);
    die();
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Auth0 PHP Webapp Example</title>
        <link rel="stylesheet" href="https://cdn.auth0.com/styleguide/core/2.0.5/core.min.css" />
        <link rel="stylesheet" href="https://cdn.auth0.com/styleguide/components/2.0.0/components.min.css" />
        <link type="text/css" rel="stylesheet" href="main.css">
    </head>
    <body>
        <section>
            <img class="logo" src="//cdn.auth0.com/samples/auth0_logo_final_blue_RGB.png">
            <?php if (! empty($_GET['error'])) : ?>
                <div class="alert alert-danger"><?php echo strip_tags($_GET['error']) ?></div>
            <?php endif; ?>
            <?php if ($userinfo) :
                $picture = filter_var($userinfo['picture'], FILTER_SANITIZE_URL);
                $nickname = filter_var($userinfo['nickname'], FILTER_SANITIZE_STRING);
                $email = filter_var($userinfo['email'], FILTER_SANITIZE_EMAIL);
                ?>
                <img class="avatar" src="<?php echo $picture; ?>"/>
                <h1><?php echo $nickname; ?></h1>
                <p class="<?php echo $userinfo[ 'email_verified' ] ? 'verified' : 'not-verified'; ?>">
                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                <p><a class="btn btn-success" href="?logout" tabindex="1">Logout</a></p>
            <?php else : ?>
                <p><a class="btn btn-primary" href="?login" tabindex="1">Login</a></p>
            <?php endif; ?>
        </section>
    </body>
</html>
