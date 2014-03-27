<?php
$auth0_cfg = array(
    'domain'        => 'example.auth0.com',
    'client_id'     => 'XXXXX',
    'client_secret' => 'XXXXX',
    'redirect_uri'  => 'http://<ip>[:port]/callback.php'
);

// You need to create a fitbit application and configure your Auth0 account to use this
$fitbit_cfg = array(
	'consumer_key'     => 'XXXXX',
	'consumer_secret'  => 'XXXXX'
);
