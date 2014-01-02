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

$access_token = $auth0->getAccessToken();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testing Auth0 PHP</title>
</head>
<body>
<?php if(!$access_token): ?>
    <script src="https://d19p4zemcycm7a.cloudfront.net/w2/auth0-widget-2.3.min.js"></script>
	<script type="text/javascript">
  		var widget = new Auth0Widget({
	    	domain:         "<?php echo $auth0->getDomain() ?>",
	    	clientID:       "<?php echo $auth0->getClientId() ?>",
	    	callbackURL:    "<?php echo $auth0->getRedirectUri() ?>"
	  	});
	</script>
	<button onclick="widget.signin()">Login</button>
<?php else: ?>
    <?php var_dump($auth0->getUserInfo()) ?>
<?php endif ?>
</body>
</html>