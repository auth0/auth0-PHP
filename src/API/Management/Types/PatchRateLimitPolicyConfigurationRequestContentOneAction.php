<?php

namespace Auth0\SDK\API\Management\Types;

enum PatchRateLimitPolicyConfigurationRequestContentOneAction: string
{
    case Block = "block";
    case Log = "log";
}
