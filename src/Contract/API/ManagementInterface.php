<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API;

use Auth0\SDK\API\Management\ManagementInterface as GeneratedManagementInterface;

/**
 * Bridge interface for backwards compatibility with downstream SDKs (e.g. auth0/login).
 *
 * Extends the Fern-generated ManagementInterface so that classes implementing
 * this contract automatically satisfy both the Contract and generated interfaces.
 * This file is handwritten and preserved via .fernignore.
 */
interface ManagementInterface extends GeneratedManagementInterface
{
}
