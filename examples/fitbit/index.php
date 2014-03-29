<?php
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testing Auth0 PHP with fitbit provider</title>
</head>
<body>
    <h1>Fitbit Test</h1>
    <script src="https://d19p4zemcycm7a.cloudfront.net/w2/auth0-widget-2.3.min.js"></script>
    <script type="text/javascript">
        var widget = new Auth0Widget({
            domain:         "<?php echo $auth0_cfg['domain'] ?>",
            clientID:       "<?php echo $auth0_cfg['client_id'] ?>",
            callbackURL:    "<?php echo $auth0_cfg['redirect_uri'] ?>"
        });
    </script>
    <button onclick="widget.signin()">Login</button>
</body>
</html>
