<?php

  // Require composer autoloader
  require __DIR__ . '/vendor/autoload.php';

  require __DIR__ . '/dotenv-loader.php';

  $auth0 = new \Auth0\SDK\Auth0(array(
    'domain'        => getenv('AUTH0_DOMAIN'),
    'client_id'     => getenv('AUTH0_CLIENT_ID'),
    'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
    'redirect_uri'  => getenv('AUTH0_CALLBACK_URL')
  ));


  $userInfo = $auth0->getUserInfo();

?>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="https://cdn.auth0.com/js/lock-7.min.js"></script>

        <script type="text/javascript" src="//use.typekit.net/iws6ohy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- font awesome from BootstrapCDN -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <script>
          var AUTH0_CLIENT_ID = '<?php echo getenv("AUTH0_CLIENT_ID") ?>';
          var AUTH0_DOMAIN = '<?php echo getenv("AUTH0_DOMAIN") ?>';
          var AUTH0_CALLBACK_URL = '<?php echo is_null(getenv("AUTH0_CALLBACK_URL")) ?
            "http://localhost:3000/index.php" : getenv("AUTH0_CALLBACK_URL") ?>';
        </script>


        <script src="/public/app.js"> </script>
        <link href="/public/app.css" rel="stylesheet">



    </head>
    <body class="home">
        <div class="container">
            <div class="login-page clearfix">
              <?php if(!$userInfo): ?>
              <div class="login-box auth0-box before">
                <img src="https://i.cloudup.com/StzWWrY34s.png" />
                <h3>Auth0 Example</h3>
                <p>Zero friction identity infrastructure, built for developers</p>
                <a class="btn btn-primary btn-lg btn-login btn-block">SignIn</a>
              </div>
              <?php else: ?>
              <div class="logged-in-box auth0-box logged-in">
                <h1 id="logo"><img src="//cdn.auth0.com/samples/auth0_logo_final_blue_RGB.png" /></h1>
                <img class="avatar" src="<?php echo $userInfo['picture'] ?>"/>
                <h2>Welcome <span class="nickname"><?php echo $userInfo['nickname'] ?></span></h2>
              </div>
              <?php endif ?>
            </div>
        </div>
    </body>
</html>
