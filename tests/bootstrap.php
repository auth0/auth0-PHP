<?php
$tests_dir = dirname(__FILE__).'/';

set_time_limit ( 1000 );

require_once $tests_dir.'../vendor/autoload.php';

if (! defined( 'AUTH0_PHP_TEST_JSON_DIR' )) {
    define( 'AUTH0_PHP_TEST_JSON_DIR', $tests_dir.'json/' );
}

require_once $tests_dir.'traits/ErrorHelpers.php';
