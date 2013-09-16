<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

use Auth0SDK\Auth0;

$auth0 = new Auth0(array(
    'domain'        => $auth0_cfg['domain'],
    'client_id'     => $auth0_cfg['client_id'],
    'client_secret' => $auth0_cfg['client_secret'],
    'redirect_uri'  => $auth0_cfg['redirect_uri']
));

$token = $auth0->getAccessToken();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testing Auth0 PHP</title>
</head>
<body>
<?php if(!$token): ?>
    <!-- PUT YOUR Auth0 HTML/JS CODE HERE -->
    <script id="auth0" src="https://sdk.auth0.com/auth0.js#client=N2UVfwZga4aZlHwXpZHPrFHIKK3vDgoi"></script>
    <button onclick="window.Auth0.signIn({onestep: true})">Login</button>
<?php else: ?>
    <?php var_dump($auth0->getUserInfo()) ?>
<?php endif ?>
</body>
</html>