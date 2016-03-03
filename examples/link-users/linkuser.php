<?php
require_once 'vendor/autoload.php';
require_once 'helpers.php';
require_once 'dotenv-loader.php';

use Auth0\SDK\Store\SessionStore;
$store = new SessionStore();
$main_user = $store->get('user');
if (!$main_user) {
  header("Location: /linkuser.php");
  exit;
}

$auth0_config = array(
  'domain'        => getenv('AUTH0_DOMAIN'),
  'client_id'     => getenv('AUTH0_CLIENT_ID'),
  'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
  'redirect_uri'  => getenv('AUTH0_CALLBACK_URL'),
  'persist_user' => false,
  'persist_id_token' => false,
  'store' => false,
);

$auth0Oauth = new \Auth0\SDK\Auth0($auth0_config);

$secondary_user = $auth0Oauth->getUser();

if ($secondary_user) {

  $app_token = getenv('AUTH0_APPTOKEN');
  $domain = getenv('AUTH0_DOMAIN');

  echo '<pre>';

  echo "Main user: " . $main_user["user_id"] . "\n";
  echo "Secondary user: " . $secondary_user["user_id"] . "\n";

  $auth0Api = new \Auth0\SDK\Auth0Api($app_token, $domain);

  $response = $auth0Api->users->linkAccount($main_user["user_id"], array(
      "provider" => $secondary_user["identities"][0]["provider"],
      "user_id" => $secondary_user["identities"][0]["user_id"]
    ));

  var_dump($response);

  echo '</pre>';
  exit;
}


?>

<html>
    <head>
        <script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="https://cdn.auth0.com/js/lock-8.1.min.js"></script>

        <script type="text/javascript" src="//use.typekit.net/iws6ohy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- font awesome from BootstrapCDN -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <script>
          var AUTH0_CLIENT_ID = '<?php echo getenv("AUTH0_CLIENT_ID") ?>';
          var AUTH0_DOMAIN = '<?php echo getenv("AUTH0_DOMAIN") ?>';
          var AUTH0_LINKUSER_CALLBACK_URL = '<?php echo is_null(getenv("AUTH0_LINKUSER_CALLBACK_URL")) ?
            "http://localhost:3000/linkuser.php" : getenv("AUTH0_LINKUSER_CALLBACK_URL") ?>';
        </script>


        <script src="/public/app.js"> </script>
        <link href="/public/app.css" rel="stylesheet">



    </head>
    <body class="home">
        <div class="container">
            <div class="login-page clearfix">

              <div class="login-box auth0-box before">
                <img src="https://i.cloudup.com/StzWWrY34s.png" />
                <h3>Auth0 Example</h3>
                <p>Link user</p>
                <a class="btn btn-primary btn-lg btn-link btn-block">Link</a>
              </div>

            </div>
        </div>
    </body>
</html>
