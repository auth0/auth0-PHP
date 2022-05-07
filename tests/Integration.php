<?php

declare(strict_types=1);

/**
 * This script is designed to run a single query against an endpoint
 */

define('AUTH0_TESTS_DIR', dirname(__FILE__));

require_once join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, '..', 'vendor', 'autoload.php']);
