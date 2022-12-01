<?php

/**
 * Confirm that Auth0\SDK\Auth0 initializes.
 */

require '_common.php';

$configuration = new \Auth0\SDK\Configuration\SdkConfiguration(
    domain: 'test.auth0.com',
    clientId: uniqid(),
    cookieSecret: uniqid(),
);

$sdk = new \Auth0\SDK\Auth0($configuration);

success(__FILE__);
