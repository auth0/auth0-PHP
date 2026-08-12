<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\API\Management\Management as ManagementClient;
use Auth0\SDK\Contract\API\ManagementInterface;

/**
 * Wrapper class to allow importing Management as Auth0\SDK\API\Management.
 * Delegates to the generated Management client at Auth0\SDK\API\Management\Management.
 *
 * Implements the Contract\API\ManagementInterface bridge so that downstream SDKs
 * (e.g. auth0/login) can type-hint against Auth0\SDK\Contract\API\ManagementInterface.
 */
class Management extends ManagementClient implements ManagementInterface
{
}
