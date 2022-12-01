<?php

/**
 * Confirm that Auth0\SDK\Configuration\SdkConfiguration initializes.
 */

require '_common.php';

$configuration = new \Auth0\SDK\Configuration\SdkConfiguration(
    domain: 'test.auth0.com',
    clientId: uniqid(),
    cookieSecret: uniqid(),
);

success(__FILE__);
