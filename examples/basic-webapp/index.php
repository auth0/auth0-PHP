<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/dotenv-loader.php';

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

if (!$userInfo) {
  $auth0->login();
}

?>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-3.0.0.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="//use.typekit.net/iws6ohy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- font awesome from BootstrapCDN -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

        <link href="public/app.css" rel="stylesheet">

    </head>
    <body class="home">
        <div class="container">
            <div class="login-page clearfix">
              <div class="logged-in-box auth0-box logged-in">
                <h1 id="logo"><img src="//cdn.auth0.com/samples/auth0_logo_final_blue_RGB.png" /></h1>
                <img class="avatar" src="<?php echo $userInfo['picture'] ?>"/>
                <h2>Welcome <span class="nickname"><?php echo $userInfo['nickname'] ?></span></h2>
              </div>
            </div>
        </div>
    </body>
</html>
