<?php

declare(strict_types=1);

define('AUTH0_TESTS_DIR', dirname(__FILE__));

require_once join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, '..', 'vendor', 'autoload.php']);

ini_set('session.use_cookies', 'false');
ini_set('session.cache_limiter', 'false');

if (! defined('AUTH0_PHP_TEST_JSON_DIR')) {
    define('AUTH0_PHP_TEST_JSON_DIR', join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, 'json']) . DIRECTORY_SEPARATOR);
}

require_once join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, 'Utilities', 'MockApi.php']);
require_once join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, 'Utilities', 'MockManagementApi.php']);
require_once join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, 'Utilities', 'MockAuthenticationApi.php']);
require_once join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, 'Utilities', 'TokenGenerator.php']);
require_once join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, 'Utilities', 'HttpResponseGenerator.php']);
