<?php
$tests_dir = dirname(__FILE__).'/';

require_once $tests_dir.'../vendor/autoload.php';

ini_set('session.use_cookies', false);
ini_set('session.cache_limiter', false);

define( 'AUTH0_PHP_TEST_INTEGRATION_SLEEP', 200000 );

if (! defined( 'AUTH0_PHP_TEST_JSON_DIR' )) {
    define( 'AUTH0_PHP_TEST_JSON_DIR', $tests_dir.'json/' );
}

require_once $tests_dir.'traits/ErrorHelpers.php';
